<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">
<style>
    /* ===== TOP HEADER BAR ===== */
    .top-header {
        position: fixed;
        top: 0;
        left: 260px;
        right: 0;
        height: 70px;
        background: #f5efe6;
        border-bottom: 1px solid rgba(0,0,0,0.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 35px;
        z-index: 999;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: left 0.3s ease;
        font-family: 'Plus Jakarta Sans', sans-serif;
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
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        color: #432118;
        margin: 0;
        line-height: 1.2;
    }

    .header-page-info p {
        font-size: 11px;
        color: #6d4c41;
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
        background: #233722;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-family: 'Playfair Display', serif;
        font-size: 16px;
        font-weight: 800;
        border: none;
        box-shadow: none;
    }

    .profile-info {
        text-align: right;
    }

    .profile-info .name {
        font-weight: 700;
        font-size: 13px;
        color: #432118;
        line-height: 1.2;
    }

    .profile-info .role {
        font-size: 10px;
        color: #5d7a54;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-logout {
        border: none;
        background: #6d4534;
        padding: 7px 16px;
        border-radius: 10px;
        font-weight: 700;
        color: #ffffff;
        box-shadow: 0 4px 0 #502e21;
        transition: 0.2s;
        font-size: 12px;
        white-space: nowrap;
        cursor: pointer;
    }

    .btn-logout:hover { background: #502e21; color: #fff; }
    .btn-logout:active {
        transform: translateY(2px);
        box-shadow: 0 2px 0 #502e21;
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
        background: rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.08);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #432118;
        font-size: 17px;
        cursor: pointer;
        transition: 0.3s;
        padding: 0;
    }
    
    .notification-btn:hover {
        background: rgba(93,122,84,0.15);
        color: #5d7a54;
        border-color: rgba(93,122,84,0.3);
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
        border: 2px solid #f5efe6;
    }
    
    .notification-dropdown {
        position: absolute;
        top: 55px;
        right: -10px;
        width: 320px;
        background: rgba(244, 239, 230, 0.85);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-radius: 15px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        border: 1.5px solid rgba(230, 213, 192, 0.8);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 1000;
    }
    
    .notification-wrapper.open .notification-dropdown {
        display: flex;
    }
    
    .notification-header {
        background: #4d624a;
        padding: 15px;
        border-bottom: 1px solid rgba(230, 213, 192, 0.8);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .notification-header h6 {
        margin: 0;
        font-family: inherit;
        font-weight: 700;
        color: #ffffff;
        font-size: 14px;
    }
    
    .notification-header span {
        font-size: 11px;
        color: #dccb96;
        font-weight: 600;
        cursor: pointer;
    }
    
    .notification-header span:hover {
        text-decoration: underline;
        color: #ffffff;
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
        background: rgba(255, 252, 247, 0.65);
        border: 1px solid rgba(230, 213, 192, 0.6);
        transition: 0.2s;
        backdrop-filter: blur(4px);
    }
    
    .notification-item:hover {
        background: rgba(240, 232, 218, 0.85);
        border-color: rgba(188, 159, 130, 0.8);
    }
    
    .notification-icon-bg {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: #ffffff;
        color: #5d7a54;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .notification-content p {
        margin: 0;
        font-size: 12px;
        color: #432118 !important;
        font-weight: 600;
        line-height: 1.4;
    }
    
    .notification-content span {
        font-size: 10px;
        color: #845a33 !important;
        font-weight: 600;
    }
    
    .notification-body::-webkit-scrollbar { width: 6px; }
    .notification-body::-webkit-scrollbar-track { background: rgba(255,255,255,0.5); }
    .notification-body::-webkit-scrollbar-thumb { background: #bc9f82; border-radius: 10px; }

    /* Global typography override to match landing page theme */
    body, p, span, td, th, input, select, textarea, button, a, div.name, div.role {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
    h1, h2, h3, h4, h5, h6, .brand h4, .page-title-section h3, .stat-info h2, .card-info h2 {
        font-family: 'Playfair Display', serif !important;
    }

    /* Global background and header text colors to match landing page theme */
    body, .top-header {
        background-color: #f4efe6 !important;
    }
    .header-page-info h6, .page-title-section h3 {
        color: #4d624a !important;
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
    const DELETED_KEY = 'app_deleted_notifications';
    
    // Load existing notifications and deleted trackers
    let notifications = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    let deletedAlerts = JSON.parse(localStorage.getItem(DELETED_KEY)) || [];

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

    // ─── Siklus Sapi Alerts (real-time active cycles dari database) ──
    @php
        $headerAlerts = \App\Models\SiklusSapi::with('sapi')
            ->where('status', 'Berjalan')
            ->get();
    @endphp

    @foreach($headerAlerts as $alert)
    @php
        // Start Alert
        $alertStartText = '🐄 ' . ($alert->sapi->nama ?? 'Sapi') . ' (' . ($alert->sapi->kode_sapi ?? '-') . '): Mulai Fase ' . $alert->fase . ' tanggal ' . \Carbon\Carbon::parse($alert->tanggal_mulai)->translatedFormat('d M Y') . '.';
        $alertStartTime = \Carbon\Carbon::parse($alert->tanggal_mulai)->translatedFormat('d M Y');
        $alertStartId = 'siklus_start_' . $alert->id;
        
        // End Alert
        $alertEndText = $alert->estimasi_selesai ? '⏰ ' . ($alert->sapi->nama ?? 'Sapi') . ' (' . ($alert->sapi->kode_sapi ?? '-') . '): Estimasi selesai Fase ' . $alert->fase . ' tanggal ' . \Carbon\Carbon::parse($alert->estimasi_selesai)->translatedFormat('d M Y') . '.' : null;
        $alertEndTime = $alert->estimasi_selesai ? \Carbon\Carbon::parse($alert->estimasi_selesai)->translatedFormat('d M Y') : null;
        $alertEndId = 'siklus_end_' . $alert->id;
    @endphp
    (function() {
        var startTxt = {!! json_encode($alertStartText) !!};
        var startTime = {!! json_encode($alertStartTime) !!};
        var startUid = {!! json_encode($alertStartId) !!};
        
        if (!deletedAlerts.includes(String(startUid))) {
            var exists = notifications.some(function(n) { return String(n.id) === String(startUid); });
            if (!exists) {
                notifications.unshift({
                    id: startUid,
                    type: 'warning',
                    text: startTxt,
                    time: 'Mulai: ' + startTime,
                    read: false
                });
                hasNewFlash = true;
            }
        }
        
        @if($alertEndText)
        var endTxt = {!! json_encode($alertEndText) !!};
        var endTime = {!! json_encode($alertEndTime) !!};
        var endUid = {!! json_encode($alertEndId) !!};
        
        if (!deletedAlerts.includes(String(endUid))) {
            var existsEnd = notifications.some(function(n) { return String(n.id) === String(endUid); });
            if (!existsEnd) {
                notifications.unshift({
                    id: endUid,
                    type: 'warning',
                    text: endTxt,
                    time: 'Estimasi Selesai: ' + endTime,
                    read: false
                });
                hasNewFlash = true;
            }
        }
        @endif
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
                bgStyle = 'background: rgba(230, 244, 234, 0.65); border-color: rgba(195, 230, 203, 0.8);';
                iconBgStyle = 'background: #ffffff; color: #28a745; border: 1.5px solid rgba(40,167,69,0.3);';
                iconClass = 'fa-solid fa-check-double';
            } else if(n.type === 'error') {
                bgStyle = 'background: rgba(253, 243, 244, 0.65); border-color: rgba(245, 198, 203, 0.8);';
                iconBgStyle = 'background: #ffffff; color: #dc3545; border: 1.5px solid rgba(220,53,69,0.3);';
                iconClass = 'fa-solid fa-triangle-exclamation';
            } else if(n.type === 'warning') {
                bgStyle = 'background: rgba(255, 252, 247, 0.65); border-color: rgba(230, 213, 192, 0.8);';
                iconBgStyle = 'background: #ffffff; color: #e74c3c; border: 1.5px solid rgba(231,76,60,0.3);';
                iconClass = 'fa-solid fa-triangle-exclamation';
            } else if(n.type === 'cart') {
                bgStyle = 'background: rgba(255, 252, 247, 0.65); border-color: rgba(230, 213, 192, 0.8);';
                iconBgStyle = 'background: #ffffff; color: #a67c52; border: 1.5px solid rgba(166,124,82,0.3);';
                iconClass = 'fa-solid fa-cart-shopping';
            } else {
                bgStyle = 'background: rgba(255, 252, 247, 0.65); border-color: rgba(230, 213, 192, 0.8);';
                iconBgStyle = 'background: #ffffff; color: #5d7a54; border: 1.5px solid rgba(93,122,84,0.3);';
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
                        <p style="margin-bottom:2px; color: #432118 !important;">${n.text}</p>
                        <span style="font-size:10px; color: #845a33 !important;">${n.time}</span>
                    </div>
                    <button onclick="window.deleteNotification('${n.id}', event)" style="background:none; border:none; color:#dc3545; cursor:pointer; padding:5px; flex-shrink:0; transition:0.2s; border-radius:5px;" title="Hapus" onmouseover="this.style.background='rgba(220,53,69,0.1)'" onmouseout="this.style.background='none'">
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
        
        // Track in deleted alerts so it doesn't get re-added on page reload
        let deleted = JSON.parse(localStorage.getItem(DELETED_KEY)) || [];
        if(!deleted.includes(String(id))) {
            deleted.push(String(id));
            localStorage.setItem(DELETED_KEY, JSON.stringify(deleted));
        }

        notifications = notifications.filter(n => String(n.id) !== String(id));
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
