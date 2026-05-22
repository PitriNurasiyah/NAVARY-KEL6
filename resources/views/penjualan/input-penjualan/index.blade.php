<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Penjualan - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f5efe6; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }

        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }

        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        .form-container {
            background-color: #f5efe6;
            padding: 35px;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            position: relative;
            border: 8px solid transparent;
            background-clip: padding-box;
            max-width: 650px;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: -12px; left: -12px; right: -12px; bottom: -12px;
            z-index: -1;
            background-color: #5d7a54;
            background-image: url('https://www.transparenttextures.com/patterns/grass.png');
            border-radius: 38px;
        }

        .form-title {
            font-family: 'Fredoka One', cursive;
            font-size: 20px;
            color: #432118;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px dashed #bc9f82;
        }

        .form-label { font-weight: 700; color: #432118; margin-bottom: 6px; font-size: 14px; }
        .form-control {
            border-radius: 12px;
            border: 2px solid #a67c52;
            padding: 12px;
            font-size: 14px;
            background-color: #fffdfa;
            color: #432118;
            font-weight: 600;
        }
        .form-control:focus {
            border-color: #5d7a54;
            box-shadow: 0 0 0 0.25rem rgba(93, 122, 84, 0.1);
            background-color: #ffffff;
        }
        .form-control[readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
            border-color: #ced4da;
        }

        .btn-submit {
            background: #5d7a54;
            color: white;
            font-weight: 800;
            border: none;
            padding: 14px 30px;
            border-radius: 15px;
            box-shadow: 0 5px 0 #3a4d33;
            transition: all 0.2s;
            width: 100%;
            font-size: 16px;
            margin-top: 10px;
        }
        .btn-submit:hover { background: #4a6344; transform: translateY(-2px); box-shadow: 0 7px 0 #3a4d33; color: white; }
        .btn-submit:active { transform: translateY(2px); box-shadow: 0 2px 0 #3a4d33; }

        .input-group-text {
            background-color: #bc9f82;
            color: white;
            border: 2px solid #a67c52;
            border-right: none;
            font-weight: 700;
            border-radius: 12px 0 0 12px;
        }
        .has-prefix .form-control { border-radius: 0 12px 12px 0; }
    </style>
</head>
<body>

    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Input Penjualan', 'pageSubtitle' => 'Input data penjualan susu'])

    <div class="main-content">
        <div class="page-title-section">
            <h3>Transaksi Penjualan Baru 💰</h3>
            <p>Silahkan lengkapi detail transaksi di bawah ini.</p>
        </div>

        <div class="form-container">
            <div class="form-title">
                <i class="fa-solid fa-receipt me-2"></i> Form Penjualan
            </div>

            @if($errors->any())
                <div class="alert alert-danger rounded-4 mb-4">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('penjualan.store') }}" method="POST" id="penjualanForm">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Pembeli</label>
                        <input type="text" name="pembeli" class="form-control" placeholder="Masukkan nama pembeli" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah (Liter)</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="0" min="0" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga Satuan (Rp/Liter)</label>
                        <div class="input-group has-prefix">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" placeholder="15000" min="0" required>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label class="form-label">Total Harga (Otomatis)</label>
                        <div class="input-group has-prefix">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="total_harga" id="total_harga" class="form-control" value="0" readonly>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-submit">
                        <i class="fa-solid fa-save me-2"></i> Simpan Transaksi
                    </button>
                    <a href="{{ route('penjualan.data') }}" class="btn btn-cancel" style="background: #e2e8f0; color: #475569; font-weight: bold; border: none; padding: 14px 30px; border-radius: 15px; text-decoration: none; transition: all 0.2s; width: 100%; font-size: 16px; margin-top: 10px; display: block; text-align: center;">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const jumlahInput = document.getElementById('jumlah');
        const hargaInput = document.getElementById('harga_satuan');
        const totalInput = document.getElementById('total_harga');

        function calculateTotal() {
            const jumlah = parseFloat(jumlahInput.value) || 0;
            const harga = parseFloat(hargaInput.value) || 0;
            totalInput.value = Math.round(jumlah * harga);
        }

        jumlahInput.addEventListener('input', calculateTotal);
        hargaInput.addEventListener('input', calculateTotal);
    </script>
</body>
</html>
