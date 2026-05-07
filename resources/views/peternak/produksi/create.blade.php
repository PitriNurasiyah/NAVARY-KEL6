<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produksi - Cimilk Yogurt</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Quicksand', sans-serif; background-color: #dcc8ae; color: #432118; margin: 0; display: flex; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        .form-container {
            background-color: #f5efe6; padding: 25px; border-radius: 30px; box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            position: relative; border: 6px solid transparent; background-clip: padding-box; max-width: 500px;
        }
        .form-container::before {
            content: ''; position: absolute; top: -10px; left: -10px; right: -10px; bottom: -10px; z-index: -1;
            background-color: #5d7a54; background-image: url('https://www.transparenttextures.com/patterns/grass.png'); border-radius: 35px;
        }

        .form-label { font-weight: 700; color: #5a2c1b; margin-bottom: 4px; display: block; font-size: 14px; }
        .form-control, .form-select { border-radius: 10px; border: 2px solid #a67c52; padding: 10px; font-size: 14px; background-color: #fffdfa; }
        .btn-save { background: #5d7a54; color: white; font-weight: bold; border: none; padding: 10px 20px; border-radius: 10px; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; }
        .btn-cancel { background: #e2e8f0; color: #475569; font-weight: bold; border: none; padding: 10px 20px; border-radius: 10px; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Produksi Susu', 'pageSubtitle' => 'Tambah data produksi harian'])

    <div class="main-content">
        <div class="page-title-section">
            <h3>Tambah Produksi Susu 🥛</h3>
        </div>

        <div class="form-container">
            <form action="{{ route('produksi.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Pilih Sapi</label>
                    <select name="sapi_id" class="form-select" required>
                        <option value="">-- Pilih Sapi --</option>
                        @foreach($sapi as $s)
                        <option value="{{ $s->id }}">{{ $s->kode_sapi }} - {{ $s->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hasil Pagi (Liter)</label>
                    <input type="number" step="0.1" name="jumlah_pagi" class="form-control" placeholder="0.0" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Hasil Sore (Liter)</label>
                    <input type="number" step="0.1" name="jumlah_sore" class="form-control" placeholder="0.0" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-save">Simpan Data</button>
                    <a href="{{ route('produksi.index') }}" class="btn btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
