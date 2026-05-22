<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produksi - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">

    <style>
        body { background-color: #f5efe6; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }

        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        .action-buttons { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        
        .btn-print { background: #5d7a54; color: white; border: none; padding: 12px 25px; border-radius: 12px; font-weight: 700; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; }
        .btn-print:hover { background: #4a6344; transform: translateY(-2px); box-shadow: 0 6px 0 #3a4d33; color: white; }
        .btn-print:active { transform: translateY(2px); box-shadow: 0 2px 0 #3a4d33; }

        .btn-back { border: none; background: #845a33; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #152414; transition: 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-back:hover { background: #6d4c41; color: #fff; transform: translateY(-2px); box-shadow: 0 6px 0 #152414; }
        .btn-back:active { transform: translateY(2px); box-shadow: 0 2px 0 #152414; }

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
    @include('layouts.header', ['pageTitle' => 'Laporan Produksi', 'pageSubtitle' => 'Rekapitulasi hasil produksi susu sapi'])

    <div class="main-content">
        <div class="page-title-section">
            <h3>Laporan Produksi Susu 🥛</h3>
            <p>Daftar lengkap hasil produksi susu dari seluruh sapi.</p>
        </div>

        <div class="action-buttons">
            <a href="{{ route('laporan.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <div class="dropdown">
                <button class="btn-print dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-print me-2"></i> Cetak Laporan
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="dropdownMenuButton" style="border-radius: 12px; overflow: hidden; border: 2px solid #bc9f82 !important;">
                    <li><a class="dropdown-item py-2 fw-bold" href="#" onclick="exportToExcel('dataTable', 'Laporan_Produksi'); return false;" style="color: #217346;"><i class="fa-solid fa-file-excel me-2"></i>Cetak Excel</a></li>
                    <li><hr class="dropdown-divider m-0" style="border-color: #bc9f82;"></li>
                    <li><a class="dropdown-item py-2 fw-bold" href="#" onclick="window.print(); return false;" style="color: #c0392b;"><i class="fa-solid fa-file-pdf me-2"></i>Cetak PDF</a></li>
                </ul>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table custom-table align-middle" id="dataTable">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px;">NO</th>
                        <th>TANGGAL</th>
                        <th>ID SAPI</th>
                        <th>PAGI (L)</th>
                        <th>SORE (L)</th>
                        <th class="text-center">TOTAL HARIAN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produksi as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                        <td class="fw-bold text-success">{{ $item->sapi->kode_sapi ?? 'N/A' }}</td>
                        <td>{{ $item->jumlah_pagi }} Liter</td>
                        <td>{{ $item->jumlah_sore }} Liter</td>
                        <td class="text-center">
                            <span class="badge bg-success px-3 py-2" style="border-radius: 8px; font-size: 14px;">
                                {{ $item->total }} L
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fa-solid fa-folder-open mb-3 d-block" style="font-size: 48px; color: #bc9f82;"></i>
                            <span class="text-muted">Belum ada data produksi yang tercatat.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $produksi->links() }}
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
