<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penjualan - Cimilk Yogurt</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;600;700&family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: {{ request('mode') == 'modal' ? 'transparent' : (Auth::check() ? '#f4efe6' : '#f4efe6') }};
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            display: flex;
            min-height: 100vh;
            overflow-y: {{ request('mode') == 'modal' ? 'hidden' : 'auto' }};
            scrollbar-width: none;
            -ms-overflow-style: none;
            color: #432118;
        }
        body::-webkit-scrollbar { display: none; }

        .register-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: {{ request('mode') == 'modal' ? 'flex-start' : 'center' }};
            padding-top: {{ request('mode') == 'modal' ? '100px' : '40px' }};
            padding-bottom: {{ request('mode') == 'modal' ? '60px' : '40px' }};
            @if(Auth::check() && request()->query('mode') != 'modal')
                margin-left: 260px;
            @endif
        }

        .farm-wrapper { position: relative; width: 480px; max-width: 95%; }

        .login-box {
            width: 100%;
            background-color: #f5efe6;
            padding: 25px 25px 30px;
            border-radius: 40px;
            box-shadow: 0 20px 45px rgba(0,0,0,0.2);
            position: relative;
            border: 10px solid transparent;
            background-clip: padding-box;
        }

        .login-box::before {
            content: '';
            position: absolute;
            top: -15px; left: -15px; right: -15px; bottom: -15px;
            z-index: -1;
            background-color: #8CA685;
            background-image: url('https://www.transparenttextures.com/patterns/grass.png');
            border-radius: 50px;
        }

        .top-icon {
            position: absolute;
            top: -55px;
            left: 50%;
            transform: translateX(-50%);
            background: #f5efe6;
            padding: 6px;
            border-radius: 50%;
            z-index: 20;
        }

        .top-icon img {
            background: white;
            border: 2px solid #D2B48C;
            border-radius: 50%;
            padding: 8px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            width: 65px;
        }

        .btn-close-custom {
            position: absolute;
            top: 15px;
            right: 15px;
            background: transparent;
            border: none;
            font-size: 20px;
            color: #8CA685;
            cursor: pointer;
            z-index: 30;
            padding: 0;
            line-height: 1;
        }

        .title {
            text-align: center;
            font-size: 26px;
            font-family: 'Playfair Display', serif;
            font-weight: bold;
            color: #432118;
            margin-top: 15px;
            margin-bottom: 25px;
            line-height: 1.1;
        }

        .form-label { font-weight: bold; color: #432118; font-size: 14px; margin-bottom: 4px; }
        
        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #a67c52;
            padding: 10px 14px;
            background-color: #fffdfa;
            font-size: 14px;
            color: #432118;
            font-weight: 600;
        }
        .form-control:focus, .form-select:focus {
            border-color: #5d7a54;
            box-shadow: 0 0 0 0.25rem rgba(93, 122, 84, 0.1);
            background-color: #ffffff;
        }
        .form-control[readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
            border-color: #ced4da;
        }

        .btn-register {
            width: 100%;
            background: #233722;
            color: white;
            border-radius: 12px;
            padding: 12px;
            font-weight: bold;
            font-size: 18px;
            border: none;
            box-shadow: 0 6px 0 #152414;
            transition: all 0.1s ease;
        }
        .btn-register:active { transform: translateY(4px); box-shadow: 0 2px 0 #152414; }

        .btn-cancel {
            width: 100%;
            background: #8c7b6f;
            color: white;
            border-radius: 12px;
            padding: 12px;
            font-weight: bold;
            font-size: 18px;
            border: none;
            box-shadow: 0 6px 0 #5e5149;
            transition: all 0.1s ease;
            text-align: center;
            text-decoration: none;
        }
        .btn-cancel:active { transform: translateY(4px); box-shadow: 0 2px 0 #5e5149; }

        .barn-icon {
            position: absolute;
            bottom: 40px;
            right: -10px;
            width: 75px;
            z-index: 10;
            pointer-events: none;
        }

        /* Custom Inline Alert (Toast style) */
        .alert-inline {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 25px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            animation: slideInRight 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: #fee2e2;
            border: 2px solid #ef4444;
            color: #991b1b;
            margin-bottom: 20px;
        }

        .alert-inline .btn-close-alert {
            background: none;
            border: none;
            color: #991b1b;
            font-size: 18px;
            cursor: pointer;
            margin-left: auto;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .alert-inline .btn-close-alert:hover {
            opacity: 1;
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        .input-group-text {
            background-color: #bc9f82;
            color: white;
            border: 2px solid #a67c52;
            border-right: none;
            font-weight: 700;
            border-radius: 12px 0 0 12px;
            display: flex;
            align-items: center;
        }
        .has-prefix .form-control { border-radius: 0 12px 12px 0; }
    </style>
</head>
<body>

    @if(request('mode') != 'modal')
        @include('layouts.sidebar')
        @include('layouts.header', ['pageTitle' => 'Edit Penjualan', 'pageSubtitle' => 'Perbarui data penjualan susu'])
        
        <div class="main-content">
            <div class="page-title-section">
                <h3>Edit Transaksi Penjualan 📝</h3>
                <p>Silahkan perbarui detail transaksi di bawah ini.</p>
            </div>
    @endif

    <div class="register-wrapper" style="{{ request('mode') != 'modal' ? 'padding-top: 20px;' : '' }}">
        <div class="farm-wrapper">
            <div class="top-icon">
                <img src="{{ asset('img/sapii.png') }}" width="80" alt="logo">
            </div>

            <div class="login-box">
                @if(Auth::check() && request('mode') == 'modal')
                <button type="button" class="btn-close-custom" id="closeModalBtn">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>
                @endif

                <div class="title">Edit Transaksi</div>

                @if($errors->any())
                    <div class="alert-inline" id="errorAlert">
                        <i class="fa-solid fa-circle-xmark" style="font-size: 16px;"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('penjualan.update', $item->id) }}" method="POST" id="penjualanForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="mode" value="{{ request('mode') }}">
                    
                    <div class="mb-2">
                        <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $item->tanggal) }}" readonly required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Pembeli <span class="text-danger">*</span></label>
                        <input type="text" name="pembeli" class="form-control" placeholder="Masukkan nama pembeli" value="{{ old('pembeli', $item->pembeli) }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Jenis Produk <span class="text-danger">*</span></label>
                        <select name="jenis_produk" class="form-select" required>
                            <option value="" disabled>Pilih jenis produk</option>
                            <option value="susu mentah" {{ old('jenis_produk', $item->jenis_produk) == 'susu mentah' ? 'selected' : '' }}>Susu Mentah</option>
                            <option value="susu murni" {{ old('jenis_produk', $item->jenis_produk) == 'susu murni' ? 'selected' : '' }}>Susu Murni</option>
                            <option value="yogurt" {{ old('jenis_produk', $item->jenis_produk) == 'yogurt' ? 'selected' : '' }}>Yogurt</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Jumlah (Liter) <span class="text-danger">*</span></label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="0" min="0" value="{{ old('jumlah', $item->jumlah) }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Harga Satuan (Rp/Liter) <span class="text-danger">*</span></label>
                        <div class="input-group has-prefix">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" placeholder="15000" min="0" value="{{ old('harga_satuan', $item->harga_satuan) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total Harga (Otomatis)</label>
                        <div class="input-group has-prefix">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="total_harga" id="total_harga" class="form-control" value="{{ old('total_harga', $item->total_harga) }}" readonly>
                        </div>
                    </div>

                    <div class="position-relative mt-4">
                        <img src="{{ asset('img/farm.png') }}" class="barn-icon" alt="barn">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-cancel w-100" id="cancelBtn" onclick="if(window.parent && window.parent.document.getElementById('registerModal')){ window.parent.bootstrap.Modal.getInstance(window.parent.document.getElementById('registerModal')).hide(); } else { window.location.href='{{ route('penjualan.data') }}'; }">Batal</button>
                            <button type="submit" class="btn btn-register w-100">Simpan</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @if(request('mode') != 'modal')
        </div>
    @endif

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

        const closeBtn = document.getElementById('closeModalBtn');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                try {
                    const modal = window.parent.bootstrap.Modal.getInstance(
                        window.parent.document.getElementById('registerModal')
                    );
                    if (modal) modal.hide();
                } catch(e) {
                    window.history.back();
                }
            });
        }

        // Auto-dismiss floating error alert after 5s
        const errorAlert = document.getElementById('errorAlert');
        if (errorAlert) {
            setTimeout(() => {
                errorAlert.style.opacity = '0';
                errorAlert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => errorAlert.remove(), 500);
            }, 5000);
        }

        @if(session('success'))
        window.addEventListener('DOMContentLoaded', (event) => {
            try {
                window.top.location.href = "{{ route('penjualan.data') }}?success=" + encodeURIComponent("{{ session('success') }}");
            } catch(e) {
                window.location.href = "{{ route('penjualan.data') }}";
            }
        });
        @endif
    </script>
</body>
</html>
