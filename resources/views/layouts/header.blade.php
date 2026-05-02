{{-- ====================================================
     HEADER PROFILE COMPONENT
     Usage: @include('layouts.header', ['pageTitle' => 'Judul', 'pageSubtitle' => 'Sub'])
     ====================================================--}}
<style>
    /* ===== TOP HEADER BAR ===== */
    .top-header {
        position: fixed;
        top: 0;
        left: 260px;
        right: 0;
        height: 70px;
        background: #f0e2d0;
        border-bottom: 4px solid #5d7a54;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 35px;
        z-index: 999;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        transition: left 0.3s ease;
    }

    .top-header.sidebar-hidden {
        left: 75px;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* Hamburger Toggle Button */
    .sidebar-toggle {
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 8px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        gap: 5px;
        transition: 0.2s;
    }

    .sidebar-toggle:hover { background: rgba(93,122,84,0.1); }

    .sidebar-toggle span {
        display: block;
        width: 24px;
        height: 3px;
        background: #432118;
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    .header-page-info h6 {
        font-family: 'Fredoka One', cursive;
        font-size: 18px;
        color: #432118;
        margin: 0;
        line-height: 1.2;
    }

    .header-page-info p {
        font-size: 12px;
        color: #845a33;
        margin: 0;
        font-weight: 600;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* Profile Avatar */
    .profile-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #5d7a54, #4a6344);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-family: 'Fredoka One', cursive;
        font-size: 18px;
        border: 3px solid #bc9f82;
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    }

    .profile-info {
        text-align: right;
    }

    .profile-info .name {
        font-weight: 700;
        font-size: 14px;
        color: #432118;
        line-height: 1.2;
    }

    .profile-info .role {
        font-size: 11px;
        color: #845a33;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-logout {
        border: none;
        background: #5a1f12;
        padding: 8px 18px;
        border-radius: 12px;
        font-weight: 700;
        color: #ffffff;
        box-shadow: 0 4px 0 #3a150c;
        transition: 0.2s;
        font-size: 13px;
        white-space: nowrap;
        cursor: pointer;
    }

    .btn-logout:hover { background: #7a2f1c; }
    .btn-logout:active {
        transform: translateY(3px);
        box-shadow: 0 1px 0 #3a150c;
    }

    /* Adjust main content for fixed header */
    .main-content {
        padding-top: 90px !important;
        transition: margin-left 0.3s ease, width 0.3s ease;
    }

    /* Sidebar hidden state */
    .sidebar.sidebar-hidden-state {
        /* handled in sidebar files now */
    }

    .main-content.sidebar-hidden-state {
        margin-left: 75px;
        width: calc(100% - 75px);
    }
</style>

<div class="top-header" id="topHeader">
<script>
    // Apply state immediately to prevent FOUC
    if (localStorage.getItem('sidebarHidden') === 'true') {
        var th = document.getElementById('topHeader');
        if(th) th.classList.add('sidebar-hidden');
        document.write('<style id="foucMainContent">.main-content { margin-left: 75px !important; width: calc(100% - 75px) !important; }</style>');
    }
</script>
    <div class="header-left">
        <!-- Hamburger Button -->
        <button class="sidebar-toggle" id="sidebarToggle" title="Sembunyikan/Tampilkan Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="header-page-info">
            <h6>{{ $pageTitle ?? 'Dashboard' }}</h6>
        </div>
    </div>

    <div class="header-right">
        <!-- Profile Info -->
        <div class="profile-info">
            <div class="name">{{ Auth::user()->name ?? 'Pengguna' }}</div>
            <div class="role">{{ Auth::user()->role ?? 'Admin' }}</div>
        </div>
        <div class="profile-avatar">
            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
        </div>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fa-solid fa-sign-out-alt me-1"></i>Keluar
            </button>
        </form>
    </div>
</div>

<script>
    // Sidebar toggle logic
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        const topHeader = document.getElementById('topHeader');
        const toggleBtn = document.getElementById('sidebarToggle');
        const foucStyle = document.getElementById('foucMainContent');

        if (!toggleBtn) return;

        // Check saved state to apply classes to mainContent (now that it exists)
        const savedState = localStorage.getItem('sidebarHidden');
        if (savedState === 'true') {
            if(sidebar) sidebar.classList.add('sidebar-hidden-state');
            if(mainContent) mainContent.classList.add('sidebar-hidden-state');
            if(topHeader) topHeader.classList.add('sidebar-hidden');
            // Remove the temporary FOUC style so transitions work
            if(foucStyle) foucStyle.remove();
        }

        toggleBtn.addEventListener('click', function() {
            const isHidden = sidebar ? sidebar.classList.contains('sidebar-hidden-state') : false;

            if (isHidden) {
                if(sidebar) sidebar.classList.remove('sidebar-hidden-state');
                if(mainContent) mainContent.classList.remove('sidebar-hidden-state');
                if(topHeader) topHeader.classList.remove('sidebar-hidden');
                localStorage.setItem('sidebarHidden', 'false');
            } else {
                if(sidebar) sidebar.classList.add('sidebar-hidden-state');
                if(mainContent) mainContent.classList.add('sidebar-hidden-state');
                if(topHeader) topHeader.classList.add('sidebar-hidden');
                localStorage.setItem('sidebarHidden', 'true');
            }
        });
    });
</script>
