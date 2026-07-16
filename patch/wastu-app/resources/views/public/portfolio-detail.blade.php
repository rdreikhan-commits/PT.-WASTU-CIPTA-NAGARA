@extends('layouts.public')

@section('title', $project->title . ' - PT. Wastu Cipta Nagara')

@section('content')

    <!-- Project Header Banner -->
    <header class="pt-12 md:pt-20 pb-12 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto border-b border-outline-variant/30">
        <div class="flex items-center gap-4 mb-4" data-aos="fade-up">
            <span class="font-label-sm text-xs text-secondary font-bold uppercase tracking-widest">{{ $project->category }}</span>
        </div>
        <h1 class="font-display-lg text-4xl md:text-5xl font-bold text-primary mb-4" data-aos="fade-up" data-aos-delay="150">
            {{ $project->title }}
        </h1>
        <p class="font-body-md text-sm text-on-surface-variant flex items-center gap-2" data-aos="fade-up" data-aos-delay="300">
            <span class="material-symbols-outlined text-sm text-secondary">location_on</span>
            {{ $project->location }}
        </p>
    </header>

    <!-- Main Content Grid -->
    <section class="py-16 bg-surface px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Left Column: Slider and Description -->
            <div class="lg:col-span-8" data-aos="fade-right">
                
                <!-- Swiper Image Gallery -->
                @if($project->galleries->isNotEmpty())
                    <div class="swiper detail-swiper overflow-hidden rounded-2xl shadow-md mb-8 group" style="aspect-ratio: 16/9;">
                        <div class="swiper-wrapper h-full">
                            @foreach($project->galleries as $gal)
                                <div class="swiper-slide h-full">
                                    <img src="{{ Storage::url($gal->file_path) }}" class="w-full h-full object-cover" alt="Detail Gallery Slide">
                                </div>
                            @endforeach
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Add Navigation (Arrows) -->
                        <div class="swiper-button-next !text-white drop-shadow-md !opacity-0 group-hover:!opacity-100 transition-opacity"></div>
                        <div class="swiper-button-prev !text-white drop-shadow-md !opacity-0 group-hover:!opacity-100 transition-opacity"></div>
                    </div>
                @else
                    <div class="w-full rounded-2xl shadow-sm mb-8 bg-surface-container flex flex-col items-center justify-center text-on-surface-variant" style="aspect-ratio: 16/9;">
                        <span class="material-symbols-outlined text-4xl mb-2">image</span>
                        <p class="text-xs">Belum ada foto galeri.</p>
                    </div>
                @endif

                <!-- Video Walkthrough -->
                @if($project->video_url)
                    <div class="mt-12 p-6 bg-surface-container rounded-2xl" data-aos="fade-up">
                        <h4 class="font-headline-lg text-lg font-bold text-primary mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-xl text-secondary">play_circle</span>
                            Video Walkthrough Proyek
                        </h4>
                        <div class="aspect-video overflow-hidden rounded-xl">
                            <video controls class="w-full h-full object-cover">
                                <source src="{{ $project->video_url }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                @endif

                <!-- Project Description -->
                <div class="mt-12">
                    <h3 class="font-headline-lg text-2xl font-bold text-primary mb-4">Deskripsi Proyek</h3>
                    <p class="font-body-md text-sm text-on-surface-variant/90 leading-relaxed text-justify whitespace-pre-line">
                        {!! nl2br(e($project->description ?? 'Tidak ada deskripsi rinci untuk proyek ini.')) !!}
                    </p>
                </div>
            </div>

            <!-- Right Column: Specs Sidebar -->
            <div class="lg:col-span-4" data-aos="fade-left">
                <div class="p-6 bg-surface-container rounded-2xl shadow-sm border border-outline-variant/30 mb-8">
                    <h4 class="font-headline-lg text-sm font-bold text-primary uppercase tracking-wider mb-6 pb-2 border-b border-outline-variant/30">
                        Spesifikasi Detail
                    </h4>
                    
                    <div class="flex justify-between items-center py-3 border-b border-outline-variant/20">
                        <span class="text-xs text-on-surface-variant/80">Status Proyek</span>
                        <span class="text-xs font-bold uppercase text-secondary">
                            {{ $project->status === 'completed' ? 'Selesai' : ($project->status === 'ongoing' ? 'Dalam Pengerjaan' : 'Perencanaan') }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-outline-variant/20">
                        <span class="text-xs text-on-surface-variant/80">Tahun Pengerjaan</span>
                        <span class="text-xs font-semibold text-primary">{{ $project->year }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-outline-variant/20">
                        <span class="text-xs text-on-surface-variant/80">Lokasi</span>
                        <span class="text-xs font-semibold text-primary text-right max-w-[60%]">{{ $project->location }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-outline-variant/20">
                        <span class="text-xs text-on-surface-variant/80">Klien</span>
                        <span class="text-xs font-semibold text-primary text-right max-w-[60%]">{{ $project->client ? $project->client->name : 'Publik / Swasta' }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-outline-variant/20">
                        <span class="text-xs text-on-surface-variant/80">Kategori</span>
                        <span class="text-xs font-semibold text-primary">{{ $project->category }}</span>
                    </div>

                    @if($project->scope)
                        <div class="mt-6">
                            <span class="text-xs text-on-surface-variant/80 block mb-2 font-semibold">Cakupan Pekerjaan (Scope)</span>
                            <p class="text-xs text-on-surface-variant/70 leading-relaxed">{{ $project->scope }}</p>
                        </div>
                    @endif
                </div>

                <!-- Client Project Portal Link -->
                @auth
                    @if(auth()->user()->isClient() && auth()->user()->id === $project->client_id)
                        <div class="p-6 bg-white border border-secondary rounded-2xl text-center shadow-sm">
                            <h5 class="font-headline-lg text-sm font-bold text-secondary mb-3 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm">person_workspace</span>
                                Portal Monitoring Klien
                            </h5>
                            <p class="text-xs text-on-surface-variant/70 mb-4 leading-relaxed">
                                Proyek ini terhubung dengan akun Anda. Akses portal Anda untuk memantau progress konstruksi dan dokumen kontrak.
                            </p>
                            <a href="{{ route('client.dashboard') }}?project_id={{ $project->id }}" class="block bg-secondary text-white text-xs font-semibold py-3 hover:bg-primary transition-colors duration-300">
                                BUKA PORTAL KLIEN
                            </a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Related Projects -->
        @if($relatedProjects->isNotEmpty())
            <div class="mt-16 pt-16 border-t border-outline-variant/30" data-aos="fade-up">
                <h3 class="font-headline-lg text-2xl font-bold text-primary mb-8">Proyek Terkait</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedProjects as $rel)
                        <div class="group border border-outline-variant/20 bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                            <div>
                                <div class="mb-4 overflow-hidden rounded-lg aspect-[4/3]">
                                    <img src="{{ $rel->cover_image ? Storage::url($rel->cover_image) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80' }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="{{ $rel->title }}">
                                </div>
                                <span class="text-xs text-secondary font-bold uppercase tracking-wider">{{ $rel->category }}</span>
                                <h5 class="font-headline-lg text-md font-bold text-primary my-2">{{ $rel->title }}</h5>
                            </div>
                            <div class="mt-4 pt-2">
                                <a href="{{ route('portfolio.detail', $rel->slug) }}" class="text-xs font-bold text-primary hover:text-secondary flex items-center gap-1">
                                    Lihat Detail
                                    <span class="material-symbols-outlined text-xs">arrow_forward_ios</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

@endsection
