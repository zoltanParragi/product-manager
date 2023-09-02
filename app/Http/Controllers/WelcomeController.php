<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class WelcomeController extends Controller
{

    /* public function __construct()
    {
        $this->middleware('auth');
    } */
    
    public function index(Request $request)
    {
        $products = Product::get();
        $categories = Category::get();
        return view('welcome')->with(compact('products', 'categories'));
    }
}
