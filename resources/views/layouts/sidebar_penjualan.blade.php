<style>
    .sidebar { width: 260px; height: 100vh; background: #f0e2d0; position: fixed; top: 0; left: 0; padding: 30px 20px; border-right: 8px solid #5d7a54; box-shadow: 5px 0 15px rgba(0,0,0,0.1); z-index: 1000; display: flex; flex-direction: column; }
    .brand h4 { font-family: 'Fredoka One', cursive; color: #432118; font-size: 24px; margin-bottom: 0; text-align: center; }
    .brand p { font-size: 14px; color: #845a33; margin-bottom: 40px; text-align: center; }
    .nav-menu { list-style: none; padding: 0; }
    .nav-item { margin-bottom: 12px; }
    .nav-link { text-decoration: none; color: #6d4c41; padding: 12px 18px; display: flex; align-items: center; border-radius: 15px; transition: 0.3s; font-weight: 700; }
    .nav-link i { margin-right: 12px; width: 20px; text-align: center; }
    .nav-link:hover, .nav-link.active { background: #5d7a54; color: #ffffff !important; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
</style>

<div class="sidebar">
    <div class="brand">
        <h4>Cimilk Yogurt</h4>
        <p>Panel Penjualan</p>
    </div>
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('penjualan.dashboard') }}" class="nav-link {{ request()->routeIs('penjualan.dashboard') ? 'active' : '' }}">
                <i class="fas fa-house"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('produksi.index') }}" class="nav-link {{ request()->routeIs('produksi.index') ? 'active' : '' }}">
                <i class="fas fa-eye"></i> Data Produksi Susu
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('penjualan.input') }}" class="nav-link {{ request()->routeIs('penjualan.input') ? 'active' : '' }}">
                <i class="fas fa-cart-plus"></i> Input Penjualan
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('penjualan.data') }}" class="nav-link {{ request()->routeIs('penjualan.data') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i> Data Penjualan
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('penjualan.laporan') }}" class="nav-link {{ request()->routeIs('penjualan.laporan') ? 'active' : '' }}">
                <i class="fas fa-file-invoice-dollar"></i> Laporan Penjualan
            </a>
        </li>
    </ul>
</div>
