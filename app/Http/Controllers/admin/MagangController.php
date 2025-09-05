<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magang;
use App\Models\Jenjang;
use App\Models\Pend_Magang;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class MagangController extends Controller
{
    // Tampilkan daftar magang
    public function index()
    {
        $magang = Magang::with('pend_magang')->get();
        return view('magang.index', compact('magang'));
    }

    // Tampilkan form tambah magang
    public function create()
    {
        $jenjang = Jenjang::all();
        return view('magang.create', compact('jenjang'));
    }

    // Simpan data magang baru
    public function store(Request $request)
    {
        $request->validate([
            'no_magang'     => 'required|unique:magang,no_magang',
            'nama_siswa'   => 'required|string|max:255',
            'tempat_lahir'  => 'required|string|max:100',
            'tgl_lahir'     => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama'         => 'required|in:Islam,Kristen Protestan,Katholik,Hindu,Budha,Konghucu',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
            'email'         => 'required|email|max:100',
            'status_magang' => 'required|string',
            'tgl_masuk'     => 'required|date',
            'tgl_akhir'     => 'nullable|date',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $magangData = $request->except('pendidikan');

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $magangData['foto'] = $request->file('foto')->store('foto_magang', 'public');
        }

        // Simpan magang
        $magang = Magang::create($magangData);

        // Simpan pendidikan
        if ($request->has('pendidikan')) {
            foreach ($request->pendidikan as $pend) {
                if (!empty($pend['id_jjg']) || !empty($pend['nama_pend']) || !empty($pend['thn_pend'])) {
                    $magang->pend_magang()->create([
                        'id_jjg'    => $pend['id_jjg'] ?? null,
                        'nama_pend' => $pend['nama_pend'] ?? null,
                        'thn_pend'  => $pend['thn_pend'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('admin.magang.index')
            ->with('success', 'Data magang berhasil ditambahkan');
    }

    // Tampilkan detail magang
    public function show($id)
    {
        $magang = Magang::with('pend_magang')->findOrFail($id);
        return view('magang.show', compact('magang'));
    }

    // Tampilkan form edit magang
    public function edit($id)
    {
        $magang = Magang::with('pend_magang')->findOrFail($id);
        $jenjang = Jenjang::all();
        return view('magang.edit', compact('magang', 'jenjang'));
    }

    // Update data magang
    public function update(Request $request, $id)
    {
        $magang = Magang::findOrFail($id);

        $request->validate([
            'nama_siswa'   => 'required|string|max:255',
            'tempat_lahir'  => 'required|string|max:100',
            'tgl_lahir'     => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama'         => 'required|in:Islam,Kristen Protestan,Katholik,Hindu,Budha,Konghucu',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:20',
            'email'         => 'required|email|max:100',
            'status_magang' => 'required|string',
            'tgl_masuk'     => 'required|date',
            'tgl_akhir'     => 'nullable|date',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $magangData = $request->except('pendidikan', 'foto');

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            if ($magang->foto && Storage::disk('public')->exists($magang->foto)) {
                Storage::disk('public')->delete($magang->foto);
            }
            $magangData['foto'] = $request->file('foto')->store('foto_magang', 'public');
        }

        $magang->update($magangData);

        // Update pendidikan
        if ($request->has('pendidikan')) {
            $magang->pend_magang()->delete();
            foreach ($request->pendidikan as $pend) {
                if (!empty($pend['id_jjg']) || !empty($pend['nama_pend']) || !empty($pend['thn_pend'])) {
                    $magang->pend_magang()->create([
                        'id_jjg'    => $pend['id_jjg'] ?? null,
                        'nama_pend' => $pend['nama_pend'] ?? null,
                        'thn_pend'  => $pend['thn_pend'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('admin.magang.index')
            ->with('success', 'Data magang berhasil diperbarui');
    }

    // Hapus magang
    public function destroy($id)
    {
        $magang = Magang::findOrFail($id);

        if ($magang->foto && Storage::disk('public')->exists($magang->foto)) {
            Storage::disk('public')->delete($magang->foto);
        }

        $magang->delete();

        return redirect()->route('admin.magang.index')
            ->with('success', 'Data magang berhasil dihapus');
    }

    // Tampilan PImpinan
    public function indexPimpinan()
    {
        $magang = Magang::all();
        return view('pimpinan.magang.index', compact('magang'));
    }
    public function showPimpinan(string $id)
    {
        $magang = Magang::findOrFail($id);
        return view('pimpinan.magang.show', compact('magang'));
    }

    // Cetak semua magang
    public function cetakSemua()
    {
        $magang = Magang::all();

        $pdf = Pdf::loadView('pimpinan.magang.laporan', compact('magang'))
            ->setPaper('a4', 'landscape');


        // kembalikan path untuk modal
        return $pdf->stream('laporan-magang.pdf');
    }

    // Cetak 1 magang (biodata)
    public function cetakSatu($id)
{
    $magang = Magang::findOrFail($id);

    $pdf = Pdf::loadView('pimpinan.magang.biodata', compact('magang'))
        ->setPaper('A4', 'portrait');

    return $pdf->stream('biodata-magang-' . $magang->id . '.pdf');
}


}
