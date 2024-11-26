<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use HasFactory;

    // Chỉ định bảng mà model này sẽ tương tác
    protected $table = 'users';

    // Các thuộc tính có thể gán mass-assignment
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
    protected $hidden = [
        'password',
    ];
}
