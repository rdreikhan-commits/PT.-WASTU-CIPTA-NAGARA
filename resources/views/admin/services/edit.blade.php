@extends('layouts.admin')

@section('header_title', 'Edit Layanan: ' . $service->title)

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4" style="max-width: 600px;">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Ubah Data Layanan</h5>
        
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Nama Layanan</label>
                <input type="text" name="title" class="form-control rounded-0" value="{{ $service->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Bootstrap Icon Class (Opsional)</label>
                <input type="text" name="icon" class="form-control rounded-0" value="{{ $service->icon }}">
                <small class="text-muted">Nama class Bootstrap Icon (contoh: `bi-cpu` atau `bi-map`).</small>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Deskripsi Layanan</label>
                <textarea name="description" rows="5" class="form-control rounded-0" required>{{ $service->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase">Urutan Tampil (Order Number)</label>
                <input type="number" name="order" class="form-control rounded-0" value="{{ $service->order }}">
            </div>

            <button type="submit" class="btn btn-gold w-100 py-3">SIMPAN PERUBAHAN</button>
        </form>
    </div>

@endsection
