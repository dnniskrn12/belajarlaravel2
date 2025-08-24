<?php

use App\Http\Controllers\PegawaiController;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/pegawai', function () {
    return view('pegawai');
});

// Route::get('/pegawai/detail/{nama?}', function (?string $nama = null){
//     return "Nama pegawai ini adalah : $nama";
// });

Route::resource('pegawai', PegawaiController::class);

Route::get('/pegawai/{id}', [PegawaiController::class, 'show'])->name('pegawai.show');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

