@extends('layouts.public')

@section('title', 'Tim Tenaga Ahli - PT. Wastu Cipta Nagara')

@section('content')

    <!-- Banner -->
    <section class="py-5 bg-dark text-white text-center">
        <div class="container py-5" data-aos="fade-up">
            <h1 class="font-head text-white fs-1 mb-2">Tim Ahli Kami</h1>
            <p class="text-white-50">Insinyur & Arsitek Profesional Berlisensi</p>
        </div>
    </section>

    <!-- Team Grid -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-4">
                @forelse($team as $member)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="team-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <!-- Grayscale hover reveal image -->
                                <img src="{{ $member->photo_path ? Storage::url($member->photo_path) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80' }}" class="team-photo" alt="{{ $member->name }}">
                                <h5 class="font-head fw-bold mb-1" style="font-size: 1.1rem;">{{ $member->name }}</h5>
                                <span class="text-gold small d-block mb-3" style="font-size: 0.8rem; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">{{ $member->position }}</span>
                                
                                @if($member->certificate)
                                    <div class="bg-light p-2 mb-3 small text-muted border-start border-3 border-gold" style="font-size: 0.75rem;">
                                        <strong>Sertifikat:</strong> {{ $member->certificate }}
                                    </div>
                                @endif
                                
                                <p class="text-muted small" style="line-height: 1.6;">{{ $member->description }}</p>
                            </div>
                            
                            @if($member->linkedin_url)
                                <div class="mt-3">
                                    <a href="{{ $member->linkedin_url }}" target="_blank" class="btn btn-outline-dark btn-sm rounded-0 w-100" style="font-size: 0.8rem;">
                                        <i class="bi bi-linkedin me-1"></i> LinkedIn Profile
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        Belum ada data tenaga ahli yang dimasukkan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
