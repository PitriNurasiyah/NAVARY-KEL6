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
        body { background-color: #f5efe6; font-family: 'Quicksand', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
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

        .action-bar { display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 25px; }
        .search-wrapper { background: #e6d5c0; border: 3px solid #a67c52; padding: 5px 15px; border-radius: 12px; flex-grow: 1; display: flex; align-items: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .search-input-group { display: flex; align-items: center; flex-grow: 1; }
        .search-input-group i { color: #152414; font-size: 18px; }
        .search-input-group input { background: transparent; border: none; outline: none; width: 100%; padding: 8px 15px; font-family: 'Quicksand', sans-serif; font-weight: 600; color: #432118; font-size: 15px; }

        .cow-card { background: #f0e2d0; padding: 25px; border-radius: 25px; border: 3px solid #bc9f82; box-shadow: 0 4px 6px rgba(0,0,0,0.05); min-width: 280px; }
        .cow-card h5 { font-family: 'Fredoka One', cursive; color: #432118; }
        .cards-wrapper { display: flex; overflow-x: auto; gap: 20px; padding-bottom: 5px; -ms-overflow-style: none; margin-bottom: 25px; }
        .cards-wrapper::-webkit-scrollbar { display: none; }

        .table { border-collapse: separate; border-spacing: 0; width: 100%; color: #432118; }
        .table thead th { background-color: #4a6344 !important; color: #fff !important; padding: 16px !important; text-transform: uppercase; font-size: 13px; border: 1px solid #bc9f82 !important; }
        .table tbody td { padding: 16px !important; border: 1px solid #bc9f82 !important; background: white; vertical-align: middle; }
        .table tbody tr:hover td { background-color: #f0e2d0 !important; cursor: pointer; transition: 0.2s; }
        .custom-table { width: 100%; overflow-x: auto; border-radius: 15px; }
        
        .badge-fase { font-size: 13px; padding: 8px 12px; border-radius: 8px; font-weight: bold; }
        .fase-ib { background-color: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; }
        .fase-bunting { background-color: #dcfce7; color: #16a34a; border: 1px solid #bbf7d0; }
        .fase-laktasi { background-color: #fef9c3; color: #ca8a04; border: 1px solid #fef08a; }
        .fase-kering { background-color: #f3f4f6; color: #4b5563; border: 1px solid #e5e7eb; }
        .fase-none { background-color: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }

        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Siklus Sapi', 'pageSubtitle' => 'Pantau siklus reproduksi sapi betina'])

    <div class="main-content">
        <div class="page-title-section">
            <h3>Siklus Sapi Betina 🐄</h3>
            <p>Pilih sapi di bawah ini untuk melihat dan mengelola alur siklus reproduksinya secara otomatis.</p>
        </div>

        @if(session('success'))
            <div class="crud-notification success" id="crudNotif">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
                <button class="notif-close" onclick="document.getElementById('crudNotif').remove()"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif



        <div class="action-bar">
            <div class="search-wrapper">
                <div class="search-input-group">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari data sapi betina berdasarkan nama atau ID...">
                </div>
            </div>
            <button type="button" class="btn text-white fw-bold px-4 py-2" data-bs-toggle="modal" data-bs-target="#registerModal" data-route="{{ route('siklus.create') }}" style="background-color: #5d7a54; border-radius: 12px; box-shadow: 0 4px 0 #3a4d33; transition: all 0.1s ease; border: none; white-space: nowrap;"><i class="fa-solid fa-plus me-1"></i> Tambah Siklus</button>
        </div>

        <div class="row g-4" id="sapiGrid">
            @forelse($sapi as $s)
                @php
                    $latestSiklus = $s->siklusSapi->first();
                    $fase = $latestSiklus ? $latestSiklus->fase : 'Belum Ada Siklus';
                    $faseClass = 'fase-none';
                    if ($fase == 'IB') $faseClass = 'fase-ib';
                    elseif ($fase == 'Bunting') $faseClass = 'fase-bunting';
                    elseif ($fase == 'Laktasi') $faseClass = 'fase-laktasi';
                    elseif ($fase == 'Kering Kandang') $faseClass = 'fase-kering';
                @endphp
                <div class="col-md-6 col-lg-4 sapi-row" data-sapi-id="{{ $s->kode_sapi }}" data-sapi-nama="{{ $s->nama }}">
                    <div class="card p-4 shadow-sm border-0 h-100 d-flex flex-column justify-content-between" style="background-color: #f5efe6; border-radius: 25px; border: 3px solid #bc9f82 !important;">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="fw-bold mb-1 sapi-nama" style="font-family: 'Fredoka One', cursive; color: #432118; font-size: 17px;">{{ $s->nama }}</h5>
                                    <p class="text-muted mb-0 font-monospace sapi-id" style="font-size: 13px; font-weight: 700;">ID: {{ $s->kode_sapi }}</p>
                                </div>
                                <span class="badge badge-fase {{ $faseClass }}">{{ $fase }}</span>
                            </div>
                            <div class="p-3 rounded-3 mb-3" style="background: rgba(93, 122, 84, 0.08); font-size: 14px; font-weight: 600;">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Umur Sapi:</span>
                                    <span style="color: #432118;">{{ $s->umur ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Hari Ke:</span>
                                    <span style="color: #432118;">{{ $latestSiklus ? $latestSiklus->hari_ke ?? '-' : '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('siklus.show', $s->id) }}" class="btn text-white fw-bold px-3 py-2 w-100 text-center" style="background-color: #5d7a54; border-radius: 12px; box-shadow: 0 4px 0 #3a4d33; transition: all 0.1s ease; border: none;">Kelola Siklus <i class="fa-solid fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5" id="noDataRow">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fa-solid fa-cow mb-3" style="font-size: 48px; color: #a67c52; opacity: 0.4;"></i>
                        <h5 class="fw-bold mb-1" style="color: #432118;">Tidak Ada Sapi Betina</h5>
                        <p class="text-muted mb-0">Sistem tidak menemukan data sapi betina di biodata.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $sapi->links() }}
        </div>
    </div>

    <!-- Modal Register/Create -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: transparent; border: none; box-shadow: none;">
                <div class="iframe-container" style="width: 100%; height: auto; border: none; overflow: hidden;">
                    <iframe id="registerIframe" src="" scrolling="no" onload="setTimeout(() => { if(this.contentWindow.document.body) { this.style.height = (this.contentWindow.document.body.scrollHeight + 50) + 'px'; } }, 50);" style="width: 100%; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('.sapi-row');
            let hasVisible = false;
            rows.forEach(row => {
                let idText = row.querySelector('.sapi-id').innerText.toLowerCase();
                let namaText = row.querySelector('.sapi-nama').innerText.toLowerCase();
                if(idText.includes(filter) || namaText.includes(filter)) {
                    row.style.display = '';
                    hasVisible = true;
                } else {
                    row.style.display = 'none';
                }
            });
            const noData = document.getElementById('noDataRow');
            if (noData) {
                noData.style.display = hasVisible ? 'none' : '';
            }
        });

        const registerModal = document.getElementById('registerModal');
        const registerIframe = document.getElementById('registerIframe');
        
        if (registerModal && registerIframe) {
            registerModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const routeUrl = button.getAttribute('data-route');
                if (routeUrl) {
                    registerIframe.src = routeUrl + (routeUrl.includes('?') ? '&' : '?') + "mode=modal";
                }
            });
            registerModal.addEventListener('hide.bs.modal', function() {
                registerIframe.src = '';
            });
        }
    </script>
</body>
</html>
