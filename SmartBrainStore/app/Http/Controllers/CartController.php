<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        // Lấy tất cả các sản phẩm trong giỏ hàng
        $cartItems = Cart::content();

        // Tính tổng giá trị của các sản phẩm trong giỏ hàng
        $subtotal = Cart::subtotal(0, '.', '');  // Sử dụng các tham số mặc định để không có phần thập phân
        // Tính chi phí vận chuyển (Giả sử là miễn phí)
        if ($subtotal > 100000) {
            $shipping = 0;
        } else {
            $shipping = 0.1 * $subtotal;
        }
        $shippingPercent = $subtotal > 0 ? ($shipping / $subtotal) * 100 : 0;

        // Tính tổng số lượng sản phẩm
        $totalItems = Cart::count();

        // Truyền tất cả các giá trị đến view
        return view('client.cart', compact('cartItems', 'subtotal', 'shipping', 'totalItems', 'shippingPercent'));
    }


    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request)
    {

        // Đặt số lượng mặc định là 1 nếu không truyền số lượng
        $qty = $request->qty ?? 1;

        // Đặt trọng lượng mặc định là 0 (hoặc 1 nếu cần thiết)
        $weight = 0;

        // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
        $existingItem = Cart::search(function ($cartItem) use ($request) {
            return $cartItem->id == $request->id; // Kiểm tra sản phẩm theo ID
        });

        $cartCount = Cart::count();

        // Nếu số lượng sản phẩm trong giỏ hàng lớn hơn 2, dừng lại
        if ($cartCount >= 2) {
            return  redirect()->route('cart.index')->with('info', 'Chỉ được thêm tối đa 2 sản phẩm vào giỏ hàng, hãy thanh toán trước!');
        }

        // Nếu sản phẩm đã có trong giỏ hàng
        if ($existingItem->isNotEmpty()) {
            return redirect()->route('product')->with('info', 'Sản phẩm này đã được thêm vào giỏ hàng!');
        }

        // Thêm sản phẩm vào giỏ hàng
        Cart::add(
            $request->id,       // id của sản phẩm
            $request->name,     // tên sản phẩm
            $qty,               // số lượng, mặc định là 1
            $request->price,    // giá sản phẩm
            $weight,            // trọng lượng sản phẩm (đặt mặc định là 0)
            ['image' => $request->image]  // tùy chọn khác (như ảnh)
        );
        // Điều hướng đến trang giỏ hàng với thông báo thành công
        return redirect()->route('product')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }


    // Cập nhật số lượng sản phẩm

public function update(Request $request, $rowId)
{
    $validated = $request->validate([
        'qty' => 'required|integer|min:1|max:20',
    ]);

    // Update the quantity in the cart
    Cart::update($rowId, $validated['qty']);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Quantity updated successfully.');
}

public function updateAll(Request $request)
{
    $validated = $request->validate([
        'quantities' => 'required|array',
        'quantities.*' => 'required|integer|min:1|max:20',
    ]);

    foreach ($validated['quantities'] as $rowId => $qty) {
        Cart::update($rowId, $qty);
    }

    return redirect()->route('cart.index')->with('success', 'Cập nhật số lượng toàn bộ giỏ hàng thành công.');
}

    
    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($rowId)
    {
        Cart::remove($rowId); // Xóa sản phẩm dựa trên Row ID
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa!');
    }

    // Xóa toàn bộ giỏ hàng
    public function clear()
    {
        Cart::destroy(); // Xóa toàn bộ giỏ hàng
        return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được làm trống!');
    }
}
