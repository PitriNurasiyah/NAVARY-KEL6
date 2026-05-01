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
            background-color: transparent;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Start from top to avoid clipping */
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            padding-top: 60px; /* Space for the top icon */
            height: 100vh;
            overflow: hidden;
        }

        .farm-wrapper { position: relative; width: 380px; }

        .login-box {
            width: 100%;
            background-color: #f5efe6;
            padding: 10px 25px 25px 25px; /* Compact top padding */
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
            margin-top: 25px;
            margin-bottom: 20px;
            line-height: 1.1;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 38px;
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

          /* Modal Styling for Floating Effect */
        .modal-content {
            background-color: transparent;
            border: none;
            box-shadow: none;
        }
        .register-iframe {
            width: 100%;
            height: 700px;
            border: none;
        }
    </style>
</head>
<body>

<div class="farm-wrapper">
    <div class="top-icon">
        <img src="{{ asset('img/sapii.png') }}" width="80" alt="logo">
    </div>

    <div class="login-box">
        <button type="button" class="btn-close-custom" onclick="closeModal()">
            <i class="fa-solid fa-circle-xmark"></i>
        </button>
        <div class="title">Cimilk<br>Buat Akun</div>

        @if(session('success'))
            <script>
                if (window.parent && window.parent.location.pathname === '/manajemen-akun') {
                    window.parent.location.reload();
                }
            </script>
        @endif

        @if($errors->any())
            <div class="alert alert-danger py-2" style="font-size: 13px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" target="_top">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-control" required>
                    <option value="" disabled selected>Pilih Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Peternak">Peternak</option>
                    <option value="Penjualan">Manajemen Penjualan</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="position-relative">
                    <input id="passwordInput" type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i id="passwordIcon" class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="position-relative mt-4">
                <img src="{{ asset('img/farm.png') }}" class="barn-icon" alt="barn">
                <button type="submit" class="btn btn-register">Register</button>
            </div>
        </form>

        <div class="footer-link"> 
            Sudah punya akun? <a href="{{ route('login') }}" target="_top">Masuk di sini</a>
        </div>
    </div>
</div>

<script>
    function closeModal() {
        if (window.parent && window.parent.bootstrap) {
            const modalElement = window.parent.document.getElementById('addAccountModal');
            const modal = window.parent.bootstrap.Modal.getInstance(modalElement);
            if (modal) modal.hide();
        }
    }

    function togglePassword() {
        const passwordInput = document.getElementById('passwordInput');
        const passwordIcon = document.getElementById('passwordIcon');
        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';
        passwordIcon.className = isPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
    }
</script>

</body>
</html>
