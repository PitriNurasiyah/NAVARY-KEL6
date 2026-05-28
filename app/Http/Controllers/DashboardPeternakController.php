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

        // 5. Data Grafik Stok Pakan
        $pakanData = \App\Models\Pakan::select('nama_pakan', \DB::raw('SUM(stok) as total_stok'))
            ->groupBy('nama_pakan')
            ->get();

        // Data Ringkasan Pakan (Total Persediaan & Total Digunakan)
        $totalStok = \App\Models\Pakan::whereNull('sapi_id')->sum('stok');
        $totalDigunakan = \App\Models\Pakan::whereNotNull('sapi_id')->sum('stok');

        // 6. Data Grafik Produksi Susu Harian (7 Hari Terakhir)
        $produksiData = \App\Models\ProduksiSusu::select('tanggal', \DB::raw('SUM(total) as total_produksi'))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->take(7)
            ->get();

        return view('dashboard.peternak', compact(
            'totalSapi', 'tugasInput', 'totalProduksi', 'alerts', 'pakanData', 'produksiData', 'totalStok', 'totalDigunakan'
        ));
    }
}
