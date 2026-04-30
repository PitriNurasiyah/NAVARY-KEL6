<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjualan - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #dcc8ae;
            color: #432118;
            margin: 0;
            overflow-x: hidden;
        }

        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 45px;
        }

        /* Header Styling */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .btn-logout {
            border: none;
            background: #5a1f12;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 700;
            color: #ffffff;
            box-shadow: 0 4px 0 #3a150c;
            transition: 0.2s;
        }

        .btn-logout:active {
            transform: translateY(3px);
            box-shadow: 0 1px 0 #3a150c;
        }

        /* Penjualan Dashboard Specific */
        .alert-box {
            background-color: #faf5ff; /* light purple */
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            color: #6b21a8;
            font-weight: 700;
            font-size: 16px;
        }

        .dashboard-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
        }

        .card-info h5 {
            color: #6d4c41;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .card-info h2 {
            font-family: 'Fredoka One', cursive;
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
            background: #ffffff;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid #e0e0e0;
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

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="welcome-text">
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One';">Dashboard Penjualan 🐄</h3>
                <p style="color: #6d4c41; font-weight: 600; margin-bottom: 0;">Selamat datang, {{ Auth::user()->name ?? 'Tim Penjualan' }}</p>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-sign-out-alt me-2"></i>Keluar
                </button>
            </form>
        </div>

        <!-- Alert Section -->
        <div class="alert-box">
            Stok Susu Tersedia: 120 Liter
        </div>

        <!-- Cards Section -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="card-info">
                        <h5>Penjualan Hari Ini</h5>
                        <h2>1.2Jt</h2>
                        <p>Rupiah</p>
                    </div>
                    <div class="card-icon icon-green">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="card-info">
                        <h5>Total Terjual</h5>
                        <h2>80</h2>
                        <p>Liter</p>
                    </div>
                    <div class="card-icon icon-blue">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="card-info">
                        <h5>Sisa Stok</h5>
                        <h2>40</h2>
                        <p>Liter</p>
                    </div>
                    <div class="card-icon icon-orange">
                        <i class="fa-solid fa-box"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Grafik Penjualan -->
        <div class="chart-card">
            <h5 class="fw-bold mb-3" style="color: #3a150c;">Grafik Penjualan Bulanan</h5>
            <div class="chart-placeholder">
                <i class="fa-solid fa-chart-area me-2"></i> Area Grafik Penjualan
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
