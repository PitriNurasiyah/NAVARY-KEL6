<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPenjualanController extends Controller
{
    public function index()
    {
        // 1. Total Produksi (Liter)
        $totalProduksi = \App\Models\ProduksiSusu::sum('total');
        
        // 2. Total Terjual (Liter)
        $totalTerjual = \App\Models\Penjualan::sum('jumlah');
        
        // 3. Stok Tersedia
        $stokSusu = $totalProduksi - $totalTerjual;
        
        // 4. Penjualan Hari Ini (Rupiah)
        $penjualanHariIni = \App\Models\Penjualan::whereDate('tanggal', date('Y-m-d'))->sum('total_harga');

        // 5. Data untuk Grafik (Tahun Ini - Perbandingan Per Bulan)
        $currentYear = date('Y');
        $monthlyData = \App\Models\Penjualan::whereYear('tanggal', $currentYear)
            ->selectRaw('MONTH(tanggal) as month, SUM(total_harga) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->all();
        
        $labels = [];
        $revenues = [];
        for ($m = 1; $m <= 12; $m++) {
            $labels[] = \Carbon\Carbon::create()->month($m)->translatedFormat('M');
            $revenues[] = $monthlyData[$m] ?? 0;
        }

        return view('dashboard.penjualan', compact(
            'stokSusu', 
            'totalTerjual', 
            'penjualanHariIni',
            'labels',
            'revenues'
        ));
    }
}
