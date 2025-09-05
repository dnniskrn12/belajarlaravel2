<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sk_Magang;
use App\Models\Magang;
use App\Models\Unit_Magang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SkMagangController extends Controller
{
    /**
     * Tampilkan daftar semua SK Magang
     */
    public function index()
    {
        $sk = Sk_Magang::with(['magang', 'unit_magang'])->get();
        return view('skmagang.index', compact('sk'));
    }

    /**
     * Form tambah SK Magang
     */
    public function create()
    {
        $magang = Magang::all();
        $unitmagang = Unit_Magang::all();

        return view('skmagang.create', compact('magang', 'unitmagang'));
    }

    /**
     * Simpan SK Magang baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_sk' => 'required|unique:sk_magang,no_sk',
            'no_magang' => 'required|exists:magang,no_magang',
            'id_unitmagang' => 'required|exists:unit_magang,id',
            'tgl_sk' => 'required|date',
        ]);

        $magang = Magang::where('no_magang', $request->no_magang)->first();

        Sk_Magang::create([
            'no_sk' => $request->no_sk,
            'no_magang' => $request->no_magang,
            'nama_siswa' => $magang->nama_siswa,
            'id_unitmagang' => $request->id_unitmagang,
            'tgl_sk' => $request->tgl_sk,
        ]);

        return redirect()->route('admin.sksiswa.index')
            ->with('success', 'Data SK Magang berhasil ditambahkan.');
    }

    /**
     * Form edit SK Magang
     */
    public function edit($id)
    {
        $sk = Sk_Magang::findOrFail($id);
        $magang = Magang::all();
        $unitmagang = Unit_Magang::all();

        return view('skmagang.edit', compact('sk', 'magang', 'unitmagang'));
    }

    /**
     * Update data SK Magang
     */
    public function update(Request $request, $id)
    {
        $sk = Sk_Magang::findOrFail($id);

        $request->validate([
            'no_sk' => 'required|unique:sk_magang,no_sk,' . $sk->id,
            'id_unitmagang' => 'required|exists:unit_magang,id',
            'tgl_sk' => 'required|date',
        ]);

        // Ambil data magang lama dari $sk
        $magang = $sk->magang; // pakai relasi

        $sk->update([
            'no_sk' => $request->no_sk,
            'no_magang' => $sk->no_magang, // tetap pakai yang lama
            'nama_siswa' => $magang?->nama_siswa, // ambil dari relasi
            'id_unitmagang' => $request->id_unitmagang,
            'tgl_sk' => $request->tgl_sk,
        ]);

        return redirect()->route('admin.sksiswa.index')
            ->with('success', 'Data SK Magang berhasil diperbarui.');
    }


    /**
     * Hapus data SK Magang
     */
    public function destroy($id)
    {
        $sk = Sk_Magang::findOrFail($id);
        $sk->delete();

        return redirect()->route('admin.sksiswa.index')
            ->with('success', 'Data SK Magang berhasil dihapus.');
    }

 // Tampilan PImpinan
    public function indexPimpinan()
    {
        $sk = Sk_Magang::all();
        return view('pimpinan.skmagang.index', compact('sk'));
    }
    public function showPimpinan(string $id)
    {
        $sk = Sk_Magang::findOrFail($id);
        return view('pimpinan.skmagang.show', compact('sk'));
    }

    // Cetak semua skmagang
    public function cetakSemua()
    {
        $sk = Sk_Magang::all();

        $pdf = Pdf::loadView('pimpinan.skmagang.laporan', compact('sk'))
            ->setPaper('a4', 'landscape');

        // kembalikan path untuk modal
        return $pdf->stream('laporan-skmagang.pdf');
    }

    // Cetak 1 skmagang (biodata)
    public function cetakSatu($id)
    {
        $sk = Sk_Magang::findOrFail($id);

        $pdf = Pdf::loadView('pimpinan.skmagang.surat', compact('sk'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('biodata-skmagang-' . $sk->id . '.pdf');
    }
}
