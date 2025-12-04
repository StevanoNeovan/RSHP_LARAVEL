@extends('layouts.admin')

@section('title', 'Temu Dokter')
@section('page-title', 'Manajemen Temu Dokter')

@section('content')
<style>
    .filter-tabs {
        display: flex;
        gap: 12px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 10px 20px;
        background: white;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-tab:hover {
        background: var(--background-light);
        border-color: var(--primary-color);
    }

    .filter-tab.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .badge-status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-warning {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-info {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .appointment-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid var(--border-color);
        margin-bottom: 16px;
        transition: all 0.3s ease;
    }

    .appointment-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .appointment-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border-color);
    }

    .appointment-number {
        font-size: 28px;
        font-weight: 700;
        color: var(--primary-color);
        line-height: 1;
    }

    .appointment-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 16px;
    }

    .info-item {
        display: flex;
        align-items: start;
        gap: 12px;
    }

    .info-icon {
        width: 36px;
        height: 36px;
        background: var(--background-light);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        flex-shrink: 0;
    }

    .info-details h4 {
        font-size: 13px;
        color: var(--text-light);
        font-weight: 500;
        margin-bottom: 4px;
    }

    .info-details p {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .appointment-actions {
        display: flex;
        gap: 8px;
        padding-top: 16px;
        border-top: 1px solid var(--border-color);
    }

    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-mini-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .stat-mini-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    .stat-mini-icon.warning {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
    }

    .stat-mini-icon.info {
        background: linear-gradient(135deg, #60a5fa, #3b82f6);
    }

    .stat-mini-icon.success {
        background: linear-gradient(135deg, #34d399, #10b981);
    }

    .stat-mini-icon.danger {
        background: linear-gradient(135deg, #f87171, #ef4444);
    }

    .stat-mini-content h3 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1;
    }

    .stat-mini-content p {
        font-size: 13px;
        color: var(--text-light);
        margin-top: 4px;
    }
</style>

<!-- Statistics -->
<div class="stats-cards">
    <div class="stat-mini-card">
        <div class="stat-mini-icon warning">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $temuDokter->where('status', 'W')->count() }}</h3>
            <p>Menunggu</p>
        </div>
    </div>
    <div class="stat-mini-card">
        <div class="stat-mini-icon info">
            <i class="fas fa-stethoscope"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $temuDokter->where('status', 'P')->count() }}</h3>
            <p>Dalam Pemeriksaan</p>
        </div>
    </div>
    <div class="stat-mini-card">
        <div class="stat-mini-icon success">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $temuDokter->where('status', 'S')->count() }}</h3>
            <p>Selesai</p>
        </div>
    </div>
    <div class="stat-mini-card">
        <div class="stat-mini-icon danger">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $temuDokter->where('status', 'B')->count() }}</h3>
            <p>Batal</p>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="filter-tabs">
    <button class="filter-tab active" data-filter="all">
        <i class="fas fa-list"></i>
        Semua ({{ $temuDokter->count() }})
    </button>
    <button class="filter-tab" data-filter="W">
        <i class="fas fa-clock"></i>
        Menunggu ({{ $temuDokter->where('status', 'W')->count() }})
    </button>
    <button class="filter-tab" data-filter="P">
        <i class="fas fa-stethoscope"></i>
        Dalam Pemeriksaan ({{ $temuDokter->where('status', 'P')->count() }})
    </button>
    <button class="filter-tab" data-filter="S">
        <i class="fas fa-check-circle"></i>
        Selesai ({{ $temuDokter->where('status', 'S')->count() }})
    </button>
    <button class="filter-tab" data-filter="B">
        <i class="fas fa-times-circle"></i>
        Batal ({{ $temuDokter->where('status', 'B')->count() }})
    </button>
</div>

<!-- Action Button -->
<div style="margin-bottom: 24px;">
    <a href="{{ route('admin.temu-dokter.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i>
        Tambah Reservasi
    </a>
</div>

<!-- Appointments List -->
<div id="appointmentsList">
    @forelse($temuDokter as $td)
        <div class="appointment-card" data-status="{{ $td->status }}">
            <div class="appointment-header">
                <div>
                    <div class="appointment-number">No. {{ $td->no_urut }}</div>
                    <div style="font-size: 13px; color: var(--text-light); margin-top: 4px;">
                        {{ \Carbon\Carbon::parse($td->waktu_daftar)->format('d M Y, H:i') }}
                    </div>
                </div>
                <span class="badge-status badge-{{ App\Http\Controllers\Admin\TemuDokterController::getStatusBadge($td->status) }}">
                    <i class="fas fa-{{ App\Http\Controllers\Admin\TemuDokterController::getStatusIcon($td->status) }}"></i>
                    {{ App\Http\Controllers\Admin\TemuDokterController::getStatusText($td->status) }}
                </span>
            </div>

            <div class="appointment-info">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-paw"></i>
                    </div>
                    <div class="info-details">
                        <h4>Pet</h4>
                        <p>{{ $td->pet->nama }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="info-details">
                        <h4>Pemilik</h4>
                        <p>{{ $td->pet->pemilik->user->nama }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="info-details">
                        <h4>Dokter</h4>
                        <p>{{ $td->roleUser->user->nama }}</p>
                    </div>
                </div>
            </div>

            <div class="appointment-actions">
                <a href="{{ route('admin.temu-dokter.edit', $td->idreservasi_dokter) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                
                @if($td->status == 'W')
                    <form action="{{ route('admin.temu-dokter.update-status', ['id' => $td->idreservasi_dokter, 'status' => 'P']) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-play"></i> Mulai Pemeriksaan
                        </button>
                    </form>
                @endif

                @if($td->status == 'P')
                    <form action="{{ route('admin.temu-dokter.update-status', ['id' => $td->idreservasi_dokter, 'status' => 'S']) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-check"></i> Selesaikan
                        </button>
                    </form>
                @endif

                @if($td->status != 'B' && $td->status != 'S')
                    <form action="{{ route('admin.temu-dokter.update-status', ['id' => $td->idreservasi_dokter, 'status' => 'B']) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-times"></i> Batalkan
                        </button>
                    </form>
                @endif

                <form action="{{ route('admin.temu-dokter.destroy', $td->idreservasi_dokter) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty-state" style="text-align: center; padding: 60px 20px;">
            <i class="fas fa-calendar-times" style="font-size: 64px; color: var(--text-light); opacity: 0.3; margin-bottom: 16px;"></i>
            <h3>Belum Ada Reservasi</h3>
            <p style="color: var(--text-light);">Silakan tambahkan reservasi temu dokter</p>
        </div>
    @endforelse
</div>
@endsection

@push('scripts')
<script>
    // Filter functionality
    const filterTabs = document.querySelectorAll('.filter-tab');
    const appointmentCards = document.querySelectorAll('.appointment-card');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active tab
            filterTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Filter cards
            appointmentCards.forEach(card => {
                if (filter === 'all' || card.dataset.status === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush