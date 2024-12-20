<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Mail\Mailorder;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use App\Models\Payment;
use DateTime;
use Illuminate\Support\Facades\Date;

class CheckoutController extends Controller
{
    static $vnp_TmnCode = "W6YEW49O";
    static $vnp_HashSecret = "WSBCHHFZBEGYEQNOQHVKLNCGZVHQTHMU";
    static $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    static $vnp_Returnurl = "/checkout/vnPayCheck";

    public function index()
    {
        // Lấy thông tin từ giỏ hàng
        $cartItems = Cart::content();
        // Tính tổng giá trị của các sản phẩm trong giỏ hàng
        $subtotal = Cart::subtotal(0, '.', '');  // Sử dụng các tham số mặc định để không có phần thập phân
        // Tính chi phí vận chuyển (Giả sử là miễn phí)
        if ($subtotal > 100000) {
            $shipping = 0;
        } else {
            $shipping = 0.1 * $subtotal;
        }
        return view('client.checkout', compact('cartItems', 'subtotal', 'shipping'));
    }

    public function checkout(Request $request)
    {
        // Lấy thông tin từ giỏ hàng
        $cartItems = Cart::content();
        $subtotal = Cart::subtotal(0, '.', '');
        if ($subtotal > 100000) {
            $shipping = 0;
        } else {
            $shipping = 0.1 * $subtotal;
        }
        $cartTotal = $subtotal + $shipping;
        // Kiểm tra giỏ hàng trống
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Validate request
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'note' => 'nullable|string',
            'payment' => 'required|in:1,2',
            'total_amount' => 'required|numeric',
            'coupon_code' => 'nullable|string', // Thêm trường coupon_code
        ], [
            'name.required' => 'Vui lòng nhập Họ Tên.',
            'email.required' => 'Vui lòng nhập Email.',
            'email.email' => 'Email không hợp lệ.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.numeric' => 'Số điện thoại phải là số.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'payment.required' => 'Vui lòng chọn phương thức thanh toán.',
            'payment.in' => 'Phương thức thanh toán không hợp lệ.',
        ]);

        // Cập nhật dữ liệu đơn hàng
        $data['status'] = 'pending'; // Trạng thái chờ xác nhận

        // Nếu người dùng đã đăng nhập, thêm user_id vào dữ liệu
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        } else {
            $user = User::firstOrCreate(
                ['email' => $data['email']], // Kiểm tra dựa trên email
                ['name' => 'guest', 'phone' => $data['phone'], 'address' => $data['address'], 'password' => bcrypt(date("Y-m-d H:i:s"))] // Tạo mới nếu không tồn tại
            );
            $data['user_id'] = $user->id;
        }

        // Kiểm tra và áp dụng coupon (nếu có)
        $discount = 0;
        $coupon = null;
        if ($request->has('coupon_code') && $request->coupon_code) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();

            if ($coupon && $coupon->isValid()) {
                // Tính toán giảm giá từ coupon
                $discount = $coupon->calculateDiscount($cartTotal);

                // tăng số lượt sử dụng của coupon
                $coupon->increment('used_count');

                // Lưu lại coupon_id vào đơn hàng
                $data['coupon_id'] = $coupon->id;
            } else {
                return redirect('checkout')->with('error', 'Mã coupon không hợp lệ hoặc đã hết lượt sử dụng!');
            }
        }

        // Cập nhật tổng số tiền sau khi áp dụng giảm giá
        $finalAmount = $cartTotal - $discount;
        $data['total_amount'] = $finalAmount;
        if ($data['payment'] == 2) {
            // Tạo order mới và thanh toán
            DB::beginTransaction();
            try {
                // Tạo order
                $order = Order::create([
                    'user_id' => $data['user_id'],
                    'total_amount' => $finalAmount,
                    'discount' => $discount,
                    'coupon_id' => $data['coupon_id'] ?? null, // Nếu không có coupon, để null
                    'status' => $data['status'],
                ]);

                // Tạo chi tiết đơn hàng
                $this->createOrderDetail($order);

                // Tạo bản ghi thanh toán
                $payment = new Payment();
                $payment->order_id = $order->id;
                $payment->payment_method = 'cash_on_delivery'; // Đổi theo phương thức thanh toán
                $payment->payment_status = 'pending'; // Trạng thái thanh toán
                $payment->amount = $finalAmount;
                $payment->save();

                DB::commit();

                // Gửi email
                $created_at = $order->created_at;
                Mail::to($data['email'])->send(new Mailorder([
                    'order' => $order,
                    'cart' => $cartItems,
                    'created_at' => $created_at,
                ]));

                // Xóa giỏ hàng
                Cart::destroy();

                return back()->with('success', 'Đặt hàng thành công! Vui lòng kiểm tra email để xem thông tin đơn hàng.');
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }
        }
        if ($data['payment'] == 1) {
            // Tạo order
            $order = Order::create([
                'user_id' => $data['user_id'],
                'total_amount' => $finalAmount,
                'discount' => $discount,
                'coupon_id' => $data['coupon_id'] ?? null, // Nếu không có coupon, để null
                'status' => $data['status'],
            ]);

            // Gửi email
            $created_at = $order->created_at;
            Mail::to($data['email'])->send(new Mailorder([
                'order' => $order,
                'cart' => $cartItems,
                'created_at' => $created_at,
            ]));

            $data = [
                'vnp_TxnRef' => $order->id,
                'vnp_OrderInfo' => 'Order Payment No.' . $order->id,
                'vnp_Amount' => $order->total_amount,
            ];
            $data_url = $this->vnpay_create_payment($data);
            // Chuyển hướng đến URL lấy được
            return Redirect::to($data_url);
        }
    }


    protected function createOrderDetail($order)
    {
        // Lấy tất cả các sản phẩm trong giỏ hàng
        $carts = Cart::content();

        // Lặp qua từng sản phẩm trong giỏ hàng
        foreach ($carts as $item) {
            // Lấy sản phẩm từ bảng products
            $product = Product::find($item->id);

            // Kiểm tra số lượng còn lại của sản phẩm trước khi giảm
            if ($product->stock < $item->qty) {
                return back()->with('error', 'Sản phẩm ' . $item->name . ' không đủ số lượng trong kho.');
            }

            // Giảm số lượng sản phẩm trong kho
            $product->decrement('stock', $item->qty);
            $product->save();

            // Lưu thông tin chi tiết đơn hàng vào bảng order_items
            $order->orderItems()->create([
                'product_id' => $item->id,
                'quantity' => $item->qty,
                'price' => $item->price,
            ]);
        }
    }





    public function checkOrder(Request $request)
    {
        // Validate dữ liệu từ request
        $data = $request->validate([
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        // Lấy dữ liệu từ request
        $phone = $request->input('phone');
        $email = $request->input('email');

        // Kiểm tra nếu cả phone và email đều không có dữ liệu
        if (empty($phone) && empty($email)) {
            return back()->with('error', 'Vui lòng nhập số điện thoại hoặc email để kiểm tra đơn hàng.');
        }

        // Xử lý logic kiểm tra đơn hàng
        $ordersQuery = Order::query();

        // Áp dụng điều kiện tìm kiếm nếu có
        if ($phone) {
            $ordersQuery->where('phone', $phone);
        }
        if ($email) {
            $ordersQuery->where('email', $email);
        }

        // Lấy danh sách đơn hàng
        $orders = $ordersQuery->paginate(10);

        // Kiểm tra nếu không tìm thấy đơn hàng
        if ($orders->isEmpty()) {
            return back()->with('error', 'Không tìm thấy đơn hàng phù hợp.');
        }

        return view('frontend.checkorder', compact('orders'));
    }

    protected function vnpay_create_payment(array $data)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_TxnRef = $data['vnp_TxnRef'];
        $vnp_OrderInfo = $data['vnp_OrderInfo'];
        $vnp_OrderType = 200000;
        $vnp_Amount = $data['vnp_Amount'] * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => self::$vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => env('APP_URL') . self::$vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        //thêm 'vnp_BankCode'
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        //thêm 'vnp_SecureHash'
        $vnp_Url = self::$vnp_Url . "?" . $query;
        if (isset(self::$vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, self::$vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = [
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        ];


        return $returnData['data'];
    }

    public function vnPayCheck(Request $request)
    {

        //Lấy data từ URL (VNPay gửi về qua $vnp_Returnurl)
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); //Mã phản hồi kết quả thanh toán
        $vnp_TxnRef = $request->get('vnp_TxnRef'); // ID đơn  hàng

        // Kiểm tra mã phản hồi
        if ($vnp_ResponseCode != null) {
            $order = Order::find($vnp_TxnRef);

            //00: TH thành công
            if ($vnp_ResponseCode == 00) {
                $this->createOrderDetail($order);
                // Tạo bản ghi thanh toán
                $payment = new Payment();
                $payment->order_id = $order->id;
                $payment->payment_method = 'bank_transfer'; // Đổi theo phương thức thanh toán
                $payment->payment_status = 'completed'; // Trạng thái thanh toán
                $payment->amount = $order->total_amount;
                $payment->save();
                DB::commit();
                Cart::destroy();
                return redirect(route('home'))->with('success', 'Thanh toán thành công!');
            } elseif ($vnp_ResponseCode == 24) { //24: Hủy thanh toán
                $order->delete();
                return redirect()->route('checkout');
            } else {
                $order->delete();
                return back()->with('error', 'Có lỗi xảy ra với VNPay');
            }
        }
    }
}



// Thẻ demo để test VNPay

// Ngân hàng: NCB
// Số thẻ: 9704198526191432198
// Tên chủ thẻ:NGUYEN VAN A
// Ngày phát hành:07/15
// Mật khẩu OTP:123456