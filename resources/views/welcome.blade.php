<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Manajemen Peternakan - Cimilk Yogurt</title>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&family=Fredoka+One&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body, html { width: 100%; height: 100%; font-family: 'Quicksand', sans-serif; overflow: hidden; background-color: #000; }

        /* Header */
        header {
            position: absolute;
            top: 0; left: 0; right: 0;
            padding: 30px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
        }
        .logo { font-family: 'Fredoka One', cursive; font-size: 32px; color: #fff; text-shadow: 2px 2px 10px rgba(0,0,0,0.3); letter-spacing: 2px; }
        .auth-buttons a {
            text-decoration: none; font-weight: 700; color: #fff;
            padding: 10px 24px; border-radius: 30px; margin-left: 15px;
            font-size: 14px; transition: 0.3s;
        }
        .btn-register { border: 2px solid #fff; }
        .btn-register:hover { background: #fff; color: #4a6344; }
        .btn-login { background: #8CA685; box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
        .btn-login:hover { background: #6b8564; transform: translateY(-2px); }

        /* Slider */
        .slider-container { position: relative; width: 100%; height: 100%; }
        .slide {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 0.8s ease-in-out, transform 1s cubic-bezier(0.25, 1, 0.5, 1);
            transform: scale(1.05);
            z-index: 1;
        }
        .slide::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(to right, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0.6) 100%);
        }
        .slide.active { opacity: 1; transform: scale(1); z-index: 10; }

        /* Content */
        .slide-content {
            position: absolute;
            top: 50%; left: 80px;
            transform: translateY(-50%);
            z-index: 20;
            color: #fff;
            max-width: 600px;
        }
        .big-number {
            position: absolute;
            top: -120px; left: -20px;
            font-family: 'Fredoka One', cursive;
            font-size: 250px;
            color: transparent;
            -webkit-text-stroke: 4px rgba(255, 255, 255, 0.15);
            z-index: -1;
            line-height: 1;
        }
        .slide-title {
            font-family: 'Fredoka One', cursive;
            font-size: 70px;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 20px;
            text-shadow: 2px 4px 15px rgba(0,0,0,0.5);
            line-height: 1.1;
        }
        .slide-desc {
            font-size: 18px;
            font-weight: 600;
            line-height: 1.6;
            text-shadow: 1px 2px 8px rgba(0,0,0,0.5);
            opacity: 0.9;
        }

        /* Arrows */
        .arrow-nav {
            position: absolute;
            right: 80px; top: 50%;
            transform: translateY(-50%);
            z-index: 20;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .arrow-nav button {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(5px);
            border: 2px solid rgba(255,255,255,0.5);
            color: white; width: 50px; height: 50px;
            border-radius: 50%; font-size: 20px;
            cursor: pointer; transition: 0.3s;
        }
        .arrow-nav button:hover { background: white; color: #4a6344; transform: scale(1.1); }

        /* Bottom Nav Cards */
        .bottom-nav {
            position: absolute;
            bottom: 40px; left: 80px; right: 80px;
            display: flex; gap: 20px;
            z-index: 20;
            overflow-x: auto;
            padding-bottom: 10px;
        }
        .bottom-nav::-webkit-scrollbar { display: none; }
        
        .nav-card {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 20px;
            padding: 20px;
            min-width: 260px;
            cursor: pointer;
            transition: 0.4s;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            height: 140px;
        }
        .nav-card::before {
            content: ''; position: absolute; inset: 0;
            background-size: cover; background-position: center;
            opacity: 0.4; z-index: -1; transition: 0.4s;
        }
        .nav-card:hover { transform: translateY(-10px); background: rgba(255,255,255,0.3); }
        .nav-card.active { border: 3px solid #8CA685; background: rgba(255,255,255,0.9); }
        .nav-card.active::before { opacity: 0; }
        .nav-card.active .card-title, .nav-card.active .card-num { color: #432118; }
        
        .card-num {
            position: absolute; top: 15px; right: 15px;
            background: #8CA685; color: white;
            font-size: 12px; font-weight: bold;
            padding: 4px 10px; border-radius: 12px;
        }
        .card-title { font-family: 'Fredoka One', cursive; color: #fff; font-size: 20px; z-index: 2; text-shadow: 1px 1px 5px rgba(0,0,0,0.5); }
        .nav-card.active .card-title { text-shadow: none; }

        @media (max-width: 768px) {
            .slide-title { font-size: 45px; }
            .big-number { font-size: 150px; top: -60px; }
            .slide-content { left: 30px; right: 30px; }
            .arrow-nav { right: 20px; }
            .bottom-nav { left: 20px; right: 20px; bottom: 20px; }
            header { padding: 20px; }
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">CIMILK</div>
        <div class="auth-buttons">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard-admin') }}" class="btn-login">Masuk ke Dasbor</a>
                @else
                    <a href="{{ route('register') }}" class="btn-register">Buat Akun</a>
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                @endauth
            @endif
        </div>
    </header>

    <div class="slider-container">
        <!-- Slide 1 -->
        <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1500595046743-cd271d694d30?q=80&w=2074&auto=format&fit=crop');">
            <div class="slide-content">
                <div class="big-number">01</div>
                <h1 class="slide-title">PASTURE</h1>
                <p class="slide-desc">Pencatatan biodata dan silsilah setiap ekor sapi secara detail untuk memastikan kualitas peternakan yang terbaik dan terstruktur.</p>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1596733430284-f74370160a28?q=80&w=2074&auto=format&fit=crop');">
            <div class="slide-content">
                <div class="big-number">02</div>
                <h1 class="slide-title">LIFECYCLE</h1>
                <p class="slide-desc">Otomatisasi alur siklus reproduksi, mulai dari Inseminasi Buatan, masa kebuntingan, hingga penjadwalan laktasi secara cerdas.</p>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1550583724-b2692b85b150?q=80&w=2074&auto=format&fit=crop');">
            <div class="slide-content">
                <div class="big-number">03</div>
                <h1 class="slide-title">HARVEST</h1>
                <p class="slide-desc">Sistem pemantauan hasil produksi susu harian dan analisis grafik laktasi untuk memaksimalkan potensi hasil panen susu segar.</p>
            </div>
        </div>

        <!-- Slide 4 -->
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?q=80&w=2070&auto=format&fit=crop');">
            <div class="slide-content">
                <div class="big-number">04</div>
                <h1 class="slide-title">SYSTEM</h1>
                <p class="slide-desc">Dasbor analitik canggih bagi pengelola untuk memonitor riwayat kesehatan, persediaan pakan, hingga laporan penjualan.</p>
            </div>
        </div>

        <!-- Arrows -->
        <div class="arrow-nav">
            <button onclick="prevSlide()"><i class="fa-solid fa-chevron-up"></i></button>
            <button onclick="nextSlide()"><i class="fa-solid fa-chevron-down"></i></button>
        </div>

        <!-- Bottom Nav -->
        <div class="bottom-nav">
            <div class="nav-card active" onclick="goToSlide(0)" style="--bg: url('https://images.unsplash.com/photo-1500595046743-cd271d694d30?q=80&w=500&auto=format&fit=crop');">
                <span class="card-num">01</span>
                <span class="card-title">Biodata Sapi</span>
            </div>
            <div class="nav-card" onclick="goToSlide(1)" style="--bg: url('https://images.unsplash.com/photo-1596733430284-f74370160a28?q=80&w=500&auto=format&fit=crop');">
                <span class="card-num">02</span>
                <span class="card-title">Siklus Otomatis</span>
            </div>
            <div class="nav-card" onclick="goToSlide(2)" style="--bg: url('https://images.unsplash.com/photo-1550583724-b2692b85b150?q=80&w=500&auto=format&fit=crop');">
                <span class="card-num">03</span>
                <span class="card-title">Produksi Susu</span>
            </div>
            <div class="nav-card" onclick="goToSlide(3)" style="--bg: url('https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?q=80&w=500&auto=format&fit=crop');">
                <span class="card-num">04</span>
                <span class="card-title">Manajemen</span>
            </div>
        </div>
    </div>

    <script>
        // Set dynamic backgrounds for cards
        document.querySelectorAll('.nav-card').forEach(card => {
            card.style.setProperty('background-image', card.style.getPropertyValue('--bg'));
        });

        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const cards = document.querySelectorAll('.nav-card');
        const totalSlides = slides.length;

        function updateSlider() {
            slides.forEach((slide, index) => {
                if(index === currentSlide) {
                    slide.classList.add('active');
                } else {
                    slide.classList.remove('active');
                }
            });

            cards.forEach((card, index) => {
                if(index === currentSlide) {
                    card.classList.add('active');
                    card.style.setProperty('background-image', 'none');
                } else {
                    card.classList.remove('active');
                    card.style.setProperty('background-image', card.style.getPropertyValue('--bg'));
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlider();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        // Auto slide
        setInterval(nextSlide, 7000);
    </script>

</body>
</html>
