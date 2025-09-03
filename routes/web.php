<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Superadmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\Pimpinan\DashboardController as PimpinanDashboardController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\SkKerjaController;
use App\Http\Controllers\Admin\MagangController;
use App\Http\Controllers\Admin\SkMagangController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\Superadmin\JabatanController;
use App\Http\Controllers\Superadmin\UnitKerjaController;
use App\Http\Controllers\Superadmin\UnitMagangController;
use App\Http\Controllers\Superadmin\LokasiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Superadmin\SuperAdminController;
use App\Http\Controllers\Pimpinan\PimpinanController;
use App\Http\Controllers\HomeController;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('dashboard'); // ganti dengan view yang kamu punya
})->name('home');

// Logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('skkerja', SkKerjaController::class);
    Route::resource('magang', MagangController::class);
    Route::resource('sksiswa', SkMagangController::class);
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
});




