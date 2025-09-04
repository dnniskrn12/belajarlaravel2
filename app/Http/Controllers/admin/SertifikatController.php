<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use App\Models\NilaiPKL;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    /**
     * Tampilkan semua sertifikat
     */
    public function index()
    {
        $sertifikat = Sertifikat::with('nilaiPkl')->get();
        $sertifikat = Sertifikat::with('magang')->get();
        $totalSertifikat = $sertifikat;
        $bulanIni = now()->month;
        $totalBulanIni = Sertifikat::whereMonth('tanggal_sertifikat', $bulanIni)->count();
        $belumTersertifikat = NilaiPKL::doesntHave('sertifikat')->count();

        return view('sertifikat.index', compact(
            'sertifikat',
            'totalSertifikat',
            'totalBulanIni',
            'belumTersertifikat'
        ));
    }

    /**
     * Form buat sertifikat baru
     */
    public function create()
{
    // Ambil hanya siswa dengan nilai akhir >= 70 dan belum punya sertifikat
    $nilaiPklTersedia = NilaiPKL::with('magang')
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
            'id_nilai_pkl'     => 'required|exists:nilai_pkl,id',
            'nomor_sertifikat' => 'required|string|max:255',
            'tanggal_sertifikat' => 'required|date',
        ]);

        $sertifikat = Sertifikat::create([
            'id_nilai_pkl' => $request->id_nilai_pkl,
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'tanggal_sertifikat' => $request->tanggal_sertifikat,
        ]);

        return redirect()->route('admin.sertifikat.index')
            ->with('success', 'Sertifikat berhasil dibuat.');
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
            'tanggal_sertifikat' => 'required|date',
        ]);

        $sertifikat = Sertifikat::findOrFail($id);
        $sertifikat->update([
            'tanggal_sertifikat' => $request->tanggal_sertifikat,
        ]);

        return redirect()->route('admin.sertifikat.index')
            ->with('success', 'Sertifikat berhasil diperbarui.');
    }

    /**
     * Hapus sertifikat
     */
    public function destroy($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        $sertifikat->delete();

        return redirect()->route('admin.sertifikat.index')
            ->with('success', 'Sertifikat berhasil dihapus.');
    }
}
