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
        
        .icon-blue { background-color: #e0f2fe; color: #0ea5e9; }
        .icon-green { background-color: #dcfce7; color: #22c55e; }

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

        <!-- Alert Section -->
        <div class="alert-box">
            <div class="alert-title">
                <i class="fa-solid fa-circle-exclamation"></i> Peringatan Jadwal Hari Ini
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



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
