@extends('layouts.admin')

@section('header_title', 'Tambah Anggota Tim Baru')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4" style="max-width: 600px;">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Form Data Anggota Tim</h5>
        
        <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Nama Lengkap & Gelar</label>
                <input type="text" name="name" class="form-control rounded-0" placeholder="Contoh: Prof. Ir. Wibowo Nagara, M.Arch." required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Jabatan</label>
                <input type="text" name="position" class="form-control rounded-0" placeholder="Contoh: Principal Architect & Founder" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Keahlian Utama (Koma Terpisah)</label>
                <input type="text" name="skills" class="form-control rounded-0" placeholder="Contoh: Masterplanning, Sustainable Design">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Sertifikasi & Lisensi Professional</label>
                <input type="text" name="certificate" class="form-control rounded-0" placeholder="Contoh: IAI Utama, GBCI Certified">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">LinkedIn Profile URL</label>
                <input type="url" name="linkedin_url" class="form-control rounded-0" placeholder="https://linkedin.com/in/username">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Deskripsi Singkat / Biografi</label>
                <textarea name="description" rows="3" class="form-control rounded-0" placeholder="Lebih dari 20 tahun memimpin perancangan..."></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Foto Professional (1:1 / Kotak)</label>
                <input type="file" name="photo_path" class="form-control rounded-0" accept="image/*">
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase">Urutan Tampil (Order Number)</label>
                <input type="number" name="order" class="form-control rounded-0" value="0">
            </div>

            <button type="submit" class="btn btn-gold w-100 py-3">BUAT PROFIL TIM</button>
        </form>
    </div>

@endsection
