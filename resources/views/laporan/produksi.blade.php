<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produksi - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f4efe6; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }

        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }

        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        /* Filter Section */
        .filter-section {
            background: #fffcf7;
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 30px;
            border: 1.5px solid #e6d5c0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        }
        .filter-title { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 18px; margin-bottom: 15px; color: #432118; }
        .form-label { font-weight: 1000; color: #432118; margin-bottom: 5px; font-size: 14px; }
        .form-control { border-radius: 12px; border: 2.5px solid #d4c2ab; padding: 10px; font-size: 14px; background-color: #fffcf7; color: #432118; font-weight: 600; }
        .form-control:focus { border-color: #5d7a54; background-color: #ffffff; box-shadow: 0 0 0 0.25rem rgba(93,122,84,0.1); }

        /* Summary Cards */
        .summary-card {
            background: #fffcf7;
            padding: 25px;
            border-radius: 25px;
            border: 1.5px solid #e6d5c0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.02);
            height: 100%;
        }
        .summary-card p { margin: 0; font-weight: 700; color: #6d4c41; font-size: 15px; }
        .summary-card h2 { margin: 10px 0 0; font-family: 'Playfair Display', serif; font-weight: 700; font-size: 32px; color: #432118; }
        
        /* Table Section */
        .table-container {
            background: #fffcf7;
            border-radius: 20px;
            padding: 0;
            border: 1.5px solid #e6d5c0;
            overflow: hidden;
            margin-top: 10px;
        }
        .table { margin-bottom: 0; border-collapse: separate; border-spacing: 0; }
        .table thead th {
            background-color: #4a6344 !important;
            color: #ffffff !important;
            padding: 14px 16px !important;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            border: 1px solid #e6d5c0 !important;
            letter-spacing: 0.5px;
            text-align: center !important;
        }
        .table tbody td {
            padding: 14px 16px !important;
            border: 1px solid #e6d5c0 !important;
            font-weight: 600;
            color: #432118;
            background: #fffcf7;
        }
        .table tfoot {
            display: none;
        }
        .table tfoot td {
            padding: 14px 16px !important;
            border: 1px solid #e6d5c0 !important;
            font-weight: 700;
            color: #432118;
            background: #f5efe6 !important;
        }

        .btn-filter {
            background: #5d7a54; color: white; font-weight: 800; border: none; padding: 12px 25px; border-radius: 12px;
            box-shadow: 0 4px 0 #3a4d33; transition: 0.2s;
        }
        .btn-filter:hover { background: #4a6344; transform: translateY(-2px); color: white; }

        .btn-reset {
            background: #e6d5c0; color: #432118; font-weight: 800; border: none; padding: 12px 25px; border-radius: 12px;
            box-shadow: 0 4px 0 #c8b7a1; transition: 0.2s; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;
        }
        .btn-reset:hover { background: #dccab3; transform: translateY(-2px); color: #432118; box-shadow: 0 6px 0 #c8b7a1; }
        .btn-reset:active { transform: translateY(2px); box-shadow: 0 2px 0 #c8b7a1; }

        .btn-back {
            border: none;
            background: #845a33;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            color: #ffffff;
            box-shadow: 0 4px 0 #152414;
            transition: 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back:hover {
            background: #6d4c41;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 0 #152414;
        }
        .btn-back:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #152414;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        /* Print only layouts defaults */
        .print-header-layout, .print-summary-layout, .print-signature-layout {
            display: none;
        }

        @media print {
            .sidebar, .top-header, .header, .filter-section, .btn-back, .btn-filter, .action-buttons,
            .page-title-section, .summary-wrapper, .mt-3, .toggle-group {
                display: none !important;
            }
            body { 
                background: white !important; 
                padding: 0 !important; 
                margin: 0 !important; 
                font-family: 'Plus Jakarta Sans', sans-serif !important; 
                color: #000 !important;
                filter: grayscale(100%) !important;
            }
            .main-content { margin: 0 !important; width: 100% !important; padding: 10px 20px !important; }
            .table-container { border: none !important; border-radius: 0 !important; margin-top: 15px !important; padding: 0 !important; }
            .table { border: none !important; border-top: 2px solid #000 !important; border-bottom: 2px solid #000 !important; width: 100% !important; border-collapse: collapse !important; }
            .table thead th { background-color: #f5f5f5 !important; color: black !important; border: none !important; border-bottom: 1px solid #000 !important; -webkit-print-color-adjust: exact; padding: 8px !important; font-size: 11px; }
            .table tbody td { border: none !important; border-bottom: 1px solid #ddd !important; color: black !important; -webkit-print-color-adjust: exact; padding: 8px !important; font-size: 11px; }
            
            .table tfoot {
                display: table-footer-group !important;
            }
            .table tfoot td {
                border: none !important;
                border-top: 2px solid #000 !important;
                border-bottom: 2px solid #000 !important;
                color: black !important;
                -webkit-print-color-adjust: exact;
                padding: 8px !important;
                font-size: 11px !important;
                font-weight: bold !important;
                background-color: #f5f5f5 !important;
            }
            
            /* Force all table text, badges, and colors to be strictly black and white */
            .text-success, .text-primary, .text-danger, .badge,
            .table thead th, .table thead th *, 
            .table tbody td, .table tbody td *, 
            .table tfoot td, .table tfoot td * {
                color: #000 !important;
            }
            
            /* Print Layout Styling */
            .print-header-layout {
                display: block !important;
                margin-bottom: 20px;
            }
            .print-kop {
                text-align: center;
                margin-bottom: 15px;
            }
            .print-kop h2 {
                font-family: 'Playfair Display', serif;
                font-size: 24px;
                font-weight: 800;
                margin: 0;
                color: #000;
                letter-spacing: 1px;
            }
            .print-kop .tagline {
                font-size: 11px;
                margin: 3px 0;
                color: #333;
                font-weight: 600;
            }
            .print-kop .address {
                font-size: 10px;
                margin: 0;
                color: #555;
            }
            .print-kop .contact {
                font-size: 10px;
                margin: 2px 0 0 0;
                color: #555;
            }
            .print-kop .line {
                border-bottom: 3px double #000;
                margin-top: 8px;
            }
            .print-title {
                text-align: center;
                font-size: 15px;
                font-weight: 800;
                margin: 12px 0 8px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
            .print-meta {
                display: flex;
                justify-content: space-between;
                font-size: 11px;
                font-weight: 600;
                border-bottom: 1px dashed #000;
                padding-bottom: 4px;
                margin-bottom: 15px;
            }
            

 
            .print-signature-layout {
                display: block !important;
                margin-top: 30px;
                page-break-inside: avoid;
            }
            .signature-box {
                float: right;
                text-align: center;
                width: 200px;
                font-size: 11px;
            }
            .signature-box .date {
                margin-bottom: 4px;
            }
            .signature-box .position {
                margin-bottom: 50px;
            }
            .signature-box .sign-line {
                border-top: 1px solid #000;
                width: 100%;
            }
        }
    </style>
</head>
<body>
 
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Laporan Produksi', 'pageSubtitle' => 'Rekapitulasi hasil produksi susu sapi'])
 
    <div class="main-content">
 
        <div class="print-header-layout">
            <div class="print-kop">
                <h2>CIMILK DAIRY FARM</h2>
                <p class="tagline">Pengolahan & Produksi Susu Segar Murni & Yogurt Premium</p>
                <p class="address">Kp. Palasari 2 Babakan Waru RT 26, RW 03, Desa Palasari, Kec. Ciater, Kab. Subang, Jawa Barat 41280</p>
                <p class="contact">Telepon: +62 813-1348-8318 | Instagram: @cimilk.id</p>
                <div class="line"></div>
            </div>
            <h3 class="print-title">LAPORAN HASIL PRODUKSI SUSU SAPI</h3>
            <div class="print-meta">
                <span>Periode: <strong>{{ request('dari_tanggal') ? \Carbon\Carbon::parse(request('dari_tanggal'))->format('d/m/Y') : 'Semua Periode' }} - {{ request('sampai_tanggal') ? \Carbon\Carbon::parse(request('sampai_tanggal'))->format('d/m/Y') : 'Sekarang' }}</strong></span>
                <span>Tanggal Cetak: <strong>{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</strong></span>
            </div>
        </div>
 

 
        <div class="page-title-section">
            <h3>Laporan Produksi Susu 🥛</h3>
            <p>Daftar lengkap hasil produksi susu dari seluruh sapi.</p>
        </div>
 
        <!-- Filter Area -->
        <div class="filter-section">
            <div class="filter-title">Filter Tanggal</div>
            <form action="{{ route('laporan.produksi') }}" method="GET">
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
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-filter flex-grow-1">
                                <i class="fa-solid fa-filter me-2"></i>Filter
                            </button>
                            <a href="{{ route('laporan.produksi') }}" class="btn-reset flex-grow-1">
                                <i class="fa-solid fa-arrows-rotate me-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
 
        <!-- Summary Cards -->
        <div class="row g-4 mb-4 d-print-none">
            <div class="col-md-4">
                <div class="summary-card">
                    <p>Total Produksi Pagi</p>
                    <h2>{{ number_format($totalPagi, 0, '.', ',') }} Liter</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card">
                    <p>Total Produksi Sore</p>
                    <h2>{{ number_format($totalSore, 0, '.', ',') }} Liter</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card">
                    <p>Total Produksi Susu</p>
                    <h2>{{ number_format($totalProduksi, 0, '.', ',') }} Liter</h2>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('laporan.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <div class="dropdown">
                <button class="btn btn-filter dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-print me-2"></i> Cetak Laporan
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="dropdownMenuButton" style="border-radius: 12px; overflow: hidden; border: 1.5px solid #e6d5c0 !important;">
                    <li><a class="dropdown-item py-2 fw-bold" href="{{ request()->fullUrlWithQuery(['all' => 'true', 'export_excel' => 'true']) }}" style="color: #217346;"><i class="fa-solid fa-file-excel me-2"></i>Cetak Excel</a></li>
                    <li><hr class="dropdown-divider m-0" style="border-color: #e6d5c0;"></li>
                    <li><a class="dropdown-item py-2 fw-bold" href="{{ request()->fullUrlWithQuery(['all' => 'true']) }}" style="color: #c0392b;"><i class="fa-solid fa-file-pdf me-2"></i>Cetak PDF</a></li>
                </ul>
            </div>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table align-middle" id="dataTable">
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
                            <td class="text-center fw-bold" style="font-size: 14px; color: #432118;">
                                {{ $item->total }} L
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
                    <tfoot>
                        <tr class="fw-bold">
                            <td colspan="3" class="text-center fw-bold">TOTAL</td>
                            <td class="fw-bold">{{ number_format($totalPagi, 2, '.', ',') }} Liter</td>
                            <td class="fw-bold">{{ number_format($totalSore, 2, '.', ',') }} Liter</td>
                            <td class="text-center fw-bold" style="font-size: 14px; color: #432118;">
                                {{ number_format($totalProduksi, 2, '.', ',') }} L
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @if($produksi instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-3">
            {{ $produksi->links() }}
        </div>
        @endif

        <!-- Signature for printing -->
        <div class="print-signature-layout">
            <div class="signature-box">
                <p class="date">Subang, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                <p class="position">Mengetahui,<br><strong>Admin Cimilk Yogurt</strong></p>
                <div class="sign-line"></div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        function exportToExcel(tableId, filename, titleText, periodText) {
            var table = document.getElementById(tableId);
            var rows = [];
            
            // Add Kop Surat
            rows.push(["CIMILK DAIRY FARM"]);
            rows.push(["Pengolahan & Produksi Susu Segar Murni & Yogurt Premium"]);
            rows.push(["Kp. Palasari 2 Babakan Waru RT 26, RW 03, Desa Palasari, Kec. Ciater, Kab. Subang, Jawa Barat 41280"]);
            rows.push(["Telepon: +62 813-1348-8318 | Instagram: @cimilk.id"]);
            rows.push([]);
            rows.push([titleText]);
            rows.push([periodText]);
            rows.push([]);
            
            // Add Table Headers
            var headerRow = [];
            var ths = table.querySelectorAll("thead th");
            ths.forEach(function(th) {
                headerRow.push(th.innerText.trim());
            });
            rows.push(headerRow);
            
            // Add Table Body Rows
            var trs = table.querySelectorAll("tbody tr");
            trs.forEach(function(tr) {
                var rowData = [];
                var tds = tr.querySelectorAll("td");
                tds.forEach(function(td) {
                    rowData.push(td.innerText.trim());
                });
                rows.push(rowData);
            });
            
            // Add Table Footer (Total)
            var tfootTrs = table.querySelectorAll("tfoot tr");
            tfootTrs.forEach(function(tr) {
                var rowData = [];
                var tds = tr.querySelectorAll("td");
                tds.forEach(function(td) {
                    rowData.push(td.innerText.trim());
                });
                rows.push(rowData);
            });
            
            rows.push([]);
            
            // Add Signature
            var dateStr = "Subang, " + new Intl.DateTimeFormat('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }).format(new Date());
            var colCount = headerRow.length;
            var sigCol = colCount > 2 ? colCount - 2 : 1;
            
            var sigRow1 = Array(colCount).fill(""); sigRow1[sigCol] = dateStr; rows.push(sigRow1);
            var sigRow2 = Array(colCount).fill(""); sigRow2[sigCol] = "Mengetahui,"; rows.push(sigRow2);
            var sigRow3 = Array(colCount).fill(""); sigRow3[sigCol] = "Admin Cimilk Yogurt"; rows.push(sigRow3);
            rows.push([]);
            rows.push([]);
            rows.push([]);
            var sigRow4 = Array(colCount).fill(""); sigRow4[sigCol] = "( ____________________ )"; rows.push(sigRow4);
            
            // Generate sheet
            var ws = XLSX.utils.aoa_to_sheet(rows);
            
            // Merging cells for header
            ws['!merges'] = [
                { s: { r: 0, c: 0 }, e: { r: 0, c: colCount - 1 } },
                { s: { r: 1, c: 0 }, e: { r: 1, c: colCount - 1 } },
                { s: { r: 2, c: 0 }, e: { r: 2, c: colCount - 1 } },
                { s: { r: 3, c: 0 }, e: { r: 3, c: colCount - 1 } },
                { s: { r: 5, c: 0 }, e: { r: 5, c: colCount - 1 } },
                { s: { r: 6, c: 0 }, e: { r: 6, c: colCount - 1 } }
            ];
            
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Laporan");
            XLSX.writeFile(wb, filename + ".xlsx");
        }
    </script>
    @if(request('export_excel') === 'true')
        <script>
            window.addEventListener('load', function() {
                setTimeout(function() {
                    exportToExcel('dataTable', 'Laporan_Produksi', 'LAPORAN HASIL PRODUKSI SUSU SAPI', 'Periode: {{ request('dari_tanggal') ? \Carbon\Carbon::parse(request('dari_tanggal'))->format('d/m/Y') : 'Semua Periode' }} - {{ request('sampai_tanggal') ? \Carbon\Carbon::parse(request('sampai_tanggal'))->format('d/m/Y') : 'Sekarang' }}');
                    
                    setTimeout(function() {
                        var url = new URL(window.location.href);
                        url.searchParams.delete('all');
                        url.searchParams.delete('export_excel');
                        window.location.href = url.toString();
                    }, 500);
                }, 500);
            });
        </script>
    @elseif(request('all') === 'true')
        <script>
            window.addEventListener('load', function() {
                setTimeout(function() {
                    window.print();
                    var url = new URL(window.location.href);
                    url.searchParams.delete('all');
                    window.location.href = url.toString();
                }, 500);
            });
        </script>
    @endif
</body>
</html>
