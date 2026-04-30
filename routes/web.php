<?php

use App\Http\Controllers\Login;
use App\Http\Controllers\Logout;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::post('/logout', Logout::class)->name('logout');
});

Route::middleware("guest")->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', Login::class);
});
