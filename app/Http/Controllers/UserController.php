<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {   
        $categories = Category::all();
        return view('welcome', compact('categories'));
    }
    public function home()
    {   
        $product = Product::with('category')->get();
        $categories = Category::all();
        return view('home',compact('product','categories'));
    }
    public function register()
    {
        return view('register');
    }
    public function login()
    {
        return view('login');
    }
    public function store(UserRequest $request)
    {
        $person = new User($request->all());
        $person->remember_token = Str::random(80);
        $person->save();
        return response()->json([
            'saved' => true,
            'person' => $person
        ]);
    }
}