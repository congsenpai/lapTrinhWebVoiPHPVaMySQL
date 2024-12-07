<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showAdminStaffForm(Request $request)
    {
        // $categories = Category::all();
        // $brands = Brand::all();
        // $brands = Brand::all(); // Lấy danh sách thương hiệu
        // // Lấy danh mục từ database
        // $categories = Category::all();
        // // Xây dựng query nhân viên
        $query = User::query();
        $query->where('role', 'staff');
        // // Tìm kiếm theo tên sản phẩm
        // if ($request->has('s') && $request->s !== '') {
        //     $query->where('name', 'like', '%' . $request->s . '%');
        // }
        // // Lọc theo loại sản phẩm
        // if ($request->has('category') && $request->brand != 'all') {
        //     $query->where('category_id', $request->category);
        // }
        // // Lọc theo thương hiệu
        // if ($request->has('brand') && $request->brand != 'all') {
        //     $query->where('brand_id', $request->brand);
        // }
        // // Phân trang

        $staffs = $query->paginate(9); // 9 sản phẩm mỗi trang

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
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'price' => 'required|numeric|min:0',
        //     'stock' => 'required|integer|min:0',
        //     'category_id' => 'required|exists:categories,id', // Kiểm tra category_id có tồn tại trong bảng categories
        //     'brand_id' => 'required|exists:brands,id', // Kiểm tra brand_id có tồn tại trong bảng categories
        //     'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        // ]);

        // Lưu thông tin sản phẩm
        $staff = User::create($request->only(['name', 'email', 'password', 'phone', 'address', 'role', 'created_at'])); // Thêm 'category_id' vào mảng

        // Lưu hình ảnh nếu có
        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $key => $imageFile) {
        //         // Tạo tên file mới để tránh trùng lặp
        //         $newFileName = uniqid() . '_' . time() . '.' . $imageFile->getClientOriginalExtension();

        //         // Lưu file vào thư mục 'products' trong 'storage/app/public'
        //         $path = $imageFile->storeAs('products', $newFileName, 'public');

        //         // Lưu thông tin hình ảnh vào bảng 'images'
        //         Image::create([
        //             'product_id' => $product->id,
        //             'image_url' => $path,
        //             'is_primary' => $key === 0, // Ảnh đầu tiên là ảnh chính
        //         ]);
        //     }
        // }
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
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'price' => 'required|numeric|min:0',
        //     'stock' => 'required|integer|min:0',
        //     'category_id' => 'required|exists:categories,id', // Kiểm tra category_id có tồn tại trong bảng categories
        //     'brand_id' => 'required|exists:brands,id', // Kiểm tra brand_id có tồn tại trong bảng categories
        //     'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        // ]);
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
}
