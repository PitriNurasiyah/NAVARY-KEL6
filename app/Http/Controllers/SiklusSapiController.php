<?php

namespace App\Http\Controllers;

use App\Models\SiklusSapi;
use App\Models\Sapi;
use App\Models\ProduksiSusu;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiklusSapiController extends Controller
{
    public function index()
    {
        $siklus = SiklusSapi::with('sapi')->orderBy('tanggal_mulai', 'desc')->get();
        $sapi = Sapi::all();

        // Siapkan data grafik untuk sapi yang sedang laktasi
        $laktasiSiklus = $siklus->where('fase', 'Laktasi');
        $laktasiChartData = [];

        foreach ($laktasiSiklus as $sik) {
            // Titik 0 laktasi sebenarnya = tanggal mulai dikurangi "hari ke"
            $hariKe = $sik->hari_ke ?? 0;
            $awalLaktasi = Carbon::parse($sik->tanggal_mulai)->subDays($hariKe);
            
            $hari100_start = $awalLaktasi->copy();
            $hari100_end = $awalLaktasi->copy()->addDays(99);
            
            $hari200_start = $awalLaktasi->copy()->addDays(100);
            $hari200_end = $awalLaktasi->copy()->addDays(199);
            
            $hari300_start = $awalLaktasi->copy()->addDays(200);
            $hari300_end = $awalLaktasi->copy()->addDays(299);

            $produksi100 = ProduksiSusu::where('sapi_id', $sik->sapi_id)
                ->whereDate('tanggal', '>=', $hari100_start)
                ->whereDate('tanggal', '<=', $hari100_end)
                ->sum('total');
                
            $produksi200 = ProduksiSusu::where('sapi_id', $sik->sapi_id)
                ->whereDate('tanggal', '>=', $hari200_start)
                ->whereDate('tanggal', '<=', $hari200_end)
                ->sum('total');
                
            $produksi300 = ProduksiSusu::where('sapi_id', $sik->sapi_id)
                ->whereDate('tanggal', '>=', $hari300_start)
                ->whereDate('tanggal', '<=', $hari300_end)
                ->sum('total');

            $laktasiChartData[] = [
                'nama' => $sik->sapi->nama ?? 'Sapi',
                'produksi100' => $produksi100,
                'produksi200' => $produksi200,
                'produksi300' => $produksi300,
            ];
        }

        return view('peternak.siklus.index', compact('siklus', 'sapi', 'laktasiChartData'));
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

        if ($request->fase === 'Laktasi' && ($request->filled('jumlah_pagi') || $request->filled('jumlah_sore'))) {
            $pagi = $request->jumlah_pagi ?? 0;
            $sore = $request->jumlah_sore ?? 0;
            ProduksiSusu::create([
                'sapi_id' => $request->sapi_id,
                'tanggal' => $request->tanggal_mulai,
                'jumlah_pagi' => $pagi,
                'jumlah_sore' => $sore,
                'total' => $pagi + $sore,
            ]);
        }

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

        if ($request->fase === 'Laktasi' && ($request->filled('jumlah_pagi') || $request->filled('jumlah_sore'))) {
            $pagi = $request->jumlah_pagi ?? 0;
            $sore = $request->jumlah_sore ?? 0;
            
            ProduksiSusu::updateOrCreate(
                [
                    'sapi_id' => $siklus->sapi_id,
                    'tanggal' => $request->tanggal_mulai,
                ],
                [
                    'jumlah_pagi' => $pagi,
                    'jumlah_sore' => $sore,
                    'total' => $pagi + $sore,
                ]
            );
        }

        return redirect()->route('siklus.index')->with('success', 'Data siklus berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $siklus = SiklusSapi::findOrFail($id);
        $siklus->delete();
        return redirect()->route('siklus.index')->with('success', 'Data siklus berhasil dihapus!');
    }

    public function storeProduksi(Request $request)
    {
        $request->validate([
            'sapi_id' => 'required|exists:biodata_sapi,id',
            'tanggal' => 'required|date',
            'jumlah_pagi' => 'nullable|numeric|min:0',
            'jumlah_sore' => 'nullable|numeric|min:0',
        ]);

        $pagi = $request->jumlah_pagi ?? 0;
        $sore = $request->jumlah_sore ?? 0;

        ProduksiSusu::create([
            'sapi_id' => $request->sapi_id,
            'tanggal' => $request->tanggal,
            'jumlah_pagi' => $pagi,
            'jumlah_sore' => $sore,
            'total' => $pagi + $sore,
        ]);

        return redirect()->route('siklus.index')->with('success', 'Data produksi susu berhasil ditambahkan!');
    }
}
