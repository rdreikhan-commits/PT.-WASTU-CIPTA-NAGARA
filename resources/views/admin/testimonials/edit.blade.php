@extends('layouts.admin')

@section('header_title', 'Edit Testimoni: ' . $testimonial->client_name)

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4" style="max-width: 600px;">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Ubah Data Testimoni</h5>
        
        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Nama Klien</label>
                <input type="text" name="client_name" class="form-control rounded-0" value="{{ $testimonial->client_name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Jabatan & Nama Perusahaan</label>
                <input type="text" name="client_company" class="form-control rounded-0" value="{{ $testimonial->client_company }}">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Rating Bintang (1-5)</label>
                <select name="rating" class="form-select rounded-0" required>
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @if($testimonial->rating === $i) selected @endif>{{ $i }} Bintang</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Isi Testimoni / Ulasan</label>
                <textarea name="testimonial" rows="5" class="form-control rounded-0" required>{{ $testimonial->testimonial }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Foto Klien (Biarkan kosong jika tidak diganti)</label>
                <input type="file" name="photo_path" class="form-control rounded-0" accept="image/*">
                @if($testimonial->photo_path)
                    <div class="mt-2 small text-muted">Foto saat ini: `{{ basename($testimonial->photo_path) }}`</div>
                @endif
            </div>

            <div class="mb-3">
                <div class="form-check mt-3">
                    <input type="checkbox" name="is_approved" value="1" class="form-check-input rounded-0" id="is_approved" @if($testimonial->is_approved) checked @endif>
                    <label class="form-check-label small fw-bold text-uppercase" for="is_approved">Terbitkan Testimoni (Tampil di Website)</label>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase">Urutan Tampil (Order Number)</label>
                <input type="number" name="order" class="form-control rounded-0" value="{{ $testimonial->order }}">
            </div>

            <button type="submit" class="btn btn-gold w-100 py-3">SIMPAN PERUBAHAN</button>
        </form>
    </div>

@endsection
