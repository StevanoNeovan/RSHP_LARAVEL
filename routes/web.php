<?php

use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

Route::get('/home', [SiteController::class, 'index'])->name('home');

// Static Pages Routes
Route::get('/', function () {
    return view('site.home');
});

Route::get('/layanan', function () {
    return view('site.layanan');
});

Route::get('/timdokter', function () {
    return view('site.timdokter');
});

Route::get('/tentang', function () {
    return view('site.tentang');
});

Route::get('/kontak', function () {
    return view('site.kontak');
});

Route::get('/login', function () {
    return view('auth.login'); 
});

// Admin Routes
Route::get('/admin/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');
Route::get('/admin/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('admin.pemilik.index');