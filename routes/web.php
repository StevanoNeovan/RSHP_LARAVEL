<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Resepsionis\PemilikController as ResepsionisPemilikController;
use App\Http\Controllers\Resepsionis\PetController as ResepsionisPetController;
use App\Http\Controllers\Resepsionis\TemuDokterController;
use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Perawat\DashboardPerawatController;



// AUTH ROUTES 

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// PUBLIC ROUTES

Route::get('/', function () {
    return view('site.home');
});
Route::get('/layanan', fn() => view('site.layanan'));
Route::get('/timdokter', fn() => view('site.timdokter'));
Route::get('/tentang', fn() => view('site.tentang'));
Route::get('/kontak', fn() => view('site.kontak'));
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');


// HOME

Route::get('/home', [SiteController::class, 'index'])->name('home');


// ADMIN ROUTES

Route::middleware(['isAdministrator'])->group(function() {
    Route::resource('dashboard', DashboardAdminController::class);
    Route::resource('jenis-hewan', JenisHewanController::class);
    Route::resource('ras-hewan', RasHewanController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('kategori-klinis', KategoriKlinisController::class);
    Route::resource('role', RoleController::class);
    Route::resource('kode-tindakan-terapi', KodeTindakanTerapiController::class);
    Route::resource('role-user', RoleUserController::class);
    Route::resource('pemilik', PemilikController::class);
    Route::resource('user', UserController::class);
});

Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardAdminController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware('isAdministrator');

Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');
Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('admin.ras-hewan.index');
Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');
Route::get('/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'index'])->name('admin.kode-tindakan-terapi.index');
Route::get('/role', [RoleController::class, 'index'])->name('admin.role.index');
Route::get('/role-user', [RoleUserController::class, 'index'])->name('admin.role-user.index');
Route::get('/pemilik', [PemilikController::class, 'index'])->name('admin.pemilik.index');
Route::get('/rekam-medis', [App\Http\Controllers\Admin\RekamMedisController::class, 'index'])->name('admin.rekam-medis.index');    
    

// RESEPSIONIS ROUTES
Route::middleware(['auth', 'isResepsionis'])
    ->prefix('resepsionis')
    ->name('resepsionis.')
    ->group(function () {
        Route::get('/dashboard', [DashboardResepsionisController::class, 'index'])->name('dashboard');

        // Registrasi Pemilik
        Route::get('/pemilik/create', [ResepsionisPemilikController::class, 'create'])->name('pemilik.create');
        Route::post('/pemilik', [ResepsionisPemilikController::class, 'store'])->name('pemilik.store');

        // Registrasi Pet
        Route::get('/pet/create', [ResepsionisPetController::class, 'create'])->name('pet.create');
        Route::post('/pet', [ResepsionisPetController::class, 'store'])->name('pet.store');

        // Temu Dokter
        Route::get('/temu-dokter/create', [TemuDokterController::class, 'create'])->name('temu-dokter.create');
        Route::post('/temu-dokter', [TemuDokterController::class, 'store'])->name('temu-dokter.store');
    });



// DOKTER ROUTES
Route::middleware(['auth', 'isDokter'])
    ->prefix('dokter')
    ->name('dokter.')
    ->group(function () {
        Route::get('/dashboard', [DashboardDokterController::class, 'index'])->name('dashboard');

        Route::get('/rekam-medis', function() {
            return 'Halaman Rekam Medis Dokter (TODO)';
        })->name('rekam-medis.index');
    });

// PERAWAT ROUTES
Route::middleware(['auth', 'isPerawat'])
    ->prefix('perawat')
    ->name('perawat.')
    ->group(function () {
        
        Route::get('/dashboard', [DashboardPerawatController::class, 'index'])->name('dashboard');

        Route::get('/rekam-medis', function() {
            return 'Halaman Kelola Rekam Medis Perawat (Belum Dibuat)';
        })->name('rekam-medis.index');

    });

// PEMILIK ROUTES

Route::middleware(['auth', 'isPemilik'])
    ->prefix('pemilik') 
    ->name('pemilik.') 
    ->group(function () {
        
        Route::get('/dashboard', [DashboardPemilikController::class, 'index'])
             ->name('dashboard');
        //Route::get('/pets', [PemilikPetController::class, 'index'])->name('pets.index');
        //Route::get('/reservasi', [PemilikReservasiController::class, 'index'])->name('reservasi.index');
        //Route::get('/rekam-medis', [PemilikRekamMedisController::class, 'index'])->name('rekam-medis.index');

    });
