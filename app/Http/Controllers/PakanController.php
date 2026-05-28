<?php

namespace App\Http\Controllers;

use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanController extends Controller
{
    public function index()
    {
        $stokPakan = Pakan::whereNull('sapi_id')->orderBy('created_at', 'desc')->paginate(10, ['*'], 'stok_page')->withQueryString();
        $pemberianPakan = Pakan::whereNotNull('sapi_id')->with('sapi')->orderBy('created_at', 'desc')->paginate(10, ['*'], 'pemberian_page')->withQueryString();
        
        $totalStok = Pakan::whereNull('sapi_id')->sum('stok');
        $totalDigunakan = Pakan::whereNotNull('sapi_id')->sum('stok');
        
        $ringkasanPakan = Pakan::select('nama_pakan')
            ->selectRaw("MAX(satuan) as satuan")
            ->selectRaw("SUM(CASE WHEN sapi_id IS NULL THEN stok ELSE 0 END) as total_stok")
            ->selectRaw("SUM(CASE WHEN sapi_id IS NOT NULL THEN stok ELSE 0 END) as total_digunakan")
            ->groupBy('nama_pakan')
            ->get();
        
        return view('peternak.pakan.index', compact('stokPakan', 'pemberianPakan', 'totalStok', 'totalDigunakan', 'ringkasanPakan'));
    }

    public function create()
    {
        $sapi = \App\Models\Sapi::all();
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

    public function createPemberian()
    {
        $sapi = \App\Models\Sapi::all();
        return view('peternak.pakan.pemberian-create', compact('sapi'));
    }

    public function storePemberian(Request $request)
    {
        $request->validate([
            'sapi_id' => 'required|exists:biodata_sapi,id',
            'nama_pakan' => 'required',
            'stok' => 'required|numeric|min:0',
            'satuan' => 'required',
        ], [
            'sapi_id.required' => 'Sapi wajib dipilih.',
            'sapi_id.exists' => 'Sapi yang dipilih tidak valid.',
            'nama_pakan.required' => 'Jenis pakan wajib diisi.',
            'stok.required' => 'Jumlah pemberian wajib diisi.',
            'stok.numeric' => 'Jumlah pemberian harus berupa angka.',
            'stok.min' => 'Jumlah pemberian tidak boleh kurang dari 0.',
            'satuan.required' => 'Satuan wajib dipilih.',
        ]);

        Pakan::create([
            'sapi_id' => $request->sapi_id,
            'nama_pakan' => $request->nama_pakan,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'tanggal_pemberian' => $request->tanggal_pemberian ?? now(),
            'keterangan' => $request->keterangan,
        ]);

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Log pemberian pakan berhasil ditambahkan!');
        }

        return redirect()->route('pakan.index')->with('success', 'Log pemberian pakan berhasil ditambahkan!');
    }

    public function editPemberian($id)
    {
        $pakan = Pakan::findOrFail($id);
        $sapi = \App\Models\Sapi::all();
        return view('peternak.pakan.pemberian-edit', compact('pakan', 'sapi'));
    }

    public function updatePemberian(Request $request, $id)
    {
        $pakan = Pakan::findOrFail($id);
        $request->validate([
            'sapi_id' => 'required|exists:biodata_sapi,id',
            'nama_pakan' => 'required',
            'stok' => 'required|numeric|min:0',
            'satuan' => 'required',
        ], [
            'sapi_id.required' => 'Sapi wajib dipilih.',
            'sapi_id.exists' => 'Sapi yang dipilih tidak valid.',
            'nama_pakan.required' => 'Jenis pakan wajib diisi.',
            'stok.required' => 'Jumlah pemberian wajib diisi.',
            'stok.numeric' => 'Jumlah pemberian harus berupa angka.',
            'stok.min' => 'Jumlah pemberian tidak boleh kurang dari 0.',
            'satuan.required' => 'Satuan wajib dipilih.',
        ]);

        $pakan->update($request->all());

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Log pemberian pakan berhasil diperbarui!');
        }

        return redirect()->route('pakan.index')->with('success', 'Log pemberian pakan berhasil diperbarui!');
    }
}
