@extends('layouts.public')

@section('title', 'Tentang Kami - PT. Wastu Cipta Nagara')

@section('content')

    <!-- Banner -->
    <section class="py-5 bg-dark text-white text-center">
        <div class="container py-5" data-aos="fade-up">
            <h1 class="font-head text-white fs-1 mb-2">Tentang Kami</h1>
            <p class="text-white-50">Filosofi, Visi, Misi, dan Perjalanan PT. Wastu Cipta Nagara</p>
        </div>
    </section>

    <!-- Philosophy -->
    <section class="py-5" style="background-color: #FFF;">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h6 class="text-uppercase text-secondary fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 0.1em;">Filosofi Kami</h6>
                    <h2 class="font-head mb-4 fs-1">Makna Di Balik Nama <span class="text-gold">Wastu</span></h2>
                    <p class="text-muted">Dalam bahasa Sansekerta kuno, "Wastu" atau "Vastu" berarti arsitektur, pondasi bumi, dan penataan ruang harmonis. Filosofi Wastu mengajarkan bahwa bangunan bukanlah benda mati, melainkan sebuah ruang yang hidup dan berinteraksi secara energi dengan manusia yang menempatinya.</p>
                    <p class="text-muted">Kami mendirikan PT. Wastu Cipta Nagara dengan memadukan prinsip luhur penataan ruang klasik tersebut dengan teknologi modern dan desain minimalis-mewah demi menciptakan konstruksi masa kini yang ikonik, fungsional, dan berenergi positif.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80" class="img-fluid border border-light shadow" alt="Architecture Drawing">
                </div>
            </div>
        </div>
    </section>

    <!-- Vision, Mission & Values -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6" data-aos="fade-up">
                    <div class="p-5 bg-white border border-light shadow-sm h-100">
                        <h4 class="font-head fw-bold text-gold mb-3 text-uppercase" style="font-size: 1.1rem; letter-spacing: 0.05em;">Visi Perusahaan</h4>
                        <p class="text-muted">Menjadi konsultan arsitektur, engineering, dan konstruksi terdepan di Indonesia yang dikenal karena keunggulan estetika modern minimalis, inovasi teknologi BIM terintegrasi, serta integritas profesionalisme yang tinggi.</p>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 bg-white border border-light shadow-sm h-100">
                        <h4 class="font-head fw-bold text-gold mb-3 text-uppercase" style="font-size: 1.1rem; letter-spacing: 0.05em;">Misi Perusahaan</h4>
                        <ul class="text-muted ps-3">
                            <li class="mb-2">Menghadirkan perencanaan desain arsitektur bernilai estetika tinggi, fungsional, dan ramah lingkungan.</li>
                            <li class="mb-2">Menyediakan gambar kerja detail engineering (DED) yang presisi berbasis koordinasi BIM multi-disiplin.</li>
                            <li class="mb-2">Mengoptimalkan operasional dan transparansi dengan portal digital monitoring untuk kenyamanan klien.</li>
                            <li>Mengembangkan kapabilitas tenaga ahli lokal agar mampu bersaing di kancah regional.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive History Timeline -->
    <section class="py-5" style="background-color: #FFF;">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-uppercase text-secondary fw-bold mb-2" style="font-size: 0.8rem; letter-spacing: 0.1em;">Sejarah Kami</h6>
                <h2 class="font-head fs-1">Milestone Perjalanan <span class="text-gold">Perusahaan</span></h2>
            </div>

            <div class="timeline-wrapper">
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-date">2014</div>
                    <div class="timeline-content">
                        <h4 class="font-head text-gold">Pendirian Awal</h4>
                        <p class="text-muted small">Wastu didirikan sebagai studio butik arsitektur di Jakarta dengan fokus utama perancangan hunian mewah eksklusif.</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-date">2018</div>
                    <div class="timeline-content">
                        <h4 class="font-head text-gold">Ekspansi Jasa Engineering</h4>
                        <p class="text-muted small">Membentuk divisi Detailed Engineering Design (DED) struktur dan mekanikal-elektrikal untuk melayani proyek gedung perkantoran komersial.</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-date">2021</div>
                    <div class="timeline-content">
                        <h4 class="font-head text-gold">Penerapan BIM LOD 400</h4>
                        <p class="text-muted small">Mengadopsi pemodelan Building Information Modeling (BIM) terintegrasi secara penuh guna menjamin akurasi kuantitas (RAB) dan meminimalkan clash desain.</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-date">2026</div>
                    <div class="timeline-content">
                        <h4 class="font-head text-gold">Portal Manajemen Proyek</h4>
                        <p class="text-muted small">Meluncurkan platform monitoring digital terpadu untuk kolaborasi real-time antara tim konsultan dan klien korporat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
