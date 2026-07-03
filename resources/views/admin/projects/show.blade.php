@extends('layouts.admin')

@section('header_title', 'Kelola Proyek: ' . $project->title)

@section('content')

    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4 bg-white">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                    <div>
                        <span class="text-gold text-uppercase fw-bold small tracking-widest">{{ $project->category }}</span>
                        <h2 class="font-head fw-bold fs-3 my-2">{{ $project->title }}</h2>
                        <p class="text-muted small mb-0"><i class="bi bi-geo-alt-fill text-gold me-1"></i>{{ $project->location }} | Klien: {{ $project->client ? $project->client->name : 'Publik / Umum' }}</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-outline-gold btn-sm"><i class="bi bi-pencil me-1"></i> Edit Data Utama</a>
                    </div>
                </div>

                @php
                    $latestProgress = $project->progress->first();
                    $currentPercentage = $latestProgress ? $latestProgress->percentage : 0;
                @endphp
                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="small fw-bold text-uppercase text-secondary">Kemajuan Pekerjaan Saat Ini</span>
                        <span class="fw-bold fs-5 text-gold">{{ $currentPercentage }}%</span>
                    </div>
                    <div class="progress rounded-0" style="height: 10px; background-color: #ECECEC;">
                        <div class="progress-bar progress-bar-luxury" role="progressbar" style="width: {{ $currentPercentage }}%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Operation Status Feedback -->
    @if(session('progress_success'))
        <div class="alert alert-success border-0 rounded-0 shadow-sm mb-4"><i class="bi bi-check-circle-fill me-2"></i> {{ session('progress_success') }}</div>
    @endif
    @if(session('document_success'))
        <div class="alert alert-success border-0 rounded-0 shadow-sm mb-4"><i class="bi bi-check-circle-fill me-2"></i> {{ session('document_success') }}</div>
    @endif
    @if(session('meeting_success'))
        <div class="alert alert-success border-0 rounded-0 shadow-sm mb-4"><i class="bi bi-check-circle-fill me-2"></i> {{ session('meeting_success') }}</div>
    @endif
    @if(session('approval_success'))
        <div class="alert alert-success border-0 rounded-0 shadow-sm mb-4"><i class="bi bi-check-circle-fill me-2"></i> {{ session('approval_success') }}</div>
    @endif
    @if(session('comment_success'))
        <div class="alert alert-success border-0 rounded-0 shadow-sm mb-4"><i class="bi bi-check-circle-fill me-2"></i> {{ session('comment_success') }}</div>
    @endif

    <div class="row g-4">
        
        <!-- Left Column: Operations Tabs -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm bg-white p-4">
                
                <!-- Navigation Tabs -->
                <ul class="nav nav-tabs border-bottom mb-4" id="adminProjectTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link font-head text-uppercase active px-3 pb-3 border-0 small" id="admin-progress-tab" data-bs-toggle="tab" data-bs-target="#admin-progress-pane" type="button" role="tab"><i class="bi bi-activity me-1"></i> Progress Log</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link font-head text-uppercase px-3 pb-3 border-0 small" id="admin-documents-tab" data-bs-toggle="tab" data-bs-target="#admin-documents-pane" type="button" role="tab"><i class="bi bi-file-earmark-pdf me-1"></i> Berkas & RAB</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link font-head text-uppercase px-3 pb-3 border-0 small" id="admin-meetings-tab" data-bs-toggle="tab" data-bs-target="#admin-meetings-pane" type="button" role="tab"><i class="bi bi-calendar3 me-1"></i> Rapat Koordinasi</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link font-head text-uppercase px-3 pb-3 border-0 small" id="admin-approvals-tab" data-bs-toggle="tab" data-bs-target="#admin-approvals-pane" type="button" role="tab"><i class="bi bi-shield-check me-1"></i> Approval Desain</button>
                    </li>
                </ul>

                <div class="tab-content" id="adminProjectTabsContent">
                    
                    <!-- 1. Progress Tab -->
                    <div class="tab-pane fade show active" id="admin-progress-pane" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="font-head fw-bold mb-0">Milestone Progress Kerja</h5>
                            <button class="btn btn-gold btn-sm" data-bs-toggle="collapse" data-bs-target="#addProgressForm"><i class="bi bi-plus-lg me-1"></i> Log Baru</button>
                        </div>

                        <!-- Collapse Add Progress Form -->
                        <div class="collapse mb-4 p-4 border bg-light" id="addProgressForm">
                            <h6 class="font-head fw-bold mb-3">Tambah Milestone Progres</h6>
                            <form action="{{ route('admin.projects.progress.store', $project->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Persentase Pekerjaan (0-100)</label>
                                        <input type="number" name="percentage" class="form-control rounded-0" min="0" max="100" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Tanggal Update</label>
                                        <input type="date" name="date" class="form-control rounded-0" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Deskripsi Pekerjaan / Catatan Lapangan</label>
                                        <textarea name="description" rows="3" class="form-control rounded-0" placeholder="Pengecoran kolom selesai, instalasi pipa AC..." required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Unggah Foto Progress Lapangan (Bisa beberapa sekaligus)</label>
                                        <input type="file" name="progress_images[]" class="form-control rounded-0" accept="image/*" multiple>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-gold btn-sm">Simpan Progress</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Log List -->
                        @foreach($project->progress as $prog)
                            <div class="mb-4 pb-4 border-bottom">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-gold text-white rounded-0">{{ $prog->percentage }}% Selesai</span>
                                    <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i>{{ $prog->date->format('d M Y') }}</span>
                                </div>
                                <p class="small text-muted mb-3">{{ $prog->description }}</p>
                                @if($prog->images->isNotEmpty())
                                    <div class="row g-2">
                                        @foreach($prog->images as $img)
                                            <div class="col-md-3 col-6">
                                                <div class="border" style="aspect-ratio: 4/3; overflow: hidden;">
                                                    <img src="{{ Storage::url($img->file_path) }}" class="w-100 h-100" style="object-fit: cover;" alt="Site Photo">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- 2. Documents Tab -->
                    <div class="tab-pane fade" id="admin-documents-pane" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="font-head fw-bold mb-0">Berkas Pendukung Proyek</h5>
                            <button class="btn btn-gold btn-sm" data-bs-toggle="collapse" data-bs-target="#uploadDocForm"><i class="bi bi-upload me-1"></i> Unggah Berkas</button>
                        </div>

                        <!-- Collapse Upload Document Form -->
                        <div class="collapse mb-4 p-4 border bg-light" id="uploadDocForm">
                            <h6 class="font-head fw-bold mb-3">Unggah Berkas Baru (DWG, PDF, Excel, ZIP)</h6>
                            <form action="{{ route('admin.projects.documents.store', $project->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Nama / Judul Dokumen</label>
                                        <input type="text" name="title" class="form-control rounded-0" placeholder="Contoh: Detail Rencana Pondasi Rev-2" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Pilih File</label>
                                        <input type="file" name="document_file" class="form-control rounded-0" required>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-gold btn-sm">Mulai Unggah</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Document List Table -->
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr class="small text-uppercase text-secondary border-bottom">
                                        <th class="py-3">Nama Berkas</th>
                                        <th class="py-3">Format</th>
                                        <th class="py-3">Ukuran</th>
                                        <th class="py-3 text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($project->documents as $doc)
                                        <tr class="border-bottom">
                                            <td class="py-3 fw-bold small text-secondary">{{ $doc->title }}</td>
                                            <td class="py-3"><span class="badge bg-secondary text-uppercase">{{ $doc->file_type }}</span></td>
                                            <td class="py-3 small text-muted">{{ $doc->file_size }}</td>
                                            <td class="py-3 text-end">
                                                <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="btn btn-light btn-sm border py-1 px-3">Buka File</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">Belum ada berkas proyek.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- 3. Meetings Tab -->
                    <div class="tab-pane fade" id="admin-meetings-pane" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="font-head fw-bold mb-0">Rapat Koordinasi Mingguan</h5>
                            <button class="btn btn-gold btn-sm" data-bs-toggle="collapse" data-bs-target="#scheduleMeetingForm"><i class="bi bi-calendar-plus me-1"></i> Jadwalkan Rapat</button>
                        </div>

                        <!-- Collapse Add Meeting Form -->
                        <div class="collapse mb-4 p-4 border bg-light" id="scheduleMeetingForm">
                            <h6 class="font-head fw-bold mb-3">Buat Agenda Rapat Baru</h6>
                            <form action="{{ route('admin.projects.meetings.store', $project->id) }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Judul Agenda Rapat</label>
                                        <input type="text" name="meeting_title" class="form-control rounded-0" placeholder="Contoh: Rapat Koordinasi Struktur Lantai 4" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Tanggal & Waktu</label>
                                        <input type="datetime-local" name="meeting_date" class="form-control rounded-0" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Lokasi Rapat atau Link Pertemuan Online (Zoom/Meet)</label>
                                        <input type="text" name="location_or_link" class="form-control rounded-0" placeholder="Contoh: Ruang Rapat Kantor Pusat / Tautan Google Meet" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Keterangan / Pokok Bahasan</label>
                                        <textarea name="description" rows="3" class="form-control rounded-0" placeholder="Review material finishing fasad..."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-gold btn-sm">Jadwalkan Rapat</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Meetings List -->
                        @forelse($project->meetings as $meet)
                            <div class="p-4 border bg-light mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="font-head fw-bold mb-0 text-gold">{{ $meet->meeting_title }}</h6>
                                    <span class="badge bg-dark rounded-0 px-2 py-1 small">{{ $meet->meeting_date->format('d M Y H:i') }}</span>
                                </div>
                                <p class="small text-muted mb-3">{{ $meet->description }}</p>
                                <div class="small text-secondary">
                                    <i class="bi bi-geo-alt-fill text-gold me-2"></i> Lokasi: <strong>{{ $meet->location_or_link }}</strong>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">Belum ada agenda rapat koordinasi.</div>
                        @endforelse
                    </div>

                    <!-- 4. Approvals Tab -->
                    <div class="tab-pane fade" id="admin-approvals-pane" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="font-head fw-bold mb-0">Review Gambar Desain (Client Approval)</h5>
                            <button class="btn btn-gold btn-sm" data-bs-toggle="collapse" data-bs-target="#uploadApprovalForm"><i class="bi bi-cloud-upload me-1"></i> Ajukan Desain</button>
                        </div>

                        <!-- Collapse Add Approval Form -->
                        <div class="collapse mb-4 p-4 border bg-light" id="uploadApprovalForm">
                            <h6 class="font-head fw-bold mb-3">Unggah Gambar Tata Ruang / Fasad Baru</h6>
                            <form action="{{ route('admin.projects.approvals.store', $project->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Judul Gambar / Blueprint</label>
                                        <input type="text" name="title" class="form-control rounded-0" placeholder="Contoh: Draf Layout Lobi Utama Lantai 1" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">File PDF / Gambar Desain</label>
                                        <input type="file" name="design_file" class="form-control rounded-0" accept="application/pdf,image/*" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Catatan Pengantar untuk Klien</label>
                                        <textarea name="description" rows="3" class="form-control rounded-0" placeholder="Mohon direview tata letak meja resepsionis..."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-gold btn-sm">Unggah Untuk Review Klien</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Approvals List -->
                        @forelse($project->approvals as $appr)
                            <div class="p-4 border mb-3 rounded bg-white shadow-xs">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="font-head fw-bold mb-0">{{ $appr->title }}</h6>
                                    @if($appr->status === 'approved')
                                        <span class="badge bg-success rounded-0">Disetujui</span>
                                    @elseif($appr->status === 'revision_requested')
                                        <span class="badge bg-warning text-dark rounded-0">Revisi Diminta</span>
                                    @else
                                        <span class="badge bg-secondary rounded-0">Menunggu Review Klien</span>
                                    @endif
                                </div>
                                <p class="small text-muted mb-3">{{ $appr->description }}</p>
                                
                                @if($appr->file_path)
                                    <div class="mb-3">
                                        <a href="{{ Storage::url($appr->file_path) }}" target="_blank" class="btn btn-outline-dark btn-sm py-1 px-3"><i class="bi bi-file-earmark-pdf me-1"></i> Buka File Ajuan</a>
                                    </div>
                                @endif

                                @if($appr->status === 'revision_requested' && $appr->revision_notes)
                                    <div class="p-3 bg-light border-start border-3 border-warning small">
                                        <strong>Catatan Revisi Klien:</strong>
                                        <p class="mb-0 mt-1 text-muted">{{ $appr->revision_notes }}</p>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">Belum ada desain yang dikirim untuk direview.</div>
                        @endforelse
                    </div>

                </div>

            </div>
        </div>

        <!-- Right Column: Project Chat Feed -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm bg-white p-4 h-100 d-flex flex-column justify-content-between" style="min-height: 500px;">
                <div>
                    <h5 class="font-head fw-bold mb-3 border-bottom pb-2">Komunikasi Proyek</h5>
                    
                    @if(!$project->client_id)
                        <div class="text-center py-5 text-muted small">
                            <i class="bi bi-chat-slash fs-1 d-block mb-2"></i>
                            Percakapan dinonaktifkan karena proyek ini tidak terhubung dengan akun klien tertentu.
                        </div>
                    @else
                        <!-- Chat Box -->
                        <div class="chat-container small rounded mb-3" style="max-height: 380px;">
                            @forelse($project->comments as $comment)
                                @php
                                    $isSelf = $comment->user_id === auth()->user()->id;
                                @endphp
                                <div class="chat-bubble {{ $isSelf ? 'sent' : 'received' }}">
                                    <div class="fw-bold mb-1" style="font-size: 0.75rem;">
                                        {{ $isSelf ? 'Anda' : $comment->user->name }}
                                    </div>
                                    <div>{{ $comment->message }}</div>
                                    <div class="text-end mt-1 text-muted" style="font-size: 0.65rem;">
                                        {{ $comment->created_at->format('d M H:i') }}
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-muted py-5">Belum ada percakapan. Kirim tanggapan pertama Anda untuk klien.</div>
                            @endforelse
                        </div>
                    @endif
                </div>

                @if($project->client_id)
                    <form action="{{ route('admin.projects.comments.store', $project->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <textarea name="message" class="form-control rounded-0 small" rows="2" placeholder="Kirim pesan balasan ke klien..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-gold w-100 btn-sm mt-2">KIRIM TANGGAPAN</button>
                    </form>
                @endif
            </div>
        </div>

    </div>

@endsection
