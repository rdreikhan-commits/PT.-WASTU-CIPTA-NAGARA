<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', $settings['seo_meta_title'] ?? 'PT. Wastu Cipta Nagara')</title>
    <meta name="description" content="@yield('meta_description', $settings['seo_meta_description'] ?? '')">
    <meta name="keywords" content="@yield('meta_keywords', $settings['seo_meta_keywords'] ?? '')">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Montserrat:wght@300;600;700&display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "primary-container": "#1c1b1b",
                      "surface-dim": "#ddd9d8",
                      "tertiary-fixed-dim": "#c6c6c6",
                      "surface-container-high": "#ebe7e6",
                      "on-secondary": "#ffffff",
                      "outline": "#747878",
                      "on-error": "#ffffff",
                      "on-surface-variant": "#444748",
                      "on-secondary-container": "#795f28",
                      "secondary": "#C9A86A",
                      "tertiary-container": "#1a1c1c",
                      "secondary-fixed": "#ffdea4",
                      "on-primary-container": "#858383",
                      "on-primary": "#ffffff",
                      "primary-fixed": "#e5e2e1",
                      "on-secondary-fixed": "#261900",
                      "on-surface": "#1c1b1b",
                      "on-error-container": "#93000a",
                      "secondary-container": "#ffdb99",
                      "on-tertiary": "#ffffff",
                      "on-secondary-fixed-variant": "#5b430e",
                      "inverse-primary": "#c8c6c5",
                      "error": "#ba1a1a",
                      "on-tertiary-container": "#838484",
                      "secondary-fixed-dim": "#e5c281",
                      "on-tertiary-fixed-variant": "#454747",
                      "on-background": "#1c1b1b",
                      "on-tertiary-fixed": "#1a1c1c",
                      "primary": "#7A0C22",
                      "surface": "#fdf8f8",
                      "outline-variant": "#c4c7c7",
                      "surface-tint": "#5f5e5e",
                      "on-primary-fixed": "#1c1b1b",
                      "background": "#fdf8f8",
                      "surface-variant": "#e5e2e1",
                      "surface-bright": "#fdf8f8",
                      "error-container": "#ffdad6",
                      "inverse-surface": "#313030",
                      "tertiary": "#000000",
                      "on-primary-fixed-variant": "#474746",
                      "inverse-on-surface": "#f4f0ef",
                      "tertiary-fixed": "#e2e2e2",
                      "primary-fixed-dim": "#c8c6c5",
                      "surface-container-lowest": "#ffffff",
                      "surface-container-highest": "#e5e2e1",
                      "surface-container-low": "#f7f3f2",
                      "surface-container": "#f1edec"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "margin-desktop": "80px",
                      "margin-mobile": "24px",
                      "gutter": "32px",
                      "unit": "8px",
                      "section-gap": "160px",
                      "container-max": "1440px"
              },
              "fontFamily": {
                      "stats-number": ["Montserrat"],
                      "body-lg": ["Inter"],
                      "headline-xl": ["Montserrat"],
                      "body-md": ["Inter"],
                      "label-sm": ["Inter"],
                      "headline-lg": ["Montserrat"],
                      "headline-lg-mobile": ["Montserrat"],
                      "display-lg": ["Montserrat"]
              },
              "fontSize": {
                      "stats-number": ["40px", {"lineHeight": "40px", "fontWeight": "300"}],
                      "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                      "headline-xl": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                      "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                      "label-sm": ["12px", {"lineHeight": "16px", "letterSpacing": "0.1em", "fontWeight": "600"}],
                      "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "600"}],
                      "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                      "display-lg": ["72px", {"lineHeight": "80px", "letterSpacing": "-0.02em", "fontWeight": "700"}]
              }
            },
          },
        }
    </script>
    <style>
        body {
            background-color: #fdf8f8;
            color: #1c1b1b;
            font-family: 'Inter', sans-serif;
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .watermark-text {
            font-size: 160px;
            font-weight: 800;
            color: rgba(201, 168, 106, 0.08); /* Using transparent gold */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
            white-space: nowrap;
            letter-spacing: -0.05em;
        }
    </style>

    <!-- Vite compiled logic (for Lenis, Swiper, AOS initialization) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">

    <!-- TopNavBar -->
    <nav class="fixed top-0 w-full z-50 bg-surface/75 dark:bg-primary-container/75 backdrop-blur-xl border-b border-outline-variant/30">
        <div class="flex justify-between items-center px-margin-desktop py-5 max-w-container-max mx-auto md:px-margin-desktop px-margin-mobile">
            <a class="flex items-center gap-2" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Wacana Logo" class="h-10 w-auto">
                <span class="font-headline-lg text-lg font-bold tracking-tighter text-primary">WACANA</span>
            </a>
            <div class="hidden md:flex space-x-gutter items-center">
                <a class="font-label-sm text-xs text-on-surface-variant hover:text-secondary transition-colors duration-300 {{ Route::is('portfolio*') ? 'border-b-2 border-secondary pb-1 text-primary font-semibold' : '' }}" href="{{ route('portfolio') }}">Portfolio</a>
                <a class="font-label-sm text-xs text-on-surface-variant hover:text-secondary transition-colors duration-300 {{ Route::is('services') ? 'border-b-2 border-secondary pb-1 text-primary font-semibold' : '' }}" href="{{ route('services') }}">Layanan</a>
                <a class="font-label-sm text-xs text-on-surface-variant hover:text-secondary transition-colors duration-300 {{ Route::is('team') ? 'border-b-2 border-secondary pb-1 text-primary font-semibold' : '' }}" href="{{ route('team') }}">Tim</a>
                <a class="font-label-sm text-xs text-on-surface-variant hover:text-secondary transition-colors duration-300 {{ Route::is('blog*') ? 'border-b-2 border-secondary pb-1 text-primary font-semibold' : '' }}" href="{{ route('blog') }}">Artikel</a>
                <a class="font-label-sm text-xs text-on-surface-variant hover:text-secondary transition-colors duration-300 {{ Route::is('contact') ? 'border-b-2 border-secondary pb-1 text-primary font-semibold' : '' }}" href="{{ route('contact') }}">Kontak</a>
            </div>
            <div class="hidden md:block">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="bg-primary text-white font-label-sm text-xs px-6 py-3 hover:bg-secondary transition-colors duration-300">
                            Admin Panel
                        </a>
                    @else
                        <a href="{{ route('client.dashboard') }}" class="bg-secondary text-white font-label-sm text-xs px-6 py-3 hover:bg-primary transition-colors duration-300">
                            Portal Klien
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-primary text-white font-label-sm text-xs px-6 py-3 hover:bg-secondary transition-colors duration-300">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Page Wrapper -->
    <div class="pt-24">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="w-full bg-surface border-t border-outline-variant/30 mt-24">
        <div class="flex flex-col md:flex-row justify-between items-center px-margin-desktop py-12 max-w-container-max mx-auto px-margin-mobile">
            <div class="font-headline-lg text-lg text-primary font-bold mb-8 md:mb-0">
                PT. WASTU CIPTA NAGARA
            </div>
            <div class="flex space-x-gutter mb-8 md:mb-0">
                <a class="font-label-sm text-xs text-on-surface-variant hover:text-secondary transition-colors duration-300" href="{{ route('about') }}">Tentang Kami</a>
                <a class="font-label-sm text-xs text-on-surface-variant hover:text-secondary transition-colors duration-300" href="{{ route('services') }}">Layanan</a>
                <a class="font-label-sm text-xs text-on-surface-variant hover:text-secondary transition-colors duration-300" href="{{ route('portfolio') }}">Portfolio</a>
                <a class="font-label-sm text-xs text-on-surface-variant hover:text-secondary transition-colors duration-300" href="{{ route('contact') }}">Kontak</a>
            </div>
            <div class="font-body-md text-xs text-on-surface-variant">
                © {{ date('Y') }} WACANA — ALL RIGHTS RESERVED
            </div>
        </div>
    </footer>

    <!-- Floating Mobile Bottom Nav (Visible only on mobile) -->
    <div class="md:hidden fixed bottom-6 left-1/2 -translate-x-1/2 w-[90%] max-w-[400px] bg-white/90 backdrop-blur-xl border border-outline-variant/35 rounded-full py-3 px-6 shadow-2xl z-50 flex justify-between items-center">
        <a href="{{ route('home') }}" class="flex flex-col items-center text-on-surface-variant hover:text-secondary {{ Route::is('home') ? 'text-secondary font-bold' : '' }}">
            <span class="material-symbols-outlined text-xl">home</span>
            <span class="text-[9px] font-semibold tracking-wider">Beranda</span>
        </a>
        <a href="{{ route('portfolio') }}" class="flex flex-col items-center text-on-surface-variant hover:text-secondary {{ Route::is('portfolio*') ? 'text-secondary font-bold' : '' }}">
            <span class="material-symbols-outlined text-xl">folder</span>
            <span class="text-[9px] font-semibold tracking-wider">Portfolio</span>
        </a>
        <a href="{{ route('services') }}" class="flex flex-col items-center text-on-surface-variant hover:text-secondary {{ Route::is('services') ? 'text-secondary font-bold' : '' }}">
            <span class="material-symbols-outlined text-xl">grid_view</span>
            <span class="text-[9px] font-semibold tracking-wider">Layanan</span>
        </a>
        <a href="{{ route('blog') }}" class="flex flex-col items-center text-on-surface-variant hover:text-secondary {{ Route::is('blog*') ? 'text-secondary font-bold' : '' }}">
            <span class="material-symbols-outlined text-xl">menu_book</span>
            <span class="text-[9px] font-semibold tracking-wider">Artikel</span>
        </a>
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center text-on-surface-variant hover:text-secondary">
                    <span class="material-symbols-outlined text-xl">dashboard</span>
                    <span class="text-[9px] font-semibold tracking-wider">Admin</span>
                </a>
            @else
                <a href="{{ route('client.dashboard') }}" class="flex flex-col items-center text-on-surface-variant hover:text-secondary">
                    <span class="material-symbols-outlined text-xl">person</span>
                    <span class="text-[9px] font-semibold tracking-wider">Portal</span>
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="flex flex-col items-center text-on-surface-variant hover:text-secondary {{ Route::is('login') ? 'text-secondary font-bold' : '' }}">
                <span class="material-symbols-outlined text-xl">login</span>
                <span class="text-[9px] font-semibold tracking-wider">Akses</span>
            </a>
        @endauth
    </div>

</body>
</html>
