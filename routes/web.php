<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Superadmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\Pimpinan\DashboardController as PimpinanDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\SkKerjaController;
use App\Http\Controllers\Admin\MagangController;
use App\Http\Controllers\Admin\SkMagangController;
use App\Http\Controllers\Admin\NilaiPklController;
use App\Http\Controllers\Admin\SertifikatController;
use App\Http\Controllers\Superadmin\UserController;
use App\Http\Controllers\Superadmin\JabatanController;
use App\Http\Controllers\Superadmin\UnitKerjaController;
use App\Http\Controllers\Superadmin\UnitMagangController;
use App\Http\Controllers\Superadmin\LokasiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Superadmin\SuperAdminController;
use App\Http\Controllers\Pimpinan\PimpinanController;
use App\Http\Controllers\HomeController;
use App\Models\Magang;
use App\Models\Sertifikat;
use App\Models\Sk_Kerja;
use App\Models\Sk_Magang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/home', function () {
    return view('dashboard');
})->name('home');

// Login
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/', function () {
    return redirect('/login');
});

// Logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('skkerja', SkKerjaController::class);
    Route::resource('magang', MagangController::class);
    Route::resource('sksiswa', SkMagangController::class);
    Route::resource('nilaipkl', NilaiPklController::class);
    Route::resource('sertifikat', SertifikatController::class);

});

Route::prefix('superadmin')->name('superadmin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::post('user/block', [UserController::class, 'toggleBlock'])->name('user.block');
    Route::resource('jabatan', JabatanController::class);
    Route::resource('unitkerja', UnitKerjaController::class);
    Route::resource('unitmagang', UnitMagangController::class);
    Route::resource('lokasi', LokasiController::class);
});

Route::prefix('pimpinan')->name('pimpinan.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PimpinanDashboardController::class, 'index'])->name('dashboard');
    // Daftar pegawai
    Route::get('/pegawai', [PegawaiController::class, 'indexPimpinan'])->name('pegawai.index');
    Route::get('/pegawai/cetak', [PegawaiController::class, 'cetakSemua'])->name('pegawai.cetak');
    Route::get('/pegawai/{id}/cetak', [PegawaiController::class, 'cetakSatu'])->name('pegawai.cetakSatu');
    Route::get('/pegawai/{id}', [PegawaiController::class, 'showPimpinan'])->name('pegawai.show');
    // Daftar SK Kerja
    Route::get('/skkerja', [SkKerjaController::class, 'indexPimpinan'])->name('skkerja.index');
    Route::get('/skkerja/cetak', [SkKerjaController::class, 'cetakSemua'])->name('skkerja.cetak');
    Route::get('/skkerja/{id}/cetak', [SkKerjaController::class, 'cetakSatu'])->name('skkerja.cetakSatu');
    // Daftar Magang
    Route::get('/magang', [MagangController::class, 'indexPimpinan'])->name('magang.index');
    Route::get('/magang/cetak', [MagangController::class, 'cetakSemua'])->name('magang.cetak');
    Route::get('/magang/{id}/cetak', [MagangController::class, 'cetakSatu'])->name('magang.cetakSatu');
    Route::get('/magang/{id}', [MagangController::class, 'showPimpinan'])->name('magang.show');
    // Daftar SK Magang
    Route::get('/sksiswa', [SkMagangController::class, 'indexPimpinan'])->name('sksiswa.index');
    Route::get('/sksiswa/cetak', [SkMagangController::class, 'cetakSemua'])->name('sksiswa.cetak');
    Route::get('/sksiswa/{id}/cetak', [SkMagangController::class, 'cetakSatu'])->name('sksiswa.cetakSatu');
    // Sertifikat
    Route::get('/sertifikat', [SertifikatController::class, 'indexPimpinan'])->name('sertifikat.index');
    Route::get('/sertifikat/cetak', [SertifikatController::class, 'cetakSemua'])->name('sertifikat.cetak');


});


