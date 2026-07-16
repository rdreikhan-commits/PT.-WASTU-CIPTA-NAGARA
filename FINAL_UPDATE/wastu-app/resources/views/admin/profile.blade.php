@extends('layouts.admin')

@section('header_title', 'Profil Saya')

@section('content')

    <div class="row g-4">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm bg-white p-4">
                <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                    <div class="topbar-avatar me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--brand-red), var(--brand-red-light)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 24px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div>
                        <h5 class="font-head fw-bold mb-0">Pengaturan Profil</h5>
                        <p class="text-muted small mb-0">Kelola informasi data diri dan kata sandi Anda</p>
                    </div>
                </div>
                
                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4">
                        
                        <!-- 1. General Profile -->
                        <div class="col-12">
                            <h6 class="font-head text-gold text-uppercase fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 0.05em;">Informasi Dasar</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-uppercase">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control rounded-0" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-uppercase">Alamat Email</label>
                            <input type="email" name="email" class="form-control rounded-0" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <!-- 2. Password Reset -->
                        <div class="col-12 mt-5">
                            <h6 class="font-head text-gold text-uppercase fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 0.05em;">Ubah Kata Sandi (Opsional)</h6>
                            <p class="small text-muted mb-4">Biarkan kosong jika Anda tidak ingin mengubah kata sandi Anda saat ini.</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-uppercase">Kata Sandi Baru</label>
                            <input type="password" name="password" class="form-control rounded-0" placeholder="Minimal 6 karakter">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-uppercase">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation" class="form-control rounded-0" placeholder="Ulangi kata sandi baru">
                        </div>

                        <div class="col-12 mt-5">
                            <button type="submit" class="btn btn-gold w-100 py-3 fw-bold">SIMPAN PERUBAHAN</button>
                        </div>
                        
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

@endsection
