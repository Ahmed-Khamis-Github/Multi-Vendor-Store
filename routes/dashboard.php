<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin'])->prefix('admin/dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('profile',[ProfileController::class,'edit'])->name('profile.edit') ;
    Route::put('profile',[ProfileController::class,'update'])->name('profile.update') ;


    Route::get('/categories/trash',[CategoryController::class,'showTrash'])->name('categories.trash') ;
    Route::put('categories/trash/{category}',[CategoryController::class,'restoreTrash'])->name('categories.trash.restore') ;
    Route::Delete('categories/trash/{category}',[CategoryController::class,'deleteTrash'])->name('categories.trash.delete') ;

    Route::resource('categories', CategoryController::class);


    Route::get('/products/trash',[ProductController::class,'showTrash'])->name('products.trash') ;
    Route::put('products/trash/{product}',[ProductController::class,'restoreTrash'])->name('products.trash.restore') ;
    Route::Delete('products/trash/{product}',[ProductController::class,'deleteTrash'])->name('products.trash.delete') ;

    Route::resource('products', ProductController::class);

});
