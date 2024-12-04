<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showAdminStaffForm(Request $request){
        return view('admin.staff.staff');
    }
}
