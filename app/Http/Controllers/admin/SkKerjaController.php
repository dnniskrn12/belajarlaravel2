<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sk_Kerja;
use Illuminate\Http\Request;

class SkKerjaController extends Controller
{
    public function index()
    {
        $sk = Sk_Kerja::all();
        return view('skkerja.index', compact('sk'));
    }

    public function create()
    {
        return view('skkerja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_sk'       => 'required|unique:sk_kerja,no_sk',
            'no_pegawai'  => 'required',
            'nama_pegawai'=> 'required|string',
            'tgl_sk'      => 'required|date',
            'id_lokasi'   => 'required',
            'id_unitkerja'=> 'required',
            'id_jabatan'  => 'required',
        ]);

        Sk_Kerja::create($request->all());

        return redirect()->route('admin.skkerja.index')
            ->with('success', 'Data SK Kerja berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sk = Sk_Kerja::findOrFail($id);
        return view('skkerja.edit', compact('sk'));
    }

    public function update(Request $request, $id)
    {
        $sk = Sk_Kerja::findOrFail($id);

        $request->validate([
            'no_sk'       => 'required|unique:sk_kerja,no_sk,'.$sk->id,
            'no_pegawai'  => 'required',
            'nama_pegawai'=> 'required|string',
            'tgl_sk'      => 'required|date',
            'id_lokasi'   => 'required',
            'id_unitkerja'=> 'required',
            'id_jabatan'  => 'required',
        ]);

        $sk->update($request->all());

        return redirect()->route('admin.skkerja.index')
            ->with('success', 'Data SK Kerja berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sk = Sk_Kerja::findOrFail($id);
        $sk->delete();

        return redirect()->route('admin.skkerja.index')
            ->with('success', 'Data SK Kerja berhasil dihapus.');
    }
}

