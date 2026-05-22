<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }

        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }

        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        /* Filter Section */
        .filter-section {
            background: #f5efe6;
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 30px;
            border: 4px solid #bc9f82;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }
        .filter-title { font-weight: 800; font-size: 18px; margin-bottom: 15px; color: #432118; }
        .form-label { font-weight: 700; color: #5a2c1b; margin-bottom: 5px; font-size: 14px; }
        .form-control { border-radius: 12px; border: 2px solid #a67c52; padding: 10px; font-size: 14px; background-color: #fffdfa; }

        /* Summary Cards */
        .summary-wrapper { display: flex; gap: 20px; margin-bottom: 35px; }
        .summary-card {
            flex: 1;
            background: #fefefe;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 0 #bc9f82;
        }
        .summary-card p { margin: 0; font-weight: 700; color: #432118; font-size: 15px; }
        .summary-card h2 { margin: 10px 0 0; font-family: 'Fredoka One', cursive; font-size: 32px; color: #1a1a1a; }

        /* Table Section */
        .table-container {
            background: white;
            border-radius: 20px;
            padding: 0;
            border: 2px solid #bc9f82;
            overflow: hidden;
            margin-top: 10px;
        }
        .table { margin-bottom: 0; border-collapse: separate; border-spacing: 0; }
        .table thead th {
            background-color: #4a6344 !important;
            color: #ffffff !important;
            padding: 18px 15px;
            font-weight: 800;
            font-size: 13px;
            text-transform: uppercase;
            border: 1px solid #bc9f82 !important;
        }
        .table tbody td {
            padding: 15px;
            border: 1px solid #bc9f82 !important;
            font-weight: 600;
            color: #432118;
            background: white;
        }

        .btn-filter {
            background: #5d7a54; color: white; font-weight: 800; border: none; padding: 12px 25px; border-radius: 12px;
            box-shadow: 0 4px 0 #3a4d33; transition: 0.2s;
        }
        .btn-filter:hover { background: #4a6344; transform: translateY(-2px); color: white; }


        @media print {
            .sidebar, .top-header, .header, .filter-section, .btn-back, .btn-filter,
            .page-title-section p, .summary-wrapper, .mt-4, .toggle-group, .print-only-header {
                display: none !important;
            }
            body { background: white !important; padding: 0 !important; margin: 0 !important; }
            .main-content { margin: 0 !important; width: 100% !important; padding: 20px !important; }
            .table-container { border: none !important; border-radius: 0 !important; margin-top: 0 !important; padding: 0 !important; }
            .table { border: 1px solid #000 !important; width: 100% !important; border-collapse: separate !important; border-spacing: 0 !important; }
            .table thead th { background-color: #f0f0f0 !important; color: black !important; border: 1px solid #000 !important; -webkit-print-color-adjust: exact; padding: 10px !important; }
            .table tbody td { border: 1px solid #000 !important; color: black !important; -webkit-print-color-adjust: exact; padding: 10px !important; }
            .page-title-section { display: block !important; margin-bottom: 20px !important; }
            .page-title-section h3 { text-align: center; margin-bottom: 20px; font-size: 20px; color: black !important; }
        }
    </style>
</head>
<body>

    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Laporan Penjualan', 'pageSubtitle' => 'Rekapitulasi riwayat penjualan susu'])

    <div class="main-content">

        <!-- Judul khusus saat cetak -->
        <div class="print-only-header" style="display: none;">
            <h2 style="font-family: 'Fredoka One', cursive; color: #000; margin-bottom: 5px;">CIMILK YOGURT</h2>
            <h4 style="font-weight: 700; color: #000;">LAPORAN PENJUALAN HARIAN</h4>
            <hr style="border: 1px solid #000; margin-top: 10px;">
        </div>

        <div class="page-title-section">
            <h3>Riwayat Penjualan Susu 🧾</h3>
            <p>Lihat dan filter data penjualan susu Cimilk Yogurt.</p>
        </div>

        <!-- Filter Area -->
        <div class="filter-section">
            <div class="filter-title">Filter Tanggal</div>
            <form action="{{ route('laporan.penjualan') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" class="form-control" value="{{ request('dari_tanggal') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="sampai_tanggal" class="form-control" value="{{ request('sampai_tanggal') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <button type="submit" class="btn btn-filter w-100">
                            <i class="fa-solid fa-filter me-2"></i> Terapkan Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="summary-wrapper">
            <div class="summary-card" style="background: #fffdfa; border: 3px solid #bc9f82; box-shadow: 0 8px 0 #bc9f82; padding: 30px; border-radius: 15px; flex: 1;">
                <p style="color: #6d4c41; margin: 0; font-weight: 700; font-size: 15px;">Total Penjualan</p>
                <h2 style="font-family: 'Fredoka One', cursive; color: #432118; margin: 10px 0 0; font-size: 32px;">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h2>
            </div>
            <div class="summary-card" style="background: #fffdfa; border: 3px solid #bc9f82; box-shadow: 0 8px 0 #bc9f82; padding: 30px; border-radius: 15px; flex: 1;">
                <p style="color: #6d4c41; margin: 0; font-weight: 700; font-size: 15px;">Total Liter Terjual</p>
                <h2 style="font-family: 'Fredoka One', cursive; color: #432118; margin: 10px 0 0; font-size: 32px;">{{ number_format($totalLiter, 0, '.', ',') }} Liter</h2>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mb-3 text-end">
            <div class="dropdown d-inline-block">
                <button class="btn btn-filter dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-print me-2"></i> Cetak Laporan
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="dropdownMenuButton" style="border-radius: 12px; overflow: hidden; border: 2px solid #bc9f82 !important;">
                    <li><a class="dropdown-item py-2 fw-bold" href="#" onclick="exportToExcel('dataTable', 'Laporan_Penjualan'); return false;" style="color: #217346;"><i class="fa-solid fa-file-excel me-2"></i>Cetak Excel</a></li>
                    <li><hr class="dropdown-divider m-0" style="border-color: #bc9f82;"></li>
                    <li><a class="dropdown-item py-2 fw-bold" href="#" onclick="window.print(); return false;" style="color: #c0392b;"><i class="fa-solid fa-file-pdf me-2"></i>Cetak PDF</a></li>
                </ul>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table align-middle" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal Jual</th>
                            <th>Pembeli</th>
                            <th>Jumlah (Liter)</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-end">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penjualan as $item)
                        <tr>
                            <td><span class="text-primary font-monospace">TRX-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</td>
                            <td>{{ $item->pembeli }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td class="text-end">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="text-end fw-bold text-dark">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <span class="text-muted italic">Tidak ada data penjualan untuk periode ini.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        function exportToExcel(tableId, filename) {
            var wb = XLSX.utils.table_to_book(document.getElementById(tableId), {sheet: "Laporan"});
            XLSX.writeFile(wb, filename + ".xlsx");
        }
    </script>
</body>
</html>
