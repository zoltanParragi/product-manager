<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    function get_category() {
        return Category::get();
    }

    function get_category_products($id, $referer, Request $request) {
        $products = Category::find($id)->get_products;
        $categories = Category::get();

        if($referer == "welcome"){
            return view('welcome')->with(compact('products', 'categories'));
        }

        return view('products')->with(compact('products', 'categories'));
    }
}
