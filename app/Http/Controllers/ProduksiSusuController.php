<?php

namespace App\Http\Controllers;

use App\Models\ProduksiSusu;
use App\Models\Sapi;
use Illuminate\Http\Request;

class ProduksiSusuController extends Controller
{
    public function index()
    {
        $produksi = ProduksiSusu::with('sapi')->orderBy('tanggal', 'desc')->paginate(10);
        $sapi = Sapi::all();
        
        // Data untuk grafik (Produksi per Sapi hari ini)
        $today = date('Y-m-d');
        $chartData = ProduksiSusu::with('sapi')
            ->where('tanggal', $today)
            ->get();

        return view('peternak.produksi.index', compact('produksi', 'sapi', 'chartData'));
    }

    public function create()
    {
        $sapi = Sapi::all();
        return view('peternak.produksi.create', compact('sapi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sapi_id' => 'required|exists:biodata_sapi,id',
            'tanggal' => 'required|date',
            'jumlah_pagi' => 'required|numeric|min:0',
            'jumlah_sore' => 'required|numeric|min:0',
        ]);

        $total = $request->jumlah_pagi + $request->jumlah_sore;

        ProduksiSusu::create([
            'sapi_id' => $request->sapi_id,
            'tanggal' => $request->tanggal,
            'jumlah_pagi' => $request->jumlah_pagi,
            'jumlah_sore' => $request->jumlah_sore,
            'total' => $total,
        ]);

        return redirect()->route('produksi.index')->with('success', 'Data produksi berhasil disimpan!');
    }

    public function edit($id)
    {
        $produksi = ProduksiSusu::with('sapi')->findOrFail($id);
        return view('peternak.produksi.edit', compact('produksi'));
    }

    public function update(Request $request, $id)
    {
        $produksi = ProduksiSusu::findOrFail($id);
        $request->validate([
            'jumlah_pagi' => 'required|numeric|min:0',
            'jumlah_sore' => 'required|numeric|min:0',
        ]);

        $total = $request->jumlah_pagi + $request->jumlah_sore;
        $produksi->update([
            'tanggal' => $request->tanggal,
            'jumlah_pagi' => $request->jumlah_pagi,
            'jumlah_sore' => $request->jumlah_sore,
            'total' => $total,
        ]);

        return redirect()->route('produksi.index')->with('success', 'Data produksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produksi = ProduksiSusu::findOrFail($id);
        $produksi->delete();
        return redirect()->route('produksi.index')->with('success', 'Data produksi berhasil dihapus!');
    }
}
