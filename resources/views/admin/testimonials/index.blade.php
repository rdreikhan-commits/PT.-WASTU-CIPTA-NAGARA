@extends('layouts.admin')

@section('header_title', 'Kelola Testimoni Klien')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="font-head fw-bold mb-0">Daftar Testimoni</h5>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-gold btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Testimoni
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="small text-uppercase text-secondary border-bottom">
                        <th class="py-3">Nama Klien</th>
                        <th class="py-3">Perusahaan / Jabatan</th>
                        <th class="py-3">Rating</th>
                        <th class="py-3">Teks Ulasan</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $t)
                        <tr class="border-bottom">
                            <td class="py-3 fw-bold text-dark">{{ $t->client_name }}</td>
                            <td class="py-3 small text-secondary">{{ $t->client_company ?? '-' }}</td>
                            <td class="py-3 text-gold">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $t->rating)
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </td>
                            <td class="py-3 text-muted small">{{ Str::limit($t->testimonial, 100) }}</td>
                            <td class="py-3">
                                @if($t->is_approved)
                                    <span class="badge bg-success rounded-0">Disetujui</span>
                                @else
                                    <span class="badge bg-secondary rounded-0">Draft</span>
                                @endif
                            </td>
                            <td class="py-3 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.testimonials.edit', $t->id) }}" class="btn btn-light btn-sm border py-1 px-3">Edit</a>
                                    <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm text-white py-1 px-2"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Belum ada testimoni ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
