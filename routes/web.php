<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuatesController;
use App\Http\Controllers\HistorysearchController;

// Akses halaman utama
Route::get('/', function () {
    if (!session('isLoggedIn')) {
        return redirect()->route('authes');
    }
    return view('appes.artikeles');
});

// AUTH ROUTES (gabung login & register jadi satu)
Route::get('/authes', [AuthController::class, 'showAuthPage'])->name('authes'); 
Route::post('/login', [AuthController::class, 'login'])->name('login.action');
Route::post('/register', [AuthController::class, 'register'])->name('register.action');
Route::post('/captcha', [AuthController::class, 'verifcapt'])->name('captcha.action');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/artikeles', [AuthController::class, 'showMain'])->name('appes.artikeles');
Route::get('/searches', [HistorysearchController::class, 'index'])->name('appes.searches');
Route::post('/searches', [HistorysearchController::class, 'Search'])->name('histories');
Route::get('/buates', [BuatesController::class, 'buat'])->name('appes.buates');
Route::post('/buates/simpan', [BuatesController::class, 'simpan'])->name('appes.buates.simpan');
