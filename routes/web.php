<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\PesertaController;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/antrian/{id}/generate', [AntrianController::class, 'generateQrCode']);
Route::get('/antrian/scan', function () {
    return view('antrian.scan');
});
Route::post('/antrian/store', [AntrianController::class, 'store'])->name('antrian.store');
Route::get('/antrian/{id}/update-status/{status}', [AntrianController::class, 'updateStatus'])->name('antrian.update-status');


Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian.index');
Route::get('/antrian/create', [AntrianController::class, 'create'])->name('antrian.create');
Route::post('/antrian/store', [AntrianController::class, 'store'])->name('antrian.store');
Route::get('/antrian/{id}/generate', [AntrianController::class, 'generateQrCode'])->name('antrian.generate-qr');
Route::get('/antrian/{id}/update-status/{status}', [AntrianController::class, 'updateStatus'])->name('antrian.update-status');
Route::delete('/antrian/{id}', [AntrianController::class, 'destroy'])->name('antrian.destroy');
Route::get('/antrian/{id}', [AntrianController::class, 'show'])->name('antrian.show');
Route::get('/antrian/scan', [AntrianController::class, 'scan'])->name('antrian.scan');

Route::get('/daftar', [AntrianController::class, 'daftarAntrian'])->name('antrian.daftarAntrian');


