<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/forum', function () {
    return view('forum.index');
});

Route::get('/items', function () {
    return view('items.index');
});

Route::get('/cart', function () {
    return view('cart.checkout');
});

Route::get('/profile', function () {
    return view('profile.dashboard');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});