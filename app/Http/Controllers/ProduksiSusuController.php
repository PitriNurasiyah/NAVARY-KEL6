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
            $records = ProduksiSusu::where('sapi_id', $s->id)
                ->whereNotNull('laktasi_hari_ke')
                ->orderBy('laktasi_hari_ke', 'asc')
                ->get();
                
            if ($records->count() > 0) {
                $labels = [];
                $data = [];
                foreach ($records as $r) {
                    $labels[] = 'Hari ' . $r->laktasi_hari_ke;
                    $data[] = floatval($r->total);
                }
                $lactationData[$s->id] = [
                    'labels' => $labels,
                    'data' => $data,
                    'has_data' => true
                ];
            } else {
                $lactationData[$s->id] = [
                    'labels' => ['Hari 1'],
                    'data' => [0],
                    'has_data' => false
                ];
            }
        }

        return view('peternak.produksi.index', compact('produksi', 'sapiList', 'lactationData'));
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
            'laktasi_hari_ke' => 'nullable|integer|min:0',
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
            'laktasi_hari_ke.integer' => 'Hari laktasi harus berupa angka.',
            'laktasi_hari_ke.min' => 'Hari laktasi tidak boleh kurang dari 0.',
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
            'laktasi_hari_ke' => 'nullable|integer|min:0',
        ], [
            'jumlah_pagi.required' => 'Hasil pagi wajib diisi.',
            'jumlah_pagi.numeric' => 'Hasil pagi harus berupa angka.',
            'jumlah_pagi.min' => 'Hasil pagi tidak boleh kurang dari 0.',
            'jumlah_sore.required' => 'Hasil sore wajib diisi.',
            'jumlah_sore.numeric' => 'Hasil sore harus berupa angka.',
            'jumlah_sore.min' => 'Hasil sore tidak boleh kurang dari 0.',
            'laktasi_hari_ke.integer' => 'Hari laktasi harus berupa angka.',
            'laktasi_hari_ke.min' => 'Hari laktasi tidak boleh kurang dari 0.',
        ]);

        $total = $request->jumlah_pagi + $request->jumlah_sore;
        $produksi->update([
            'tanggal' => $request->tanggal,
            'jumlah_pagi' => $request->jumlah_pagi,
            'jumlah_sore' => $request->jumlah_sore,
            'total' => $total,
            'laktasi_hari_ke' => $request->laktasi_hari_ke,
        ]);

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Data produksi berhasil diperbarui!');
        }

        return redirect()->route('produksi.index')->with('success', 'Data produksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produksi = ProduksiSusu::findOrFail($id);
        $produksi->delete();
        return redirect()->route('produksi.index')->with('success', 'Data produksi berhasil dihapus!');
    }
}
