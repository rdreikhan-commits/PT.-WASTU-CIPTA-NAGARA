@extends('layouts.public')

@section('title', 'Layanan Jasa - PT. Wastu Cipta Nagara')

@section('content')

    <!-- Banner -->
    <section class="py-24 bg-surface text-center px-margin-mobile md:px-margin-desktop">
        <div class="max-w-container-max mx-auto" data-aos="fade-up">
            <h1 class="font-display-lg text-4xl md:text-5xl font-bold text-primary mb-4">Layanan Jasa Kami</h1>
            <p class="text-on-surface-variant max-w-2xl mx-auto">Solusi Konsultasi Arsitektur, Engineering, & BIM Terintegrasi</p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-12 bg-white">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $srv)
                    @php
                        // Mapping Bootstrap Icons to Material Symbols roughly
                        $iconMap = [
                            'bi-map' => 'map',
                            'bi-cpu' => 'precision_manufacturing',
                            'bi-building-gear' => 'construction',
                            'bi-palette' => 'palette',
                            'bi-building' => 'architecture',
                            'bi-box' => 'view_in_ar',
                            'bi-kanban' => 'view_timeline',
                            'bi-tree' => 'park',
                        ];
                        $matIcon = $iconMap[$srv->icon] ?? 'business';
                        
                        // Map specific slugs to high-quality Unsplash architecture/engineering images
                        $imageMap = [
                            'perencanaan-umum-dan-masterplanning' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800&auto=format&fit=crop', // city/masterplan
                            'perencanaan-teknik-dan-struktur' => 'https://images.unsplash.com/photo-1541888086925-0c13d3f9263a?q=80&w=800&auto=format&fit=crop', // structural/engineering
                            'perencanaan-konstruksi' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=800&auto=format&fit=crop', // construction site
                            'desain-interior-premium' => 'https://images.unsplash.com/photo-1600607688969-a5bfcd64bd40?q=80&w=800&auto=format&fit=crop', // modern interior
                            'desain-eksterior-dan-arsitektur' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=800&auto=format&fit=crop', // luxury exterior
                            'bim-modeling-dan-digital-twin' => 'https://images.unsplash.com/photo-1504307651254-35680f356f58?q=80&w=800&auto=format&fit=crop', // tech/blueprint/digital
                            'project-management-consultancy' => 'https://images.unsplash.com/photo-1517581177682-a085bc7fcb10?q=80&w=800&auto=format&fit=crop', // meeting/management
                            'lanskap-dan-desain-ekologis' => 'https://images.unsplash.com/photo-1523731407965-2430cd12f5e4?q=80&w=800&auto=format&fit=crop', // landscape/greenery
                        ];
                        
                        $defaultImg = $imageMap[$srv->slug] ?? 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800&auto=format&fit=crop';
                        $img = $srv->image ? Storage::url($srv->image) : $defaultImg;
                    @endphp

                    <div class="group bg-surface rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer flex flex-col" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}" onclick="openModal('serviceModal{{ $srv->id }}')">
                        <div class="h-48 overflow-hidden relative">
                            <img src="{{ $img }}" alt="{{ $srv->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" onerror="this.src='https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800&auto=format&fit=crop'">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors"></div>
                            <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-md p-3 rounded-xl shadow-lg text-primary">
                                <span class="material-symbols-outlined text-3xl">{{ $matIcon }}</span>
                            </div>
                        </div>
                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="font-headline-lg text-xl font-bold text-primary mb-3">{{ $srv->title }}</h3>
                                <p class="text-on-surface-variant text-sm line-clamp-3 mb-4">{{ $srv->description }}</p>
                            </div>
                            <div class="flex items-center text-secondary font-semibold text-sm group-hover:text-primary transition-colors">
                                Lihat Detail <span class="material-symbols-outlined ml-1 text-sm">arrow_forward</span>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div id="serviceModal{{ $srv->id }}" class="fixed inset-0 z-[100] hidden items-center justify-center">
                        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('serviceModal{{ $srv->id }}')"></div>
                        <div class="relative bg-white w-11/12 max-w-4xl rounded-3xl overflow-hidden shadow-2xl flex flex-col md:flex-row z-10 animate-fade-in-up max-h-[90vh]">
                            <div class="md:w-5/12 h-56 md:h-auto relative">
                                <img src="{{ $img }}" class="w-full h-full object-cover" alt="{{ $srv->title }}" onerror="this.src='https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800&auto=format&fit=crop'">
                                <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-black/60 to-transparent flex items-end md:items-center p-6">
                                     <div class="bg-white/20 backdrop-blur-md p-4 rounded-2xl text-white shadow-lg flex items-center justify-center">
                                        <span class="material-symbols-outlined text-5xl">{{ $matIcon }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-7/12 p-8 md:p-10 flex flex-col max-h-[60vh] md:max-h-full overflow-y-auto">
                                <button onclick="closeModal('serviceModal{{ $srv->id }}')" class="absolute top-4 right-4 text-outline hover:text-primary transition-colors bg-surface rounded-full p-2 flex items-center justify-center z-20 shadow-sm">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                                <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-primary mb-2 pr-8">{{ $srv->title }}</h2>
                                <div class="w-12 h-1 bg-secondary mb-6"></div>
                                <h4 class="font-bold text-sm text-on-surface-variant uppercase tracking-widest mb-3">Deskripsi Layanan</h4>
                                <p class="text-on-surface-variant leading-relaxed mb-8">{{ $srv->description }}</p>
                                
                                <div class="mt-auto pt-6 border-t border-outline-variant/30 flex justify-end gap-4">
                                    <button onclick="closeModal('serviceModal{{ $srv->id }}')" class="px-6 py-2.5 rounded-full border border-outline text-on-surface-variant hover:bg-surface transition-colors font-medium text-sm">Tutup</button>
                                    <a href="{{ route('contact') }}" class="px-6 py-2.5 rounded-full bg-primary text-white hover:bg-secondary transition-colors font-medium text-sm">Konsultasi Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-on-surface-variant py-12">
                        Belum ada layanan tersedia saat ini.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.3s ease-out forwards;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    
    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }
        
        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = '';
            }
        }
    </script>
@endsection
