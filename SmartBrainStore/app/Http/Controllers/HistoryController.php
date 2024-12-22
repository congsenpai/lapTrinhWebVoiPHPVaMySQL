<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class HistoryController extends Controller
{
    public function showDetail($id)
    {
        // Lấy người dùng hiện tại
        if (!Auth::check()) {
            // Nếu người dùng chưa đăng nhập
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem chi tiết đơn hàng');
        }
        $userid = Auth::user()->id;
        $user = User::find($userid);

        // Tìm đơn hàng theo ID và kiểm tra xem nó có thuộc về người dùng hiện tại không
        $order = Order::where('id', $id)->where('user_id', $user->id)->first();

        if (!$order) {
            // Nếu không tìm thấy đơn hàng hoặc đơn hàng không thuộc về người dùng hiện tại
            return redirect()->route('order.history')->with('error', 'Bạn không có quyền truy cập vào đơn hàng này.');
        }

        // Trả về chi tiết đơn hàng nếu tìm thấy
        return view('client.order.order-detail', compact('order'));
    }

    public function index()
    {

        if (Auth::check()) { // Tìm thông tin người dùng
            $userId = Auth::user()->id; // Lấy ID của người dùng hiện tại
            $user = User::find($userId);
            $orders = $user->orders()->with(['orderItems', 'coupon', 'payment'])->paginate(10); // Số lượng mỗi trang là 10 đơn hàng
            // Tải trước các mối quan hệ
            return view('client.order.order-history', compact('orders'));
        } else {
            // Xử lý nếu người dùng chưa đăng nhập
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem lịch sử đơn hàng');
        }
    }
}
