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

        // 5. Data untuk Grafik (6 Bulan Terakhir)
        $monthlyData = \App\Models\Penjualan::selectRaw('MONTH(tanggal) as month, SUM(total_harga) as total')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->take(6)
            ->get();
        
        $labels = [];
        $revenues = [];
        foreach ($monthlyData as $data) {
            $labels[] = \Carbon\Carbon::create()->month($data->month)->translatedFormat('M');
            $revenues[] = $data->total;
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
