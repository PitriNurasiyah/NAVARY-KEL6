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

        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        .action-buttons { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        
        .btn-print { background: #5d7a54; color: white; border: none; padding: 12px 25px; border-radius: 12px; font-weight: 700; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; }
        .btn-print:hover { background: #4a6344; transform: translateY(-2px); box-shadow: 0 6px 0 #3a4d33; color: white; }
        .btn-print:active { transform: translateY(2px); box-shadow: 0 2px 0 #3a4d33; }

        .btn-back { background: #e2e8f0; color: #475569; border: none; padding: 12px 25px; border-radius: 12px; font-weight: 700; text-decoration: none; transition: 0.2s; display: inline-flex; align-items: center; gap: 8px; }
        .btn-back:hover { background: #cbd5e1; color: #1e293b; }

        .custom-table { border-collapse: separate; border-spacing: 0; width: 100%; border-radius: 15px; overflow: hidden; border: 1px solid #bc9f82; }
        .custom-table thead th { background-color: #5d7a54 !important; color: white !important; padding: 18px 15px; text-transform: uppercase; font-size: 13px; border: 1px solid #bc9f82 !important; }
        .custom-table tbody td { padding: 15px; border: 1px solid #bc9f82 !important; font-weight: 600; background: white; }

        @media print {
            .sidebar, .top-header, .header, .btn-print, .btn-back, .page-title-section p, .brand, .sidebar-toggle { 
                display: none !important; 
            }
            body { background: white !important; padding: 0 !important; margin: 0 !important; }
            .main-content { margin: 0 !important; width: 100% !important; padding: 20px !important; }
            .custom-table { border: 1px solid #000 !important; width: 100% !important; }
            .custom-table thead th { background-color: #f0f0f0 !important; color: black !important; border: 1px solid #000 !important; -webkit-print-color-adjust: exact; }
            .custom-table tbody td { border: 1px solid #000 !important; color: black !important; -webkit-print-color-adjust: exact; }
            .page-title-section h3 { text-align: center; margin-bottom: 20px; font-size: 20px; }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Laporan Penjualan', 'pageSubtitle' => 'Rekapitulasi performa penjualan yogurt'])

    <div class="main-content">
        <div class="page-title-section">
            <h3>Laporan Penjualan 📈</h3>
            <p>Daftar lengkap transaksi penjualan Cimilk Yogurt.</p>
        </div>

        <div class="action-buttons">
            <a href="{{ route('laporan.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <button class="btn-print" onclick="window.print()">
                <i class="fa-solid fa-print me-2"></i> Cetak Laporan
            </button>
        </div>

        <div class="table-responsive">
            <table class="table custom-table align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px;">NO</th>
                        <th>TANGGAL</th>
                        <th>PRODUK</th>
                        <th>JUMLAH</th>
                        <th class="text-end">TOTAL HARGA</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjualan as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal ?? $item->created_at)->format('d F Y') }}</td>
                        <td class="fw-bold">{{ $item->produk ?? 'Yogurt Original' }}</td>
                        <td>{{ $item->jumlah ?? 0 }} Unit</td>
                        <td class="text-end">
                            <span class="badge bg-success px-3 py-2" style="border-radius: 8px; font-size: 14px; font-weight: 700;">
                                Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="fa-solid fa-cart-shopping mb-3 d-block" style="font-size: 48px; color: #bc9f82;"></i>
                            <span class="text-muted">Belum ada data transaksi penjualan.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
