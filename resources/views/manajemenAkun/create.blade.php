<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #dcc8ae;
            color: #432118;
            margin: 0;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #f0e2d0;
            position: fixed;
            top: 0;
            left: 0;
            padding: 30px 20px;
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

        .form-container {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid #e0e0e0;
            max-width: 600px;
        }

        .form-label { font-weight: 700; color: #5a2c1b; }
        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e0e0e0;
        }
        .form-control:focus, .form-select:focus {
            border-color: #5d7a54;
            box-shadow: none;
        }

        .btn-save {
            background: #5d7a54;
            color: white;
            font-weight: bold;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
        }
        .btn-save:hover { background: #4a6344; color: white; }
        .btn-cancel {
            background: #e2e8f0;
            color: #475569;
            font-weight: bold;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
        }
        .btn-cancel:hover { background: #cbd5e1; color: #475569; }

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
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One';">Tambah Akun Baru</h3>
                <p style="color: #6d4c41; font-weight: 600; margin-bottom: 0;">Buat akun pengguna baru.</p>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-sign-out-alt me-2"></i>Keluar
                </button>
            </form>
        </div>

        <div class="form-container">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('manajemen-akun.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="Masukkan username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Peternak">Peternak</option>
                        <option value="Penjualan">Manajemen Penjualan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-save">Tambah Akun</button>
                    <a href="{{ route('manajemen.akun') }}" class="btn btn-cancel">Batal</a>
                </div>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
