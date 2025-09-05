<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Magang;
use App\Models\Sertifikat;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahPegawai = Pegawai::count();
        $jumlahMagang = Magang::count();
        $jumlahSertifikat = Sertifikat::count();

        return view('dashboard.pimpinan', compact('jumlahPegawai', 'jumlahMagang', 'jumlahSertifikat'));
    }
}
