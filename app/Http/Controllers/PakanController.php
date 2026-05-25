<?php

namespace App\Http\Controllers;

use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanController extends Controller
{
    public function index()
    {
        $pakan = Pakan::orderBy('created_at', 'desc')->paginate(10);
        return view('peternak.pakan.index', compact('pakan'));
    }

    public function create()
    {
        return view('peternak.pakan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pakan' => 'required',
            'stok' => 'required|numeric|min:0',
            'satuan' => 'required',
        ], [
            'nama_pakan.required' => 'Nama pakan wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.numeric' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
            'satuan.required' => 'Satuan wajib dipilih.',
        ]);

        Pakan::create([
            'nama_pakan' => $request->nama_pakan,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'tanggal_pemberian' => $request->tanggal_pemberian ?? now(),
            'keterangan' => $request->keterangan,
        ]);

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Data pakan berhasil ditambahkan!');
        }

        return redirect()->route('pakan.index')->with('success', 'Data pakan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pakan = Pakan::findOrFail($id);
        return view('peternak.pakan.edit', compact('pakan'));
    }

    public function update(Request $request, $id)
    {
        $pakan = Pakan::findOrFail($id);
        $request->validate([
            'nama_pakan' => 'required',
            'stok' => 'required|numeric|min:0',
            'satuan' => 'required',
        ], [
            'nama_pakan.required' => 'Nama pakan wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.numeric' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
            'satuan.required' => 'Satuan wajib dipilih.',
        ]);

        $pakan->update($request->all());

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Data pakan berhasil diperbarui!');
        }

        return redirect()->route('pakan.index')->with('success', 'Data pakan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pakan = Pakan::findOrFail($id);
        $pakan->delete();
        return redirect()->back()->with('success', 'Data pakan berhasil dihapus!');
    }
}
