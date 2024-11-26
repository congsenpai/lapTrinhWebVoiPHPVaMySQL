<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Validate request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Đăng nhập với "Remember Me" nếu có
        $remember = $request->has('remember'); // Kiểm tra nếu người dùng chọn "Remember Me"

        if (Auth::attempt($credentials, $remember)) {
            // Đăng nhập thành công
            return redirect()->intended(route('home')); // Redirect người dùng tới trang họ muốn
        }

        // Nếu đăng nhập không thành công
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    // hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    // xử lý logic đăng ký
    public function registerUser(Request $request)
    {
        // Validate thông tin đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // đảm bảo mật khẩu được xác nhận
        ]);

        try {

            // Tạo người dùng mới
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password, // Laravel tự động mã hóa mật khẩu
            ]);

            // Đăng nhập người dùng sau khi tạo tài khoản
            Auth::login($user);

            // Flash thông báo thành công
            session()->flash('success', 'Đăng ký thành công!');
            return redirect()->route('home');
        } catch (\Exception $e) {
            // Flash thông báo lỗi
            session()->flash('error', 'Đã xảy ra lỗi, vui lòng thử lại sau.');
            return back();
        }
    }



    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
