@extends('layouts.admin')

@section('header_title', 'Buat Akun Klien Baru')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4" style="max-width: 600px;">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Form Registrasi Klien</h5>
        
        <form action="{{ route('admin.clients.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Nama Perusahaan Klien / Nama Personal</label>
                <input type="text" name="name" class="form-control rounded-0" placeholder="Masukkan nama klien" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Alamat Email Klien (Untuk Login)</label>
                <input type="email" name="email" class="form-control rounded-0" placeholder="klien@email.com" required>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase">Kata Sandi Awal</label>
                <input type="text" name="password" class="form-control rounded-0" placeholder="Minimal 6 karakter" required>
                <small class="text-muted">Klien dapat memperbarui kata sandi ini setelah masuk pertama kali.</small>
            </div>

            <button type="submit" class="btn btn-gold w-100 py-3">BUAT AKUN KLIEN</button>
        </form>
    </div>

@endsection
