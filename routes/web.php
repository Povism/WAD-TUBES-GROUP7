<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


// fix the routes according to ur features these are just here for testing

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Home
Route::get('/', function () { return view('home'); });
    
// Admin
Route::get('/admin', function () { return view('admin.index'); });
Route::get('/admin/items', function () { return view('admin.items.index'); });
Route::get('/admin/category', function () { return view('admin.category.index'); });

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

});
// Cart

Route::get('/cart', function () { return view('cart.checkout'); });

// Forum

Route::get('/forum', function () { return view('forum.index'); });
Route::get('/forum/create', function () { return view('forum.create'); });
Route::post('/forum/{forum}', function () { return view('forum.store'); });
Route::get('/forum/{forum}', function ($id) { return view('forum.show' ); });
Route::put('/forum/{forum}', function () { return view('forum.update'); });

// Item Listing

Route::get('/items', function () { return view('items.index' ); });
Route::get('/items/create', function () { return view('items.create' ); });
Route::get('/items/{item}', function ($id) { return view('items.show' ); });
Route::put('/items/{item}', function ($id) { return view('items.update' ); });


// Profile

Route::get('profile', function () { return view('profile.dashboard' ) ;});
Route::get('profile/reviews', function () { return view('profile.reviews' ) ;});










