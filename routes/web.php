<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CimilkController;
use App\Http\Controllers\SapiController;

// Rute Halaman Utama
Route::get('/', function () {
    return view('index');
});

// Rute Login & Register
Route::get('login', [CimilkController::class, 'showLogin'])->name('login');
Route::post('login', [CimilkController::class, 'login'])->name('login.post');
Route::get('register', [CimilkController::class, 'showRegister'])->name('register');
Route::post('register', [CimilkController::class, 'register'])->name('register.post');

Route::get('/biodata-sapi', [SapiController::class, 'index'])->name('sapi.index');

// Rute Dashboard (Hanya bisa diakses kalau sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard-admin', function () { return view('dashboardAdmin'); })->name('admin.dashboard');
    Route::get('/dashboard-peternak', function () { return view('dashboardPeternak'); })->name('peternak.dashboard');
    Route::get('/dashboard-penjualan', function () { return view('dashboardPenjualan'); })->name('penjualan.dashboard');

    Route::post('logout', [CimilkController::class, 'logout'])->name('logout');
});
