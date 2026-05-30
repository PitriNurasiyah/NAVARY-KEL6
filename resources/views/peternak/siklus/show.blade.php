<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siklus Sapi - Cimilk Yogurt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        body { background-color: #f4efe6; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; display: flex; color: #432118; overflow-x: hidden; }
        .main-content { margin-left: 260px; width: calc(100% - 260px); padding: 45px; }
        .page-title-section { margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between; }
        .page-title-section h3 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #4d624a; margin: 0 0 4px 0; }
        
        .card-cow { background: #fffcf7; padding: 25px; border-radius: 20px; border: 1.5px solid #e6d5c0; margin-bottom: 30px; box-shadow: 0 8px 20px rgba(0,0,0,0.03); }
        .timeline { position: relative; padding: 20px 0; margin-top: 20px; }
        .timeline::before { content: ''; position: absolute; left: 30px; top: 0; bottom: 0; width: 2px; background: #e6d5c0; border-radius: 4px; }
        
        .timeline-item { position: relative; padding-left: 70px; margin-bottom: 30px; }
        .timeline-icon { position: absolute; left: 15px; top: 0; width: 34px; height: 34px; background: #fff; border: 2.5px solid #bc9f82; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 1; color: #bc9f82; font-size: 14px; }
        .timeline-content { background: #fffcf7; padding: 20px; border-radius: 15px; border: 1.5px solid #e6d5c0; box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
        .timeline-content h5 { font-family: 'Playfair Display', serif; font-weight: 700; margin-bottom: 5px; color: #432118; }
        .timeline-content .date { color: #845a33; font-size: 13px; font-weight: bold; margin-bottom: 10px; display: block; }
        
        .status-badge { padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: bold; }
        
        .action-box { background: rgba(93, 122, 84, 0.05); border: 1.5px dashed #bc9f82; padding: 25px; border-radius: 15px; margin-top: 20px; text-align: center; }
        
        .chart-container { background: #fffcf7; padding: 25px; border-radius: 15px; border: 1.5px solid #e6d5c0; margin-top: 25px; box-shadow: 0 8px 20px rgba(0,0,0,0.03); }
        
        .btn-action { background: #5d7a54; color: white; border: none; padding: 10px 20px; border-radius: 10px; font-weight: bold; box-shadow: 0 4px 0 #3a4d33; transition: 0.2s; }
        .btn-action:hover { background: #4a6344; transform: translateY(2px); box-shadow: 0 2px 0 #3a4d33; color: white; }
        .btn-danger-action { background: #c0392b; color: white; border: none; padding: 10px 20px; border-radius: 10px; font-weight: bold; box-shadow: 0 4px 0 #922b21; transition: 0.2s; }
        .btn-danger-action:hover { background: #a93226; transform: translateY(2px); box-shadow: 0 2px 0 #7b241c; color: white; }

        .form-control { border-radius: 10px; border: 2.5px solid #d4c2ab; background-color: #fffcf7; }
        .btn-back { border: none; background: #845a33; padding: 10px 20px; border-radius: 12px; font-weight: 700; color: #ffffff; box-shadow: 0 4px 0 #152414; transition: 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-back:hover { background: #6d4c41; color: #fff; transform: translateY(-2px); }

        /* Custom Delete Confirm Modal */
        .confirm-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }
        .confirm-overlay.active { display: flex; }
        .confirm-box {
            background: #fffcf7;
            border-radius: 20px;
            padding: 35px 40px;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
            text-align: center;
            border: 1.5px solid #e6d5c0;
            animation: popIn 0.25s ease;
        }
        @keyframes popIn {
            from { transform: scale(0.85); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .confirm-icon { font-size: 48px; color: #c0392b; margin-bottom: 15px; }
        .confirm-box h5 { font-family: 'Playfair Display', serif; font-weight: 700; color: #432118; font-size: 20px; margin-bottom: 8px; }
        .confirm-box p { color: #6d4c41; font-weight: 600; font-size: 14px; margin-bottom: 25px; }
        .confirm-actions { display: flex; gap: 12px; justify-content: center; }
        .btn-confirm-yes {
            background: #c0392b; color: #fff; border: none;
            padding: 10px 28px; border-radius: 12px; font-weight: 700;
            box-shadow: 0 4px 0 #922b21; cursor: pointer; transition: 0.2s;
        }
        .btn-confirm-yes:active { transform: translateY(3px); box-shadow: 0 1px 0 #922b21; }
        .btn-confirm-no {
            background: #e2e8f0; color: #475569; border: none;
            padding: 10px 28px; border-radius: 12px; font-weight: 700; cursor: pointer;
        }
        .btn-confirm-no:hover { background: #cbd5e1; }
    
        /* Modal Floating Styling */
        .modal-content-custom {
            background: transparent;
            border: none;
            box-shadow: none;
        }
        .modal-backdrop.show { opacity: 0.6; background-color: #000; }
        .iframe-container {
            width: 100%;
            height: auto;
            border: none;
            overflow: hidden;
        }
        .iframe-container iframe {
            width: 100%;
            border: none;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    @include('layouts.sidebar')
    @include('layouts.header', ['pageTitle' => 'Siklus Sapi', 'pageSubtitle' => 'Detail alur siklus sapi'])

    <div class="main-content">
        <div class="page-title-section">
            <div>
                <h3>Detail Siklus: {{ $sapi->nama }} 🐄</h3>
                <p>ID: {{ $sapi->kode_sapi }} | Umur: {{ $sapi->umur ?? '-' }}</p>
            </div>
            <a href="{{ route('siklus.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left me-2"></i> Kembali</a>
        </div>


        {{-- Flash messages are automatically captured by the header notification system --}}

        <div class="card-cow">
            @php
                $latest = $sapi->siklusSapi->first();
                $fase = $latest ? $latest->fase : null;
            @endphp
            
            <h4 style="font-family: 'Playfair Display', serif; font-weight: 700; color: #432118; margin-bottom: 20px;">Tindakan Selanjutnya</h4>
            
            @if(!$fase || $fase == 'Kering Kandang' && $latest->status == 'Selesai')
                <div class="action-box">
                    <p class="mb-3 fw-bold" style="color: #6d4c41;"><i class="fa-solid fa-syringe fs-3 mb-2 d-block"></i> Sapi siap untuk memulai siklus baru (Inseminasi Buatan).</p>
                    <form action="{{ route('siklus.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sapi_id" value="{{ $sapi->id }}">
                        <input type="hidden" name="fase" value="IB">
                        <input type="hidden" name="tanggal_mulai" value="{{ date('Y-m-d') }}">
                        <button type="submit" class="btn btn-action"><i class="fa-solid fa-play me-2"></i>Mulai IB (Inseminasi Buatan)</button>
                    </form>
                </div>
            @elseif($fase == 'IB')
                @if($latest->status == 'Berjalan')
                @php 
                    $daysPassed = $latest->hari_ke; 
                    $isPastEstimasi = !$latest->estimasi_selesai || \Carbon\Carbon::today()->greaterThanOrEqualTo(\Carbon\Carbon::parse($latest->estimasi_selesai));
                @endphp
                <div class="action-box">
                    <p class="mb-3 fw-bold" style="color: #6d4c41;">
                        <i class="fa-solid fa-magnifying-glass fs-3 mb-2 d-block"></i> 
                        Menunggu 14-21 hari setelah IB. (Sekarang Hari ke-{{ $daysPassed }}). Lakukan cek birahi untuk memastikan kehamilan.
                        @if($latest->estimasi_selesai)
                            <br><span class="text-xs text-muted">Bisa diproses mulai tanggal: {{ \Carbon\Carbon::parse($latest->estimasi_selesai)->format('d/m/Y') }}</span>
                        @endif
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <form action="{{ route('siklus.action.cek_birahi', $latest->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="hasil" value="berhasil">
                            <button type="submit" class="btn btn-action" @if(!$isPastEstimasi) disabled style="opacity: 0.55; cursor: not-allowed;" @endif><i class="fa-solid fa-check me-2"></i>Berhasil (Bunting)</button>
                        </form>
                        <form action="{{ route('siklus.action.cek_birahi', $latest->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="hasil" value="gagal">
                            <button type="submit" class="btn btn-danger-action" @if(!$isPastEstimasi) disabled style="opacity: 0.55; cursor: not-allowed;" @endif><i class="fa-solid fa-xmark me-2"></i>Gagal (Ulangi IB)</button>
                        </form>
                    </div>
                </div>
                @endif
            @elseif($fase == 'Bunting')
                @if($latest->status == 'Berjalan')
                @php 
                    $daysPassed = $latest->hari_ke; 
                    $isPastEstimasi = !$latest->estimasi_selesai || \Carbon\Carbon::today()->greaterThanOrEqualTo(\Carbon\Carbon::parse($latest->estimasi_selesai));
                @endphp
                <div class="action-box">
                    <p class="mb-3 fw-bold" style="color: #6d4c41;"><i class="fa-solid fa-baby-carriage fs-3 mb-2 d-block"></i> Masa kehamilan sapi (±9 bulan). Sudah berjalan: {{ $daysPassed }} hari.<br>Estimasi selesai: {{ \Carbon\Carbon::parse($latest->estimasi_selesai)->format('d/m/Y') }}</p>
                    <form action="{{ route('siklus.action.melahirkan', $latest->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-action" style="background: #4a6344; box-shadow: 0 4px 0 #3a4d33; @if(!$isPastEstimasi) opacity: 0.55; cursor: not-allowed; @endif" @if(!$isPastEstimasi) disabled @endif><i class="fa-solid fa-cow me-2"></i>Sapi Telah Melahirkan</button>
                    </form>
                </div>
                @endif
            @elseif($fase == 'Laktasi')
                @if($latest->status == 'Berjalan')
                @php $daysPassed = $latest->hari_ke; @endphp
                <div class="action-box">
                    <p class="mb-3 fw-bold" style="color: #6d4c41;"><i class="fa-solid fa-jug-detergent fs-3 mb-2 d-block"></i> Masa Laktasi. Sapi sedang menghasilkan susu (Hari ke-{{ $daysPassed }}).</p>
                    <a href="{{ route('produksi.index') }}" class="btn btn-action mb-2"><i class="fa-solid fa-plus me-2"></i>Input Produksi Susu</a>
                    <form action="{{ route('siklus.action.kering', $latest->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-danger-action" style="background: #b91c1c; box-shadow: 0 4px 0 #7f1d1d;"><i class="fa-solid fa-stopwatch me-2"></i>Akhiri Laktasi & Mulai Masa Kering</button>
                    </form>
                </div>
                @endif
            @elseif($fase == 'Kering Kandang')
                @if($latest->status == 'Berjalan')
                @php 
                    $daysPassed = $latest->hari_ke; 
                    $isPastEstimasi = !$latest->estimasi_selesai || \Carbon\Carbon::today()->greaterThanOrEqualTo(\Carbon\Carbon::parse($latest->estimasi_selesai));
                @endphp
                <div class="action-box">
                    <p class="mb-3 fw-bold" style="color: #6d4c41;">
                        <i class="fa-solid fa-bed fs-3 mb-2 d-block"></i> 
                        Masa Kering (Istirahat ±1 bulan). Sudah berjalan: {{ $daysPassed }} hari.
                        @if($latest->estimasi_selesai)
                            <br><span class="text-xs text-muted">Estimasi selesai: {{ \Carbon\Carbon::parse($latest->estimasi_selesai)->format('d/m/Y') }}</span>
                        @endif
                    </p>
                    <form action="{{ route('siklus.action.selesai_kering', $latest->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-action" @if(!$isPastEstimasi) disabled style="opacity: 0.55; cursor: not-allowed;" @endif><i class="fa-solid fa-check-double me-2"></i>Selesaikan Masa Kering</button>
                    </form>
                </div>
                @endif
            @endif
        </div>



        <h4 style="font-family: 'Playfair Display', serif; font-weight: 700; color: #432118; margin-bottom: 20px; margin-top: 40px;">Riwayat Siklus Sapi</h4>
        <div class="timeline">
            @forelse($sapi->siklusSapi as $sik)
            <div class="timeline-item">
                <div class="timeline-icon"><i class="fa-solid fa-circle-dot"></i></div>
                <div class="timeline-content">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5>{{ $sik->fase }}</h5>
                            <span class="date">{{ \Carbon\Carbon::parse($sik->tanggal_mulai)->format('d F Y') }}</span>
                            <p class="mb-0 text-muted">{{ $sik->keterangan ?? 'Tidak ada keterangan khusus.' }}</p>
                        </div>
                        <div class="text-end">
                            <span class="status-badge {{ $sik->status == 'Selesai' ? 'bg-success text-white' : ($sik->status == 'Batal' ? 'bg-danger text-white' : 'bg-warning text-dark') }} d-inline-block mb-2">{{ $sik->status }}</span>
                            <div class="d-flex gap-2 justify-content-end">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#registerModal" data-route="{{ route('siklus.edit', $sik->id) }}" style="border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: bold; border-color: #bc9f82; color: #432118;"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ route('siklus.destroy', $sik->id) }}', '{{ $sik->fase }}')" style="border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: bold;"><i class="fa-solid fa-trash"></i> Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted text-center fw-bold" style="padding-left: 30px;">Belum ada riwayat siklus.</p>
            @endforelse
        </div>
    </div>

    <!-- Custom Confirm Delete Modal -->
    <div class="confirm-overlay" id="confirmOverlay">
        <div class="confirm-box">
            <div class="confirm-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h5>Hapus Riwayat Siklus?</h5>
            <p id="confirmMessage">Apakah Anda yakin ingin menghapus data siklus ini?</p>
            <div class="confirm-actions">
                <button class="btn-confirm-yes" id="confirmYesBtn">Ya, Hapus</button>
                <button class="btn-confirm-no" onclick="closeConfirm()">Batal</button>
            </div>
        </div>
    </div>

    <!-- Hidden delete form -->
    <form id="deleteForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Modal Register/Create -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="iframe-container">
                    <iframe id="registerIframe" src="" scrolling="no" onload="setTimeout(() => { if(this.contentWindow.document.body) { this.style.height = (this.contentWindow.document.body.scrollHeight + 50) + 'px'; } }, 50);" ></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ====== Custom Delete Confirm ======
        let deleteUrl = '';

        function confirmDelete(url, name) {
            deleteUrl = url;
            document.getElementById('confirmMessage').textContent =
                'Apakah Anda yakin ingin menghapus data siklus "' + name + '"? Tindakan ini tidak bisa dibatalkan.';
            document.getElementById('confirmOverlay').classList.add('active');
        }

        function closeConfirm() {
            document.getElementById('confirmOverlay').classList.remove('active');
        }

        document.getElementById('confirmYesBtn').addEventListener('click', function() {
            const form = document.getElementById('deleteForm');
            form.action = deleteUrl;
            form.submit();
        });

        document.getElementById('confirmOverlay').addEventListener('click', function(e) {
            if (e.target === this) closeConfirm();
        });

        // ====== Modal: Reload iframe ======
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
