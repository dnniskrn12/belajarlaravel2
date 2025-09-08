<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Unit_Kerja;
use App\Models\Unit_Magang;
use App\Models\Pegawai;
use App\Models\Magang;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic counts
        $jumlahPegawai = Pegawai::count();
        $jumlahMagang = Magang::count();
        $jumlahSertifikat = Sertifikat::count();

        // Debug: Check if data exists
        Log::info('Dashboard Data Check:', [
            'pegawai_count' => $jumlahPegawai,
            'magang_count' => $jumlahMagang,
            'sertifikat_count' => $jumlahSertifikat
        ]);

        // ===============================
        // Pegawai per cluster (Unit Kerja)
        // ===============================
        // Gunakan nama field yang benar dari model
        $unitKerja = Unit_Kerja::withCount('skKerja')->get();
        $labelsPegawaiCluster = $unitKerja->pluck('nama_unitkerja')->toArray(); // Perbaikan nama field
        $dataPegawaiCluster = $unitKerja->pluck('sk_kerja_count')->toArray();

        // Alternatif langsung dari sk_kerja
        if (empty($labelsPegawaiCluster) || array_sum($dataPegawaiCluster) == 0) {
            $pegawaiPerUnit = DB::table('sk_kerja')
                ->join('unit_kerja', 'sk_kerja.id_unitkerja', '=', 'unit_kerja.id')
                ->select('unit_kerja.nama_unitkerja', DB::raw('count(*) as total'))
                ->groupBy('unit_kerja.nama_unitkerja', 'sk_kerja.id_unitkerja')
                ->get();

            $labelsPegawaiCluster = $pegawaiPerUnit->pluck('nama_unitkerja')->toArray();
            $dataPegawaiCluster = $pegawaiPerUnit->pluck('total')->toArray();
        }

        // ===============================
        // Magang per cluster (Unit Magang)
        // ===============================
        // Gunakan nama field yang benar dari model
        $unitMagang = Unit_Magang::withCount('skMagang')->get();
        $labelsMagangCluster = $unitMagang->pluck('nama_unitmagang')->toArray(); // Perbaikan nama field
        $dataMagangCluster = $unitMagang->pluck('sk_magang_count')->toArray();

        // Alternatif langsung dari sk_magang
        if (empty($labelsMagangCluster) || array_sum($dataMagangCluster) == 0) {
            $magangPerUnit = DB::table('sk_magang')
                ->join('unit_magang', 'sk_magang.id_unitmagang', '=', 'unit_magang.id')
                ->select('unit_magang.nama_unitmagang', DB::raw('count(*) as total'))
                ->groupBy('unit_magang.nama_unitmagang', 'sk_magang.id_unitmagang')
                ->get();

            $labelsMagangCluster = $magangPerUnit->pluck('nama_unitmagang')->toArray();
            $dataMagangCluster = $magangPerUnit->pluck('total')->toArray();
        }

        // ===============================
        // Status Pegawai
        // ===============================
        $statusPegawaiQuery = Pegawai::select('status_pekerjaan', DB::raw('count(*) as total'))
            ->whereNotNull('status_pekerjaan')
            ->groupBy('status_pekerjaan')
            ->pluck('total', 'status_pekerjaan');

        $statusPegawai = $statusPegawaiQuery->isEmpty() ?
            collect(['Tidak Ada Data' => 0]) : $statusPegawaiQuery;

        // ===============================
        // Status Magang
        // ===============================
        $statusMagangQuery = Magang::select('status_magang', DB::raw('count(*) as total'))
            ->whereNotNull('status_magang')
            ->groupBy('status_magang')
            ->pluck('total', 'status_magang');

        $statusMagang = $statusMagangQuery->isEmpty() ?
            collect(['Tidak Ada Data' => 0]) : $statusMagangQuery;

        // ===============================
        // Gender Pegawai
        // ===============================
        $genderPegawaiQuery = Pegawai::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->whereNotNull('jenis_kelamin')
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin');

        $genderPegawai = $genderPegawaiQuery->isEmpty() ?
            collect(['Tidak Ada Data' => 0]) : $genderPegawaiQuery;

        // ===============================
        // Gender Magang
        // ===============================
        $genderMagangQuery = Magang::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->whereNotNull('jenis_kelamin')
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin');

        $genderMagang = $genderMagangQuery->isEmpty() ?
            collect(['Tidak Ada Data' => 0]) : $genderMagangQuery;

        // Debug log untuk memeriksa data
        Log::info('Chart Data:', [
            'labelsPegawaiCluster' => $labelsPegawaiCluster,
            'dataPegawaiCluster' => $dataPegawaiCluster,
            'labelsMagangCluster' => $labelsMagangCluster,
            'dataMagangCluster' => $dataMagangCluster,
            'statusPegawai' => $statusPegawai->toArray(),
            'statusMagang' => $statusMagang->toArray(),
            'genderPegawai' => $genderPegawai->toArray(),
            'genderMagang' => $genderMagang->toArray(),
        ]);

        return view('dashboard.pimpinan', compact(
            'jumlahPegawai',
            'jumlahMagang',
            'jumlahSertifikat',
            'labelsPegawaiCluster',
            'dataPegawaiCluster',
            'labelsMagangCluster',
            'dataMagangCluster',
            'statusPegawai',
            'statusMagang',
            'genderPegawai',
            'genderMagang'
        ));
    }
}
