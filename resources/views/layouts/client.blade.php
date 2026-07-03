<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portal Klien - PT. Wastu Cipta Nagara</title>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

    <div class="container-fluid">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 p-0">
                <div class="portal-sidebar d-flex flex-column justify-content-between">
                    <div>
                        <div class="sidebar-brand d-flex align-items-center gap-2">
                            <img src="{{ asset('images/logo.png') }}" alt="Wacana Logo" style="height: 35px;">
                            <span class="tracking-wider">WACANA</span>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="{{ Route::is('client.dashboard') ? 'active' : '' }}">
                                <a href="{{ route('client.dashboard') }}">
                                    <i class="bi bi-person-workspace"></i> Progress Proyek
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="bi bi-house"></i> Kembali ke Website
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="mt-5">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-dark w-100 btn-sm rounded-0">
                                <i class="bi bi-box-arrow-left me-1"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-lg-10 col-md-9 p-0">
                
                <!-- Header -->
                <header class="portal-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <h3 class="mb-0 fs-5 font-head text-uppercase text-secondary">
                            Portal Klien
                        </h3>
                        
                        <!-- Project Selector (If client has multiple projects) -->
                        @if(isset($projects) && $projects->count() > 1)
                            <div class="dropdown">
                                <button class="btn btn-outline-gold btn-sm dropdown-toggle py-1 px-3 border border-secondary" type="button" data-bs-toggle="dropdown">
                                    Pilih Proyek: {{ $project->title }}
                                </button>
                                <ul class="dropdown-menu border-0 shadow">
                                    @foreach($projects as $p)
                                        <li>
                                            <a class="dropdown-item @if($p->id === $project->id) active bg-gold @endif" href="?project_id={{ $p->id }}">
                                                {{ $p->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <!-- Notifications Dropdown -->
                        @if(isset($notifications))
                            <div class="dropdown">
                                <button class="btn btn-light position-relative p-2 rounded-circle shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-bell-fill text-secondary"></i>
                                    @php
                                        $unreadCount = $notifications->where('is_read', false)->count();
                                    @endphp
                                    @if($unreadCount > 0)
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger p-1 notification-badge">
                                            {{ $unreadCount }}
                                        </span>
                                    @endif
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow p-2" style="width: 320px;">
                                    <li class="px-2 py-1 fw-bold border-bottom text-secondary mb-2 small">NOTIFIKASI TERBARU</li>
                                    @forelse($notifications as $notif)
                                        <li class="notification-item p-2 mb-1 border-bottom small rounded {{ $notif->is_read ? 'opacity-70' : 'bg-light' }}" data-id="{{ $notif->id }}">
                                            <div class="fw-bold">{{ $notif->title }}</div>
                                            <div class="text-secondary" style="font-size: 0.8rem;">{{ $notif->message }}</div>
                                            <div class="d-flex justify-content-between align-items-center mt-1">
                                                <span class="text-muted" style="font-size: 0.75rem;">{{ $notif->created_at->diffForHumans() }}</span>
                                                @if(!$notif->is_read)
                                                    <button class="btn btn-link p-0 text-gold mark-read-btn" style="font-size: 0.75rem; text-decoration: none;">Tandai Dibaca</button>
                                                @endif
                                            </div>
                                        </li>
                                    @empty
                                        <li class="text-center py-3 text-muted">Tidak ada notifikasi</li>
                                    @endforelse
                                </ul>
                            </div>
                        @endif

                        <!-- Client User Info -->
                        <div class="d-flex align-items-center gap-3">
                            <div class="text-end">
                                <div class="fw-bold fs-6">{{ auth()->user()->name }}</div>
                                <div class="text-muted small">Klien Perusahaan</div>
                            </div>
                            <i class="bi bi-person-workspace fs-3 text-secondary"></i>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <div class="portal-content">
                    @if(session('success'))
                        <div class="alert alert-success border-0 rounded-0 shadow-sm mb-4" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>

        </div>
    </div>

</body>
</html>
