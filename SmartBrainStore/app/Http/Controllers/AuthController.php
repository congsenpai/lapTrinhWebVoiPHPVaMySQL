<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

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
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        try {
            // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
            $hashedPassword = Hash::make($request->password);
    
            // Tạo người dùng mới
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashedPassword, // Mã hóa mật khẩu
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
    



    // Đăng xuất// Đăng xuất
    public function logout(Request $request)
    {
        // Lấy người dùng hiện tại
        $user = Auth::user();

        if ($user) {
            // Xóa remember_token trong cơ sở dữ liệu
            $user->remember_token = null;
        }

        // Đăng xuất người dùng
        Auth::logout();

        // Hủy session và token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Xóa cookie remember_token
        Cookie::queue(Cookie::forget('remember_token'));

        // Chuyển hướng về trang đăng nhập
        return redirect()->route('login');
    }



    // Hiển thị form quên mật khẩu
    public function showForgotPassForm()
    {
        return view('auth.forgotpassword');
    }
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    
        // Kiểm tra email có tồn tại
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->with('error', 'Email không tồn tại trong hệ thống!');
        }
    
        // Tạo token reset sử dụng Hash::make() để hash email kết hợp với thời gian
        $token = Hash::make($request->email . now());
    
        // Mã hóa lại token bằng base64 để tránh các ký tự đặc biệt
        $encodedToken = base64_encode($token);  // Mã hóa token thành base64
    
        $expiresAt = now()->addMinutes(60);  // Set expiration time to 60 minutes from now
    
        // Lưu token vào bảng password_resets
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
            'expired_at' => $expiresAt,  // Thêm thời gian hết hạn
        ]);
        
        // Gửi email HTML
        Mail::send([], [], function ($message) use ($request, $encodedToken) {
            $message->to($request->email)
                ->subject('Đặt lại mật khẩu của bạn')
                ->html( // Sử dụng phương thức `html` để gửi nội dung HTML
                    '<html><body>' .
                        '<h1>Đặt lại mật khẩu của bạn</h1>' .
                        '<p>Nhấn vào nút bên dưới để đặt lại mật khẩu:</p>' .
                        '<a href="' . route('resetpassword', ['token' => $encodedToken]) . '" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Đặt lại mật khẩu</a>' .
                        '</body></html>'
                );
        });
    
        // Hiển thị thông báo
        return back()->with('success', 'Liên kết đặt lại mật khẩu đã được gửi đến email của bạn!');
    }
    public function resetPassword(Request $request)
    {
        // Validate input
        $request->validate([
            'password' => 'required|min:6|confirmed', // Ensure confirmation field is present
            'token' => 'required',
        ]);
    
        // Giải mã token trước khi so sánh
        $decodedToken = base64_decode($request->token);  // Giải mã lại token từ base64
    
        // Retrieve the password reset entry by token (đã giải mã)
        $passwordReset = DB::table('password_resets')->where('token', $decodedToken)->first();
    
        // Check if the reset token exists
        if (!$passwordReset) {
            return back()->with('error', 'Token không hợp lệ hoặc đã hết hạn!');
        }
    
        // Check if the token has expired
        $currentTime = now();
        if ($currentTime->gt(\Carbon\Carbon::parse($passwordReset->expired_at))) {
            return back()->with('error', 'Token đã hết hạn!');
        }
    
        // Find the user associated with this email
        $user = User::where('email', $passwordReset->email)->first();
    
        if ($user) {
            // Update the user's password
            $user->update(['password' => Hash::make($request->password)]);
    
            // Delete the token from the password_resets table to prevent reuse
            DB::table('password_resets')->where('token', $decodedToken)->delete();
    
            // Redirect to login page with success message
            return redirect()->route('login')->with('success', 'Mật khẩu đã được cập nhật thành công!');
        } else {
            return back()->with('error', 'Không tìm thấy người dùng.');
        }
    }
        
}
