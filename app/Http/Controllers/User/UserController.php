<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class UserController extends Controller
{
    // user home page
    public function home()
    {
        $pizza = Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        return view('user.main.home', compact('pizza', 'category'));
    }
}
