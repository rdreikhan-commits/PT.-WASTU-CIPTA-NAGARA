@extends('layouts.admin')

@section('header_title', 'Kelola Layanan Jasa')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="font-head fw-bold mb-0">Semua Layanan Jasa</h5>
            <a href="{{ route('admin.services.create') }}" class="btn btn-gold btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Layanan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="small text-uppercase text-secondary border-bottom">
                        <th class="py-3" style="width: 80px;">Icon</th>
                        <th class="py-3">Nama Layanan</th>
                        <th class="py-3">Deskripsi Singkat</th>
                        <th class="py-3">Urutan</th>
                        <th class="py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $srv)
                        <tr class="border-bottom">
                            <td class="py-3 fs-4 text-gold"><i class="bi {{ $srv->icon ?? 'bi-building' }}"></i></td>
                            <td class="py-3 fw-bold text-dark">{{ $srv->title }}</td>
                            <td class="py-3 text-muted small">{{ Str::limit($srv->description, 100) }}</td>
                            <td class="py-3 small">{{ $srv->order }}</td>
                            <td class="py-3 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.services.edit', $srv->id) }}" class="btn btn-light btn-sm border py-1 px-3">Edit</a>
                                    <form action="{{ route('admin.services.destroy', $srv->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm text-white py-1 px-2"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Belum ada layanan ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
