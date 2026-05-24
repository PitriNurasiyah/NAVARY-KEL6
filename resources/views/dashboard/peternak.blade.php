<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peternak - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f4efe6;
            background-attachment: fixed;
            color: #432118;
            margin: 0;
            overflow-x: hidden;
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 45px;
        }

        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        .stat-card {
            background: #fffcf7;
            padding: 25px;
            border-radius: 20px;
            border: 1.5px solid #e6d5c0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03);
            height: 100%;
            text-decoration: none;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: #bc9f82;
            box-shadow: 0 12px 25px rgba(0,0,0,0.08);
            background: #fffcf7;
        }

        .stat-info h2 {
            font-family: 'Playfair Display', serif;
            margin: 5px 0;
            font-size: 36px;
            font-weight: 700;
            color: #432118;
        }
        .stat-info span { color: #845a33; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; }
        .stat-unit { color: #5d7a54; font-weight: 800; font-size: 13px; }

        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .bg-custom-green { background: #5d7a54; color: #ffffff; }
        .bg-custom-blue { background: #5d7a54; color: #ffffff; }
        .bg-custom-brown { background: #845a33; color: #ffffff; }

        .notification-bar {
            background: #fffcf7;
            border: 1.5px solid #e6d5c0;
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 35px;
            font-size: 14px;
            color: #432118;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        }

        /* Data Sapi Section (view only) */
        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .section-header h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #432118;
            margin: 0;
            font-size: 20px;
        }
        .view-only-badge {
            background: rgba(93, 122, 84, 0.15);
            color: #5d7a54;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            border: 1px solid rgba(93, 122, 84, 0.3);
            text-transform: uppercase;
        }

        .cow-card { background: #faf6f0; padding: 20px; border-radius: 16px; border: 1.5px solid #e6d5c0; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        .cow-card h5 { font-family: 'Playfair Display', serif; font-weight: 700; color: #432118; font-size: 15px; margin-bottom: 6px; }
        .cow-card p { font-size: 13px; margin: 0; color: #6d4c41; font-weight: 600; }

        .cards-wrapper {
            display: flex;
            overflow-x: auto;
            gap: 15px;
            padding-bottom: 5px;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .cards-wrapper::-webkit-scrollbar { display: none; }

        /* Table */
        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; }
        .table thead th { background-color: #4a6344 !important; color: #ffffff !important; padding: 14px !important; text-transform: uppercase; font-size: 11px; border: 1px solid #bc9f82 !important; letter-spacing: 0.5px; }
        .table tbody td { padding: 14px !important; border: 1px solid #bc9f82 !important; font-weight: 600; background: #faf6f0; }
        .table-bordered-custom th, .table-bordered-custom td { border-left: 1px solid #bc9f82 !important; }
        .table-bordered-custom th:first-child, .table-bordered-custom td:first-child { border-left: none !important; }
        .table tbody tr:hover td { background-color: rgba(93, 122, 84, 0.05) !important; }
        .custom-table { width: 100%; overflow-x: auto; border-radius: 15px; }
    </style>
</head>
<body>

    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Dashboard Peternak', 'pageSubtitle' => 'Selamat datang di panel Peternak'])

    <!-- Main Content -->
    <div class="main-content">

        <div class="page-title-section">
            <h3>Hallo, {{ Auth::user()->name ?? 'Peternak' }}! 🐄</h3>
            <p>Selamat datang kembali di dashboard peternak.</p>
        </div>

        @if($alerts->count() > 0)
        <div class="notification-bar">
            <div class="fw-bold mb-2" style="color: #a77000; font-size: 16px;">
                <i class="fa-solid fa-circle-exclamation me-2"></i> Peringatan Jadwal Hari Ini
            </div>
            <ul class="mb-0 ps-3">
                @foreach($alerts as $alert)
                    <li>{{ $alert->sapi->nama ?? 'Sapi' }} ({{ $alert->sapi->kode_sapi }}): 
                        @if($alert->tanggal_mulai == date('Y-m-d'))
                            Mulai Fase {{ $alert->fase }}
                        @else
                            Estimasi Selesai Fase {{ $alert->fase }}
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        @else
        <div class="notification-bar">
            <i class="fa-solid fa-circle-info me-2" style="color: #845a33;"></i> Tidak ada jadwal khusus untuk hari ini. Tetap semangat bekerja!
        </div>
        @endif

        <!-- Cards Section -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-info">
                        <span>Populasi Sapi</span>
                        <h2>{{ $totalSapi }}</h2>
                        <div class="stat-unit">Ekor Sapi</div>
                    </div>
                    <div class="icon-circle bg-custom-green">
                        <i class="fa-solid fa-cow"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-info">
                        <span>Tugas Input Hari Ini</span>
                        <h2>{{ $tugasInput }}</h2>
                        <div class="stat-unit">Belum Diinput</div>
                    </div>
                    <div class="icon-circle bg-custom-blue">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-info">
                        <span>Total Produksi</span>
                        <h2>{{ number_format($totalProduksi, 0, ',', '.') }}</h2>
                        <div class="stat-unit">Liter Susu</div>
                    </div>
                    <div class="icon-circle bg-custom-brown">
                        <i class="fa-solid fa-bucket"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-4 mt-2 mb-4">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm" style="background-color: #faf6f0; border-radius: 25px; border: 1.5px solid #e6d5c0 !important;">
                    <h5 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #432118;"><i class="fa-solid fa-wheat-awn me-2" style="color: #845a33;"></i>Grafik Stok Pakan</h5>
                    <div style="height: 300px; position: relative;">
                        <canvas id="pakanChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4 shadow-sm" style="background-color: #faf6f0; border-radius: 25px; border: 1.5px solid #e6d5c0 !important;">
                    <h5 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #432118;"><i class="fa-solid fa-chart-line me-2" style="color: #5d7a54;"></i>Grafik Produksi Susu (7 Hari Terakhir)</h5>
                    <div style="height: 300px; position: relative;">
                        <canvas id="produksiChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data Stok Pakan
        const pakanLabels = {!! json_encode($pakanData->pluck('nama_pakan')) !!};
        const pakanStok = {!! json_encode($pakanData->pluck('total_stok')) !!};
        
        // Data Produksi Susu
        const produksiLabels = {!! json_encode($produksiData->map(function($d) { return \Carbon\Carbon::parse($d->tanggal)->format('d M'); })) !!};
        const produksiTotal = {!! json_encode($produksiData->pluck('total_produksi')) !!};

        // Render Pakan Chart (Bar)
        const ctxPakan = document.getElementById('pakanChart').getContext('2d');
        new Chart(ctxPakan, {
            type: 'bar',
            data: {
                labels: pakanLabels,
                datasets: [{
                    label: 'Stok (KG)',
                    data: pakanStok,
                    backgroundColor: '#845a33',
                    borderColor: '#432118',
                    borderWidth: 2,
                    borderRadius: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#432118', font: { family: 'Plus Jakarta Sans', weight: 'bold' } },
                        grid: { color: 'rgba(67, 33, 24, 0.1)' }
                    },
                    x: {
                        ticks: { color: '#432118', font: { family: 'Plus Jakarta Sans', weight: 'bold' } },
                        grid: { display: false }
                    }
                }
            }
        });

        // Render Produksi Chart (Line)
        const ctxProduksi = document.getElementById('produksiChart').getContext('2d');
        new Chart(ctxProduksi, {
            type: 'line',
            data: {
                labels: produksiLabels,
                datasets: [{
                    label: 'Total Produksi (Liter)',
                    data: produksiTotal,
                    borderColor: '#5d7a54',
                    backgroundColor: 'rgba(93, 122, 84, 0.2)',
                    borderWidth: 4,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#4a6344',
                    pointRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#432118', font: { family: 'Plus Jakarta Sans', weight: 'bold' } },
                        grid: { color: 'rgba(67, 33, 24, 0.1)' }
                    },
                    x: {
                        ticks: { color: '#432118', font: { family: 'Plus Jakarta Sans', weight: 'bold' } },
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
</body>
</html>
