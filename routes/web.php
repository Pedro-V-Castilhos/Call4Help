<?php

use App\Http\Controllers\CallController;
use App\Http\Controllers\Login;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Register;
use App\Http\Controllers\SectorController;
use App\Models\Sector;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    Route::get('/', [CallController::class, 'index'])->name('home');
    Route::post('/logout', Logout::class)->name('logout');
    Route::post('/sector', [SectorController::class, 'store'])->name('sector');
    Route::delete('/sector/{sector}', [SectorController::class,'destroy'])->name('deleteSector');
    Route::post('/call', [CallController::class, 'store'])->name('call');
    Route::get('/call/{id}', [CallController::class, 'show'])->name('callDetails');
    Route::get('/calls/{call}/download', [CallController::class, 'download'])->name('calls.download');
});

Route::middleware("guest")->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::get('/cadastro', Register::class)->name('register');
    Route::post('/login', Login::class);
    Route::post('/cadastro', Register::class);
});


