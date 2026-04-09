<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CimilkController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// --- GROUP ROUTE GUEST (Hanya bisa diakses sebelum login) ---
Route::middleware('guest')->group(function () {
    // Login
    Route::get('Cimilk/login', [CimilkController::class, 'showLogin'])->name('login');
    Route::post('Cimilk/login', [CimilkController::class, 'login'])->name('login.post');

    // Register
    Route::get('Cimilk/register', [CimilkController::class, 'showRegister'])->name('register');
    Route::post('Cimilk/register', [CimilkController::class, 'register'])->name('register.post');
});

// --- GROUP ROUTE AUTH (Harus Login dulu) ---
Route::middleware('auth')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard-admin', function () {
        return view('dashboardAdmin');
    })->name('admin.dashboard');

    // Dashboard Peternak
    Route::get('/dashboard-peternak', function () {
        return view('dashboardPeternak');
    })->name('peternak.dashboard');

    // Dashboard Penjualan
    Route::get('/dashboard-penjualan', function () {
        return view('dashboardPenjualan');
    })->name('penjualan.dashboard');

    // Logout
    Route::post('Cimilk/logout', [CimilkController::class, 'logout'])->name('logout');
});
