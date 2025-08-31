<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit_Kerja;

class UnitKerjaController extends Controller
{
    public function index()
    {
        $unitkerja = Unit_Kerja::all();
        return view('superadmin.unit_kerja.index', compact('unitkerja'));
    }

    public function create()
    {
        return view('superadmin.unit_kerja');
    }

    public function store(Request $request)
{
    $request->validate([
        'id_unitkerja' => 'required|unique:unit_kerja,id_unitkerja',
        'nama_unitkerja' => 'required|string|max:255',
    ]);

    $unitkerja = Unit_Kerja::create([
        'id_unitkerja' => $request->id_unitkerja,
        'nama_unitkerja' => $request->nama_unitkerja,
    ]);

    return redirect()->route('superadmin.unitkerja.index')->with('success', 'Unit Kerja berhasil ditambahkan');
}

public function update(Request $request, $id)
{
    $unitkerja = Unit_Kerja::findOrFail($id);

    $request->validate([
        'id_unitkerja' => 'required|unique:unit_kerja,id_unitkerja,' . $unitkerja->id,
        'nama_unitkerja' => 'required|string|max:255',
    ]);

    $unitkerja->update([
        'id_unitkerja' => $request->id_unitkerja,
        'nama_unitkerja' => $request->nama_unitkerja,
    ]);

    return redirect()->route('superadmin.unitkerja.index')->with('success', 'Unit Kerja berhasil diperbarui');
}


    public function edit(Unit_Kerja $unitkerja)
    {
        return view('superadmin.unit_kerja.edit', compact('unitkerja'));
    }




    public function destroy(Unit_Kerja $unitkerja)
    {
        $unitkerja->delete();
        return redirect()->route('superadmin.unitkerja.index')->with('success', 'Unit Kerja berhasil dihapus');
    }
}
