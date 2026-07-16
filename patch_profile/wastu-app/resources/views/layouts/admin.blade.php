<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - PT. Wastu Cipta Nagara</title>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --brand-red: #7A0C22;
            --brand-red-dark: #5D0819;
            --brand-red-light: #9B1030;
            --brand-gold: #C9A86A;
            --sidebar-w: 260px;
        }

        body {
            background: #f4f1f0;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        #admin-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: linear-gradient(160deg, var(--brand-red) 0%, var(--brand-red-dark) 100%);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: transform 0.3s cubic-bezier(0.16,1,0.3,1);
            overflow-y: auto;
        }

        #admin-sidebar::-webkit-scrollbar { width: 6px; }
        #admin-sidebar::-webkit-scrollbar-track { background: transparent; }
        #admin-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 6px; }
        #admin-sidebar:hover::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.5); }

        /* Mobile: hidden by default */
        @media (max-width: 991px) {
            #admin-sidebar {
                transform: translateX(-100%);
                box-shadow: 4px 0 30px rgba(0,0,0,0.3);
            }
            #admin-sidebar.open {
                transform: translateX(0);
            }
        }

        .sidebar-brand {
            padding: 24px 22px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand img { height: 38px; }
        .sidebar-brand span {
            color: var(--brand-gold);
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 0.12em;
        }

        .sidebar-section-label {
            color: rgba(255,255,255,0.38);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 18px 22px 6px;
        }

        .sidebar-nav { padding: 8px 12px; }
        
        .sidebar-nav li { list-style: none; margin-bottom: 2px; }
        
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 11px;
            color: rgba(255,255,255,0.75);
            padding: 11px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .sidebar-nav a i { font-size: 16px; width: 20px; flex-shrink: 0; }

        .sidebar-nav a:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }

        .sidebar-nav li.active a {
            background: rgba(255,255,255,0.18);
            color: #fff;
            font-weight: 600;
            box-shadow: inset 3px 0 0 var(--brand-gold);
        }

        .sidebar-footer {
            padding: 16px 14px 24px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-footer .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.8);
            border: 1px solid rgba(255,255,255,0.15);
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            width: 100%;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .sidebar-footer .btn-logout:hover {
            background: rgba(255,255,255,0.18);
            color: #fff;
        }

        /* ===== MAIN CONTENT ===== */
        #admin-main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s cubic-bezier(0.16,1,0.3,1);
        }

        @media (max-width: 991px) {
            #admin-main { margin-left: 0; }
        }

        /* ===== TOPBAR ===== */
        #admin-topbar {
            background: #fff;
            border-bottom: 1px solid #ece8e7;
            padding: 0 28px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        @media (max-width: 768px) {
            #admin-topbar { padding: 0 16px; }
        }

        .topbar-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--brand-red);
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-user .user-info { text-align: right; }
        .topbar-user .user-name {
            font-weight: 700;
            font-size: 13px;
            color: #1c1b1b;
            line-height: 1.3;
        }
        .topbar-user .user-role {
            font-size: 11px;
            color: var(--brand-red);
            font-weight: 600;
        }

        .topbar-avatar {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--brand-red), var(--brand-red-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 16px;
        }

        /* Mobile hamburger */
        #sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--brand-red);
            font-size: 22px;
            padding: 4px;
            cursor: pointer;
        }

        @media (max-width: 991px) {
            #sidebar-toggle { display: flex; align-items: center; }
            .topbar-user .user-info { display: none; }
        }

        /* ===== SIDEBAR OVERLAY ===== */
        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            backdrop-filter: blur(2px);
        }

        /* ===== PAGE CONTENT ===== */
        #admin-page-content {
            padding: 28px;
            flex: 1;
        }

        @media (max-width: 768px) {
            #admin-page-content { padding: 16px; }
        }

        /* ===== ALERT OVERRIDES ===== */
        .alert-success { background: #f0fdf4; border-left: 4px solid #22c55e; color: #15803d; border-radius: 8px; }
        .alert-danger { background: #fff1f2; border-left: 4px solid var(--brand-red); color: var(--brand-red-dark); border-radius: 8px; }

        /* ===== MOBILE BOTTOM NAV (Admin) ===== */
        #admin-mobile-nav {
            display: none;
            position: fixed;
            bottom: 0; left: 0; right: 0;
            background: #fff;
            border-top: 1px solid #ece8e7;
            padding: 8px 0 12px;
            z-index: 980;
            justify-content: space-around;
        }

        @media (max-width: 991px) {
            #admin-mobile-nav { display: flex; }
            #admin-page-content { padding-bottom: 80px; }
        }

        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            color: #9ca3af;
            text-decoration: none;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 0.04em;
            transition: color 0.2s;
            padding: 0 8px;
        }

        .mobile-nav-item i { font-size: 20px; }
        .mobile-nav-item.active, .mobile-nav-item:hover { color: var(--brand-red); }

        /* ===== CARD STYLE ===== */
        .admin-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #ece8e7;
            overflow: hidden;
        }
    </style>
</head>
<body>

    <!-- Sidebar Overlay (Mobile) -->
    <div id="sidebar-overlay" onclick="closeSidebar()"></div>

    <!-- ===== SIDEBAR ===== -->
    <aside id="admin-sidebar" data-lenis-prevent>
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>WACANA</span>
        </div>

        <p class="sidebar-section-label">Menu Utama</p>
        <ul class="sidebar-nav">
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="{{ Route::is('admin.projects*') ? 'active' : '' }}">
                <a href="{{ route('admin.projects.index') }}">
                    <i class="bi bi-folder2-open"></i> Portfolio Proyek
                </a>
            </li>
            <li class="{{ Route::is('admin.clients*') ? 'active' : '' }}">
                <a href="{{ route('admin.clients.index') }}">
                    <i class="bi bi-people"></i> Klien Portal
                </a>
            </li>
        </ul>

        <p class="sidebar-section-label">Konten Website</p>
        <ul class="sidebar-nav">
            <li class="{{ Route::is('admin.services*') ? 'active' : '' }}">
                <a href="{{ route('admin.services.index') }}">
                    <i class="bi bi-grid"></i> Layanan
                </a>
            </li>
            <li class="{{ Route::is('admin.team*') ? 'active' : '' }}">
                <a href="{{ route('admin.team.index') }}">
                    <i class="bi bi-person-badge"></i> Tim Ahli
                </a>
            </li>
            <li class="{{ Route::is('admin.articles*') ? 'active' : '' }}">
                <a href="{{ route('admin.articles.index') }}">
                    <i class="bi bi-journal-text"></i> Artikel Blog
                </a>
            </li>
            <li class="{{ Route::is('admin.testimonials*') ? 'active' : '' }}">
                <a href="{{ route('admin.testimonials.index') }}">
                    <i class="bi bi-chat-quote"></i> Testimoni
                </a>
            </li>
            <li class="{{ Route::is('admin.faqs*') ? 'active' : '' }}">
                <a href="{{ route('admin.faqs.index') }}">
                    <i class="bi bi-question-circle"></i> FAQ
                </a>
            </li>
        </ul>

        <p class="sidebar-section-label">Sistem</p>
        <ul class="sidebar-nav">
            <li class="{{ Route::is('admin.inbox*') ? 'active' : '' }}">
                <a href="{{ route('admin.inbox.index') }}">
                    <i class="bi bi-envelope"></i> Inbox Pesan
                </a>
            </li>
            <li class="{{ Route::is('admin.settings*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings') }}">
                    <i class="bi bi-gear"></i> Pengaturan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.backup') }}">
                    <i class="bi bi-database-down"></i> Backup Database
                </a>
            </li>
        </ul>

        <div class="sidebar-footer mt-auto">
            <div style="padding: 10px 2px 14px; color: rgba(255,255,255,0.5); font-size:11px;">
                Login sebagai<br>
                <span style="color:#fff; font-weight:700;">{{ auth()->user()->name }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-left"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main id="admin-main">

        <!-- Topbar -->
        <header id="admin-topbar">
            <div class="d-flex align-items-center gap-3">
                <button id="sidebar-toggle" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <span class="topbar-title">@yield('header_title', 'Admin Panel')</span>
            </div>
            <div class="topbar-user dropdown">
                <button class="btn btn-link text-decoration-none d-flex align-items-center gap-2 p-0 text-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-info text-end d-none d-md-block" style="line-height: 1.2;">
                        <div class="user-name" style="font-weight: 700; font-size: 13px; color: #1c1b1b;">{{ auth()->user()->name }}</div>
                        <div class="user-role" style="font-size: 11px; color: var(--brand-red); font-weight: 600;">Administrator</div>
                    </div>
                    <div class="topbar-avatar" style="width: 38px; height: 38px; background: linear-gradient(135deg, var(--brand-red), var(--brand-red-light)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-2">
                    <li>
                        <a href="{{ route('admin.profile') }}" class="dropdown-item d-flex align-items-center gap-2" style="font-size: 13px; font-weight: 500;">
                            <i class="bi bi-person-circle"></i> Profil Saya
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2" style="font-size: 13px; font-weight: 500;">
                                <i class="bi bi-box-arrow-right"></i> Keluar (Logout)
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        <!-- Page Content -->
        <div id="admin-page-content">

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>

    </main>

    <!-- ===== MOBILE BOTTOM NAV ===== -->
    <nav id="admin-mobile-nav">
        <a href="{{ route('admin.dashboard') }}" class="mobile-nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.projects.index') }}" class="mobile-nav-item {{ Route::is('admin.projects*') ? 'active' : '' }}">
            <i class="bi bi-folder2-open"></i>
            <span>Proyek</span>
        </a>
        <a href="{{ route('admin.clients.index') }}" class="mobile-nav-item {{ Route::is('admin.clients*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            <span>Klien</span>
        </a>
        <a href="{{ route('admin.inbox.index') }}" class="mobile-nav-item {{ Route::is('admin.inbox*') ? 'active' : '' }}">
            <i class="bi bi-envelope"></i>
            <span>Inbox</span>
        </a>
        <a href="#" class="mobile-nav-item" onclick="toggleSidebar(); return false;">
            <i class="bi bi-grid-3x3-gap"></i>
            <span>Menu</span>
        </a>
    </nav>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('open');
            overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
        }
        function closeSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.remove('open');
            overlay.style.display = 'none';
        }
        // Close sidebar on window resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 991) closeSidebar();
        });
    </script>

</body>
</html>
