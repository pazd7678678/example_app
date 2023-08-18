<?php

use App\Http\Controllers\Admin\DiscountPlansController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminProductGalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('admin.index');
});





Route::resource('users',UserController::class);
Route::resource('products',ProductController::class)->except(['show']);

Route::resource('products.gallery',ProductGalleryController::class);

Route::resource('discountplans',DiscountPlansController::class);