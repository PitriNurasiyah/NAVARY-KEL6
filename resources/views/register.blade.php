<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Cimilk Dairy Farm</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }

        .farm-wrapper { position: relative; }

        .login-box {
            width: 460px; /* Sedikit lebih lebar untuk form register */
            background-color: #f5efe6;
            padding: 20px 40px;
            border-radius: 40px;
            box-shadow: 0 20px 45px rgba(0,0,0,0.2);
            position: relative;
            border: 10px solid transparent;
            background-clip: padding-box;
        }

        /* Frame Rumput */
        .login-box::before {
            content: '';
            position: absolute;
            top: -15px; left: -15px; right: -15px; bottom: -15px;
            z-index: -1;
            background-color: #8CA685;
            background-image: url('https://www.transparenttextures.com/patterns/grass.png');
            border-radius: 50px;
        }

        /* Logo Memotong Border */
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
            font-size: 26px;
            font-family: 'Fredoka', sans-serif;
            font-weight: bold;
            color: #5a2c1b;
            margin-top: 30px;
            margin-bottom: 25px;
            line-height: 1.1;
        }

        .form-label { font-weight: bold; color: #5a2c1b; font-size: 16px; }

        .form-control {
            border-radius: 12px;
            border: 2px solid #a67c52;
            padding: 10px 14px;
            background-color: #fffdfa;
        }

        /* Tombol Login Marun 3D */
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

        /* Posisi Barn di Atas Tombol Banget */
        .barn-icon {
            position: absolute;
            bottom: 40px; /* Menempel di atas tombol */
            right: -10px;
            width: 75px;
            z-index: 10;
            pointer-events: none;
        }

        .animal-left { position: absolute; bottom: -35px; left: -45px; width: 90px; z-index: 10; }

        .footer-link { text-align: center; margin-top: 15px; font-size: 14px; }
        .footer-link a { color: #7a2f1c; font-weight: bold; text-decoration: none; }
    </style>
</head>
<body>

<div class="farm-wrapper">

    <div class="top-icon">
        <img src="{{ asset('img/sapii.png') }}" width="80" alt="logo">
    </div>

    <div class="login-box">
        <div class="title">Cimilk<br>Buat Akun</div>

        <form method="POST" action="/register">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>

            <div class="mb-4 position-relative">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <div class="position-relative mt-4">
                <img src="{{ asset('img/farm.png') }}" class="barn-icon" alt="barn">
                <button type="submit" class="btn btn-register">Register</button>
            </div>
        </form>

        <div class="footer-link">
            Sudah punya akun? <a href="/login">Masuk di sini</a>
        </div>
    </div>

</div>

</body>
</html>
