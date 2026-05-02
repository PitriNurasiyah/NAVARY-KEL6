<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sapi;

class DashboardPeternakController extends Controller
{
    public function index()
    {
        $sapi = Sapi::all();
        return view('dashboard.peternak', compact('sapi'));
    }
}
