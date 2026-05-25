<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sapi;

class SapiController extends Controller
{
    public function index()
    {
        $sapi = Sapi::paginate(10);
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
            'jenis' => 'required'
        ], [
            'kode_sapi.required' => 'ID Sapi wajib diisi.',
            'kode_sapi.unique' => 'ID Sapi sudah terdaftar.',
            'nama.required' => 'Nama Sapi wajib diisi.',
            'jenis.required' => 'Jenis Sapi wajib diisi.'
        ]);

        Sapi::create([
            'kode_sapi' => $request->kode_sapi,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'berat' => $request->berat,
            'status_kesehatan' => 'Sehat',
            'ayah' => $request->ayah,
            'ibu' => $request->ibu
        ]);

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Data sapi berhasil ditambahkan!');
        }

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
            'jenis' => 'required'
        ], [
            'kode_sapi.required' => 'ID Sapi wajib diisi.',
            'kode_sapi.unique' => 'ID Sapi sudah terdaftar.',
            'nama.required' => 'Nama Sapi wajib diisi.',
            'jenis.required' => 'Jenis Sapi wajib diisi.'
        ]);

        $sapi->update([
            'kode_sapi' => $request->kode_sapi,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'berat' => $request->berat,
            'ayah' => $request->ayah,
            'ibu' => $request->ibu
        ]);

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Data sapi berhasil diperbarui!');
        }

        return redirect()->route('sapi.index')->with('success', 'Data sapi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $sapi = Sapi::findOrFail($id);
        $sapi->delete();
        return redirect()->route('sapi.index')->with('success', 'Data sapi berhasil dihapus!');
    }
}
