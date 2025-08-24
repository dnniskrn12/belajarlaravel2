<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Jenjang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        $jenjang = Jenjang::all();

        return view('pegawai.create', compact('jenjang'));
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'no_pegawai' => 'required|unique:pegawai,no_pegawai',
        'nama_pegawai' => 'required',
        'tempat_lahir' => 'required',
        'tgl_lahir' => 'required|date',
        'jenis_kelamin' => 'required',
        'alamat' => 'required',
        'agama' => 'required',
        'no_hp' => 'nullable',
        'email' => 'nullable|email',
        'status_kwn' => 'nullable',
        'status_pekerjaan' => 'nullable',
        'tgl_masuk' => 'required|date',
        'tgl_akhir' => 'nullable',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'pendidikan.*.id_jjg' => 'required',
        'pendidikan.*.nama_pend' => 'required',
        'pendidikan.*.thn_pend' => 'required|integer',
    ]);

    // Simpan file foto jika ada
    $fileName = null;
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('foto_pegawai', $foto, $fileName);
    }

    // Simpan data pegawai dulu
    $pegawaiData = $request->only([
        'no_pegawai',
        'nama_pegawai',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'agama',
        'no_hp',
        'email',
        'status_kwn',
        'status_pekerjaan',
        'tgl_masuk'
    ]);
    $pegawaiData['foto'] = $fileName;

    // Buat pegawai baru
    $pegawai = Pegawai::create($pegawaiData);

    // Simpan data pendidikan terkait
    if ($request->has('pendidikan')) {
    foreach ($request->pendidikan as $pend) {
        $pegawai->pend_pegawai()->create([
            'id_jjg' => $pend['id_jjg'],
            'nama_pend' => $pend['nama_pend'],
            'thn_pend' => $pend['thn_pend'],
        ]);
    }
}


    return redirect()->route('pegawai.index')
        ->with('success', 'Data pegawai berhasil ditambahkan!');
}


    public function show(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.show', compact('pegawai'));
    }


    public function edit(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $jenjang = Jenjang::all();
        return view('pegawai.edit', compact('pegawai', 'jenjang'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Validasi input
        $request->validate([
            'no_pegawai' => [
                'required',
                Rule::unique('pegawai', 'no_pegawai')->ignore($pegawai->no_pegawai, 'no_pegawai')
            ],
            'nama_pegawai' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'no_hp' => 'nullable',
            'email' => 'nullable|email',
            'status_kwn' => 'nullable',
            'status_pekerjaan' => 'nullable',
            'tgl_masuk' => 'required|date',
            'tgl_akhir'=>'nullable',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle foto
        $fileName = $pegawai->foto;
        $foto = $request->file('foto');
        if ($foto) {
            $fileName = Str::uuid() . '.' . $foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto_pegawai', $foto, $fileName);
        }

        // Ambil semua input dan tambahkan nama file foto
        $newRequest = $request->all();
        $newRequest['foto'] = $fileName;

        $pegawai->update($newRequest);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }


    public function destroy(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Hapus foto jika ada
        if ($pegawai->foto && Storage::disk('public')->exists('foto_pegawai/' . $pegawai->foto)) {
            Storage::disk('public')->delete('foto_pegawai/' . $pegawai->foto);
        }

        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data Pegawai berhasil dihapus');
    }
}
