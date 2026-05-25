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
            'jumlah' => 'required|numeric|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
        ], [
            'tanggal.required' => 'Tanggal transaksi wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'pembeli.required' => 'Nama pembeli wajib diisi.',
            'jumlah.required' => 'Jumlah (liter) wajib diisi.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh kurang dari 0.',
            'harga_satuan.required' => 'Harga satuan wajib diisi.',
            'harga_satuan.numeric' => 'Harga satuan harus berupa angka.',
            'harga_satuan.min' => 'Harga satuan tidak boleh kurang dari 0.',
            'total_harga.required' => 'Total harga wajib diisi.',
            'total_harga.numeric' => 'Total harga harus berupa angka.',
            'total_harga.min' => 'Total harga tidak boleh kurang dari 0.',
        ]);

        \App\Models\Penjualan::create($request->all());

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Transaksi penjualan berhasil disimpan!');
        }

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
            'jumlah' => 'required|numeric|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
        ], [
            'tanggal.required' => 'Tanggal transaksi wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'pembeli.required' => 'Nama pembeli wajib diisi.',
            'jumlah.required' => 'Jumlah (liter) wajib diisi.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh kurang dari 0.',
            'harga_satuan.required' => 'Harga satuan wajib diisi.',
            'harga_satuan.numeric' => 'Harga satuan harus berupa angka.',
            'harga_satuan.min' => 'Harga satuan tidak boleh kurang dari 0.',
            'total_harga.required' => 'Total harga wajib diisi.',
            'total_harga.numeric' => 'Total harga harus berupa angka.',
            'total_harga.min' => 'Total harga tidak boleh kurang dari 0.',
        ]);

        $item = \App\Models\Penjualan::findOrFail($id);
        $item->update($request->all());

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Transaksi penjualan berhasil diperbarui!');
        }

        return redirect()->route('penjualan.data')->with('success', 'Transaksi penjualan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = \App\Models\Penjualan::findOrFail($id);
        $item->delete();
        return redirect()->route('penjualan.data')->with('success', 'Transaksi penjualan berhasil dihapus!');
    }
}
