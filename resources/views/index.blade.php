<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cimilk Dairy Farm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'farm-green': '#4d624a',
                        'farm-dark': '#2e3b2c',
                        'farm-brown': '#7a5a40',
                        'farm-cream': '#f4efe6',
                        'farm-soft': '#dccfb6',
                        'emerald-gold': '#dccb96',
                    },
                    fontFamily: {
                        'sans-body': ['Plus Jakarta Sans', 'sans-serif'],
                        'serif-title': ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Slider CSS */
        .slider-container {
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }
        .slider-wrapper {
            display: flex;
            width: 300vw;
            height: 100%;
            transition: transform 1.2s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .slide {
            width: 100vw;
            height: 100%;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        /* Individual Parallax Speeds (via JS transitions) */
        .layer-bg {
            transition: transform 1.2s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .layer-title {
            transition: transform 1.3s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .layer-content {
            transition: transform 1.2s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.8s ease-out;
        }
        .layer-card {
            transition: transform 1.2s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.8s ease-out;
        }

        /* Active slide states for initial entry animation */
        .slide:not(.active) .layer-content {
            opacity: 0;
            transform: translateY(40px);
        }
        .slide:not(.active) .layer-card {
            opacity: 0;
            transform: translateY(40px);
        }
        .slide.active .layer-content {
            opacity: 1;
            transform: translateY(0);
        }
        .slide.active .layer-card {
            opacity: 1;
            transform: translateY(0);
        }

        /* Glassmorphism custom classes */
        .glass-panel {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .glass-nav {
            background: rgba(46, 59, 44, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.4s ease;
        }

        .glass-nav.scrolled {
            background: rgba(46, 59, 44, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 1rem;
            padding-bottom: 1rem;
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.3);
        }

        /* Scrollbar styling */
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-none {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Thumbnail Selection */
        .thumb-card {
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .thumb-card.active-thumb {
            border-color: rgba(16, 185, 129, 0.6);
            background: rgba(255, 255, 255, 0.16);
            opacity: 1 !important;
            transform: scale(1.05);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.4);
        }
    </style>
</head>
<body class="bg-farm-cream text-gray-800 font-sans-body overflow-x-hidden">

    <!-- GLOBAL GLASS NAVBAR -->
    <nav id="navbar" class="glass-nav text-white py-5 px-6 fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="#home" class="flex items-center gap-3 group">
                <span class="text-2xl font-black font-serif-title tracking-widest text-white group-hover:text-emerald-300 transition duration-300">CIMILK</span>
                <span class="hidden md:inline-block rounded-full bg-emerald-500/20 border border-emerald-500/30 px-3 py-0.5 text-[10px] font-bold tracking-wider text-white uppercase">Dairy Farm</span>
            </a>

            <!-- Navigation Links -->
            <div class="hidden lg:flex items-center gap-8 text-xs font-bold uppercase tracking-widest text-white/80">
                <a href="#home" class="hover:text-emerald-400 transition-colors">Beranda</a>
                <a href="#products" class="hover:text-emerald-400 transition-colors">Produk Kami</a>
                <a href="#about" class="hover:text-emerald-400 transition-colors">Tentang Peternakan</a>
                <a href="#location" class="hover:text-emerald-400 transition-colors">Lokasi</a>
            </div>

            <!-- Login / Action button -->
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="relative group overflow-hidden bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-2.5 rounded-full font-bold text-xs uppercase tracking-wider text-white shadow-lg shadow-emerald-500/20 hover:shadow-emerald-600/30 transition-all active:scale-95">
                    <span class="relative z-10">LOGIN</span>
                    <span class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></span>
                </a>
            </div>
        </div>
    </nav>

    <!-- FULLSCREEN HERO SLIDER CONTAINER -->
    <section id="home" class="slider-container">
        <div class="slider-wrapper" id="sliderWrapper">

            <!-- SLIDE 1: CATTLE FARMING -->
            <div class="slide active" id="slide-0">
                <!-- Parallax background (cattle) -->
                <div class="absolute inset-0 bg-cover bg-center layer-bg" style="background-image: url('{{ asset('img/bg_cattle.png') }}'); transform: scale(1.15);"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-farm-dark/95 via-farm-dark/50 to-transparent z-10"></div>

                <!-- Huge Parallax Background Title -->
                <div class="absolute top-[28%] select-none pointer-events-none text-center w-full z-20 layer-title">
                    <h2 class="text-[12vw] font-black text-white/5 font-serif-title uppercase tracking-widest leading-none">CATTLE</h2>
                </div>

                <!-- Main Contents -->
                <div class="container mx-auto px-6 lg:px-20 relative z-30 flex flex-col lg:flex-row items-center justify-between gap-10 h-full pt-28 pb-32">
                    <div class="max-w-xl text-white space-y-6 layer-content">
                        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/20 border border-emerald-500/30 px-4 py-1.5 text-xs font-semibold tracking-wider text-white uppercase backdrop-blur-sm">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            01. SAPI PERAH UNGGUL
                        </span>
                        <h1 class="text-4xl lg:text-6xl font-bold font-serif-title leading-tight text-white drop-shadow-md">
                            Peternakan Cimilk Dari Ciater
                        </h1>
                        <p class="text-white/80 text-sm lg:text-base leading-relaxed">
                            Kami memproduksi susu segar berkualitas premium langsung dari sapi peternakan unggulan. Dibudidayakan secara modern, higienis, dan penuh kasih sayang di Ciater.
                        </p>
                        <div class="flex items-center gap-4 pt-2">
                            <a href="#products" class="group flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-6 py-3 rounded-full transition shadow-lg shadow-emerald-500/20 hover:shadow-emerald-600/30">
                                Lihat Produk
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                            <a href="#about" class="text-white/85 hover:text-white font-semibold text-sm transition border-b border-white/20 hover:border-white py-1">Tentang Peternakan</a>
                        </div>
                    </div>

                    <!-- Glass Interactive Details Panel -->
                    <div class="w-full lg:max-w-md glass-panel rounded-[32px] p-6 lg:p-8 text-white shadow-2xl transition hover:-translate-y-2 duration-300 layer-card">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-lg font-bold font-serif-title">Detail Peternakan</h3>
                                <p class="text-xs text-white/50">Cimilk Cattle Center</p>
                            </div>
                            <div class="bg-white/10 rounded-2xl p-2.5 border border-white/15 text-lg">
                                🐄
                            </div>
                        </div>
                        <div class="space-y-4 text-sm">
                            <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                <span class="text-white/60">Populasi Sapi</span>
                                <span class="font-bold">10++ Ekor Sapi Sehat</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                <span class="text-white/60">Produksi Susu</span>
                                <span class="font-bold">1,500 Liter / Hari</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                <span class="text-white/60">Suhu Lokasi</span>
                                <span class="font-bold">18°C - 22°C (Sejuk)</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-white/60">Standar Pakan</span>
                                <span class="font-bold text-emerald-400">Nutrisi Tinggi Organik</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 2: STRAWBERRY YOGURT -->
            <div class="slide" id="slide-1">
                <!-- Parallax background (strawberry yogurt) -->
                <div class="absolute inset-0 bg-cover bg-center layer-bg" style="background-image: url('{{ asset('img/flavored_milk.png') }}'); transform: scale(1.15);"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-farm-dark/95 via-farm-dark/50 to-transparent z-10"></div>

                <!-- Huge Parallax Background Title -->
                <div class="absolute top-[28%] select-none pointer-events-none text-center w-full z-20 layer-title">
                    <h2 class="text-[12vw] font-black text-white/5 font-serif-title uppercase tracking-widest leading-none">SUSU RASA</h2>
                </div>

                <!-- Main Contents -->
                <div class="container mx-auto px-6 lg:px-20 relative z-30 flex flex-col lg:flex-row items-center justify-between gap-10 h-full pt-28 pb-32">
                    <div class="max-w-xl text-white space-y-6 layer-content">
                        <span class="inline-flex items-center gap-2 rounded-full bg-rose-500/20 border border-rose-500/30 px-4 py-1.5 text-xs font-semibold tracking-wider text-white uppercase backdrop-blur-sm">
                            <span class="h-2 w-2 rounded-full bg-rose-400 animate-pulse"></span>
                            02. SUSU SAPI MURNI SEGAR RASA-RASA
                        </span>
                        <h1 class="text-4xl lg:text-6xl font-bold font-serif-title leading-tight text-white drop-shadow-md">
                            Susu Sapi Murni Segar Aneka Rasa
                        </h1>
                        <p class="text-white/80 text-sm lg:text-base leading-relaxed">
                            Diproduksi langsung dari pemerahan harian susu segar steril kami yang dipadukan dengan kelezatan rasa buah alami pilihan: Stroberi, Anggur, Durian, Leci, dan Melon. Kaya nutrisi dan sangat disukai seluruh keluarga.
                        </p>
                        <div class="flex items-center gap-4 pt-2">
                            <a href="#products" class="group flex items-center gap-2 bg-rose-500 hover:bg-rose-600 text-white font-bold px-6 py-3 rounded-full transition shadow-lg shadow-rose-500/20 hover:shadow-rose-600/30">
                                Lihat Produk
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                            <a href="#about" class="text-white/85 hover:text-white font-semibold text-sm transition border-b border-white/20 hover:border-white py-1">Standardisasi Higienis</a>
                        </div>
                    </div>

                    <!-- Glass Interactive Details Panel -->
                    <div class="w-full lg:max-w-md glass-panel rounded-[32px] p-6 lg:p-8 text-white shadow-2xl transition hover:-translate-y-2 duration-300 layer-card">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-lg font-bold font-serif-title">Detail Varian</h3>
                                <p class="text-xs text-white/50">Cimilk Flavored Milk</p>
                            </div>
                            <div class="bg-white/10 rounded-2xl p-2.5 border border-white/15 text-lg">
                                🥛
                            </div>
                        </div>
                        <div class="space-y-4 text-sm">
                            <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                <span class="text-white/60">Varian Rasa</span>
                                <span class="font-bold text-rose-300">Stroberi, Anggur, Durian, Leci, Melon</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                <span class="text-white/60">Pemerahan</span>
                                <span class="font-bold">100% Sapi Perah Murni</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                <span class="text-white/60">Tingkat Manis</span>
                                <span class="font-bold">Pas & Rendah Kalori</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-white/60">Keistimewaan</span>
                                <span class="font-bold text-rose-400">Kaya Kalsium & Gurih Segar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 3: MIXED FLAVOR YOGURT -->
            <div class="slide" id="slide-2">
                <!-- Parallax background (mango blueberry yogurt) -->
                <div class="absolute inset-0 bg-cover bg-center layer-bg" style="background-image: url('{{ asset('img/yogurt.png') }}'); transform: scale(1.15);"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-farm-dark/95 via-farm-dark/50 to-transparent z-10"></div>

                <!-- Huge Parallax Background Title -->
                <div class="absolute top-[28%] select-none pointer-events-none text-center w-full z-20 layer-title">
                    <h2 class="text-[12vw] font-black text-white/5 font-serif-title uppercase tracking-widest leading-none">YOGURT RASA</h2>
                </div>

                <!-- Main Contents -->
                <div class="container mx-auto px-6 lg:px-20 relative z-30 flex flex-col lg:flex-row items-center justify-between gap-10 h-full pt-28 pb-32">
                    <div class="max-w-xl text-white space-y-6 layer-content">
                        <span class="inline-flex items-center gap-2 rounded-full bg-indigo-500/20 border border-indigo-500/30 px-4 py-1.5 text-xs font-semibold tracking-wider text-white uppercase backdrop-blur-sm">
                            <span class="h-2 w-2 rounded-full bg-indigo-400 animate-pulse"></span>
                            03. YOGURT CIMILK RASA-RASA
                        </span>
                        <h1 class="text-4xl lg:text-6xl font-bold font-serif-title leading-tight text-white drop-shadow-md">
                            Yogurt Rasa-Rasa Fermentasi Alami
                        </h1>
                        <p class="text-white/80 text-sm lg:text-base leading-relaxed">
                            Coba sensasi kelembutan rasa yogurt probiotik kental terbaik kami dengan kultur bakteri baik L. bulgaricus. Menawarkan kesegaran rasa buah lezat pilihan: Stroberi, Anggur, Durian, Leci, dan Melon.
                        </p>
                        <div class="flex items-center gap-4 pt-2">
                            <a href="#products" class="group flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white font-bold px-6 py-3 rounded-full transition shadow-lg shadow-indigo-500/20 hover:shadow-indigo-600/30">
                                Lihat Produk
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                            <a href="#about" class="text-white/85 hover:text-white font-semibold text-sm transition border-b border-white/20 hover:border-white py-1">Kandungan Nutrisi</a>
                        </div>
                    </div>

                    <!-- Glass Interactive Details Panel -->
                    <div class="w-full lg:max-w-md glass-panel rounded-[32px] p-6 lg:p-8 text-white shadow-2xl transition hover:-translate-y-2 duration-300 layer-card">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-lg font-bold font-serif-title">Detail Varian</h3>
                                <p class="text-xs text-white/50">Cimilk Yogurt Center</p>
                            </div>
                            <div class="bg-white/10 rounded-2xl p-2.5 border border-white/15 text-lg">
                                🍓
                            </div>
                        </div>
                        <div class="space-y-4 text-sm">
                            <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                <span class="text-white/60">Varian Rasa</span>
                                <span class="font-bold text-indigo-300">Stroberi, Anggur, Durian, Leci, Melon</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                <span class="text-white/60">Kultur Bakteri</span>
                                <span class="font-bold">L. bulgaricus Pilihan</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                <span class="text-white/60">Tekstur Olahan</span>
                                <span class="font-bold">Sangat Kental & Lembut</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-white/60">Manfaat Utama</span>
                                <span class="font-bold text-indigo-400">Melancarkan Pencernaan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- CONTROLS & DOCK DOCK SECTION (Modelled after the TikTok Reference) -->
        <div class="absolute bottom-6 left-0 right-0 z-40 px-6 max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-end gap-6 pointer-events-none">

            <!-- Pulse Arrows (Left & Right Controls Removed) -->

            <!-- Horizontal Thumbnail Dock (Custom styling similar to interactive TikTok preview) -->
            <div class="flex items-center gap-4 overflow-x-auto pb-2 scrollbar-none w-full md:w-auto justify-center pointer-events-auto">

                <!-- Thumb Card 1 -->
                <div data-slide-to="0" class="thumb-card active-thumb group relative flex items-center gap-3 bg-white/10 hover:bg-white/15 border border-white/20 backdrop-blur-md rounded-2xl p-2.5 pr-5 text-white cursor-pointer select-none w-[170px] md:w-[210px]">
                    <div class="absolute bottom-0 left-0 h-1 bg-emerald-500 rounded-b-2xl transition-all duration-300 pointer-events-none thumb-progress" style="width: 100%;"></div>
                    <div class="w-10 h-10 rounded-xl overflow-hidden bg-white/15 flex-shrink-0">
                        <img src="{{ asset('img/bg_cattle.png') }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105" alt="">
                    </div>
                    <div class="overflow-hidden">
                        <span class="text-[9px] text-white/55 font-bold uppercase tracking-wider block">01. SAPI PERAH</span>
                        <span class="font-bold text-xs md:text-sm font-serif-title block truncate">Cattle Farm</span>
                    </div>
                </div>

                <!-- Thumb Card 2 -->
                <div data-slide-to="1" class="thumb-card group relative flex items-center gap-3 bg-white/5 hover:bg-white/15 border border-white/10 backdrop-blur-md rounded-2xl p-2.5 pr-5 text-white/70 cursor-pointer select-none w-[170px] md:w-[210px] opacity-70">
                    <div class="absolute bottom-0 left-0 h-1 bg-rose-500 rounded-b-2xl transition-all duration-300 pointer-events-none thumb-progress" style="width: 0%;"></div>
                    <div class="w-10 h-10 rounded-xl overflow-hidden bg-white/15 flex-shrink-0">
                        <img src="{{ asset('img/flavored_milk.png') }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105" alt="">
                    </div>
                    <div class="overflow-hidden">
                        <span class="text-[9px] text-white/55 font-bold uppercase tracking-wider block">02. SUSU RASA-RASA</span>
                        <span class="font-bold text-xs md:text-sm font-serif-title block truncate">Flavored Milk</span>
                    </div>
                </div>

                <!-- Thumb Card 3 -->
                <div data-slide-to="2" class="thumb-card group relative flex items-center gap-3 bg-white/5 hover:bg-white/15 border border-white/10 backdrop-blur-md rounded-2xl p-2.5 pr-5 text-white/70 cursor-pointer select-none w-[170px] md:w-[210px] opacity-70">
                    <div class="absolute bottom-0 left-0 h-1 bg-indigo-500 rounded-b-2xl transition-all duration-300 pointer-events-none thumb-progress" style="width: 0%;"></div>
                    <div class="w-10 h-10 rounded-xl overflow-hidden bg-white/15 flex-shrink-0">
                        <img src="{{ asset('img/yogurt.png') }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105" alt="">
                    </div>
                    <div class="overflow-hidden">
                        <span class="text-[9px] text-white/55 font-bold uppercase tracking-wider block">03. YOGURT RASA-RASA</span>
                        <span class="font-bold text-xs md:text-sm font-serif-title block truncate">Premium Yogurt</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- Down Arrow Indicator -->
        <a href="#products" class="absolute bottom-6 left-1/2 -translate-x-1/2 z-40 text-white/40 hover:text-white transition duration-300 animate-bounce">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7-7v18"></path></svg>
        </a>
    </section>


    <!-- PRODUCT CARDS SECTION -->
    <section id="products" class="bg-gradient-to-b from-farm-dark to-emerald-950 px-6 py-20 lg:px-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/5 via-transparent to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="mb-16 text-center">
                <span class="inline-flex rounded-full bg-emerald-500/10 border border-emerald-500/20 px-4 py-1.5 text-xs font-semibold tracking-[0.25em] text-emerald-300 uppercase">PRODUK SEGAR TERLARIS</span>
                <h2 class="mt-4 text-4xl lg:text-5xl font-bold font-serif-title text-white">Hasil Olahan Alami & Murni</h2>
                <p class="mx-auto mt-4 max-w-2xl text-white/60 text-sm lg:text-base leading-relaxed">
                    Setiap produk diolah langsung secara higienis pasca pemerahan harian demi menjaga keutuhan zat gizi alami yang bermanfaat untuk keluarga Anda.
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                <!-- Product Card 1 -->
                <div class="group rounded-[32px] overflow-hidden bg-white/5 border border-white/10 backdrop-blur-md shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:border-emerald-500/30">
                    <div class="h-60 w-full overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1563636619-e9143da7973b?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Susu Segar" />
                        <span class="absolute top-4 left-4 rounded-full bg-emerald-500 px-3 py-1 text-[10px] font-bold tracking-wider text-white uppercase shadow-lg shadow-emerald-500/20">TERFAVORIT</span>
                    </div>
                    <div class="p-8 text-center text-white space-y-3">
                        <h3 class="text-xl font-bold font-serif-title group-hover:text-emerald-400 transition-colors">Susu Murni Segar</h3>
                        <p class="text-white/60 text-xs leading-relaxed">Susu segar berkualitas tinggi yang langsung dikemas steril pasca proses pemerahan pagi hari. Kaya kalsium dan gurih.</p>
                        <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                            <span class="text-emerald-400 font-bold">100% Organik</span>
                            <span class="text-white/40">Isi: 1 Liter</span>
                        </div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="group rounded-[32px] overflow-hidden bg-white/5 border border-white/10 backdrop-blur-md shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:border-emerald-500/30">
                    <div class="h-60 w-full overflow-hidden relative">
                        <img src="{{ asset('img/flavored_milk.png') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Susu Rasa-Rasa" />
                        <span class="absolute top-4 left-4 rounded-full bg-rose-500 px-3 py-1 text-[10px] font-bold tracking-wider text-white uppercase shadow-lg shadow-rose-500/20">POPULER</span>
                    </div>
                    <div class="p-8 text-center text-white space-y-3">
                        <h3 class="text-xl font-bold font-serif-title group-hover:text-emerald-400 transition-colors">Susu Murni Segar Rasa-Rasa</h3>
                        <p class="text-white/60 text-xs leading-relaxed">Susu sapi murni segar berkualitas tinggi dengan rasa buah lezat pilihan: Stroberi, Anggur, Durian, Leci, dan Melon.</p>
                        <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                            <span class="text-rose-400 font-bold">Stroberi, Anggur, Durian, Leci, Melon</span>
                            <span class="text-white/40">Isi: 1 Liter</span>
                        </div>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="group rounded-[32px] overflow-hidden bg-white/5 border border-white/10 backdrop-blur-md shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:border-emerald-500/30">
                    <div class="h-60 w-full overflow-hidden relative">
                        <img src="{{ asset('img/yogurt.png') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Yogurt Rasa-Rasa" />
                        <span class="absolute top-4 left-4 rounded-full bg-indigo-500 px-3 py-1 text-[10px] font-bold tracking-wider text-white uppercase shadow-lg shadow-indigo-500/20">PREMIUM</span>
                    </div>
                    <div class="p-8 text-center text-white space-y-3">
                        <h3 class="text-xl font-bold font-serif-title group-hover:text-emerald-400 transition-colors">Yogurt Probiotik Rasa-Rasa</h3>
                        <p class="text-white/60 text-xs leading-relaxed">Olahan yogurt fermentasi super kental dengan varian rasa buah alami pilihan: Stroberi, Anggur, Durian, Leci, dan Melon yang kaya probiotik.</p>
                        <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                            <span class="text-indigo-400 font-bold">Stroberi, Anggur, Durian, Leci, Melon</span>
                            <span class="text-white/40">Isi: 250ml</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- YOGURT FLAVORS SECTION -->
            <div class="mt-24 pt-16 border-t border-white/10">
                <div class="mb-12 text-center">
                    <span class="inline-flex rounded-full bg-indigo-500/10 border border-indigo-500/20 px-4 py-1.5 text-xs font-semibold tracking-[0.25em] text-indigo-300 uppercase">EKSPLORASI VARIAN RASA YOGURT</span>
                    <h3 class="mt-4 text-3xl lg:text-4xl font-bold font-serif-title text-white">5 Sensasi Kesegaran Yogurt Probiotik</h3>
                    <p class="mx-auto mt-4 max-w-xl text-white/50 text-xs lg:text-sm leading-relaxed">
                        Nikmati kelembutan yogurt kental fermentasi alami dengan kultur bakteri baik L. bulgaricus, kini hadir dalam lima varian rasa buah segar pilihan langsung dari Cimilk Yogurt.
                    </p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 justify-center">
                    <!-- Flavor 1: Strawberry -->
                    <div class="group rounded-3xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-md shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_15px_30px_-5px_rgba(244,63,94,0.3)] hover:border-rose-500/30">
                        <div class="h-[340px] w-full overflow-hidden relative">
                            <img src="{{ asset('img/yogurt_strawberry.png') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Yoghurt Strawberry" />
                            <span class="absolute top-3 left-3 rounded-full bg-rose-500 px-2.5 py-0.5 text-[9px] font-bold tracking-wider text-white uppercase shadow-lg shadow-rose-500/20">STRAWBERRY</span>
                        </div>
                        <div class="p-6 text-center text-white space-y-2">
                            <h4 class="text-lg font-bold font-serif-title group-hover:text-rose-300 transition-colors">Yoghurt Strawberry</h4>
                            <p class="text-rose-400/90 text-[10px] font-semibold italic">"Manis segarnya bikin harimu makin ceria!"</p>
                            <p class="text-white/60 text-[11px] leading-relaxed">Manis alami buah, berpadu dengan kesegaran yoghurt yang bikin hari makin ceria. Yuk, cobain sekarang dan rasakan sensasi segarnya di setiap tegukan! 🥶❤️</p>
                        </div>
                    </div>

                    <!-- Flavor 2: Leci -->
                    <div class="group rounded-3xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-md shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_15px_30px_-5px_rgba(14,165,233,0.3)] hover:border-sky-500/30">
                        <div class="h-[340px] w-full overflow-hidden relative">
                            <img src="{{ asset('img/yogurt_lychee.png') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Yoghurt Leci" />
                            <span class="absolute top-3 left-3 rounded-full bg-sky-500 px-2.5 py-0.5 text-[9px] font-bold tracking-wider text-white uppercase shadow-lg shadow-sky-500/20">LECI</span>
                        </div>
                        <div class="p-6 text-center text-white space-y-2">
                            <h4 class="text-lg font-bold font-serif-title group-hover:text-sky-300 transition-colors">Yoghurt Leci</h4>
                            <p class="text-sky-400/90 text-[10px] font-semibold italic">"Manis lembutnya bikin hari kamu lebih berwarna"</p>
                            <p class="text-white/60 text-[11px] leading-relaxed">Yoghurt es rasa leci yang bikin setiap tegukan terasa adem dan menenangkan. Pas banget buat temenin santai di siang yang panas! 🥶🤍</p>
                        </div>
                    </div>

                    <!-- Flavor 3: Anggur -->
                    <div class="group rounded-3xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-md shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_15px_30px_-5px_rgba(168,85,247,0.3)] hover:border-purple-500/30">
                        <div class="h-[340px] w-full overflow-hidden relative">
                            <img src="{{ asset('img/yogurt_grape.png') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Yoghurt Anggur" />
                            <span class="absolute top-3 left-3 rounded-full bg-purple-500 px-2.5 py-0.5 text-[9px] font-bold tracking-wider text-white uppercase shadow-lg shadow-purple-500/20">ANGGUR</span>
                        </div>
                        <div class="p-6 text-center text-white space-y-2">
                            <h4 class="text-lg font-bold font-serif-title group-hover:text-purple-300 transition-colors">Yoghurt Anggur</h4>
                            <p class="text-purple-400/90 text-[10px] font-semibold italic">"Rasa anggur yang fresh bikin suasana adem"</p>
                            <p class="text-white/60 text-[11px] leading-relaxed">Perpaduan rasa fruity dan creamy yang bikin hari kamu lebih berwarna. Siap temani momen santai dengan kesegaran tiada tanding! 🥶💜</p>
                        </div>
                    </div>

                    <!-- Flavor 4: Melon -->
                    <div class="group rounded-3xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-md shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_15px_30px_-5px_rgba(34,197,94,0.3)] hover:border-emerald-500/30">
                        <div class="h-[340px] w-full overflow-hidden relative">
                            <img src="{{ asset('img/yogurt_melon.png') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Yoghurt Melon" />
                            <span class="absolute top-3 left-3 rounded-full bg-emerald-500 px-2.5 py-0.5 text-[9px] font-bold tracking-wider text-white uppercase shadow-lg shadow-emerald-500/20">MELON</span>
                        </div>
                        <div class="p-6 text-center text-white space-y-2">
                            <h4 class="text-lg font-bold font-serif-title group-hover:text-emerald-300 transition-colors">Yoghurt Melon</h4>
                            <p class="text-emerald-400/90 text-[10px] font-semibold italic">"Segarnya melon mood booster di setiap waktu!"</p>
                            <p class="text-white/60 text-[11px] leading-relaxed">Perpaduan rasa manis and aroma segar yang bikin lidah jatuh cinta dari tegukan pertama. Cocok diminum kapan saja untuk mood yang selalu fresh! 🥶💚</p>
                        </div>
                    </div>

                    <!-- Flavor 5: Durian -->
                    <div class="group rounded-3xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-md shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_15px_30px_-5px_rgba(234,179,8,0.3)] hover:border-amber-500/30">
                        <div class="h-[340px] w-full overflow-hidden relative">
                            <img src="{{ asset('img/yogurt_durian.png') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="Yoghurt Durian" />
                            <span class="absolute top-3 left-3 rounded-full bg-amber-500 px-2.5 py-0.5 text-[9px] font-bold tracking-wider text-white uppercase shadow-lg shadow-amber-500/20">DURIAN</span>
                        </div>
                        <div class="p-6 text-center text-white space-y-2">
                            <h4 class="text-lg font-bold font-serif-title group-hover:text-amber-300 transition-colors">Yoghurt Durian</h4>
                            <p class="text-amber-400/90 text-[10px] font-semibold italic">"Kaya rasa, penuh kenikmatan"</p>
                            <p class="text-white/60 text-[11px] leading-relaxed">Yoghurt es rasa durian dengan aroma khas dan rasa legit yang berpadu segar. Sensasi unik yang bikin sekali coba langsung ketagihan! 💛✨</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ABOUT SECTION -->
    <section id="about" class="bg-farm-cream px-6 py-20 lg:px-20 text-[#2e3b2c] relative overflow-hidden">
        <div class="max-w-7xl mx-auto grid gap-12 lg:grid-cols-2 items-center">

            <!-- Visual Grid Frame -->
            <div class="relative group">
                <div class="absolute -inset-4 bg-emerald-500/10 rounded-[44px] blur-xl group-hover:bg-emerald-500/20 transition-all duration-500"></div>
                <div class="rounded-[40px] overflow-hidden border border-[#d8d0bc] shadow-2xl relative z-10 aspect-[4/3] lg:aspect-auto lg:h-[480px]">
                    <img src="https://i.pinimg.com/736x/da/6e/49/da6e49bd6cf922dfdabdb300c464b0da.jpg" alt="Peternakan Cimilk" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-700" />
                </div>
            </div>

            <div class="space-y-6 lg:pl-6">
                <span class="inline-flex rounded-full bg-[#dccfb6]/60 border border-[#c4b69c] px-4 py-1.5 text-xs font-semibold tracking-widest text-[#4d624a] uppercase">TENTANG KAMI</span>
                <h2 class="text-4xl lg:text-5xl font-bold font-serif-title leading-tight text-farm-dark">Dedikasi Cimilk Pada Kualitas Susu & Ternak</h2>
                <p class="text-[#5e6a59] text-sm lg:text-base leading-relaxed">
                    Sejak 2014, Cimilk berkomitmen untuk menghadirkan kualitas susu terbaik melalui pengelolaan peternakan modern yang ramah lingkungan dan memperhatikan kesejahteraan hewan. Kami yakin bahwa sapi dan ternak yang hidup bahagia di lingkungan Palasari Ciater yang sejuk dan bebas stres akan menghasilkan produk susu yang lebih berkhasiat, lezat, dan melimpah.
                </p>

                <div class="grid grid-cols-2 gap-4 pt-4">
                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-[#e8dfcb]">
                        <span class="text-2xl text-emerald-600 block mb-2">🌿</span>
                        <h4 class="font-bold text-sm text-farm-dark font-serif-title">100% Organik</h4>
                        <p class="text-xs text-gray-500 mt-1">Bebas pengawet, antibiotik kimiawi, & pakan sintetis.</p>
                    </div>
                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-[#e8dfcb]">
                        <span class="text-2xl text-emerald-600 block mb-2">⭐</span>
                        <h4 class="font-bold text-sm text-farm-dark font-serif-title">Higienitas Steril</h4>
                        <p class="text-xs text-gray-500 mt-1">Proses tertutup modern dari pemerahan hingga pengemasan botol.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- LOCATION & CONTACT MAP SECTION -->
    <section id="location" class="bg-farm-dark text-white px-6 py-20 lg:px-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto grid gap-12 lg:grid-cols-[1fr_1.5fr] items-center">

            <div class="space-y-6">
                <span class="inline-flex rounded-full bg-emerald-500/20 border border-emerald-500/30 px-4 py-1.5 text-xs font-semibold tracking-widest text-emerald-300 uppercase">HUBUNGI KAMI</span>
                <h2 class="text-3xl lg:text-4xl font-bold font-serif-title leading-tight">Mari Kunjungi Peternakan Kami</h2>
                <p class="text-white/60 text-sm leading-relaxed">
                    Yang berlokasi di Palasari Ciater, serta rasakan langsung pengalaman membuat yogurt dari susu segar pasca pemerahan.
                </p>

                <div class="space-y-4 pt-4 text-sm border-t border-white/10">
                    <div class="flex items-start gap-4">
                        <span class="bg-white/10 p-2.5 rounded-xl border border-white/10 flex-shrink-0 text-base">📍</span>
                        <div>
                            <h4 class="font-bold text-white/90">Alamat Peternakan</h4>
                            <p class="text-white/50 text-xs mt-1">Kp. Palasari 2 Babakan Waru RT 26, RW 03, Desa Palasari, Kecamatan Ciater, Kabupaten Subang, Subang, Indonesia, 41280</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="bg-white/10 p-2.5 rounded-xl border border-white/10 flex-shrink-0 text-base">📞</span>
                        <div>
                            <h4 class="font-bold text-white/90">Nomor Telepon</h4>
                            <p class="text-white/50 text-xs mt-1">+62 813-1348-8318</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="bg-white/10 p-2.5 rounded-xl border border-white/10 flex-shrink-0 text-base">📸</span>
                        <div>
                            <h4 class="font-bold text-white/90">Instagram Resmi</h4>
                            <p class="text-emerald-400 text-xs mt-1 font-bold">@cimilk.id</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Styled Google Map container -->
            <div class="relative w-full h-[350px] lg:h-[420px] rounded-[36px] overflow-hidden border border-white/15 shadow-2xl">
                <iframe src="https://maps.google.com/maps?q=-6.7163390,107.6720960&hl=id&z=15&output=embed" width="100%" height="100%" style="border:0; filter: contrast(1.1) brightness(0.9);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
    </section>


    <!-- FOOTER -->
    <footer class="bg-emerald-950 text-white/40 py-8 text-center text-xs border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-center g<span class="font-bold text-white/60">CIMILK DAIRY FARM © 2026. All Rights Reserved.</span>
        </div>
    </footer>


    <!-- DYNAMIC JAVASCRIPT SLIDER PARALLAX CONTROLLER -->
    <script>
        const sliderWrapper = document.getElementById('sliderWrapper');
        const slides = document.querySelectorAll('.slide');
        const thumbCards = document.querySelectorAll('.thumb-card');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const navbar = document.getElementById('navbar');

        let currentSlide = 0;
        const totalSlides = slides.length;

        // Function to smoothly switch slides and trigger advanced multi-layered horizontal parallax
        function goToSlide(slideIndex) {
            if (slideIndex < 0 || slideIndex >= totalSlides) return;

            currentSlide = slideIndex;

            // 1. Move the parent slider container wrapper horizontally
            sliderWrapper.style.transform = `translateX(-${currentSlide * 100}vw)`;

            // 2. Loop through all slides to compute spatial offsets for multi-layer 3D-like Parallax
            slides.forEach((slide, idx) => {
                const diff = idx - currentSlide;

                // Layers inside the slide
                const bgLayer = slide.querySelector('.layer-bg');
                const titleLayer = slide.querySelector('.layer-title');
                const contentLayer = slide.querySelector('.layer-content');
                const cardLayer = slide.querySelector('.layer-card');

                if (bgLayer) {
                    // Slide background moves in the opposite direction at 35% speed (deep perspective depth)
                    bgLayer.style.transform = `translateX(${diff * 35}vw) scale(1.15)`;
                }
                if (titleLayer) {
                    // Big typography slides at a fast 50% rate
                    titleLayer.style.transform = `translateX(${diff * -50}vw)`;
                }

                // Add/remove active classes for fade/float entrance animations
                if (idx === currentSlide) {
                    slide.classList.add('active');
                } else {
                    slide.classList.remove('active');
                }
            });

            // 3. Update active classes and bottom loader progress docks
            thumbCards.forEach((card, idx) => {
                const progressIndicator = card.querySelector('.thumb-progress');

                if (idx === currentSlide) {
                    card.classList.add('active-thumb');
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1.05)';
                    if (progressIndicator) progressIndicator.style.width = '100%';
                } else {
                    card.classList.remove('active-thumb');
                    card.style.opacity = '0.6';
                    card.style.transform = 'scale(0.95)';
                    if (progressIndicator) progressIndicator.style.width = '0%';
                }
            });
        }

        // Add event listeners for button clicks
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                let target = currentSlide + 1;
                if (target >= totalSlides) target = 0; // infinite carousel loop
                goToSlide(target);
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                let target = currentSlide - 1;
                if (target < 0) target = totalSlides - 1; // infinite carousel loop
                goToSlide(target);
            });
        }

        // Add click events to thumbnail selectors
        thumbCards.forEach((card) => {
            card.addEventListener('click', () => {
                const targetIdx = parseInt(card.getAttribute('data-slide-to'));
                goToSlide(targetIdx);
            });
        });

        // Initialize state of parallax for all non-active background slides at load
        goToSlide(0);

        // Sticky Navbar Scroll Handler (changes opacity/glow and compacts padding on scroll)
        window.addEventListener('scroll', () => {
            if (window.scrollY > 80) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
