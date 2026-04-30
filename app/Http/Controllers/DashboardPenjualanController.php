<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPenjualanController extends Controller
{
    public function index()
    {
        return view('dashboardPenjualan.dashboardPenjualan');
    }
}
