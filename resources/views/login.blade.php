<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cimilk | Nature Intended Dairy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'mil-beige': '#f6f1ea', // Warna background utama referensi
                        'mil-dark': '#231f20',  // Warna teks serif gelap
                        'mil-gold': '#b9a573',  // Warna tulisan kursif referensi
                    },
                    fontFamily: {
                        'serif-title': ['Playfair Display', 'serif'], // Untuk Judul Utama & Slogan
                        'serif-body': ['Georgia', 'serif'],      // Untuk paragraf kecil referensi
                        'poppins': ['Poppins', 'sans-serif'],        // Untuk Navbar & Info-Cards
                    }
                }
            }
        }
    </script>
    <style>
        /* Elemen Kursif 'Sapi Perah' Meniru Referensi */
        .script-text {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-weight: 400;
            color: #b9a573;
            font-size: 3.5rem;
            line-height: 1;
            margin-bottom: -0.5rem;
            display: block;
        }

        /* Lingkaran Krem Tipis di Belakang Teks (Hero) */
        .mil-circle {
            position: absolute;
            width: 500px;
            height: 500px;
            background-color: #f2e7da; /* Warna lingkaran tipis */
            border-radius: 50%;
            top: -100px;
            left: -150px;
            z-index: -1;
            opacity: 0.6;
        }

        /* Susunan Gambar Grid Meniru Susunan Referensi (Kanan ke Kiri) */
        .grid-images {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        .grid-images .group:first-child { grid-column: span 1; }
        .grid-images .group:nth-child(2) { grid-column: span 1; }
        .grid-images .group:nth-child(3) { grid-column: span 1; }
    </style>
</head>
<body class="bg-mil-beige text-gray-800 font-poppins antialiased">

    <nav class="bg-mil-dark text-mil-beige py-4 px-10 shadow-lg">
        <div class="max-w-[1400px] mx-auto flex justify-between items-center px-4">
            <h1 class="font-bold text-xl font-serif-title tracking-tight text-[#f2ca5a]">CIMILK</h1>
            <div class="space-x-8 text-xs uppercase font-semibold">
                <a href="#" class="hover:text-mil-gold transition">Beranda</a>
                <a href="#" class="hover:text-mil-gold transition">Produk</a>
                <a href="#" class="hover:text-mil-gold transition">Tentang</a>
                <a href="/login" class="bg-mil-gold text-mil-dark px-5 py-2 rounded-lg font-bold hover:bg-opacity-90 transition">LOGIN</a>
            </div>
        </div>
    </nav>

    <main class="space-y-24 pb-20 pt-16">

        <header class="max-w-[1300px] mx-auto px-6 grid md:grid-cols-2 gap-16 items-start relative overflow-hidden h-[500px]">
            <img src="https://images.pexels.com/photos/1485637/pexels-photo-1485637.jpeg?auto=compress&cs=tinysrgb&w=1600"
                 alt="Sapi Perah Cimilk" class="w-full h-full object-cover rounded-3xl shadow-xl">

            <div class="relative z-10 p-6 flex items-center justify-center text-center">
                <div class="relative pt-10">
                    <div class="mil-circle"></div>
                    <span class="script-text">sapi perah</span>
                    <h2 class="text-6xl font-serif-title text-mil-dark leading-[1.05] tracking-tight">Milk and More!</h2>
                    <p class="text-mil-dark/70 text-xl uppercase tracking-widest font-bold mt-2">FRESH. LOCAL. DELIVERED.</p>
                </div>
            </div>
        </header>

        <section class="container mx-auto px-6 max-w-6xl">
            <h3 class="text-4xl font-serif-title text-farm-brown text-center mb-16 italic">Produk Terbaru Kami</h3>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="text-center group">
                    <div class="overflow-hidden rounded-2xl shadow-xl border-2 border-farm-soft/50 mb-6 bg-white">
                        <img src="https://via.placeholder.com/350x350.png?text=Tvorog" alt="Tvorog" class="w-full h-64 object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <h4 class="font-bold text-lg text-mil-dark mb-1 font-serif-title">Massa Tvorozhnaya</h4>
                    <p class="text-sm text-gray-600 italic">Keju lembut kaya protein untuk kesehatan Anda.</p>
                </div>
                <div class="text-center group">
                    <div class="overflow-hidden rounded-2xl shadow-xl border-2 border-farm-soft/50 mb-6 bg-white">
                        <img src="https://via.placeholder.com/350x350.png?text=Milk" alt="Milk" class="w-full h-64 object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <h4 class="font-bold text-lg text-mil-dark mb-1 font-serif-title">Susu Murni 3.2%</h4>
                    <p class="text-sm text-gray-600 italic">Kesegaran murni langsung dari peternakan lokal.</p>
                </div>
                <div class="text-center group">
                    <div class="overflow-hidden rounded-2xl shadow-xl border-2 border-farm-soft/50 mb-6 bg-white">
                        <img src="https://via.placeholder.com/350x350.png?text=Yogurt" alt="Yogurt" class="w-full h-64 object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <h4 class="font-bold text-lg text-mil-dark mb-1 font-serif-title">Yogurt Buah</h4>
                    <p class="text-sm text-gray-600 italic">Pilihan menyehatkan dengan rasa buah alami.</p>
                </div>
            </div>
        </section>

        <section class="container mx-auto px-6 max-w-3xl text-center">
            <h3 class="text-2xl font-serif-title text-mil-dark mb-10 uppercase tracking-widest">Kategori Peternakan</h3>
            <div class="flex justify-center gap-12">
                <div class="bg-white p-8 rounded-3xl shadow-sm border-2 border-mil-beige w-48 hover:border-mil-dark transition cursor-pointer group">
                    <div class="text-6xl mb-4 group-hover:scale-110 transition">🐮</div>
                    <h4 class="font-bold text-[10px] text-gray-500 uppercase tracking-[0.2em]">Dairy Cows</h4>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border-2 border-mil-beige w-48 hover:border-mil-dark transition cursor-pointer group">
                    <div class="text-6xl mb-4 group-hover:scale-110 transition">🥛</div>
                    <h4 class="font-semibold text-xs text-gray-700 uppercase tracking-widest font-bold">MILK PRODUCTS</h4>
                </div>
            </div>
        </section>

        <section class="container mx-auto px-6 max-w-6xl">
            <div class="grid-images grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="group overflow-hidden rounded-2xl shadow-xl">
                    <img src="https://images.unsplash.com/photo-1546445317-29f4545e9d53?auto=format&fit=crop&q=80&w=800"
                         alt="Sapi Perah" class="w-full h-96 object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="group overflow-hidden rounded-2xl shadow-xl">
                    <img src="https://images.unsplash.com/photo-1500595046743-cd273d0984a8?auto=format&fit=crop&q=80&w=800"
                         alt="Peternakan" class="w-full h-96 object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="group overflow-hidden rounded-2xl shadow-xl">
                    <img src="https://images.unsplash.com/photo-1563227812-0ea4c22e6cc8?auto=format&fit=crop&q=80&w=800"
                         alt="Produk" class="w-full h-96 object-cover group-hover:scale-110 transition duration-500">
                </div>
            </div>
        </section>

        <section class="container mx-auto px-6 max-w-3xl text-center">
            <h3 class="text-3xl font-serif-title text-mil-dark mb-10 leading-tight">Tradisi Produksi Susu,<br>Teruji oleh Waktu</h3>
            <p class="font-serif-body text-gray-600 text-lg leading-relaxed italic max-w-2xl mx-auto">"Para pengrajin kami dengan teliti mengikuti tradisi yang diwariskan turun-temurun untuk memastikan setiap produk tidak bercacat."</p>
            <div class="mt-8 border-l-4 border-mil-gold pl-4 font-bold text-mil-dark font-serif-title text-3xl">Berkat Hartono</div>
        </section>

    </main>

    <footer class="bg-white text-mil-dark py-12 px-6 border-t border-mil-beige">
        <div class="container mx-auto text-center space-y-3">
            <div class="font-serif-title text-3xl tracking-tight">CIMILK</div>
            <p class="text-mil-dark/70 text-xs mt-6 tracking-wide">&copy; 2026 CIMILK. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

</body>
</html>
