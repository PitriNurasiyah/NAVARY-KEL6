<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">
    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        .placeholder-card { background: #f0e2d0; padding: 50px; border-radius: 25px; border: 3px dashed #bc9f82; text-align: center; }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Laporan Penjualan', 'pageSubtitle' => 'Analisis performa penjualan bulanan'])
    <div class="main-content">
        <h3 class="fw-bold mb-1" style="font-family: 'Fredoka One'; color: #432118;">Laporan Penjualan 📈</h3>
        <p style="color: #6d4c41; font-weight: 600; margin-bottom: 25px;">Analisis performa penjualan bulanan.</p>
        <div class="placeholder-card">
            <i class="fa-solid fa-file-contract mb-4" style="font-size: 64px; color: #a67c52; opacity: 0.5;"></i>
            <h4 class="fw-bold" style="color: #432118;">Halaman Laporan Penjualan</h4>
            <p class="text-muted">Fitur laporan penjualan sedang dalam tahap integrasi data.</p>
        </div>
    </div>
</body>
</html>
