<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::all();
        return view('superadmin.lokasi.index', compact('lokasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_lokasi'   => 'required|unique:lokasi,id_lokasi',
            'nama_lokasi' => 'required|string|max:255',
            'alamat'      => 'required|string',
            'no_hp'       => 'required|string|max:20',
        ]);

        Lokasi::create($request->all());
        return redirect()->route('superadmin.lokasi.index')->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $request->validate([
            'id_lokasi'   => 'required|unique:lokasi,id_lokasi,' . $lokasi->id,
            'nama_lokasi' => 'required|string|max:255',
            'alamat'      => 'required|string',
            'no_hp'       => 'required|string|max:20',
        ]);

        $lokasi->update($request->all());
        return redirect()->route('superadmin.lokasi.index')->with('success', 'Lokasi berhasil diperbarui');
    }

    public function edit(Lokasi $lokasi)
    {
        return view('superadmin.lokasi.edit', compact('lokasi'));
    }

    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();
        return redirect()->route('superadmin.lokasi.index')->with('success', 'Lokasi berhasil dihapus');
    }
}
