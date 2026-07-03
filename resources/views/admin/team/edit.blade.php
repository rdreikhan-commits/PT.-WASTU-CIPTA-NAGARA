@extends('layouts.admin')

@section('header_title', 'Edit Anggota Tim: ' . $member->name)

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4" style="max-width: 600px;">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Ubah Data Anggota Tim</h5>
        
        <form action="{{ route('admin.team.update', $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Nama Lengkap & Gelar</label>
                <input type="text" name="name" class="form-control rounded-0" value="{{ $member->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Jabatan</label>
                <input type="text" name="position" class="form-control rounded-0" value="{{ $member->position }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Keahlian Utama (Koma Terpisah)</label>
                <input type="text" name="skills" class="form-control rounded-0" value="{{ $member->skills }}">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Sertifikasi & Lisensi Professional</label>
                <input type="text" name="certificate" class="form-control rounded-0" value="{{ $member->certificate }}">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">LinkedIn Profile URL</label>
                <input type="url" name="linkedin_url" class="form-control rounded-0" value="{{ $member->linkedin_url }}">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Deskripsi Singkat / Biografi</label>
                <textarea name="description" rows="3" class="form-control rounded-0">{{ $member->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Foto Professional (Biarkan kosong jika tidak diganti)</label>
                <input type="file" name="photo_path" class="form-control rounded-0" accept="image/*">
                @if($member->photo_path)
                    <div class="mt-2 small text-muted">Foto saat ini: `{{ basename($member->photo_path) }}`</div>
                @endif
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase">Urutan Tampil (Order Number)</label>
                <input type="number" name="order" class="form-control rounded-0" value="{{ $member->order }}">
            </div>

            <button type="submit" class="btn btn-gold w-100 py-3">SIMPAN PERUBAHAN</button>
        </form>
    </div>

@endsection
