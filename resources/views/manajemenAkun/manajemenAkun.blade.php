<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun - Cimilk Yogurt</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #dcc8ae; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }

        /* Sidebar */
        .sidebar { width: 260px; height: 100vh; background: #f0e2d0; position: fixed; padding: 30px 20px; border-right: 8px solid #5d7a54; box-shadow: 5px 0 15px rgba(0,0,0,0.1); }
        .brand h4 { font-family: 'Fredoka One', cursive; color: #432118; font-size: 24px; margin-bottom: 0; }
        .brand p { font-size: 14px; color: #845a33; margin-bottom: 40px; }
        .nav-menu { list-style: none; padding: 0; }
        .nav-item { margin-bottom: 12px; }
        .nav-link { text-decoration: none; color: #6d4c41; padding: 12px 18px; display: flex; align-items: center; border-radius: 15px; transition: 0.3s; font-weight: 700; }
        .nav-link i { margin-right: 12px; width: 20px; text-align: center; }
        .nav-link:hover, .nav-link.active { background: #5d7a54; color: #ffffff !important; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }

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
            padding: 10.5px 15px;
            border-radius: 12px;
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
            padding: 0px 15px;
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

        /* Tabel */
        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 16px !important; text-transform: uppercase; font-size: 13px; border: 1px solid #bc9f82 !important; }
        .table tbody td { padding: 16px !important; border: 1px solid #bc9f82 !important; font-weight: 600; }

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

        .badge-role { padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .badge-admin { background-color: #d1fae5; color: #065f46; }
        .badge-peternak { background-color: #ede9fe; color: #5b21b6; }
        .badge-penjualan { background-color: #ffedd5; color: #c2410c; }

        /* Modal Floating Styling */
        .modal-transparent {
            background: transparent !important;
        }
        .modal-content-custom {
            background: transparent;
            border: none;
            box-shadow: none;
        }
        .modal-backdrop.show {
            opacity: 0.6;
            background-color: #000;
        }
        .iframe-container {
            width: 100%;
            height: 765px;
            border: none;
            overflow: hidden;
        }
        .iframe-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }


    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        @if(session('success') || request()->query('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 15px; font-weight: 600;">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') ?? request()->query('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="header">
            <div class="welcome-text">
                <h3 class="fw-bold mb-0" style="font-family: 'Fredoka One';">Daftar Akun Pengguna</h3>
                <p style="color: #6d4c41; font-weight: 600; margin-bottom: 0;">Kelola semua akun pengguna sistem.</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-sign-out-alt me-2"></i>Keluar
                </button>
            </form>
        </div>

        <div class="action-bar">
            <div class="search-wrapper">
                <div class="search-input-group">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama atau username pengguna...">
                </div>
            </div>
            <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#registerModal">
                <i class="fa-solid fa-user-plus me-2"></i> Tambah Akun
            </button>
        </div>

        <div class="custom-table">
            <table class="table table-bordered-custom align-middle">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>USERNAME</th>
                        <th>NAMA LENGKAP</th>
                        <th>ROLE</th>
                        <th>STATUS</th>
                        <th>TANGGAL DIBUAT</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    @foreach($users as $index => $user)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $user->username ?? '-' }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @php
                                $roleClass = 'badge-admin';
                                $roleText = 'admin';
                                if($user->role == 'Peternak') { $roleClass = 'badge-peternak'; $roleText = 'peternak'; }
                                elseif($user->role == 'Penjualan') { $roleClass = 'badge-penjualan'; $roleText = 'manajemen penjualan'; }
                            @endphp
                            <span class="badge-role {{ $roleClass }}">{{ $roleText }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $user->status == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                                {{ $user->status }}
                            </span>
                        </td>
                        <td>{{ $user->created_at ? $user->created_at->format('Y-m-d') : '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('manajemen-akun.edit', $user->id) }}" class="btn btn-sm btn-outline-primary shadow-sm">Edit</a>
                                <form action="{{ route('manajemen-akun.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr id="noDataRow" style="display: none;">
                        <td colspan="7" class="text-center py-5">
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


    <!-- Modal Register -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="iframe-container">
                    <iframe src="{{ route('manajemen-akun.create', ['mode' => 'modal']) }}" scrolling="no"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#userTableBody tr:not(#noDataRow)');
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
