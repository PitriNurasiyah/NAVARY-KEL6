<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Penjualan - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">
    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .btn-logout { border: none; background: #5a1f12; padding: 8px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a150c; transition: 0.2s; }
        .form-card { background: #f0e2d0; padding: 30px; border-radius: 25px; border: 3px solid #bc9f82; }
        .btn-submit { background: #5d7a54; color: white; border: none; padding: 10px 30px; border-radius: 12px; font-weight: 700; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; }
        .btn-submit:hover { background: #4a6344; color: white; }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    <div class="main-content">
        <div class="header">
            <div class="welcome-text">
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One';">Input Penjualan 🛒</h3>
                <p style="color: #6d4c41; font-weight: 600; margin-bottom: 0;">Catat transaksi penjualan harian.</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-sign-out-alt me-2"></i>Keluar
                </button>
            </form>
        </div>
        <div class="form-card">
            <h5 class="fw-bold mb-4" style="color: #3a150c;">Form Transaksi Baru</h5>
            <form>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nama Produk</label>
                        <select class="form-select" style="border-radius: 10px;">
                            <option>Susu Segar</option>
                            <option>Yogurt</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jumlah (Liter/Cup)</label>
                        <input type="number" class="form-control" style="border-radius: 10px;">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Total Harga</label>
                        <input type="text" class="form-control" style="border-radius: 10px;" readonly>
                    </div>
                    <div class="col-md-12 text-end mt-4">
                        <button type="button" class="btn-submit">Simpan Transaksi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
