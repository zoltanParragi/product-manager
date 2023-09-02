<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductsController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('auth');
    } */

    public function getproducts(Request $request)
    {   
        
        $products = Product::get();
        $categories = Category::get();
        return view('products')->with(compact('products', 'categories'));
    }

    public function get_product_form()
    {
        $categories = Category::get();
        return view('add-product')->with('categories', $categories);
    }


    public function add_product(Request $request) 
    {
        try {
            $validated = $request->validate([
                'name' => 'required|min:3|max:30',
                'category_id' => 'nullable|integer', 
                'description' => 'required|min:10|max:300',
                'price'=> 'required|integer',
                'image' => 'nullable|image|max:2048',
            ]);
        } catch (ValidationException $e) {
            return response(['errors'=>$e->errors()], 422);
        }

        if(array_key_exists('image', $validated)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validated["image"] = $imageName;
        } else {
            $validated["image"] = 'default.jpg';
        }
        
        Product::create($validated);

        $products = Product::get();
        return redirect('/products')->with('products', $products);
    }

    public function edit_product_form($id)
    {
        $categories = Category::get();
        $product = Product::find($id);
        return view('edit-product')->with(compact('product', 'categories'));
    }

    public function edit_product($id, Request $request) 
    {
        try {
            $validated = $request->validate([
                'name' => 'required|min:3|max:30', 
                'category_id' => 'nullable|integer', 
                'description' => 'required|min:10|max:300',
                'price'=> 'required|integer',
                'image' => 'nullable|image|max:2048',
            ]);
        } catch (ValidationException $e) {
            return response(['errors'=>$e->errors()], 422);
        }

        if(array_key_exists('image', $validated)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validated["image"] = $imageName;
            
            Product::where('id', $request->id)->update(['name' => $validated["name"], 'category_id' => $validated["category"], 'description' => $validated["description"], 'price' => $validated["price"],  'image' => $validated["image"]]);

            $products = Product::get();
            return redirect('/products')->with('products', $products);
        } else {
            Product::where('id', $request->id)->update(['name' => $validated["name"], 'category_id' => $validated["category_id"], 'description' => $validated["description"], 'price' => $validated["price"]]);

            $products = Product::get();
            return redirect('/products')->with('products', $products);
        }
    }

    public function delete_product($id, Request $request) 
    {
        Product::where('id', $id)->delete();
        $products = Product::get();
        return redirect('/products')->with('products', $products);
    }
}
