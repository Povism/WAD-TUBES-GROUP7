<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Models\Item;
use App\Models\User;


// fix the routes according to ur features these are just here for testing

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Home
Route::get('/', function () {
    $featuredItems = Item::query()
        ->where('status', 'active')
        ->latest()
        ->take(8)
        ->get();

    $itemsExchanged = Item::query()->count();
    $studentsEngaged = User::query()->count();
    $wastePreventedKg = $itemsExchanged;

    return view('home', compact('featuredItems', 'itemsExchanged', 'studentsEngaged', 'wastePreventedKg'));
})->name('home');
    
// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        $totalUsers = User::query()->count();
        $activeListings = Item::query()->where('status', 'active')->count();
        $categoryCount = Item::query()->whereNotNull('category')->distinct('category')->count('category');

        $recentListings = Item::query()
            ->with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.index', compact('totalUsers', 'activeListings', 'categoryCount', 'recentListings'));
    })->name('index');
    Route::get('/category', function () { return view('admin.category.index'); })->name('category.index');

    Route::get('/items', [AdminItemController::class, 'index'])->name('items.index');
    Route::get('/items/{item}/edit', [AdminItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [AdminItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [AdminItemController::class, 'destroy'])->name('items.destroy');
});
// Cart

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{item}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/items/{cartItem}/delta', [CartController::class, 'delta'])->name('cart.items.delta');
    Route::delete('/cart/items/{cartItem}', [CartController::class, 'remove'])->name('cart.items.remove');
});

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

Route::get('/items', [ItemController::class, 'index'])->name('items.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
});

Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');


// Profile

Route::get('profile', function () { return view('profile.dashboard' ) ;});
Route::get('profile/reviews', function () { return view('profile.reviews' ) ;});

