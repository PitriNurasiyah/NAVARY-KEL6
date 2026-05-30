<?php

namespace App\Http\Controllers;

use App\Models\ProduksiSusu;
use App\Models\Sapi;
use Illuminate\Http\Request;

class ProduksiSusuController extends Controller
{
    public function index(Request $request)
    {
        $query = ProduksiSusu::with('sapi');
        
        if ($request->filled('dari_tanggal')) {
            $query->whereDate('tanggal', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('tanggal', '<=', $request->sampai_tanggal);
        }

        $queryClone = clone $query;
        $totalPagi = $queryClone->sum('jumlah_pagi');
        $totalSore = $queryClone->sum('jumlah_sore');
        $totalProduksi = $queryClone->sum('total');
        
        $produksi = $query->orderBy('tanggal', 'desc')->paginate(10)->withQueryString();
        
        // Data grafik laktasi per sapi: semua data dikelompokkan per sapi
        $sapiList = Sapi::whereHas('produksiSusu')->get();
        $laktasiChartData = [];
        foreach ($sapiList as $s) {
            $records = ProduksiSusu::where('sapi_id', $s->id)
                ->selectRaw('tanggal, MAX(laktasi_hari_ke) as laktasi_hari_ke, SUM(total) as total')
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'asc')
                ->get();
            if ($records->isNotEmpty()) {
                $laktasiChartData[] = [
                    'nama' => $s->nama . ' (' . $s->kode_sapi . ')',
                    'labels' => $records->map(fn($r) => 'Hari ' . ($r->laktasi_hari_ke ?? 1))->values()->toArray(),
                    'data' => $records->pluck('total')->toArray(),
                ];
            }
        }
        
        return view('peternak.produksi.index', compact('produksi', 'totalPagi', 'totalSore', 'totalProduksi', 'laktasiChartData'));
    }

    public function create()
    {
        $sapi = Sapi::where('jenis_kelamin', 'Betina')->get();
        return view('peternak.produksi.create', compact('sapi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sapi_id' => 'required|exists:biodata_sapi,id',
            'tanggal' => 'required|date',
            'jumlah_pagi' => 'required|numeric|min:0',
            'jumlah_sore' => 'required|numeric|min:0',
        ], [
            'sapi_id.required' => 'Sapi wajib dipilih.',
            'sapi_id.exists' => 'Sapi yang dipilih tidak valid.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'jumlah_pagi.required' => 'Hasil pagi wajib diisi.',
            'jumlah_pagi.numeric' => 'Hasil pagi harus berupa angka.',
            'jumlah_pagi.min' => 'Hasil pagi tidak boleh kurang dari 0.',
            'jumlah_sore.required' => 'Hasil sore wajib diisi.',
            'jumlah_sore.numeric' => 'Hasil sore harus berupa angka.',
            'jumlah_sore.min' => 'Hasil sore tidak boleh kurang dari 0.',
        ]);

        $total = $request->jumlah_pagi + $request->jumlah_sore;
        $laktasi_hari_ke = $this->calculateLaktasiHariKe($request->sapi_id, $request->tanggal);

        ProduksiSusu::create([
            'sapi_id' => $request->sapi_id,
            'tanggal' => $request->tanggal,
            'jumlah_pagi' => $request->jumlah_pagi,
            'jumlah_sore' => $request->jumlah_sore,
            'total' => $total,
            'laktasi_hari_ke' => $laktasi_hari_ke,
        ]);

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Data produksi berhasil disimpan!');
        }

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
        ], [
            'jumlah_pagi.required' => 'Hasil pagi wajib diisi.',
            'jumlah_pagi.numeric' => 'Hasil pagi harus berupa angka.',
            'jumlah_pagi.min' => 'Hasil pagi tidak boleh kurang dari 0.',
            'jumlah_sore.required' => 'Hasil sore wajib diisi.',
            'jumlah_sore.numeric' => 'Hasil sore harus berupa angka.',
            'jumlah_sore.min' => 'Hasil sore tidak boleh kurang dari 0.',
        ]);

        $total = $request->jumlah_pagi + $request->jumlah_sore;
        $laktasi_hari_ke = $this->calculateLaktasiHariKe($produksi->sapi_id, $request->tanggal);

        $produksi->update([
            'tanggal' => $request->tanggal,
            'jumlah_pagi' => $request->jumlah_pagi,
            'jumlah_sore' => $request->jumlah_sore,
            'total' => $total,
            'laktasi_hari_ke' => $laktasi_hari_ke,
        ]);

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Data produksi berhasil diperbarui!');
        }

        return redirect()->route('produksi.index')->with('success', 'Data produksi berhasil diperbarui!');
    }

    private function calculateLaktasiHariKe($sapiId, $tanggal)
    {
        $siklus = \App\Models\SiklusSapi::where('sapi_id', $sapiId)
            ->where('fase', 'Laktasi')
            ->orderBy('tanggal_mulai', 'asc')
            ->first();

        $firstLog = ProduksiSusu::where('sapi_id', $sapiId)
            ->orderBy('tanggal', 'asc')
            ->first();

        $dates = [];
        if ($siklus) {
            $dates[] = \Carbon\Carbon::parse($siklus->tanggal_mulai);
        }
        if ($firstLog) {
            $dates[] = \Carbon\Carbon::parse($firstLog->tanggal);
        }

        if (empty($dates)) {
            return 1;
        }

        $refDate = $dates[0];
        foreach ($dates as $d) {
            if ($d->lt($refDate)) {
                $refDate = $d;
            }
        }

        $prodDate = \Carbon\Carbon::parse($tanggal);
        if ($prodDate->lt($refDate)) {
            return 1;
        }

        return abs($refDate->diffInDays($prodDate)) + 1;
    }

    public function destroy($id)
    {
        $produksi = ProduksiSusu::findOrFail($id);
        $produksi->delete();
        return redirect()->route('produksi.index')->with('success', 'Data produksi berhasil dihapus!');
    }
}
