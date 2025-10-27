<?php

use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\PemilikController;

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

Route::prefix('admin')->name('admin.')->group(function() {
    
    Route::resource('jenis-hewan', JenisHewanController::class);
    Route::resource('ras-hewan', RasHewanController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('kategori-klinis', KategoriKlinisController::class);
    Route::resource('role', RoleController::class);
    Route::resource('kode-tindakan-terapi', KodeTindakanTerapiController::class);
    Route::resource('role-user', RoleUserController::class);
    Route::resource('pemilik', PemilikController::class);
});


