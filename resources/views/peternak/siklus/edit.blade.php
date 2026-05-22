<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siklus - Cimilk Yogurt</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Quicksand', sans-serif; background-color: #f5efe6; color: #432118; margin: 0; display: flex; overflow-x: hidden; }
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

        .form-label { font-weight: 700; color: #432118; margin-bottom: 4px; display: block; font-size: 14px; }
        .form-control, .form-select { border-radius: 10px; border: 2px solid #a67c52; padding: 10px; font-size: 14px; background-color: #fffdfa; }
        .btn-save { background: #5d7a54; color: white; font-weight: bold; border: none; padding: 10px 20px; border-radius: 10px; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; }
        .btn-cancel { background: #e2e8f0; color: #475569; font-weight: bold; border: none; padding: 10px 20px; border-radius: 10px; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Siklus Sapi', 'pageSubtitle' => 'Edit data siklus reproduksi'])

    <div class="main-content">
        <div class="page-title-section">
            <h3>Edit Siklus Sapi ⏳</h3>
        </div>

        <div class="form-container">
            <form action="{{ route('siklus.update', $siklus->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Sapi</label>
                    <input type="text" class="form-control" value="{{ $siklus->sapi->kode_sapi }} - {{ $siklus->sapi->nama }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Fase Siklus</label>
                    <select name="fase" id="faseSelectEdit" class="form-select" required>
                        @foreach(['IB', 'Bunting', 'Melahirkan', 'Laktasi', 'Kering Kandang'] as $f)
                        <option value="{{ $f }}" {{ $siklus->fase == $f ? 'selected' : '' }}>{{ $f }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div id="inputSusuFieldsEdit" style="display: none; background: #e8f4e5; padding: 15px; border-radius: 10px; border: 2px dashed #8CA685; margin-bottom: 15px;">
                    <p style="font-weight: 700; color: #4a6344; margin-bottom: 10px; font-size: 14px;"><i class="fa-solid fa-droplet"></i> Input Produksi Susu Awal (Opsional)</p>
                    <div class="row">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <label class="form-label">Susu Pagi (Liter)</label>
                            <input type="number" step="0.01" name="jumlah_pagi" class="form-control" placeholder="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Susu Sore (Liter)</label>
                            <input type="number" step="0.01" name="jumlah_sore" class="form-control" placeholder="0">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ $siklus->tanggal_mulai }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hari Ke</label>
                    <input type="number" name="hari_ke" class="form-control" value="{{ $siklus->hari_ke }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="Berjalan" {{ $siklus->status == 'Berjalan' ? 'selected' : '' }}>Berjalan</option>
                        <option value="Selesai" {{ $siklus->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label">Keterangan (Opsional)</label>
                    <textarea name="keterangan" class="form-control" rows="3">{{ $siklus->keterangan }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                    <a href="{{ route('siklus.show', $siklus->sapi_id) }}" class="btn btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.getElementById('faseSelectEdit').addEventListener('change', function() {
            if(this.value === 'Laktasi') {
                document.getElementById('inputSusuFieldsEdit').style.display = 'block';
            } else {
                document.getElementById('inputSusuFieldsEdit').style.display = 'none';
            }
        });
        document.getElementById('faseSelectEdit').dispatchEvent(new Event('change'));
    </script>
</body>
</html>
