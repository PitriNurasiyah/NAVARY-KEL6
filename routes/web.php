<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CimilkController;
use App\Http\Controllers\SapiController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\ManajemenAkunController;
use App\Http\Controllers\DashboardPeternakController;
use App\Http\Controllers\DashboardPenjualanController;

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
Route::get('/biodata-sapi/create', [SapiController::class, 'create'])->name('sapi.create');
Route::post('/biodata-sapi', [SapiController::class, 'store'])->name('sapi.store');
Route::get('/biodata-sapi/{id}/edit', [SapiController::class, 'edit'])->name('sapi.edit');
Route::put('/biodata-sapi/{id}', [SapiController::class, 'update'])->name('sapi.update');
Route::delete('/biodata-sapi/{id}', [SapiController::class, 'destroy'])->name('sapi.destroy');

// Rute Dashboard (Hanya bisa diakses kalau sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/manajemen-akun', [ManajemenAkunController::class, 'index'])->name('manajemen.akun');
    Route::get('/manajemen-akun/create', [ManajemenAkunController::class, 'create'])->name('manajemen-akun.create');
    Route::post('/manajemen-akun', [ManajemenAkunController::class, 'store'])->name('manajemen-akun.store');
    Route::get('/manajemen-akun/{id}/edit', [ManajemenAkunController::class, 'edit'])->name('manajemen-akun.edit');
    Route::put('/manajemen-akun/{id}', [ManajemenAkunController::class, 'update'])->name('manajemen-akun.update');
    Route::delete('/manajemen-akun/{id}', [ManajemenAkunController::class, 'destroy'])->name('manajemen-akun.destroy');
    Route::get('/dashboard-peternak', [DashboardPeternakController::class, 'index'])->name('peternak.dashboard');
    Route::get('/pencatatan-pakan', function() { return view('peternak.pakan'); })->name('pakan.index');
    Route::get('/siklus-sapi', function() { return view('peternak.siklus'); })->name('siklus.index');
    Route::get('/produksi-susu-peternak', function() { return view('peternak.produksi'); })->name('produksi.index');
    
    Route::get('/dashboard-penjualan', [DashboardPenjualanController::class, 'index'])->name('penjualan.dashboard');

    Route::post('logout', [CimilkController::class, 'logout'])->name('logout');
});
