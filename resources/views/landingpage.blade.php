<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cimilk Dairy Farm | Segar. Lokal. Terpercaya.</title>
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
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="font-bold text-xl font-serif-title tracking-tight text-#">CIMILK</h1>
            <div class="space-x-6 text-xs uppercase font-semibold">
                <a href="/register" class="hover:text-farm-soft transition">BUAT AKUN</a>
                <a href="/login" class="bg-farm-brown px-5 py-2 rounded-lg font-bold hover:bg-opacity-90 transition">LOGIN</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
<section class="grid md:grid-cols-2 gap-6 items-center px-10 py-16">
  <div>
    <h2 class="text-4xl font-bold text-[#4b5d46] mb-4">Snack Enak Setiap Hari</h2>
    <p class="text-gray-600 mb-6">Nikmati berbagai cemilan lezat dengan kualitas terbaik dan harga terjangkau.</p>
    <button class="bg-[#4b5d46] text-white px-6 py-3 rounded-full">Lihat Produk</button>
  </div>
  <img src="https://i.pinimg.com/1200x/a9/34/61/a9346151ed287745ac67f1a3296f231f.jpg" class="rounded-xl shadow-lg" />
</section>

<!-- CATEGORY CARDS -->
<section class="px-10 py-10 grid md:grid-cols-4 gap-6 text-center">
  <div class="bg-white p-4 rounded-xl shadow">
    <img src="https://i.pinimg.com/736x/1a/8f/18/1a8f184a599ffbe7ece86df16fa4dfcf.jpg" class="mx-auto h-20" />
    <p class="mt-2">Susu Segar</p>
  </div>
  <div class="bg-white p-4 rounded-xl shadow">
    <img src="https://i.pinimg.com/736x/49/b3/5b/49b35bfa39f4481362f1b9563c0ee82f.jpg" class="mx-auto h-20" />
    <p class="mt-2">Susu Murni</p>
  </div>
  <div class="bg-white p-4 rounded-xl shadow">
    <img src="https://i.pinimg.com/736x/3e/62/8e/3e628e070b14e22f8831b9d7d03a1e7f.jpg" class="mx-auto h-20" />
    <p class="mt-2">Yogurt</p>
  </div>
  <div class="bg-white p-4 rounded-xl shadow">
    <img src="https://images.unsplash.com/photo-1576402187878-974f70c890a5" class="mx-auto h-20" />
    <p class="mt-2">Minuman</p>
  </div>
</section>

<!-- PRODUCT SECTION -->
<section class="px-10 py-10">
  <h3 class="text-2xl font-bold text-[#4b5d46] mb-6">Produk Unggulan</h3>
  <div class="grid md:grid-cols-3 gap-6">
    <div class="bg-[#4b5d46] text-white p-6 rounded-xl">
      <h4 class="text-lg font-semibold">Snack Ringan</h4>
      <p class="text-sm mt-2">Cemilan gurih dan renyah</p>
    </div>
    <div class="bg-[#6b7f6a] text-white p-6 rounded-xl">
      <h4 class="text-lg font-semibold">Snack Sehat</h4>
      <p class="text-sm mt-2">Pilihan sehat untuk kamu</p>
    </div>
    <div class="bg-[#8fa88f] text-white p-6 rounded-xl">
      <h4 class="text-lg font-semibold">Snack Manis</h4>
      <p class="text-sm mt-2">Manis dan lezat</p>
    </div>
  </div>
</section>

<!-- PROMO SECTION -->
<section class="px-10 py-10 grid md:grid-cols-2 gap-6">
  <img src="https://i.pinimg.com/736x/da/6e/49/da6e49bd6cf922dfdabdb300c464b0da.jpg" class="rounded-xl" />
  <div class="bg-[#4b5d46] text-white p-10 rounded-xl flex flex-col justify-center">
    <h3 class="text-2xl font-bold">Promo Spesial!</h3>
    <p class="mt-4">Dapatkan diskon hingga 30% untuk produk pilihan.</p>
    <button class="mt-6 bg-yellow-300 text-black px-6 py-2 rounded-full">Beli Sekarang</button>
  </div>
</section>

<!-- FOOTER -->
<footer class="bg-[#3b4a36] text-white text-center py-6 mt-10">
  <p>© 2026 CIMILK. All Rights Reserved.</p>
</footer>

</body>
</html>
