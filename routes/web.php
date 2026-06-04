<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PemanggilanController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('layanan', LayananController::class)->except(['show'])->middleware('role:admin');
    Route::resource('antrian', AntrianController::class)->only(['index', 'create', 'store']);

    Route::get('/pemanggilan', [PemanggilanController::class, 'index'])->name('pemanggilan.index')->middleware('role:admin,petugas');
    Route::post('/pemanggilan/next', [PemanggilanController::class, 'next'])->name('pemanggilan.next')->middleware('role:admin,petugas');
    Route::post('/pemanggilan/finish', [PemanggilanController::class, 'finish'])->name('pemanggilan.finish')->middleware('role:admin,petugas');
    Route::post('/pemanggilan/skip', [PemanggilanController::class, 'skip'])->name('pemanggilan.skip')->middleware('role:admin,petugas');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
});
