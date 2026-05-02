<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }

        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }

        .page-title-section {
            margin-bottom: 25px;
        }
        .page-title-section h3 {
            font-family: 'Fredoka One', cursive;
            font-size: 26px;
            color: #432118;
            margin: 0 0 4px 0;
        }
        .page-title-section p {
            color: #6d4c41;
            font-weight: 600;
            margin: 0;
        }

        .btn-add { border: none; background: #5d7a54; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; text-decoration: none; white-space: nowrap; }
        .btn-add:hover { background: #4a6344; color: #fff; }

        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

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

        .search-input-group {
            display: flex;
            align-items: center;
            flex-grow: 1;
        }

        .search-input-group i { color: #5a1f12; font-size: 18px; }

        .search-input-group input {
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
            padding: 0px 15px;
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            color: #432118;
            font-size: 15px;
        }

        .search-input-group input::placeholder { color: #845a33; opacity: 0.7; }

        /* Tabel */
        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 16px !important; text-transform: uppercase; font-size: 13px; border: 1px solid #bc9f82 !important; }
        .table tbody td { padding: 16px !important; border: 1px solid #bc9f82 !important; font-weight: 600; }
        .table-bordered-custom th, .table-bordered-custom td { border-left: 1px solid #bc9f82 !important; }
        .table-bordered-custom th:first-child, .table-bordered-custom td:first-child { border-left: none !important; }
        .table tbody tr:hover { background-color: rgba(93, 122, 84, 0.05) !important; }

        .custom-table { width: 100%; overflow-x: auto; border-radius: 15px; }

        .badge-role { padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .badge-admin { background-color: #d1fae5; color: #065f46; }
        .badge-peternak { background-color: #ede9fe; color: #5b21b6; }
        .badge-penjualan { background-color: #ffedd5; color: #c2410c; }

        /* Notifikasi */
        .crud-notification {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 20px;
            animation: fadeInDown 0.4s ease;
        }
        .crud-notification.success {
            background: #d1fae5;
            border: 2px solid #6ee7b7;
            color: #065f46;
        }
        .crud-notification.error {
            background: #fee2e2;
            border: 2px solid #fca5a5;
            color: #7f1d1d;
        }
        .notif-close {
            margin-left: auto;
            background: none;
            border: none;
            cursor: pointer;
            color: inherit;
            opacity: 0.6;
            font-size: 16px;
            padding: 0;
        }
        .notif-close:hover { opacity: 1; }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Modal Floating Styling */
        .modal-content-custom {
            background: transparent;
            border: none;
            box-shadow: none;
        }
        .modal-backdrop.show { opacity: 0.6; background-color: #000; }
        .iframe-container {
            width: 100%;
            height: 750px;
            border: none;
            overflow-y: auto;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none;  /* IE and Edge */
        }
        .iframe-container::-webkit-scrollbar {
            display: none; /* Chrome, Safari and Opera */
        }
        .iframe-container iframe {
            width: 100%;
            height: 100%;
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
            background: #f5efe6;
            border-radius: 20px;
            padding: 35px 40px;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            text-align: center;
            border: 6px solid #8CA685;
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
            font-family: 'Fredoka One', cursive;
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
    </style>
</head>
<body>

    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Manajemen Akun', 'pageSubtitle' => 'Kelola semua akun pengguna sistem'])

    <!-- Main Content -->
    <div class="main-content">

        <div class="page-title-section">
            <h3>Daftar Akun Pengguna</h3>
            <p>Kelola semua akun pengguna sistem.</p>
        </div>

        {{-- Notifikasi CRUD (posisi di atas search) --}}
        @if(session('success') || request()->query('success'))
            <div class="crud-notification success" id="crudNotif">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') ?? request()->query('success') }}</span>
                <button class="notif-close" onclick="document.getElementById('crudNotif').remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        <div class="action-bar">
            <div class="search-wrapper">
                <div class="search-input-group">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama atau username pengguna...">
                </div>
            </div>
            <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#registerModal" id="btnTambahAkun">
                <i class="fa-solid fa-user-plus me-2"></i> Tambah Akun
            </button>
        </div>

        <div class="custom-table">
            <table class="table table-bordered-custom align-middle">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>USERNAME</th>
                        <th>NAMA LENGKAP</th>
                        <th>ROLE</th>
                        <th>STATUS</th>
                        <th>TANGGAL DIBUAT</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    @foreach($users as $index => $user)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $user->username ?? '-' }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @php
                                $roleClass = 'badge-admin';
                                $roleText = 'admin';
                                if($user->role == 'Peternak') { $roleClass = 'badge-peternak'; $roleText = 'peternak'; }
                                elseif($user->role == 'Penjualan') { $roleClass = 'badge-penjualan'; $roleText = 'manajemen penjualan'; }
                            @endphp
                            <span class="badge-role {{ $roleClass }}">{{ $roleText }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $user->status == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                                {{ $user->status }}
                            </span>
                        </td>
                        <td>{{ $user->created_at ? $user->created_at->format('Y-m-d') : '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('manajemen-akun.edit', $user->id) }}" class="btn btn-sm btn-outline-primary shadow-sm">Edit</a>
                                <button type="button"
                                    class="btn btn-sm btn-outline-danger shadow-sm"
                                    onclick="confirmDelete('{{ route('manajemen-akun.destroy', $user->id) }}', '{{ $user->name }}')">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr id="noDataRow" style="display: none;">
                        <td colspan="7" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="fa-solid fa-magnifying-glass mb-3" style="font-size: 48px; color: #a67c52; opacity: 0.4;"></i>
                                <h5 class="fw-bold mb-1" style="color: #432118;">Data Tidak Ditemukan</h5>
                                <p class="text-muted mb-0">Maaf, kami tidak dapat menemukan data yang Anda cari.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal Register -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="iframe-container">
                    <iframe id="registerIframe" src="" scrolling="no"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Confirm Delete Modal -->
    <div class="confirm-overlay" id="confirmOverlay">
        <div class="confirm-box">
            <div class="confirm-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h5>Hapus Akun?</h5>
            <p id="confirmMessage">Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak bisa dibatalkan.</p>
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
        // ====== Search ======
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#userTableBody tr:not(#noDataRow)');
            let visibleCount = 0;

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                if (text.includes(filter)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('noDataRow').style.display = visibleCount === 0 ? '' : 'none';
        });

        // ====== Modal: Reload iframe setiap kali modal dibuka ======
        const registerModal = document.getElementById('registerModal');
        const registerIframe = document.getElementById('registerIframe');
        const iframeSrc = "{{ route('manajemen-akun.create', ['mode' => 'modal']) }}";

        registerModal.addEventListener('show.bs.modal', function() {
            // Reload fresh iframe every time modal opens (clear old state/notification)
            registerIframe.src = iframeSrc;
        });

        registerModal.addEventListener('hide.bs.modal', function() {
            // Clear iframe src when modal closes
            registerIframe.src = '';
        });

        // ====== Custom Delete Confirm ======
        let deleteUrl = '';

        function confirmDelete(url, name) {
            deleteUrl = url;
            document.getElementById('confirmMessage').textContent = 
                'Apakah Anda yakin ingin menghapus akun "' + name + '"? Tindakan ini tidak bisa dibatalkan.';
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
                notif.style.transition = 'opacity 0.5s ease';
                setTimeout(() => notif.remove(), 500);
            }, 5000);
        }
    </script>
</body>
</html>
