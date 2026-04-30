<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sapi - Cimilk Yogurt</title>
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

        /* Sidebar */
        .sidebar { width: 260px; height: 100vh; background: #f0e2d0; position: fixed; padding: 30px 20px; border-right: 8px solid #5d7a54; box-shadow: 5px 0 15px rgba(0,0,0,0.1); }
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

        .btn-logout:active {
            transform: translateY(3px);
            box-shadow: 0 1px 0 #3a150c;
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
            <li class="nav-item"><a href="{{ route('manajemen.akun') }}" class="nav-link"><i class="fa-solid fa-user-gear"></i> Manajemen Akun</a></li>
            <li class="nav-item"><a href="{{ route('sapi.index') }}" class="nav-link active"><i class="fa-solid fa-cow"></i> Biodata Sapi</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-flask"></i> Produksi Susu</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-cart-shopping"></i> Penjualan</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="welcome-text">
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One', cursive;">Edit Data Sapi</h3>
                <p style="color: #6d4c41; font-weight: 600; margin-bottom: 0;">Perbarui informasi sapi.</p>
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

            <form action="{{ route('sapi.update', $sapi->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">ID Sapi (Kode)</label>
                    <input type="text" name="kode_sapi" class="form-control" value="{{ old('kode_sapi', $sapi->kode_sapi) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Sapi</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $sapi->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis</label>
                    <input type="text" name="jenis" class="form-control" value="{{ old('jenis', $sapi->jenis) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Kesehatan</label>
                    <select name="status_kesehatan" class="form-select" required>
                        <option value="Sehat" {{ old('status_kesehatan', $sapi->status_kesehatan) == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                        <option value="Sakit" {{ old('status_kesehatan', $sapi->status_kesehatan) == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="Sedang" {{ old('status_kesehatan', $sapi->status_kesehatan) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                    <a href="{{ route('sapi.index') }}" class="btn btn-cancel">Batal</a>
                </div>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
