@extends('layouts.admin')

@section('header_title', 'Tambah Staf Admin')

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
                    <h5 class="font-head fw-bold mb-4 border-bottom pb-3">Form Pembuatan Akun Staf Admin</h5>
                    
                    <form action="{{ route('admin.admins.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-uppercase">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control rounded-0" placeholder="Masukkan nama staf" value="{{ old('name') }}" required>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label small fw-bold text-uppercase">Alamat Email</label>
                                <input type="email" name="email" class="form-control rounded-0" placeholder="nama@wastucipta.com" value="{{ old('email') }}" required>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label small fw-bold text-uppercase">Kata Sandi (Password)</label>
                                <input type="password" name="password" class="form-control rounded-0" placeholder="Minimal 6 karakter" required>
                            </div>
                            
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-gold w-100 py-3 fw-bold">SIMPAN & BUAT AKUN ADMIN</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="bg-primary text-white p-4 rounded-3 h-100">
                <h6 class="font-head fw-bold mb-3"><i class="bi bi-info-circle me-2"></i> Informasi Hak Akses</h6>
                <p class="small opacity-75 mb-3">Akun baru yang Anda buat ini akan mendapatkan status <strong>ADMIN</strong>.</p>
                <ul class="small opacity-75 ps-3 mb-0" style="line-height: 1.8;">
                    <li>Bisa menambah/mengedit proyek portfolio</li>
                    <li>Bisa membalas pesan masuk</li>
                    <li>Bisa membuat artikel blog</li>
                    <li>Bisa melihat semua data klien</li>
                    <li><strong>Tidak bisa</strong> menghapus akun Super Admin.</li>
                </ul>
            </div>
        </div>
    </div>

@endsection
