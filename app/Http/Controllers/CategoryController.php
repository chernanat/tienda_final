<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        // return $cities;
        return $categories;
    }
    
    public function store(CategoryRequest $request)
    {
        $category = new Category($request->all());
        $category->save();
        return response()->json([
            'saved'=> true,
            'category'=> $category
        ]);
    }
    public function delete(Category $category)
    {
        $products = Product::with('category')->where('category_id',$category->id)->get();
        // return $products[0]['id'];
        $cart = Cart::where('product_id',8)->get();
        // return $cart;
        foreach($products as $product){
            return $product['id'];
            // $product->delete();
        }
        $category->delete();
        return response()->json([
            'deleted'=> true,
            'category'=> $category
        ]);
    }
    public function edit(Category $category)    
    {
        return $category;
    }
    public function update(CategoryRequest $request, Category $category)
    {
        if($category->update($request->all())){
            return response()->json([
                'updated'=> true
            ]);
        }else{
            return response()->json([
                'updated'=> false,
                'message'=> 'Category cannot be empty!'
            ], 422);
        }
    }
}
