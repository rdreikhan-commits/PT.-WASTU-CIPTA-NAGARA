@extends('layouts.admin')

@section('header_title', 'Edit Akun Klien: ' . $client->name)

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4" style="max-width: 600px;">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Ubah Data Klien</h5>
        
        <form action="{{ route('admin.clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Nama Perusahaan Klien / Nama Personal</label>
                <input type="text" name="name" class="form-control rounded-0" value="{{ $client->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Alamat Email Klien</label>
                <input type="email" name="email" class="form-control rounded-0" value="{{ $client->email }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase">Kata Sandi Baru (Biarkan kosong jika tidak diganti)</label>
                <input type="password" name="password" class="form-control rounded-0" placeholder="Masukkan kata sandi baru jika ingin diubah">
            </div>

            <button type="submit" class="btn btn-gold w-100 py-3">SIMPAN PERUBAHAN</button>
        </form>
    </div>

@endsection
