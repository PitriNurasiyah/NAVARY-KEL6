<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
    .sidebar {
        width: 260px; height: 100vh;
        background: linear-gradient(180deg, #1a2e1a 0%, #0f1f10 60%, #0a1a0b 100%);
        position: fixed; top: 0; left: 0; padding: 0;
        border-right: 1px solid rgba(255,255,255,0.08);
        box-shadow: 5px 0 30px rgba(0,0,0,0.4);
        z-index: 1000; display: flex; flex-direction: column;
        transition: width 0.3s ease; overflow-x: hidden;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .sidebar.sidebar-hidden-state { width: 75px; }
    .sidebar.sidebar-hidden-state .brand h4,
    .sidebar.sidebar-hidden-state .brand p { display: none; }
    .sidebar.sidebar-hidden-state .nav-link span { display: none; }
    .sidebar.sidebar-hidden-state .nav-link { justify-content: center; padding: 12px 0; }
    .sidebar.sidebar-hidden-state .nav-link i { margin-right: 0; font-size: 20px; }

    .brand {
        height: 75px; display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        background: rgba(255,255,255,0.04);
        border-bottom: 1px solid rgba(255,255,255,0.08);
        padding: 0 20px;
    }
    .brand h4 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800; color: #ffffff;
        font-size: 20px; margin: 0; text-align: center;
        white-space: nowrap; letter-spacing: 1px;
    }
    .brand p {
        font-size: 11px; color: rgba(110,231,183,0.7);
        margin: 2px 0 0 0; text-align: center;
        font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px;
        white-space: nowrap;
    }

    .nav-menu { list-style: none; padding: 20px 15px; margin: 0; flex: 1; }
    .sidebar.sidebar-hidden-state .nav-menu { padding: 20px 10px; }
    .nav-item { margin-bottom: 4px; }
    .nav-link {
        text-decoration: none; color: rgba(255,255,255,0.55);
        padding: 11px 16px; display: flex; align-items: center;
        border-radius: 12px; transition: all 0.25s ease;
        font-weight: 600; font-size: 13.5px;
        border: 1px solid transparent;
    }
    .nav-link i { margin-right: 12px; width: 18px; text-align: center; font-size: 15px; }
    .nav-link:hover {
        background: rgba(255,255,255,0.07);
        color: rgba(255,255,255,0.9);
        border-color: rgba(255,255,255,0.08);
    }
    .nav-link.active {
        background: linear-gradient(135deg, rgba(52,211,153,0.25), rgba(16,185,129,0.15));
        color: #6ee7b7 !important;
        border-color: rgba(52,211,153,0.25);
        box-shadow: 0 4px 15px rgba(16,185,129,0.15);
    }
    .nav-link.active i { color: #34d399; }
</style>

<div class="sidebar" id="appSidebar">
    <script>
        if (localStorage.getItem('sidebarHidden') === 'true') {
            document.getElementById('appSidebar').classList.add('sidebar-hidden-state');
        }
    </script>
    <div class="brand">
        <h4>CIMILK</h4>
        <p>Panel Penjualan</p>
    </div>
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('penjualan.dashboard') }}" class="nav-link {{ request()->routeIs('penjualan.dashboard') ? 'active' : '' }}">
                <i class="fas fa-house"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('produksi.index') }}" class="nav-link {{ request()->routeIs('produksi.*') ? 'active' : '' }}">
                <i class="fas fa-flask"></i> <span>Produksi Susu</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('penjualan.data') }}" class="nav-link {{ request()->routeIs('penjualan.data', 'penjualan.input') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i> <span>Penjualan</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('laporan.penjualan') }}" class="nav-link {{ request()->routeIs('laporan.penjualan') ? 'active' : '' }}">
                <i class="fas fa-calendar-day"></i> <span>Laporan Harian</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('laporan.penjualan.bulanan') }}" class="nav-link {{ request()->routeIs('laporan.penjualan.bulanan') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> <span>Laporan Bulanan</span>
            </a>
        </li>
    </ul>
</div>
