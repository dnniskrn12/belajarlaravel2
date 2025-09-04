<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use App\Models\NilaiPKL;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SertifikatController extends Controller
{
    /**
     * Tampilkan semua sertifikat
     */
    public function index()
    {
        $sertifikat = Sertifikat::with('nilaiPkl.magang', 'nilaiPkl.unit_magang')->get();
        $totalSertifikat = $sertifikat;
        $bulanIni = now()->month;
        $totalBulanIni = Sertifikat::whereMonth('tanggal_sertifikat', $bulanIni)->count();
        $belumTersertifikat = NilaiPKL::doesntHave('sertifikat')->count();
        $nilaiTanpaSertifikat = NilaiPkl::doesntHave('sertifikat')
            ->with('magang', 'unit_magang')
            ->get();

        return view('sertifikat.index', compact(
            'sertifikat',
            'totalSertifikat',
            'totalBulanIni',
            'belumTersertifikat',
            'nilaiTanpaSertifikat'
        ));
    }

    /**
     * Form buat sertifikat baru
     */
    public function create()
    {
        // Ambil hanya siswa dengan nilai akhir >= 70 dan belum punya sertifikat
        $nilaiPklTersedia = NilaiPKL::with('magang', 'unit_magang')
            ->where('nilai_akhir', '>=', 70)
            ->whereDoesntHave('sertifikat')
            ->get();

        return view('sertifikat.create', compact('nilaiPklTersedia'));
    }

    /**
     * Simpan sertifikat baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_nilai_pkl' => 'required|exists:nilai_pkl,id',
            'nomor_sertifikat' => 'nullable|string|max:255',
            'tanggal_sertifikat' => 'nullable|date',
        ]);

        $nilaiPkl = NilaiPKL::with('magang', 'unit_magang')->findOrFail($request->id_nilai_pkl);

        $nomor = $request->nomor_sertifikat ?: 'SERTIF/PKL/' . date('Y') . '/' . rand(100, 999);
        $tanggal = $request->tanggal_sertifikat ?: date('Y-m-d');

        // Data untuk PDF
        $data = [
            'namaSiswa' => $nilaiPkl->magang->nama_siswa,
            'nilaiAkhir' => $nilaiPkl->nilai_akhir,
            'nomorSertifikat' => $nomor,
            'tanggalSertifikat' => $tanggal,
            'unitMagang' => optional($nilaiPkl->magang->sk_magang->unit_magang)->nama_unitmagang ?? '-',
            'tglMasuk' => Carbon::parse($nilaiPkl->magang->tgl_masuk)->locale('id')->translatedFormat('d F Y'),
            'tglKeluar' => Carbon::parse($nilaiPkl->magang->tgl_akhir)->locale('id')->translatedFormat('d F Y'),
        ];

        // Generate PDF dari view
        $pdf = PDF::loadView('sertifikat.template', $data)->setPaper('a4', 'landscape');

        // Nama file unik
        $fileName = 'sertifikat_' . $nilaiPkl->id . '_' . time() . '.pdf';

        // Simpan file PDF ke storage/app/public/sertifikat_pkl
        Storage::disk('public')->put('sertifikat_pkl/' . $fileName, $pdf->output());

        // Simpan data sertifikat ke database
        Sertifikat::create([
            'id_nilai_pkl' => $nilaiPkl->id,
            'nomor_sertifikat' => $nomor,
            'tanggal_sertifikat' => $tanggal,
            'file_sertifikat' => $fileName,
        ]);

        return redirect()->route('admin.sertifikat.index')->with('success', 'Sertifikat berhasil dibuat dan file PDF telah disimpan.');
    }

    /**
     * Edit sertifikat
     */
    public function edit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        return view('sertifikat.edit', compact('sertifikat'));
    }

    /**
     * Update sertifikat
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_sertifikat' => 'nullable|string|max:255',
            'tanggal_sertifikat' => 'required|date',
        ]);

        $sertifikat = Sertifikat::with('nilaiPkl.magang', 'nilaiPkl.unit_magang')->findOrFail($id);

        // update data utama dulu
        $sertifikat->update([
            'nomor_sertifikat' => $request->nomor_sertifikat ?: $sertifikat->nomor_sertifikat,
            'tanggal_sertifikat' => $request->tanggal_sertifikat,
        ]);

        // siapkan data terbaru untuk PDF
        $data = [
            'namaSiswa' => $sertifikat->nilaiPkl->magang->nama_siswa,
            'nilaiAkhir' => $sertifikat->nilaiPkl->nilai_akhir,
            'nomorSertifikat' => $sertifikat->nomor_sertifikat,
            'tanggalSertifikat' => $sertifikat->tanggal_sertifikat,
            'unitMagang' => optional($sertifikat->nilaiPkl->unit_magang)->nama_unitmagang ?? '-',
            'tglMasuk' => Carbon::parse($sertifikat->nilaiPkl->magang->tgl_masuk)->locale('id')->translatedFormat('d F Y'),
            'tglKeluar' => Carbon::parse($sertifikat->nilaiPkl->magang->tgl_akhir)->locale('id')->translatedFormat('d F Y'),
        ];

        // generate ulang PDF
        $pdf = Pdf::loadView('sertifikat.template', $data)->setPaper('a4', 'landscape');
        $fileName = 'sertifikat_' . $sertifikat->id . '_' . time() . '.pdf';

        // simpan file PDF baru
        Storage::disk('public')->put('sertifikat_pkl/' . $fileName, $pdf->output());

        // hapus file lama
        if ($sertifikat->file_sertifikat && Storage::disk('public')->exists('sertifikat_pkl/' . $sertifikat->file_sertifikat)) {
            Storage::disk('public')->delete('sertifikat_pkl/' . $sertifikat->file_sertifikat);
        }

        // update nama file di database
        $sertifikat->update([
            'file_sertifikat' => $fileName,
        ]);


        return redirect()->route('admin.sertifikat.index')
            ->with('success', 'Sertifikat berhasil diperbarui & file PDF diperbarui.');
    }



    /**
     * Hapus sertifikat
     */
    /**
     * Hapus sertifikat
     */
    public function destroy($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);

        // hapus file PDF dari storage jika ada
        if ($sertifikat->file_sertifikat && Storage::disk('public')->exists('sertifikat_pkl/' . $sertifikat->file_sertifikat)) {
            Storage::disk('public')->delete('sertifikat_pkl/' . $sertifikat->file_sertifikat);
        }

        // hapus record dari database
        $sertifikat->delete();

        return redirect()->route('admin.sertifikat.index')
            ->with('success', 'Sertifikat berhasil dihapus beserta file PDF-nya.');
    }


    /**
     * Download sertifikat PDF
     */
    public function downloadSertifikat($id)
    {
        $sertifikat = Sertifikat::with('nilaiPkl.magang', 'nilaiPkl.unit_magang')->findOrFail($id);

        $pdf = Pdf::loadView('sertifikat.template', [
            'namaSiswa' => $sertifikat->nilaiPkl->magang->nama_siswa,
            'nilaiAkhir' => $sertifikat->nilaiPkl->nilai_akhir,
            'nomorSertifikat' => $sertifikat->nomor_sertifikat,
            'tanggalSertifikat' => $sertifikat->tanggal_sertifikat,
            'unitMagang' => $sertifikat->nilaiPkl->unit_magang->nama_unitmagang,
            'tglMasuk' => $sertifikat->nilaiPkl->magang->tgl_masuk,
            'tglKeluar' => $sertifikat->nilaiPkl->magang->tgl_akhir,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('sertifikat-' . $sertifikat->nomor_sertifikat . '.pdf');
    }
}
