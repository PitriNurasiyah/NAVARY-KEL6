<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #dcc8ae;
            color: #432118;
            margin: 0;
            overflow-x: hidden;
        }

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
            background-color: #f5efe6;
            padding: 40px;
            border-radius: 40px;
            box-shadow: 0 20px 45px rgba(0,0,0,0.1);
            position: relative;
            border: 8px solid transparent;
            background-clip: padding-box;
            max-width: 600px;
        }

        /* Bingkai Rumput */
        .form-container::before {
            content: '';
            position: absolute;
            top: -12px; left: -12px; right: -12px; bottom: -12px;
            z-index: -1;
            background-color: #5d7a54;
            background-image: url('https://www.transparenttextures.com/patterns/grass.png');
            border-radius: 45px;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.1);
        }

        .form-label { font-weight: 700; color: #5a2c1b; margin-bottom: 8px; display: block; }
        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #a67c52;
            padding: 12px;
            background-color: #fffdfa;
        }
        .form-control:focus, .form-select:focus {
            border-color: #5d7a54;
            box-shadow: 0 0 0 0.25rem rgba(93, 122, 84, 0.1);
            background-color: #ffffff;
        }

        .btn-save {
            background: #5d7a54;
            color: white;
            font-weight: bold;
            border: none;
            padding: 12px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 0 #3a4d33;
            transition: all 0.2s;
        }
        .btn-save:hover { background: #4a6344; transform: translateY(-2px); box-shadow: 0 6px 0 #3a4d33; color: white; }
        .btn-save:active { transform: translateY(2px); box-shadow: 0 2px 0 #3a4d33; }

        .btn-cancel {
            background: #e2e8f0;
            color: #475569;
            font-weight: bold;
            border: none;
            padding: 12px 25px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-block;
        }
        .btn-cancel:hover { background: #cbd5e1; color: #475569; transform: translateY(-2px); }

    </style>
</head>
<body>

    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="welcome-text">
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One';">Edit Akun Pengguna</h3>
                <p style="color: #6d4c41; font-weight: 600; margin-bottom: 0;">Perbarui informasi akun.</p>
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

            <form action="{{ route('manajemen-akun.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Peternak" {{ $user->role == 'Peternak' ? 'selected' : '' }}>Peternak</option>
                        <option value="Penjualan" {{ $user->role == 'Penjualan' ? 'selected' : '' }}>Manajemen Penjualan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Aktif" {{ $user->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ $user->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password (Biarkan kosong jika tidak ingin mengubah)</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password baru">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                    <a href="{{ route('manajemen.akun') }}" class="btn btn-cancel">Batal</a>
                </div>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
