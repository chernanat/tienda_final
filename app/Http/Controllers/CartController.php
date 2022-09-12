<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        return view('checkout');
    }
    public function getitems(Request $request){
        $id = $request->id;     
        $carrito = Cart::with('product')->where('user_id',$id)->get();
        return $carrito;
    }   
    public function store(Request $request)
    {
        if(!$request->product_id){
            return response()->json([
                'message'=> 'product sent',
            ]);
        }
        $product = Product::find($request->product_id);
        $validate = Cart::where('product_id',$request->product_id)->pluck('id');
        // $usuario =$request;
        // return $validate;
        if($validate->isEmpty()){
            $cart = Cart::Create([
                'quantity'=>1,
                'price'=>$product->price,
                'user_id'=>$request->user_id,
                'product_id'=>$request->product_id
            ]);
        }
        else{
        $cart = Cart::where('product_id',$request->product_id)->increment('quantity');
        }
        if($cart){
            return response()->json([
                'Saved' => true
            ]);
        }
    }
    public function delete($id)
    {
        // return $id;
        $cart = Cart::find($id);
        $cart->delete();
        return response()->json([
            'deleted'=> true,
        ]);
    }
    public function update(Request $request){
        foreach($request->all() as $prueba){
            $item = Cart::find($prueba['id']);
            $item->quantity = $prueba['quantity'];
            $item->update();
        }
        return response()->json([
            'updated'=>true
        ]);
    }
}
