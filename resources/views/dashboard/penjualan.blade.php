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
            background-color: #fffcf7;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            color: #432118;
            font-weight: 700;
            font-size: 16px;
            border: 1.5px solid #e6d5c0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
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
            <i class="fa-solid fa-boxes-stacking me-2"></i> Stok Susu Tersedia: <strong>{{ number_format($stokSusu, 0, '.', ',') }} Liter</strong>
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
            <h5 class="fw-bold mb-3" style="color: #3a150c;">Grafik Penjualan Bulanan</h5>
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
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: data,
                    backgroundColor: '#5d7a54',
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>
