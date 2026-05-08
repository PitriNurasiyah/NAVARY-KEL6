<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }

        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }

        .page-title-section { margin-bottom: 25px; display: flex; justify-content: space-between; align-items: flex-end; }
        .page-title-section .left h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section .left p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        /* Toggle Buttons */
        .toggle-group {
            background: #fffdfa;
            padding: 5px;
            border-radius: 12px;
            display: flex;
            gap: 5px;
            border: 2px solid #a67c52;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .btn-toggle {
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-toggle.active { background: #432118; color: white !important; }
        .btn-toggle:not(.active) { color: #6d4c41; }
        .btn-toggle:not(.active):hover { background: #f0e2d0; }

        /* Chart Card */
        .chart-card {
            background: white;
            border-radius: 25px;
            padding: 35px;
            border: 3px solid #bc9f82;
            box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        }

        .chart-container { position: relative; height: 400px; width: 100%; }

        /* Legend */
        .chart-legend {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 25px;
            font-weight: 700;
            color: #432118;
            font-size: 14px;
        }
        .legend-item { display: flex; align-items: center; gap: 8px; }
        .dot { width: 12px; height: 12px; border-radius: 50%; display: inline-block; }
    </style>
</head>
<body>

    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Laporan Bulanan', 'pageSubtitle' => 'Visualisasi tren penjualan bulanan'])

    <div class="main-content">
        
        <div class="page-title-section">
            <div class="left">
                <h3>Tren Penjualan 📈</h3>
                <p>Visualisasi performa penjualan dari waktu ke waktu</p>
            </div>
            <div class="toggle-group">
                <button onclick="updateChart('daily')" class="btn-toggle" id="btnHarian">
                    <i class="fa-solid fa-calendar-day"></i> Harian
                </button>
                <button onclick="updateChart('monthly')" class="btn-toggle active" id="btnBulanan">
                    <i class="fa-solid fa-calendar-week"></i> Bulanan
                </button>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>

            <div class="chart-legend">
                <div class="legend-item">
                    <span class="dot" style="background: #5d7a54;"></span> Volume (Liter)
                </div>
                <div class="legend-item">
                    <span class="dot" style="background: #bc9f82;"></span> Pendapatan (Rp)
                </div>
            </div>
        </div>

        <div class="mt-4 text-end">
            <button class="btn btn-dark rounded-pill px-4" onclick="window.print()" style="font-weight: 700;">
                <i class="fa-solid fa-print me-2"></i> Cetak Grafik
            </button>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        const mData = {
            labels: @json($m_labels),
            liters: @json($m_liters),
            revenues: @json($m_revenues)
        };

        const dData = {
            labels: @json($d_labels),
            liters: @json($d_liters),
            revenues: @json($d_revenues)
        };

        let salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: mData.labels,
                datasets: [
                    {
                        label: 'Volume (Liter)',
                        data: mData.liters,
                        borderColor: '#5d7a54',
                        backgroundColor: 'rgba(93, 122, 84, 0.1)',
                        borderWidth: 4,
                        tension: 0.4,
                        pointRadius: 6,
                        pointBackgroundColor: '#5d7a54',
                        yAxisID: 'y',
                    },
                    {
                        label: 'Pendapatan (Rp)',
                        data: mData.revenues,
                        borderColor: '#bc9f82',
                        backgroundColor: 'rgba(188, 159, 130, 0.1)',
                        borderWidth: 4,
                        tension: 0.4,
                        pointRadius: 6,
                        pointBackgroundColor: '#bc9f82',
                        yAxisID: 'y1',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(67, 33, 24, 0.9)',
                        padding: 12,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        cornerRadius: 10,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) label += ': ';
                                if (context.datasetIndex === 1) {
                                    label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                } else {
                                    label += context.parsed.y + ' L';
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        type: 'linear', display: true, position: 'left',
                        title: { display: true, text: 'Liter', font: { weight: 'bold' } },
                        grid: { color: '#f0f0f0' }
                    },
                    y1: {
                        type: 'linear', display: true, position: 'right',
                        title: { display: true, text: 'Rupiah', font: { weight: 'bold' } },
                        grid: { drawOnChartArea: false }
                    },
                    x: { grid: { display: false }, ticks: { font: { weight: 'bold' } } }
                }
            }
        });

        function updateChart(type) {
            const btnH = document.getElementById('btnHarian');
            const btnB = document.getElementById('btnBulanan');
            
            if (type === 'daily') {
                salesChart.data.labels = dData.labels;
                salesChart.data.datasets[0].data = dData.liters;
                salesChart.data.datasets[1].data = dData.revenues;
                btnH.classList.add('active');
                btnB.classList.remove('active');
            } else {
                salesChart.data.labels = mData.labels;
                salesChart.data.datasets[0].data = mData.liters;
                salesChart.data.datasets[1].data = mData.revenues;
                btnB.classList.add('active');
                btnH.classList.remove('active');
            }
            salesChart.update();
        }
    </script>
</body>
</html>
