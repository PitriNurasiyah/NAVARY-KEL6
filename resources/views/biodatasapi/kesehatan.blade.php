<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kesehatan Sapi - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">

    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }

        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }

        /* Page title */
        .page-title-section { margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        .btn-back { border: none; background: #845a33; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #5a1f12; transition: 0.2s; text-decoration: none; }
        .btn-back:hover { background: #6d4c41; color: #fff; transform: translateY(-2px); }

        .btn-add { border: none; background: #5d7a54; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; text-decoration: none; }
        .btn-add:hover { background: #4a6344; color: #fff; transform: translateY(-2px); }

        /* Form Card */
        .form-card { background: #f0e2d0; padding: 30px; border-radius: 25px; border: 3px solid #bc9f82; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .form-card h5 { font-family: 'Fredoka One', cursive; color: #432118; margin-bottom: 20px; }
        
        .form-control, .form-select {
            background-color: #fdfbf7; border: 2px solid #d4c2ab; border-radius: 12px;
            padding: 12px 16px; font-weight: 600; color: #432118; transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            background-color: #ffffff; border-color: #a67c52; box-shadow: 0 0 0 4px rgba(166, 124, 82, 0.15);
        }
        .form-label { font-weight: 700; color: #5a1f12; margin-bottom: 8px; font-size: 14px; }

        /* Tabel */
        .custom-table { width: 100%; overflow-x: auto; border-radius: 15px; }
        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; background: #fdfbf7; border-radius: 15px; overflow: hidden; }
        .table thead th { background-color: #8CA685 !important; color: #fff !important; padding: 16px !important; text-transform: uppercase; font-size: 13px; border: 1px solid #bc9f82 !important; border-top: none !important; }
        .table tbody td { padding: 16px !important; border: 1px solid #bc9f82 !important; }
        .table-bordered-custom th, .table-bordered-custom td { border-left: 1px solid #bc9f82 !important; }
        .table-bordered-custom th:first-child, .table-bordered-custom td:first-child { border-left: none !important; }
        .table tbody tr:hover { background-color: rgba(140, 166, 133, 0.1) !important; }

        .crud-notification {
            display: flex; align-items: center; gap: 12px; padding: 15px 25px; border-radius: 12px;
            font-weight: 700; font-size: 14px; margin-bottom: 25px; animation: fadeInDown 0.4s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .crud-notification.success { background: #dcfce7; border: 2px solid #22c55e; color: #166534; }
        .notif-close { margin-left: auto; background: none; border: none; color: inherit; font-size: 18px; cursor: pointer; opacity: 0.5; transition: 0.2s; }
        .notif-close:hover { opacity: 1; }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

    </style>
</head>
<body>

    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Pemantauan Kesehatan Sapi', 'pageSubtitle' => 'Log aktivitas kesehatan sapi'])

    <div class="main-content">

        <div class="page-title-section">
            <div>
                <h3>Riwayat Kesehatan: {{ $sapi->nama }} ({{ $sapi->kode_sapi }}) 🩺</h3>
                <p>Status saat ini: <span class="badge {{ strtolower($sapi->status_kesehatan) == 'sehat' ? 'bg-success' : 'bg-danger' }}">{{ $sapi->status_kesehatan }}</span></p>
            </div>
            <a href="{{ route('sapi.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
        </div>

        @if(session('success'))
            <div class="crud-notification success" id="crudNotif">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
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
            <div class="col-md-4">
                <div class="form-card">
                    <h5>Tambah Log Kesehatan</h5>
                    <form action="{{ route('kesehatan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sapi_id" value="{{ $sapi->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kondisi Sekarang</label>
                            <input type="text" name="kondisi_sekarang" class="form-control" placeholder="Cth: Demam, Membaik..." required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tindakan / Perawatan</label>
                            <input type="text" name="tindakan_perawatan" class="form-control" placeholder="Cth: Pemberian Vaksin PMK">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan Perkembangan</label>
                            <textarea name="catatan_perkembangan" class="form-control" rows="3" placeholder="Tambahkan detail jika ada..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Update Status Sapi (Opsional)</label>
                            <input type="text" name="update_status_sapi" class="form-control" placeholder="Kosongkan jika tidak ada perubahan status">
                        </div>

                        <button type="submit" class="btn-add w-100"><i class="fa-solid fa-notes-medical me-2"></i>Simpan Log</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-card" style="padding: 0; background: transparent; border: none; box-shadow: none;">
                    <h5 class="mb-3">Tabel Riwayat Pemantauan</h5>
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
                                @forelse($sapi->pemantauanKesehatan->sortByDesc('tanggal') as $log)
                                <tr>
                                    <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($log->tanggal)->format('d M Y') }}</td>
                                    <td><span class="fw-bold">{{ $log->kondisi_sekarang }}</span></td>
                                    <td>{{ $log->tindakan_perawatan ?? '-' }}</td>
                                    <td>{{ $log->catatan_perkembangan ?? '-' }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('kesehatan.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Hapus log kesehatan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm"><i class="fa-solid fa-trash"></i></button>
                                        </form>
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
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
