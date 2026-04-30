<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Jenis Pakan - Cimilk Yogurt</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; background-color: #dcc8ae; color: #432118; margin: 0; display: flex; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .btn-logout { border: none; background: #5a1f12; padding: 8px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a150c; transition: 0.2s; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    <div class="main-content">
        <div class="header">
            <div class="welcome-text">
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One';">Pencatatan Jenis Pakan</h3>
                <p style="color: #6d4c41; font-weight: 600; margin-bottom: 0;">Halaman pencatatan pakan sapi.</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn-logout"><i class="fa-solid fa-sign-out-alt me-2"></i>Keluar</button>
            </form>
        </div>
    </div>
</body>
</html>
