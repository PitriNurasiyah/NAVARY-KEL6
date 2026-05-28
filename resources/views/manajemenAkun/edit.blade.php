<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun - Cimilk Yogurt</title>
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
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        body::-webkit-scrollbar { display: none; }

        .register-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: {{ request('mode') == 'modal' ? 'flex-start' : 'center' }};
            padding-top: {{ request('mode') == 'modal' ? '80px' : '40px' }};
            padding-bottom: {{ request('mode') == 'modal' ? '50px' : '40px' }};
            @if(Auth::check() && request()->query('mode') != 'modal')
                margin-left: 260px;
            @endif
        }

        .farm-wrapper { position: relative; width: 400px; max-width: 95%; }

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

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #845a33;
            font-size: 18px;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
    </style>
</head>
<body>

    @if(request('mode') != 'modal')
        @include('layouts.sidebar')
        @include('layouts.header', ['pageTitle' => 'Manajemen Akun', 'pageSubtitle' => 'Perbarui informasi akun pengguna'])
        
        <div class="main-content">
            <div class="page-title-section">
                <h3>Edit Akun Pengguna</h3>
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

                <div class="title">Edit Akun</div>

                @if($errors->any())
                    <div class="alert-inline" id="errorAlert">
                        <i class="fa-solid fa-circle-xmark" style="font-size: 16px;"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('manajemen-akun.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="mode" value="{{ request('mode') }}">
                    
                    <div class="mb-2">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Peternak" {{ $user->role == 'Peternak' ? 'selected' : '' }}>Peternak</option>
                            <option value="Penjualan" {{ $user->role == 'Penjualan' ? 'selected' : '' }}>Manajemen Penjualan</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Aktif" {{ $user->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ $user->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru <small>(Opsional)</small></label>
                        <div class="position-relative">
                            <input id="passwordInput" type="password" name="password" class="form-control" placeholder="Biarkan kosong jika tidak diubah">
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i id="passwordIcon" class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="position-relative mt-4">
                        <img src="{{ asset('img/farm.png') }}" class="barn-icon" alt="barn">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-cancel w-100" id="cancelBtn" onclick="if(window.parent && window.parent.document.getElementById('registerModal')){ window.parent.bootstrap.Modal.getInstance(window.parent.document.getElementById('registerModal')).hide(); } else { window.location.href='{{ route('manajemen.akun') }}'; }">Batal</button>
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
        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const passwordIcon = document.getElementById('passwordIcon');
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            passwordIcon.className = isPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
        }

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
                window.top.location.href = "{{ route('manajemen.akun') }}?success=" + encodeURIComponent("{{ session('success') }}");
            } catch(e) {
                window.location.href = "{{ route('manajemen.akun') }}";
            }
        });
        @endif
    </script>
</body>
</html>
