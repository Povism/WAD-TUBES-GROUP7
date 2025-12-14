<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminOrderController;


// fix the routes according to ur features these are just here for testing

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Home
Route::get('/', function () { return view('home'); })->name('home');
    
// Admin
Route::get('/admin', function () { return view('admin.index'); });
Route::get('/admin/items', function () { return view('admin.items.index'); });
Route::get('/admin/category', function () { return view('admin.category.index'); });

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Admin Order Management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::put('/orders/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
});
// Cart
Route::middleware('auth')->group(function () {
    Route::get('/cart', function () { return view('cart.checkout'); })->name('cart.checkout');
});

// Forum

Route::get('/forum', function () { return view('forum.index'); });
Route::get('/forum/create', function () { return view('forum.create'); });
Route::post('/forum/{forum}', function () { return view('forum.store'); });
Route::get('/forum/{forum}', function ($id) { return view('forum.show' ); });
Route::put('/forum/{forum}', function () { return view('forum.update'); });

// Item Listing

Route::get('/items', function () { return view('items.index' ); })->name('items.index');
Route::get('/items/create', function () { return view('items.create' ); });
Route::get('/items/{item}', function ($id) { return view('items.show' ); });
Route::put('/items/{item}', function ($id) { return view('items.update' ); });


// Profile

Route::get('profile', function () { return view('profile.dashboard' ) ;});
Route::get('profile/reviews', function () { return view('profile.reviews' ) ;});

// Orders (User)
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});










