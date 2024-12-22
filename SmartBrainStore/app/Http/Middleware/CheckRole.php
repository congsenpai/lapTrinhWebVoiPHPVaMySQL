<?php
// app/Http/Middleware/CheckRole.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // Chuyển hướng đến trang đăng nhập
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }
        $user = Auth::user();

        if ($user->role === 'staff'&& !in_array('staff', $roles)) {
            // Nếu role là staff, chuyển hướng về trang dashboard
            return redirect()->route('dashboard')->with('error', 'Bạn không có quyền truy cập vào trang này.');
        } elseif (!in_array($user->role, $roles)) {
            // Nếu không phải role hợp lệ, chuyển hướng về trang khác
            return redirect()->route('index')->with('error', 'Bạn không có quyền truy cập vào trang này.');
        }
        

        return $next($request);
    }
}
