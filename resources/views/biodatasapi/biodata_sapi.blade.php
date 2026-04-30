<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Sapi - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">

    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }

        /* Sidebar */
        .sidebar { width: 260px; height: 100vh; background: #f0e2d0; position: fixed; padding: 30px 20px; border-right: 8px solid #5d7a54; box-shadow: 5px 0 15px rgba(0,0,0,0.1); }
        .brand h4 { font-family: 'Fredoka One', cursive; color: #432118; font-size: 24px; margin-bottom: 0; }
        .brand p { font-size: 14px; color: #845a33; margin-bottom: 40px; }
        .nav-menu { list-style: none; padding: 0; }
        .nav-item { margin-bottom: 12px; }
        .nav-link { text-decoration: none; color: #6d4c41; padding: 12px 18px; display: flex; align-items: center; border-radius: 15px; transition: 0.3s; font-weight: 700; }
        .nav-link i { margin-right: 12px; width: 20px; text-align: center; }
        .nav-link:hover, .nav-link.active { background: #5d7a54; color: #ffffff !important; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }

        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }

        .btn-add { border: none; background: #5d7a54; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; }
        .btn-add:hover { background: #4a6344; color: #fff; }

        .cow-card { background: #f0e2d0; padding: 25px; border-radius: 25px; border: 3px solid #bc9f82; box-shadow: 0 4px 6px rgba(0,0,0,0.05); min-width: 300px; }
        .cow-card h5 { font-family: 'Fredoka One', cursive; color: #432118; }

        .cards-wrapper {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 5px;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none;  /* IE and Edge */
        }

        .cards-wrapper::-webkit-scrollbar {
            display: none; /* Chrome, Safari and Opera */
        }

        /* Tabel Profesional */
        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 16px !important; text-transform: uppercase; font-size: 13px; border: 1px solid #bc9f82 !important; }
        .table tbody td { padding: 16px !important; border: 1px solid #bc9f82 !important; }

        /* Garis Vertikal Tabel */
        .table-bordered-custom th, .table-bordered-custom td { border-left: 1px solid #bc9f82 !important; }
        .table-bordered-custom th:first-child, .table-bordered-custom td:first-child { border-left: none !important; }

        .table tbody tr:hover { background-color: rgba(93, 122, 84, 0.05) !important; }

        .custom-table {
            width: 100%;
            overflow-x: auto;
            border-radius: 15px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .btn-logout {
            border: none;
            background: #5a1f12;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 700;
            color: #ffffff;
            box-shadow: 0 4px 0 #3a150c;
            transition: 0.2s;
        }

        .btn-logout:active {
            transform: translateY(3px);
            box-shadow: 0 1px 0 #3a150c;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand"><h4>Cimilk Yogurt</h4><p>Admin Dashboard</p></div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('manajemen.akun') }}" class="nav-link"><i class="fa-solid fa-user-gear"></i> Manajemen Akun</a></li>
            <li class="nav-item"><a href="{{ route('sapi.index') }}" class="nav-link active"><i class="fa-solid fa-cow"></i> Biodata Sapi</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-flask"></i> Produksi Susu</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-cart-shopping"></i> Penjualan</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="welcome-text">
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One', cursive;">Biodata Sapi 🐄</h3>
                <p style="color: #6d4c41; font-weight: 600; margin-bottom: 0;">Data lengkap sapi peternakan.</p>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('sapi.create') }}" class="btn btn-add"><i class="fa-solid fa-plus me-2"></i>Tambah Sapi Baru</a>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fa-solid fa-sign-out-alt me-2"></i>Keluar
                    </button>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Space preserved if needed -->
        </div>


        <div class="cards-wrapper mb-4">
            @foreach($sapi as $s)
            <div class="cow-card">
                <h5>{{ $s->nama }}</h5>
                <p>ID: {{ $s->kode_sapi }}<br>Jenis: {{ $s->jenis }}<br>
                Status: <span class="{{ strtolower($s->status_kesehatan) == 'sehat' ? 'text-success' : (strtolower($s->status_kesehatan) == 'sakit' ? 'text-danger' : 'text-warning') }} fw-bold">{{ $s->status_kesehatan }}</span></p>
            </div>
            @endforeach
        </div>

        <div class="custom-table mt-4">
            <table class="table table-bordered-custom align-middle">
                <thead>
                    <tr>
                        <th>ID SAPI</th>
                        <th>NAMA</th>
                        <th>JENIS</th>
                        <th>STATUS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sapi as $s)
                    <tr>
                        <td>{{ $s->kode_sapi }}</td>
                        <td>{{ $s->nama }}</td>
                        <td>{{ $s->jenis }}</td>
                        <td>
                            <span class="badge {{ strtolower($s->status_kesehatan) == 'sehat' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $s->status_kesehatan }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('sapi.edit', $s->id) }}" class="btn btn-sm btn-outline-primary shadow-sm">Edit</a>
                                <form action="{{ route('sapi.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data sapi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
