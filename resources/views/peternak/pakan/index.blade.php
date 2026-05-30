<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pakan - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">

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

        .btn-add { border: none; background: #5d7a54; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; text-decoration: none; white-space: nowrap; }
        .btn-add:hover { background: #4a6344; color: #fff; }

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

        /* Tabel */
        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 14px 16px !important; text-transform: uppercase; font-size: 11px; border: 1px solid #e6d5c0 !important; letter-spacing: 0.5px; }
        .table tbody td { padding: 14px 16px !important; border: 1px solid #e6d5c0 !important; background: #fffcf7; font-weight: 600; }
        .table-bordered-custom th, .table-bordered-custom td { border-left: 1px solid #e6d5c0 !important; }
        .table-bordered-custom th:first-child, .table-bordered-custom td:first-child { border-left: none !important; }
        .table tbody tr:hover td { background-color: rgba(93, 122, 84, 0.05) !important; }
        .custom-table { width: 100%; overflow-x: auto; border-radius: 15px; }

        .cards-wrapper {
            display: flex;
            overflow-x: auto;
            gap: 15px;
            padding-bottom: 10px;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .cards-wrapper::-webkit-scrollbar { display: none; }
        .stat-card {
            background: #fffcf7;
            padding: 25px;
            border-radius: 20px;
            border: 1.5px solid #e6d5c0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03);
            text-decoration: none;
            height: 100%;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            border-color: #bc9f82 !important;
            box-shadow: 0 12px 25px rgba(0,0,0,0.08) !important;
        }
        .stat-info span { color: #845a33; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; }
        .stat-info h2 { font-family: 'Playfair Display', serif; margin: 5px 0; font-size: 32px; font-weight: 700; color: #432118; }
        .stat-unit { color: #5d7a54; font-weight: 800; font-size: 12px; }

        /* Custom Delete Confirm Modal */
        .confirm-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); }
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

        </style>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Manajemen Pakan', 'pageSubtitle' => 'Catat jenis pakan dan pemberian pakan'])

    <div class="main-content">
        <div class="page-title-section">
            <h3>Manajemen Pakan Sapi 🌾</h3>
            <p>Kelola stok dan jadwal pemberian pakan sapi.</p>
        </div>



        @if(session('success') || request('success'))
            <div class="crud-notification success" id="crudNotif">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') ?? request('success') }}</span>
                <button class="notif-close" onclick="document.getElementById('crudNotif').remove()"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        <!-- Section: Ringkasan Tiap Jenis Pakan -->
        <div class="mb-5">
            <div class="cards-wrapper">
                @forelse($ringkasanPakan as $pakanItem)
                <div class="stat-card flex-shrink-0" style="width: 280px; display: flex; justify-content: space-between; align-items: center;">
                    <div class="stat-info">
                        <span>{{ $pakanItem->nama_pakan }} 🌾</span>
                        <h2 class="fw-bold mt-2 mb-1" style="font-family: 'Playfair Display', serif; font-size: 20px; color: #432118;">
                            <span class="text-success">{{ number_format($pakanItem->total_stok ?? 0, 0, ',', '.') }} <span style="font-size: 13px; font-weight: 700; font-family: 'Quicksand', sans-serif;">{{ $pakanItem->satuan }}</span></span> / 
                            <span class="text-warning">{{ number_format($pakanItem->total_digunakan ?? 0, 0, ',', '.') }} <span style="font-size: 13px; font-weight: 700; font-family: 'Quicksand', sans-serif;">{{ $pakanItem->satuan }}</span></span>
                        </h2>
                        <div class="stat-unit">Stok / Digunakan</div>
                    </div>
                    <div class="icon-circle bg-custom-green d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 15px; background: rgba(93, 122, 84, 0.1); color: #5d7a54; font-size: 20px;">
                        <i class="fa-solid fa-seedling"></i>
                    </div>
                </div>
                @empty
                <div class="text-muted p-3">Belum ada ringkasan akumulasi pakan.</div>
                @endforelse
            </div>
        </div>

        <!-- Section: Persediaan Stok Pakan -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold m-0" style="color: #432118; font-family: 'Playfair Display', serif;">Persediaan Stok Pakan 📦</h4>
        </div>
        <div class="action-bar">
            <div class="search-wrapper">
                <div class="search-input-group">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInputStok" placeholder="Cari stok pakan berdasarkan nama...">
                </div>
            </div>
            @if(Auth::user()->role === 'Peternak')
            <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#registerModal" data-route="{{ route('pakan.create') }}"><i class="fa-solid fa-plus me-2"></i>Tambah Pakan Baru</button>
            @endif
        </div>

        <div class="custom-table mb-4">
            <table class="table table-bordered-custom align-middle">
                <thead>
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>NAMA PAKAN</th>
                        <th>STOK</th>
                        <th>KETERANGAN</th>
                        @if(Auth::user()->role === 'Peternak')
                        <th class="text-center">AKSI</th>
                        @endif
                    </tr>
                </thead>
                <tbody id="stokTableBody">
                    @forelse($stokPakan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $item->nama_pakan }}</td>
                        <td>{{ $item->stok }} {{ $item->satuan }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        @if(Auth::user()->role === 'Peternak')
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-sm btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#registerModal" data-route="{{ route('pakan.edit', $item->id) }}">Edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger shadow-sm" onclick="confirmDelete('{{ route('pakan.destroy', $item->id) }}', '{{ $item->nama_pakan }}')">Hapus</button>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr id="noStokRow">
                        <td colspan="5" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="fa-solid fa-box-open mb-3" style="font-size: 48px; color: #a67c52; opacity: 0.4;"></i>
                                <h5 class="fw-bold mb-1" style="color: #432118;">Stok Kosong</h5>
                                <p class="text-muted mb-0">Belum ada data persediaan stok pakan yang tersimpan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2 mb-5">
            {{ $stokPakan->links() }}
        </div>

        <!-- Section: Monitoring Pemberian Pakan Sapi -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold m-0" style="color: #432118; font-family: 'Playfair Display', serif;">Monitoring Pemberian Pakan Sapi 🐄</h4>
        </div>
        <div class="action-bar">
            <div class="search-wrapper">
                <div class="search-input-group">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInputPemberian" placeholder="Cari pemberian pakan berdasarkan sapi atau jenis pakan...">
                </div>
            </div>
            @if(Auth::user()->role === 'Peternak')
            <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#registerModal" data-route="{{ route('pemberian-pakan.create') }}"><i class="fa-solid fa-plus me-2"></i>Tambah Pemberian Pakan</button>
            @endif
        </div>

        <div class="custom-table">
            <table class="table table-bordered-custom align-middle">
                <thead>
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>TANGGAL PEMBERIAN</th>
                        <th>NAMA SAPI</th>
                        <th>JENIS PAKAN</th>
                        <th>JUMLAH PEMBERIAN</th>
                        <th>KETERANGAN</th>
                        @if(Auth::user()->role === 'Peternak')
                        <th class="text-center">AKSI</th>
                        @endif
                    </tr>
                </thead>
                <tbody id="pemberianTableBody">
                    @forelse($pemberianPakan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pemberian)->format('d M Y') }}</td>
                        <td class="fw-bold">{{ $item->sapi ? $item->sapi->nama . ' (' . $item->sapi->kode_sapi . ')' : '-' }}</td>
                        <td>{{ $item->nama_pakan }}</td>
                        <td>{{ $item->stok }} {{ $item->satuan }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        @if(Auth::user()->role === 'Peternak')
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-sm btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#registerModal" data-route="{{ route('pemberian-pakan.edit', $item->id) }}">Edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger shadow-sm" onclick="confirmDeletePemberian('{{ route('pemberian-pakan.destroy', $item->id) }}', '{{ $item->nama_pakan }}')">Hapus</button>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr id="noPemberianRow">
                        <td colspan="7" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="fa-solid fa-clipboard-list mb-3" style="font-size: 48px; color: #a67c52; opacity: 0.4;"></i>
                                <h5 class="fw-bold mb-1" style="color: #432118;">Log Kosong</h5>
                                <p class="text-muted mb-0">Belum ada data pemberian pakan sapi yang tercatat.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{ $pemberianPakan->links() }}
        </div>
    </div>

    <!-- Custom Confirm Delete Modal -->
    <div class="confirm-overlay" id="confirmOverlay">
        <div class="confirm-box">
            <div class="confirm-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h5>Hapus Data Pakan?</h5>
            <p id="confirmMessage">Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="confirm-actions">
                <button class="btn-confirm-yes" id="confirmYesBtn">Ya, Hapus</button>
                <button class="btn-confirm-no" onclick="closeConfirm()">Batal</button>
            </div>
        </div>
    </div>

    <form id="deleteForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
    <form id="deletePemberianForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    
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
        // Search stok
        const searchStok = document.getElementById('searchInputStok');
        if (searchStok) {
            searchStok.addEventListener('input', function() {
                let filter = this.value.toLowerCase();
                document.querySelectorAll('#stokTableBody tr').forEach(row => {
                    if (row.id === 'noStokRow') return;
                    row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
                });
            });
        }

        // Search pemberian
        const searchPemberian = document.getElementById('searchInputPemberian');
        if (searchPemberian) {
            searchPemberian.addEventListener('input', function() {
                let filter = this.value.toLowerCase();
                document.querySelectorAll('#pemberianTableBody tr').forEach(row => {
                    if (row.id === 'noPemberianRow') return;
                    row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
                });
            });
        }

        let deleteUrl = '';
        let deletePemberianUrl = '';

        function confirmDelete(url, name) {
            deleteUrl = url;
            document.getElementById('confirmYesBtn').dataset.mode = 'stok';
            document.getElementById('confirmMessage').textContent = 'Apakah Anda yakin ingin menghapus data pakan "' + name + '"?';
            document.getElementById('confirmOverlay').classList.add('active');
        }
        function confirmDeletePemberian(url, name) {
            deletePemberianUrl = url;
            document.getElementById('confirmYesBtn').dataset.mode = 'pemberian';
            document.getElementById('confirmMessage').textContent = 'Hapus log pemberian "' + name + '"? Stok akan dikembalikan otomatis.';
            document.getElementById('confirmOverlay').classList.add('active');
        }
        function closeConfirm() {
            document.getElementById('confirmOverlay').classList.remove('active');
        }

        document.getElementById('confirmOverlay').addEventListener('click', function(e) {
            if (e.target === this) closeConfirm();
        });

        document.getElementById('confirmYesBtn').addEventListener('click', function() {
            if (this.dataset.mode === 'pemberian') {
                const form = document.getElementById('deletePemberianForm');
                form.action = deletePemberianUrl;
                form.submit();
            } else {
                const form = document.getElementById('deleteForm');
                form.action = deleteUrl;
                form.submit();
            }
        });

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
