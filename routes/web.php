<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kunjungan;
use App\Models\LaporanKunjungan;
use App\Models\RiwayatKunjungan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\LibraryCardController;
use App\Http\Controllers\Admin\GeolokasiController;
use App\Http\Controllers\Pemustaka\DendaController;
use App\Http\Controllers\Pemustaka\KartuController;
use App\Http\Controllers\Admin\SettingCardController;
use App\Http\Controllers\Auth\BarcodeLoginController;
use App\Http\Controllers\Pemustaka\BarcodeController;
use App\Http\Controllers\Pemustaka\ProfileController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Pemustaka\PinjamanController;
use App\Http\Controllers\Admin\KelolaAnggotaController;
use App\Http\Controllers\Pemustaka\DashboardController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\LaporanKunjunganController;
use App\Http\Controllers\Admin\KategoriKunjunganController;
use App\Http\Controllers\Pemustaka\RegisterAnggotaController;
use App\Http\Controllers\Pemustaka\PerekamKunjunganController;
use App\Http\Controllers\Pemustaka\RiwayatKunjunganController;

// Routes Role Admin Start

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/dashboard', [DashboardAdminController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
Route::get('/kelola-anggota', [KelolaAnggotaController::class, 'index'])->name('kelola-anggota'); // Rute untuk pendaftaran anggota
Route::get('/pendaftaran-anggota', [KelolaAnggotaController::class, 'create'])->name('pendaftaran-anggota.index');
Route::post('/pendaftaran-anggota/store', [KelolaAnggotaController::class, 'store'])->name('pendaftaran-anggota.store');
Route::get('/kelola-anggota/{id}/edit', [KelolaAnggotaController::class, 'edit'])->name('kelola-anggota.edit');
Route::put('/kelola-anggota/{id}', [KelolaAnggotaController::class, 'update'])->name('kelola-anggota.update');
Route::delete('/kelola-anggota/{id}', [KelolaAnggotaController::class, 'destroy'])->name('kelola-anggota.destroy');
Route::resource('geolocation', GeolokasiController::class)->except(['destroy']);
Route::delete('/geolocation/reset', [GeolokasiController::class, 'reset'])->name('geolocation.reset');
Route::resource('program-studi', ProgramStudiController::class);
Route::resource('kategori-kunjungan', KategoriKunjunganController::class);
Route::resource('laporan-kunjungan', LaporanKunjunganController::class);
Route::get('/setting-card', [SettingCardController::class, 'index'])->name('setting-card');
Route::post('/setting-card/store', [SettingCardController::class, 'store'])->name('setting-card.store');
// Routes Role Admin End




// Routes Role Pegawai / Dosen Start
Route::get('/login-pegawai', [LoginController::class, 'showRFIDForm'])->name('login-rfid.form');
Route::post('/login-pegawai', [LoginController::class, 'loginWithRFID'])->name('login-rfid');
// Route logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Anda telah logout.');
})->name('logout.pegawai');



// Routes Role Pegawai / Dosen End


// Routes Role Mahasiswa Start
Route::get('/pendaftaran-anggota', [RegisterAnggotaController::class, 'showForm'])->name('pendaftaran-anggota.form');
Route::post('/pendaftaran-anggota', [RegisterAnggotaController::class, 'store'])->name('pendaftaran-anggota.store');

// Halaman login barcode
Route::get('/login/barcode', [BarcodeLoginController::class, 'showLoginForm'])->name('barcode.login.form');
// Proses login dengan barcode
Route::post('/login/barcode', [BarcodeLoginController::class, 'login'])->name('barcode.login');

// Logout
Route::post('/logout', [BarcodeLoginController::class, 'logout'])->name('logout');

Route::get('/', [DashboardController::class, 'dashboardPemustaka'])->name('dashboard-pemustaka');
Route::get('/pinjaman', [PinjamanController::class, 'index'])->name('pinjaman.index');
Route::get('/bayar-denda', [DendaController::class, 'index'])->name('bayar.denda');
Route::post('/bayar-denda/{id}', [DendaController::class, 'prosesBayar'])->name('proses.bayar.denda');
Route::get('/riwayat-kunjungan', [RiwayatKunjunganController::class, 'index'])->name('riwayat-kunjungan');
Route::post('/riwayat-kunjungan/store', [RiwayatKunjunganController::class, 'store'])
    ->name('riwayat-kunjungan.store');

Route::get('/profil', [ProfileController::class, 'profil'])->name('profil');
Route::get('/unduh-kartu/{id}', [KartuController::class, 'unduhKartu'])->name('unduh.kartu');
Route::get('/scan-barcode', [BarcodeController::class, 'scan'])->name('scan.barcode');
Route::get('/perekam-kunjungan', [PerekamKunjunganController::class, 'index'])->name('perekam-kunjungan');
Route::get('/geo-lokasi', [PerekamKunjunganController::class, 'geoLokasi'])->name('geo.lokasi');
Route::post('/geo-submit', [PerekamKunjunganController::class, 'submit'])->name('geo.submit');
// Routes Role Mahasiswa End








Route::get('/kartu/{id}', function ($id) {
    $user = App\Models\User::find($id);
    return view('kartu', compact('user'));
})->name('kartu');


Route::get('/generate-library-card/{id}', [LibraryCardController::class, 'generateCard'])->name('generate.card');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/library-card/print', [LibraryCardController::class, 'printCard'])->name('library-card.print');
