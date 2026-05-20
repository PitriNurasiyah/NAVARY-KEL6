<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siklus Sapi - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">

    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        .page-title-section { margin-bottom: 25px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; font-size: 14px; }

        .crud-notification {
            display: flex; align-items: center; gap: 12px; padding: 15px 25px; border-radius: 12px;
            font-weight: 700; font-size: 14px; margin-bottom: 25px; animation: fadeInDown 0.4s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .crud-notification.success { background: #dcfce7; border: 2px solid #22c55e; color: #166534; }
        .crud-notification.error { background: #fee2e2; border: 2px solid #ef4444; color: #991b1b; }
        
        .notif-close {
            margin-left: auto; background: none; border: none; color: inherit;
            font-size: 18px; cursor: pointer; opacity: 0.5; transition: 0.2s;
            display: flex; align-items: center; justify-content: center;
        }
        .notif-close:hover { opacity: 1; }

        .btn-add { border: none; background: #5d7a54; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; text-decoration: none; }
        .btn-add:hover { background: #4a6344; color: #fff; }

        .action-bar { display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 25px; }
        .search-wrapper { background: #e6d5c0; border: 3px solid #a67c52; padding: 5px 15px; border-radius: 12px; flex-grow: 1; display: flex; align-items: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .search-input-group { display: flex; align-items: center; flex-grow: 1; }
        .search-input-group i { color: #5a1f12; font-size: 18px; }
        .search-input-group input { background: transparent; border: none; outline: none; width: 100%; padding: 8px 15px; font-family: 'Quicksand', sans-serif; font-weight: 600; color: #432118; font-size: 15px; }

        .nav-tabs-custom { display: flex; gap: 10px; margin-bottom: 25px; border-bottom: 2px solid #bc9f82; padding-bottom: 5px; overflow-x: auto; }
        .nav-link-custom { padding: 10px 20px; border-radius: 10px 10px 0 0; font-weight: 700; color: #6d4c41; text-decoration: none; transition: 0.2s; white-space: nowrap; }
        .nav-link-custom.active { background: #4a6344; color: white; }

        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 16px !important; text-transform: uppercase; font-size: 13px; border: 1px solid #bc9f82 !important; }
        .table tbody td { padding: 16px !important; border: 1px solid #bc9f82 !important; background: white; }
        .custom-table { width: 100%; overflow-x: auto; border-radius: 15px; }

        /* Custom Delete Confirm Modal */
        .confirm-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 9999; align-items: center; justify-content: center; }
        .confirm-overlay.active { display: flex; }
        .confirm-box { background: #f5efe6; border-radius: 20px; padding: 35px 40px; max-width: 420px; width: 90%; box-shadow: 0 20px 50px rgba(0,0,0,0.3); text-align: center; border: 6px solid #8CA685; animation: popIn 0.25s ease; }
        @keyframes popIn { from { transform: scale(0.85); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .confirm-icon { font-size: 48px; color: #c0392b; margin-bottom: 15px; }
        .confirm-box h5 { font-family: 'Fredoka One', cursive; color: #432118; font-size: 20px; margin-bottom: 8px; }
        .confirm-box p { color: #6d4c41; font-weight: 600; font-size: 14px; margin-bottom: 25px; }
        .confirm-actions { display: flex; gap: 12px; justify-content: center; }
        .btn-confirm-yes { background: #c0392b; color: #fff; border: none; padding: 10px 28px; border-radius: 12px; font-weight: 700; box-shadow: 0 4px 0 #922b21; cursor: pointer; transition: 0.2s; }
        .btn-confirm-yes:active { transform: translateY(3px); box-shadow: 0 1px 0 #922b21; }
        .btn-confirm-no { background: #e2e8f0; color: #475569; border: none; padding: 10px 28px; border-radius: 12px; font-weight: 700; cursor: pointer; }
        .btn-confirm-no:hover { background: #cbd5e1; }

        .chart-container { background: white; padding: 25px; border-radius: 15px; border: 2px solid #bc9f82; margin-top: 25px; display: none; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .chart-container.active { display: block; animation: fadeInDown 0.4s ease; }
        .chart-title { font-family: 'Fredoka One', cursive; color: #432118; font-size: 20px; margin-bottom: 20px; text-align: center; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Siklus Sapi', 'pageSubtitle' => 'Pantau siklus reproduksi sapi'])

    <div class="main-content">
        <div class="page-title-section">
            <h3>Siklus Sapi ⏳</h3>
            <p>Monitor tahapan reproduksi sapi dari IB hingga Kering Kandang.</p>
        </div>

        @if(session('success'))
            <div class="crud-notification success" id="crudNotif">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
                <button class="notif-close" onclick="document.getElementById('crudNotif').remove()"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        <div class="nav-tabs-custom">
            <a href="#" class="nav-link-custom active" onclick="filterFase('all', this)">All</a>
            <a href="#" class="nav-link-custom" onclick="filterFase('IB', this)">IB</a>
            <a href="#" class="nav-link-custom" onclick="filterFase('Bunting', this)">Bunting</a>
            <a href="#" class="nav-link-custom" onclick="filterFase('Melahirkan', this)">Melahirkan</a>
            <a href="#" class="nav-link-custom" onclick="filterFase('Laktasi', this)">Laktasi</a>
            <a href="#" class="nav-link-custom" onclick="filterFase('Kering Kandang', this)">Kering Kandang</a>
        </div>

        <div class="action-bar">
            <div class="search-wrapper">
                <div class="search-input-group">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari data siklus berdasarkan nama sapi...">
                </div>
            </div>
            @if(Auth::user()->role === 'Peternak')
            <a href="{{ route('siklus.create') }}" class="btn btn-add"><i class="fa-solid fa-plus me-2"></i>Tambah Siklus</a>
            @endif
        </div>

        <div class="custom-table">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>ID SAPI</th>
                        <th>NAMA SAPI</th>
                        <th>FASE</th>
                        <th>MULAI</th>
                        <th>HARI KE</th>
                        <th>ESTIMASI</th>
                        <th>KETERANGAN</th>
                        <th class="text-center">STATUS</th>
                        @if(Auth::user()->role === 'Peternak')
                        <th class="text-center">AKSI</th>
                        @endif
                    </tr>
                </thead>
                <tbody id="siklusTableBody">
                    @forelse($siklus as $index => $item)
                    <tr data-fase="{{ $item->fase }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->sapi->kode_sapi ?? 'N/A' }}</td>
                        <td class="fw-bold">{{ $item->sapi->nama ?? 'N/A' }}</td>
                        <td><span class="badge bg-info text-dark px-3">{{ $item->fase }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }}</td>
                        <td>{{ $item->hari_ke }} Hari</td>
                        <td>{{ $item->estimasi_selesai ? \Carbon\Carbon::parse($item->estimasi_selesai)->format('d/m/Y') : '-' }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td class="text-center"><span class="badge {{ $item->status == 'Selesai' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $item->status }}</span></td>
                        @if(Auth::user()->role === 'Peternak')
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                @if($item->fase === 'Laktasi')
                                <button type="button" class="btn btn-sm btn-outline-info shadow-sm fw-bold" onclick="openProduksi('{{ $item->sapi_id }}', '{{ addslashes($item->sapi->nama ?? 'Sapi') }}')"><i class="fa-solid fa-plus"></i> Input Produksi</button>
                                @endif
                                <a href="{{ route('siklus.edit', $item->id) }}" class="btn btn-sm btn-outline-primary shadow-sm">Edit</a>
                                <button type="button" class="btn btn-sm btn-outline-danger shadow-sm" onclick="confirmDelete('{{ route('siklus.destroy', $item->id) }}', '{{ $item->sapi->nama ?? 'Sapi' }}')">Hapus</button>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr id="noDataRow">
                        <td colspan="10" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="fa-solid fa-clock-rotate-left mb-3" style="font-size: 48px; color: #a67c52; opacity: 0.4;"></i>
                                <h5 class="fw-bold mb-1" style="color: #432118;">Data Belum Ada</h5>
                                <p class="text-muted mb-0">Belum ada data siklus sapi yang tersimpan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="chart-container" id="laktasiChartContainer">
            <h4 class="chart-title">Grafik Pemantauan Laktasi Sapi (Per 100 Hari)</h4>
            <canvas id="laktasiChart" height="100"></canvas>
        </div>
    </div>
    <div class="confirm-overlay" id="confirmOverlay">
        <div class="confirm-box">
            <div class="confirm-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h5>Hapus Data Siklus?</h5>
            <p id="confirmMessage">Yakin ingin menghapus data ini?</p>
            <div class="confirm-actions">
                <button class="btn-confirm-yes" id="confirmYesBtn">Ya, Hapus</button>
                <button class="btn-confirm-no" onclick="closeConfirm()">Batal</button>
            </div>
        </div>
    </div>

    <!-- Modal Input Produksi Susu -->
    <div class="confirm-overlay" id="produksiOverlay">
        <div class="confirm-box" style="max-width: 500px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="m-0 text-start" style="font-family: 'Fredoka One', cursive; color: #432118; font-size: 20px;"><i class="fa-solid fa-droplet text-info me-2"></i>Input Produksi Susu</h5>
                <button type="button" class="btn-close" onclick="closeProduksi()"></button>
            </div>
            <form action="{{ route('siklus.storeProduksi') }}" method="POST" id="formProduksiSusu">
                @csrf
                <input type="hidden" name="sapi_id" id="produksiSapiId">
                <p class="text-start mb-3" style="color: #6d4c41; font-weight: 600; font-size: 14px;">Sapi: <span id="produksiSapiNama" class="badge bg-primary"></span></p>
                
                <div class="mb-3 text-start">
                    <label class="form-label" style="font-weight: 700; color: #5a2c1b; font-size: 14px;">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" style="border-radius: 10px; border: 2px solid #a67c52; padding: 10px; background-color: #fffdfa;" required>
                </div>
                <div class="row text-start mb-4">
                    <div class="col-6">
                        <label class="form-label" style="font-weight: 700; color: #5a2c1b; font-size: 14px;">Susu Pagi (L)</label>
                        <input type="number" step="0.01" name="jumlah_pagi" class="form-control" placeholder="0" style="border-radius: 10px; border: 2px solid #a67c52; padding: 10px; background-color: #fffdfa;">
                    </div>
                    <div class="col-6">
                        <label class="form-label" style="font-weight: 700; color: #5a2c1b; font-size: 14px;">Susu Sore (L)</label>
                        <input type="number" step="0.01" name="jumlah_sore" class="form-control" placeholder="0" style="border-radius: 10px; border: 2px solid #a67c52; padding: 10px; background-color: #fffdfa;">
                    </div>
                </div>
                <div class="confirm-actions">
                    <button type="submit" class="btn-confirm-yes" style="background: #5d7a54; box-shadow: 0 4px 0 #3a4d33;">Simpan Data</button>
                    <button type="button" class="btn-confirm-no" onclick="closeProduksi()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterFase(fase, element) {
            document.querySelectorAll('.nav-link-custom').forEach(link => link.classList.remove('active'));
            element.classList.add('active');
            let rows = document.querySelectorAll('#siklusTableBody tr:not(#noDataRow)');
            rows.forEach(row => {
                row.style.display = (fase === 'all' || row.getAttribute('data-fase') === fase) ? '' : 'none';
            });

            // Tampilkan grafik hanya jika tab Laktasi dipilih
            if(fase === 'Laktasi') {
                document.getElementById('laktasiChartContainer').classList.add('active');
            } else {
                document.getElementById('laktasiChartContainer').classList.remove('active');
            }
        }
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#siklusTableBody tr:not(#noDataRow)');
            rows.forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
            });
        });
        let deleteUrl = '';
        function confirmDelete(url, name) {
            deleteUrl = url;
            document.getElementById('confirmMessage').textContent = 'Hapus siklus sapi "' + name + '"?';
            document.getElementById('confirmOverlay').classList.add('active');
        }
        function closeConfirm() { document.getElementById('confirmOverlay').classList.remove('active'); }
        document.getElementById('confirmYesBtn').addEventListener('click', function() {
            const form = document.getElementById('deleteForm'); form.action = deleteUrl; form.submit();
        });

        function openProduksi(sapiId, sapiNama) {
            document.getElementById('produksiSapiId').value = sapiId;
            document.getElementById('produksiSapiNama').textContent = sapiNama;
            document.getElementById('produksiOverlay').classList.add('active');
        }

        function closeProduksi() {
            document.getElementById('produksiOverlay').classList.remove('active');
            document.getElementById('formProduksiSusu').reset();
            document.getElementById('formProduksiSusu').querySelector('input[name="tanggal"]').value = new Date().toISOString().split('T')[0];
        }

        // Setup Chart
        const chartDataRaw = @json($laktasiChartData ?? []);
        if (chartDataRaw.length > 0) {
            const labels = chartDataRaw.map(d => d.nama);
            const data100 = chartDataRaw.map(d => d.produksi100);
            const data200 = chartDataRaw.map(d => d.produksi200);
            const data300 = chartDataRaw.map(d => d.produksi300);

            const ctx = document.getElementById('laktasiChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        { label: '100 Hari Pertama (L)', data: data100, backgroundColor: '#8CA685', borderColor: '#4a6344', borderWidth: 1 },
                        { label: '100 Hari Kedua (L)', data: data200, backgroundColor: '#c0a080', borderColor: '#a67c52', borderWidth: 1 },
                        { label: '100 Hari Ketiga (L)', data: data300, backgroundColor: '#d1b99a', borderColor: '#b69772', borderWidth: 1 }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true, title: { display: true, text: 'Total Produksi (Liter)' } }
                    },
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        }
    </script>
</body>
</html>
