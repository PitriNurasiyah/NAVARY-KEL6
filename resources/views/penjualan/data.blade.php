<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">
    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .btn-logout { border: none; background: #5a1f12; padding: 8px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a150c; transition: 0.2s; }
        .table-card { background: #f0e2d0; padding: 25px; border-radius: 25px; border: 3px solid #bc9f82; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 16px; border: 1px solid #bc9f82 !important; text-transform: uppercase; font-size: 13px; }
        .table tbody td { padding: 16px; border: 1px solid #bc9f82 !important; font-weight: 600; }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    <div class="main-content">
        <div class="header">
            <div class="welcome-text">
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One';">Data Penjualan 📑</h3>
                <p style="color: #6d4c41; font-weight: 600; margin-bottom: 0;">Riwayat transaksi penjualan Cimilk.</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-sign-out-alt me-2"></i>Keluar
                </button>
            </form>
        </div>
        <div class="table-card">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>TANGGAL</th>
                            <th>PRODUK</th>
                            <th>JUMLAH</th>
                            <th>TOTAL</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada data transaksi yang tersimpan.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
