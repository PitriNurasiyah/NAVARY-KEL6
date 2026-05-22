<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pakan - Cimilk Yogurt</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&family=Fredoka:wght@600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: {{ request('mode') == 'modal' ? 'transparent' : (Auth::check() ? '#dcc8ae' : '#e8dccb') }};
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            display: flex;
            min-height: 100vh;
            overflow-y: {{ request('mode') == 'modal' ? 'hidden' : 'auto' }};
            
            
        }
        body::-webkit-scrollbar { display: none; }

        .register-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: {{ request('mode') == 'modal' ? 'flex-start' : 'center' }};
            padding-top: {{ request('mode') == 'modal' ? '60px' : '40px' }};
            padding-bottom: {{ request('mode') == 'modal' ? '50px' : '40px' }};
            @if(Auth::check() && request()->query('mode') != 'modal')
                margin-left: 260px;
            @endif
        }

        .farm-wrapper { position: relative; width: 500px; max-width: 95%; }

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
            background: #dcc8ae;
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
            font-size: 24px;
            font-family: 'Fredoka', sans-serif;
            font-weight: bold;
            color: #5a2c1b;
            margin-top: 15px;
            margin-bottom: 25px;
            line-height: 1.1;
        }

        .form-label { font-weight: bold; color: #5a2c1b; font-size: 14px; margin-bottom: 4px; }
        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #a67c52;
            padding: 10px 14px;
            background-color: #fffdfa;
            font-size: 14px;
        }

        .btn-register {
            width: 100%;
            background: #7a2f1c;
            color: white;
            border-radius: 12px;
            padding: 12px;
            font-weight: bold;
            font-size: 18px;
            border: none;
            box-shadow: 0 6px 0 #5a1f12;
            transition: all 0.1s ease;
        }
        .btn-register:active { transform: translateY(4px); box-shadow: 0 2px 0 #5a1f12; }

        .barn-icon {
            position: absolute;
            bottom: 40px;
            right: -10px;
            width: 75px;
            z-index: 10;
            pointer-events: none;
        }

        .alert-form { padding: 8px 12px; font-size: 13px; border-radius: 12px; margin-bottom: 15px; border: 2px solid #f5c2c7; }
        
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }
    </style>
</head>
<body>

    @if(request('mode') != 'modal')
        @include('layouts.sidebar')
        @include('layouts.header', ['pageTitle' => 'Tambah Pakan', 'pageSubtitle' => 'Input data baru'])
        
        <div class="main-content">
            <div class="page-title-section">
                <h3>Tambah Pakan 🐄</h3>
            </div>
    @endif

    <div class="register-wrapper" style="{{ request('mode') != 'modal' ? 'padding-top: 20px;' : '' }}">
        <div class="farm-wrapper">
            <div class="top-icon">
                <img src="{{ asset('img/sapii.png') }}" width="80" alt="logo">
            </div>

            <div class="login-box">
                @if(Auth::check())
                <button type="button" class="btn-close-custom" id="closeModalBtn">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>
                @endif

                <div class="title">Tambah Pakan</div>

                @if($errors->any())
                    <div class="alert alert-danger alert-form">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('pakan.store') }}" method="POST" target="_parent">
                @csrf
                    <input type="hidden" name="mode" value="{{ request('mode') }}">
                <div class="mb-2">
                    <label class="form-label">Nama Pakan</label>
                    <input type="text" name="nama_pakan" class="form-control" placeholder="Contoh: Rumput Gajah" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" placeholder="0" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Satuan</label>
                    <select name="satuan" class="form-select" required>
                        <option value="KG">KG</option>
                        <option value="TON">TON</option>
                        <option value="IKAT">IKAT</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Tanggal Pemberian</label>
                    <input type="date" name="tanggal_pemberian" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="mb-4">
                    <label class="form-label">Keterangan (Opsional)</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan catatan..."></textarea>
                </div>
                    <div class="position-relative mt-4">
                        <img src="{{ asset('img/farm.png') }}" class="barn-icon" alt="barn">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-secondary w-100 fw-bold" style="border-radius: 12px; padding: 12px; background-color: #8c7b6f; border: none; box-shadow: 0 6px 0 #5e5149;" id="cancelBtn" onclick="if(window.parent && window.parent.document.getElementById('registerModal')){ window.parent.bootstrap.Modal.getInstance(window.parent.document.getElementById('registerModal')).hide(); } else { window.history.back(); }">Batal</button>
                            <button type="submit" class="btn btn-register w-100">Simpan Data</button>
                        </div>
                    </div>
            </form>

            </div>
        </div>
    </div>
    @if(request('mode') != 'modal')
        </div>
    @endif

<script>
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

    @if(session('success'))
    window.addEventListener('DOMContentLoaded', (event) => {
        try {
            window.top.location.href = "{{ route('pakan.index') }}?success=" + encodeURIComponent("{{ session('success') }}");
        } catch(e) {
            window.location.href = "{{ route('pakan.index') }}";
        }
    });
    @endif
</script>

</body>
</html>