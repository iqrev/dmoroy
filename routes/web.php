<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/products', [MainController::class, 'products'])->name('products.index');
Route::get('/products/{slug}', [MainController::class, 'productDetail'])->name('products.show');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::get('/posts', [MainController::class, 'posts'])->name('posts.index');
Route::get('/posts/{slug}', [MainController::class, 'postDetail'])->name('posts.show');
