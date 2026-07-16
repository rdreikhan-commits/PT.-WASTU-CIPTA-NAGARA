@extends('layouts.admin')

@section('header_title', 'Edit Staf Admin')

@section('content')

    <div class="mb-4">
        <a href="{{ route('admin.admins.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Admin
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm admin-card">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                        <div class="topbar-avatar me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--brand-red), var(--brand-red-light)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 24px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <h5 class="font-head fw-bold mb-0">Edit Profil Staf Admin</h5>
                            <p class="text-muted small mb-0">Kelola akun staf: {{ $admin->name }}</p>
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-4">
                            
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-uppercase">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control rounded-0" value="{{ old('name', $admin->name) }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-uppercase">Alamat Email</label>
                                <input type="email" name="email" class="form-control rounded-0" value="{{ old('email', $admin->email) }}" required>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <div class="bg-light p-3 border-start border-4 border-warning">
                                    <h6 class="font-head fw-bold mb-1" style="font-size: 0.8rem;">Ganti Kata Sandi (Opsional)</h6>
                                    <p class="small text-muted mb-3">Kosongkan kolom ini jika Anda tidak ingin mengubah kata sandi akun ini.</p>
                                    <input type="password" name="password" class="form-control rounded-0" placeholder="Ketik kata sandi baru jika ingin diubah">
                                </div>
                            </div>
                            
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-gold w-100 py-3 fw-bold">SIMPAN PERUBAHAN AKUN</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
