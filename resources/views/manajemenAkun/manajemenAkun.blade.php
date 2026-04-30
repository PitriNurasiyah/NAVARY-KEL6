<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #dcc8ae; /* Background utama */
            color: #432118;
            margin: 0;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background: #f0e2d0;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            border-right: 8px solid #5d7a54;
            box-shadow: 5px 0 15px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .brand h4 { font-family: 'Fredoka One', cursive; color: #432118; font-size: 24px; margin-bottom: 0; text-align: center; }
        .brand p { font-size: 14px; color: #845a33; margin-bottom: 40px; text-align: center; }
        .nav-menu { list-style: none; padding: 0; }
        .nav-item { margin-bottom: 12px; }
        .nav-link { text-decoration: none; color: #6d4c41; padding: 12px 18px; display: flex; align-items: center; border-radius: 15px; transition: 0.3s; font-weight: 700; }
        .nav-link i { margin-right: 12px; width: 20px; text-align: center; }
        .nav-link:hover, .nav-link.active { background: #5d7a54; color: #ffffff !important; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }

        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 45px;
        }

        /* Header Styling */
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

        .btn-add {
            border: none;
            background: #5d7a54;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            color: #ffffff;
            box-shadow: 0 4px 0 #3a4d33;
            transition: 0.2s;
            text-decoration: none;
        }
        .btn-add:hover {
            background: #4a6344;
            color: #fff;
        }

        .btn-edit { background: #e0f2fe; color: #0284c7; border: none; padding: 5px 12px; border-radius: 6px; font-weight: bold; text-decoration: none; font-size: 12px; }
        .btn-delete { background: #fee2e2; color: #dc2626; border: none; padding: 5px 12px; border-radius: 6px; font-weight: bold; font-size: 12px; }

        /* Table Styling */
        .table-container {
            background: #ffffff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid #e0e0e0;
            overflow-x: auto;
        }

        .table-custom {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-custom th {
            background-color: #fcfbf8;
            color: #6d4c41;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            padding: 15px;
            border-bottom: 2px solid #e8e1d5;
            border-top: 1px solid #e8e1d5;
        }

        .table-custom td {
            padding: 15px;
            color: #432118;
            font-weight: 600;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .table-custom tr:hover td {
            background-color: rgba(93, 122, 84, 0.03);
        }

        /* Role Badges */
        .badge-role {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }
        .badge-peternak { background-color: #ede9fe; color: #5b21b6; }
        .badge-penjualan { background-color: #ffedd5; color: #c2410c; }
        .badge-admin { background-color: #d1fae5; color: #065f46; }

        /* Status Badge */
        .badge-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }
        .badge-aktif { background-color: #dcfce7; color: #166534; }
        .badge-nonaktif { background-color: #fee2e2; color: #991b1b; }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand"><h4>Cimilk Yogurt</h4><p>Admin Dashboard</p></div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('manajemen.akun') }}" class="nav-link active"><i class="fa-solid fa-user-gear"></i> Manajemen Akun</a></li>
            <li class="nav-item"><a href="{{ route('sapi.index') }}" class="nav-link"><i class="fa-solid fa-cow"></i> Biodata Sapi</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-flask"></i> Produksi Susu</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-cart-shopping"></i> Penjualan</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="welcome-text">
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One';">Daftar Akun Pengguna</h3>
                <p style="color: #6d4c41; font-weight: 600; margin-bottom: 0;">Kelola semua akun pengguna sistem.</p>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('manajemen-akun.create') }}" class="btn-add"><i class="fa-solid fa-plus me-2"></i>Tambah Akun</a>

            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-sign-out-alt me-2"></i>Keluar
                </button>
            </form>
        </div>

        <div class="table-container">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>USERNAME</th>
                        <th>NAMA LENGKAP</th>
                        <th>ROLE</th>
                        <th>STATUS</th>
                        <th>TANGGAL DIBUAT</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
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
                            @if($user->status == 'Aktif')
                                <span class="badge-status badge-aktif">Aktif</span>
                            @else
                                <span class="badge-status badge-nonaktif">Nonaktif</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at ? $user->created_at->format('Y-m-d') : '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('manajemen-akun.edit', $user->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('manajemen-akun.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
