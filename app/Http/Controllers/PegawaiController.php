<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Jenjang;
use App\Models\Pend_Pegawai;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
        Log::info('Isi Request Pendidikan:', $request->pendidikan ?? []);

        // cek semua request
        Log::info('Isi Request Pegawai:', $request->all());
        // Simpan data pegawai
        $pegawai = Pegawai::create($request->only([
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
            'tgl_masuk',
            'tgl_akhir',
            'foto',
        ]));

        dd($request->nama_pend);
        // Simpan data pendidikan
        if ($request->has('pendidikan')) {
            foreach ($request->pendidikan as $pendidikan) {
                if (!empty($pendidikan['id_jjg']) || !empty($pendidikan['nama_pend']) || !empty($pendidikan['thn_pend'])) {
                    Pend_Pegawai::create([
                        'no_pegawai' => $pegawai->no_pegawai,  // pakai no_pegawai
                        'id_jjg' => $pendidikan['id_jjg'] ?? null,
                        'nama_pend' => $pendidikan['nama_pend'] ?? null,
                        'thn_pend' => $pendidikan['thn_pend'] ?? null,
                    ]);
                }
            }
        }



        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan');
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
            'tgl_akhir' => 'nullable',

            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
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
