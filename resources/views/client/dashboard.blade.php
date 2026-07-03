@extends('layouts.client')

@section('content')

    <!-- If client has no projects -->
    @if(!$project)
        <div class="card border-0 shadow-sm p-5 text-center bg-white">
            <i class="bi bi-folder-x text-muted mb-3" style="font-size: 4rem;"></i>
            <h4 class="font-head fw-bold">Belum Ada Proyek Terdaftar</h4>
            <p class="text-muted mx-auto" style="max-width: 500px;">Akun Anda belum dihubungkan dengan proyek aktif apapun saat ini. Silakan hubungi tim administrasi kami untuk informasi lebih lanjut.</p>
        </div>
    @else

        <!-- Project Overview Bar -->
        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm p-4 bg-white">
                    <span class="text-gold text-uppercase fw-bold small tracking-widest">{{ $project->category }}</span>
                    <h2 class="font-head fw-bold fs-3 my-2">{{ $project->title }}</h2>
                    <p class="text-muted small mb-0"><i class="bi bi-geo-alt-fill text-gold me-1"></i>{{ $project->location }} | Tahun: {{ $project->year }}</p>
                    
                    <!-- Progress Bar -->
                    @php
                        $latestProgress = $project->progress->first();
                        $currentPercentage = $latestProgress ? $latestProgress->percentage : 0;
                    @endphp
                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-bold text-uppercase text-secondary">Kemajuan Pekerjaan (Progress)</span>
                            <span class="fw-bold fs-5 text-gold">{{ $currentPercentage }}%</span>
                        </div>
                        <div class="progress rounded-0" style="height: 12px; background-color: #ECECEC;">
                            <div class="progress-bar progress-bar-luxury" role="progressbar" style="width: {{ $currentPercentage }}%;" aria-valuenow="{{ $currentPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('comment_success'))
            <div class="alert alert-success border-0 rounded-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('comment_success') }}
            </div>
        @endif

        @if(session('approval_success'))
            <div class="alert alert-success border-0 rounded-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('approval_success') }}
            </div>
        @endif

        <!-- Main Dashboard Tabs -->
        <div class="row g-4">
            
            <!-- Left Side: Tabs Navigation & Details -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm bg-white p-4">
                    
                    <!-- Tab Buttons -->
                    <ul class="nav nav-tabs border-bottom mb-4" id="projectTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link font-head text-uppercase active px-3 pb-3 border-0 small tracking-wider" id="progress-tab" data-bs-toggle="tab" data-bs-target="#progress-pane" type="button" role="tab" aria-controls="progress-pane" aria-selected="true">
                                <i class="bi bi-activity me-1"></i> Progress Log
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link font-head text-uppercase px-3 pb-3 border-0 small tracking-wider" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents-pane" type="button" role="tab" aria-controls="documents-pane" aria-selected="false">
                                <i class="bi bi-file-earmark-pdf me-1"></i> Dokumen & RAB
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link font-head text-uppercase px-3 pb-3 border-0 small tracking-wider" id="meetings-tab" data-bs-toggle="tab" data-bs-target="#meetings-pane" type="button" role="tab" aria-controls="meetings-pane" aria-selected="false">
                                <i class="bi bi-calendar3 me-1"></i> Rapat
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link font-head text-uppercase px-3 pb-3 border-0 small tracking-wider" id="approvals-tab" data-bs-toggle="tab" data-bs-target="#approvals-pane" type="button" role="tab" aria-controls="approvals-pane" aria-selected="false">
                                <i class="bi bi-shield-check me-1"></i> Persetujuan Desain
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Contents -->
                    <div class="tab-content" id="projectTabsContent">
                        
                        <!-- 1. Progress Tab -->
                        <div class="tab-pane fade show active" id="progress-pane" role="tabpanel" aria-labelledby="progress-tab" tabindex="0">
                            <h5 class="font-head fw-bold mb-4">Milestone Kemajuan Pekerjaan</h5>
                            @forelse($project->progress as $prog)
                                <div class="mb-4 pb-4 border-bottom">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-gold rounded-0 text-white px-2 py-1">{{ $prog->percentage }}% Selesai</span>
                                        <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i>{{ $prog->date->format('d M Y') }}</span>
                                    </div>
                                    <p class="text-muted small mb-3">{{ $prog->description }}</p>
                                    
                                    <!-- Progress Images Grid -->
                                    @if($prog->images->isNotEmpty())
                                        <div class="row g-2">
                                            @foreach($prog->images as $img)
                                                <div class="col-md-3 col-6">
                                                    <div class="border" style="aspect-ratio: 4/3; overflow: hidden; background-color: #000;">
                                                        <a href="{{ Storage::url($img->file_path) }}" target="_blank">
                                                            <img src="{{ Storage::url($img->file_path) }}" class="w-100 h-100 hover-zoom" style="object-fit: cover;" alt="Progress Photo">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted">
                                    Belum ada log progress yang dicatatkan oleh admin.
                                </div>
                            @endforelse
                        </div>

                        <!-- 2. Documents Tab -->
                        <div class="tab-pane fade" id="documents-pane" role="tabpanel" aria-labelledby="documents-tab" tabindex="0">
                            <h5 class="font-head fw-bold mb-4">Pusat Berkas & Dokumen Proyek</h5>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr class="small text-uppercase text-secondary border-bottom">
                                            <th class="py-3">Nama Dokumen</th>
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
                                                    <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="btn btn-outline-gold btn-sm py-1 px-3" download>
                                                        <i class="bi bi-download me-1"></i> Unduh
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-5 text-muted">Belum ada dokumen yang diunggah.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- 3. Meetings Tab -->
                        <div class="tab-pane fade" id="meetings-pane" role="tabpanel" aria-labelledby="meetings-tab" tabindex="0">
                            <h5 class="font-head fw-bold mb-4">Jadwal Rapat Koordinasi</h5>
                            @forelse($project->meetings as $meet)
                                <div class="p-4 border border-light bg-light mb-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="font-head fw-bold mb-0 text-gold">{{ $meet->meeting_title }}</h6>
                                        <span class="badge bg-dark rounded-0 px-2 py-1 small">{{ $meet->meeting_date->format('d M Y H:i') }} WIB</span>
                                    </div>
                                    <p class="small text-muted mb-3">{{ $meet->description }}</p>
                                    <div class="d-flex align-items-center text-secondary small">
                                        <i class="bi bi-geo-alt-fill text-gold me-2"></i>
                                        <span>Lokasi/Tautan: 
                                            @if(Str::startsWith($meet->location_or_link, 'http'))
                                                <a href="{{ $meet->location_or_link }}" target="_blank" class="text-primary">{{ $meet->location_or_link }}</a>
                                            @else
                                                <strong>{{ $meet->location_or_link }}</strong>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted">
                                    Tidak ada jadwal rapat koordinasi saat ini.
                                </div>
                            @endforelse
                        </div>

                        <!-- 4. Approvals Tab -->
                        <div class="tab-pane fade" id="approvals-pane" role="tabpanel" aria-labelledby="approvals-tab" tabindex="0">
                            <h5 class="font-head fw-bold mb-4">Persetujuan Desain & Blueprint</h5>
                            @forelse($project->approvals as $appr)
                                <div class="p-4 border mb-3 rounded bg-white shadow-xs">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="font-head fw-bold mb-0">{{ $appr->title }}</h6>
                                        @if($appr->status === 'approved')
                                            <span class="badge bg-success rounded-0">Disetujui</span>
                                        @elseif($appr->status === 'revision_requested')
                                            <span class="badge bg-warning text-dark rounded-0">Revisi Diminta</span>
                                        @else
                                            <span class="badge bg-secondary rounded-0">Menunggu Review</span>
                                        @endif
                                    </div>
                                    
                                    <p class="small text-muted mb-3">{{ $appr->description }}</p>
                                    
                                    <div class="d-flex justify-content-between align-items-center border-top pt-3 flex-wrap gap-2">
                                        @if($appr->file_path)
                                            <a href="{{ Storage::url($appr->file_path) }}" target="_blank" class="btn btn-outline-dark btn-sm py-1 px-3">
                                                <i class="bi bi-file-earmark-pdf me-1"></i> Buka Gambar Desain
                                            </a>
                                        @endif

                                        @if($appr->status === 'pending')
                                            <div class="d-flex gap-2">
                                                <!-- Form Approve -->
                                                <form action="{{ route('client.approvals.update', $appr->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="btn btn-success btn-sm py-1 px-3">Setujui Desain</button>
                                                </form>

                                                <!-- Trigger Revision Form -->
                                                <button class="btn btn-warning btn-sm py-1 px-3 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#revForm-{{ $appr->id }}">Minta Revisi</button>
                                            </div>
                                        @endif
                                    </div>

                                    @if($appr->status === 'revision_requested' && $appr->revision_notes)
                                        <div class="mt-3 p-3 bg-light border-start border-3 border-warning small">
                                            <strong>Catatan Revisi Klien:</strong>
                                            <p class="mb-0 mt-1 text-muted">{{ $appr->revision_notes }}</p>
                                        </div>
                                    @endif

                                    <!-- Revision Notes Collapse Form -->
                                    <div class="collapse mt-3" id="revForm-{{ $appr->id }}">
                                        <form action="{{ route('client.approvals.update', $appr->id) }}" method="POST" class="p-3 border bg-light">
                                            @csrf
                                            <input type="hidden" name="status" value="revision_requested">
                                            <div class="mb-3">
                                                <label class="form-label small fw-bold text-uppercase">Catatan Revisi & Masukan Anda</label>
                                                <textarea name="revision_notes" rows="3" class="form-control rounded-0 small" placeholder="Tuliskan masukan revisi secara detail untuk tim kami..." required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-gold btn-sm">Kirim Catatan Revisi</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted">
                                    Belum ada desain yang dikirim oleh admin untuk persetujuan.
                                </div>
                            @endforelse
                        </div>

                    </div>

                </div>
            </div>

            <!-- Right Side: Chat & Comments -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm bg-white p-4 h-100 d-flex flex-column justify-content-between" style="min-height: 500px;">
                    <div>
                        <h5 class="font-head fw-bold mb-3 border-bottom pb-2">Komunikasi Proyek</h5>
                        
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
                                <div class="text-center text-muted py-5">Belum ada percakapan. Kirim pesan pertama Anda di bawah.</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Comment input form -->
                    <form action="{{ route('client.comments.store', $project->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <textarea name="message" class="form-control rounded-0 small" rows="2" placeholder="Tulis komentar ke admin..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-gold w-100 btn-sm mt-2">KIRIM PESAN</button>
                    </form>
                </div>
            </div>

        </div>

    @endif

@endsection
