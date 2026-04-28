<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sapi;

class SapiController extends Controller
{
    public function index()
    {
        $sapi = Sapi::all();
        return view('biodata_sapi', compact('sapi'));
    }
}
