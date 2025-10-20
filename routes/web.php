<?php

use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [SiteController::class, 'index'])->name('home');

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
    return view('auth.login'); // kalau nanti kamu buat halaman login
});
