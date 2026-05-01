<?php

use App\Http\Controllers\Login;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Register;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::post('/logout', Logout::class)->name('logout');
});

Route::middleware("guest")->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/cadastro', 'auth.register', ['sectors' => \App\Models\Sector::all()])->name('register');
    Route::post('/login', Login::class);
    Route::post('/cadastro', Register::class);
});
