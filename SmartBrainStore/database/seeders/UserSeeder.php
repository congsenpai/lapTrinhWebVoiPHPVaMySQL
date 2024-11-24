<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123'), // Mã hóa mật khẩu
            'phone' => '1234567890',
            'address' => '123 Street, City, Country',
            'role' => 'admin',  // Vai trò có thể là customer, admin, staff
        ]);
        // Tạo 10 người dùng giả lập
        User::factory(10)->create();
    }
}
