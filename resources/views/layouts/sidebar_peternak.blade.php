<style>
    .sidebar { width: 260px; height: 100vh; background: #f0e2d0; position: fixed; top: 0; left: 0; padding: 0; border-right: 8px solid #5d7a54; box-shadow: 5px 0 15px rgba(0,0,0,0.1); z-index: 1000; display: flex; flex-direction: column; transition: width 0.3s ease; overflow-x: hidden; }
    .sidebar.sidebar-hidden-state { width: 75px; }
    .sidebar.sidebar-hidden-state .brand h4, .sidebar.sidebar-hidden-state .brand p { display: none; }
    .sidebar.sidebar-hidden-state .nav-link span { display: none; }
    .sidebar.sidebar-hidden-state .nav-link { justify-content: center; padding: 12px 0; }
    .sidebar.sidebar-hidden-state .nav-link i { margin-right: 0; font-size: 20px; }
    .brand { height: 70px; display: flex; flex-direction: column; align-items: center; justify-content: center; background: #f0e2d0; }
    .brand h4 { font-family: 'Fredoka One', cursive; color: #432118; font-size: 22px; margin: 0; text-align: center; white-space: nowrap; }
    .brand p { font-size: 13px; color: #845a33; margin: 0; text-align: center; font-weight: 700; white-space: nowrap; }
    .nav-menu { list-style: none; padding: 20px; margin: 0; }
    .sidebar.sidebar-hidden-state .nav-menu { padding: 20px 10px; }
    .nav-link { text-decoration: none; color: #6d4c41; padding: 12px 18px; display: flex; align-items: center; border-radius: 15px; transition: 0.3s; font-weight: 700; }
    .nav-link i { margin-right: 12px; width: 20px; text-align: center; }
    .nav-link:hover, .nav-link.active { background: #5d7a54; color: #ffffff !important; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
    .nav-item { margin-bottom: 5px; }
</style>

<div class="sidebar" id="appSidebar">
    <script>
        if (localStorage.getItem('sidebarHidden') === 'true') {
            document.getElementById('appSidebar').classList.add('sidebar-hidden-state');
        }
    </script>
    <div class="brand">
        <h4>Cimilk Yogurt</h4>
        <p>Panel Peternak</p>
    </div>
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('peternak.dashboard') }}" class="nav-link {{ request()->routeIs('peternak.dashboard') ? 'active' : '' }}">
                <i class="fas fa-house"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('sapi.index') }}" class="nav-link {{ request()->routeIs('sapi.*') ? 'active' : '' }}">
                <i class="fas fa-cow"></i> <span>Data Sapi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pakan.index') }}" class="nav-link {{ request()->routeIs('pakan.index') ? 'active' : '' }}">
                <i class="fas fa-seedling"></i> <span>Manajemen Pakan</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('siklus.index') }}" class="nav-link {{ request()->routeIs('siklus.index') ? 'active' : '' }}">
                <i class="fas fa-clock-rotate-left"></i> <span>Siklus Sapi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('produksi.index') }}" class="nav-link {{ request()->routeIs('produksi.index') ? 'active' : '' }}">
                <i class="fas fa-flask"></i> <span>Produksi Susu</span>
            </a>
        </li>
    </ul>
</div>
