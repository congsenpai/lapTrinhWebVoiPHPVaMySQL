<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,  // Tạo tên ngẫu nhiên
            'email' => $this->faker->unique()->safeEmail,  // Email duy nhất
            'password' => bcrypt('password123'),  // Mã hóa mật khẩu
            'phone' => $this->faker->phoneNumber,  // Số điện thoại ngẫu nhiên
            'address' => $this->faker->address,  // Địa chỉ ngẫu nhiên
            'role' => $this->faker->randomElement(['customer', 'admin', 'staff']),  // Vai trò ngẫu nhiên
            'created_at' => now(),  // Thời gian tạo
            'updated_at' => now(),  // Thời gian cập nhật
        ];
    }
}
