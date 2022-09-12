<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials, true)) {
            return response()->json([
                'loged' => true,
                'user' => User::select(['name', 'email', 'id'])->whereId(Auth::id())->first()
            ], 200);
        } else {
            return response()->json([
                'loged' => false,
                'errors' => 'Email or Password are Incorrect'
            ], 422);
        }
    }
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'logout' => true
        ]);
    }
    // public function pruebas()
    // {
    //     $usuarios = Cart::where('user_id',1)->count();
    //     return $usuarios;
    // }
}
