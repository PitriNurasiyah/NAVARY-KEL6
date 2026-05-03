<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Admin - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">
    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        .report-card { background: #f0e2d0; padding: 30px; border-radius: 25px; border: 3px solid #bc9f82; text-align: center; transition: 0.3s; display: block; text-decoration: none; color: inherit; height: 100%; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .report-card:hover { transform: translateY(-5px); border-color: #5d7a54; box-shadow: 0 8px 15px rgba(0,0,0,0.1); }
        .icon-wrapper { width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 36px; margin: 0 auto 20px auto; color: white; }
        .bg-custom-green { background: #5d7a54; }
        .bg-custom-tan { background: #a67c52; }
        .report-card h4 { font-family: 'Fredoka One', cursive; margin-bottom: 10px; color: #432118; }
        .report-card p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Laporan', 'pageSubtitle' => 'Rekapitulasi data seluruh sistem'])
    <div class="main-content">
        <h3 class="fw-bold mb-1" style="font-family: 'Fredoka One'; color: #432118;">Laporan Admin 📊</h3>
        <p style="color: #6d4c41; font-weight: 600; margin-bottom: 25px;">Rekapitulasi data seluruh sistem.</p>
        <div class="row g-4 mt-2">
            <div class="col-md-6">
                <a href="{{ route('laporan.produksi') }}" class="report-card">
                    <div class="icon-wrapper bg-custom-green">
                        <i class="fa-solid fa-flask"></i>
                    </div>
                    <h4>Laporan Produksi Susu</h4>
                    <p>Lihat rekap data produksi susu sapi harian dan bulanan.</p>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('penjualan.laporan') }}" class="report-card">
                    <div class="icon-wrapper bg-custom-tan">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h4>Laporan Penjualan Bulanan</h4>
                    <p>Lihat rekapitulasi data transaksi penjualan per bulan.</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
