<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sapi;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalSapi = \App\Models\Sapi::count();
        $totalProduksi = \App\Models\ProduksiSusu::sum('total');
        $totalPenjualan = \App\Models\Penjualan::sum('total_harga');
        
        return view('dashboard.admin', compact('totalSapi', 'totalProduksi', 'totalPenjualan'));
    }
}
