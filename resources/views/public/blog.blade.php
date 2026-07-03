@extends('layouts.public')

@section('title', 'Artikel & Berita - PT. Wastu Cipta Nagara')

@section('content')

    <!-- Banner -->
    <section class="py-5 bg-dark text-white text-center">
        <div class="container py-5" data-aos="fade-up">
            <h1 class="font-head text-white fs-1 mb-2">Artikel & Berita</h1>
            <p class="text-white-50">Tips Perencanaan Arsitektur, Desain Interior, & Update Teknologi Konstruksi</p>
        </div>
    </section>

    <!-- Blog Posts List -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            @if($articles->isEmpty())
                <div class="text-center py-5 text-muted" data-aos="fade-up">
                    <i class="bi bi-journal-x fs-1 d-block mb-3"></i>
                    Belum ada artikel yang diterbitkan saat ini.
                </div>
            @else
                <div class="row g-4">
                    @foreach($articles as $art)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <div class="border border-light shadow-sm bg-white p-3 h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="mb-3" style="aspect-ratio: 16/9; overflow: hidden; background-color: #ECECEC;">
                                        <img src="{{ $art->thumbnail ? Storage::url($art->thumbnail) : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=600&q=80' }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $art->title }}">
                                    </div>
                                    <span class="text-gold small text-uppercase fw-bold">{{ $art->category ?? 'Berita' }}</span>
                                    <h5 class="font-head my-2" style="font-size: 1.1rem; line-height: 1.4;">{{ $art->title }}</h5>
                                    <p class="text-muted small" style="line-height: 1.6;">{{ Str::limit(strip_tags($art->content), 120) }}</p>
                                </div>
                                <div class="mt-3 border-top pt-3 d-flex justify-content-between align-items-center">
                                    <span class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-calendar-event me-1"></i>{{ $art->created_at->format('d M Y') }}</span>
                                    <a href="{{ route('blog.detail', $art->slug) }}" class="small text-dark fw-bold hover-gold">Selengkapnya <i class="bi-arrow-right-short"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $articles->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </section>

@endsection
