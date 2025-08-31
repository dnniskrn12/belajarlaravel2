<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit_Magang;

class UnitMagangController extends Controller
{
    public function index()
    {
        $unitmagang = Unit_Magang::all();
        $total = Unit_Magang::count();

        return view('superadmin.unit_magang.index', compact('unitmagang', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_unitmagang' => 'required|unique:unit_magang,id_unitmagang',
            'nama_unitmagang' => 'required|string|max:255',
        ]);

        Unit_Magang::create($request->all());

        return redirect()->back()->with('success', 'Unit magang berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $unitmagang = Unit_Magang::findOrFail($id);
        $request->validate([
            'id_unitmagang' => 'required|unique:unit_magang,id_unitmagang',
            'nama_unitmagang' => 'required|string|max:255',
        ]);

        $unitmagang->update([
        'id_unitmagang' => $request->id_unitmagang,
        'nama_unitmagang' => $request->nama_unitmagang,
    ]);

        return redirect()->back()->with('success', 'Unit magang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $unitmagang = Unit_Magang::findOrFail($id);
        $unitmagang->delete();

        return redirect()->back()->with('success', 'Unit magang berhasil dihapus.');
    }
}
