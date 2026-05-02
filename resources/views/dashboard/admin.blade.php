<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Cimilk Yogurt</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #dcc8ae;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            display: flex;
            color: #432118;
            overflow-x: hidden;
        }
        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 45px;
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

        /* Page title below header */
        .page-title-section {
            margin-bottom: 30px;
        }
        .page-title-section h3 {
            font-family: 'Fredoka One', cursive;
            font-size: 26px;
            color: #432118;
            margin: 0 0 4px 0;
        }
        .page-title-section p {
            color: #6d4c41;
            font-weight: 600;
            margin: 0;
        }
    </style>
</head>
<body>

    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Dashboard Admin', 'pageSubtitle' => 'Selamat datang di panel Admin'])

    <div class="main-content">

        <div class="page-title-section">
            <h3>Hallo, {{ Auth::user()->name ?? 'Admin' }}! 🐮</h3>
            <p>Selamat datang kembali di dashboard admin.</p>
        </div>

        @if(session('success'))
        <div class="notification-bar alert alert-dismissible fade show" role="alert" style="background-color: #dcfce7; border-color: #22c55e; color: #166534;">
            <i class="fa-solid fa-circle-check me-2"></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @else
        <div class="notification-bar alert alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-bell me-2" style="color: #5a1f12;"></i>
            <strong>Update Sistem:</strong> Sinkronisasi data berhasil. Selamat bekerja, {{ Auth::user()->name ?? 'Admin' }}!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row g-4">
            <div class="col-md-4">
                <a href="{{ route('sapi.index') }}" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="stat-info">
                            <span>Populasi Sapi</span>
                            <h2>{{ $totalSapi ?? 0 }}</h2>
                            <div class="stat-unit">Ekor</div>
                        </div>
                        <div class="icon-circle bg-custom-green"><i class="fa-solid fa-paw"></i></div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('produksi.index') }}" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="stat-info">
                            <span>Hasil Produksi</span>
                            <h2>{{ $totalProduksi ?? 0 }}</h2>
                            <div class="stat-unit">Liter Susu</div>
                        </div>
                        <div class="icon-circle bg-custom-brown"><i class="fa-solid fa-bucket"></i></div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('penjualan.data') }}" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="stat-info">
                            <span>Omzet Penjualan</span>
                            <h2>Rp{{ number_format($totalPenjualan ?? 0, 0, ',', '.') }}</h2>
                            <div class="stat-unit">Rupiah</div>
                        </div>
                        <div class="icon-circle bg-custom-tan"><i class="fa-solid fa-coins"></i></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
