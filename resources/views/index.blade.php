<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cimilk Dairy Farm </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Georgia&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'farm-green': '#4d624a',
                        'farm-brown': '#7a5a40',
                        'farm-cream': '#f4efe6',
                        'farm-soft': '#dccfb6',
                    },
                    fontFamily: {
                        'serif-title': ['Playfair Display', 'serif'],
                        'serif-body': ['Georgia', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .hero-overlay { background-color: rgba(0, 0, 0, 0.45); }
    </style>
</head>
<body class="bg-farm-cream text-gray-800 font-serif-body">

    <nav class="bg-farm-green text-white p-4 shadow-md sticky top-0 z-50">
        <div class="container mx-auto flex flex-wrap items-center justify-between px-4 gap-4">
            <div class="flex items-center gap-6">
                <h1 class="font-bold text-xl font-serif-title tracking-tight">CIMILK</h1>
                <div class="hidden md:flex items-center gap-6 text-xs uppercase font-semibold">
                    <a href="{{ url('/#home') }}" class="hover:text-farm-soft transition">BERANDA</a>
                    <a href="{{ url('/#products') }}" class="hover:text-farm-soft transition">PRODUK</a>
                </div>
            </div>
            <div class="flex items-center gap-4 text-xs uppercase font-semibold">
                <a href="{{ route('login') }}" class="bg-farm-brown px-5 py-2 rounded-lg font-bold hover:bg-opacity-90 transition">LOGIN</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
<section id="home" class="px-10 py-16 lg:px-20 lg:py-20">
  <div class="max-w-7xl mx-auto grid gap-10 lg:grid-cols-2 items-center">
    <div class="space-y-8">
      <span class="inline-flex rounded-full bg-[#d9d7c7] px-4 py-2 text-sm uppercase tracking-[0.4em] text-[#4d624a] font-semibold">Sapi Perah Lokal</span>
      <h1 class="text-5xl font-bold text-[#2f3f2f] leading-tight">Susu Segar dan Olahan Alami dari Peternakan Sapi Perah</h1>
      <p class="max-w-2xl text-lg text-[#5e6a59]">Kami menyajikan susu perah segar langsung dari sapi yang dirawat dengan baik. Temukan produk lokal berkualitas tinggi yang sehat untuk keluarga.</p>
      <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
        <div class="rounded-3xl bg-white p-4 text-center shadow-sm">
          <p class="text-sm text-[#7d8b70]">Kualitas</p>
          <p class="mt-2 text-lg font-bold text-[#2f3f2f]">Terjamin</p>
        </div>
        <div class="rounded-3xl bg-white p-4 text-center shadow-sm">
          <p class="text-sm text-[#7d8b70]">Sapi Sehat</p>
          <p class="mt-2 text-lg font-bold text-[#2f3f2f]">Terawat</p>
        </div>
        <div class="rounded-3xl bg-white p-4 text-center shadow-sm">
          <p class="text-sm text-[#7d8b70]">Susu Segar</p>
          <p class="mt-2 text-lg font-bold text-[#2f3f2f]">Diperah Harian</p>
        </div>
        <div class="rounded-3xl bg-white p-4 text-center shadow-sm">
          <p class="text-sm text-[#7d8b70]">Tanpa Pengawet</p>
          <p class="mt-2 text-lg font-bold text-[#2f3f2f]">Alami</p>
        </div>
      </div>
    </div>
    <div class="rounded-[40px] overflow-hidden shadow-2xl border border-[#d8d0bc] bg-white">
      <img src="https://i.pinimg.com/1200x/a9/34/61/a9346151ed287745ac67f1a3296f231f.jpg" alt="Sapi perah" class="h-full w-full object-cover" />
    </div>
  </div>
</section>

<!-- PRODUCT CARDS -->
<section id="products" class="bg-farm-green px-10 py-16 lg:px-20">
  <div class="max-w-7xl mx-auto">
    <div class="mb-10 text-center text-white">
      <p class="text-sm uppercase tracking-[0.3em] text-[#d8d4be]">Produk Favorit</p>
      <h2 class="mt-3 text-3xl font-bold">Produk Susu dan Olahan Peternakan</h2>
      <p class="mx-auto mt-3 max-w-2xl text-[#e4dcc8]">Produk kami dibuat langsung dari hasil perahan sapi perah, dengan kualitas rasa yang segar dan alami.</p>
    </div>
    <div class="grid gap-4 md:grid-cols-3">
      <div class="rounded-[32px] border border-white/20 bg-[#f4efe6] shadow-sm overflow-hidden">
        <img src="https://i.pinimg.com/736x/1a/8f/18/1a8f184a599ffbe7ece86df16fa4dfcf.jpg" class="w-full h-56 object-cover" alt="Susu Segar" />
        <div class="p-6 text-center">
          <h3 class="text-lg font-semibold text-[#33412e]">Susu Segar</h3>
        </div>
      </div>
      <div class="rounded-[32px] border border-white/20 bg-[#f4efe6] shadow-sm overflow-hidden">
        <img src="https://i.pinimg.com/736x/49/b3/5b/49b35bfa39f4481362f1b9563c0ee82f.jpg" class="w-full h-56 object-cover" alt="Susu Murni" />
        <div class="p-6 text-center">
          <h3 class="text-lg font-semibold text-[#33412e]">Susu Murni</h3>
        </div>
      </div>
      <div class="rounded-[32px] border border-white/20 bg-[#f4efe6] shadow-sm overflow-hidden">
        <img src="https://i.pinimg.com/736x/3e/62/8e/3e628e070b14e22f8831b9d7d03a1e7f.jpg" class="w-full h-56 object-cover" alt="Yogurt" />
        <div class="p-6 text-center">
          <h3 class="text-lg font-semibold text-[#33412e]">Yogurt</h3>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PROMO SECTION -->
<section class="bg-farm-cream px-10 py-16 lg:px-20 text-[#33412e]">
  <div class="max-w-7xl mx-auto grid gap-10 lg:grid-cols-2 items-center">
    <div class="rounded-[40px] overflow-hidden border border-[#d8d4be] shadow-2xl">
      <img src="https://i.pinimg.com/736x/da/6e/49/da6e49bd6cf922dfdabdb300c464b0da.jpg" alt="Produk susu" class="h-full w-full object-cover" />
    </div>
    <div class="space-y-6">
      <span class="inline-flex rounded-full bg-[#e3d7b4] px-4 py-2 text-sm uppercase tracking-[0.3em] text-[#4d624a]">Hasil Peternakan</span>
      <h2 class="text-4xl font-bold leading-tight">Nikmati Susu dan Olahan yang Selalu Segar</h2>
      <p class="max-w-xl text-[#5e6a59]">Dari peternakan sapi perah kami, setiap produk diproses dengan teliti untuk memberikan rasa dan nutrisi terbaik bagi keluarga Anda.</p>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="bg-[#3b4a36] text-white mt-10">
  <div class="bg-[#3f4f3c] px-6 py-8">
    <div class="max-w-6xl mx-auto grid gap-10 lg:grid-cols-[1fr_1.5fr] items-start text-[#e4dcc8]">
      <div class="text-left mt-10 pl-4 lg:pl-0">
        <p class="text-xs uppercase tracking-[0.35em] text-[#d8d4be]">Kontak</p>
        <p class="mt-3 text-lg font-semibold">Cimilk Yogurt</p>
        <p class="mt-2 text-base">Kp. Palasari 2 Babakan Waru RT 26, RW 03, Desa Palasari, Kecamatan Ciater, Kabupaten Subang, Subang, Indonesia, 41280</p>
        <p class="mt-2 text-base">contact: +62 812-3456-7890</p>
        <p class="text-base">instagram: @cimilk.id</p>
      </div>
      <div class="w-full mt-4">
        <iframe src="https://maps.google.com/maps?q=-6.7163390,107.6720960&hl=id&z=15&output=embed" width="100%" height="300" style="border:0; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
    <div class="mt-12 border-t border-white/10 pt-6 text-center text-sm text-[#bfc5a9]">Copyright © 2026 CIMILK. All Rights Reserved.</div>
  </div>
</footer>

</body>
</html>
