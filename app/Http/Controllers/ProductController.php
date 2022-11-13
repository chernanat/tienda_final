<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with('category')->get();
        return $product;
    }
    public function getcategories(){
        $categories = Category::all();
        return $categories;
    }
    public function store(ProductRequest $request)
    {   
        $product = new Product($request->all());
        $image_name = null;

        if($request->hasFile('image')){
            $image_name = $this->save_image($request);
            $product->photo = $image_name;
        }
        $product->save();
        return response()->json([
            'saved'=> true,
            'product'=> $product
        ]);
    }
    public function save_image($request)
    {
        $encript = md5(Auth::id());
        $folder = '/image/products/'. $encript.'/';
        $has = Str::random(20);
        $file = $request->file('image');
        $file_name = ($has.$file->getClientOriginalName());
        $file->move(public_path($folder),$file_name);
        return ($folder.$file_name);
    }
    
    public function delete(Product $product)
    {   
        $product_cart = Cart::where('product_id',$product['id']);
        if($product_cart){
            $product_cart->delete();
        }
        $product->delete();
        return response()->json([
            'deleted'=> true,
            'product'=> $product
        ]);
    }
    public function edit(Product $product)    
    {
        return $product;
    }
    public function update(ProductRequest $request, Product $product)
    {
        $validate = false;
        if($request->hasFile('image')){
            $image = $this->save_image($request);
            $validate = true;
        }
        if($validate){
            $product->photo = $image;
        }
        if($product->update($request->all())){
            return response()->json([
                'updated'=> true,
            ], 200);
        }
        else{
            return response()->json([
                'updated'=> false,
            ], 422);
        }

    }
}
