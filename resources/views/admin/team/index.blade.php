@extends('layouts.admin')

@section('header_title', 'Kelola Tim Ahli')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="font-head fw-bold mb-0">Daftar Tenaga Ahli</h5>
            <a href="{{ route('admin.team.create') }}" class="btn btn-gold btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Anggota Tim
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="small text-uppercase text-secondary border-bottom">
                        <th class="py-3">Tenaga Ahli</th>
                        <th class="py-3">Keahlian</th>
                        <th class="py-3">Sertifikat</th>
                        <th class="py-3">Urutan</th>
                        <th class="py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($team as $member)
                        <tr class="border-bottom">
                            <td class="py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 50px; height: 50px; overflow: hidden; background-color: #ECECEC;">
                                        <img src="{{ $member->photo_path ? Storage::url($member->photo_path) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=100&q=80' }}" class="w-100 h-100" style="object-fit: cover;" alt="Photo">
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $member->name }}</div>
                                        <small class="text-gold fw-bold text-uppercase" style="font-size: 0.75rem;">{{ $member->position }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 small text-secondary">{{ $member->skills ?? '-' }}</td>
                            <td class="py-3 small text-muted">{{ $member->certificate ?? '-' }}</td>
                            <td class="py-3 small">{{ $member->order }}</td>
                            <td class="py-3 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.team.edit', $member->id) }}" class="btn btn-light btn-sm border py-1 px-3">Edit</a>
                                    <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm text-white py-1 px-2"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Belum ada data anggota tim.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
