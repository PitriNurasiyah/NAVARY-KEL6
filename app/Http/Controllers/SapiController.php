<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sapi;

class SapiController extends Controller
{
    public function index()
    {
        $sapi = Sapi::paginate(10);
        return view('biodatasapi.biodata_sapi', compact('sapi'));
    }

    public function create()
    {
        $latestSapi = Sapi::orderBy('id', 'desc')->first();
        if ($latestSapi && preg_match('/SP(\d+)/', $latestSapi->kode_sapi, $matches)) {
            $number = (int)$matches[1] + 1;
            $nextKode = 'SP' . str_pad($number, 3, '0', STR_PAD_LEFT);
        } else {
            $nextKode = 'SP001';
        }
        $cows = Sapi::orderBy('kode_sapi', 'asc')->get();
        return view('biodatasapi.create', compact('nextKode', 'cows'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_sapi' => 'required|unique:biodata_sapi',
            'nama' => 'required',
            'jenis' => 'required',
            'tanggal_lahir' => 'required|date'
        ], [
            'kode_sapi.required' => 'ID Sapi wajib diisi.',
            'kode_sapi.unique' => 'ID Sapi sudah terdaftar.',
            'nama.required' => 'Nama Sapi wajib diisi.',
            'jenis.required' => 'Jenis Sapi wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.'
        ]);

        $umurStr = '';
        if ($request->filled('tanggal_lahir')) {
            $dob = \Carbon\Carbon::parse($request->tanggal_lahir);
            $diff = $dob->diff(now());
            if ($diff->y > 0) {
                $umurStr .= $diff->y . ' Tahun ';
            }
            if ($diff->m > 0) {
                $umurStr .= $diff->m . ' Bulan';
            }
            if (empty(trim($umurStr))) {
                $umurStr = $diff->d . ' Hari';
            }
            $umurStr = trim($umurStr);
        }

        $beratStr = '';
        if ($request->filled('berat_nilai')) {
            $beratStr = $request->berat_nilai . ' ' . ($request->berat_satuan ?? 'kg');
        }

        Sapi::create([
            'kode_sapi' => $request->kode_sapi,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $umurStr,
            'tanggal_lahir' => $request->tanggal_lahir,
            'berat' => $beratStr,
            'status_kesehatan' => 'Sehat',
            'ayah' => $request->ayah,
            'ibu' => $request->ibu
        ]);

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Data sapi berhasil ditambahkan!');
        }

        return redirect()->route('sapi.index')->with('success', 'Data sapi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $sapi = Sapi::findOrFail($id);
        $cows = Sapi::where('id', '!=', $id)->orderBy('kode_sapi', 'asc')->get();

        $beratNilai = '';
        $beratSatuan = 'kg';
        if (!empty($sapi->berat)) {
            if (preg_match('/^\s*(\d+(?:\.\d+)?)\s*(kg|ton|KG|TON)?/i', $sapi->berat, $matches)) {
                $beratNilai = $matches[1];
                $beratSatuan = strtolower($matches[2] ?? 'kg');
            } else {
                $beratNilai = $sapi->berat;
            }
        }

        return view('biodatasapi.edit', compact('sapi', 'cows', 'beratNilai', 'beratSatuan'));
    }

    public function update(Request $request, $id)
    {
        $sapi = Sapi::findOrFail($id);
        $request->validate([
            'kode_sapi' => 'required|unique:biodata_sapi,kode_sapi,'.$sapi->id,
            'nama' => 'required',
            'jenis' => 'required',
            'tanggal_lahir' => 'required|date'
        ], [
            'kode_sapi.required' => 'ID Sapi wajib diisi.',
            'kode_sapi.unique' => 'ID Sapi sudah terdaftar.',
            'nama.required' => 'Nama Sapi wajib diisi.',
            'jenis.required' => 'Jenis Sapi wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.'
        ]);

        $umurStr = '';
        if ($request->filled('tanggal_lahir')) {
            $dob = \Carbon\Carbon::parse($request->tanggal_lahir);
            $diff = $dob->diff(now());
            if ($diff->y > 0) {
                $umurStr .= $diff->y . ' Tahun ';
            }
            if ($diff->m > 0) {
                $umurStr .= $diff->m . ' Bulan';
            }
            if (empty(trim($umurStr))) {
                $umurStr = $diff->d . ' Hari';
            }
            $umurStr = trim($umurStr);
        }

        $beratStr = '';
        if ($request->filled('berat_nilai')) {
            $beratStr = $request->berat_nilai . ' ' . ($request->berat_satuan ?? 'kg');
        }

        $sapi->update([
            'kode_sapi' => $request->kode_sapi,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $umurStr,
            'tanggal_lahir' => $request->tanggal_lahir,
            'berat' => $beratStr,
            'ayah' => $request->ayah,
            'ibu' => $request->ibu
        ]);

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Data sapi berhasil diperbarui!');
        }

        return redirect()->route('sapi.index')->with('success', 'Data sapi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $sapi = Sapi::findOrFail($id);
        $sapi->delete();
        return redirect()->route('sapi.index')->with('success', 'Data sapi berhasil dihapus!');
    }
}
