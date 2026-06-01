<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PemantauanKesehatan;
use App\Models\Sapi;

class PemantauanKesehatanController extends Controller
{
    public function history($sapi_id)
    {
        $sapi = Sapi::findOrFail($sapi_id);
        $kesehatan = $sapi->pemantauanKesehatan()->orderBy('tanggal', 'desc')->paginate(10);
        return view('biodatasapi.kesehatan', compact('sapi', 'kesehatan'));
    }

    /**
     * Tentukan status kesehatan sapi secara otomatis berdasarkan kondisi.
     */
    private function resolveStatusFromKondisi(string $kondisi): string
    {
        $kondisiLower = strtolower(trim($kondisi));
        $kondisiSakit = ['sakit', 'demam', 'mastitis', 'kembung', 'luka', 'pincang'];

        if ($kondisiLower === 'sehat') {
            return 'Sehat';
        } elseif (in_array($kondisiLower, $kondisiSakit)) {
            return 'Sakit';
        } else {
            return 'Perlu Perhatian';
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'sapi_id' => 'required|exists:biodata_sapi,id',
            'tanggal' => 'required|date',
            'kondisi_sekarang' => 'required|string|max:255',
            'tindakan_perawatan' => 'nullable|string|max:255',
            'catatan_perkembangan' => 'nullable|string',
        ]);

        PemantauanKesehatan::create([
            'sapi_id' => $request->sapi_id,
            'tanggal' => $request->tanggal,
            'kondisi_sekarang' => $request->kondisi_sekarang,
            'tindakan_perawatan' => $request->tindakan_perawatan,
            'catatan_perkembangan' => $request->catatan_perkembangan
        ]);

        // Auto-update status sapi berdasarkan kondisi
        $sapi = Sapi::find($request->sapi_id);
        if ($sapi) {
            $sapi->status_kesehatan = $this->resolveStatusFromKondisi($request->kondisi_sekarang);
            $sapi->save();
        }

        return redirect()->back()->with('success', 'Log kesehatan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kondisi_sekarang' => 'required|string|max:255',
            'tindakan_perawatan' => 'nullable|string|max:255',
            'catatan_perkembangan' => 'nullable|string',
        ]);

        $log = PemantauanKesehatan::findOrFail($id);
        $log->update([
            'tanggal' => $request->tanggal,
            'kondisi_sekarang' => $request->kondisi_sekarang,
            'tindakan_perawatan' => $request->tindakan_perawatan,
            'catatan_perkembangan' => $request->catatan_perkembangan
        ]);

        // Auto-update status sapi berdasarkan kondisi
        $sapi = Sapi::find($log->sapi_id);
        if ($sapi) {
            $sapi->status_kesehatan = $this->resolveStatusFromKondisi($request->kondisi_sekarang);
            $sapi->save();
        }

        return redirect()->back()->with('success', 'Log kesehatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $log = PemantauanKesehatan::findOrFail($id);
        $log->delete();
        return redirect()->back()->with('success', 'Log kesehatan berhasil dihapus!');
    }
}
