<?php

use App\Http\Controllers\FiturController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('layanan.index');
});

Route::get('layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::post('layanan/store', [LayananController::class, 'store'])->name('layanan.store');
Route::post('layanan/update/{id}', [LayananController::class, 'update'])->name('layanan.update');
Route::delete('layanan/destroy/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::post('pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::post('pelanggan/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('pelanggan/destroy/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::post('transaksi/update/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::delete('transaksi/destroy/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

