<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showAdminCategoryForm(){
        return view('admin.category.category');
    }
}
