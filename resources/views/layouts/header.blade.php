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
        background: rgba(15, 31, 16, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255,255,255,0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 35px;
        z-index: 999;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
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
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
        line-height: 1.2;
    }

    .header-page-info p {
        font-size: 11px;
        color: rgba(110,231,183,0.7);
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
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #34d399, #059669);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 16px;
        font-weight: 800;
        border: 2px solid rgba(52,211,153,0.3);
        box-shadow: 0 0 15px rgba(52,211,153,0.2);
    }

    .profile-info {
        text-align: right;
    }

    .profile-info .name {
        font-weight: 700;
        font-size: 13px;
        color: #ffffff;
        line-height: 1.2;
    }

    .profile-info .role {
        font-size: 10px;
        color: rgba(110,231,183,0.7);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-logout {
        border: 1px solid rgba(52,211,153,0.3);
        background: rgba(52,211,153,0.1);
        padding: 7px 16px;
        border-radius: 10px;
        font-weight: 700;
        color: #6ee7b7;
        box-shadow: 0 0 15px rgba(52,211,153,0.1);
        transition: 0.2s;
        font-size: 12px;
        white-space: nowrap;
        cursor: pointer;
    }

    .btn-logout:hover { background: rgba(52,211,153,0.2); color: #fff; }
    .btn-logout:active {
        transform: translateY(2px);
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

    /* Notification Styles */
    .notification-wrapper {
        position: relative;
        margin-left: -5px;
        margin-right: 5px;
    }
    
    .notification-btn {
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.12);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.7);
        font-size: 17px;
        cursor: pointer;
        transition: 0.3s;
        padding: 0;
    }
    
    .notification-btn:hover {
        background: rgba(52,211,153,0.15);
        color: #6ee7b7;
        border-color: rgba(52,211,153,0.3);
    }
    
    .notification-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        background: #e74c3c;
        color: white;
        font-size: 10px;
        font-weight: bold;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 2px solid #f0e2d0;
    }
    
    .notification-dropdown {
        position: absolute;
        top: 55px;
        right: -10px;
        width: 320px;
        background: rgba(15,31,16,0.97);
        backdrop-filter: blur(20px);
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.5);
        border: 1px solid rgba(255,255,255,0.1);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 1000;
    }
    
    .notification-wrapper.open .notification-dropdown {
        display: flex;
    }
    
    .notification-header {
        background: rgba(255,255,255,0.05);
        padding: 15px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .notification-header h6 {
        margin: 0;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        color: #ffffff;
        font-size: 14px;
    }
    
    .notification-header span {
        font-size: 11px;
        color: rgba(110,231,183,0.7);
        font-weight: 600;
        cursor: pointer;
    }
    
    .notification-header span:hover {
        text-decoration: underline;
        color: #6ee7b7;
    }
    
    .notification-body {
        max-height: 300px;
        overflow-y: auto;
        padding: 10px;
        display: flex;
        flex-direction: column;
        gap: 6px;
        background: transparent;
    }
    
    .notification-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px;
        border-radius: 10px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.07);
        transition: 0.2s;
    }
    
    .notification-item:hover {
        background: rgba(255,255,255,0.09);
    }
    
    .notification-icon-bg {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: rgba(93,122,84,0.15);
        color: #5d7a54;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .notification-content p {
        margin: 0;
        font-size: 12px;
        color: rgba(255,255,255,0.85);
        font-weight: 600;
        line-height: 1.4;
    }
    
    .notification-content span {
        font-size: 10px;
        color: rgba(110,231,183,0.6);
        font-weight: 600;
    }
    
    .notification-body::-webkit-scrollbar { width: 6px; }
    .notification-body::-webkit-scrollbar-track { background: #fdfaf6; }
    .notification-body::-webkit-scrollbar-thumb { background: #bc9f82; border-radius: 10px; }
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

        <!-- Notification Dropdown -->
        <div class="notification-wrapper" id="notificationWrapper">
            <button class="notification-btn" id="notificationBtn" type="button" title="Notifikasi">
                <i class="fa-solid fa-bell"></i>
                <span class="notification-badge" id="notificationCount" style="display:none;">0</span>
            </button>
            
            <div class="notification-dropdown">
                <div class="notification-header">
                    <h6>Notifikasi</h6>
                    <span onclick="window.markAllAsRead()">Tandai sudah dibaca</span>
                </div>
                <div class="notification-body" id="notificationBody">
                    <!-- Notifications will be populated by JS -->
                </div>
            </div>
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
    // Notification Logic using LocalStorage
    const STORAGE_KEY = 'app_notifications';
    
    // Load existing notifications
    let notifications = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

    let hasNewFlash = false;

    // ─── Flash: session('success') ────────────────────────────────────
    @if(session('success') || request()->query('success'))
        var successMsg = {!! json_encode(session('success') ?? request()->query('success')) !!};
        var alreadyExists = notifications.some(n => n.text === successMsg && n.type === 'success');
        if(!alreadyExists) {
            notifications.unshift({
                id: Date.now(),
                type: 'success',
                text: successMsg,
                time: 'Baru saja',
                read: false
            });
            hasNewFlash = true;
        }
    @endif
    
    // ─── Flash: session('error') ──────────────────────────────────────
    @if(session('error'))
        var errorMsg = {!! json_encode(session('error')) !!};
        var alreadyExistsErr = notifications.some(n => n.text === errorMsg && n.type === 'error');
        if(!alreadyExistsErr) {
            notifications.unshift({
                id: Date.now() + 1,
                type: 'error',
                text: errorMsg,
                time: 'Baru saja',
                read: false
            });
            hasNewFlash = true;
        }
    @endif

    // ─── Siklus Sapi Alerts (jadwal hari ini dari database) ──────────
    @php
        $today = \Carbon\Carbon::today()->toDateString();
        $headerAlerts = \App\Models\SiklusSapi::with('sapi')
            ->where(function($q) use ($today) {
                $q->whereDate('tanggal_mulai', $today)
                  ->orWhereDate('estimasi_selesai', $today);
            })
            ->where('status', 'Berjalan')
            ->get();
    @endphp

    @foreach($headerAlerts as $alert)
    @php
        if ($alert->tanggal_mulai == $today) {
            $alertText = '🐄 ' . ($alert->sapi->nama ?? 'Sapi') . ' (' . ($alert->sapi->kode_sapi ?? '-') . '): Mulai Fase ' . $alert->fase . ' hari ini.';
        } else {
            $alertText = '⏰ ' . ($alert->sapi->nama ?? 'Sapi') . ' (' . ($alert->sapi->kode_sapi ?? '-') . '): Estimasi selesai Fase ' . $alert->fase . ' hari ini.';
        }
        $alertId = 'siklus_' . $alert->id . '_' . $today;
    @endphp
    (function() {
        var txt = {!! json_encode($alertText) !!};
        var uid = {!! json_encode($alertId) !!};
        var exists = notifications.some(function(n) { return n.id == uid; });
        if (!exists) {
            notifications.unshift({
                id: uid,
                type: 'warning',
                text: txt,
                time: 'Jadwal Hari Ini',
                read: false
            });
            hasNewFlash = true;
        }
    })();
    @endforeach

    if(hasNewFlash) {
        // Limit to latest 50 notifications
        if(notifications.length > 50) notifications = notifications.slice(0, 50);
        localStorage.setItem(STORAGE_KEY, JSON.stringify(notifications));
    }

    function renderNotifications() {
        const body = document.getElementById('notificationBody');
        const countBadge = document.getElementById('notificationCount');
        
        if (!body || !countBadge) return;
        
        // update count
        const unreadCount = notifications.filter(n => !n.read).length;
        if(unreadCount > 0) {
            countBadge.style.display = 'flex';
            countBadge.textContent = unreadCount;
        } else {
            countBadge.style.display = 'none';
        }
        
        body.innerHTML = '';
        
        if(notifications.length === 0) {
            body.innerHTML = '<div style="text-align:center; padding:20px; color:#845a33; font-size:12px;">Tidak ada notifikasi</div>';
            return;
        }
        
        notifications.forEach(n => {
            let bgStyle, iconBgStyle, iconClass;
            
            if(n.type === 'success') {
                bgStyle = 'background: #e6f4ea; border-color: #c3e6cb;';
                iconBgStyle = 'background: rgba(40,167,69,0.15); color: #28a745;';
                iconClass = 'fa-solid fa-check-double';
            } else if(n.type === 'error') {
                bgStyle = 'background: #fdf3f4; border-color: #f5c6cb;';
                iconBgStyle = 'background: rgba(220,53,69,0.15); color: #dc3545;';
                iconClass = 'fa-solid fa-triangle-exclamation';
            } else if(n.type === 'warning') {
                bgStyle = 'background: #fdfaf6; border-color: #e6d5c0;';
                iconBgStyle = 'background: rgba(231,76,60,0.15); color: #e74c3c;';
                iconClass = 'fa-solid fa-triangle-exclamation';
            } else if(n.type === 'cart') {
                bgStyle = 'background: #fdfaf6; border-color: #e6d5c0;';
                iconBgStyle = 'background: rgba(166,124,82,0.15); color: #a67c52;';
                iconClass = 'fa-solid fa-cart-shopping';
            } else {
                bgStyle = 'background: #fdfaf6; border-color: #e6d5c0;';
                iconBgStyle = 'background: rgba(93,122,84,0.15); color: #5d7a54;';
                iconClass = 'fa-solid fa-check';
            }
            
            const opacity = n.read ? 'opacity: 0.6;' : 'opacity: 1;';
            const unreadDot = !n.read ? '<div style="width:8px; height:8px; background:#e74c3c; border-radius:50%; margin-right:5px; flex-shrink:0; margin-top:13px;"></div>' : '<div style="width:8px; margin-right:5px; flex-shrink:0;"></div>';
            
            body.innerHTML += `
                <div class="notification-item" style="${bgStyle} ${opacity}; position:relative; align-items:flex-start; padding:10px 12px; gap:8px;" id="notif-${n.id}">
                    ${unreadDot}
                    <div class="notification-icon-bg" style="${iconBgStyle}">
                        <i class="${iconClass}"></i>
                    </div>
                    <div class="notification-content" style="flex:1;">
                        <p style="margin-bottom:2px;">${n.text}</p>
                        <span style="font-size:10px; opacity:0.8;">${n.time}</span>
                    </div>
                    <button onclick="window.deleteNotification(${n.id}, event)" style="background:none; border:none; color:#dc3545; cursor:pointer; padding:5px; flex-shrink:0; transition:0.2s; border-radius:5px;" title="Hapus" onmouseover="this.style.background='rgba(220,53,69,0.1)'" onmouseout="this.style.background='none'">
                        <i class="fa-solid fa-trash-can" style="font-size:14px;"></i>
                    </button>
                </div>
            `;
        });
    }

    window.markAllAsRead = function() {
        notifications = notifications.map(n => ({...n, read: true}));
        localStorage.setItem(STORAGE_KEY, JSON.stringify(notifications));
        renderNotifications();
    }

    window.deleteNotification = function(id, event) {
        if(event) event.stopPropagation();
        notifications = notifications.filter(n => n.id !== id);
        localStorage.setItem(STORAGE_KEY, JSON.stringify(notifications));
        renderNotifications();
    }
</script>

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

        // Notification Toggle
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationWrapper = document.getElementById('notificationWrapper');
        
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationWrapper.classList.toggle('open');
            });
            
            // Close notification when clicking outside
            document.addEventListener('click', function(e) {
                if (notificationWrapper && !notificationWrapper.contains(e.target)) {
                    notificationWrapper.classList.remove('open');
                }
            });
        }
        
        // Render notifications on load
        renderNotifications();
    });
</script>
