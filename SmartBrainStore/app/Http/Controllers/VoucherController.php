<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function showAdminVoucherForm(){
        return view('admin.voucher.voucher');
    }
}
