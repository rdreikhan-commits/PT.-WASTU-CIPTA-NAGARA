@extends('layouts.public')

@section('title', $article->title . ' - PT. Wastu Cipta Nagara')

@section('content')

    <!-- Article Header -->
    <section class="py-5 bg-dark text-white">
        <div class="container py-5 text-center" data-aos="fade-up">
            <span class="text-gold text-uppercase fw-bold small tracking-widest">{{ $article->category ?? 'Berita' }}</span>
            <h1 class="font-head text-white fs-2 my-3 mx-auto" style="max-width: 800px; line-height: 1.3;">{{ $article->title }}</h1>
            <p class="text-white-50"><i class="bi bi-calendar-event me-2"></i>{{ $article->created_at->format('d M Y') }}</p>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-5" style="background-color: #FFF;">
        <div class="container">
            <div class="row g-5">
                
                <!-- Main Content Column -->
                <div class="col-lg-8" data-aos="fade-right">
                    @if($article->thumbnail)
                        <div class="mb-4 shadow-sm" style="aspect-ratio: 21/9; overflow: hidden; background-color: #000;">
                            <img src="{{ Storage::url($article->thumbnail) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $article->title }}">
                        </div>
                    @endif

                    <div class="article-body text-muted py-3" style="line-height: 1.8; font-size: 1.05rem;">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    <!-- Tags -->
                    @if($article->tags)
                        <div class="mt-4 pt-4 border-top">
                            <span class="small text-uppercase fw-bold text-secondary me-2">TAGS:</span>
                            @foreach(explode(',', $article->tags) as $tag)
                                <span class="badge bg-light text-dark border p-2 me-1 small">{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Recent Articles Sidebar -->
                <div class="col-lg-4" data-aos="fade-left">
                    <div class="p-4 border border-light shadow-sm bg-light mb-4">
                        <h4 class="font-head fw-bold mb-4 text-uppercase text-secondary" style="font-size: 0.9rem; letter-spacing: 0.08em;">Artikel Terbaru</h4>
                        
                        @forelse($recentArticles as $recent)
                            <div class="mb-4 pb-3 border-bottom">
                                <span class="text-gold small d-block mb-1 text-uppercase fw-bold" style="font-size: 0.75rem;">{{ $recent->category }}</span>
                                <h6 class="font-head mb-1">
                                    <a href="{{ route('blog.detail', $recent->slug) }}" class="text-dark hover-gold" style="font-size: 0.95rem; line-height: 1.4;">
                                        {{ $recent->title }}
                                    </a>
                                </h6>
                                <span class="text-muted" style="font-size: 0.75rem;">{{ $recent->created_at->format('d M Y') }}</span>
                            </div>
                        @empty
                            <p class="text-muted small">Tidak ada artikel lain.</p>
                        @endforelse
                    </div>

                    <div class="p-4 border border-gold bg-white text-center">
                        <h5 class="font-head text-gold mb-3">Butuh Konsultasi?</h5>
                        <p class="small text-muted">Tim kami siap membantu Anda menyusun perencanaan terbaik.</p>
                        <a href="{{ route('contact') }}" class="btn btn-gold w-100 btn-sm">HUBUNGI KAMI</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
