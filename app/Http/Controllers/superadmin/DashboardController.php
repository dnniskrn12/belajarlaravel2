<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Models\Unit_Kerja;
use App\Models\Unit_Magang;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahUser = User::count();
        $jumlahUnitKerja = Unit_Kerja::count();
        $jumlahUnitMagang = Unit_Magang::count();
        $jumlahJabatan = Jabatan::count();
        $jumlahLokasi = Lokasi::count();

        return view('dashboard.superadmin', compact('jumlahUnitKerja', 'jumlahUnitMagang', 'jumlahUser', 'jumlahJabatan'));
    }
}
