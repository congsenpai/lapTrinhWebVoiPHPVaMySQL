<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function ShowAdminBrandForm(){
        return view('admin.brand.brand');
    }
}
