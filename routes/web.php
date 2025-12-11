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
