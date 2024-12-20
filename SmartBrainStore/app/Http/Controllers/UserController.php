<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showAdminStaffForm(Request $request)
    {

        $data = User::query();
        $data->where('role', 'staff')->where('status', 'active');
        if (isset($request->searchkey) && $request->input('searchkey') != "") {
            $data = User::where('role', 'staff')
                ->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', "%{$request->input('searchkey')}%")
                        ->orWhere('email', 'LIKE', "%{$request->input('searchkey')}%")
                        ->orWhere('phone', 'LIKE', "%{$request->input('searchkey')}%");
                });
        }

        $staffs = $data->paginate(9); // 9 sản phẩm mỗi trang

        // Kiểm tra nếu là AJAX request
        if ($request->ajax()) {
            // Render HTML cho các sản phẩm và phân trang
            $staffsHtml = view('partials.staffs', compact('staffs'))->render();
            $paginationHtml = view('partials.pagination', compact('staffs'))->render();

            return response()->json([
                'adminstaff' => $staffsHtml,
                'pagination' => $paginationHtml
            ]);
        }
        return view('admin.staff.staff', compact('staffs'));
    }

    public function store(Request $request)
    {
        // Lưu thông tin 
        $staff = User::create($request->only(['name', 'email', 'password', 'phone', 'address', 'role', 'created_at'])); // Thêm 'category_id' vào mảng


        //Mã hóa mật khẩu
        $email = $request->input('email');
        $data = $request->only(['name', 'email', 'phone', 'address', 'role']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        User::where('email', $email)->update($data);
        return redirect()->route('adminstaff')->with('addsuccess', 'Nhân viên đã được tạo!');
    }

    //Update function
    public function update(Request $request)
    {
     
        $email = $request->input('email');
        User::where('email', $email)->update($request->only(['name', 'email', 'password', 'phone', 'address', 'role']));
        //Mã hóa mật khẩu
        $data = $request->only(['name', 'email', 'phone', 'address', 'role']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        User::where('email', $email)->update($data);
        return redirect()->route('adminstaff')->with('updatesuccess', 'Nhân viên đã được sửa!');
    }

    public function delete($email)
    {
        User::where('email', $email)->update(['status' => 'inactive']);
        return redirect()->route('adminstaff')->with('deletesuccess', 'Nhân viên đã được xóa!');
    }
    public function showAccountForm()
    {
        return view('client.updateaccount');
    }
    public function updateCustomer(Request $request)
    {
        $email = $request->input('email');
        User::where('email', $email)->update($request->only(['name', 'email', 'phone', 'address']));
        //Mã hóa mật khẩu
        $data = $request->only(['name', 'email', 'phone', 'address']);
        User::where('email', $email)->update($data);
        return redirect(route('home'))->with('success', 'Thông tin tài khoản đã được thay đổi!');
    }
}
