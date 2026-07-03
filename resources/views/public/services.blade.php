@extends('layouts.public')

@section('title', 'Layanan Jasa - PT. Wastu Cipta Nagara')

@section('content')

    <!-- Banner -->
    <section class="py-5 bg-dark text-white text-center">
        <div class="container py-5" data-aos="fade-up">
            <h1 class="font-head text-white fs-1 mb-2">Layanan Jasa Kami</h1>
            <p class="text-white-50">Solusi Konsultasi Arsitektur, Engineering, & BIM Terintegrasi</p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-4">
                @forelse($services as $srv)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="service-card d-flex flex-column justify-content-between h-100">
                            <div>
                                <div class="icon-box">
                                    <i class="bi {{ $srv->icon ?? 'bi-building' }}"></i>
                                </div>
                                <h3 class="font-head fw-bold mb-3" style="font-size: 1.25rem;">{{ $srv->title }}</h3>
                                <p class="text-muted small" style="line-height: 1.7;">{{ $srv->description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        Belum ada layanan tersedia saat ini.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
