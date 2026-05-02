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
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        
        .page-title-section { margin-bottom: 30px; }
        .page-title-section h3 { font-family: 'Fredoka One', cursive; font-size: 26px; color: #432118; margin: 0 0 4px 0; }
        .page-title-section p { color: #6d4c41; font-weight: 600; margin: 0; }

        /* Action Bar */
        .action-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; gap: 20px; }
        .search-wrapper {
            flex: 1; background: #f5efe6; border-radius: 20px; padding: 10px 20px;
            display: flex; align-items: center; border: 3px solid #bc9f82;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
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
            background: #5d7a54; color: white; border: none; padding: 12px 24px;
            border-radius: 15px; font-weight: 700; display: flex; align-items: center;
            text-decoration: none; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s;
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
        .table tbody td { padding: 16px !important; border: 1px solid #bc9f82 !important; font-weight: 600; background: white; }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Manajemen Pakan', 'pageSubtitle' => 'Catat jenis pakan dan pemberian pakan'])
    <div class="main-content">
        <div class="page-title-section">
            <h3>Manajemen Pakan 🌾</h3>
        </div>
        
        <div class="action-bar">
            <div class="search-wrapper">
                <div class="search-input-group">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari data pakan..">
                </div>
            </div>
            <a href="#" class="btn-add">
                <i class="fa-solid fa-plus me-2"></i> Input Pakan Baru
            </a>
        </div>

        <div class="custom-table">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA PAKAN</th>
                            <th>STOK (KG)</th>
                            <th>TANGGAL PEMBERIAN</th>
                            <th>KETERANGAN</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="pakanTableBody">
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fa-solid fa-seedling mb-3" style="font-size: 48px; color: #a67c52; opacity: 0.4;"></i>
                                    <h5 class="fw-bold mb-1" style="color: #432118;">Data Belum Ada</h5>
                                    <p class="text-muted mb-0">Belum ada data pemberian pakan yang tersimpan.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#pakanTableBody tr');
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
