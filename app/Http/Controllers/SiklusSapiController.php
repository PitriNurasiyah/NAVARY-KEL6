<?php

namespace App\Http\Controllers;

use App\Models\SiklusSapi;
use App\Models\Sapi;
use App\Models\ProduksiSusu;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SiklusSapiController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(function ($request, $next) {
                $role = auth()->user()->role ?? '';
                if (strtolower($role) === 'penjualan') {
                    abort(403, 'Unauthorized action.');
                }
                return $next($request);
            }),
        ];
    }
    public function index()
    {
        $this->checkAutoTransitions();
        $sapi = Sapi::with(['siklusSapi' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->where('jenis_kelamin', 'Betina')->paginate(10);

        return view('peternak.siklus.index', compact('sapi'));
    }

    public function create()
    {
        $sapi = Sapi::where('jenis_kelamin', 'Betina')->get();
        return view('peternak.siklus.create', compact('sapi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sapi_id' => 'required|exists:biodata_sapi,id',
            'fase' => 'required',
            'tanggal_mulai' => 'required|date',
            'hari_ke' => 'nullable|integer',
        ], [
            'sapi_id.required' => 'Sapi wajib dipilih.',
            'sapi_id.exists' => 'Sapi yang dipilih tidak valid.',
            'fase.required' => 'Fase siklus wajib dipilih.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_mulai.date' => 'Format tanggal tidak valid.',
            'hari_ke.integer' => 'Hari ke harus berupa angka.',
        ]);

        SiklusSapi::create([
            'sapi_id' => $request->sapi_id,
            'fase' => $request->fase,
            'tanggal_mulai' => $request->tanggal_mulai,
            'estimasi_selesai' => $request->estimasi_selesai,
            'hari_ke' => $request->hari_ke ?? 0,
            'status' => $request->status ?? 'Berjalan',
            'keterangan' => $request->keterangan,
        ]);

        if ($request->fase === 'Laktasi' && ($request->filled('jumlah_pagi') || $request->filled('jumlah_sore'))) {
            $pagi = $request->jumlah_pagi ?? 0;
            $sore = $request->jumlah_sore ?? 0;
            ProduksiSusu::create([
                'sapi_id' => $request->sapi_id,
                'tanggal' => $request->tanggal_mulai,
                'jumlah_pagi' => $pagi,
                'jumlah_sore' => $sore,
                'total' => $pagi + $sore,
            ]);
        }

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Data siklus berhasil disimpan!');
        }

        return redirect()->route('siklus.show', $request->sapi_id)->with('success', 'Data siklus berhasil disimpan!');
    }

    public function show($id)
    {
        $this->checkAutoTransitions();
        $sapi = Sapi::with(['siklusSapi' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->where('jenis_kelamin', 'Betina')->findOrFail($id);

        $laktasiSiklus = $sapi->siklusSapi->where('fase', 'Laktasi')->first();
        $laktasiChartData = null;

        if ($laktasiSiklus) {
            $hariKe = $laktasiSiklus->hari_ke ?? 0;
            $awalLaktasi = Carbon::parse($laktasiSiklus->tanggal_mulai)->subDays($hariKe);
            
            $hari100_start = $awalLaktasi->copy();
            $hari100_end = $awalLaktasi->copy()->addDays(100);
            
            $hari200_start = $awalLaktasi->copy()->addDays(101);
            $hari200_end = $awalLaktasi->copy()->addDays(200);
            
            $hari300_start = $awalLaktasi->copy()->addDays(201);
            $hari300_end = $awalLaktasi->copy()->addDays(300);

            $produksi100 = ProduksiSusu::where('sapi_id', $laktasiSiklus->sapi_id)
                ->whereDate('tanggal', '>=', $hari100_start)
                ->whereDate('tanggal', '<=', $hari100_end)
                ->sum('total');
                
            $produksi200 = ProduksiSusu::where('sapi_id', $laktasiSiklus->sapi_id)
                ->whereDate('tanggal', '>=', $hari200_start)
                ->whereDate('tanggal', '<=', $hari200_end)
                ->sum('total');
                
            $produksi300 = ProduksiSusu::where('sapi_id', $laktasiSiklus->sapi_id)
                ->whereDate('tanggal', '>=', $hari300_start)
                ->whereDate('tanggal', '<=', $hari300_end)
                ->sum('total');

            $laktasiChartData = [
                'labels' => ['Hari 1 - 100', 'Hari 101 - 200', 'Hari 201 - 300'],
                'data' => [$produksi100, $produksi200, $produksi300]
            ];
        }

        return view('peternak.siklus.show', compact('sapi', 'laktasiChartData'));
    }

    public function edit($id)
    {
        $siklus = SiklusSapi::with('sapi')->findOrFail($id);
        return view('peternak.siklus.edit', compact('siklus'));
    }

    public function update(Request $request, $id)
    {
        $siklus = SiklusSapi::findOrFail($id);
        $siklus->update($request->all());

        if ($request->fase === 'Laktasi' && ($request->filled('jumlah_pagi') || $request->filled('jumlah_sore'))) {
            $pagi = $request->jumlah_pagi ?? 0;
            $sore = $request->jumlah_sore ?? 0;
            
            ProduksiSusu::updateOrCreate(
                [
                    'sapi_id' => $siklus->sapi_id,
                    'tanggal' => $request->tanggal_mulai,
                ],
                [
                    'jumlah_pagi' => $pagi,
                    'jumlah_sore' => $sore,
                    'total' => $pagi + $sore,
                ]
            );
        }

        if ($request->input('mode') === 'modal') {
            return redirect()->back()->with('success', 'Data siklus berhasil diperbarui!');
        }

        return redirect()->route('siklus.show', $siklus->sapi_id)->with('success', 'Data siklus berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $siklus = SiklusSapi::findOrFail($id);
        $sapiId = $siklus->sapi_id;
        $siklus->delete();
        return redirect()->route('siklus.show', $sapiId)->with('success', 'Data siklus berhasil dihapus!');
    }

    public function storeProduksi(Request $request)
    {
        $request->validate([
            'sapi_id' => 'required|exists:biodata_sapi,id',
            'tanggal' => 'required|date',
            'jumlah_pagi' => 'nullable|numeric|min:0',
            'jumlah_sore' => 'nullable|numeric|min:0',
        ]);

        $pagi = $request->jumlah_pagi ?? 0;
        $sore = $request->jumlah_sore ?? 0;

        ProduksiSusu::create([
            'sapi_id' => $request->sapi_id,
            'tanggal' => $request->tanggal,
            'jumlah_pagi' => $pagi,
            'jumlah_sore' => $sore,
            'total' => $pagi + $sore,
        ]);

        return redirect()->route('siklus.index')->with('success', 'Data produksi susu berhasil ditambahkan!');
    }
    public function actionCekBirahi(Request $request, $id)
    {
        $siklus = SiklusSapi::findOrFail($id);
        
        if ($request->hasil == 'berhasil') {
            $siklus->update(['status' => 'Selesai', 'keterangan' => 'IB Berhasil']);
            SiklusSapi::create([
                'sapi_id' => $siklus->sapi_id,
                'fase' => 'Bunting',
                'tanggal_mulai' => $siklus->tanggal_mulai,
                'estimasi_selesai' => Carbon::parse($siklus->tanggal_mulai)->addMonths(9)->format('Y-m-d'),
                'status' => 'Berjalan',
                'keterangan' => 'Memasuki fase Bunting setelah IB berhasil.'
            ]);
            
            $this->checkAutoTransitions();
            
            return back()->with('success', 'Selamat! Sapi kini memasuki fase Bunting (Kehamilan).');
        } else {
            $siklus->update(['status' => 'Batal', 'keterangan' => 'IB Gagal']);
            SiklusSapi::create([
                'sapi_id' => $siklus->sapi_id,
                'fase' => 'IB',
                'tanggal_mulai' => date('Y-m-d'),
                'status' => 'Berjalan',
                'keterangan' => 'Mengulang IB karena sebelumnya gagal.'
            ]);
            return back()->with('error', 'IB Gagal. Sistem telah membuat jadwal IB baru secara otomatis.');
        }
    }

    public function actionMelahirkan($id)
    {
        $siklus = SiklusSapi::findOrFail($id);
        $siklus->update(['status' => 'Selesai', 'keterangan' => 'Sapi telah melahirkan']);
        
        SiklusSapi::create([
            'sapi_id' => $siklus->sapi_id,
            'fase' => 'Laktasi',
            'tanggal_mulai' => date('Y-m-d'),
            'status' => 'Berjalan'
        ]);

        return back()->with('success', 'Sapi telah melahirkan dan sekarang memasuki fase Laktasi!');
    }

    public function actionKering($id)
    {
        $siklus = SiklusSapi::findOrFail($id);
        $siklus->update(['status' => 'Selesai', 'keterangan' => 'Masa laktasi selesai']);
        
        SiklusSapi::create([
            'sapi_id' => $siklus->sapi_id,
            'fase' => 'Kering Kandang',
            'tanggal_mulai' => date('Y-m-d'),
            'estimasi_selesai' => Carbon::now()->addMonths(1)->format('Y-m-d'),
            'status' => 'Berjalan'
        ]);

        return back()->with('success', 'Masa Laktasi berakhir. Sapi kini memasuki Masa Kering.');
    }

    public function actionSelesaiKering($id)
    {
        $siklus = SiklusSapi::findOrFail($id);
        $siklus->update(['status' => 'Selesai', 'keterangan' => 'Masa kering selesai. Sapi siap IB kembali.']);
        
        return back()->with('success', 'Masa kering selesai. Sapi kini siap untuk memulai siklus IB yang baru.');
    }

    private function checkAutoTransitions()
    {
        $today = Carbon::today()->toDateString();

        // 1. Transisi otomatis dari Bunting ke Laktasi setelah 9 bulan
        $buntingCycles = SiklusSapi::where('fase', 'Bunting')
            ->where('status', 'Berjalan')
            ->whereDate('estimasi_selesai', '<=', $today)
            ->get();

        foreach ($buntingCycles as $bunting) {
            $bunting->update([
                'status' => 'Selesai',
                'keterangan' => 'Sapi telah melahirkan (Transisi Otomatis)'
            ]);

            SiklusSapi::create([
                'sapi_id' => $bunting->sapi_id,
                'fase' => 'Laktasi',
                'tanggal_mulai' => $bunting->estimasi_selesai,
                'status' => 'Berjalan',
                'keterangan' => 'Memasuki fase Laktasi otomatis setelah masa bunting selesai.'
            ]);
        }

        // 2. Transisi otomatis dari Kering Kandang ke Selesai setelah 1 bulan
        $keringCycles = SiklusSapi::where('fase', 'Kering Kandang')
            ->where('status', 'Berjalan')
            ->whereDate('estimasi_selesai', '<=', $today)
            ->get();

        foreach ($keringCycles as $kering) {
            $kering->update([
                'status' => 'Selesai',
                'keterangan' => 'Masa kering selesai. Sapi siap IB kembali. (Transisi Otomatis)'
            ]);
        }
    }
}
