@extends('layouts.admin')

@section('header_title', 'Manajemen Staf Admin')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="font-head fw-bold mb-0">Daftar Akun Admin</h5>
        <a href="{{ route('admin.admins.create') }}" class="btn btn-gold fw-bold">
            <i class="bi bi-plus-lg me-2"></i> Tambah Admin Baru
        </a>
    </div>

    <div class="card border-0 shadow-sm admin-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-uppercase" style="font-size: 11px; letter-spacing: 0.05em;">
                        <tr>
                            <th class="ps-4 py-3 text-secondary">No</th>
                            <th class="py-3 text-secondary">Nama Lengkap</th>
                            <th class="py-3 text-secondary">Email</th>
                            <th class="py-3 text-secondary">Role</th>
                            <th class="py-3 text-secondary text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        @forelse($admins as $index => $admin)
                            <tr>
                                <td class="ps-4">{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $admin->name }} 
                                    @if($admin->id == 1)
                                        <span class="badge bg-danger ms-2" style="font-size: 10px;">SUPER ADMIN</span>
                                    @endif
                                </td>
                                <td class="text-muted">{{ $admin->email }}</td>
                                <td><span class="badge bg-dark">ADMIN</span></td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        @if($admin->id != 1 && auth()->id() != $admin->id)
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm('Yakin ingin menghapus admin ini? Mereka tidak akan bisa login lagi.')) document.getElementById('delete-admin-{{ $admin->id }}').submit()">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                        <form id="delete-admin-{{ $admin->id }}" action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">Belum ada akun admin lain yang ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
