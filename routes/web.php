<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/products', [MainController::class, 'products'])->name('products.index');
Route::get('/products/{slug}', [MainController::class, 'productDetail'])->name('products.show');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/posts', [MainController::class, 'posts'])->name('posts.index');
Route::get('/posts/{slug}', [MainController::class, 'postDetail'])->name('posts.show');

Route::get('/sitemap.xml', [MainController::class, 'sitemap'])->name('sitemap');

// Cart Routes
use App\Http\Controllers\CartController;
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Language Switcher Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['applocale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

// Cerdas: Fallback router untuk mem-bypass pemblokiran Hostinger pada folder storage
Route::get('/storage/{path}', function (string $path) {
    $fullPath = storage_path('app/public/' . $path);
    
    if (!file_exists($fullPath)) {
        abort(404);
    }
    
    $mimeType = \Illuminate\Support\Facades\File::mimeType($fullPath);
    return response()->file($fullPath, [
        'Content-Type' => $mimeType,
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*');
