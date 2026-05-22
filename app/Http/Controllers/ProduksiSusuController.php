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
        $sapiList = Sapi::where('jenis_kelamin', 'Betina')->get();
        
        $lactationData = [];
        foreach ($sapiList as $s) {
            $laktasiSiklus = \App\Models\SiklusSapi::where('sapi_id', $s->id)
                ->where('fase', 'Laktasi')
                ->orderBy('created_at', 'desc')
                ->first();
                
            if ($laktasiSiklus) {
                $hariKe = $laktasiSiklus->hari_ke ?? 0;
                $awalLaktasi = \Carbon\Carbon::parse($laktasiSiklus->tanggal_mulai)->subDays($hariKe);
                
                $hari100_start = $awalLaktasi->copy();
                $hari100_end = $awalLaktasi->copy()->addDays(100);
                
                $hari200_start = $awalLaktasi->copy()->addDays(101);
                $hari200_end = $awalLaktasi->copy()->addDays(200);
                
                $hari300_start = $awalLaktasi->copy()->addDays(201);
                $hari300_end = $awalLaktasi->copy()->addDays(300);

                $produksi100 = ProduksiSusu::where('sapi_id', $s->id)
                    ->whereDate('tanggal', '>=', $hari100_start)
                    ->whereDate('tanggal', '<=', $hari100_end)
                    ->sum('total');
                    
                $produksi200 = ProduksiSusu::where('sapi_id', $s->id)
                    ->whereDate('tanggal', '>=', $hari200_start)
                    ->whereDate('tanggal', '<=', $hari200_end)
                    ->sum('total');
                    
                $produksi300 = ProduksiSusu::where('sapi_id', $s->id)
                    ->whereDate('tanggal', '>=', $hari300_start)
                    ->whereDate('tanggal', '<=', $hari300_end)
                    ->sum('total');

                $lactationData[$s->id] = [
                    'labels' => ['Hari 1 - 100', 'Hari 101 - 200', 'Hari 201 - 300'],
                    'data' => [floatval($produksi100), floatval($produksi200), floatval($produksi300)],
                    'has_data' => true
                ];
            } else {
                $lactationData[$s->id] = [
                    'labels' => ['Hari 1 - 100', 'Hari 101 - 200', 'Hari 201 - 300'],
                    'data' => [0, 0, 0],
                    'has_data' => false
                ];
            }
        }

        return view('peternak.produksi.index', compact('produksi', 'sapiList', 'lactationData'));
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
            'laktasi_hari_ke' => 'nullable|integer|min:0',
        ]);

        $total = $request->jumlah_pagi + $request->jumlah_sore;

        ProduksiSusu::create([
            'sapi_id' => $request->sapi_id,
            'tanggal' => $request->tanggal,
            'jumlah_pagi' => $request->jumlah_pagi,
            'jumlah_sore' => $request->jumlah_sore,
            'total' => $total,
            'laktasi_hari_ke' => $request->laktasi_hari_ke,
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
