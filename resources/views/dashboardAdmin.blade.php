<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Cimilk Yogurt</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #dcc8ae;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            display: flex;
            color: #432118;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #f0e2d0;
            position: fixed;
            padding: 30px 20px;
            border-right: 8px solid #5d7a54;
            box-shadow: 5px 0 15px rgba(0,0,0,0.1);
        }

        .brand h4 {
            font-family: 'Fredoka One', cursive;
            color: #432118;
            font-size: 24px;
            margin-bottom: 0;
        }
        .brand p { font-size: 14px; color: #845a33; margin-bottom: 40px; }

        .nav-menu { list-style: none; padding: 0; }
        .nav-item { margin-bottom: 12px; }
        .nav-link {
            text-decoration: none;
            color: #6d4c41;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            border-radius: 15px;
            transition: 0.3s;
            font-weight: 700;
        }

        .nav-link i { margin-right: 12px; width: 20px; text-align: center; }

        .nav-link:hover, .nav-link.active {
            background: #5d7a54;
            color: #ffffff !important;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 45px;
        }

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

        .notification-bar {
            background: #e6d5c0;
            border: 2px solid #a67c52;
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 35px;
            font-size: 14px;
            color: #432118;
            font-weight: 600;
        }

        .stat-card {
            background: #f0e2d0;
            padding: 25px;
            border-radius: 25px;
            border: 3px solid #bc9f82;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: #5d7a54;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        .stat-info h2 {
            font-family: 'Fredoka One', cursive;
            margin: 5px 0;
            font-size: 38px;
            color: #432118;
        }
        .stat-info span { color: #845a33; font-weight: 700; text-transform: uppercase; font-size: 12px; }
        .stat-unit { color: #5d7a54; font-weight: 800; }

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
        .bg-custom-brown { background: #845a33; color: #ffffff; }
        .bg-custom-tan { background: #a67c52; color: #ffffff; }

    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand">
            <h4>Cimilk Yogurt</h4>
            <p>Admin Dashboard</p>
        </div>

        <ul class="nav-menu">
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('sapi.index') }}"
                class="nav-link {{ request()->is('biodata-sapi') ? 'active' : '' }}">
                    <i class="fa-solid fa-cow"></i> Biodata Sapi
                </a>
            </li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-flask"></i> Produksi Susu</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-cart-shopping"></i> Penjualan</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-user-gear"></i> Manajemen Akun
        </a>
    </li>
</ul>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="welcome-text">
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One';">Halo, Admin! 🐮</h3>
                <p style="color: #6d4c41; font-weight: 600;">Selamat datang kembali di panel kontrol.</p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-sign-out-alt me-2"></i>Keluar
                </button>
            </form>
        </div>

        <div class="notification-bar">
            <i class="fa-solid fa-bell me-2" style="color: #5a1f12;"></i>
            <strong>Update Sistem:</strong> Sinkronisasi data peternakan berhasil diselesaikan hari ini.
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-info">
                        <span>Populasi Sapi</span>
                        <h2>50</h2>
                        <div class="stat-unit">Ekor Sehat</div>
                    </div>
                    <div class="icon-circle bg-custom-green"><i class="fa-solid fa-paw"></i></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-info">
                        <span>Hasil Produksi</span>
                        <h2>120</h2>
                        <div class="stat-unit">Liter Susu</div>
                    </div>
                    <div class="icon-circle bg-custom-brown"><i class="fa-solid fa-bucket"></i></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-info">
                        <span>Omzet Penjualan</span>
                        <h2>15jt</h2>
                        <div class="stat-unit">Rupiah</div>
                    </div>
                    <div class="icon-circle bg-custom-tan"><i class="fa-solid fa-coins"></i></div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
