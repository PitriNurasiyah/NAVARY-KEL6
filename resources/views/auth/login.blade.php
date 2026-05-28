<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cimilk </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;600;700&family=Quicksand:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url('{{ asset("img/bg_login.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(20, 32, 18, 0.55); /* Dark green-tinted overlay */
            z-index: 1;
        }

        /* Container Utama */
        .farm-wrapper {
            position: relative;
            z-index: 10;
            width: 460px;
            max-width: 95%;
        }

        .login-box {
            width: 100%;
            background-color: #f5efe6;
            padding: 40px;
            border-radius: 40px;
            box-shadow: 0 20px 45px rgba(0,0,0,0.3);
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

        /* Icon Sapi di Atas */
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
            border: 2px solid #bc9f82;
            border-radius: 50%;
            padding: 8px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            width: 80px;
        }

        .title {
            text-align: center;
            font-size: 28px;
            font-family: 'Playfair Display', serif;
            font-weight: bold;
            color: #432118;
            margin-top: 30px;
            margin-bottom: 25px;
            line-height: 1.1;
        }

        .form-label {
            font-weight: bold;
            color: #432118;
            margin-left: 2px;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #bc9f82;
            padding: 12px 14px;
            background-color: #fffdfa;
            color: #432118;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: #a68c7e;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #233722;
            color: #432118;
            box-shadow: 0 0 0 0.25rem rgba(35, 55, 34, 0.15);
            outline: none;
        }

        /* Tombol Login */
        .btn-login {
            width: 100%;
            background: #233722;
            color: white;
            border-radius: 12px;
            padding: 14px;
            font-weight: bold;
            font-size: 18px;
            border: none;
            box-shadow: 0 6px 0 #152414;
            transition: all 0.1s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background: #1b2a1a;
            color: white;
        }
        
        .btn-login:active {
            transform: translateY(4px);
            box-shadow: 0 2px 0 #152414;
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 38px;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #8c7054;
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

        .password-toggle:focus {
            outline: none;
        }

        .password-field input {
            padding-right: 3rem;
        }

        .login-action-container {
            width: 100%;
            position: relative;
            margin-top: 25px;
        }

        .barn-icon {
            position: absolute;
            bottom: 40px;
            right: -10px;
            width: 75px;
            z-index: 10;
            pointer-events: none;
        }

        .alert-form {
            padding: 8px 12px;
            font-size: 13px;
            border-radius: 12px;
            margin-bottom: 15px;
            border: 2px solid #f5c2c7;
        }
    </style>
</head>
<body>

<div class="farm-wrapper">
    <div class="top-icon">
        <img src="{{ asset('img/sapii.png') }}" alt="cow logo">
    </div>

    <div class="login-box">
        <div class="title">Cimilk</div>

        @if(session('success'))
            <div class="alert alert-success alert-form py-2 mb-3">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-form py-2 mb-3">
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
                <img src="{{ asset('img/farm.png') }}" class="barn-icon" alt="barn">
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
