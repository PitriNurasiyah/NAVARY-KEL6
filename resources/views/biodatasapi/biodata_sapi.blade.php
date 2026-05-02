<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Sapi - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&family=Fredoka+One&display=swap" rel="stylesheet">

    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }

        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }

        .btn-add { border: none; background: #5d7a54; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; text-decoration: none; }
        .btn-add:hover { background: #4a6344; color: #fff; }

        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start; 
            gap: 15px;
            margin-bottom: 25px;
        }

        .search-wrapper {
            background: #e6d5c0;
            border: 3px solid #a67c52;
            padding: 3px 15px;
            border-radius: 15px;
            flex-grow: 1;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .search-input-group {
            display: flex;
            align-items: center;
            flex-grow: 1;
            margin-right: 15px;
        }

        .search-input-group i {
            color: #5a1f12;
            font-size: 18px;
        }

        .search-input-group input {
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
            padding: 8px 15px;
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            color: #432118;
            font-size: 15px;
        }

        .search-input-group input::placeholder {
            color: #845a33;
            opacity: 0.7;
        }

        /* Restore shadow for external button */
        .btn-add { 
            box-shadow: 0 4px 0 #3a4d33;
            white-space: nowrap;
        }

        .cow-card { background: #f0e2d0; padding: 25px; border-radius: 25px; border: 3px solid #bc9f82; box-shadow: 0 4px 6px rgba(0,0,0,0.05); min-width: 300px; }
        .cow-card h5 { font-family: 'Fredoka One', cursive; color: #432118; }

        .cards-wrapper {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 5px;
            scrollbar-width: none; 
            -ms-overflow-style: none;  
        }

        .cards-wrapper::-webkit-scrollbar {
            display: none; 
        }

        /* Tabel */
        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 16px !important; text-transform: uppercase; font-size: 13px; border: 1px solid #bc9f82 !important; }
        .table tbody td { padding: 16px !important; border: 1px solid #bc9f82 !important; }

        /* Garis Vertikal Tabel */
        .table-bordered-custom th, .table-bordered-custom td { border-left: 1px solid #bc9f82 !important; }
        .table-bordered-custom th:first-child, .table-bordered-custom td:first-child { border-left: none !important; }

        .table tbody tr:hover { background-color: rgba(93, 122, 84, 0.05) !important; }

        .custom-table {
            width: 100%;
            overflow-x: auto;
            border-radius: 15px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .btn-logout {
            border: none;
            background: #5a1f12;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 700;
            color: #ffffff;
            box-shadow: 0 4px 0 #3a150c;
            transition: 0.2s;
        }

        .btn-logout:active {
            transform: translateY(3px);
            box-shadow: 0 1px 0 #3a150c;
        }
    </style>
</head>
<body>

    @include('layouts.sidebar')

    <div class="main-content">
        <div class="header">
            <div class="welcome-text">
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One', cursive;">Biodata Sapi 🐄</h3>
                <p style="color: #6d4c41; font-weight: 600; margin-bottom: 0;">Data lengkap sapi peternakan.</p>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-sign-out-alt me-2"></i>Keluar
                </button>
            </form>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Space preserved if needed -->
        </div>


        <div class="cards-wrapper mb-4">
            @foreach($sapi as $s)
            <div class="cow-card">
                <h5>{{ $s->nama }}</h5>
                <p>ID: {{ $s->kode_sapi }}<br>Jenis: {{ $s->jenis }}<br>
                Status: <span class="{{ strtolower($s->status_kesehatan) == 'sehat' ? 'text-success' : (strtolower($s->status_kesehatan) == 'sakit' ? 'text-danger' : 'text-warning') }} fw-bold">{{ $s->status_kesehatan }}</span></p>
            </div>
            @endforeach
        </div>

        <div class="action-bar">
            <div class="search-wrapper">
                <div class="search-input-group">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari data sapi berdasarkan nama atau ID...">
                </div>
            </div>
            <a href="{{ route('sapi.create') }}" class="btn btn-add"><i class="fa-solid fa-plus me-2"></i>Tambah Sapi Baru</a>
        </div>

        <div class="custom-table mt-2">
            <table class="table table-bordered-custom align-middle">
                <thead>
                    <tr>
                        <th>ID SAPI</th>
                        <th>NAMA</th>
                        <th>JENIS</th>
                        <th>STATUS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody id="sapiTableBody">
                    @foreach($sapi as $s)
                    <tr>
                        <td>{{ $s->kode_sapi }}</td>
                        <td>{{ $s->nama }}</td>
                        <td>{{ $s->jenis }}</td>
                        <td>
                            <span class="badge {{ strtolower($s->status_kesehatan) == 'sehat' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $s->status_kesehatan }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('sapi.edit', $s->id) }}" class="btn btn-sm btn-outline-primary shadow-sm">Edit</a>
                                <form action="{{ route('sapi.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data sapi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr id="noDataRow" style="display: none;">
                        <td colspan="5" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="fa-solid fa-magnifying-glass mb-3" style="font-size: 48px; color: #a67c52; opacity: 0.4;"></i>
                                <h5 class="fw-bold mb-1" style="color: #432118;">Data Tidak Ditemukan</h5>
                                <p class="text-muted mb-0">Maaf, kami tidak dapat menemukan data yang Anda cari.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#sapiTableBody tr:not(#noDataRow)');
            let visibleCount = 0;

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                if (text.includes(filter)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('noDataRow').style.display = visibleCount === 0 ? '' : 'none';
        });
    </script>
</body>
</html>
