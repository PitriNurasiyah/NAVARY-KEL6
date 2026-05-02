<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Cimilk Dairy Farm</title>

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
            overflow-y: auto;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none;  /* IE and Edge */
        }
        body::-webkit-scrollbar {
            display: none; /* Chrome, Safari and Opera */
        }

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

        .farm-wrapper { position: relative; width: 380px; }

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
            text-decoration: none;
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-family: 'Fredoka', sans-serif;
            font-weight: bold;
            color: #5a2c1b;
            margin-top: 25px;
            margin-bottom: 25px;
            line-height: 1.1;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 45px;
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
            width: 32px;
            height: 32px;
            z-index: 10;
        }

        .password-toggle:focus { outline: none; }

        .form-label { font-weight: bold; color: #5a2c1b; font-size: 16px; }

        .form-control {
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
            font-size: 19px;
            border: none;
            box-shadow: 0 6px 0 #5a1f12;
            transition: all 0.1s ease;
        }

        .btn-register:active {
            transform: translateY(4px);
            box-shadow: 0 2px 0 #5a1f12;
        }

        .barn-icon {
            position: absolute;
            bottom: 40px;
            right: -10px;
            width: 75px;
            z-index: 10;
            pointer-events: none;
        }

        .footer-link { text-align: center; margin-top: 15px; font-size: 14px; }
        .footer-link a { color: #7a2f1c; font-weight: bold; text-decoration: none; }

        /* Error alert */
        .alert-form {
            padding: 8px 12px;
            font-size: 13px;
            border-radius: 12px;
            margin-bottom: 10px;
            border: 2px solid #f5c2c7;
        }
    </style>
</head>
<body>

    @if(request('mode') != 'modal')
        @include('layouts.sidebar')
        @include('layouts.header', ['pageTitle' => 'Tambah Akun', 'pageSubtitle' => 'Buat akun pengguna baru'])
    @endif

    <div class="register-wrapper">
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

                <div class="title">Tambah Akun</div>

                @if($errors->any())
                    <div class="alert alert-danger alert-form">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('manajemen-akun.store') }}" method="POST" id="registerForm">
                    @csrf
                    <input type="hidden" name="mode" value="{{ request('mode') }}">
                    <div class="mb-2">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="{{ old('username') }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-control" required>
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Role</option>
                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Peternak" {{ old('role') == 'Peternak' ? 'selected' : '' }}>Peternak</option>
                            <option value="Penjualan" {{ old('role') == 'Penjualan' ? 'selected' : '' }}>Manajemen Penjualan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="position-relative">
                            <input id="passwordInput" type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i id="passwordIcon" class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="position-relative mt-2">
                        <img src="{{ asset('img/farm.png') }}" class="barn-icon" alt="barn">
                        <button type="submit" class="btn btn-register" id="registerBtn">Register</button>
                    </div>
                </form>

                @if(!Auth::check())
                <div class="footer-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
                @endif
            </div>
        </div>
    </div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('passwordInput');
        const passwordIcon = document.getElementById('passwordIcon');
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        passwordIcon.className = isPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
    }

    // ====== Tutup modal saat klik tombol X ======
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

    // ====== Jika sukses register: langsung close modal & redirect (tanpa delay) ======
    @if(session('success'))
    window.addEventListener('DOMContentLoaded', (event) => {
        try {
            // Tutup modal langsung dan redirect ke halaman manajemen akun dengan notifikasi
            window.top.location.href = "{{ route('manajemen.akun') }}?success=" + encodeURIComponent("{{ session('success') }}");
        } catch(e) {
            window.location.href = "{{ route('manajemen.akun') }}";
        }
    });
    @endif
</script>

</body>
</html>
