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

        .filter-section {
            background: #fffcf7;
            padding: 12px 25px;
            border-radius: 20px;
            margin-bottom: 30px;
            border: 1.5px solid #e6d5c0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        }
        .filter-title { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 18px; margin-bottom: 8px; color: #432118; }
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
                    <div class="col-md-4 mb-2 mb-md-0">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" class="form-control" value="{{ request('dari_tanggal') }}">
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="sampai_tanggal" class="form-control" value="{{ request('sampai_tanggal') }}">
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.4.0/exceljs.min.js"></script>
    <script>
        function exportToExcel(tableId, filename, titleText, periodText, callback) {
            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet('Laporan');
            
            const table = document.getElementById(tableId);
            
            // 1. Add Kop Surat
            worksheet.addRow(["CIMILK DAIRY FARM"]);
            worksheet.addRow(["Pengolahan & Produksi Susu Segar Murni & Yogurt Premium"]);
            worksheet.addRow(["Kp. Palasari 2 Babakan Waru RT 26, RW 03, Desa Palasari, Kec. Ciater, Kab. Subang, Jawa Barat 41280"]);
            worksheet.addRow(["Telepon: +62 813-1348-8318 | Instagram: @cimilk.id"]);
            worksheet.addRow([]);
            worksheet.addRow([titleText]);
            worksheet.addRow([periodText]);
            worksheet.addRow([]);
            
            // 2. Add Table Headers
            const ths = table.querySelectorAll("thead th");
            const headerRow = [];
            ths.forEach(function(th) {
                const span = th.colSpan || 1;
                headerRow.push(th.innerText.trim());
                for (let i = 1; i < span; i++) {
                    headerRow.push("");
                }
            });
            const colCount = headerRow.length;
            worksheet.addRow(headerRow);
            
            // Helper function to clean numeric values and return float or clean string
            function cleanVal(val) {
                if (val === undefined || val === null) return "";
                let clean = val.replace(/\s+/g, ' ').trim();
                if (clean === "") return "";
                
                let isCurr = clean.startsWith('Rp');
                let isLit = clean.toLowerCase().endsWith(' liter') || clean.toLowerCase().endsWith(' l');
                
                if (isCurr || isLit) {
                    let numericPart = clean.replace(/[^\d.,-]/g, '');
                    let dotCount = (numericPart.match(/\./g) || []).length;
                    let commaCount = (numericPart.match(/,/g) || []).length;
                    
                    if (dotCount > 0 && commaCount > 0) {
                        if (numericPart.indexOf(',') < numericPart.indexOf('.')) {
                            numericPart = numericPart.replace(/,/g, '');
                        } else {
                            numericPart = numericPart.replace(/\./g, '').replace(',', '.');
                        }
                    } else if (dotCount > 1) {
                        numericPart = numericPart.replace(/\./g, '');
                    } else if (commaCount > 1) {
                        numericPart = numericPart.replace(/,/g, '');
                    } else if (dotCount === 1 && commaCount === 0) {
                        if (numericPart.length - numericPart.indexOf('.') === 4 && numericPart.indexOf('.') > 0) {
                            numericPart = numericPart.replace(/\./g, '');
                        }
                    } else if (commaCount === 1 && dotCount === 0) {
                        if (numericPart.length - numericPart.indexOf(',') === 4 && numericPart.indexOf(',') > 0) {
                            numericPart = numericPart.replace(/,/g, '');
                        } else {
                            numericPart = numericPart.replace(',', '.');
                        }
                    }
                    
                    let num = parseFloat(numericPart);
                    if (!isNaN(num)) return num;
                }
                
                let num = parseFloat(clean.replace(/\./g, '').replace(',', '.'));
                let standardNum = parseFloat(clean);
                if (!isNaN(standardNum) && String(standardNum) === clean) return standardNum;
                if (!isNaN(num) && /^\d+$/.test(clean.replace(/[.,]/g, ''))) return num;
                
                return clean;
            }
            
            // 3. Add Table Body and Footer Rows dynamically handling colspan
            let currentRowNum = 10;
            
            function addTableRows(trs) {
                trs.forEach(function(tr) {
                    if (tr.id === 'noDataRow' || tr.id === 'tempNoDataRow') return;
                    const rowData = [];
                    const merges = [];
                    let currentCol = 1;
                    
                    const tds = tr.querySelectorAll("td, th");
                    tds.forEach(function(td) {
                        const span = td.colSpan || 1;
                        rowData.push(cleanVal(td.innerText.trim()));
                        if (span > 1) {
                            merges.push({
                                s: { r: currentRowNum, c: currentCol },
                                e: { r: currentRowNum, c: currentCol + span - 1 }
                            });
                        }
                        for (let i = 1; i < span; i++) {
                            rowData.push("");
                        }
                        currentCol += span;
                    });
                    
                    worksheet.addRow(rowData);
                    merges.forEach(m => {
                        worksheet.mergeCells(m.s.r, m.s.c, m.e.r, m.e.c);
                    });
                    currentRowNum++;
                });
            }
            
            // Add body and footer rows
            addTableRows(table.querySelectorAll("tbody tr"));
            const bodyEndRowNum = currentRowNum - 1;
            addTableRows(table.querySelectorAll("tfoot tr"));
            
            // 5. Add Signature
            const dateStr = "Subang, " + new Intl.DateTimeFormat('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }).format(new Date());
            const sigCol = colCount > 2 ? colCount - 2 : 1;
            const lastRow = worksheet.lastRow.number;
            
            worksheet.getCell(lastRow + 2, sigCol + 1).value = dateStr;
            worksheet.getCell(lastRow + 3, sigCol + 1).value = "Mengetahui,";
            worksheet.getCell(lastRow + 4, sigCol + 1).value = "Admin Cimilk Yogurt";
            worksheet.getCell(lastRow + 8, sigCol + 1).value = "( ____________________ )";
            
            // Merging cells for Kop & Title
            worksheet.mergeCells(1, 1, 1, colCount);
            worksheet.mergeCells(2, 1, 2, colCount);
            worksheet.mergeCells(3, 1, 3, colCount);
            worksheet.mergeCells(4, 1, 4, colCount);
            worksheet.mergeCells(6, 1, 6, colCount);
            worksheet.mergeCells(7, 1, 7, colCount);
            
            // 6. STYLING THE SHEET
            // Font Calibri for the entire sheet
            worksheet.eachRow(row => {
                row.eachCell(cell => {
                    cell.font = { name: 'Calibri', size: 11, color: { argb: 'FF432118' } };
                });
            });
            
            // Kop 1: CIMILK DAIRY FARM
            const r1 = worksheet.getRow(1);
            r1.height = 25;
            r1.getCell(1).font = { name: 'Calibri', size: 16, bold: true, color: { argb: 'FF4A6344' } };
            r1.getCell(1).alignment = { horizontal: 'center', vertical: 'middle' };
            
            // Kop 2-4: Tagline, Address, Contact
            for (let i = 2; i <= 4; i++) {
                const r = worksheet.getRow(i);
                r.height = 18;
                r.getCell(1).font = { name: 'Calibri', size: 9, italic: i === 2, color: { argb: 'FF6D4C41' } };
                r.getCell(1).alignment = { horizontal: 'center', vertical: 'middle' };
            }
            // Kop Underline (Row 4 Bottom Border)
            worksheet.getRow(4).eachCell(cell => {
                cell.border = { bottom: { style: 'double', color: { argb: 'FF000000' } } };
            });
            
            // Title row 6
            const r6 = worksheet.getRow(6);
            r6.height = 22;
            r6.getCell(1).font = { name: 'Calibri', size: 12, bold: true, color: { argb: 'FF432118' } };
            r6.getCell(1).alignment = { horizontal: 'center', vertical: 'middle' };
            
            // Period row 7
            const r7 = worksheet.getRow(7);
            r7.height = 18;
            r7.getCell(1).font = { name: 'Calibri', size: 10, italic: true, color: { argb: 'FF6D4C41' } };
            r7.getCell(1).alignment = { horizontal: 'center', vertical: 'middle' };
            
            // Table Header Row 9 (Green theme background)
            const headerRowObj = worksheet.getRow(9);
            headerRowObj.height = 28;
            for (let c = 1; c <= colCount; c++) {
                const cell = headerRowObj.getCell(c);
                cell.fill = {
                    type: 'pattern',
                    pattern: 'solid',
                    fgColor: { argb: 'FF5D7A54' } // Beautiful themed green background
                };
                cell.font = { name: 'Calibri', size: 11, bold: true, color: { argb: 'FFFFFFFF' } };
                cell.alignment = { horizontal: 'center', vertical: 'middle', wrapText: true };
                cell.border = {
                    top: { style: 'thin', color: { argb: 'FF000000' } },
                    left: { style: 'thin', color: { argb: 'FF000000' } },
                    bottom: { style: 'medium', color: { argb: 'FF000000' } },
                    right: { style: 'thin', color: { argb: 'FF000000' } }
                };
            }
            
            // Format Table Data & Footer rows
            for (let r = 10; r < currentRowNum; r++) {
                const row = worksheet.getRow(r);
                row.height = 20;
                const isFooter = (r > bodyEndRowNum);
                const isEven = (r % 2 === 0);
                
                for (let c = 1; c <= colCount; c++) {
                    const cell = row.getCell(c);
                    
                    if (isFooter) {
                        cell.font = { name: 'Calibri', size: 11, bold: true, color: { argb: 'FF432118' } };
                        cell.fill = {
                            type: 'pattern',
                            pattern: 'solid',
                            fgColor: { argb: 'FFEAEAEA' }
                        };
                        cell.border = {
                            top: { style: 'thin', color: { argb: 'FF000000' } },
                            left: { style: 'thin', color: { argb: 'FF000000' } },
                            bottom: { style: 'double', color: { argb: 'FF000000' } },
                            right: { style: 'thin', color: { argb: 'FF000000' } }
                        };
                    } else {
                        if (isEven) {
                            cell.fill = {
                                type: 'pattern',
                                pattern: 'solid',
                                fgColor: { argb: 'FFF9F9F9' }
                            };
                        }
                        cell.border = {
                            top: { style: 'thin', color: { argb: 'FFBFBFBF' } },
                            left: { style: 'thin', color: { argb: 'FFBFBFBF' } },
                            bottom: { style: 'thin', color: { argb: 'FFBFBFBF' } },
                            right: { style: 'thin', color: { argb: 'FFBFBFBF' } }
                        };
                    }
                    
                    let val = cell.value;
                    if (typeof val === 'number') {
                        cell.alignment = { horizontal: 'right', vertical: 'middle' };
                        const colHeader = (headerRow[c - 1] || '').toLowerCase();
                        const isCurrency = colHeader.includes('harga') || colHeader.includes('satuan') || colHeader.includes('pendapatan') || colHeader.includes('omzet');
                        const isVolume = colHeader.includes('volume') || colHeader.includes('liter') || colHeader.includes('pagi') || colHeader.includes('sore') || colHeader.includes('jumlah') || colHeader.includes('total harian') || colHeader.includes('total volume');
                        
                        if (isCurrency) {
                            cell.numFmt = '"Rp "#,##0';
                        } else if (isVolume) {
                            cell.numFmt = '#,##0.00" L"';
                        } else {
                            cell.numFmt = '#,##0';
                        }
                    } else {
                        if (isFooter) {
                            cell.alignment = { horizontal: 'center', vertical: 'middle' };
                        } else {
                            const colHeader = (headerRow[c - 1] || '').toLowerCase();
                            if (colHeader.includes('no') || colHeader.includes('tanggal') || colHeader.includes('id') || colHeader.includes('kode') || colHeader.includes('bulan')) {
                                cell.alignment = { horizontal: 'center', vertical: 'middle' };
                            } else {
                                cell.alignment = { horizontal: 'left', vertical: 'middle' };
                            }
                        }
                    }
                }
            }
            
            // Auto-fit column widths (only using headers & table data from row 9 down)
            worksheet.columns.forEach((column, i) => {
                let maxLength = 10;
                column.eachCell({ includeEmpty: false }, cell => {
                    if (cell.row >= 9) {
                        let valText = cell.value;
                        if (valText !== undefined && valText !== null) {
                            if (typeof valText === 'number') {
                                const colHeader = (headerRow[i] || '').toLowerCase();
                                const isCurrency = colHeader.includes('harga') || colHeader.includes('satuan') || colHeader.includes('pendapatan') || colHeader.includes('omzet');
                                const isVolume = colHeader.includes('volume') || colHeader.includes('liter') || colHeader.includes('pagi') || colHeader.includes('sore') || colHeader.includes('jumlah') || colHeader.includes('total harian') || colHeader.includes('total volume');
                                if (isCurrency) {
                                    valText = "Rp " + Math.round(valText).toLocaleString('id-ID');
                                } else if (isVolume) {
                                    valText = valText.toFixed(2) + " L";
                                } else {
                                    valText = String(valText);
                                }
                            } else {
                                valText = String(valText);
                            }
                            let columnLength = valText.length;
                            if (columnLength > maxLength) {
                                maxLength = columnLength;
                            }
                        }
                    }
                });
                column.width = maxLength < 10 ? 12 : maxLength + 4;
            });
            
            // Write buffer and download
            workbook.xlsx.writeBuffer().then(function(buffer) {
                const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                const url = window.URL.createObjectURL(blob);
                const anchor = document.createElement('a');
                anchor.href = url;
                anchor.download = filename + '.xlsx';
                anchor.click();
                
                setTimeout(function() {
                    window.URL.revokeObjectURL(url);
                }, 3000);
                
                if (typeof callback === 'function') {
                    callback();
                }
            });
        }
    </script>
    @if(request('export_excel') === 'true')
        <script>
            window.addEventListener('load', function() {
                setTimeout(function() {
                    exportToExcel('dataTable', 'Laporan_Produksi', 'LAPORAN HASIL PRODUKSI SUSU SAPI', 'Periode: {{ request('dari_tanggal') ? \Carbon\Carbon::parse(request('dari_tanggal'))->format('d/m/Y') : 'Semua Periode' }} - {{ request('sampai_tanggal') ? \Carbon\Carbon::parse(request('sampai_tanggal'))->format('d/m/Y') : 'Sekarang' }}', function() {
                        setTimeout(function() {
                            var url = new URL(window.location.href);
                            url.searchParams.delete('all');
                            url.searchParams.delete('export_excel');
                            window.location.href = url.toString();
                        }, 2000);
                    });
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
