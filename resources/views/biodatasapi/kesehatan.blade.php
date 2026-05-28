<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kesehatan Sapi - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;600;700&family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">

    <style>
        body { background-color: #f4efe6; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }

        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }

        /* Page title */
        .page-title-section { margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between; }
        .page-title-section h3 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #4d624a; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        .btn-back { border: none; background: #845a33; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #152414; transition: 0.2s; text-decoration: none; white-space: nowrap; }
        .btn-back:hover { background: #6d4c41; color: #fff; transform: translateY(-2px); }

        .btn-add { border: none; background: #5d7a54; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; text-decoration: none; white-space: nowrap; }
        .btn-add:hover { background: #4a6344; color: #fff; transform: translateY(-2px); }

        /* Form Card */
        .form-card { background: #fffcf7; padding: 30px; border-radius: 20px; border: 1.5px solid #e6d5c0; box-shadow: 0 8px 20px rgba(0,0,0,0.03); margin-bottom: 30px; }
        .form-card h5 { font-family: 'Playfair Display', serif; font-weight: 700; color: #432118; margin-bottom: 20px; }
        
        .form-control, .form-select {
            background-color: #fdfbf7; border: 2.5px solid #d4c2ab; border-radius: 12px;
            padding: 12px 16px; font-weight: 600; color: #432118; transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            background-color: #ffffff; border-color: #a67c52; box-shadow: 0 0 0 4px rgba(166, 124, 82, 0.15);
        }
        .form-label { font-weight: 700; color: #152414; margin-bottom: 8px; font-size: 14px; }

        /* Tabel */
        .custom-table { width: 100%; overflow-x: auto; border-radius: 15px; }
        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; background: #fffcf7; border-radius: 15px; overflow: hidden; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 14px 16px !important; text-transform: uppercase; font-size: 11px; border: 1px solid #e6d5c0 !important; letter-spacing: 0.5px; }
        .table tbody td { padding: 14px 16px !important; border: 1px solid #e6d5c0 !important; background: #fffcf7; font-weight: 600; }
        .table-bordered-custom th, .table-bordered-custom td { border-left: 1px solid #e6d5c0 !important; }
        .table-bordered-custom th:first-child, .table-bordered-custom td:first-child { border-left: none !important; }
        .table tbody tr:hover td { background-color: rgba(93, 122, 84, 0.05) !important; }

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

        /* Farm Modal Styles */
        .farm-wrapper { position: relative; width: 100%; max-width: 500px; margin: auto; }
        .login-box {
            width: 100%;
            background-color: #f5efe6;
            padding: 25px 25px 30px;
            border-radius: 40px;
            box-shadow: 0 20px 45px rgba(0,0,0,0.2);
            position: relative;
            border: 10px solid transparent;
            background-clip: padding-box;
        }
        .login-box::before {
            content: '';
            position: absolute;
            top: -15px; left: -15px; right: -15px; bottom: -15px;
            z-index: -1;
            background-color: #8CA685;
            background-image: url('https://www.transparenttextures.com/patterns/grass.png');
            border-radius: 50px;
        }
        .top-icon {
            position: absolute;
            top: -55px;
            left: 50%;
            transform: translateX(-50%);
            background: #f5efe6;
            padding: 6px;
            border-radius: 50%;
            z-index: 20;
        }
        .top-icon img {
            background: white;
            border: 2px solid #D2B48C;
            border-radius: 50%;
            padding: 8px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            width: 65px;
        }
        .btn-close-custom {
            position: absolute;
            top: 15px;
            right: 15px;
            background: transparent;
            border: none;
            font-size: 20px;
            color: #8CA685;
            cursor: pointer;
            z-index: 30;
            padding: 0;
            line-height: 1;
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-family: 'Fredoka', sans-serif;
            font-weight: bold;
            color: #432118;
            margin-top: 15px;
            margin-bottom: 25px;
            line-height: 1.1;
        }
        .btn-register {
            width: 100%;
            background: #233722;
            color: white;
            border-radius: 12px;
            padding: 12px;
            font-weight: bold;
            font-size: 18px;
            border: none;
            box-shadow: 0 6px 0 #152414;
            transition: all 0.1s ease;
        }
        .btn-register:active { transform: translateY(4px); box-shadow: 0 2px 0 #152414; }
        .barn-icon {
            position: absolute;
            bottom: 40px;
            right: -10px;
            width: 75px;
            z-index: 10;
            pointer-events: none;
        }
        #tambahLogModal, #tambahLogModal .form-control, #tambahLogModal .form-select, #tambahLogModal .form-label {
            font-family: 'Quicksand', sans-serif;
        }
        #tambahLogModal .form-control, #tambahLogModal .form-select {
            font-size: 14px !important;
            padding: 10px 14px !important;
        }
        #tambahLogModal .form-label {
            font-size: 14px !important;
            font-weight: 700 !important;
            color: #432118 !important;
            margin-bottom: 4px !important;
        }
        .modal-title-custom {
            text-align: center;
            font-size: 26px;
            font-family: 'Playfair Display', serif;
            font-weight: bold;
            color: #432118;
            margin-top: 15px;
            margin-bottom: 25px;
            line-height: 1.1;
        }
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
    </style>
</head>
<body>

    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Kesehatan Sapi', 'pageSubtitle' => 'Log aktivitas kesehatan sapi'])

    <div class="main-content">

        <div class="page-title-section">
            <div>
                <h3>Riwayat Kesehatan: {{ $sapi->nama }} ({{ $sapi->kode_sapi }}) 🩺</h3>
                <p>Status saat ini: <span class="badge {{ strtolower($sapi->status_kesehatan) == 'sehat' ? 'bg-success' : 'bg-danger' }}">{{ $sapi->status_kesehatan }}</span></p>
            </div>
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

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius: 12px; font-weight: 600;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-md-12">
                <div class="form-card" style="padding: 0; background: transparent; border: none; box-shadow: none;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('sapi.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
                        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#tambahLogModal"><i class="fa-solid fa-plus me-2"></i>Tambah Log Kesehatan</button>
                    </div>
                    <div class="custom-table">
                        <table class="table table-bordered-custom align-middle">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kondisi</th>
                                    <th>Tindakan</th>
                                    <th>Catatan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kesehatan as $log)
                                <tr>
                                    <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($log->tanggal)->format('d M Y') }}</td>
                                    <td><span class="fw-bold">{{ $log->kondisi_sekarang }}</span></td>
                                    <td>{{ $log->tindakan_perawatan ?? '-' }}</td>
                                    <td>{{ $log->catatan_perkembangan ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-outline-primary shadow-sm btn-edit-log" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editLogModal"
                                                data-id="{{ $log->id }}"
                                                data-tanggal="{{ $log->tanggal }}"
                                                data-kondisi="{{ $log->kondisi_sekarang }}"
                                                data-tindakan="{{ $log->tindakan_perawatan ?? '' }}"
                                                data-catatan="{{ $log->catatan_perkembangan ?? '' }}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger shadow-sm" onclick="confirmDelete('{{ route('kesehatan.destroy', $log->id) }}', '{{ \Carbon\Carbon::parse($log->tanggal)->format('d M Y') }}')">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fa-solid fa-clipboard-list mb-3" style="font-size: 40px; color: #a67c52; opacity: 0.4;"></i>
                                            <h6 class="fw-bold mb-1" style="color: #432118;">Belum Ada Riwayat</h6>
                                            <p class="text-muted mb-0" style="font-size: 14px;">Belum ada log kesehatan untuk sapi ini.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $kesehatan->links() }}
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal Tambah Log Kesehatan -->
    <div class="modal fade" id="tambahLogModal" tabindex="-1" aria-labelledby="tambahLogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
            <div class="modal-content" style="background: transparent; border: none; box-shadow: none; overflow: visible; padding-top: 60px;">
                <div class="farm-wrapper">
                    <div class="top-icon">
                        <img src="{{ asset('img/sapii.png') }}" width="80" alt="logo">
                    </div>

                    <div class="login-box">
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>

                        <div class="modal-title-custom">Tambah Log Kesehatan</div>

                        <form action="{{ route('kesehatan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="sapi_id" value="{{ $sapi->id }}">
                            
                            <div class="mb-2">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Kondisi Sekarang</label>
                                <input type="text" name="kondisi_sekarang" class="form-control" placeholder="Contoh: Demam, Sehat, etc..." required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Tindakan / Perawatan</label>
                                <input type="text" name="tindakan_perawatan" class="form-control" placeholder="Contoh: Pemberian Vaksin PMK">
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Catatan Perkembangan</label>
                                <textarea name="catatan_perkembangan" class="form-control" rows="3" placeholder="Tambahkan detail jika ada..."></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Update Status Sapi</label>
                                <input type="text" name="update_status_sapi" class="form-control" placeholder="Kosongkan jika tidak ada perubahan status">
                            </div>

                            <div class="position-relative mt-4">
                                <img src="{{ asset('img/farm.png') }}" class="barn-icon" alt="barn">
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-secondary w-100 fw-bold" style="border-radius: 12px; padding: 12px; background-color: #8c7b6f; border: none; box-shadow: 0 6px 0 #5e5149; color: white;" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn-register w-100"><i class="fa-solid fa-notes-medical me-2"></i>Simpan Log</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- Modal Edit Log Kesehatan -->
    <div class="modal fade" id="editLogModal" tabindex="-1" aria-labelledby="editLogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
            <div class="modal-content" style="background: transparent; border: none; box-shadow: none; overflow: visible; padding-top: 60px;">
                <div class="farm-wrapper">
                    <div class="top-icon">
                        <img src="{{ asset('img/sapii.png') }}" width="80" alt="logo">
                    </div>

                    <div class="login-box">
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>

                        <div class="modal-title-custom">Edit Log Kesehatan</div>

                        <form id="editLogForm" action="" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-2">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" id="edit_tanggal" class="form-control" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Kondisi Sekarang</label>
                                <input type="text" name="kondisi_sekarang" id="edit_kondisi_sekarang" class="form-control" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Tindakan / Perawatan</label>
                                <input type="text" name="tindakan_perawatan" id="edit_tindakan_perawatan" class="form-control">
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Catatan Perkembangan</label>
                                <textarea name="catatan_perkembangan" id="edit_catatan_perkembangan" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Update Status Sapi</label>
                                <input type="text" name="update_status_sapi" id="edit_update_status_sapi" class="form-control" placeholder="Kosongkan jika tidak ada perubahan status">
                            </div>

                            <div class="position-relative mt-4">
                                <img src="{{ asset('img/farm.png') }}" class="barn-icon" alt="barn">
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-secondary w-100 fw-bold" style="border-radius: 12px; padding: 12px; background-color: #8c7b6f; border: none; box-shadow: 0 6px 0 #5e5149; color: white;" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn-register w-100"><i class="fa-solid fa-notes-medical me-2"></i>Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #editLogModal, #editLogModal .form-control, #editLogModal .form-select, #editLogModal .form-label {
            font-family: 'Quicksand', sans-serif;
        }
        #editLogModal .form-control, #editLogModal .form-select {
            font-size: 14px !important;
            padding: 10px 14px !important;
        }
        #editLogModal .form-label {
            font-size: 14px !important;
            font-weight: 700 !important;
            color: #432118 !important;
            margin-bottom: 4px !important;
        }
    </style>

    <!-- Custom Confirm Delete Modal -->
    <div class="confirm-overlay" id="confirmOverlay">
        <div class="confirm-box">
            <div class="confirm-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h5>Hapus Log Kesehatan?</h5>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const notif = document.getElementById('crudNotif');
        if (notif) {
            setTimeout(() => {
                notif.style.opacity = '0';
                notif.style.transform = 'translateX(50px)';
                notif.style.transition = 'all 0.5s ease';
                setTimeout(() => notif.remove(), 500);
            }, 5000);
        }

        const editButtons = document.querySelectorAll('.btn-edit-log');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const tanggal = this.getAttribute('data-tanggal');
                const kondisi = this.getAttribute('data-kondisi');
                const tindakan = this.getAttribute('data-tindakan');
                const catatan = this.getAttribute('data-catatan');

                const form = document.getElementById('editLogForm');
                form.action = "{{ url('kesehatan') }}/" + id;

                document.getElementById('edit_tanggal').value = tanggal;
                document.getElementById('edit_kondisi_sekarang').value = kondisi;
                document.getElementById('edit_tindakan_perawatan').value = tindakan;
                document.getElementById('edit_catatan_perkembangan').value = catatan;
                document.getElementById('edit_update_status_sapi').value = '';
            });
        });

        let deleteUrl = '';
        function confirmDelete(url, date) {
            deleteUrl = url;
            document.getElementById('confirmMessage').textContent = 'Apakah Anda yakin ingin menghapus log kesehatan tanggal "' + date + '"?';
            document.getElementById('confirmOverlay').classList.add('active');
        }
        function closeConfirm() { document.getElementById('confirmOverlay').classList.remove('active'); }
        document.getElementById('confirmYesBtn').addEventListener('click', function() {
            const form = document.getElementById('deleteForm');
            form.action = deleteUrl;
            form.submit();
        });
    </script>
</body>
</html>
