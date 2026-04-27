<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/',[ProductController::class,'index'])->name('home');
Route::get('/products/{product:slug}',[ProductController::class,'show'])->name('products.show');

Route::middleware('auth')->group(function()
{
    Route::get('/cart',[CartController::class,'index'])->name('cart.index');
    Route::post('/cart/{product}',[CartController::class,'add'])->name('cart.add');
    Route::patch('/cart{cart}',[CartController::class,'update'])->name('cart.update');
    Route::delete('/cart/{cart}',[CartController::class,'remove'])->name('cart.remove');

    Route::get('/checkout',[OrderController::class,'checkout'])->name('checkout');
    Route::post('/orders',[OrderController::class,'store'])->name('orders.store');
    Route::get('/orders/{order}',[OrderController::class,'show'])->name('orders.show');
    Route::get('/my-orders',[OrderController::class,'history'])->name('orders.history');
});

use App\Http\Controllers\AuthController;
Route::middleware('guest')->group(function()
{
    Route::get('/register',[AuthController::class,'showRegister'])->name('register');
    Route::post('/register',[AuthController::class,'register']);
    Route::get('/login',[AuthController::class,'showLogin'])->name('login');
    Route::post('/login',[AuthController::class,'login']);
});
Route::middleware('auth')->post('/logout',[AuthController::class,'logout'])->name('logout');
