@extends('layouts.admin')

@section('header_title', 'Kelola Artikel Blog')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="font-head fw-bold mb-0">Daftar Artikel</h5>
            <a href="{{ route('admin.articles.create') }}" class="btn btn-gold btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tulis Artikel Baru
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="small text-uppercase text-secondary border-bottom">
                        <th class="py-3">Judul Artikel</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Status</th>
                        <th class="py-3">Tanggal Dibuat</th>
                        <th class="py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $art)
                        <tr class="border-bottom">
                            <td class="py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 50px; height: 50px; overflow: hidden; background-color: #ECECEC;">
                                        <img src="{{ $art->thumbnail ? Storage::url($art->thumbnail) : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=100&q=80' }}" class="w-100 h-100" style="object-fit: cover;" alt="Thumbnail">
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $art->title }}</div>
                                        <small class="text-muted"><i class="bi bi-tag-fill me-1"></i>Tags: {{ $art->tags ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 small text-secondary">{{ $art->category ?? '-' }}</td>
                            <td class="py-3">
                                @if($art->is_published)
                                    <span class="badge bg-success rounded-0">Published</span>
                                @else
                                    <span class="badge bg-secondary rounded-0">Draft</span>
                                @endif
                            </td>
                            <td class="py-3 small text-muted">{{ $art->created_at->format('d M Y') }}</td>
                            <td class="py-3 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.articles.edit', $art->id) }}" class="btn btn-light btn-sm border py-1 px-3">Edit</a>
                                    <form action="{{ route('admin.articles.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm text-white py-1 px-2"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Belum ada artikel diterbitkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
