<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siklus Sapi - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">

    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        .page-title-section { margin-bottom: 25px; display: flex; align-items: center; gap: 15px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        
        .card-cow { background: #f5efe6; padding: 25px; border-radius: 20px; border: 4px solid #8CA685; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .timeline { position: relative; padding: 20px 0; margin-top: 20px; }
        .timeline::before { content: ''; position: absolute; left: 30px; top: 0; bottom: 0; width: 4px; background: #bc9f82; border-radius: 4px; }
        
        .timeline-item { position: relative; padding-left: 70px; margin-bottom: 30px; }
        .timeline-icon { position: absolute; left: 15px; top: 0; width: 34px; height: 34px; background: #fff; border: 4px solid #a67c52; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 1; color: #a67c52; font-size: 14px; }
        .timeline-content { background: white; padding: 20px; border-radius: 15px; border: 2px solid #e6d5c0; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .timeline-content h5 { font-family: 'Fredoka One', cursive; margin-bottom: 5px; color: #5a2c1b; }
        .timeline-content .date { color: #845a33; font-size: 13px; font-weight: bold; margin-bottom: 10px; display: block; }
        
        .status-badge { padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: bold; }
        
        .action-box { background: #f0e2d0; border: 2px dashed #a67c52; padding: 20px; border-radius: 15px; margin-top: 20px; text-align: center; }
        
        .chart-container { background: white; padding: 25px; border-radius: 15px; border: 2px solid #bc9f82; margin-top: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        
        .btn-action { background: #8CA685; color: white; border: none; padding: 10px 20px; border-radius: 10px; font-weight: bold; box-shadow: 0 4px 0 #5d7a54; transition: 0.2s; }
        .btn-action:hover { background: #5d7a54; transform: translateY(2px); box-shadow: 0 2px 0 #3a4d33; color: white; }
        .btn-danger-action { background: #c0392b; color: white; border: none; padding: 10px 20px; border-radius: 10px; font-weight: bold; box-shadow: 0 4px 0 #922b21; transition: 0.2s; }
        .btn-danger-action:hover { background: #a93226; transform: translateY(2px); box-shadow: 0 2px 0 #7b241c; color: white; }

        .form-control { border-radius: 10px; border: 2px solid #a67c52; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Siklus Sapi', 'pageSubtitle' => 'Detail alur siklus sapi'])

    <div class="main-content">
        <div class="page-title-section">
            <a href="{{ route('siklus.index') }}" class="btn btn-sm" style="background: #e6d5c0; color: #5a2c1b; border: 2px solid #bc9f82; border-radius: 10px; font-weight: bold;"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            <div>
                <h3>Detail Siklus: {{ $sapi->nama }} 🐄</h3>
                <p>ID: {{ $sapi->kode_sapi }} | Umur: {{ $sapi->umur ?? '-' }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="border-radius: 12px; font-weight: bold;"><i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" style="border-radius: 12px; font-weight: bold;"><i class="fa-solid fa-circle-xmark me-2"></i>{{ session('error') }}</div>
        @endif

        <div class="card-cow">
            @php
                $latest = $sapi->siklusSapi->first();
                $fase = $latest ? $latest->fase : null;
            @endphp
            
            <h4 style="font-family: 'Fredoka One', cursive; color: #432118; margin-bottom: 20px;">Tindakan Selanjutnya</h4>
            
            @if(!$fase || $fase == 'Kering Kandang' && $latest->status == 'Selesai')
                <div class="action-box">
                    <p class="mb-3 fw-bold" style="color: #6d4c41;"><i class="fa-solid fa-syringe fs-3 mb-2 d-block"></i> Sapi siap untuk memulai siklus baru (Inseminasi Buatan).</p>
                    <form action="{{ route('siklus.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sapi_id" value="{{ $sapi->id }}">
                        <input type="hidden" name="fase" value="IB">
                        <input type="hidden" name="tanggal_mulai" value="{{ date('Y-m-d') }}">
                        <button type="submit" class="btn btn-action"><i class="fa-solid fa-play me-2"></i>Mulai IB (Inseminasi Buatan)</button>
                    </form>
                </div>
            @elseif($fase == 'IB')
                @if($latest->status == 'Berjalan')
                @php $daysPassed = \Carbon\Carbon::parse($latest->tanggal_mulai)->diffInDays(\Carbon\Carbon::now()); @endphp
                <div class="action-box">
                    <p class="mb-3 fw-bold" style="color: #6d4c41;"><i class="fa-solid fa-magnifying-glass fs-3 mb-2 d-block"></i> Menunggu 14-21 hari setelah IB. (Sekarang Hari ke-{{ $daysPassed }}). Lakukan cek birahi untuk memastikan kehamilan.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <form action="{{ route('siklus.action.cek_birahi', $latest->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="hasil" value="berhasil">
                            <button type="submit" class="btn btn-action"><i class="fa-solid fa-check me-2"></i>Berhasil (Bunting)</button>
                        </form>
                        <form action="{{ route('siklus.action.cek_birahi', $latest->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="hasil" value="gagal">
                            <button type="submit" class="btn btn-danger-action"><i class="fa-solid fa-xmark me-2"></i>Gagal (Ulangi IB)</button>
                        </form>
                    </div>
                </div>
                @endif
            @elseif($fase == 'Bunting')
                @if($latest->status == 'Berjalan')
                @php $daysPassed = \Carbon\Carbon::parse($latest->tanggal_mulai)->diffInDays(\Carbon\Carbon::now()); @endphp
                <div class="action-box">
                    <p class="mb-3 fw-bold" style="color: #6d4c41;"><i class="fa-solid fa-baby-carriage fs-3 mb-2 d-block"></i> Masa kehamilan sapi (±9 bulan). Sudah berjalan: {{ $daysPassed }} hari.<br>Estimasi selesai: {{ \Carbon\Carbon::parse($latest->estimasi_selesai)->format('d/m/Y') }}</p>
                    <form action="{{ route('siklus.action.melahirkan', $latest->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-action" style="background: #4a6344; box-shadow: 0 4px 0 #3a4d33;"><i class="fa-solid fa-cow me-2"></i>Sapi Telah Melahirkan</button>
                    </form>
                </div>
                @endif
            @elseif($fase == 'Laktasi')
                @if($latest->status == 'Berjalan')
                @php $daysPassed = \Carbon\Carbon::parse($latest->tanggal_mulai)->diffInDays(\Carbon\Carbon::now()); @endphp
                <div class="action-box">
                    <p class="mb-3 fw-bold" style="color: #6d4c41;"><i class="fa-solid fa-jug-detergent fs-3 mb-2 d-block"></i> Masa Laktasi. Sapi sedang menghasilkan susu (Hari ke-{{ $daysPassed }}).</p>
                    <a href="{{ route('produksi.index') }}" class="btn btn-action mb-2"><i class="fa-solid fa-plus me-2"></i>Input Produksi Susu</a>
                    <form action="{{ route('siklus.action.kering', $latest->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-danger-action" style="background: #b91c1c; box-shadow: 0 4px 0 #7f1d1d;"><i class="fa-solid fa-stopwatch me-2"></i>Akhiri Laktasi & Mulai Masa Kering</button>
                    </form>
                </div>
                @endif
            @elseif($fase == 'Kering Kandang')
                @if($latest->status == 'Berjalan')
                @php $daysPassed = \Carbon\Carbon::parse($latest->tanggal_mulai)->diffInDays(\Carbon\Carbon::now()); @endphp
                <div class="action-box">
                    <p class="mb-3 fw-bold" style="color: #6d4c41;"><i class="fa-solid fa-bed fs-3 mb-2 d-block"></i> Masa Kering (Istirahat ±1 bulan). Sudah berjalan: {{ $daysPassed }} hari.</p>
                    <form action="{{ route('siklus.action.selesai_kering', $latest->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-action"><i class="fa-solid fa-check-double me-2"></i>Selesaikan Masa Kering</button>
                    </form>
                </div>
                @endif
            @endif
        </div>

        @if($laktasiChartData)
        <div class="chart-container">
            <h4 style="font-family: 'Fredoka One', cursive; color: #432118; margin-bottom: 20px;">Grafik Produksi Laktasi Terakhir (Per 100 Hari)</h4>
            <canvas id="laktasiChart" height="80"></canvas>
        </div>
        <script>
            const chartDataRaw = @json($laktasiChartData);
            const ctx = document.getElementById('laktasiChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartDataRaw.labels,
                    datasets: [
                        { 
                            label: 'Total Produksi (L)', 
                            data: chartDataRaw.data, 
                            backgroundColor: ['#8CA685', '#c0a080', '#d1b99a'] 
                        }
                    ]
                },
                options: { responsive: true, scales: { y: { beginAtZero: true } } }
            });
        </script>
        @endif

        <h4 style="font-family: 'Fredoka One', cursive; color: #432118; margin-bottom: 20px; margin-top: 40px;">Riwayat Siklus Sapi</h4>
        <div class="timeline">
            @forelse($sapi->siklusSapi as $sik)
            <div class="timeline-item">
                <div class="timeline-icon"><i class="fa-solid fa-circle-dot"></i></div>
                <div class="timeline-content">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5>{{ $sik->fase }}</h5>
                            <span class="date">{{ \Carbon\Carbon::parse($sik->tanggal_mulai)->format('d F Y') }}</span>
                            <p class="mb-0 text-muted">{{ $sik->keterangan ?? 'Tidak ada keterangan khusus.' }}</p>
                        </div>
                        <span class="status-badge {{ $sik->status == 'Selesai' ? 'bg-success text-white' : ($sik->status == 'Batal' ? 'bg-danger text-white' : 'bg-warning text-dark') }}">{{ $sik->status }}</span>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted text-center fw-bold" style="padding-left: 30px;">Belum ada riwayat siklus.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
