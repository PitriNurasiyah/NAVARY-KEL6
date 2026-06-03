<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siklus - Cimilk Yogurt</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;600;700&family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: {{ request('mode') == 'modal' ? 'transparent' : (Auth::check() ? '#f5efe6' : '#f5efe6') }};
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
            padding-top: {{ request('mode') == 'modal' ? '100px' : '40px' }};
            padding-bottom: {{ request('mode') == 'modal' ? '60px' : '40px' }};
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
    </style>
</head>
<body>

    @if(request('mode') != 'modal')
        @include('layouts.sidebar')
        @include('layouts.header', ['pageTitle' => 'Edit Siklus', 'pageSubtitle' => 'Perbarui data siklus reproduksi'])
        
        <div class="main-content">
            <div class="page-title-section">
                <h3>Edit Siklus Sapi ⏳</h3>
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

                <div class="title">Edit Siklus</div>

                @if($errors->any())
                    <div class="alert-inline" id="errorAlert">
                        <i class="fa-solid fa-circle-xmark" style="font-size: 16px;"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('siklus.update', $siklus->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="mode" value="{{ request('mode') }}">
                    
                    <div class="mb-2">
                        <label class="form-label">Sapi</label>
                        <input type="text" class="form-control" value="{{ $siklus->sapi->kode_sapi }} - {{ $siklus->sapi->nama }}" disabled>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Fase Siklus <span class="text-danger">*</span></label>
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
                    <div class="mb-2">
                        <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_mulai" class="form-control" value="{{ $siklus->tanggal_mulai }}" readonly required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Hari Ke</label>
                        <input type="number" name="hari_ke" id="hari_ke_input" class="form-control" value="{{ $siklus->hari_ke }}" readonly>
                    </div>
                    <div class="mb-2">
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
                    
                    <div class="position-relative mt-4">
                        <img src="{{ asset('img/farm.png') }}" class="barn-icon" alt="barn">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-cancel w-100" id="cancelBtn" onclick="if(window.parent && window.parent.document.getElementById('registerModal')){ window.parent.bootstrap.Modal.getInstance(window.parent.document.getElementById('registerModal')).hide(); } else { window.location.href='{{ route('siklus.show', $siklus->sapi_id) }}'; }">Batal</button>
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
                window.top.location.href = "{{ route('siklus.show', $siklus->sapi_id) }}?success=" + encodeURIComponent("{{ session('success') }}");
            } catch(e) {
                window.location.href = "{{ route('siklus.show', $siklus->sapi_id) }}";
            }
        });
        @endif

        const faseSelect = document.getElementById('faseSelectEdit');
        const inputSusuFields = document.getElementById('inputSusuFieldsEdit');
        
        function adjustIframeHeight() {
            if(window.parent && window.parent.document.getElementById('registerIframe')) {
                window.parent.document.getElementById('registerIframe').style.height = (document.body.scrollHeight + 50) + 'px';
            }
        }

        if (faseSelect && inputSusuFields) {
            faseSelect.addEventListener('change', function() {
                if(this.value === 'Laktasi') {
                    inputSusuFields.style.display = 'block';
                } else {
                    inputSusuFields.style.display = 'none';
                }
                adjustIframeHeight();
            });
            
            // Trigger initially
            if(faseSelect.value === 'Laktasi') {
                inputSusuFields.style.display = 'block';
                setTimeout(adjustIframeHeight, 100);
            }
        }

        // Auto-update Hari Ke based on Tanggal Mulai
        const tanggalMulaiInput = document.querySelector('input[name="tanggal_mulai"]');
        const hariKeInput = document.getElementById('hari_ke_input');

        function updateHariKe() {
            if (!tanggalMulaiInput || !hariKeInput) return;
            const startVal = tanggalMulaiInput.value;
            if (startVal) {
                const startDate = new Date(startVal);
                startDate.setHours(0,0,0,0);
                const today = new Date();
                today.setHours(0,0,0,0);
                
                let diffTime = today.getTime() - startDate.getTime();
                let diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;
                if (diffDays < 1) diffDays = 1;
                hariKeInput.value = diffDays;
            }
        }

        if (tanggalMulaiInput) {
            tanggalMulaiInput.addEventListener('change', updateHariKe);
            updateHariKe();
        }
    </script>
</body>
</html>
