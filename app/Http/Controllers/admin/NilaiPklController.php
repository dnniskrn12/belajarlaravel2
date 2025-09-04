<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NilaiPKL;
use App\Models\Magang;
use App\Models\Sertifikat;
use Illuminate\Http\Request;

class NilaiPKLController extends Controller
{
    /**
     * Daftar nilai PKL
     */
    public function index()
    {
        $nilaiPkl = NilaiPkl::all();
        $nilaiPkl = NilaiPKL::with('magang')->get();
        return view('nilaipkl.index', compact('nilaiPkl'));
    }

    /**
     * Form tambah nilai
     */
    public function create()
    {
        $magang = Magang::all();
        return view('nilaipkl.create', compact('magang'));
    }

    /**
     * Simpan nilai baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_magang' => 'required|exists:magang,no_magang',
            'nilai_pkl' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string',
            'file_scan_nilai' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $filePath = null;
        if ($request->hasFile('file_scan_nilai')) {
            $file = $request->file('file_scan_nilai');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('scan_nilai_pkl', $filename, 'public');
            $filePath = $filename;  // simpan nama file ke $filePath
        }

        NilaiPKL::create([
            'no_magang' => $request->no_magang,
            'nilai_akhir' => $request->nilai_pkl,
            'catatan' => $request->catatan,
            'file_scan_nilai' => $filePath,
        ]);


        return redirect()->route('admin.nilaipkl.index')
            ->with('success', 'Data nilai Magang berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai_pkl' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string',
            'file_scan_nilai' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $nilai = NilaiPKL::findOrFail($id);

        $filePath = $nilai->file_scan_nilai;
        if ($request->hasFile('file_scan_nilai')) {
            $file = $request->file('file_scan_nilai');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('scan_nilai_pkl', $filename, 'public');
            $filePath = $filename;  // simpan nama file ke $filePath
        }


        $nilai->update([
            'nilai_akhir' => $request->nilai_pkl,
            'catatan' => $request->catatan,
            'file_scan_nilai' => $filePath,
        ]);

        return redirect()->route('admin.nilaipkl.index')
            ->with('success', 'Data nilai Magang berhasil diperbarui.');
    }


    /**
     * Form edit nilai
     */
    public function edit($id)
    {
        $nilai = NilaiPKL::findOrFail($id);
        $magang = Magang::all();
        return view('nilaipkl.edit', compact('nilai', 'magang'));
    }


    /**
     * Hapus nilai
     */
    public function destroy($id)
    {
        $nilai = NilaiPKL::findOrFail($id);
        $nilai->delete();

        return redirect()->route('admin.nilaipkl.index')
            ->with('success', 'Data nilai Magang berhasil dihapus.');
    }

    public function download($filename)
    {
        $path = storage_path('app/scan_nilai_pkl/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

}
