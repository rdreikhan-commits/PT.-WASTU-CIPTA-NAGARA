@extends('layouts.admin')

@section('header_title', 'Tambah Proyek Baru')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Form Data Proyek</h5>
        
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Nama Proyek</label>
                    <input type="text" name="title" class="form-control rounded-0" placeholder="Contoh: Gedung Lumina Tower" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Hubungkan Akun Klien (Opsional)</label>
                    <select name="client_id" class="form-select rounded-0">
                        <option value="">-- Tanpa Klien (Proyek Umum / Publik) --</option>
                        @foreach($clients as $c)
                            <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase">Kategori Proyek</label>
                    <select name="category" class="form-select rounded-0" required>
                        <option value="Architecture">Architecture</option>
                        <option value="Interior">Interior</option>
                        <option value="Exterior">Exterior</option>
                        <option value="Commercial">Commercial</option>
                        <option value="Residential">Residential</option>
                        <option value="Government">Government</option>
                        <option value="Planning">Planning</option>
                        <option value="Supervision">Supervision</option>
                        <option value="Construction">Construction</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase">Status Proyek</label>
                    <select name="status" class="form-select rounded-0" required>
                        <option value="planning">Planning (Perencanaan)</option>
                        <option value="ongoing">Ongoing (Sedang Konstruksi)</option>
                        <option value="completed">Completed (Selesai)</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase">Tahun Pengerjaan</label>
                    <input type="text" name="year" class="form-control rounded-0" placeholder="Contoh: 2026" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Lokasi Proyek</label>
                    <input type="text" name="location" class="form-control rounded-0" placeholder="Contoh: TB Simatupang, Jakarta Selatan" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Nilai Kontrak / Proyek (RAB dalam Rupiah, Opsional)</label>
                    <input type="number" name="project_value" class="form-control rounded-0" placeholder="Contoh: 15000000000">
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold text-uppercase">Cakupan Pekerjaan (Scope, Koma Terpisah)</label>
                    <input type="text" name="scope" class="form-control rounded-0" placeholder="Contoh: Perancangan Struktur, Desain Fasad, BIM LOD 300">
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold text-uppercase">Deskripsi Rinci Proyek</label>
                    <textarea name="description" rows="5" class="form-control rounded-0" placeholder="Tuliskan deskripsi lengkap proyek arsitektur/konstruksi di sini..."></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Foto Utama Cover (Rekomendasi 4:3 / 16:9)</label>
                    <input type="file" name="cover_image" class="form-control rounded-0" accept="image/*">
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Tautan Video Walkthrough (Opsional)</label>
                    <input type="url" name="video_url" class="form-control rounded-0" placeholder="Contoh: https://assets.wCN/video.mp4">
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold text-uppercase">Unggah Banyak Foto Galeri (Bisa pilih beberapa sekaligus)</label>
                    <input type="file" name="gallery_images[]" class="form-control rounded-0" accept="image/*" multiple>
                </div>

                <div class="col-md-6">
                    <div class="form-check mt-3">
                        <input type="checkbox" name="is_featured" value="1" class="form-check-input rounded-0" id="is_featured">
                        <label class="form-check-label small fw-bold text-uppercase" for="is_featured">Tampilkan Sebagai Proyek Unggulan (Featured)</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Urutan Tampil (Order Number)</label>
                    <input type="number" name="order" class="form-control rounded-0" value="0">
                </div>

                <div class="col-12 mt-5">
                    <button type="submit" class="btn btn-gold w-100 py-3">TAMBAHKAN PROYEK</button>
                </div>

            </div>
        </form>
    </div>

@endsection
