<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabatan;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::all();
        return view('superadmin.jabatan.index', compact('jabatan'));
    }

    public function create()
    {
        return view('superadmin.jabatan.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'id_jabatan' => 'required|unique:jabatan,id_jabatan',
        'nama_jabatan' => 'required|string|max:255',
    ]);

    $jabatan = Jabatan::create([
        'id_jabatan' => $request->id_jabatan,
        'nama_jabatan' => $request->nama_jabatan,
    ]);

    return redirect()->route('superadmin.jabatan.index')->with('success', 'Jabatan berhasil ditambahkan');
}

public function update(Request $request, $id)
{
    $jabatan = Jabatan::findOrFail($id);

    $request->validate([
        'id_jabatan' => 'required|unique:jabatan,id_jabatan,' . $jabatan->id,
        'nama_jabatan' => 'required|string|max:255',
    ]);

    $jabatan->update([
        'id_jabatan' => $request->id_jabatan,
        'nama_jabatan' => $request->nama_jabatan,
    ]);

    return redirect()->route('superadmin.jabatan.index')->with('success', 'Jabatan berhasil diperbarui');
}


    public function edit(Jabatan $jabatan)
    {
        return view('superadmin.jabatan.edit', compact('jabatan'));
    }




    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();
        return redirect()->route('superadmin.jabatan.index')->with('success', 'Jabatan berhasil dihapus');
    }
}
