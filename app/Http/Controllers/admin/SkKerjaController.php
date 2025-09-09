<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sk_Kerja;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Unit_Kerja;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SkKerjaController extends Controller
{
    /**
     * Tampilkan daftar semua SK Kerja
     */
    public function index()
    {
        $sk = Sk_Kerja::with(['pegawai', 'jabatan', 'unitkerja', 'lokasi'])->get();
        return view('skkerja.index', compact('sk'));
    }

    /**
     * Form tambah SK Kerja
     */
    public function create()
    {
        $pegawai   = Pegawai::all();
        $jabatan   = Jabatan::all();
        $unitkerja = Unit_Kerja::all();
        $lokasi    = Lokasi::all();

        return view('skkerja.create', compact('pegawai', 'jabatan', 'unitkerja', 'lokasi'));
    }

    /**
     * Simpan SK Kerja baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_sk'        => 'required|unique:sk_kerja,no_sk',
            'no_pegawai'   => 'required|exists:pegawai,no_pegawai',
            'id_jabatan'   => 'required|exists:jabatan,id',
            'id_unitkerja' => 'required|exists:unit_kerja,id',
            'id_lokasi'    => 'required|exists:lokasi,id',
            'tgl_sk'       => 'required|date',
        ]);

        $pegawai = Pegawai::where('no_pegawai', $request->no_pegawai)->first();

          Sk_Kerja::create([
        'no_sk'        => $request->no_sk,
        'no_pegawai'   => $request->no_pegawai,
        'nama_pegawai' => $pegawai->nama_pegawai, // isi otomatis
        'id_jabatan'   => $request->id_jabatan,
        'id_unitkerja' => $request->id_unitkerja,
        'id_lokasi'    => $request->id_lokasi,
        'tgl_sk'       => $request->tgl_sk,
    ]);

        return redirect()->route('admin.skkerja.index')
            ->with('success', 'Data SK Kerja berhasil ditambahkan.');
    }

    /**
     * Form edit SK Kerja
     */
    public function edit($id)
    {
        $sk        = Sk_Kerja::findOrFail($id);
        $pegawai   = Pegawai::all();
        $jabatan   = Jabatan::all();
        $unitkerja = Unit_Kerja::all();
        $lokasi    = Lokasi::all();

        return view('skkerja.edit', compact('sk', 'pegawai', 'jabatan', 'unitkerja', 'lokasi'));
    }

    /**
     * Update data SK Kerja
     */
    public function update(Request $request, $id)
    {
        $sk = Sk_Kerja::findOrFail($id);

        $request->validate([
            'no_sk'        => 'required|unique:sk_kerja,no_sk,' . $sk->id,
            'id_jabatan'   => 'required|exists:jabatan,id',
            'id_unitkerja' => 'required|exists:unit_kerja,id',
            'id_lokasi'    => 'required|exists:lokasi,id',
            'tgl_sk'       => 'required|date',
        ]);

        $sk->update($request->all());

        return redirect()->route('admin.skkerja.index')
            ->with('success', 'Data SK Kerja berhasil diperbarui.');
    }

    /**
     * Hapus data SK Kerja
     */
    public function destroy($id)
    {
        $sk = Sk_Kerja::findOrFail($id);
        $sk->delete();

        return redirect()->route('admin.skkerja.index')
            ->with('success', 'Data SK Kerja berhasil dihapus.');
    }

    // Tampilan PImpinan
    public function indexPimpinan()
    {
        $sk = Sk_Kerja::all();
        return view('pimpinan.skkerja.index', compact('sk'));
    }
    public function showPimpinan(string $id)
    {
        $sk = Sk_Kerja::findOrFail($id);
        return view('pimpinan.skkerja.show', compact('sk'));
    }

    // Cetak semua skkerja
    public function cetakSemua()
    {
        $sk = Sk_Kerja::all();

        $pdf = Pdf::loadView('pimpinan.skkerja.laporan', compact('sk'))
            ->setPaper('a4', 'landscape');

        // kembalikan path untuk modal
        return $pdf->stream('laporan-skkerja.pdf');
    }

    // Cetak 1 skkerja (biodata)
    public function cetakSatu($id)
    {
        $sk = Sk_Kerja::findOrFail($id);

        $pdf = Pdf::loadView('pimpinan.skkerja.surat', compact('sk'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('biodata-skkerja-' . $sk->id . '.pdf');
    }
}
