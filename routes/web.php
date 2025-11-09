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
use App\Http\Controllers\Admin\RekamMedisController;
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Resepsionis\PemilikController as ResepsionisPemilikController;
use App\Http\Controllers\Resepsionis\PetController as ResepsionisPetController;
use App\Http\Controllers\Resepsionis\TemuDokterController;
use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Perawat\DashboardPerawatController;

use App\Models\KodeTindakanTerapi;

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

// jenis hewan
Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');
Route::get('/jenis-hewan/create', [JenisHewanController::class, 'create'])->name('admin.jenis-hewan.create');
Route::post('/jenis-hewan/store', [JenisHewanController::class, 'store'])->name('admin.jenis-hewan.store');

// ras hewan
Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('admin.ras-hewan.index');
Route::get('/ras-hewan/create', [RasHewanController::class, 'create'])->name('admin.ras-hewan.create');
Route::post('/ras-hewan/store', [RasHewanController::class, 'store'])->name('admin.ras-hewan.store');

// kategori

Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('admin.kategori.store');

// kategori klinis  
Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');
Route::get('/kategori-klinis/create', [KategoriKlinisController::class, 'create'])->name('admin.kategori-klinis.create');
Route::post('/kategori-klinis/store', [KategoriKlinisController::class, 'store'])->name('admin.kategori-klinis.store');

// kode tindakan terapi
Route::get('/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'index'])->name('admin.kode-tindakan-terapi.index');
Route::get('/kode-tindakan-terapi/create', [KodeTindakanTerapiController::class, 'create'])->name('admin.kode-tindakan-terapi.create');
Route::post('/kode-tindakan-terapi/store', [KodeTindakanTerapiController::class, 'store'])->name('admin.kode-tindakan-terapi.store');

// role
Route::get('/role', [RoleController::class, 'index'])->name('admin.role.index');
Route::get('/role/create', [RoleController::class, 'create'])->name('admin.role.create');
Route::post('/role/store', [RoleController::class, 'store'])->name('admin.role.store');

// role user
Route::get('/role-user', [RoleUserController::class, 'index'])->name('admin.role-user.index');
Route::get('/role-user/create', [RoleUserController::class, 'create'])->name('admin.role-user.create');
Route::post('/role-user/store', [RoleUserController::class, 'store'])->name('admin.role-user.store');

// pemilik
Route::get('/pemilik', [PemilikController::class, 'index'])->name('admin.pemilik.index');
Route::get('/pemilik/create', [PemilikController::class, 'create'])->name('admin.pemilik.create');
Route::post('/pemilik/store', [PemilikController::class, 'store'])->name('admin.pemilik.store');

// rekam medis
Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('admin.rekam-medis.index');    
Route::get('/rekam-medis/create', [RekamMedisController::class, 'create'])->name('admin.rekam-medis.create');
Route::post('/rekam-medis/store', [RekamMedisController::class, 'store'])->name('admin.rekam-medis.store');

    

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
