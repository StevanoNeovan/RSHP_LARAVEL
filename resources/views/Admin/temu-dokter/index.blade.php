@extends('layouts.admin')

@section('title', 'Temu Dokter')
@section('page-title', 'Manajemen Temu Dokter')

@section('content')
<style>
    /* ===== General Layout ===== */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }

    /* ===== Stats Cards ===== */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 24px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
    }

    .stat-content h3 {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        margin: 0;
        line-height: 1.2;
    }

    .stat-content p {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
    }

    /* Colors for Stats */
    .bg-warning { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .bg-info { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .bg-success { background: linear-gradient(135deg, #10b981, #059669); }
    .bg-danger { background: linear-gradient(135deg, #ef4444, #dc2626); }

    /* ===== Filters & Controls ===== */
    .controls-wrapper {
        background: white;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        margin-bottom: 24px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .status-filters {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        padding-bottom: 16px;
        border-bottom: 1px solid #f3f4f6;
    }

    .filter-btn {
        padding: 8px 16px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: white;
        color: #6b7280;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .filter-btn:hover {
        background: #f9fafb;
        border-color: #d1d5db;
    }

    .filter-btn.active {
        background: #2563eb;
        color: white;
        border-color: #2563eb;
    }

    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .view-filters {
        display: flex;
        gap: 8px;
    }

    /* ===== Appointment Card ===== */
    .appointment-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .apt-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        transition: box-shadow 0.2s;
    }

    .apt-card:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .apt-header {
        padding: 16px 20px;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .apt-meta h4 {
        font-size: 16px;
        font-weight: 700;
        color: #2563eb;
        margin: 0;
    }

    .apt-meta span {
        font-size: 13px;
        color: #6b7280;
    }

    .apt-body {
        padding: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .info-group {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .info-icon-box {
        width: 40px;
        height: 40px;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-text label {
        display: block;
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 2px;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .info-text p {
        margin: 0;
        font-weight: 600;
        color: #1f2937;
        font-size: 15px;
    }

    .apt-footer {
        padding: 12px 20px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: white;
    }

    .deleted-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #ef4444;
        background: #fef2f2;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        margin-left: auto; /* Push buttons to right */
    }

    /* Badges */
    .badge-pill {
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .badge-W { background: #fef3c7; color: #b45309; }
    .badge-P { background: #dbeafe; color: #1d4ed8; }
    .badge-S { background: #d1fae5; color: #047857; }
    .badge-B { background: #fee2e2; color: #b91c1c; }
    .badge-trash { background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; }

    /* Buttons override */
    .btn-sm { padding: 6px 12px; font-size: 13px; display: inline-flex; align-items: center; gap: 6px; }
    form { margin: 0; }
</style>

<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon bg-warning"><i class="fas fa-clock"></i></div>
        <div class="stat-content">
            <h3>{{ $temuDokter->where('status', 'W')->count() }}</h3>
            <p>Menunggu</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-info"><i class="fas fa-stethoscope"></i></div>
        <div class="stat-content">
            <h3>{{ $temuDokter->where('status', 'P')->count() }}</h3>
            <p>Pemeriksaan</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-success"><i class="fas fa-check-circle"></i></div>
        <div class="stat-content">
            <h3>{{ $temuDokter->where('status', 'S')->count() }}</h3>
            <p>Selesai</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-danger"><i class="fas fa-times-circle"></i></div>
        <div class="stat-content">
            <h3>{{ $temuDokter->where('status', 'B')->count() }}</h3>
            <p>Batal</p>
        </div>
    </div>
</div>

<div class="controls-wrapper">
    <div class="status-filters">
        <button class="filter-btn active" data-filter="all">
            <i class="fas fa-th-large"></i> Semua
        </button>
        <button class="filter-btn" data-filter="W">
            <i class="fas fa-clock"></i> Menunggu
        </button>
        <button class="filter-btn" data-filter="P">
            <i class="fas fa-user-md"></i> Diperiksa
        </button>
        <button class="filter-btn" data-filter="S">
            <i class="fas fa-check"></i> Selesai
        </button>
        <button class="filter-btn" data-filter="B">
            <i class="fas fa-ban"></i> Batal
        </button>
    </div>

    <div class="action-bar">
        <div class="view-filters">
            <a href="{{ route('admin.temu-dokter.index') }}"
               class="btn {{ !request('trashed') ? 'btn-primary' : 'btn-outline-secondary' }} btn-sm">
                <i class="fas fa-folder-open"></i> Data Aktif
            </a>
            <a href="{{ route('admin.temu-dokter.index', ['trashed' => 'only']) }}"
               class="btn {{ request('trashed') == 'only' ? 'btn-danger' : 'btn-outline-danger' }} btn-sm">
                <i class="fas fa-trash"></i> Sampah
            </a>
            <a href="{{ route('admin.temu-dokter.index', ['trashed' => 'with']) }}"
               class="btn {{ request('trashed') == 'with' ? 'btn-warning' : 'btn-outline-secondary' }} btn-sm">
                <i class="fas fa-archive"></i> Semua
            </a>
        </div>

        <a href="{{ route('admin.temu-dokter.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Reservasi
        </a>
    </div>
</div>

@if(request('trashed'))
<div class="alert alert-warning mb-4 shadow-sm border-0">
    <i class="fas fa-exclamation-triangle me-2"></i>
    Menampilkan data yang sudah dihapus. 
    <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="fw-bold text-dark text-decoration-underline">Kembali ke data aktif</a>
</div>
@endif

<div class="appointment-list" id="appointmentsList">
    @forelse($temuDokter as $td)
        <div class="apt-card" data-status="{{ $td->status }}">
            <div class="apt-header">
                <div class="apt-meta">
                    <h4>No. Urut {{ $td->no_urut }}</h4>
                    <span><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($td->waktu_daftar)->format('d M Y, H:i') }}</span>
                </div>
                
                @if($td->trashed())
                    <span class="badge-pill badge-trash">
                        <i class="fas fa-trash-alt"></i> Terhapus
                    </span>
                @else
                    <span class="badge-pill badge-{{ $td->status }}">
                        <i class="fas fa-{{ App\Http\Controllers\Admin\TemuDokterController::getStatusIcon($td->status) }}"></i>
                        {{ App\Http\Controllers\Admin\TemuDokterController::getStatusText($td->status) }}
                    </span>
                @endif
            </div>

            <div class="apt-body">
                <div class="info-group">
                    <div class="info-icon-box">
                        <i class="fas fa-paw"></i>
                    </div>
                    <div class="info-text">
                        <label>Pasien (Pet)</label>
                        <p>{{ $td->pet->nama }}</p>
                    </div>
                </div>

                <div class="info-group">
                    <div class="info-icon-box">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="info-text">
                        <label>Pemilik</label>
                        <p>{{ $td->pet->pemilik->user->nama }}</p>
                    </div>
                </div>

                <div class="info-group">
                    <div class="info-icon-box">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="info-text">
                        <label>Dokter</label>
                        <p>{{ $td->roleUser->user->nama }}</p>
                    </div>
                </div>
            </div>

            <div class="apt-footer">
                <div>
                    @if($td->trashed() && $td->deleted_by)
                        <div class="deleted-info">
                            <i class="fas fa-user-slash"></i>
                            <span>Dihapus: <strong>{{ $td->deletedBy->nama ?? 'Unknown' }}</strong> 
                            ({{ \Carbon\Carbon::parse($td->deleted_at)->format('d/m H:i') }})</span>
                        </div>
                    @endif
                </div>

                <div class="action-buttons">
                    @if($td->trashed())
                        <form action="{{ route('admin.temu-dokter.restore', $td->idreservasi_dokter) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="btn btn-success btn-sm" title="Pulihkan">
                                <i class="fas fa-undo"></i> Restore
                            </button>
                        </form>
                        <form action="{{ route('admin.temu-dokter.force-delete', $td->idreservasi_dokter) }}" method="POST" onsubmit="return confirm('PERMANEN! Data tidak bisa dikembalikan. Yakin?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="Hapus Permanen">
                                <i class="fas fa-times"></i> Hapus
                            </button>
                        </form>
                    @else
                        @if($td->status == 'W')
                            <form action="{{ route('admin.temu-dokter.update-status', ['id' => $td->idreservasi_dokter, 'status' => 'P']) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-stethoscope"></i> Periksa
                                </button>
                            </form>
                        @endif

                        @if($td->status == 'P')
                            <form action="{{ route('admin.temu-dokter.update-status', ['id' => $td->idreservasi_dokter, 'status' => 'S']) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i> Selesai
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('admin.temu-dokter.edit', $td->idreservasi_dokter) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.temu-dokter.destroy', $td->idreservasi_dokter) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="empty-state text-center py-5">
            <div class="mb-3">
                <i class="fas fa-clipboard-list fa-3x text-muted opacity-25"></i>
            </div>
            <h4 class="text-muted">Tidak ada data reservasi</h4>
            <p class="text-muted small">Coba ubah filter atau tambah data baru.</p>
        </div>
    @endforelse
</div>

@endsection

@push('scripts')
<script>
    const filterBtns = document.querySelectorAll('.filter-btn');
    const aptCards = document.querySelectorAll('.apt-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active state
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            aptCards.forEach(card => {
                if (filterValue === 'all' || card.getAttribute('data-status') === filterValue) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush