@extends('layouts.public')

@section('title', 'Hubungi Kami - PT. Wastu Cipta Nagara')

@section('content')

    <!-- Banner -->
    <section class="py-5 bg-dark text-white text-center">
        <div class="container py-5" data-aos="fade-up">
            <h1 class="font-head text-white fs-1 mb-2">Hubungi Kami</h1>
            <p class="text-white-50">Silakan Hubungi Kami atau Kirim Pesan Melalui Form di Bawah Ini</p>
        </div>
    </section>

    <!-- Contact Form & Info -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            
            @if(session('success'))
                <div class="alert alert-success border-0 rounded-0 shadow-sm mb-5" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="row g-5">
                
                <!-- Contact Info Panel -->
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="p-5 bg-white border border-light shadow-sm h-100">
                        <h3 class="font-head fw-bold mb-4">Informasi Kantor</h3>
                        
                        <div class="d-flex align-items-start gap-3 mb-4">
                            <div class="bg-light p-3 text-gold fs-4"><i class="bi bi-geo-alt"></i></div>
                            <div>
                                <h6 class="font-head fw-bold mb-1">Alamat Kantor Pusat</h6>
                                <p class="text-muted small mb-0">{{ $settings['company_address'] ?? '' }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-light p-3 text-gold fs-4"><i class="bi bi-telephone"></i></div>
                            <div>
                                <h6 class="font-head fw-bold mb-1">Telepon</h6>
                                <p class="text-muted small mb-0">{{ $settings['company_phone'] ?? '' }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-light p-3 text-gold fs-4"><i class="bi bi-envelope"></i></div>
                            <div>
                                <h6 class="font-head fw-bold mb-1">Email Resmi</h6>
                                <p class="text-muted small mb-0">{{ $settings['company_email'] ?? '' }}</p>
                            </div>
                        </div>

                        <!-- WhatsApp CTA -->
                        @if(!empty($settings['company_whatsapp']))
                            <div class="mt-5">
                                <a href="https://wa.me/{{ $settings['company_whatsapp'] }}?text=Halo%20tim%20Wastu,%20saya%20tertarik%20untuk%20konsultasi%20desain." target="_blank" class="btn btn-gold w-100 py-3">
                                    <i class="bi bi-whatsapp me-2"></i> HUBUNGI LEWAT WHATSAPP
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Form Panel -->
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="p-5 bg-white border border-light shadow-sm h-100">
                        <h3 class="font-head fw-bold mb-4">Kirim Pesan</h3>
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small text-uppercase text-secondary fw-bold">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control rounded-0" placeholder="Masukkan nama Anda" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-uppercase text-secondary fw-bold">Alamat Email</label>
                                    <input type="email" name="email" class="form-control rounded-0" placeholder="nama@email.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-uppercase text-secondary fw-bold">Nomor Telepon</label>
                                    <input type="text" name="phone" class="form-control rounded-0" placeholder="+62...">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-uppercase text-secondary fw-bold">Subjek</label>
                                    <input type="text" name="subject" class="form-control rounded-0" placeholder="Subjek pesan">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-uppercase text-secondary fw-bold">Isi Pesan</label>
                                    <textarea name="message" rows="5" class="form-control rounded-0" placeholder="Tuliskan pesan atau rencana proyek Anda secara detail di sini..." required></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-gold w-100 py-3">KIRIM PESAN SEKARANG</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Map Iframe Embed -->
            @if(!empty($settings['company_maps']))
                <div class="mt-5" data-aos="fade-up">
                    <div class="p-3 bg-white border border-light shadow-sm">
                        <iframe src="{{ $settings['company_maps'] }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            @endif

        </div>
    </section>

@endsection
