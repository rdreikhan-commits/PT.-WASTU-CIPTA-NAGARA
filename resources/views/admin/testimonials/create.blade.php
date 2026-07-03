@extends('layouts.admin')

@section('header_title', 'Tambah Testimoni Baru')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4" style="max-width: 600px;">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Form Data Testimoni</h5>
        
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Nama Klien</label>
                <input type="text" name="client_name" class="form-control rounded-0" placeholder="Contoh: Alexandra Wijaya" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Jabatan & Nama Perusahaan</label>
                <input type="text" name="client_company" class="form-control rounded-0" placeholder="Contoh: Founder & Owner The Peak Resort Group">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Rating Bintang (1-5)</label>
                <select name="rating" class="form-select rounded-0" required>
                    <option value="5">5 Bintang (Sangat Memuaskan)</option>
                    <option value="4">4 Bintang (Memuaskan)</option>
                    <option value="3">3 Bintang (Cukup)</option>
                    <option value="2">2 Bintang (Kurang)</option>
                    <option value="1">1 Bintang (Buruk)</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Isi Testimoni / Ulasan</label>
                <textarea name="testimonial" rows="5" class="form-control rounded-0" placeholder="Tuliskan ulasan lengkap klien di sini..." required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Foto Klien (Opsional)</label>
                <input type="file" name="photo_path" class="form-control rounded-0" accept="image/*">
            </div>

            <div class="mb-3">
                <div class="form-check mt-3">
                    <input type="checkbox" name="is_approved" value="1" class="form-check-input rounded-0" id="is_approved" checked>
                    <label class="form-check-label small fw-bold text-uppercase" for="is_approved">Terbitkan Testimoni (Tampil di Website)</label>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase">Urutan Tampil (Order Number)</label>
                <input type="number" name="order" class="form-control rounded-0" value="0">
            </div>

            <button type="submit" class="btn btn-gold w-100 py-3">BUAT TESTIMONI</button>
        </form>
    </div>

@endsection
