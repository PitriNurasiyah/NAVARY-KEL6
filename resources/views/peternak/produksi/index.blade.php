<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produksi Susu - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f4efe6; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }

        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }

        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #4d624a; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        /* Notifikasi CRUD (Floating / Toast style) */
        .crud-notification {
            position: fixed;
            top: 25px;
            right: 25px;
            z-index: 99999;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 25px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            animation: slideInRight 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            min-width: 320px;
            max-width: 450px;
        }
        .crud-notification.success { background: #dcfce7; border: 2px solid #22c55e; color: #166534; }
        .crud-notification.error { background: #fee2e2; border: 2px solid #ef4444; color: #991b1b; }
        
        .notif-close {
            margin-left: auto; background: none; border: none; color: inherit;
            font-size: 18px; cursor: pointer; opacity: 0.5; transition: 0.2s;
            display: flex; align-items: center; justify-content: center;
        }
        .notif-close:hover { opacity: 1; }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

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
        .form-label { font-weight: 700; color: #432118; margin-bottom: 5px; font-size: 14px; }
        .form-control { border-radius: 12px; border: 2.5px solid #d4c2ab; padding: 10px; font-size: 14px; background-color: #fffcf7; color: #432118; font-weight: 600; }
        .form-control:focus { border-color: #5d7a54; background-color: #ffffff; box-shadow: 0 0 0 0.25rem rgba(93,122,84,0.1); }

        /* Summary Cards */
        .summary-wrapper { display: flex; gap: 20px; margin-bottom: 35px; }
        .summary-card {
            flex: 1;
            background: #fffcf7;
            padding: 30px;
            border-radius: 15px;
            border: 1.5px solid #e6d5c0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        }
        .summary-card p { margin: 0; font-weight: 700; color: #6d4c41; font-size: 15px; }
        .summary-card h2 { margin: 10px 0 0; font-family: 'Playfair Display', serif; font-weight: 700; font-size: 32px; color: #432118; }

        /* Action Buttons & Search */
        .action-bar { display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 25px; }
        .search-wrapper {
            background: #fffcf7;
            border: 1.5px solid #e6d5c0;
            padding: 5px 15px;
            border-radius: 12px;
            flex-grow: 1;
            display: flex;
            align-items: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        }
        .search-input-group { display: flex; align-items: center; flex-grow: 1; }
        .search-input-group i { color: #152414; font-size: 18px; }
        .search-input-group input {
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
            padding: 8px 15px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            color: #432118;
            font-size: 15px;
        }
        .search-input-group input::placeholder { color: #845a33; opacity: 0.6; }

        .btn-add { border: none; background: #5d7a54; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; text-decoration: none; }
        .btn-add:hover { background: #4a6344; color: #fff; }

        .btn-filter {
            background: #5d7a54; color: white; font-weight: 800; border: none; padding: 12px 25px; border-radius: 12px;
            box-shadow: 0 4px 0 #3a4d33; transition: 0.2s;
        }
        .btn-filter:hover { background: #4a6344; transform: translateY(-2px); color: white; }

        /* Table Section */
        .table-container {
            background: #fffcf7;
            border-radius: 20px;
            padding: 0;
            border: 1.5px solid #e6d5c0;
            overflow: hidden;
            margin-top: 10px;
        }
        .table { margin-bottom: 0; border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; }
        .table thead th {
            background-color: #4a6344 !important;
            color: #ffffff !important;
            padding: 14px 16px !important;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            border: 1px solid #e6d5c0 !important;
            letter-spacing: 0.5px;
        }
        .table tbody td {
            padding: 14px 16px !important;
            border: 1px solid #e6d5c0 !important;
            font-weight: 600;
            color: #432118;
            background: #fffcf7;
        }
        .table tbody tr:hover td { background-color: rgba(93, 122, 84, 0.05) !important; }

        .total-badge { background: rgba(93, 122, 84, 0.15); padding: 5px 12px; border-radius: 8px; border: 1px solid rgba(93, 122, 84, 0.3); font-weight: 800; color: #4a6344; }

        /* Custom Delete Confirm Modal */
        .confirm-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 9999; align-items: center; justify-content: center; }
        .confirm-overlay.active { display: flex; }
        .confirm-box {
            background: #fffcf7;
            border-radius: 20px;
            padding: 35px 40px;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
            text-align: center;
            border: 1.5px solid #e6d5c0;
            animation: popIn 0.25s ease;
        }
        @keyframes popIn { from { transform: scale(0.85); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .confirm-icon { font-size: 48px; color: #c0392b; margin-bottom: 15px; }
        .confirm-box h5 { font-family: 'Playfair Display', serif; font-weight: 700; color: #432118; font-size: 20px; margin-bottom: 8px; }
        .confirm-box p { color: #6d4c41; font-weight: 600; font-size: 14px; margin-bottom: 25px; }
        .confirm-actions { display: flex; gap: 12px; justify-content: center; }
        .btn-confirm-yes { background: #c0392b; color: #fff; border: none; padding: 10px 28px; border-radius: 12px; font-weight: 700; box-shadow: 0 4px 0 #922b21; cursor: pointer; transition: 0.2s; }
        .btn-confirm-yes:active { transform: translateY(3px); box-shadow: 0 1px 0 #922b21; }
        .btn-confirm-no { background: #e2e8f0; color: #475569; border: none; padding: 10px 28px; border-radius: 12px; font-weight: 700; cursor: pointer; }
        .btn-confirm-no:hover { background: #cbd5e1; }

        /* Modal Floating Styling */
        .modal-content-custom {
            background: transparent;
            border: none;
            box-shadow: none;
        }
        .modal-backdrop.show { opacity: 0.6; background-color: #000; }
        .iframe-container {
            width: 100%;
            height: auto;
            border: none;
            overflow: hidden;
        }
        .iframe-container iframe {
            width: 100%;
            border: none;
        }

        /* Print only layouts defaults */
        .print-header-layout, .print-summary-layout, .print-signature-layout {
            display: none;
        }

        @media print {
            .sidebar, .top-header, .header, .filter-section, .btn-back, .btn-filter, .action-bar,
            .page-title-section, .summary-wrapper, .mt-3, .toggle-group {
                display: none !important;
            }
            body { background: white !important; padding: 0 !important; margin: 0 !important; font-family: 'Plus Jakarta Sans', sans-serif !important; color: #000 !important; }
            .main-content { margin: 0 !important; width: 100% !important; padding: 10px 20px !important; }
            .table-container { border: none !important; border-radius: 0 !important; margin-top: 15px !important; padding: 0 !important; }
            .table { border: 1px solid #000 !important; width: 100% !important; border-collapse: collapse !important; }
            .table thead th { background-color: #f0f0f0 !important; color: black !important; border: 1px solid #000 !important; -webkit-print-color-adjust: exact; padding: 8px !important; font-size: 11px; }
            .table tbody td { border: 1px solid #000 !important; color: black !important; -webkit-print-color-adjust: exact; padding: 8px !important; font-size: 11px; }
            .table tbody td:last-child { display: none !important; } /* Hide action column in print */
            .table thead th:last-child { display: none !important; }
            
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
            .print-kop .line {
                border-bottom: 2px solid #000;
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
            
            .print-summary-layout {
                display: flex !important;
                gap: 15px;
                margin-bottom: 15px;
            }
            .print-summary-box {
                flex: 1;
                border: 1px solid #000;
                padding: 10px;
                border-radius: 6px;
                text-align: center;
            }
            .print-summary-box .label {
                font-size: 11px;
                font-weight: bold;
                display: block;
                margin-bottom: 3px;
                text-transform: uppercase;
            }
            .print-summary-box .value {
                font-size: 14px;
                font-weight: bold;
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
    @include('layouts.header', ['pageTitle' => 'Produksi Susu', 'pageSubtitle' => 'Catat hasil produksi susu harian'])

    <div class="main-content">

        <!-- Print-only elements -->
        <div class="print-header-layout">
            <div class="print-kop">
                <h2>CIMILK YOGURT</h2>
                <p class="tagline">Laporan Hasil Produksi & Penjualan Yogurt Premium</p>
                <p class="address">Jl. Raya Peternakan No. 123, Cimahi</p>
                <div class="line"></div>
            </div>
            <h3 class="print-title">LAPORAN HASIL PRODUKSI SUSU SAPI</h3>
            <div class="print-meta">
                <span>Periode: <strong>{{ request('dari_tanggal') ? \Carbon\Carbon::parse(request('dari_tanggal'))->format('d/m/Y') : 'Awal' }} - {{ request('sampai_tanggal') ? \Carbon\Carbon::parse(request('sampai_tanggal'))->format('d/m/Y') : 'Akhir' }}</strong></span>
                <span>Tanggal Cetak: <strong>{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</strong></span>
            </div>
        </div>

        <div class="print-summary-layout">
            <div class="print-summary-box">
                <span class="label">Total Produksi Pagi:</span>
                <span class="value">{{ number_format($totalPagi, 0, '.', ',') }} L</span>
            </div>
            <div class="print-summary-box">
                <span class="label">Total Produksi Sore:</span>
                <span class="value">{{ number_format($totalSore, 0, '.', ',') }} L</span>
            </div>
            <div class="print-summary-box">
                <span class="label">Total Produksi Susu:</span>
                <span class="value">{{ number_format($totalProduksi, 0, '.', ',') }} L</span>
            </div>
        </div>

        <div class="page-title-section">
            <h3>Produksi Susu 🥛</h3>
            <p>Catat dan pantau hasil produksi susu harian per sapi.</p>
        </div>

        @if(session('success') || request('success'))
            <div class="crud-notification success" id="crudNotif">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') ?? request('success') }}</span>
                <button class="notif-close" onclick="document.getElementById('crudNotif').remove()"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        <!-- Filter Area -->
        <div class="filter-section">
            <div class="filter-title">Filter Tanggal</div>
            <form action="{{ route('produksi.index') }}" method="GET">
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
            <div class="summary-card">
                <p>Total Produksi Pagi</p>
                <h2>{{ number_format($totalPagi, 0, '.', ',') }} Liter</h2>
            </div>
            <div class="summary-card">
                <p>Total Produksi Sore</p>
                <h2>{{ number_format($totalSore, 0, '.', ',') }} Liter</h2>
            </div>
            <div class="summary-card">
                <p>Total Produksi Susu</p>
                <h2>{{ number_format($totalProduksi, 0, '.', ',') }} Liter</h2>
            </div>
        </div>

        <div class="action-bar">
            <div class="search-wrapper">
                <div class="search-input-group">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari data produksi berdasarkan ID Sapi...">
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <div class="dropdown">
                    <button class="btn btn-filter dropdown-toggle py-2" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 12px; font-weight: 700; height: 100%;">
                        <i class="fa-solid fa-print me-2"></i> Cetak Laporan
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="dropdownMenuButton" style="border-radius: 12px; overflow: hidden; border: 1.5px solid #e6d5c0 !important;">
                        <li><a class="dropdown-item py-2 fw-bold" href="#" onclick="exportToExcel('produksiTable', 'Laporan_Produksi'); return false;" style="color: #217346;"><i class="fa-solid fa-file-excel me-2"></i>Cetak Excel</a></li>
                        <li><hr class="dropdown-divider m-0" style="border-color: #e6d5c0;"></li>
                        <li><a class="dropdown-item py-2 fw-bold" href="#" onclick="window.print(); return false;" style="color: #c0392b;"><i class="fa-solid fa-file-pdf me-2"></i>Cetak PDF</a></li>
                    </ul>
                </div>

                @if(Auth::user()->role === 'Peternak')
                <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#registerModal" data-route="{{ route('produksi.create') }}">
                    <i class="fa-solid fa-plus me-2"></i>Tambah Produksi
                </button>
                @endif
            </div>
        </div>

        <!-- Tarik Data table-bordered-custom -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table align-middle" id="produksiTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">NO</th>
                            <th>TANGGAL</th>
                            <th>ID SAPI</th>
                            <th>PAGI (L)</th>
                            <th>SORE (L)</th>
                            <th class="text-center">TOTAL HARIAN</th>
                            @if(Auth::user()->role === 'Peternak')
                            <th class="text-center" style="width: 150px;">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="produksiTableBody">
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
                            @if(Auth::user()->role === 'Peternak')
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#registerModal" data-route="{{ route('produksi.edit', $item->id) }}">Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger shadow-sm" onclick="confirmDelete('{{ route('produksi.destroy', $item->id) }}', '{{ $item->sapi->kode_sapi ?? 'Sapi' }}')">Hapus</button>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr id="noDataRow">
                            <td @if(Auth::user()->role === 'Peternak') colspan="7" @else colspan="6" @endif class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fa-solid fa-bucket mb-3" style="font-size: 48px; color: #a67c52; opacity: 0.4;"></i>
                                    <h5 class="fw-bold mb-1" style="color: #432118;">Data Belum Ada</h5>
                                    <p class="text-muted mb-0">Belum ada data produksi yang tersimpan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $produksi->links() }}
        </div>

        <!-- Signature for printing -->
        <div class="print-signature-layout">
            <div class="signature-box">
                <p class="date">Cimahi, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                <p class="position">Mengetahui,<br><strong>Admin Cimilk Yogurt</strong></p>
                <div class="sign-line"></div>
            </div>
        </div>

    </div>

    <!-- Confirm Delete Modal Overlay -->
    <div class="confirm-overlay" id="confirmOverlay">
        <div class="confirm-box">
            <div class="confirm-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h5>Hapus Data Produksi?</h5>
            <p id="confirmMessage">Yakin ingin menghapus data ini?</p>
            <div class="confirm-actions">
                <button class="btn-confirm-yes" id="confirmYesBtn">Ya, Hapus</button>
                <button class="btn-confirm-no" onclick="closeConfirm()">Batal</button>
            </div>
        </div>
    </div>

    <form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>

    <!-- Modal Register/Create/Edit -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="iframe-container">
                    <iframe id="registerIframe" src="" scrolling="no" onload="setTimeout(() => { if(this.contentWindow.document.body) { this.style.height = (this.contentWindow.document.body.scrollHeight + 50) + 'px'; } }, 50);" ></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        // Instant search
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#produksiTableBody tr');
            rows.forEach(row => {
                if (row.id === 'noDataRow') return;
                row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
            });
        });

        // Delete confirmation
        let deleteUrl = '';
        function confirmDelete(url, name) {
            deleteUrl = url;
            document.getElementById('confirmMessage').textContent = 'Hapus data produksi sapi "' + name + '"?';
            document.getElementById('confirmOverlay').classList.add('active');
        }
        function closeConfirm() { document.getElementById('confirmOverlay').classList.remove('active'); }
        document.getElementById('confirmYesBtn').addEventListener('click', function() {
            const form = document.getElementById('deleteForm');
            form.action = deleteUrl;
            form.submit();
        });

        // Export to Excel
        function exportToExcel(tableId, filename) {
            // Clone table to remove the last action column during excel export if role is Peternak
            var originalTable = document.getElementById(tableId);
            var clonedTable = originalTable.cloneNode(true);
            
            // Check if action header exists and remove it
            var actionHeaders = clonedTable.querySelectorAll('th:last-child');
            var actionCells = clonedTable.querySelectorAll('td:last-child');
            
            @if(Auth::user()->role === 'Peternak')
                actionHeaders.forEach(el => el.remove());
                actionCells.forEach(el => el.remove());
            @endif

            var wb = XLSX.utils.table_to_book(clonedTable, {sheet: "Laporan Produksi"});
            XLSX.writeFile(wb, filename + ".xlsx");
        }

        // Iframe modal handling
        const registerModal = document.getElementById('registerModal');
        const registerIframe = document.getElementById('registerIframe');
        
        if (registerModal && registerIframe) {
            registerModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const routeUrl = button.getAttribute('data-route');
                if (routeUrl) {
                    registerIframe.src = routeUrl + (routeUrl.includes('?') ? '&' : '?') + "mode=modal";
                }
            });
            registerModal.addEventListener('hide.bs.modal', function() {
                registerIframe.src = '';
            });
        }

        // Auto-dismiss alert
        const notif = document.getElementById('crudNotif');
        if (notif) {
            setTimeout(() => {
                notif.style.opacity = '0';
                notif.style.transform = 'translateX(50px)';
                notif.style.transition = 'all 0.5s ease';
                setTimeout(() => notif.remove(), 500);
            }, 5000);
        }
    </script>
</body>
</html>
