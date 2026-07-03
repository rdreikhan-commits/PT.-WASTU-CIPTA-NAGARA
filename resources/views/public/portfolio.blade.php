@extends('layouts.public')

@section('title', 'Portfolio Proyek - PT. Wastu Cipta Nagara')

@section('content')

    <!-- Header Banner -->
    <header class="pt-12 md:pt-20 pb-12 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-center border-b border-outline-variant/30">
        <div class="flex items-center justify-center gap-4 mb-4" data-aos="fade-up">
            <div class="w-12 h-px bg-outline-variant/50"></div>
            <p class="font-label-sm text-xs text-on-surface-variant uppercase tracking-widest text-[10px]">PORTOFOLIO</p>
            <div class="w-12 h-px bg-outline-variant/50"></div>
        </div>
        <h1 class="font-display-lg text-4xl md:text-5xl font-bold text-primary mb-4" data-aos="fade-up" data-aos-delay="150">
            Crafting Spaces, Defining Experiences
        </h1>
        <p class="font-body-md text-sm text-on-surface-variant max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">
            Jelajahi karya rancangan kami dalam arsitektur premium, interior minimalis, dan perencanaan teknik presisi tinggi.
        </p>
    </header>

    <!-- Projects Grid Section -->
    <section class="py-16 bg-surface px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        
        <!-- Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-4 mb-12" data-aos="fade-up">
            <a href="{{ route('portfolio') }}" 
               class="font-label-sm text-xs px-6 py-2 transition-all duration-300 border {{ !request('category') ? 'bg-primary text-white border-primary' : 'bg-transparent text-on-surface-variant border-outline-variant/40 hover:border-primary' }}">
                SEMUA
            </a>
            @foreach($categories as $cat)
                <a href="?category={{ urlencode($cat) }}" 
                   class="font-label-sm text-xs px-6 py-2 transition-all duration-300 border {{ request('category') === $cat ? 'bg-primary text-white border-primary' : 'bg-transparent text-on-surface-variant border-outline-variant/40 hover:border-primary' }}">
                    {{ strtoupper($cat) }}
                </a>
            @endforeach
        </div>

        <!-- Grid Container -->
        @if($projects->isEmpty())
            <div class="text-center py-24 text-on-surface-variant" data-aos="fade-up">
                <span class="material-symbols-outlined text-5xl text-outline-variant mb-4">folder_off</span>
                <p class="font-body-md text-sm">Belum ada portofolio dalam kategori ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $proj)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <a href="{{ route('portfolio.detail', $proj->slug) }}" class="block text-decoration-none">
                            <!-- Image Frame -->
                            <div class="h-[320px] mb-4 overflow-hidden relative rounded-xl shadow-sm">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700" 
                                     src="{{ $proj->cover_image ? Storage::url($proj->cover_image) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80' }}" 
                                     alt="{{ $proj->title }}"/>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-transparent to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-300"></div>
                                
                                <div class="absolute top-4 left-4">
                                    <span class="bg-white/35 backdrop-blur-md text-white text-[10px] uppercase tracking-wider px-3 py-1 border border-white/20 rounded-full">
                                        {{ $proj->category }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Metadata -->
                            <div>
                                <div class="flex justify-between items-start mb-1">
                                    <h4 class="font-headline-lg text-lg font-bold text-primary group-hover:text-secondary transition-colors duration-300">
                                        {{ $proj->title }}
                                    </h4>
                                    <span class="text-xs text-on-surface-variant font-mono font-semibold">{{ $proj->year }}</span>
                                </div>
                                <p class="text-xs text-on-surface-variant/75">{{ $proj->location }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

    </section>

@endsection
