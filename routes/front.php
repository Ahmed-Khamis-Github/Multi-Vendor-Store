<?php

use App\Http\Controllers\Front\Auth\TwoFactorAuthController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use Illuminate\Support\Facades\Route ;

Route::get('/',[HomeController::class,'index'])->name('home') ;

Route::get('/products',[ProductsController::class,'index'])->name('products.index') ;
Route::get('/products/{product:slug}',[ProductsController::class,'show'])->name('products.show') ;

Route::resource('/cart',CartController::class) ;


Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'store']);


Route::get('auth/user/2fa',[TwoFactorAuthController::class,'index'] ) ;


Route::post('currency', [CurrencyConverterController::class, 'store'])
->name('currency.store');
