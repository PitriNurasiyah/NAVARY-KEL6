<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjualan - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4efe6;
            color: #432118;
            margin: 0;
            overflow-x: hidden;
            display: flex;
        }

        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 45px;
        }

        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        .alert-box {
            background: linear-gradient(135deg, #fffdfa 0%, #faf6ef 100%);
            border: 1px solid #e8dec9;
            border-left: 5px solid #5d7a54;
            padding: 16px 24px;
            border-radius: 16px;
            margin-bottom: 30px;
            font-size: 15px;
            color: #432118;
            font-weight: 700;
            box-shadow: 0 6px 15px rgba(93, 122, 84, 0.03);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        .alert-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(93, 122, 84, 0.07);
            border-color: #d8cdb6;
        }
        .alert-icon-wrapper {
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

        .dashboard-card {
            background: #fffcf7;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03);
            border: 1.5px solid #e6d5c0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
            transition: 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            border-color: #bc9f82;
            box-shadow: 0 12px 25px rgba(0,0,0,0.08);
        }

        .card-info h5 {
            color: #6d4c41;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .card-info h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #3a150c;
            font-size: 32px;
            margin: 0;
        }
        
        .card-info p {
            color: #8f7267;
            font-size: 14px;
            margin: 0;
            font-weight: 600;
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .icon-green { background-color: #dcfce7; color: #22c55e; }
        .icon-blue { background-color: #e0f2fe; color: #0ea5e9; }
        .icon-orange { background-color: #ffedd5; color: #f97316; }

        .chart-card {
            background: #fffcf7;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03);
            border: 1.5px solid #e6d5c0;
        }

        .chart-placeholder {
            background-color: #f3f4f6;
            height: 300px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-weight: 600;
        }
    </style>
</head>
<body>

    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Dashboard Penjualan', 'pageSubtitle' => 'Selamat datang di panel Manajemen Penjualan'])

    <!-- Main Content -->
    <div class="main-content">

        <div class="page-title-section">
            <h3>Hallo, {{ Auth::user()->name ?? 'Penjualan' }}! 🐄</h3>
        </div>

        <!-- Alert Section -->
        <div class="alert-box">
            <span class="alert-icon-wrapper"><i class="fa-solid fa-boxes-stacking"></i></span>
            <div>Stok Susu Tersedia: <strong style="color: #5d7a54;">{{ number_format($stokSusu, 0, '.', ',') }} Liter</strong></div>
        </div>

        <!-- Cards Section -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <a href="{{ route('penjualan.data') }}" class="text-decoration-none">
                    <div class="dashboard-card">
                        <div class="card-info">
                            <h5>Penjualan Hari Ini</h5>
                            <h2>Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</h2>
                            <p>Rupiah</p>
                        </div>
                        <div class="card-icon icon-green">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('penjualan.data') }}" class="text-decoration-none">
                    <div class="dashboard-card">
                        <div class="card-info">
                            <h5>Total Terjual</h5>
                            <h2>{{ number_format($totalTerjual, 0, '.', ',') }}</h2>
                            <p>Liter</p>
                        </div>
                        <div class="card-icon icon-blue">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="#" class="text-decoration-none">
                    <div class="dashboard-card">
                        <div class="card-info">
                            <h5>Sisa Stok</h5>
                            <h2>{{ number_format($stokSusu, 0, '.', ',') }}</h2>
                            <p>Liter</p>
                        </div>
                        <div class="card-icon icon-orange">
                            <i class="fa-solid fa-box"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- Grafik Penjualan -->
        <div class="chart-card">
            <h5 class="fw-bold mb-3" style="color: #3a150c;">Grafik Penjualan Tahun {{ date('Y') }}</h5>
            <div style="height: 300px; position: relative;">
                <canvas id="dashboardSalesChart"></canvas>
            </div>
        </div>

    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const ctx = document.getElementById('dashboardSalesChart').getContext('2d');
        
        // Data derived from controller (needs to be added)
        const labels = @json($labels ?? ['Jan', 'Feb', 'Mar']);
        const data = @json($revenues ?? [0, 0, 0]);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: data,
                    borderColor: '#5d7a54',
                    backgroundColor: 'rgba(93, 122, 84, 0.15)',
                    borderWidth: 3,
                    fill: false,
                    tension: 0.3,
                    pointBackgroundColor: '#5d7a54',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Pendapatan: Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f0f0f0' },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>
