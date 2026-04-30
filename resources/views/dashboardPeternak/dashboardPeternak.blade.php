<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peternak - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #dcc8ae;
            color: #432118;
            margin: 0;
            overflow-x: hidden;
            display: flex;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background: #f0e2d0;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 30px 20px;
            border-right: 8px solid #5d7a54;
            box-shadow: 5px 0 15px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .brand h4 { font-family: 'Fredoka One', cursive; color: #432118; font-size: 24px; margin-bottom: 0; text-align: center; }
        .brand p { font-size: 14px; color: #845a33; margin-bottom: 40px; text-align: center; }
        .nav-menu { list-style: none; padding: 0; }
        .nav-item { margin-bottom: 12px; }
        .nav-link { text-decoration: none; color: #6d4c41; padding: 12px 18px; display: flex; align-items: center; border-radius: 15px; transition: 0.3s; font-weight: 700; }
        .nav-link i { margin-right: 12px; width: 20px; text-align: center; }
        .nav-link:hover, .nav-link.active { background: #5d7a54; color: #ffffff !important; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }

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

        /* Peternak Dashboard Specific */
        .alert-box {
            background-color: #fef0d7;
            border: 2px solid #f6c23e;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .alert-title {
            color: #a77000;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-list {
            margin: 0;
            padding-left: 20px;
            color: #856404;
            font-weight: 600;
            font-size: 15px;
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
        
        .icon-blue {
            background-color: #e0f2fe;
            color: #0ea5e9;
        }
        
        .icon-green {
            background-color: #dcfce7;
            color: #22c55e;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand"><h4>Cimilk Yogurt</h4><p>Peternak Dashboard</p></div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="{{ route('peternak.dashboard') }}" class="nav-link active"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('manajemen.akun') }}" class="nav-link"><i class="fa-solid fa-user-gear"></i> Manajemen Akun</a></li>
            <li class="nav-item"><a href="{{ route('sapi.index') }}" class="nav-link"><i class="fa-solid fa-cow"></i> Biodata Sapi</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-flask"></i> Produksi Susu</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-cart-shopping"></i> Penjualan</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="welcome-text">
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One';">Dashboard Peternak</h3>
                <p style="color: #6d4c41; font-weight: 600; margin-bottom: 0;">Selamat datang, {{ Auth::user()->name ?? 'Peternak' }}</p>
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
            <div class="alert-title">
                <i class="fa-solid fa-circle-exclamation"></i> Peringat Jadwal Hari Ini
            </div>
            <ul class="alert-list">
                <li>Sapi ID-01: Jadwal Inseminasi Buatan (IB)</li>
                <li>Sapi ID-05: Masa Kering Kandang</li>
            </ul>
        </div>

        <!-- Cards Section -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="dashboard-card">
                    <div class="card-info">
                        <h5>Tugas Input Hari Ini</h5>
                        <h2>3</h2>
                        <p>Kegiatan</p>
                    </div>
                    <div class="card-icon icon-blue">
                        <i class="fa-solid fa-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dashboard-card">
                    <div class="card-info">
                        <h5>Total Produksi Anda</h5>
                        <h2>15</h2>
                        <p>Liter</p>
                    </div>
                    <div class="card-icon icon-green">
                        <i class="fa-solid fa-flask"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Aksi Cepat -->
        <h4 class="fw-bold mb-3" style="color: #3a150c;">Aksi Cepat</h4>
        <!-- Placeholder for future actions -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
