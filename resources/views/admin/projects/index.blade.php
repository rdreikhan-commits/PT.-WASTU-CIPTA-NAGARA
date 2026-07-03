@extends('layouts.admin')

@section('header_title', 'Daftar Portfolio Proyek')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="font-head fw-bold mb-0">Semua Proyek</h5>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-gold btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Proyek Baru
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="small text-uppercase text-secondary border-bottom">
                        <th class="py-3">Proyek</th>
                        <th class="py-3">Klien</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Status</th>
                        <th class="py-3">Tahun</th>
                        <th class="py-3">Featured?</th>
                        <th class="py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $proj)
                        <tr class="border-bottom">
                            <td class="py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 50px; height: 50px; overflow: hidden; background-color: #ECECEC;">
                                        <img src="{{ $proj->cover_image ? Storage::url($proj->cover_image) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=100&q=80' }}" class="w-100 h-100" style="object-fit: cover;" alt="Cover">
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $proj->title }}</div>
                                        <small class="text-muted"><i class="bi bi-geo-alt-fill text-gold me-1"></i>{{ $proj->location }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                @if($proj->client)
                                    <span class="fw-bold small text-secondary">{{ $proj->client->name }}</span>
                                @else
                                    <span class="text-muted small">Publik / Umum</span>
                                @endif
                            </td>
                            <td class="py-3 small text-secondary">{{ $proj->category }}</td>
                            <td class="py-3">
                                @if($proj->status === 'completed')
                                    <span class="badge bg-success rounded-0">Selesai</span>
                                @elseif($proj->status === 'ongoing')
                                    <span class="badge bg-warning text-dark rounded-0">Berjalan</span>
                                @else
                                    <span class="badge bg-secondary rounded-0">Perencanaan</span>
                                @endif
                            </td>
                            <td class="py-3 small">{{ $proj->year }}</td>
                            <td class="py-3">
                                @if($proj->is_featured)
                                    <span class="badge bg-gold rounded-0 text-white"><i class="bi bi-star-fill me-1"></i> Ya</span>
                                @else
                                    <span class="text-muted small">Tidak</span>
                                @endif
                            </td>
                            <td class="py-3 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.projects.show', $proj->id) }}" class="btn btn-outline-dark btn-sm py-1 px-3">
                                        <i class="bi bi-eye"></i> Kelola
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $proj->id) }}" class="btn btn-light btn-sm py-1 px-2 border">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $proj->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini? Seluruh progress, berkas, dan komentar terkait akan terhapus secara permanen.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm py-1 px-2 text-white">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">Belum ada proyek ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
