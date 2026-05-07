<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sapi;
use App\Models\ProduksiSusu;
use App\Models\SiklusSapi;
use Carbon\Carbon;

class DashboardPeternakController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        
        // 1. Populasi Sapi
        $totalSapi = Sapi::count();
        
        // 2. Tugas Input Hari Ini (Sapi yang belum diinput produksi susunya hari ini)
        $sudahInput = ProduksiSusu::whereDate('tanggal', $today)->distinct('sapi_id')->count();
        $tugasInput = max(0, $totalSapi - $sudahInput);
        
        // 3. Total Produksi (Keseluruhan)
        $totalProduksi = ProduksiSusu::sum('total');
        
        // 4. Jadwal Hari Ini (Dari Siklus Sapi)
        $alerts = SiklusSapi::with('sapi')
            ->where(function($query) use ($today) {
                $query->whereDate('tanggal_mulai', $today)
                      ->orWhereDate('estimasi_selesai', $today);
            })
            ->where('status', 'Berjalan')
            ->get();

        return view('dashboard.peternak', compact('totalSapi', 'tugasInput', 'totalProduksi', 'alerts'));
    }
}
