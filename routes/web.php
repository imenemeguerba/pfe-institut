<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

Route::get('/signin', function () {
    return view('auth');
})->name('signin');

Route::get('/signup', function () {
    return view('auth');
})->name('signup');

