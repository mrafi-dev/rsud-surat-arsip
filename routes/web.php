<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LogController;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Arahkan halaman utama langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Grup untuk semua fitur yang membutuhkan pengguna untuk login
Route::middleware(['auth', 'verified'])->group(function () {

    // --- RUTE BERSAMA (Bisa diakses oleh Admin dan TU) ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk Surat Masuk
    Route::resource('surat-masuk', SuratMasukController::class);
    // INI BAGIAN YANG DIPERBAIKI: Namanya disamakan
    Route::get('/surat-masuk/{suratMasuk}/lihat', [SuratMasukController::class, 'lihatPdf'])->name('surat-masuk.lihat');

    // Rute untuk Surat Keluar
    Route::resource('surat-keluar', SuratKeluarController::class);
    Route::get('/surat-keluar/{suratKeluar}/lihat', [SuratKeluarController::class, 'lihatPdf'])->name('surat-keluar.lihat');


    // --- GRUP RUTE KHUSUS ADMIN ---
    // Rute di dalam grup ini dijaga oleh middleware 'admin'
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::resource('users', UserController::class);
        
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/cetak', [LaporanController::class, 'cetakPdf'])->name('laporan.cetak');
        Route::get('/laporan/cetak-excel', [LaporanController::class, 'cetakExcel'])->name('laporan.cetak_excel');
        
        Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

        // Rute baru untuk data grafik dinamis
        Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chartData');
    });
});

require __DIR__.'/auth.php';

