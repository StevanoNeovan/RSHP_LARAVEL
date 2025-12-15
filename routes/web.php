<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
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
use App\Http\Controllers\Admin\TemuDokterController;
use App\Http\Controllers\Admin\PetController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', function() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('site.home'))->name('home');
Route::get('/layanan', fn() => view('site.layanan'))->name('layanan');
Route::get('/timdokter', fn() => view('site.timdokter'))->name('timdokter');
Route::get('/tentang', fn() => view('site.tentang'))->name('tentang');
Route::get('/kontak', fn() => view('site.kontak'))->name('kontak');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdministrator'])->prefix('admin')->name('admin.')->group(function() {
    
    // Dashboard
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    
    // === MASTER DATA ===
    
    // Jenis Hewan
    Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis-hewan.index');
    Route::get('/jenis-hewan/create', [JenisHewanController::class, 'create'])->name('jenis-hewan.create');
    Route::post('/jenis-hewan', [JenisHewanController::class, 'store'])->name('jenis-hewan.store');
    Route::get('/jenis-hewan/{id}/edit', [JenisHewanController::class, 'edit'])->name('jenis-hewan.edit');
    Route::put('/jenis-hewan/{id}', [JenisHewanController::class, 'update'])->name('jenis-hewan.update');
    Route::delete('/jenis-hewan/{id}', [JenisHewanController::class, 'destroy'])->name('jenis-hewan.destroy');
    Route::patch('/jenis-hewan/{id}/restore', [JenisHewanController::class, 'restore'])->name('jenis-hewan.restore');
    Route::delete('/jenis-hewan/{id}/force-delete', [JenisHewanController::class, 'forceDelete'])->name('jenis-hewan.force-delete');
    
    // Ras Hewan - ✅ FIXED ORDER: DELETE FORM BEFORE EDIT
    Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras-hewan.index');
    Route::get('/ras-hewan/create', [RasHewanController::class, 'create'])->name('ras-hewan.create');
    Route::post('/ras-hewan', [RasHewanController::class, 'store'])->name('ras-hewan.store');
    // ✅ DELETE FORM per Jenis Hewan - MUST BE BEFORE {id}/edit
    Route::get('/ras-hewan/{idjenis_hewan}/delete', [RasHewanController::class, 'deleteForm'])->name('ras-hewan.delete-form');
    Route::delete('/ras-hewan', [RasHewanController::class, 'destroy'])->name('ras-hewan.destroy');
    // Edit routes come after specific routes
    Route::get('/ras-hewan/{id}/edit', [RasHewanController::class, 'edit'])->name('ras-hewan.edit');
    Route::put('/ras-hewan/{id}', [RasHewanController::class, 'update'])->name('ras-hewan.update');
     Route::patch('/ras-hewan/{id}/restore', [RasHewanController::class, 'restore'])->name('ras-hewan.restore');
    Route::delete('/ras-hewan/{id}/force-delete', [RasHewanController::class, 'forceDelete'])->name('ras-hewan.force-delete');
    
    
    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::patch('/kategori/{id}/restore', [KategoriController::class, 'restore'])->name('kategori.restore');
    Route::delete('/kategori/{id}/force-delete', [KategoriController::class, 'forceDelete'])->name('kategori.force-delete');
    
    // Kategori Klinis
    Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori-klinis.index');
    Route::get('/kategori-klinis/create', [KategoriKlinisController::class, 'create'])->name('kategori-klinis.create');
    Route::post('/kategori-klinis', [KategoriKlinisController::class, 'store'])->name('kategori-klinis.store');
    Route::get('/kategori-klinis/{id}/edit', [KategoriKlinisController::class, 'edit'])->name('kategori-klinis.edit');
    Route::put('/kategori-klinis/{id}', [KategoriKlinisController::class, 'update'])->name('kategori-klinis.update');
    Route::delete('/kategori-klinis/{id}', [KategoriKlinisController::class, 'destroy'])->name('kategori-klinis.destroy');
    Route::patch('/kategori-klinis/{id}/restore', [KategoriKlinisController::class, 'restore'])->name('kategori-klinis.restore');
    Route::delete('/kategori-klinis/{id}/force-delete', [KategoriKlinisController::class, 'forceDelete'])->name('kategori-klinis.force-delete');
    
    
    // Kode Tindakan Terapi
    Route::get('/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'index'])->name('kode-tindakan-terapi.index');
    Route::get('/kode-tindakan-terapi/create', [KodeTindakanTerapiController::class, 'create'])->name('kode-tindakan-terapi.create');
    Route::post('/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'store'])->name('kode-tindakan-terapi.store');
    Route::get('/kode-tindakan-terapi/{id}/edit', [KodeTindakanTerapiController::class, 'edit'])->name('kode-tindakan-terapi.edit');
    Route::put('/kode-tindakan-terapi/{id}', [KodeTindakanTerapiController::class, 'update'])->name('kode-tindakan-terapi.update');
    Route::delete('/kode-tindakan-terapi/{id}', [KodeTindakanTerapiController::class, 'destroy'])->name('kode-tindakan-terapi.destroy');
    Route::patch('/kode-tindakan-terapi/{id}/restore', [KodeTindakanTerapiController::class, 'restore'])->name('kode-tindakan-terapi.restore');
    Route::delete('/kode-tindakan-terapi/{id}/force-delete', [KodeTindakanTerapiController::class, 'forceDelete'])->name('kode-tindakan-terapi.force-delete');
    
    
    // === USER MANAGEMENT ===
    
    // User
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/user/{id}/reset-password', [UserController::class, 'resetPassword'])->name('user.reset-password');
    Route::patch('/user/{id}/restore', [UserController::class, 'restore'])->name('user.restore');
    Route::delete('/user/{id}/force-delete', [UserController::class, 'forceDelete'])->name('user.force-delete');

    
    // Role
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    Route::patch('/role/{id}/restore', [RoleController::class, 'restore'])->name('role.restore');
    Route::delete('/role/{id}/force-delete', [RoleController::class, 'forceDelete'])->name('role.force-delete');
    
    // Role User
    Route::get('/role-user', [RoleUserController::class, 'index'])->name('role-user.index');
    Route::get('/role-user/create', [RoleUserController::class, 'create'])->name('role-user.create');
    Route::post('/role-user', [RoleUserController::class, 'store'])->name('role-user.store');
    Route::get('/role-user/{id}/edit', [RoleUserController::class, 'edit'])->name('role-user.edit');
    Route::put('/role-user/{id}', [RoleUserController::class, 'update'])->name('role-user.update');
    Route::delete('/role-user/{id}', [RoleUserController::class, 'destroy'])->name('role-user.destroy');
    Route::patch('/role-user/{id}/restore', [RoleUserController::class, 'restore'])->name('role-user.restore');
    Route::delete('/role-user/{id}/force-delete', [RoleUserController::class, 'forceDelete'])->name('role-user.force-delete');
    
    // === DATA TRANSAKSI ===
    
    // Pemilik
    Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
    Route::get('/pemilik/create', [PemilikController::class, 'create'])->name('pemilik.create');
    Route::post('/pemilik', [PemilikController::class, 'store'])->name('pemilik.store');
    Route::get('/pemilik/{id}/edit', [PemilikController::class, 'edit'])->name('pemilik.edit');
    Route::put('/pemilik/{id}', [PemilikController::class, 'update'])->name('pemilik.update');
    Route::delete('/pemilik/{id}', [PemilikController::class, 'destroy'])->name('pemilik.destroy');
    Route::patch('/pemilik/{id}/restore', [PemilikController::class, 'restore'])->name('pemilik.restore');
    Route::delete('/pemilik/{id}/force-delete', [PemilikController::class, 'forceDelete'])->name('pemilik.force-delete');
    
    // Pet
    Route::get('/pet', [PetController::class, 'index'])->name('pet.index');
    Route::get('/pet/create', [PetController::class, 'create'])->name('pet.create');
    Route::post('/pet', [PetController::class, 'store'])->name('pet.store');
    Route::get('/pet/{id}/edit', [PetController::class, 'edit'])->name('pet.edit');
    Route::put('/pet/{id}', [PetController::class, 'update'])->name('pet.update');
    Route::delete('/pet/{id}', [PetController::class, 'destroy'])->name('pet.destroy');
    Route::patch('/pet/{id}/restore', [PetController::class, 'restore'])->name('pet.restore');
    Route::delete('/pet/{id}/force-delete', [PetController::class, 'forceDelete'])->name('pet.force-delete');
    
    // Temu Dokter
    Route::get('/temu-dokter', [TemuDokterController::class, 'index'])->name('temu-dokter.index');
    Route::get('/temu-dokter/create', [TemuDokterController::class, 'create'])->name('temu-dokter.create');
    Route::post('/temu-dokter', [TemuDokterController::class, 'store'])->name('temu-dokter.store');
    Route::get('/temu-dokter/{id}/edit', [TemuDokterController::class, 'edit'])->name('temu-dokter.edit');
    Route::put('/temu-dokter/{id}', [TemuDokterController::class, 'update'])->name('temu-dokter.update');
    Route::delete('/temu-dokter/{id}', [TemuDokterController::class, 'destroy'])->name('temu-dokter.destroy');
    Route::patch('/temu-dokter/{id}/status/{status}', [TemuDokterController::class, 'updateStatus'])->name('temu-dokter.update-status');
    Route::patch('/temu-dokter/{id}/restore', [TemuDokterController::class, 'restore'])->name('temu-dokter.restore');
    Route::delete('/temu-dokter/{id}/force-delete', [TemuDokterController::class, 'forceDelete'])->name('temu-dokter.force-delete');

    // Rekam Medis
    Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::get('/rekam-medis/create', [RekamMedisController::class, 'create'])->name('rekam-medis.create');
    Route::post('/rekam-medis', [RekamMedisController::class, 'store'])->name('rekam-medis.store');
    Route::get('/rek    // Rekam Medisam-medis/{id}', [RekamMedisController::class, 'show'])->name('rekam-medis.show');
    Route::get('/rekam-medis/{id}/edit', [RekamMedisController::class, 'edit'])->name('rekam-medis.edit');
    Route::put('/rekam-medis/{id}', [RekamMedisController::class, 'update'])->name('rekam-medis.update');
    Route::delete('/rekam-medis/{id}', [RekamMedisController::class, 'destroy'])->name('rekam-medis.destroy');
    Route::post('/rekam-medis/{id}/add-detail', [RekamMedisController::class, 'addDetail'])->name('rekam-medis.add-detail');
    Route::delete('/rekam-medis/{id}/detail/{detailId}', [RekamMedisController::class, 'removeDetail'])->name('rekam-medis.remove-detail');
    Route::patch('/rekam-medis/{id}/restore', [RekamMedisController::class, 'restore'])->name('rekam-medis.restore');
    Route::delete('/rekam-medis/{id}/force-delete', [RekamMedisController::class, 'forceDelete'])->name('rekam-medis.force-delete');
});

/*
|--------------------------------------------------------------------------
| RESEPSIONIS ROUTES
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
Route::middleware(['auth', 'isResepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardResepsionisController::class, 'index'])->name('dashboard');
    
    // Pemilik
    Route::get('/pemilik', [\App\Http\Controllers\Resepsionis\PemilikResepsionisController::class, 'index'])->name('pemilik.index');
    Route::get('/pemilik/create', [\App\Http\Controllers\Resepsionis\PemilikResepsionisController::class, 'create'])->name('pemilik.create');
    Route::post('/pemilik', [\App\Http\Controllers\Resepsionis\PemilikResepsionisController::class, 'store'])->name('pemilik.store');
    Route::get('/pemilik/{id}/edit', [\App\Http\Controllers\Resepsionis\PemilikResepsionisController::class, 'edit'])->name('pemilik.edit');
    Route::put('/pemilik/{id}', [\App\Http\Controllers\Resepsionis\PemilikResepsionisController::class, 'update'])->name('pemilik.update');
    Route::delete('/pemilik/{id}', [\App\Http\Controllers\Resepsionis\PemilikResepsionisController::class, 'destroy'])->name('pemilik.destroy');
    
    // Pet
    Route::get('/pet', [\App\Http\Controllers\Resepsionis\PetResepsionisController::class, 'index'])->name('pet.index');
    Route::get('/pet/create', [\App\Http\Controllers\Resepsionis\PetResepsionisController::class, 'create'])->name('pet.create');
    Route::post('/pet', [\App\Http\Controllers\Resepsionis\PetResepsionisController::class, 'store'])->name('pet.store');
    Route::get('/pet/{id}/edit', [\App\Http\Controllers\Resepsionis\PetResepsionisController::class, 'edit'])->name('pet.edit');
    Route::put('/pet/{id}', [\App\Http\Controllers\Resepsionis\PetResepsionisController::class, 'update'])->name('pet.update');
    Route::delete('/pet/{id}', [\App\Http\Controllers\Resepsionis\PetResepsionisController::class, 'destroy'])->name('pet.destroy');
    
    // Temu Dokter
    Route::get('/temu-dokter', [\App\Http\Controllers\Resepsionis\TemuDokterResepsionisController::class, 'index'])->name('temu-dokter.index');
    Route::get('/temu-dokter/create', [\App\Http\Controllers\Resepsionis\TemuDokterResepsionisController::class, 'create'])->name('temu-dokter.create');
    Route::post('/temu-dokter', [\App\Http\Controllers\Resepsionis\TemuDokterResepsionisController::class, 'store'])->name('temu-dokter.store');
    Route::get('/temu-dokter/{id}/edit', [\App\Http\Controllers\Resepsionis\TemuDokterResepsionisController::class, 'edit'])->name('temu-dokter.edit');
    Route::put('/temu-dokter/{id}', [\App\Http\Controllers\Resepsionis\TemuDokterResepsionisController::class, 'update'])->name('temu-dokter.update');
    Route::delete('/temu-dokter/{id}', [\App\Http\Controllers\Resepsionis\TemuDokterResepsionisController::class, 'destroy'])->name('temu-dokter.destroy');
    Route::patch('/temu-dokter/{id}/status/{status}', [\App\Http\Controllers\Resepsionis\TemuDokterResepsionisController::class, 'updateStatus'])->name('temu-dokter.update-status');

});

/*
|--------------------------------------------------------------------------
| DOKTER ROUTES
|--------------------------------------------------------------------------
*/
// ========================================
// TAMBAHKAN/UPDATE ROUTES INI DI routes/web.php
// SECTION: DOKTER ROUTES
// ========================================

use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Dokter\ProfilDokterController;
use App\Http\Controllers\Dokter\PasienDokterController;
use App\Http\Controllers\Dokter\TemuDokterDokterController;
use App\Http\Controllers\Dokter\RekamMedisDokterController;

Route::middleware(['auth', 'isDokter'])->prefix('dokter')->name('dokter.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardDokterController::class, 'index'])->name('dashboard');
    
    // Profil
    Route::get('/profil', [ProfilDokterController::class, 'index'])->name('profil');
    
    // Pasien
    Route::get('/pasien', [PasienDokterController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/{id}', [PasienDokterController::class, 'show'])->name('pasien.show');
    
    // Temu Dokter
    Route::get('/temu-dokter', [TemuDokterDokterController::class, 'index'])->name('temu-dokter.index');
    Route::get('/temu-dokter/{id}', [TemuDokterDokterController::class, 'show'])->name('temu-dokter.show');
    
    // Rekam Medis
    Route::get('/rekam-medis', [RekamMedisDokterController::class, 'index'])->name('rekam-medis.index');
    Route::get('/rekam-medis/{id}', [RekamMedisDokterController::class, 'show'])->name('rekam-medis.show');
    Route::get('/rekam-medis/{id}/edit', [RekamMedisDokterController::class, 'edit'])->name('rekam-medis.edit');
    Route::put('/rekam-medis/{id}', [RekamMedisDokterController::class, 'update'])->name('rekam-medis.update');
    
    // Detail Rekam Medis (CRUD)
    Route::post('/rekam-medis/{id}/add-detail', [RekamMedisDokterController::class, 'addDetail'])->name('rekam-medis.add-detail');
    Route::delete('/rekam-medis/{id}/detail/{detailId}', [RekamMedisDokterController::class, 'removeDetail'])->name('rekam-medis.remove-detail');

    // DOKTER - Profile Completion
    Route::get('/profil/complete', [ProfilDokterController::class, 'showCompleteForm'])->name('profil.complete');
    Route::post('/profil/complete', [ProfilDokterController::class, 'storeComplete'])->name('profil.store-complete');
    
    // Existing routes...
    Route::get('/profil', [ProfilDokterController::class, 'index'])->name('profil');
    Route::put('/profil', [ProfilDokterController::class, 'update'])->name('profil.update');
});

/*
|--------------------------------------------------------------------------
| PERAWAT ROUTES
|--------------------------------------------------------------------------
*/
// PERAWAT ROUTES - Add to routes/web.php
use App\Http\Controllers\Perawat\{
    DashboardPerawatController,
    ProfilPerawatController,
    PasienPerawatController,
    RekamMedisPerawatController
};

Route::middleware(['auth', 'isPerawat'])->prefix('perawat')->name('perawat.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardPerawatController::class, 'index'])->name('dashboard');
    
    // Profil
    Route::get('/profil', [ProfilPerawatController::class, 'index'])->name('profil');
    
    // Pasien
    Route::get('/pasien', [PasienPerawatController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/{id}', [PasienPerawatController::class, 'show'])->name('pasien.show');
    
    // Rekam Medis
    Route::get('/rekam-medis', [RekamMedisPerawatController::class, 'index'])->name('rekam-medis.index');
    Route::get('/rekam-medis/create', [RekamMedisPerawatController::class, 'create'])->name('rekam-medis.create');
    Route::post('/rekam-medis', [RekamMedisPerawatController::class, 'store'])->name('rekam-medis.store');
    Route::get('/rekam-medis/{id}', [RekamMedisPerawatController::class, 'show'])->name('rekam-medis.show');
    Route::get('/rekam-medis/{id}/edit', [RekamMedisPerawatController::class, 'edit'])->name('rekam-medis.edit');
    Route::put('/rekam-medis/{id}', [RekamMedisPerawatController::class, 'update'])->name('rekam-medis.update');
    Route::delete('/rekam-medis/{id}', [RekamMedisPerawatController::class, 'destroy'])->name('rekam-medis.destroy');
    
    // Detail Rekam Medis
    Route::post('/rekam-medis/{id}/add-detail', [RekamMedisPerawatController::class, 'addDetail'])->name('rekam-medis.add-detail');
    Route::delete('/rekam-medis/{id}/detail/{detailId}', [RekamMedisPerawatController::class, 'removeDetail'])->name('rekam-medis.remove-detail');

    // PERAWAT - Profile Completion
    Route::get('/profil/complete', [ProfilPerawatController::class, 'showCompleteForm'])->name('profil.complete');
    Route::post('/profil/complete', [ProfilPerawatController::class, 'storeComplete'])->name('profil.store-complete');
    
    Route::get('/profil', [ProfilPerawatController::class, 'index'])->name('profil');
    Route::put('/profil', [ProfilPerawatController::class, 'update'])->name('profil.update');
});

/*
|--------------------------------------------------------------------------
| PEMILIK ROUTES
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Http\Controllers\Pemilik\ProfilPemilikController;
use App\Http\Controllers\Pemilik\PetPemilikController;
use App\Http\Controllers\Pemilik\TemuDokterPemilikController;
use App\Http\Controllers\Pemilik\RekamMedisPemilikController;

Route::middleware(['auth', 'isPemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardPemilikController::class, 'index'])->name('dashboard');
    
    // Profil
    Route::get('/profil', [ProfilPemilikController::class, 'index'])->name('profil');
    
    // Pets
    Route::get('/pets', [PetPemilikController::class, 'index'])->name('pets.index');
    Route::get('/pets/{id}', [PetPemilikController::class, 'show'])->name('pets.show');
    
    // Temu Dokter
    Route::get('/temu-dokter', [TemuDokterPemilikController::class, 'index'])->name('temu-dokter.index');
    Route::get('/temu-dokter/{id}', [TemuDokterPemilikController::class, 'show'])->name('temu-dokter.show');
    
    // Rekam Medis
    Route::get('/rekam-medis', [RekamMedisPemilikController::class, 'index'])->name('rekam-medis.index');
    Route::get('/rekam-medis/{id}', [RekamMedisPemilikController::class, 'show'])->name('rekam-medis.show');
});