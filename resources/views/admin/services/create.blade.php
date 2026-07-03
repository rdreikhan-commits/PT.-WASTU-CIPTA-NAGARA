@extends('layouts.admin')

@section('header_title', 'Tambah Layanan Baru')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4" style="max-width: 600px;">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Form Data Layanan</h5>
        
        <form action="{{ route('admin.services.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Nama Layanan</label>
                <input type="text" name="title" class="form-control rounded-0" placeholder="Contoh: Perencanaan Teknik & Struktur" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Bootstrap Icon Class (Opsional)</label>
                <input type="text" name="icon" class="form-control rounded-0" placeholder="Contoh: bi-cpu">
                <small class="text-muted">Cari nama icon di <a href="https://icons.getbootstrap.com/" target="_blank">icons.getbootstrap.com</a> (misal: `bi-cpu` atau `bi-map`).</small>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Deskripsi Layanan</label>
                <textarea name="description" rows="5" class="form-control rounded-0" placeholder="Tuliskan deskripsi lengkap layanan..." required></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase">Urutan Tampil (Order Number)</label>
                <input type="number" name="order" class="form-control rounded-0" value="0">
            </div>

            <button type="submit" class="btn btn-gold w-100 py-3">BUAT LAYANAN</button>
        </form>
    </div>

@endsection
