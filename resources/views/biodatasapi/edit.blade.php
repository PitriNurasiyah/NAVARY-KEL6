<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sapi - Cimilk Yogurt</title>
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
            display: flex;
            overflow-x: hidden;
        }

        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 45px;
        }

        .page-title-section { margin-bottom: 30px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; }

        .form-container {
            background-color: #f5efe6;
            padding: 25px;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            position: relative;
            border: 6px solid transparent;
            background-clip: padding-box;
            max-width: 500px;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: -10px; left: -10px; right: -10px; bottom: -10px;
            z-index: -1;
            background-color: #5d7a54;
            background-image: url('https://www.transparenttextures.com/patterns/grass.png');
            border-radius: 35px;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.1);
        }

        .form-label { font-weight: 700; color: #5a2c1b; margin-bottom: 4px; display: block; font-size: 14px; }
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #a67c52;
            padding: 10px;
            font-size: 14px;
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
            padding: 10px 20px;
            border-radius: 10px;
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
    @include('layouts.header', ['pageTitle' => 'Edit Sapi', 'pageSubtitle' => 'Perbarui informasi data sapi'])

    <!-- Main Content -->
    <div class="main-content">

        <div class="page-title-section">
            <h3>Edit Data Sapi 🐄</h3>
            <p>Perbarui informasi sapi.</p>
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
