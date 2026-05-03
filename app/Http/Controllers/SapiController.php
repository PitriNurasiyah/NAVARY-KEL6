<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sapi;

class SapiController extends Controller
{
    public function index()
    {
        $sapi = Sapi::all();
        return view('biodatasapi.biodata_sapi', compact('sapi'));
    }

    public function create()
    {
        return view('biodatasapi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_sapi' => 'required|unique:biodata_sapi',
            'nama' => 'required',
            'jenis' => 'required',
            'status_kesehatan' => 'required'
        ]);

        Sapi::create([
            'kode_sapi' => $request->kode_sapi,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur ?? 0,
            'berat' => $request->berat,
            'status_kesehatan' => $request->status_kesehatan
        ]);

        return redirect()->route('sapi.index')->with('success', 'Data sapi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $sapi = Sapi::findOrFail($id);
        return view('biodatasapi.edit', compact('sapi'));
    }

    public function update(Request $request, $id)
    {
        $sapi = Sapi::findOrFail($id);
        $request->validate([
            'kode_sapi' => 'required|unique:biodata_sapi,kode_sapi,'.$sapi->id,
            'nama' => 'required',
            'jenis' => 'required',
            'status_kesehatan' => 'required'
        ]);

        $sapi->update([
            'kode_sapi' => $request->kode_sapi,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur ?? 0,
            'berat' => $request->berat,
            'status_kesehatan' => $request->status_kesehatan
        ]);

        return redirect()->route('sapi.index')->with('success', 'Data sapi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $sapi = Sapi::findOrFail($id);
        $sapi->delete();
        return redirect()->route('sapi.index')->with('success', 'Data sapi berhasil dihapus!');
    }
}
