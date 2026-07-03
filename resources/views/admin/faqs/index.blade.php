@extends('layouts.admin')

@section('header_title', 'Kelola FAQ Website')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="font-head fw-bold mb-0">Semua FAQ</h5>
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-gold btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah FAQ Baru
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="small text-uppercase text-secondary border-bottom">
                        <th class="py-3" style="width: 30%;">Pertanyaan</th>
                        <th class="py-3" style="width: 50%;">Jawaban</th>
                        <th class="py-3">Urutan</th>
                        <th class="py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                        <tr class="border-bottom">
                            <td class="py-3 fw-bold text-dark">{{ $faq->question }}</td>
                            <td class="py-3 text-muted small">{{ Str::limit($faq->answer, 120) }}</td>
                            <td class="py-3 small">{{ $faq->order }}</td>
                            <td class="py-3 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-light btn-sm border py-1 px-3">Edit</a>
                                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm text-white py-1 px-2"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Belum ada FAQ ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
