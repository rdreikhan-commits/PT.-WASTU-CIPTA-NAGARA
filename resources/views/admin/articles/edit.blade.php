@extends('layouts.admin')

@section('header_title', 'Edit Artikel: ' . $article->title)

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Ubah Data Artikel</h5>
        
        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label small fw-bold text-uppercase">Judul Artikel</label>
                    <input type="text" name="title" class="form-control rounded-0" value="{{ $article->title }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Kategori</label>
                    <input type="text" name="category" class="form-control rounded-0" value="{{ $article->category }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Tags (Koma Terpisah)</label>
                    <input type="text" name="tags" class="form-control rounded-0" value="{{ $article->tags }}">
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold text-uppercase">Konten Artikel</label>
                    <textarea name="content" rows="12" class="form-control rounded-0" required>{{ $article->content }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Gambar Sampul (Thumbnail)</label>
                    <input type="file" name="thumbnail" class="form-control rounded-0" accept="image/*">
                    @if($article->thumbnail)
                        <div class="mt-2 small text-muted">Thumbnail saat ini: `{{ basename($article->thumbnail) }}`</div>
                    @endif
                </div>

                <div class="col-md-6">
                    <div class="form-check mt-4">
                        <input type="checkbox" name="is_published" value="1" class="form-check-input rounded-0" id="is_published" @if($article->is_published) checked @endif>
                        <label class="form-check-label small fw-bold text-uppercase" for="is_published">Terbitkan (Publish)</label>
                    </div>
                </div>

                <!-- SEO -->
                <div class="col-12 mt-5">
                    <h6 class="font-head text-gold text-uppercase fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 0.05em;">SEO Metadata Artikel (Opsional)</h6>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">SEO Meta Title</label>
                    <input type="text" name="seo_title" class="form-control rounded-0" value="{{ $article->seo_title }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">SEO Meta Keywords</label>
                    <input type="text" name="seo_keywords" class="form-control rounded-0" value="{{ $article->seo_keywords }}">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold text-uppercase">SEO Meta Description</label>
                    <textarea name="seo_description" rows="3" class="form-control rounded-0">{{ $article->seo_description }}</textarea>
                </div>

                <div class="col-12 mt-5">
                    <button type="submit" class="btn btn-gold w-100 py-3">SIMPAN PERUBAHAN</button>
                </div>
            </div>
        </form>
    </div>

@endsection
