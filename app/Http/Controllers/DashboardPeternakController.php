<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPeternakController extends Controller
{
    public function index()
    {
        return view('dashboardPeternak.dashboardPeternak');
    }
}
