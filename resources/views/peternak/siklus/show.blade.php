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
        .page-title-section { margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between; }
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
        .btn-back { border: none; background: #845a33; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #5a1f12; transition: 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-back:hover { background: #6d4c41; color: #fff; transform: translateY(-2px); }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Siklus Sapi', 'pageSubtitle' => 'Detail alur siklus sapi'])

    <div class="main-content">
        <div class="page-title-section">
            <div>
                <h3>Detail Siklus: {{ $sapi->nama }} 🐄</h3>
                <p>ID: {{ $sapi->kode_sapi }} | Umur: {{ $sapi->umur ?? '-' }}</p>
            </div>
            <a href="{{ route('siklus.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left me-2"></i> Kembali</a>
        </div>


        {{-- Flash messages are automatically captured by the header notification system --}}

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
                @php $daysPassed = intval(\Carbon\Carbon::parse($latest->tanggal_mulai)->diffInDays(\Carbon\Carbon::now()) + 1); @endphp
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
                @php $daysPassed = intval(\Carbon\Carbon::parse($latest->tanggal_mulai)->diffInDays(\Carbon\Carbon::now()) + 1); @endphp
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
                @php $daysPassed = intval(\Carbon\Carbon::parse($latest->tanggal_mulai)->diffInDays(\Carbon\Carbon::now()) + 1); @endphp
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
                @php $daysPassed = intval(\Carbon\Carbon::parse($latest->tanggal_mulai)->diffInDays(\Carbon\Carbon::now()) + 1); @endphp
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
                        <div class="text-end">
                            <span class="status-badge {{ $sik->status == 'Selesai' ? 'bg-success text-white' : ($sik->status == 'Batal' ? 'bg-danger text-white' : 'bg-warning text-dark') }} d-inline-block mb-2">{{ $sik->status }}</span>
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('siklus.edit', $sik->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: bold; border-color: #bc9f82; color: #5a2c1b;"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                <form action="{{ route('siklus.destroy', $sik->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siklus ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: bold;"><i class="fa-solid fa-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </div>
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
