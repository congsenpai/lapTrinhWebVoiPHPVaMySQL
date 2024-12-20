<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class CustomerController extends Controller
{
    public function showAdminCustomerForm(Request $request)
    {
        // Tìm kiếm dựa trên tên, email hoặc số điện thoại
        $data = User::query();
        $data->where('role', 'customer');
        if (isset($request->searchkey) && $request->input('searchkey') != "") {
            $data = User::where('role', 'customer')
                ->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', "%{$request->input('searchkey')}%")
                        ->orWhere('email', 'LIKE', "%{$request->input('searchkey')}%")
                        ->orWhere('phone', 'LIKE', "%{$request->input('searchkey')}%");
                });
        }
        
        // // Phân trang
        $customers = $data->paginate(9); // 9 sản phẩm mỗi trang
        // Kiểm tra nếu là AJAX request
        if ($request->ajax()) {
            // Render HTML cho các sản phẩm và phân trang
            $customersHtml = view('partials.customer', compact('customers'))->render();
            $paginationHtml = view('partials.pagination', compact('customers'))->render();

            return response()->json([
                'admincustomer' => $customersHtml,
                'pagination' => $paginationHtml
            ]);
        }
        return view('admin.customer.customer', compact('customers'));
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
        $customers = User::create($request->only(['name', 'email', 'password', 'phone', 'address', 'role', 'created_at'])); // Thêm 'category_id' vào mảng

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
        return redirect()->route('admincustomer')->with('addsuccess', 'Tài khoản khách hàng đã được tạo!');
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
        return redirect()->route('admincustomer')->with('updatesuccess', 'Khách hàng đã được sửa!');
    }

    public function delete($email)
    {
        User::where('email', $email)->update(['status' => 'inactive']);
        return redirect()->route('admincustomer')->with('deletesuccess', 'Khách hàng đã được xóa!');
    }

    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $searchkey = $request->input('query');

        // Tìm kiếm dựa trên tên, email hoặc số điện thoại
        $customers = User::where('role', 'customer')
            ->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', $request->input('query'))
                    ->orWhere('email', 'LIKE', $request->input('query'))
                    ->orWhere('phone', 'LIKE', $request->input('query'));
            })
            ->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json($customers);
    }
}
