<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CimilkController;
use App\Http\Controllers\SapiController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\ManajemenAkunController;
use App\Http\Controllers\DashboardPeternakController;
use App\Http\Controllers\DashboardPenjualanController;

// Rute Halaman Utama
Route::get('/', function () {
    return view('index');
});

// Rute Login
Route::get('login', [CimilkController::class, 'showLogin'])->name('login');
Route::post('login', [CimilkController::class, 'login'])->name('login.post');

Route::get('/biodata-sapi', [SapiController::class, 'index'])->name('sapi.index');
Route::get('/biodata-sapi/create', [SapiController::class, 'create'])->name('sapi.create');
Route::post('/biodata-sapi', [SapiController::class, 'store'])->name('sapi.store');
Route::get('/biodata-sapi/{id}/edit', [SapiController::class, 'edit'])->name('sapi.edit');
Route::put('/biodata-sapi/{id}', [SapiController::class, 'update'])->name('sapi.update');
Route::delete('/biodata-sapi/{id}', [SapiController::class, 'destroy'])->name('sapi.destroy');

// Rute Dashboard (Hanya bisa diakses kalau sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/manajemen-akun', [ManajemenAkunController::class, 'index'])->name('manajemen.akun');
    Route::get('/manajemen-akun/create', [ManajemenAkunController::class, 'create'])->name('manajemen-akun.create');
    Route::post('/manajemen-akun', [ManajemenAkunController::class, 'store'])->name('manajemen-akun.store');
    Route::get('/manajemen-akun/{id}/edit', [ManajemenAkunController::class, 'edit'])->name('manajemen-akun.edit');
    Route::put('/manajemen-akun/{id}', [ManajemenAkunController::class, 'update'])->name('manajemen-akun.update');
    Route::delete('/manajemen-akun/{id}', [ManajemenAkunController::class, 'destroy'])->name('manajemen-akun.destroy');
    
    Route::get('/dashboard-peternak', [DashboardPeternakController::class, 'index'])->name('peternak.dashboard');
    Route::resource('pakan', App\Http\Controllers\PakanController::class);
    Route::get('/pemberian-pakan/create', [App\Http\Controllers\PakanController::class, 'createPemberian'])->name('pemberian-pakan.create');
    Route::post('/pemberian-pakan', [App\Http\Controllers\PakanController::class, 'storePemberian'])->name('pemberian-pakan.store');
    Route::get('/pemberian-pakan/{id}/edit', [App\Http\Controllers\PakanController::class, 'editPemberian'])->name('pemberian-pakan.edit');
    Route::put('/pemberian-pakan/{id}', [App\Http\Controllers\PakanController::class, 'updatePemberian'])->name('pemberian-pakan.update');
    Route::delete('/pemberian-pakan/{id}', [App\Http\Controllers\PakanController::class, 'destroyPemberian'])->name('pemberian-pakan.destroy');
    Route::resource('siklus', App\Http\Controllers\SiklusSapiController::class);
    Route::post('/siklus/produksi', [App\Http\Controllers\SiklusSapiController::class, 'storeProduksi'])->name('siklus.storeProduksi');
    Route::post('/siklus/{id}/action/cek-birahi', [App\Http\Controllers\SiklusSapiController::class, 'actionCekBirahi'])->name('siklus.action.cek_birahi');
    Route::post('/siklus/{id}/action/melahirkan', [App\Http\Controllers\SiklusSapiController::class, 'actionMelahirkan'])->name('siklus.action.melahirkan');
    Route::post('/siklus/{id}/action/kering', [App\Http\Controllers\SiklusSapiController::class, 'actionKering'])->name('siklus.action.kering');
    Route::post('/siklus/{id}/action/selesai-kering', [App\Http\Controllers\SiklusSapiController::class, 'actionSelesaiKering'])->name('siklus.action.selesai_kering');
    Route::get('/siklus/{id}/pantau', [App\Http\Controllers\SiklusSapiController::class, 'pantau'])->name('siklus.pantau');
    Route::resource('produksi', App\Http\Controllers\ProduksiSusuController::class);
    Route::resource('kesehatan', App\Http\Controllers\PemantauanKesehatanController::class);
    Route::get('/biodata-sapi/{sapi_id}/kesehatan', [App\Http\Controllers\PemantauanKesehatanController::class, 'history'])->name('sapi.kesehatan');
    
    Route::get('/dashboard-penjualan', [DashboardPenjualanController::class, 'index'])->name('penjualan.dashboard');
    Route::get('/input-penjualan', function() { return view('penjualan.input-penjualan.index'); })->name('penjualan.input');
    Route::post('/input-penjualan', [App\Http\Controllers\PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('/input-penjualan/{id}/edit', [App\Http\Controllers\PenjualanController::class, 'edit'])->name('penjualan.edit');
    Route::put('/input-penjualan/{id}', [App\Http\Controllers\PenjualanController::class, 'update'])->name('penjualan.update');
    Route::delete('/input-penjualan/{id}', [App\Http\Controllers\PenjualanController::class, 'destroy'])->name('penjualan.destroy');
    Route::get('/data-penjualan', function(Illuminate\Http\Request $request) { 
        $query = \App\Models\Penjualan::query();
        
        if ($request->filled('dari_tanggal')) {
            $query->whereDate('tanggal', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('tanggal', '<=', $request->sampai_tanggal);
        }
        
        $penjualan = $query->orderBy('tanggal', 'desc')->paginate(10)->withQueryString();
        return view('penjualan.data-penjualan.index', compact('penjualan')); 
    })->name('penjualan.data');
    Route::get('/laporan-admin', function() { return view('laporan.index'); })->name('laporan.index');
    Route::get('/laporan-produksi', function(Illuminate\Http\Request $request) { 
        $query = \App\Models\ProduksiSusu::with('sapi');
        
        if ($request->filled('dari_tanggal')) {
            $query->whereDate('tanggal', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('tanggal', '<=', $request->sampai_tanggal);
        }

        $queryClone = clone $query;
        $totalPagi = $queryClone->sum('jumlah_pagi');
        $totalSore = $queryClone->sum('jumlah_sore');
        $totalProduksi = $queryClone->sum('total');
        
        if ($request->get('all') === 'true') {
            $produksi = $query->orderBy('tanggal', 'desc')->get();
        } else {
            $produksi = $query->orderBy('tanggal', 'desc')->paginate(10)->withQueryString();
        }
        
        return view('laporan.produksi', compact('produksi', 'totalPagi', 'totalSore', 'totalProduksi')); 
    })->name('laporan.produksi');
    Route::get('/laporan-penjualan', function(Illuminate\Http\Request $request) { 
        $query = \App\Models\Penjualan::query();
        
        if ($request->filled('dari_tanggal')) {
            $query->whereDate('tanggal', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('tanggal', '<=', $request->sampai_tanggal);
        }

        $queryClone = clone $query;
        $totalPenjualan = $queryClone->sum('total_harga');
        $totalLiter = $queryClone->sum('jumlah');
        
        if ($request->get('all') === 'true') {
            $penjualan = $query->orderBy('tanggal', 'desc')->get();
        } else {
            $penjualan = $query->orderBy('tanggal', 'desc')->paginate(10)->withQueryString();
        }
        
        return view('laporan.penjualan', compact('penjualan', 'totalPenjualan', 'totalLiter')); 
    })->name('laporan.penjualan');

    Route::get('/laporan-penjualan-bulanan', function(Illuminate\Http\Request $request) { 
        $query = \App\Models\Penjualan::selectRaw('
            MONTH(tanggal) as month, 
            YEAR(tanggal) as year, 
            SUM(jumlah) as total_liter, 
            SUM(total_harga) as total_pendapatan
        ')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc');

        if ($request->filled('dari_tanggal')) {
            $query->whereDate('tanggal', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('tanggal', '<=', $request->sampai_tanggal);
        }

        $allData = $query->get();

        $totalLiter = $allData->sum('total_liter');
        $totalPendapatan = $allData->sum('total_pendapatan');

        if ($request->get('all') === 'true') {
            $monthlyData = $allData;
        } else {
            $page = $request->get('page', 1);
            $perPage = 10;
            $sliced = $allData->slice(($page - 1) * $perPage, $perPage)->values();
            $monthlyData = new \Illuminate\Pagination\LengthAwarePaginator(
                $sliced,
                $allData->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }

        // Get chronological chart data for Penjualan role visual
        $chartQuery = \App\Models\Penjualan::query();
        if ($request->filled('dari_tanggal')) {
            $chartQuery->whereDate('tanggal', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $chartQuery->whereDate('tanggal', '<=', $request->sampai_tanggal);
        }

        $monthlyChartData = (clone $chartQuery)->selectRaw('
            MONTH(tanggal) as month, 
            YEAR(tanggal) as year, 
            SUM(jumlah) as total_liter, 
            SUM(total_harga) as total_pendapatan
        ')
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $dailyChartData = (clone $chartQuery)->selectRaw('
            DATE(tanggal) as date, 
            SUM(jumlah) as total_liter, 
            SUM(total_harga) as total_pendapatan
        ')
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        $monthlyLabels = [];
        $monthlyVolume = [];
        $monthlyRevenue = [];
        foreach ($monthlyChartData as $item) {
            $monthlyLabels[] = \Carbon\Carbon::create()->month($item->month)->translatedFormat('F') . ' ' . $item->year;
            $monthlyVolume[] = (float)$item->total_liter;
            $monthlyRevenue[] = (float)$item->total_pendapatan;
        }

        $dailyLabels = [];
        $dailyVolume = [];
        $dailyRevenue = [];
        foreach ($dailyChartData as $item) {
            $dailyLabels[] = \Carbon\Carbon::parse($item->date)->translatedFormat('d/m');
            $dailyVolume[] = (float)$item->total_liter;
            $dailyRevenue[] = (float)$item->total_pendapatan;
        }

        return view('laporan.penjualan_bulanan', compact(
            'monthlyData', 
            'totalLiter', 
            'totalPendapatan',
            'monthlyLabels',
            'monthlyVolume',
            'monthlyRevenue',
            'dailyLabels',
            'dailyVolume',
            'dailyRevenue'
        ));
    })->name('laporan.penjualan.bulanan');

    Route::post('logout', [CimilkController::class, 'logout'])->name('logout');
});
