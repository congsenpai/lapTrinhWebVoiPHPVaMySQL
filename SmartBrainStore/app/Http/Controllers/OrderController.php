<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{

    public function showAdminOrderForm()
    {
        return view('admin.order.order');
    }
    public function checkOrderForm()
    {
        return view('client.order.check');
    }
    public function checkOrder(Request $request)
    {
        // Validate đầu vào
        $validated = $request->validate([
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
        ]);

        // Kiểm tra điều kiện đầu vào
        if (empty($validated['email']) && empty($validated['phone'])) {
            return redirect()->back()->withErrors([
                'error' => 'Bạn phải cung cấp ít nhất một trong hai thông tin: email hoặc số điện thoại.',
            ]);
        }

        // Tìm người dùng dựa trên email hoặc phone
        $userQuery = User::query();

        if (!empty($validated['email'])) {
            $userQuery->where('email', $validated['email']);
        }

        if (!empty($validated['phone'])) {
            $userQuery->where('phone', $validated['phone']);
        }

        $user = $userQuery->first();

        // Nếu không tìm thấy người dùng, trả về null
        if (!$user) {
            return view('client.order.checkorder', ['orders' => null])
                ->with(['error' => 'Không tìm thấy người dùng với thông tin đã cung cấp.']);
        }

        // Tìm tất cả đơn hàng dựa trên user_id
        $orders = Order::where('user_id', $user->id)->paginate(10);  // Sử dụng phân trang


        // Nếu không có đơn hàng nào, trả về thông báo
        if ($orders->isEmpty()) {
            return view('client.order.checkorder', ['orders' => null])
                ->with(['error' => 'Không có đơn hàng nào được tìm thấy.']);
        }

        // Trả về view với danh sách đơn hàng
        return view('client.order.checkorder', ['orders' => $orders]);
    }
    // controller cho admin
    public function index(Request $request)
    {
        $search = $request->get('s', ''); // Lấy từ query string tham số tìm kiếm

        // Truy vấn đơn hàng và thêm điều kiện tìm kiếm nếu có
        $orders = Order::with('user', 'payment') // Eager loading để giảm số lần query
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                    ->orWhere('status', 'like', "%{$search}%");
            })
            ->paginate(10); // Phân trang với 10 kết quả mỗi trang

        // Trả về dữ liệu dưới dạng JSON nếu là yêu cầu AJAX
        if ($request->ajax()) {
            $html = view('partials.order', compact('orders'))->render();
            return response()->json(['html' => $html]);
        }

        return view('admin.order.order', compact('orders'));
    }




    public function showDetailOrder($orderId)
    {
        // Lấy đơn hàng theo ID và load các quan hệ (relationships) liên quan
        $order = Order::with(['user', 'coupon', 'orderItems', 'payment'])->findOrFail($orderId);

        // Trả về view với dữ liệu đơn hàng
        return view('admin.order.detail', compact('order'));
    }

    public function updateStatus(Request $request)
    {
        $order = Order::find($request->order_id);

        if (!$order) {
            return redirect(route('adminorder.index'))->with('error', 'Không tìm thấy đơn hàng.');
        }

        if ($request->status == 'complete') {
            $order->status = 'completed';
        } elseif ($request->status == 'cancel') {
            $order->status = 'cancelled';
        }

        $order->save();

        return redirect(route('adminorder.index'))->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }
}
