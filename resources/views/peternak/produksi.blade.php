<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produksi Susu - Cimilk Yogurt</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        
        .page-title-section { margin-bottom: 30px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; }

        /* Action Bar */
        .action-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; gap: 15px; }
        .search-wrapper {
            background: #e6d5c0;
            border: 3px solid #a67c52;
            padding: 10.5px 15px;
            border-radius: 12px;
            flex-grow: 1;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .search-input-group { display: flex; align-items: center; width: 100%; gap: 10px; }
        .search-input-group i { color: #5a1f12; font-size: 18px; }
        .search-input-group input {
            background: transparent; border: none; outline: none; width: 100%;
            padding: 0px 15px; font-family: 'Quicksand', sans-serif;
            font-weight: 600; color: #432118; font-size: 15px;
        }
        .search-input-group input::placeholder { color: #845a33; opacity: 0.7; }

        .btn-add {
            border: none; background: #5d7a54; padding: 10px 20px;
            border-radius: 12px; font-weight: 700; color: #ffffff;
            box-shadow: 0 4px 0 #3a4d33; transition: 0.2s;
            text-decoration: none; white-space: nowrap;
            display: flex; align-items: center;
        }
        .btn-add:hover { background: #4a6344; color: white; transform: translateY(-2px); box-shadow: 0 6px 0 #3a4d33; }
        .btn-add:active { transform: translateY(2px); box-shadow: 0 2px 0 #3a4d33; }

        /* Tabel */
        .custom-table {
            width: 100%;
            overflow-x: auto;
            border-radius: 15px;
            margin-top: 10px;
        }
        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 16px !important; text-transform: uppercase; font-size: 13px; border: 1px solid #bc9f82 !important; }
        .table tbody td { padding: 12px 16px !important; border: 1px solid #bc9f82 !important; font-weight: 600; background: white; }
        
        .form-control-sm-custom {
            border: 1px solid #bc9f82;
            border-radius: 8px;
            padding: 5px 10px;
            width: 80px;
            text-align: center;
            font-weight: 700;
            background: #fffdfa;
        }
        .total-badge {
            background: #f0e2d0;
            padding: 5px 15px;
            border-radius: 8px;
            border: 1px solid #bc9f82;
            font-weight: 800;
            color: #432118;
            display: inline-block;
            min-width: 60px;
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Produksi Susu', 'pageSubtitle' => 'Catat hasil produksi susu harian'])
    <div class="main-content">
        <div class="page-title-section">
            <h3>Produksi Susu 🥛</h3>
            <p>Catat hasil produksi susu harian.</p>
        </div>
        
        <div class="action-bar">
            <div class="search-wrapper">
                <div class="search-input-group">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari data produksi..">
                </div>
            </div>
            @if(Auth::user()->role !== 'Admin')
            <button type="button" class="btn-add" onclick="alert('Fitur simpan otomatis atau tombol simpan akan ditambahkan.')">
                <i class="fa-solid fa-save me-2"></i> Simpan Data Produksi
            </button>
            @endif
        </div>

        <div class="custom-table">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px;">NO</th>
                            <th>ID SAPI</th>
                            <th>HASIL PAGI (LITER)</th>
                            <th>HASIL SORE (LITER)</th>
                            <th class="text-center">TOTAL</th>
                            @if(Auth::user()->role !== 'Admin')
                            <th class="text-center">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="produksiTableBody">
                        @php
                            $cows = [
                                ['id' => 'ID-01', 'pagi' => 100, 'sore' => 0],
                                ['id' => 'ID-02', 'pagi' => 0, 'sore' => 0],
                                ['id' => 'ID-03', 'pagi' => 0, 'sore' => 0],
                            ];
                        @endphp
                        @foreach($cows as $index => $cow)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $cow['id'] }}</td>
                            <td>
                                @if(Auth::user()->role !== 'Admin')
                                <input type="number" class="form-control-sm-custom" value="{{ $cow['pagi'] }}" step="0.1">
                                @else
                                {{ $cow['pagi'] }} L
                                @endif
                            </td>
                            <td>
                                @if(Auth::user()->role !== 'Admin')
                                <input type="number" class="form-control-sm-custom" value="{{ $cow['sore'] }}" step="0.1">
                                @else
                                {{ $cow['sore'] }} L
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="total-badge">0.0 L</span>
                            </td>
                            @if(Auth::user()->role !== 'Admin')
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-success border-0"><i class="fa-solid fa-check-circle"></i></button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#produksiTableBody tr');
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
