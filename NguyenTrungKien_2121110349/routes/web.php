<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\CartController;

Route::get('/',[HomeController::class,'index'])->name('site.home');
Route::get('/san-pham',[ProductController::class,'index']);
Route::get('/chi-tiet-san-pham/{slug}',[ProductController::class,'product_detail']);
Route::get('/lien-he',[ContactController::class,'index'])->name('site.contact');
Route::get('/gio-hang',[CartController::class,'index']);
