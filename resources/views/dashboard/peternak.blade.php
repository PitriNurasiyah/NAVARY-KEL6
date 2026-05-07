<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peternak - Cimilk Yogurt</title>
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
            display: flex;
        }

        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 45px;
        }

        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

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
            height: 100%;
            text-decoration: none;
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
        .stat-unit { color: #5d7a54; font-weight: 800; font-size: 14px; }

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
        .bg-custom-blue { background: #799cd1ff; color: #ffffff; }
        .bg-custom-brown { background: #845a33; color: #ffffff; }

        .notification-bar {
            background: #fef0d7;
            border: 2px solid #f6c23e;
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 35px;
            font-size: 14px;
            color: #432118;
            font-weight: 600;
        }

        /* Data Sapi Section (view only) */
        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .section-header h4 {
            font-family: 'Fredoka One', cursive;
            color: #432118;
            margin: 0;
            font-size: 22px;
        }
        .view-only-badge {
            background: #e6d5c0;
            color: #845a33;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            border: 1.5px solid #bc9f82;
            text-transform: uppercase;
        }

        .cow-card { background: #f0e2d0; padding: 20px; border-radius: 20px; border: 3px solid #bc9f82; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .cow-card h5 { font-family: 'Fredoka One', cursive; color: #432118; font-size: 16px; margin-bottom: 6px; }
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
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 14px !important; text-transform: uppercase; font-size: 12px; border: 1px solid #bc9f82 !important; }
        .table tbody td { padding: 14px !important; border: 1px solid #bc9f82 !important; font-weight: 600; }
        .table-bordered-custom th, .table-bordered-custom td { border-left: 1px solid #bc9f82 !important; }
        .table-bordered-custom th:first-child, .table-bordered-custom td:first-child { border-left: none !important; }
        .table tbody tr:hover { background-color: rgba(93, 122, 84, 0.05) !important; }
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
        <div class="notification-bar" style="background: #e6f7ff; border-color: #91d5ff; color: #0050b3;">
            <i class="fa-solid fa-circle-info me-2"></i> Tidak ada jadwal khusus untuk hari ini. Tetap semangat bekerja!
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



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
