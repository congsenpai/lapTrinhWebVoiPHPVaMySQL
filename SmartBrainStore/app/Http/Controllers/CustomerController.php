<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function showAdminCustomerForm(){
        return view('admin.customer.customer');
    }
}
