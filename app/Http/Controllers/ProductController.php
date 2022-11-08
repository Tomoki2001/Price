<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.product',compact('products'));
    }
    
    public function create()
    {
        return view('products.create');
    }
    
    public function  store(Request $request)
    {
        $request->validate([
        'name' => 'required|max:20',
        'price' => 'required|integer',
        'url' => 'required|max:100',
        'email' => 'required|max:140',
        ]);
        
        $Products = new product;
        $Products->timestamps = false;
        $Products->name=$request->input(["name"]);
        $Products->price=$request->input(["price"]);
        $Products->url=$request->input(["url"]);
        $Products->email=$request->input(["email"]);
       
        $Products->save(); 
        
        return redirect()->route('products.product');
        
    }
    
    public function edit(Product $product)
    {
        
        return view('products.edit',compact('product'));
         
    }
    public function update(Request $request, Product $product)
    {
        $request->validate([
        'name' => 'required|max:20',
        'price' => 'required|integer',
        'url' => 'required|max:100',
        'email' => 'required|max:140',
        ]);
        
       
        
        $product->timestamps = false;
        $product->name=$request->input(["name"]);
        $product->price=$request->input(["price"]);
        $product->url=$request->input(["url"]);
        $product->email=$request->input(["email"]);
       
        $product->save(); 
        
        return redirect()->route('products.product');
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.product');
        
    }
    
}
