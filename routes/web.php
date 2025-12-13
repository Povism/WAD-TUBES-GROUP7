<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;


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
//Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');

Route::middleware(['auth', 'role:student'])->group(function () {
Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
Route::get('/forum/{forum}/edit', [ForumController::class, 'edit'])->name('forum.edit');
Route::put('/forum/{forum}', [ForumController::class, 'update'])->name('forum.update');
Route::delete('/forum/{forum}', [ForumController::class, 'destroy'])->name('forum.destroy');

//Comment Reply
Route::post('/forum/{forum}/comments', [CommentController::class, 'store'])->name('comment.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

Route::get('/forum/{forum}', [ForumController::class, 'show'])->name('forum.show');

// Item Listing

Route::get('/items', function () { return view('items.index' ); });
Route::get('/items/create', function () { return view('items.create' ); });
Route::get('/items/{item}', function ($id) { return view('items.show' ); });
Route::put('/items/{item}', function ($id) { return view('items.update' ); });


// Profile

Route::get('profile', function () { return view('profile.dashboard' ) ;});
Route::get('profile/reviews', function () { return view('profile.reviews' ) ;});

