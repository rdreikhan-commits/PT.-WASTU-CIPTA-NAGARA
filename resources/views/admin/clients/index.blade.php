@extends('layouts.admin')

@section('header_title', 'Manajemen Akun Klien')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="font-head fw-bold mb-0">Daftar Akun Klien</h5>
            <a href="{{ route('admin.clients.create') }}" class="btn btn-gold btn-sm">
                <i class="bi bi-person-plus me-1"></i> Buat Akun Klien Baru
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="small text-uppercase text-secondary border-bottom">
                        <th class="py-3">Nama Klien</th>
                        <th class="py-3">Alamat Email</th>
                        <th class="py-3">Jumlah Proyek</th>
                        <th class="py-3">Terdaftar Sejak</th>
                        <th class="py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $c)
                        <tr class="border-bottom">
                            <td class="py-3 fw-bold text-dark">{{ $c->name }}</td>
                            <td class="py-3 small text-secondary">{{ $c->email }}</td>
                            <td class="py-3"><span class="badge bg-gold text-white rounded-0 px-2">{{ $c->projects_count }} Proyek</span></td>
                            <td class="py-3 small text-muted">{{ $c->created_at->format('d M Y') }}</td>
                            <td class="py-3 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.clients.edit', $c->id) }}" class="btn btn-light btn-sm border py-1 px-3">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.clients.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun klien ini? Klien ini tidak akan bisa login lagi ke portal.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm text-white py-1 px-2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Belum ada akun klien terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
