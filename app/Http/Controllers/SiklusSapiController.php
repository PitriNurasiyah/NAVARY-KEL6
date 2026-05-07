<?php

namespace App\Http\Controllers;

use App\Models\SiklusSapi;
use App\Models\Sapi;
use Illuminate\Http\Request;

class SiklusSapiController extends Controller
{
    public function index()
    {
        $siklus = SiklusSapi::with('sapi')->orderBy('tanggal_mulai', 'desc')->get();
        $sapi = Sapi::all();
        return view('peternak.siklus.index', compact('siklus', 'sapi'));
    }

    public function create()
    {
        $sapi = Sapi::all();
        return view('peternak.siklus.create', compact('sapi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sapi_id' => 'required|exists:biodata_sapi,id',
            'fase' => 'required',
            'tanggal_mulai' => 'required|date',
            'hari_ke' => 'nullable|integer',
        ]);

        SiklusSapi::create([
            'sapi_id' => $request->sapi_id,
            'fase' => $request->fase,
            'tanggal_mulai' => $request->tanggal_mulai,
            'estimasi_selesai' => $request->estimasi_selesai,
            'hari_ke' => $request->hari_ke ?? 0,
            'status' => $request->status ?? 'Berjalan',
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('siklus.index')->with('success', 'Data siklus berhasil disimpan!');
    }

    public function edit($id)
    {
        $siklus = SiklusSapi::with('sapi')->findOrFail($id);
        return view('peternak.siklus.edit', compact('siklus'));
    }

    public function update(Request $request, $id)
    {
        $siklus = SiklusSapi::findOrFail($id);
        $siklus->update($request->all());

        return redirect()->route('siklus.index')->with('success', 'Data siklus berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $siklus = SiklusSapi::findOrFail($id);
        $siklus->delete();
        return redirect()->route('siklus.index')->with('success', 'Data siklus berhasil dihapus!');
    }
}
