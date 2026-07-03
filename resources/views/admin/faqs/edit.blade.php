@extends('layouts.admin')

@section('header_title', 'Edit FAQ')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4" style="max-width: 650px;">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Ubah Data FAQ</h5>
        
        <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Pertanyaan</label>
                <input type="text" name="question" class="form-control rounded-0" value="{{ $faq->question }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">Jawaban FAQ</label>
                <textarea name="answer" rows="6" class="form-control rounded-0" required>{{ $faq->answer }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase">Urutan Tampil (Order Number)</label>
                <input type="number" name="order" class="form-control rounded-0" value="{{ $faq->order }}">
            </div>

            <button type="submit" class="btn btn-gold w-100 py-3">SIMPAN PERUBAHAN</button>
        </form>
    </div>

@endsection
