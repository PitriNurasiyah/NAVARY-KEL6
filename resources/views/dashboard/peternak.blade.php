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
            background: linear-gradient(135deg, #fffdfa 0%, #faf6ef 100%);
            border: 1px solid #e8dec9;
            border-left: 5px solid #5d7a54;
            padding: 16px 24px;
            border-radius: 16px;
            margin-bottom: 35px;
            font-size: 14px;
            color: #432118;
            font-weight: 600;
            box-shadow: 0 6px 15px rgba(93, 122, 84, 0.03);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        .notification-bar:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(93, 122, 84, 0.07);
            border-color: #d8cdb6;
        }
        .notification-icon-wrapper {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: rgba(93, 122, 84, 0.1);
            color: #5d7a54;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 14px;
            flex-shrink: 0;
        }

        /* Task Board Styling */
        .task-board-container {
            background: linear-gradient(135deg, #fffcf7 0%, #faf6ef 100%);
            border: 1.5px solid #e6d5c0;
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 35px;
            box-shadow: 0 10px 25px rgba(93, 122, 84, 0.03);
        }
        .task-board-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 1.5px dashed #e6d5c0;
            padding-bottom: 20px;
            gap: 15px;
        }
        .task-board-icon {
            width: 48px;
            height: 48px;
            background: rgba(93, 122, 84, 0.1);
            color: #5d7a54;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .task-board-title-group h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            color: #432118;
            margin: 0 0 3px 0;
            font-size: 20px;
        }
        .task-board-title-group p {
            color: #6d4c41;
            font-size: 13px;
            margin: 0;
            font-weight: 600;
        }
        .task-item-card {
            background: #ffffff;
            border: 1px solid #e6d5c0;
            border-radius: 18px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.015);
            height: 100%;
        }
        .task-item-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(93, 122, 84, 0.08);
            border-color: #bc9f82;
        }
        .task-item-indicator {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 5px;
        }
        .task-item-icon-circle {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #faf6f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .task-item-info {
            flex-grow: 1;
        }
        .task-item-info h5 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #432118;
            margin: 0 0 2px 0;
            font-size: 16px;
        }
        .task-item-code {
            font-size: 11px;
            font-weight: 700;
            color: #845a33;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .badge-action-start {
            background-color: rgba(93, 122, 84, 0.15) !important;
            color: #5d7a54 !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            padding: 5px 12px !important;
            border-radius: 8px !important;
        }
        .badge-action-end {
            background-color: rgba(212, 163, 115, 0.15) !important;
            color: #845a33 !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            padding: 5px 12px !important;
            border-radius: 8px !important;
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
        .table thead th { background-color: #4a6344 !important; color: #ffffff !important; padding: 14px !important; text-transform: uppercase; font-size: 11px; border: 1px solid #bc9f82 !important; letter-spacing: 0.5px; text-align: center !important; }
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
        <div class="task-board-container">
            <div class="task-board-header">
                <div class="task-board-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <div class="task-board-title-group">
                    <h4>Jadwal & Tugas Hari Ini</h4>
                    <p>Daftar fase siklus sapi yang memerlukan tindakan hari ini</p>
                </div>
                <span class="badge bg-custom-green px-3 py-2 rounded-pill ms-auto" style="font-weight: 700; font-size: 12px;">
                    {{ $alerts->count() }} Tugas
                </span>
            </div>
            <div class="row g-3">
                @foreach($alerts as $alert)
                    <div class="col-md-6">
                        <div class="task-item-card">
                            <div class="task-item-indicator" style="background-color: {{ $alert->fase === 'Kering' ? '#5d7a54' : ($alert->fase === 'Melahirkan' ? '#c0392b' : '#845a33') }};"></div>
                            <div class="task-item-icon-circle">
                                <i class="fa-solid fa-cow" style="color: {{ $alert->fase === 'Kering' ? '#5d7a54' : ($alert->fase === 'Melahirkan' ? '#c0392b' : '#845a33') }};"></i>
                            </div>
                            <div class="task-item-info">
                                <h5>{{ $alert->sapi->nama ?? 'Sapi' }}</h5>
                                <span class="task-item-code">{{ $alert->sapi->kode_sapi }}</span>
                                <div class="task-item-action mt-2">
                                    @if($alert->tanggal_mulai == date('Y-m-d'))
                                        <span class="badge badge-action-start"><i class="fa-solid fa-play me-1"></i> Mulai Fase {{ $alert->fase }}</span>
                                    @else
                                        <span class="badge badge-action-end"><i class="fa-solid fa-flag-checkered me-1"></i> Selesai Fase {{ $alert->fase }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="notification-bar">
            <span class="notification-icon-wrapper"><i class="fa-solid fa-circle-info"></i></span>
            <div>Tidak ada jadwal khusus untuk hari ini. Tetap semangat bekerja!</div>
        </div>
        @endif

        <!-- Cards Section -->
        <div class="cards-wrapper mb-4">
            <div class="stat-card flex-shrink-0" style="width: 280px;">
                <div class="stat-info">
                    <span>Populasi Sapi</span>
                    <h2>{{ $totalSapi }}</h2>
                    <div class="stat-unit">Ekor Sapi</div>
                </div>
                <div class="icon-circle bg-custom-green">
                    <i class="fa-solid fa-cow"></i>
                </div>
            </div>
            <div class="stat-card flex-shrink-0" style="width: 280px;">
                <div class="stat-info">
                    <span>Tugas Input Hari Ini</span>
                    <h2>{{ $tugasInput }}</h2>
                    <div class="stat-unit">Belum Diinput</div>
                </div>
                <div class="icon-circle bg-custom-blue">
                    <i class="fa-solid fa-clipboard-check"></i>
                </div>
            </div>
            <div class="stat-card flex-shrink-0" style="width: 280px;">
                <div class="stat-info">
                    <span>Total Produksi</span>
                    <h2>{{ number_format($totalProduksi, 0, ',', '.') }}</h2>
                    <div class="stat-unit">Liter Susu</div>
                </div>
                <div class="icon-circle bg-custom-brown">
                    <i class="fa-solid fa-bucket"></i>
                </div>
            </div>
            <div class="stat-card flex-shrink-0" style="width: 280px;">
                <div class="stat-info">
                    <span>Total Persediaan Pakan</span>
                    <h2>{{ number_format($totalStok, 0, ',', '.') }}</h2>
                    <div class="stat-unit">KG Pakan</div>
                </div>
                <div class="icon-circle bg-custom-green">
                    <i class="fa-solid fa-warehouse"></i>
                </div>
            </div>
            <div class="stat-card flex-shrink-0" style="width: 280px;">
                <div class="stat-info">
                    <span>Total Pakan Digunakan</span>
                    <h2>{{ number_format($totalDigunakan, 0, ',', '.') }}</h2>
                    <div class="stat-unit">KG Pakan</div>
                </div>
                <div class="icon-circle bg-custom-brown">
                    <i class="fa-solid fa-utensils"></i>
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
