<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Cimilk Yogurt</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f4efe6;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            display: flex;
            color: #432118;
            overflow-x: hidden;
        }

        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 45px;
        }

        .notification-bar {
            background: #fffcf7;
            border: 1.5px solid #e6d5c0;
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 35px;
            font-size: 14px;
            color: #432118;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        }

        .stat-card {
            background: #fffcf7;
            padding: 25px;
            border-radius: 25px;
            border: 1.5px solid #e6d5c0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: #bc9f82;
            box-shadow: 0 12px 25px rgba(0,0,0,0.08);
        }

        .stat-info h2 {
            font-family: 'Playfair Display', serif;
            margin: 5px 0;
            font-size: 38px;
            font-weight: 700;
            color: #432118;
        }
        .stat-info span { color: #845a33; font-weight: 700; text-transform: uppercase; font-size: 12px; }
        .stat-unit { color: #5d7a54; font-weight: 800; }

        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .bg-custom-green { background: #5d7a54; color: #ffffff; }
        .bg-custom-brown { background: #845a33; color: #ffffff; }
        .bg-custom-tan { background: #a67c52; color: #ffffff; }

        /* Page title below header */
        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }
    </style>
</head>
<body>

    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Dashboard Admin', 'pageSubtitle' => 'Selamat datang di panel Admin'])

    <div class="main-content">

        <div class="page-title-section">
            <h3>Hallo, {{ Auth::user()->name ?? 'Admin' }}! 🐮</h3>
            <p>Selamat datang kembali di dashboard admin.</p>
        </div>

        @if(session('success'))
        <div class="notification-bar alert alert-dismissible fade show" role="alert" style="background-color: #dcfce7; border-color: #22c55e; color: #166534;">
            <i class="fa-solid fa-circle-check me-2"></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @else
        <div class="notification-bar alert alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-bell me-2" style="color: #152414;"></i>
            <strong>Update Sistem:</strong> Sinkronisasi data berhasil. Selamat bekerja, {{ Auth::user()->name ?? 'Admin' }}!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row g-4">
            <div class="col-md-4">
                <a href="{{ route('sapi.index') }}" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="stat-info">
                            <span>Populasi Sapi</span>
                            <h2>{{ $totalSapi ?? 0 }}</h2>
                            <div class="stat-unit">Ekor</div>
                        </div>
                        <div class="icon-circle bg-custom-green"><i class="fa-solid fa-paw"></i></div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('produksi.index') }}" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="stat-info">
                            <span>Hasil Produksi</span>
                            <h2>{{ $totalProduksi ?? 0 }}</h2>
                            <div class="stat-unit">Liter Susu</div>
                        </div>
                        <div class="icon-circle bg-custom-brown"><i class="fa-solid fa-bucket"></i></div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('penjualan.data') }}" class="text-decoration-none">
                    <div class="stat-card">
                        <div class="stat-info">
                            <span>Omzet Penjualan</span>
                            <h2>Rp{{ number_format($totalPenjualan ?? 0, 0, ',', '.') }}</h2>
                            <div class="stat-unit">Rupiah</div>
                        </div>
                        <div class="icon-circle bg-custom-tan"><i class="fa-solid fa-coins"></i></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row g-4 mt-2">
            <div class="col-12">
                <div class="stat-card" style="display: block; padding: 25px;">
                    <h3 style="font-family: 'Fredoka One', cursive; font-size: 20px; color: #432118; margin-bottom: 20px;">Grafik Ringkasan</h3>
                    <div style="position: relative; height: 350px; width: 100%;">
                        <canvas id="dashboardChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('dashboardChart').getContext('2d');
            var dashboardChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Populasi Sapi', 'Hasil Produksi', 'Omzet Penjualan'],
                    datasets: [{
                        label: 'Statistik',
                        data: [
                            {{ $totalSapi ?? 0 }}, 
                            {{ $totalProduksi ?? 0 }}, 
                            {{ ($totalPenjualan ?? 0) / 1000 }} // Scale down Omzet for better visualization
                        ],
                        backgroundColor: [
                            'rgba(93, 122, 84, 0.8)',  // Green
                            'rgba(132, 90, 51, 0.8)',  // Brown
                            'rgba(166, 124, 82, 0.8)'  // Tan
                        ],
                        borderColor: [
                            '#5d7a54',
                            '#845a33',
                            '#a67c52'
                        ],
                        borderWidth: 2,
                        borderRadius: 8,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(166, 124, 82, 0.2)',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#432118',
                                font: {
                                    family: 'Quicksand',
                                    weight: 'bold'
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                color: '#432118',
                                font: {
                                    family: 'Quicksand',
                                    weight: 'bold',
                                    size: 14
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#432118',
                            titleFont: { family: 'Quicksand', size: 14 },
                            bodyFont: { family: 'Quicksand', size: 14, weight: 'bold' },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    let value = context.parsed.y;
                                    if (context.dataIndex === 0) {
                                        return value + ' Ekor';
                                    } else if (context.dataIndex === 1) {
                                        return value + ' Liter Susu';
                                    } else if (context.dataIndex === 2) {
                                        return 'Rp ' + (value * 1000).toLocaleString('id-ID');
                                    }
                                    return value;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
