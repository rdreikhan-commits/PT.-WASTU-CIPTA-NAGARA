@extends('layouts.admin')

@section('header_title', 'Edit Proyek: ' . $project->title)

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Form Ubah Proyek</h5>
        
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Nama Proyek</label>
                    <input type="text" name="title" class="form-control rounded-0" value="{{ $project->title }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Hubungkan Akun Klien</label>
                    <select name="client_id" class="form-select rounded-0">
                        <option value="">-- Tanpa Klien (Proyek Umum / Publik) --</option>
                        @foreach($clients as $c)
                            <option value="{{ $c->id }}" @if($project->client_id === $c->id) selected @endif>{{ $c->name }} ({{ $c->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase">Kategori Proyek</label>
                    <select name="category" class="form-select rounded-0" required>
                        @foreach(['Architecture', 'Interior', 'Exterior', 'Commercial', 'Residential', 'Government', 'Planning', 'Supervision', 'Construction'] as $cat)
                            <option value="{{ $cat }}" @if($project->category === $cat) selected @endif>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase">Status Proyek</label>
                    <select name="status" class="form-select rounded-0" required>
                        <option value="planning" @if($project->status === 'planning') selected @endif>Planning (Perencanaan)</option>
                        <option value="ongoing" @if($project->status === 'ongoing') selected @endif>Ongoing (Sedang Konstruksi)</option>
                        <option value="completed" @if($project->status === 'completed') selected @endif>Completed (Selesai)</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase">Tahun Pengerjaan</label>
                    <input type="text" name="year" class="form-control rounded-0" value="{{ $project->year }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Lokasi Proyek</label>
                    <input type="text" name="location" class="form-control rounded-0" value="{{ $project->location }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Nilai Kontrak / Proyek (RAB dalam Rupiah)</label>
                    <input type="number" name="project_value" class="form-control rounded-0" value="{{ $project->project_value }}">
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold text-uppercase">Cakupan Pekerjaan (Scope, Koma Terpisah)</label>
                    <input type="text" name="scope" class="form-control rounded-0" value="{{ $project->scope }}">
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold text-uppercase">Deskripsi Rinci Proyek</label>
                    <textarea name="description" rows="5" class="form-control rounded-0">{{ $project->description }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Foto Utama Cover (Biarkan kosong jika tidak diubah)</label>
                    <input type="file" name="cover_image" class="form-control rounded-0" accept="image/*">
                    @if($project->cover_image)
                        <div class="mt-2 text-muted small">Cover saat ini: `{{ basename($project->cover_image) }}`</div>
                    @endif
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Tautan Video Walkthrough</label>
                    <input type="url" name="video_url" class="form-control rounded-0" value="{{ $project->video_url }}">
                </div>

                <div class="col-md-6">
                    <div class="form-check mt-3">
                        <input type="checkbox" name="is_featured" value="1" class="form-check-input rounded-0" id="is_featured" @if($project->is_featured) checked @endif>
                        <label class="form-check-label small fw-bold text-uppercase" for="is_featured">Tampilkan Sebagai Proyek Unggulan (Featured)</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Urutan Tampil (Order Number)</label>
                    <input type="number" name="order" class="form-control rounded-0" value="{{ $project->order }}">
                </div>

                <div class="col-12 mt-5">
                    <button type="submit" class="btn btn-gold w-100 py-3">PERBARUI DATA PROYEK</button>
                </div>

            </div>
        </form>
    </div>

@endsection
