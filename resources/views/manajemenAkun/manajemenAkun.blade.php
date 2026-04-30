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

        .btn-add { border: none; background: #5d7a54; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; text-decoration: none; }
        .btn-add:hover { background: #4a6344; color: #fff; }

        /* Tabel Profesional */
        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; background: white; border-radius: 15px; overflow: hidden; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 16px !important; text-transform: uppercase; font-size: 13px; border: 1px solid #bc9f82 !important; }
        .table tbody td { padding: 16px !important; border: 1px solid #bc9f82 !important; font-weight: 600; }

        /* Garis Vertikal Tabel */
        .table-bordered-custom th, .table-bordered-custom td { border-left: 1px solid #bc9f82 !important; }
        .table-bordered-custom th:first-child, .table-bordered-custom td:first-child { border-left: none !important; }

        .table tbody tr:hover { background-color: rgba(93, 122, 84, 0.05) !important; }

        .custom-table {
            width: 100%;
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
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

        .badge-role { padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .badge-admin { background-color: #d1fae5; color: #065f46; }
        .badge-peternak { background-color: #ede9fe; color: #5b21b6; }
        .badge-penjualan { background-color: #ffedd5; color: #c2410c; }

    </style>
</head>
<body>

    @include('layouts.sidebar')

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
                <tbody>
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
                                <form action="{{ route('manajemen-akun.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');" class="m-0">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
