<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PemantauanKesehatan;
use App\Models\Sapi;

class PemantauanKesehatanController extends Controller
{
    public function history($sapi_id)
    {
        $sapi = Sapi::with('pemantauanKesehatan')->findOrFail($sapi_id);
        return view('biodatasapi.kesehatan', compact('sapi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sapi_id' => 'required|exists:biodata_sapi,id',
            'tanggal' => 'required|date',
            'kondisi_sekarang' => 'required|string|max:255',
            'tindakan_perawatan' => 'nullable|string|max:255',
            'catatan_perkembangan' => 'nullable|string',
            'update_status_sapi' => 'nullable|string|max:255'
        ]);

        PemantauanKesehatan::create([
            'sapi_id' => $request->sapi_id,
            'tanggal' => $request->tanggal,
            'kondisi_sekarang' => $request->kondisi_sekarang,
            'tindakan_perawatan' => $request->tindakan_perawatan,
            'catatan_perkembangan' => $request->catatan_perkembangan
        ]);

        if ($request->has('update_status_sapi') && $request->update_status_sapi) {
            $sapi = Sapi::find($request->sapi_id);
            $sapi->status_kesehatan = $request->update_status_sapi;
            $sapi->save();
        }

        return redirect()->back()->with('success', 'Log kesehatan berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $log = PemantauanKesehatan::findOrFail($id);
        $log->delete();
        return redirect()->back()->with('success', 'Log kesehatan berhasil dihapus!');
    }
}
