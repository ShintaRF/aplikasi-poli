<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DaftarPoliController;
use App\Http\Controllers\DetailPeriksaController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PasienRegistrationController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin/login', [LoginController::class, 'indexAdmin'])->name('admin.login')->middleware('guest');
Route::post('/admin/login', [LoginController::class, 'authenticateAdmin']);
Route::post('/admin/logout', [LoginController::class, 'logoutAdmin']);

Route::get('/dokter/login', [LoginController::class, 'indexDokter'])->name('dokter.login')->middleware('guest');
Route::post('/dokter/login', [LoginController::class, 'authenticateDokter']);
Route::post('/dokter/logout', [LoginController::class, 'logoutDokter']);

Route::get('/pasien/register', [PasienRegistrationController::class, 'register'])->name('pasien.register');
Route::post('/pasien/register', [PasienRegistrationController::class, 'registerPasien']);
Route::get('/pasien/login', [PasienRegistrationController::class, 'login'])->name('pasien.login');
Route::post('/pasien/login', [PasienRegistrationController::class, 'loginPasien']);
Route::get('/pasien/logout', [PasienRegistrationController::class, 'logout'])->name('pasien.logout');

Route::middleware(['pasien.auth'])->group(function () {
    Route::get('/pasien/daftar-poli', [DaftarPoliController::class, 'index'])->name('pasien.daftarpoli');
    Route::post('/pasien/daftar-poli', [DaftarPoliController::class, 'store'])->name('pasien.daftarpoli.store');
    Route::get('/getJadwals', [DaftarPoliController::class, 'getJadwals'])->name('getJadwals');
    Route::get('/pasien/selesai/{id}', [DaftarPoliController::class, 'selesai'])->name('pasien.selesai');
});


Route::middleware(['auth', 'role:dokter'])->group(function () {
    // Dokter
    Route::get('/dokter', [HomeController::class, 'dokter'])->name('dokter.dashboard');

    Route::get('/dokter/jadwal-periksa', [JadwalController::class, 'index'])->name('jadwalperiksa');
    Route::post('/dokter/jadwal-periksa', [JadwalController::class, 'store'])->name('jadwalperiksa.store');
    Route::delete('/dokter/jadwal-periksa/{id}', [JadwalController::class, 'destroy'])->name('jadwalperiksa.destroy');
    Route::post('/dokter/jadwal-periksa/{id}', [JadwalController::class, 'update'])->name('jadwalperiksa.update');

    Route::get('/dokter/memeriksa-pasien', [PeriksaController::class, 'index'])->name('memeriksapasien');
    Route::post('/dokter/memeriksa-pasien/{id}', [PeriksaController::class, 'update'])->name('memeriksapasien.update');

    Route::get('/dokter/edit-periksa/{id}', [PeriksaController::class, 'edit'])->name('editperiksa');
    Route::post('/dokter/edit-periksa/{id}', [PeriksaController::class, 'updatePeriksa'])->name('editperiksa.update');

    Route::get('/dokter/riwayat-pasien', [DetailPeriksaController::class, 'index'])->name('riwayatpasien');
    Route::get('/dokter/profil', [ProfileController::class, 'index'])->name('profil');
    Route::post('/dokter/profil/{id}', [ProfileController::class, 'update'])->name('profil.update');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin
    Route::get('/admin', [HomeController::class, 'admin'])->name('admin.dashboard');

    Route::get('/admin/dokter', [DokterController::class, 'index'])->name('dokter');
    Route::post('/admin/dokter', [DokterController::class, 'store'])->name('dokter.store');
    Route::delete('/admin/dokter/{id}', [DokterController::class, 'destroy'])->name('dokter.destroy');
    Route::post('/admin/dokter/{id}', [DokterController::class, 'update'])->name('dokter.update');

    Route::get('/admin/pasien', [PasienController::class, 'index'])->name('pasien');
    Route::post('/admin/pasien', [PasienController::class, 'store'])->name('pasien.store');
    Route::delete('/admin/pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');
    Route::post('/admin/pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');

    Route::get('/admin/poli', [PoliController::class, 'index'])->name('poli');
    Route::post('/admin/poli', [PoliController::class, 'store'])->name('poli.store');
    Route::delete('/admin/poli/{id}', [PoliController::class, 'destroy'])->name('poli.destroy');
    Route::post('/admin/poli/{id}', [PoliController::class, 'update'])->name('poli.update');

    Route::get('/admin/obat', [ObatController::class, 'index'])->name('obat');
    Route::post('/admin/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::delete('/admin/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
    Route::post('/admin/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
});