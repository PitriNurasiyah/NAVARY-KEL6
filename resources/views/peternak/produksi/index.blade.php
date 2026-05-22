<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produksi Susu - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">

    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        .crud-notification {
            display: flex; align-items: center; gap: 12px; padding: 15px 25px; border-radius: 12px;
            font-weight: 700; font-size: 14px; margin-bottom: 25px; animation: fadeInDown 0.4s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .crud-notification.success { background: #dcfce7; border: 2px solid #22c55e; color: #166534; }
        .crud-notification.error { background: #fee2e2; border: 2px solid #ef4444; color: #991b1b; }
        
        .notif-close {
            margin-left: auto; background: none; border: none; color: inherit;
            font-size: 18px; cursor: pointer; opacity: 0.5; transition: 0.2s;
            display: flex; align-items: center; justify-content: center;
        }
        .notif-close:hover { opacity: 1; }
        
        .btn-add { border: none; background: #5d7a54; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; text-decoration: none; }
        .btn-add:hover { background: #4a6344; color: #fff; }

        .action-bar { display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 25px; }
        .search-wrapper { background: #e6d5c0; border: 3px solid #a67c52; padding: 5px 15px; border-radius: 12px; flex-grow: 1; display: flex; align-items: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .search-input-group { display: flex; align-items: center; flex-grow: 1; }
        .search-input-group i { color: #5a1f12; font-size: 18px; }
        .search-input-group input { background: transparent; border: none; outline: none; width: 100%; padding: 8px 15px; font-family: 'Quicksand', sans-serif; font-weight: 600; color: #432118; font-size: 15px; }

        .custom-table { width: 100%; overflow-x: auto; border-radius: 15px; margin-top: 10px; }
        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 16px !important; text-transform: uppercase; font-size: 13px; border: 1px solid #bc9f82 !important; }
        .table tbody td { padding: 12px 16px !important; border: 1px solid #bc9f82 !important; background: white; }
        
        .total-badge { background: #f0e2d0; padding: 5px 12px; border-radius: 8px; border: 1px solid #bc9f82; font-weight: 800; color: #432118; }

        .chart-container { background: white; padding: 25px; border-radius: 20px; margin-top: 30px; border: 4px solid #8CA685; box-shadow: 0 8px 16px rgba(0,0,0,0.05); }
        .chart-title { font-family: 'Fredoka One', cursive; font-size: 20px; color: #432118; margin-bottom: 20px; }

        /* Custom Delete Confirm Modal */
        .confirm-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 9999; align-items: center; justify-content: center; }
        .confirm-overlay.active { display: flex; }
        .confirm-box { background: #f5efe6; border-radius: 20px; padding: 35px 40px; max-width: 420px; width: 90%; box-shadow: 0 20px 50px rgba(0,0,0,0.3); text-align: center; border: 6px solid #8CA685; animation: popIn 0.25s ease; }
        @keyframes popIn { from { transform: scale(0.85); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .confirm-icon { font-size: 48px; color: #c0392b; margin-bottom: 15px; }
        .confirm-box h5 { font-family: 'Fredoka One', cursive; color: #432118; font-size: 20px; margin-bottom: 8px; }
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

        </style>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Produksi Susu', 'pageSubtitle' => 'Catat hasil produksi susu harian'])

    <div class="main-content">
        <div class="page-title-section">
            <h3>Produksi Susu 🥛</h3>
            <p>Catat dan pantau hasil produksi susu harian per sapi.</p>
        </div>

        @if(session('success'))
            <div class="crud-notification success" id="crudNotif">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
                <button class="notif-close" onclick="document.getElementById('crudNotif').remove()"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        <div class="action-bar">
            <div class="search-wrapper">
                <div class="search-input-group">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari data produksi berdasarkan ID Sapi...">
                </div>
            </div>
            @if(Auth::user()->role === 'Peternak')
            <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#registerModal" data-route="{{ route('produksi.create') }}"><i class="fa-solid fa-plus me-2"></i>Tambah Produksi</button>
            @endif
        </div>

        <div class="custom-table">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>ID SAPI</th>
                        <th>PAGI (L)</th>
                        <th>SORE (L)</th>
                        <th class="text-center">TOTAL</th>
                        <th>TANGGAL</th>
                        @if(Auth::user()->role === 'Peternak')
                        <th class="text-center">AKSI</th>
                        @endif
                    </tr>
                </thead>
                <tbody id="produksiTableBody">
                    @forelse($produksi as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $item->sapi->kode_sapi ?? 'N/A' }}</td>
                        <td>{{ $item->jumlah_pagi }} L</td>
                        <td>{{ $item->jumlah_sore }} L</td>
                        <td class="text-center"><span class="total-badge">{{ $item->total }} L</span></td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
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
                        <td colspan="7" class="text-center py-5">
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

        <div class="chart-container">
            <h4 class="chart-title">Produksi Per Sapi (Hari Ini)</h4>
            <canvas id="productionChart" height="100"></canvas>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Modal Register/Create -->
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
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#produksiTableBody tr');
            rows.forEach(row => {
                if (row.id === 'noDataRow') return;
                row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
            });
        });

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

        // Chart
        const ctx = document.getElementById('productionChart').getContext('2d');
        const labels = {!! json_encode($chartData->map(fn($d) => $d->sapi->kode_sapi ?? 'N/A')) !!};
        const dataValues = {!! json_encode($chartData->map(fn($d) => $d->total)) !!};
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{ label: 'Total (Liter)', data: dataValues, backgroundColor: '#5d7a54', borderRadius: 8, barThickness: 30 }]
            },
            options: { indexAxis: 'y', responsive: true, scales: { x: { beginAtZero: true, grid: { display: false } }, y: { grid: { display: false } } }, plugins: { legend: { display: false } } }
        });
    </script>

    <script>
        // ====== Modal: Reload iframe ======
        const registerModal = document.getElementById('registerModal');
        const registerIframe = document.getElementById('registerIframe');
        
        if (registerModal && registerIframe) {
            registerModal.addEventListener('show.bs.modal', function(event) {
                // Determine the create route
                // If it's passed via data-route, use it. Otherwise default to the one mapped in JS.
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
