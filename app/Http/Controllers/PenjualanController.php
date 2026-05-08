<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'pembeli' => 'required|string',
            'jumlah' => 'required|numeric',
            'harga_satuan' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);

        \App\Models\Penjualan::create($request->all());

        return redirect()->route('penjualan.data')->with('success', 'Transaksi penjualan berhasil disimpan!');
    }

    public function edit($id)
    {
        $item = \App\Models\Penjualan::findOrFail($id);
        return view('penjualan.input-penjualan.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'pembeli' => 'required|string',
            'jumlah' => 'required|numeric',
            'harga_satuan' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);

        $item = \App\Models\Penjualan::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('penjualan.data')->with('success', 'Transaksi penjualan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = \App\Models\Penjualan::findOrFail($id);
        $item->delete();
        return redirect()->route('penjualan.data')->with('success', 'Transaksi penjualan berhasil dihapus!');
    }
}
