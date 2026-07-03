@extends('layouts.admin')

@section('header_title', 'Detail Pesan Masuk')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4" style="max-width: 800px;">
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
            <h5 class="font-head fw-bold mb-0">Baca Pesan</h5>
            <a href="{{ route('admin.inbox.index') }}" class="btn btn-outline-gold btn-sm">
                <i class="bi bi-chevron-left me-1"></i> Kembali ke Kotak Masuk
            </a>
        </div>

        <div class="mb-4 bg-light p-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <span class="small text-muted d-block">Nama Pengirim</span>
                    <strong class="text-dark">{{ $message->name }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="small text-muted d-block">Email</span>
                    <strong>{{ $message->email }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="small text-muted d-block">Nomor Telepon</span>
                    <strong>{{ $message->phone ?? '-' }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="small text-muted d-block">Tanggal Pengiriman</span>
                    <strong>{{ $message->created_at->format('d M Y, H:i') }} WIB</strong>
                </div>
                <div class="col-12">
                    <span class="small text-muted d-block">Subjek</span>
                    <strong>{{ $message->subject ?? '(Tanpa Subjek)' }}</strong>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-uppercase text-secondary">Isi Pesan:</label>
            <div class="p-4 border text-muted" style="line-height: 1.8; background-color: #FAFAFA; white-space: pre-wrap;">{{ $message->message }}</div>
        </div>

        <div class="d-flex gap-2">
            <a href="mailto:{{ $message->email }}?subject=Balasan:%20{{ rawurlencode($message->subject ?? '') }}" class="btn btn-gold btn-sm">
                <i class="bi bi-reply-fill me-1"></i> Balas Lewat Email
            </a>
            <form action="{{ route('admin.inbox.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm text-white py-2 px-3">
                    <i class="bi bi-trash me-1"></i> Hapus Pesan
                </button>
            </form>
        </div>
    </div>

@endsection
