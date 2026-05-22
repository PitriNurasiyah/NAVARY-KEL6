<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">
    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        
        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        /* Action Bar */
        .action-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; gap: 15px; }
        .search-wrapper {
            background: #e6d5c0;
            border: 3px solid #a67c52;
            padding: 10.5px 15px;
            border-radius: 12px;
            flex-grow: 1;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .search-input-group { display: flex; align-items: center; width: 100%; gap: 10px; }
        .search-input-group i { color: #5a1f12; font-size: 18px; }
        .search-input-group input {
            background: transparent; border: none; outline: none; width: 100%;
            padding: 0px 15px; font-family: 'Quicksand', sans-serif;
            font-weight: 600; color: #432118; font-size: 15px;
        }

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
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 16px !important; text-transform: uppercase; font-size: 13px; border: 1px solid #bc9f82 !important; }
        .table tbody td { padding: 16px !important; border: 1px solid #bc9f82 !important; font-weight: 600; background: white; }
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
        
        {{-- Notifikasi CRUD --}}
        @if(session('success') || request()->query('success'))
            <div class="crud-notification success" id="crudNotif" style="display: flex; align-items: center; gap: 12px; padding: 15px 25px; border-radius: 12px; font-weight: 700; font-size: 14px; margin-bottom: 25px; background: #dcfce7; border: 2px solid #22c55e; color: #166534; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') ?? request()->query('success') }}</span>
                <button class="notif-close" onclick="document.getElementById('crudNotif').remove()" style="margin-left: auto; background: none; border: none; color: inherit; font-size: 18px; cursor: pointer; opacity: 0.5;">
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
            <a href="{{ route('penjualan.input') }}" class="btn-add">
                <i class="fa-solid fa-plus me-2"></i> Tambah Transaksi
            </a>
            @endif
        </div>

        <div class="custom-table">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">NO</th>
                            <th>TANGGAL</th>
                            <th>PEMBELI</th>
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
                                    <a href="{{ route('penjualan.edit', $item->id) }}" class="btn btn-sm btn-outline-primary shadow-sm" style="border-radius: 8px; font-weight: 700; padding: 5px 12px;">
                                        Edit
                                    </a>
                                    <button type="button" 
                                        class="btn btn-sm btn-outline-danger shadow-sm" 
                                        style="border-radius: 8px; font-weight: 700; padding: 5px 12px;"
                                        onclick="confirmDelete('{{ route('penjualan.destroy', $item->id) }}', '{{ $item->pembeli }}')">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ Auth::user()->role === 'Admin' ? 6 : 7 }}" class="text-center py-5">
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

    <!-- Custom Confirm Delete Modal -->
    <div class="confirm-overlay" id="confirmOverlay" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 9999; align-items: center; justify-content: center;">
        <div class="confirm-box" style="background: #f5efe6; border-radius: 20px; padding: 35px 40px; max-width: 420px; width: 90%; box-shadow: 0 20px 50px rgba(0,0,0,0.3); text-align: center; border: 6px solid #8CA685;">
            <div class="confirm-icon" style="font-size: 48px; color: #c0392b; margin-bottom: 15px;"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h5 style="font-family: 'Fredoka One', cursive; color: #432118; font-size: 20px; margin-bottom: 8px;">Hapus Transaksi?</h5>
            <p id="confirmMessage" style="color: #6d4c41; font-weight: 600; font-size: 14px; margin-bottom: 25px;">Apakah Anda yakin ingin menghapus data penjualan ini?</p>
            <div class="confirm-actions" style="display: flex; gap: 12px; justify-content: center;">
                <button class="btn-confirm-yes" id="confirmYesBtn" style="background: #c0392b; color: #fff; border: none; padding: 10px 28px; border-radius: 12px; font-weight: 700; box-shadow: 0 4px 0 #922b21; cursor: pointer;">Ya, Hapus</button>
                <button class="btn-confirm-no" onclick="closeConfirm()" style="background: #e2e8f0; color: #475569; border: none; padding: 10px 28px; border-radius: 12px; font-weight: 700; cursor: pointer;">Batal</button>
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
            document.getElementById('confirmOverlay').style.display = 'flex';
        }

        function closeConfirm() {
            document.getElementById('confirmOverlay').style.display = 'none';
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
                notif.style.transition = 'opacity 0.5s ease';
                setTimeout(() => notif.remove(), 500);
            }, 5000);
        }
    </script>
</body>
</html>
