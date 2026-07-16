@extends('layouts.public')

@section('title', 'PT. Wastu Cipta Nagara | Luxury Minimalist Architecture & Engineering')

@section('content')

    <!-- Header Section -->
    <header class="pt-12 md:pt-24 pb-12 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
            <div class="md:col-span-8 md:col-start-3 text-center">
                <div class="flex items-center justify-center gap-4 mb-4" data-aos="fade-up">
                    <div class="w-12 h-px bg-outline-variant/50"></div>
                    <p class="font-label-sm text-xs text-on-surface-variant uppercase tracking-widest text-[10px]">PORTOFOLIO KAMI</p>
                    <div class="w-12 h-px bg-outline-variant/50"></div>
                </div>
                <h1 class="font-display-lg text-[56px] leading-[64px] font-bold text-primary mb-6" data-aos="fade-up" data-aos-delay="150">
                    Creative <span class="text-secondary">Projects</span> That<br/>
                    <span class="text-secondary">Define</span> Our Style
                </h1>
                <p class="font-body-md text-sm text-on-surface-variant max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">
                    Portofolio kami menampilkan beragam proyek inovatif, mulai dari ruang hunian minimalis yang elegan hingga gedung perkantoran komersial yang fungsional dan modern.
                </p>
            </div>
        </div>
    </header>

    <!-- Horizontal Timeline Section (Repurposed for Projects) -->
    <section class="py-12 overflow-hidden relative">
        <div class="max-w-[1920px] mx-auto relative px-4">
            <div class="swiper projects-swiper relative z-10 px-margin-mobile md:px-margin-desktop">
                <div class="swiper-wrapper">
                    @php
                        // Duplicate projects if there are too few to ensure smooth marquee looping
                        $displayProjects = $projects;
                        if ($projects->count() > 0 && $projects->count() < 8) {
                            $displayProjects = $projects->concat($projects)->concat($projects);
                        }
                    @endphp
                    @forelse($displayProjects as $proj)
                        @php
                            // Determine the layout offset based on loop index to exactly match the staggered design
                            $index = $loop->index % 4;
                            if ($index === 0) {
                                $widthClass = 'w-[85vw] md:w-[320px]';
                                $heightClass = 'h-[420px]';
                                $marginClass = 'mt-12';
                                $featured = false;
                            } elseif ($index === 1) {
                                $widthClass = 'w-[85vw] md:w-[380px]';
                                $heightClass = 'h-[480px]';
                                $marginClass = '';
                                $featured = true;
                            } elseif ($index === 2) {
                                $widthClass = 'w-[85vw] md:w-[320px]';
                                $heightClass = 'h-[420px]';
                                $marginClass = 'mt-12';
                                $featured = false;
                            } else {
                                $widthClass = 'w-[85vw] md:w-[320px]';
                                $heightClass = 'h-[420px]';
                                $marginClass = 'mt-24';
                                $featured = false;
                            }
                        @endphp
                        
                        <div class="swiper-slide {{ $widthClass }} flex-shrink-0 group {{ $marginClass }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <a href="{{ route('portfolio.detail', $proj->slug) }}" class="block text-decoration-none text-center">
                                <div class="{{ $heightClass }} mb-6 overflow-hidden relative rounded-2xl {{ $featured ? 'shadow-xl' : '' }}">
                                    <img class="w-full h-full object-cover opacity-90 group-hover:scale-105 group-hover:opacity-100 transition-all duration-700" 
                                         src="{{ $proj->cover_image ? Storage::url($proj->cover_image) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80' }}" 
                                         alt="{{ $proj->title }}"/>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent group-hover:bg-black/20 transition-colors duration-500"></div>
                                    <div class="absolute top-4 left-4 flex gap-2">
                                        <span class="bg-white/20 backdrop-blur-md text-white text-[10px] uppercase tracking-wider px-3 py-1 rounded-full border border-white/30">{{ $proj->category }}</span>
                                        <span class="bg-white/20 backdrop-blur-md text-white text-[10px] uppercase tracking-wider px-3 py-1 rounded-full border border-white/30">{{ $proj->status === 'completed' ? 'Selesai' : 'Konstruksi' }}</span>
                                    </div>
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="w-16 h-16 bg-black/50 backdrop-blur-sm rounded-full flex items-center justify-center text-white text-xs tracking-widest uppercase">View</div>
                                    </div>
                                </div>
                                <div class="text-center px-4">
                                    <h3 class="font-headline-lg text-lg font-bold text-primary mb-1">{{ $proj->title }}</h3>
                                    <p class="text-xs text-on-surface-variant/70">{{ $proj->location }} &bull; {{ $proj->year }}</p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="swiper-slide w-full text-center text-muted py-12">Belum ada portofolio terdaftar.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Layered Content Section (Watermark Overlay) -->
    <section class="py-24 relative overflow-hidden bg-surface">
        <div class="watermark-text select-none pointer-events-none" style="color: rgba(201, 168, 106, 0.20);">PT. WASTU CIPTA NAGARA</div>
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop relative z-10 flex justify-center" data-aos="zoom-in">
            <!-- Modern rendering model illustration -->
            <img class="w-full max-w-[1200px] h-auto object-contain drop-shadow-2xl" 
                 src="{{ asset('images/showcase.png') }}" 
                 alt="Modern minimalist architecture villa rendering"/>
        </div>
    </section>

    <!-- Warm Words Testimonials -->
    @if($testimonials->isNotEmpty())
        @php $featuredTestimonial = $testimonials->first(); @endphp
        <section class="py-24 bg-surface">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                    <div class="lg:col-span-3" data-aos="fade-right">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-px bg-outline-variant/50"></div>
                            <p class="font-label-sm text-xs text-on-surface-variant uppercase tracking-widest text-[10px]">ULASAN KLIEN KAMI</p>
                        </div>
                    </div>
                    <div class="lg:col-span-9 grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div data-aos="fade-up">
                            <h2 class="font-display-lg text-3xl leading-tight font-bold text-primary mb-8">
                                Here's What <span class="text-secondary">Warm Words</span><br/>
                                <span class="text-secondary">Our Clients</span> Say
                            </h2>
                            <div class="rounded-2xl overflow-hidden h-[300px] shadow-sm">
                                <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500" 
                                     src="https://lh3.googleusercontent.com/aida-public/AB6AXuCRkNQk3fs1ZYzqqvBpftO7VYvFLymsSoWwc2Ze8NCYbuLEl4FdshQO1Mqm6eVvSBTZMtJcEgOk-sMflabGmAEbJVj_DRcR6dJQKSpcDK46q5kGRzOwupcOtUImNQZFaZ_MxbICB01Yn-k5KqkmQTfoJMpWRtB27sgjJBnAudNZ-j0O4-oIJcL1l0Ri-Kfis_W_6zSPkAC9Sw2LR5c1CQHNSE8CGLNsXfxpz2x3vTiJ7AJTuRfagfyG-SIm8brTkLJXXnMycXXBnsA" 
                                     alt="Architects on site"/>
                            </div>
                        </div>
                        <div class="pt-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="flex items-center gap-6 mb-8 border-b border-outline-variant/30 pb-8">
                                <div class="text-5xl font-bold text-primary">5.0</div>
                                <div>
                                    <div class="flex text-secondary text-sm mb-1">
                                        ★★★★★
                                    </div>
                                    <div class="text-xs text-on-surface-variant">{{ $testimonials->count() }} Reviews</div>
                                </div>
                                <p class="text-xs text-primary font-medium leading-relaxed pl-6 border-l border-outline-variant/30">
                                    Dari Konsep Hingga Realisasi Fisik, Wastu Mewujudkan Visi Desain Kami Secara Presisi.
                                </p>
                            </div>
                            <blockquote class="text-lg text-primary italic leading-relaxed mb-8">
                                "{{ $featuredTestimonial->testimonial }}"
                            </blockquote>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gold/25 flex items-center justify-center text-secondary font-bold font-head">
                                    {{ substr($featuredTestimonial->client_name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-primary text-sm">{{ $featuredTestimonial->client_name }}</div>
                                    <div class="text-xs text-on-surface-variant">{{ $featuredTestimonial->client_company }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Service Partners & Capabilities -->
    <section class="py-12 bg-surface">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            <div class="flex items-center justify-center gap-4 mb-12" data-aos="fade-up">
                <div class="h-px bg-outline-variant/30 flex-grow max-w-[200px]"></div>
                <p class="text-xs font-semibold text-primary tracking-wide">Layanan Jasa & Kemampuan <span class="text-secondary">WACANA</span></p>
                <div class="h-px bg-outline-variant/30 flex-grow max-w-[200px]"></div>
            </div>
            
            <div class="flex flex-wrap justify-center md:justify-between items-center gap-8 opacity-60 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500" data-aos="fade-up">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl">architecture</span>
                    <div class="text-[10px] font-bold uppercase tracking-widest leading-tight">Arsitektur<br/><span class="font-normal text-[8px]">Desain Premium</span></div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl">chair</span>
                    <div class="text-[10px] font-bold uppercase tracking-widest leading-tight">Interior<br/><span class="font-normal text-[8px]">Minimalis Mewah</span></div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl">foundation</span>
                    <div class="text-[10px] font-bold uppercase tracking-widest leading-tight">Teknik Sipil<br/><span class="font-normal text-[8px]">DED & Struktur</span></div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl">location_city</span>
                    <div class="text-[10px] font-bold uppercase tracking-widest leading-tight">Konstruksi<br/><span class="font-normal text-[8px]">Pengawasan Mutu</span></div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl">apartment</span>
                    <div class="text-[10px] font-bold uppercase tracking-widest leading-tight">BIM Model<br/><span class="font-normal text-[8px]">LOD 100 - 500</span></div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl">domain</span>
                    <div class="text-[10px] font-bold uppercase tracking-widest leading-tight">RAB Digital<br/><span class="font-normal text-[8px]">Presisi Estimasi</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Journey -->
    <section class="py-24 bg-surface relative overflow-hidden">
        <div class="absolute -left-32 top-0 opacity-5 pointer-events-none">
            <img alt="Architectural sketch watermark" class="w-[600px] h-auto" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBmdYvjDMKQ5qEhiFUcdaH4FcS9nF3Rftnb_prDqVTyUOsEV88C06WIRiyg0um7OoyA8bbFxA8sokIahmlFnBYJHuSk1Ov1-RqWhdIeFokgd1gBDvbF-MyRcNN7tiDI1XIORtkOx3dOXqIN2E_sXVzkMGnTNAZAhxrfIFof5W5FH0bMzJUeUvx5t443_oUkHX9HZCNlX9_Z79zPmgftW8_WEbr0jTWcazq7YND5El4ZGEjv5XR5gvTzQngxVKzYgCrvP71BsYPjfKE"/>
        </div>
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop text-center relative z-10">
            <div class="flex items-center justify-center gap-4 mb-4" data-aos="fade-up">
                <div class="w-8 h-px bg-outline-variant/50"></div>
                <p class="font-label-sm text-[8px] text-on-surface-variant uppercase tracking-[0.2em]">PANORAMA 360 DERAJAT</p>
                <div class="w-8 h-px bg-outline-variant/50"></div>
            </div>
            
            <h2 class="font-display-lg text-3xl md:text-5xl font-bold text-primary mb-16" data-aos="fade-up" data-aos-delay="150">
                Create An Even <span class="text-secondary">Greater</span><br/>
                <span class="text-secondary">Experience</span>
            </h2>
            
            <div class="relative w-full max-w-5xl mx-auto h-[400px] md:h-[600px] rounded-t-[3rem] md:rounded-t-[5rem] overflow-hidden shadow-2xl" data-aos="fade-up" data-aos-delay="300">
                <img class="w-full h-full object-cover" 
                     src="https://lh3.googleusercontent.com/aida-public/AB6AXuB9fwUAKqXRcWrFeq3NL-kYYu8SPFDFzkBV8AcXEuGtesQIYSCnxEkoEsNVrzozeR_szIVPj8qNRnw4VhycJ_E12oqGzd2LcGlEd-gsQ6B7_LmSGFjdI4PfE0pJuvhwcexMNhJTbsI2FcO9Jfnli2C70k22ZIWJj7aIud31s1Kd6dAIgxhpDqLpcMC3GxVsoDNBGM5i4NNxNu1gnCDGFZgu6GqZ-zem2cM1Kl4VbrMswseQc1tIYBj1hYTeEeYD4sycdU1kc7ERPGA" 
                     alt="Luxurious classical rendering"/>
            </div>
        </div>
    </section>

@endsection
