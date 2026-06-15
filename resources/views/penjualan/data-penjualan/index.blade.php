<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f4efe6; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        
        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #4d624a; margin: 0 0 4px 0; }
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
        .form-label { font-weight: 700; color: #432118; margin-bottom: 5px; font-size: 14px; }
        .form-control { border-radius: 12px; border: 2.5px solid #d4c2ab; padding: 10px; font-size: 14px; background-color: #fffcf7; color: #432118; font-weight: 600; }
        .form-control:focus { border-color: #5d7a54; background-color: #ffffff; box-shadow: 0 0 0 0.25rem rgba(93,122,84,0.1); }

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

        /* Action Bar */
        .action-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; gap: 15px; }
        .search-wrapper {
            background: #fffcf7;
            border: 1.5px solid #e6d5c0;
            padding: 10.5px 15px;
            border-radius: 12px;
            flex-grow: 1;
            display: flex;
            align-items: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        }
        .search-input-group { display: flex; align-items: center; width: 100%; gap: 10px; }
        .search-input-group i { color: #152414; font-size: 18px; }
        .search-input-group input {
            background: transparent; border: none; outline: none; width: 100%;
            padding: 0px 15px; font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600; color: #432118; font-size: 15px;
        }
        .search-input-group input::placeholder { color: #845a33; opacity: 0.6; }

        .btn-add {
            border: none; background: #5d7a54; padding: 10px 20px;
            border-radius: 12px; font-weight: 700; color: #ffffff;
            box-shadow: 0 4px 0 #3a4d33; transition: 0.2s;
            text-decoration: none; white-space: nowrap;
            display: flex; align-items: center;
        }
        .btn-add:hover { background: #4a6344; color: white; transform: translateY(-2px); box-shadow: 0 6px 0 #3a4d33; }

        /* Tabel */
        .custom-table { width: 100%; overflow-x: auto; border-radius: 15px; margin-top: 10px; }
        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 14px 16px !important; text-transform: uppercase; font-size: 11px; border: 1px solid #e6d5c0 !important; letter-spacing: 0.5px; text-align: center !important; }
        .table tbody td { padding: 14px 16px !important; border: 1px solid #e6d5c0 !important; font-weight: 600; background: #fffcf7; }
        .table-bordered-custom th, .table-bordered-custom td { border-left: 1px solid #e6d5c0 !important; }
        .table-bordered-custom th:first-child, .table-bordered-custom td:first-child { border-left: none !important; }
        .table tbody tr:hover td { background-color: rgba(93, 122, 84, 0.05) !important; }

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

        /* Custom Delete Confirm Modal */
        .confirm-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
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
        @keyframes popIn {
            from { transform: scale(0.85); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .confirm-box .confirm-icon {
            font-size: 48px;
            color: #c0392b;
            margin-bottom: 15px;
        }
        .confirm-box h5 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #432118;
            font-size: 20px;
            margin-bottom: 8px;
        }
        .confirm-box p {
            color: #6d4c41;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 25px;
        }
        .confirm-actions { display: flex; gap: 12px; justify-content: center; }
        .btn-confirm-yes {
            background: #c0392b;
            color: #fff;
            border: none;
            padding: 10px 28px;
            border-radius: 12px;
            font-weight: 700;
            box-shadow: 0 4px 0 #922b21;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-confirm-yes:active { transform: translateY(3px); box-shadow: 0 1px 0 #922b21; }
        .btn-confirm-no {
            background: #e2e8f0;
            color: #475569;
            border: none;
            padding: 10px 28px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-confirm-no:hover { background: #cbd5e1; }

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
    </style>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Penjualan', 'pageSubtitle' => 'Riwayat transaksi penjualan Cimilk'])
    <div class="main-content">
        <div class="page-title-section">
            <h3>Data Penjualan 📑</h3>
            <p>Riwayat transaksi penjualan Cimilk.</p>
        </div>

        <!-- Filter Area -->
        <div class="filter-section">
            <div class="filter-title">Filter Tanggal</div>
            <form action="{{ route('penjualan.data') }}" method="GET">
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
                            <a href="{{ route('penjualan.data') }}" class="btn-reset flex-grow-1">
                                <i class="fa-solid fa-arrows-rotate me-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        @if(session('success') || request('success'))
            <div class="crud-notification success" id="crudNotif">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') ?? request('success') }}</span>
                <button class="notif-close" onclick="document.getElementById('crudNotif').remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif
        @if(session('error') || request('error'))
            <div class="crud-notification error" id="crudNotif">
                <i class="fa-solid fa-circle-xmark"></i>
                <span>{{ session('error') ?? request('error') }}</span>
                <button class="notif-close" onclick="document.getElementById('crudNotif').remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        <div class="action-bar">
            <div class="search-wrapper">
                <div class="search-input-group">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari data penjualan berdasarkan tanggal atau pembeli...">
                </div>
            </div>
            @if(Auth::user()->role !== 'Admin')
            <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#registerModal" data-route="{{ route('penjualan.input') }}">
                <i class="fa-solid fa-plus me-2"></i> Tambah Transaksi
            </button>
            @endif
        </div>

        <div class="custom-table">
            <div class="table-responsive">
                <table class="table table-bordered-custom align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">NO</th>
                            <th>TANGGAL</th>
                            <th>PEMBELI</th>
                            <th>JENIS PRODUK</th>
                            <th>JUMLAH (L)</th>
                            <th class="text-end">HARGA SATUAN</th>
                            <th class="text-end">TOTAL HARGA</th>
                            @if(Auth::user()->role !== 'Admin')
                            <th class="text-center">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="salesTableBody">
                        @forelse($penjualan as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $item->pembeli }}</td>
                            <td>
                                @if($item->jenis_produk == 'susu mentah')
                                    <span class="badge bg-warning text-dark px-2.5 py-1.5 text-capitalize" style="border-radius: 6px; font-size: 12.5px; font-weight: 700;">
                                        {{ $item->jenis_produk }}
                                    </span>
                                @elseif($item->jenis_produk == 'susu murni')
                                    <span class="badge bg-primary px-2.5 py-1.5 text-capitalize" style="border-radius: 6px; font-size: 12.5px; font-weight: 700; background-color: #5d7a54 !important;">
                                        {{ $item->jenis_produk }}
                                    </span>
                                @elseif($item->jenis_produk == 'yogurt')
                                    <span class="badge bg-danger px-2.5 py-1.5 text-capitalize" style="border-radius: 6px; font-size: 12.5px; font-weight: 700; background-color: #b05c75 !important;">
                                        {{ $item->jenis_produk }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $item->jumlah }} L</td>
                            <td class="text-end">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="text-end">
                                <span class="badge bg-success px-3 py-2" style="border-radius: 8px; font-size: 14px;">
                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                </span>
                            </td>
                            @if(Auth::user()->role !== 'Admin')
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#registerModal" data-route="{{ route('penjualan.edit', $item->id) }}">
                                        Edit
                                    </button>
                                    <button type="button" 
                                        class="btn btn-sm btn-outline-danger shadow-sm" 
                                        onclick="confirmDelete('{{ route('penjualan.destroy', $item->id) }}', '{{ $item->pembeli }}')">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ Auth::user()->role === 'Admin' ? 7 : 8 }}" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fa-solid fa-magnifying-glass mb-3" style="font-size: 48px; color: #a67c52; opacity: 0.4;"></i>
                                    <h5 class="fw-bold mb-1" style="color: #432118;">Data Belum Ada</h5>
                                    <p class="text-muted mb-0">Belum ada data transaksi yang tersimpan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3">
            {{ $penjualan->links() }}
        </div>
    </div>

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

    <!-- Custom Confirm Delete Modal -->
    <div class="confirm-overlay" id="confirmOverlay">
        <div class="confirm-box">
            <div class="confirm-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h5>Hapus Transaksi?</h5>
            <p id="confirmMessage">Apakah Anda yakin ingin menghapus data penjualan ini?</p>
            <div class="confirm-actions">
                <button class="btn-confirm-yes" id="confirmYesBtn">Ya, Hapus</button>
                <button class="btn-confirm-no" onclick="closeConfirm()">Batal</button>
            </div>
        </div>
    </div>

    <!-- Hidden form for delete -->
    <form id="deleteForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#salesTableBody tr:not(:has(td[colspan]))');
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        // ====== Custom Delete Confirm ======
        let deleteUrl = '';

        function confirmDelete(url, name) {
            deleteUrl = url;
            document.getElementById('confirmMessage').textContent = 
                'Apakah Anda yakin ingin menghapus transaksi atas nama "' + name + '"? Tindakan ini tidak bisa dibatalkan.';
            document.getElementById('confirmOverlay').classList.add('active');
        }

        function closeConfirm() {
            document.getElementById('confirmOverlay').classList.remove('active');
        }

        document.getElementById('confirmYesBtn').addEventListener('click', function() {
            const form = document.getElementById('deleteForm');
            form.action = deleteUrl;
            form.submit();
        });

        // Close on overlay click
        document.getElementById('confirmOverlay').addEventListener('click', function(e) {
            if (e.target === this) closeConfirm();
        });

        // ====== Auto-dismiss notification after 5s ======
        const notif = document.getElementById('crudNotif');
        if (notif) {
            setTimeout(() => {
                notif.style.opacity = '0';
                notif.style.transform = 'translateX(50px)';
                notif.style.transition = 'all 0.5s ease';
                setTimeout(() => notif.remove(), 500);
            }, 5000);
        }

        // ====== Modal: Reload iframe ======
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
    </script>
</body>
</html>
