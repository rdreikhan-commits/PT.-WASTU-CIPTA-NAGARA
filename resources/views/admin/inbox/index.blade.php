@extends('layouts.admin')

@section('header_title', 'Kotak Masuk Pesan')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Semua Pesan Pengunjung</h5>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="small text-uppercase text-secondary border-bottom">
                        <th class="py-3">Pengirim</th>
                        <th class="py-3">Subjek</th>
                        <th class="py-3">Tanggal</th>
                        <th class="py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr class="border-bottom {{ !$msg->is_read ? 'bg-light font-weight-bold' : '' }}">
                            <td class="py-3">
                                <div>
                                    <span class="fw-bold @if(!$msg->is_read) text-gold @else text-dark @endif">{{ $msg->name }}</span>
                                    @if(!$msg->is_read)
                                        <span class="badge bg-gold text-white rounded-0 px-1 ms-1">Baru</span>
                                    @endif
                                </div>
                                <small class="text-muted">{{ $msg->email }}</small>
                            </td>
                            <td class="py-3 text-secondary small">{{ $msg->subject ?? '(Tanpa Subjek)' }}</td>
                            <td class="py-3 small text-muted">{{ $msg->created_at->format('d M Y H:i') }}</td>
                            <td class="py-3 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.inbox.show', $msg->id) }}" class="btn btn-outline-dark btn-sm py-1 px-3">
                                        Buka Pesan
                                    </a>
                                    <form action="{{ route('admin.inbox.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm text-white py-1 px-2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Belum ada pesan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
