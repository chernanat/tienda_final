<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/pruebas', function () {
//     return view('welcome');
// });


Route::group(['prefix'=>'/sign','controller'=>\App\Http\Controllers\LoginController::class],function(){
    Route::name('')->group(function(){
        Route::get('/','index')->name('');
        Route::get('/register','register')->name('');
        Route::post('/login','login')->name('');
        Route::post('/logout','logout')->name('');
        // Route::get('/pruebas','pruebas')->name('');
    });
});

Route::group(['prefix'=>'','controller'=>\App\Http\Controllers\UserController::class],function(){
    Route::name('')->group(function(){
        Route::get('/home','home')->name('');
        Route::get('/config','index')->name('');
        Route::get('/register','register')->name('');
        Route::get('/login','login')->name('');
        Route::post('/save','store')->name('person.store');
        Route::post('/edit/{person}','update')->name('person.update');
        Route::get('/edit/{person}','edit')->name('person.edit');
        Route::get('/delete/{person}','delete')->name('person.delete');
    });
});

Route::group(['prefix'=>'/category','controller'=>\App\Http\Controllers\CategoryController::class],function(){
    Route::name('')->group(function(){
        Route::get('/','index')->name('');
        Route::post('/save','store')->name('');
        Route::post('/edit/{category}','update')->name('');
        Route::get('/edit/{category}','edit')->name('');
        Route::get('/delete/{category}','delete')->name('');
    });
});

Route::group(['prefix'=>'/product','controller'=>\App\Http\Controllers\ProductController::class],function(){
    Route::name('')->group(function(){
        Route::get('/','index')->name('');
        Route::get('/categories','getcategories')->name('');
        Route::post('/save','store')->name('');
        Route::post('/edit/{product}','update')->name('');
        Route::get('/edit/{product}','edit')->name('');
        Route::get('/delete/{product}','delete')->name('');
    });
});

Route::group(['prefix'=>'/cart','controller'=>\App\Http\Controllers\CartController::class],function(){
    Route::name('')->group(function(){
        Route::get('/checkout','index')->name('');
        Route::post('/items','getitems')->name('');
        Route::post('/save','store')->name('');
        Route::post('/update','update')->name('');
        Route::get('/edit/{id}','edit')->name('');
        Route::get('/delete/{id}','delete')->name('');
    });
});
