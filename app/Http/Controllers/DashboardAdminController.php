<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sapi;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalSapi = Sapi::count();
        $totalProduksi = 0; // Belum ada modul DB
        $totalPenjualan = 0; // Belum ada modul DB
        
        return view('dashboard.admin', compact('totalSapi', 'totalProduksi', 'totalPenjualan'));
    }
}
