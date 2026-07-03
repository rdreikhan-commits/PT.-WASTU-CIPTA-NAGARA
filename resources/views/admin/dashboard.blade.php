@extends('layouts.admin')

@section('header_title', 'Dashboard')

@section('content')

<style>
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 22px 20px;
        border: 1px solid #ece8e7;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .stat-card:hover { box-shadow: 0 8px 30px rgba(122,12,34,0.08); transform: translateY(-2px); }
    .stat-icon {
        width: 52px; height: 52px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .stat-icon.red { background: rgba(122,12,34,0.08); color: #7A0C22; }
    .stat-icon.gold { background: rgba(201,168,106,0.12); color: #C9A86A; }
    .stat-icon.blue { background: rgba(59,130,246,0.08); color: #3b82f6; }
    .stat-icon.green { background: rgba(34,197,94,0.08); color: #22c55e; }
    .stat-label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #9ca3af; font-weight: 600; }
    .stat-value { font-size: 28px; font-weight: 800; color: #1c1b1b; line-height: 1.1; font-family: 'Montserrat', sans-serif; }
    .stat-sub { font-size: 11px; color: #7A0C22; font-weight: 600; margin-top: 2px; }

    .section-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #ece8e7;
        overflow: hidden;
    }
    .section-card-header {
        padding: 18px 22px;
        border-bottom: 1px solid #f3f0ef;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .section-card-header h6 {
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #1c1b1b;
        margin: 0;
    }
    .section-card-body { padding: 0; }

    .progress-item { padding: 16px 22px; border-bottom: 1px solid #f9f6f5; }
    .progress-item:last-child { border-bottom: 0; }
    .progress-bar-wastu {
        height: 6px;
        background: linear-gradient(90deg, #7A0C22, #C9A86A);
        border-radius: 3px;
    }

    .project-row {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 22px;
        border-bottom: 1px solid #f9f6f5;
        transition: background 0.15s;
    }
    .project-row:last-child { border-bottom: 0; }
    .project-row:hover { background: #fdf8f8; }
    .project-thumb {
        width: 52px; height: 44px;
        border-radius: 6px;
        object-fit: cover;
        flex-shrink: 0;
        background: #f3f0ef;
    }
    .project-thumb-placeholder {
        width: 52px; height: 44px;
        border-radius: 6px;
        background: linear-gradient(135deg, #f3f0ef, #e8e3e2);
        flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        color: #c4c0bf;
        font-size: 18px;
    }
    .project-info { flex: 1; min-width: 0; }
    .project-info .name { font-size: 13px; font-weight: 600; color: #1c1b1b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .project-info .meta { font-size: 11px; color: #9ca3af; margin-top: 2px; }
    .badge-status {
        font-size: 10px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        flex-shrink: 0;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .badge-completed { background: #f0fdf4; color: #15803d; }
    .badge-ongoing { background: rgba(122,12,34,0.07); color: #7A0C22; }
    .badge-planning { background: #fffbeb; color: #b45309; }
    .badge-featured { background: rgba(201,168,106,0.15); color: #92702a; }

    .msg-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 22px;
        border-bottom: 1px solid #f9f6f5;
        text-decoration: none;
        transition: background 0.15s;
    }
    .msg-row:last-child { border-bottom: 0; }
    .msg-row:hover { background: #fdf8f8; }
    .msg-avatar {
        width: 36px; height: 36px;
        background: rgba(122,12,34,0.08);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #7A0C22;
        font-size: 15px;
        flex-shrink: 0;
    }
    .msg-info .sender { font-size: 13px; font-weight: 700; color: #1c1b1b; }
    .msg-info .preview { font-size: 11px; color: #9ca3af; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 280px; }
    .msg-time { font-size: 11px; color: #9ca3af; white-space: nowrap; }

    .btn-brand {
        background: #7A0C22;
        color: #fff;
        border: none;
        padding: 8px 18px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s;
    }
    .btn-brand:hover { background: #5D0819; color: #fff; }
    .btn-outline-brand {
        background: transparent;
        color: #7A0C22;
        border: 1.5px solid #7A0C22;
        padding: 7px 16px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    .btn-outline-brand:hover { background: #7A0C22; color: #fff; }

    @media (max-width: 576px) {
        .stat-card { padding: 16px 14px; gap: 12px; }
        .stat-value { font-size: 22px; }
        .msg-info .preview { max-width: 160px; }
    }
</style>

{{-- ===== STATS ROW ===== --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon red"><i class="bi bi-folder2-open"></i></div>
            <div>
                <div class="stat-label">Total Proyek</div>
                <div class="stat-value">{{ $totalProjects }}</div>
                <div class="stat-sub">{{ $completedProjects }} selesai</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon gold"><i class="bi bi-people"></i></div>
            <div>
                <div class="stat-label">Akun Klien</div>
                <div class="stat-value">{{ $totalClients }}</div>
                <div class="stat-sub">Portal aktif</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="bi bi-journal-text"></i></div>
            <div>
                <div class="stat-label">Artikel Blog</div>
                <div class="stat-value">{{ $totalArticles }}</div>
                <div class="stat-sub">Dipublikasikan</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-envelope"></i></div>
            <div>
                <div class="stat-label">Pesan Masuk</div>
                <div class="stat-value">{{ $totalMessages }}</div>
                <div class="stat-sub">{{ $unreadMessages->count() }} belum dibaca</div>
            </div>
        </div>
    </div>
</div>

{{-- ===== MAIN GRID ===== --}}
<div class="row g-4">

    {{-- Project List --}}
    <div class="col-lg-7">
        <div class="section-card h-100">
            <div class="section-card-header">
                <h6><i class="bi bi-folder2-open me-2 text-danger"></i>Portfolio Proyek Terbaru</h6>
                <a href="{{ route('admin.projects.create') }}" class="btn-brand">
                    <i class="bi bi-plus-lg"></i> Tambah
                </a>
            </div>
            <div class="section-card-body">
                @php $recentProjects = \App\Models\Project::latest()->take(8)->get(); @endphp
                @forelse($recentProjects as $proj)
                <div class="project-row">
                    @if($proj->cover_image && \Illuminate\Support\Facades\Storage::exists('public/'.$proj->cover_image))
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($proj->cover_image) }}" class="project-thumb" alt="{{ $proj->title }}">
                    @else
                        <div class="project-thumb-placeholder"><i class="bi bi-image"></i></div>
                    @endif
                    <div class="project-info">
                        <div class="name">{{ $proj->title }}</div>
                        <div class="meta">{{ $proj->location }} &bull; {{ $proj->year }}</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        @if($proj->is_featured)
                            <span class="badge-status badge-featured"><i class="bi bi-star-fill me-1"></i>Highlight</span>
                        @endif
                        <span class="badge-status {{ $proj->status === 'completed' ? 'badge-completed' : ($proj->status === 'ongoing' ? 'badge-ongoing' : 'badge-planning') }}">
                            {{ $proj->status === 'completed' ? 'Selesai' : ($proj->status === 'ongoing' ? 'Berjalan' : 'Rencana') }}
                        </span>
                        <a href="{{ route('admin.projects.edit', $proj->id) }}" class="btn btn-sm btn-light border" title="Edit" style="padding:4px 8px; border-radius:6px;">
                            <i class="bi bi-pencil" style="font-size:12px;"></i>
                        </a>
                        <form action="{{ route('admin.projects.destroy', $proj->id) }}" method="POST" onsubmit="return confirm('Hapus proyek ini?');" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light border" title="Hapus" style="padding:4px 8px; border-radius:6px; color:#7A0C22;">
                                <i class="bi bi-trash" style="font-size:12px;"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-folder-x fs-1 d-block mb-2"></i>
                        Belum ada proyek
                    </div>
                @endforelse
                <div class="p-3 text-center border-top">
                    <a href="{{ route('admin.projects.index') }}" class="btn-outline-brand">
                        <i class="bi bi-grid"></i> Kelola Semua Proyek
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Column --}}
    <div class="col-lg-5 d-flex flex-column gap-4">

        {{-- Project Status Breakdown --}}
        <div class="section-card">
            <div class="section-card-header">
                <h6><i class="bi bi-bar-chart me-2 text-danger"></i>Status Proyek</h6>
            </div>
            <div class="section-card-body">
                <div class="progress-item">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="font-size:12px; font-weight:600;">Selesai</span>
                        <span style="font-size:12px; color:#7A0C22; font-weight:700;">{{ $completedProjects }}</span>
                    </div>
                    <div style="background:#f3f0ef; border-radius:3px; height:6px; overflow:hidden;">
                        <div class="progress-bar-wastu" style="width:{{ $totalProjects > 0 ? round(($completedProjects/$totalProjects)*100) : 0 }}%;"></div>
                    </div>
                </div>
                <div class="progress-item">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="font-size:12px; font-weight:600;">Berjalan</span>
                        <span style="font-size:12px; color:#7A0C22; font-weight:700;">{{ $ongoingProjects }}</span>
                    </div>
                    <div style="background:#f3f0ef; border-radius:3px; height:6px; overflow:hidden;">
                        <div class="progress-bar-wastu" style="width:{{ $totalProjects > 0 ? round(($ongoingProjects/$totalProjects)*100) : 0 }}%;"></div>
                    </div>
                </div>
                <div class="progress-item">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="font-size:12px; font-weight:600;">Perencanaan</span>
                        <span style="font-size:12px; color:#7A0C22; font-weight:700;">{{ $planningProjects }}</span>
                    </div>
                    <div style="background:#f3f0ef; border-radius:3px; height:6px; overflow:hidden;">
                        <div class="progress-bar-wastu" style="width:{{ $totalProjects > 0 ? round(($planningProjects/$totalProjects)*100) : 0 }}%;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Inbox Messages --}}
        <div class="section-card flex-grow-1">
            <div class="section-card-header">
                <h6><i class="bi bi-envelope me-2 text-danger"></i>Pesan Belum Dibaca</h6>
                <a href="{{ route('admin.inbox.index') }}" class="btn-outline-brand" style="font-size:11px; padding:5px 12px;">Semua</a>
            </div>
            <div class="section-card-body">
                @forelse($unreadMessages as $msg)
                    <a href="{{ route('admin.inbox.show', $msg->id) }}" class="msg-row">
                        <div class="msg-avatar"><i class="bi bi-person-fill"></i></div>
                        <div class="msg-info flex-grow-1">
                            <div class="sender">{{ $msg->name }}</div>
                            <div class="preview">{{ $msg->message }}</div>
                        </div>
                        <div class="msg-time">{{ $msg->created_at->diffForHumans() }}</div>
                    </a>
                @empty
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-envelope-check fs-2 d-block mb-2"></i>
                        <span style="font-size:12px;">Semua pesan telah dibaca</span>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

@endsection
