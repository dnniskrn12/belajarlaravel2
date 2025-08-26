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
        // Validasi input
        $validated = $request->validate([
            'no_pegawai' => 'required|string|max:50|unique:pegawai,no_pegawai',
            'nama_pegawai' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'agama' => 'required|in:Islam,Kristen Protestan,Katholik,Hindu,Budha,Konghucu',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'status_kwn' => 'required|string',
            'status_pekerjaan' => 'required|string',
            'tgl_masuk' => 'required|date',
            'tgl_akhir' => 'nullable|date',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan data pegawai
        $pegawai = Pegawai::create($validated);

        // Simpan data pendidikan
        if ($request->has('pendidikan')) {
            foreach ($request->pendidikan as $pendidikan) {
                if (!empty($pendidikan['id_jjg']) || !empty($pendidikan['nama_pend']) || !empty($pendidikan['thn_pend'])) {
                    Pend_Pegawai::create([
                        'no_pegawai' => $pegawai->no_pegawai,
                        'id_jjg' => $pendidikan['id_jjg'] ?? null,
                        'nama_pend' => $pendidikan['nama_pend'] ?? null,
                        'thn_pend' => $pendidikan['thn_pend'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan');
    }




    public function show(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.show', compact('pegawai'));
    }


    public function edit(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->load('pend_pegawai');
        $jenjang = Jenjang::all();

        return view('pegawai.edit', compact('pegawai', 'jenjang'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        // update data pegawai
        $pegawai->update($request->except(['pendidikan', 'foto']));

        // handle foto baru
        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('foto_pegawai', $fotoName, 'public');

            // hapus foto lama kalau ada
            if ($pegawai->foto) {
                Storage::disk('public')->delete('foto_pegawai/' . $pegawai->foto);
            }

            $pegawai->foto = $fotoName;
            $pegawai->save();
        }

        // handle pendidikan (hapus lama, simpan baru)
        if ($request->has('pendidikan')) {
            // hapus riwayat lama
            $pegawai->pend_pegawai()->delete();

            // simpan ulang
            foreach ($request->pendidikan as $pend) {
                $pegawai->pend_pegawai()->create($pend);
            }
        }

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
