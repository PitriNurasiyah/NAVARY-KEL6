<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cimilk </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&family=Fredoka:wght@600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #e8dccb;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            overflow: hidden;
        }

        /* Container Utama */
        .farm-wrapper {
            position: relative;
            z-index: 10;
        }

        .login-box {
            width: 440px;
            background-color: #f5efe6;
            padding: 40px;
            border-radius: 40px;
            box-shadow: 0 20px 45px rgba(0,0,0,0.2);
            position: relative;
            border: 10px solid transparent;
            background-clip: padding-box;
        }

        /* Bingkai Rumput */
        .login-box::before {
            content: '';
            position: absolute;
            top: -15px; left: -15px; right: -15px; bottom: -15px;
            z-index: -1;
            background-color: #8CA685;
            background-image: url('https://www.transparenttextures.com/patterns/grass.png');
            border-radius: 50px;
            box-shadow: inset 0 0 15px rgba(0,0,0,0.1);
        }

        /* Icon Sapi di Atas */
        .top-icon {
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            background: #e8dccb;
            padding: 10px;
            border-radius: 50%;
            z-index: 20;
        }

        .top-icon img {
            background: white;
            border: 2px solid #D2B48C;
            border-radius: 50%;
            padding: 15px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }

        .title {
            text-align: center;
            font-size: 28px;
            font-family: 'Fredoka', sans-serif;
            color: #5a2c1b;
            margin-top: 30px;
            margin-bottom: 30px;
            line-height: 1.1;
        }

        .form-label {
            font-weight: bold;
            color: #5a2c1b;
            margin-left: 5px;
            font-size: 18px;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #a67c52;
            padding: 14px;
            background-color: #fffdfa;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #8CA685;
            box-shadow: 0 0 0 0.25rem rgba(140, 166, 133, 0.1);
        }

        /* Tombol Login */
        .btn-login {
            width: 100%;
            background: #7a2f1c;
            color: white;
            border-radius: 12px;
            padding: 14px;
            font-weight: bold;
            font-size: 19px;
            border: none;
            box-shadow: 0 6px 0 #5a1f12;
            transition: all 0.1s ease;
            position: relative;
            z-index: 5;
        }

        .btn-login:hover { background: #6b2818; color: white; }
        .btn-login:active {
            transform: translateY(4px);
            box-shadow: 0 2px 0 #5a1f12;
        }

        /* Ikon Lumbung (Farm) */
        .farm-icon-style {
            position: absolute;
            bottom: 45px;
            right: -25px;
            width: 90px;
            height: auto;
            z-index: 10;
            pointer-events: none;
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right:40px;
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
        }

        .password-toggle:focus {
            outline: none;
        }

        .password-field input {
            padding-right: 3rem;
        }

        .login-action-container {
            width: 100%;
            position: relative;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="farm-wrapper">
    <div class="top-icon">
        <img src="{{ asset('img/sapii.png') }}" width="70" alt="cow logo">
    </div>

    <div class="login-box">
        <div class="title">Cimilk</div>

        @if(session('success'))
            <div class="alert alert-success py-2 mb-3" style="font-size: 14px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger py-2 mb-3" style="font-size: 14px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
            </div>

           <div class="mb-4 password-field">
            <label class="form-label">Password</label>
            <div class="position-relative">
                <input id="passwordInput" type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                <button type="button" class="password-toggle" onclick="togglePassword()">
                    <i id="passwordIcon" class="fa-solid fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="login-action-container">
            <img src="{{ asset('img/farm.png') }}" class="farm-icon-style" alt="farm icon">
            <button type="submit" class="btn btn-login">Login</button>
        </div>
        </form>
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
</script>

</body>
</html>
