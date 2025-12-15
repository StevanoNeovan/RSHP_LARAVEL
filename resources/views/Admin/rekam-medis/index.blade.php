@extends('layouts.admin')

@section('title', 'Rekam Medis')
@section('page-title', 'Manajemen Rekam Medis')

@section('content')
<style>
    .rekam-medis-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        margin-bottom: 16px;
        transition: all 0.3s ease;
    }

    .rekam-medis-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .rm-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 16px;
}

.rm-header-left {
    display: flex;
    flex-direction: column;
}

.rm-header-right {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

    .rm-id {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary-color);
    }

    .rm-date {
        font-size: 13px;
        color: var(--text-light);
        margin-top: 4px;
    }

    .rm-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .info-group {
        display: flex;
        gap: 12px;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background: var(--background-light);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        flex-shrink: 0;
    }

    .info-content h4 {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 4px;
        font-weight: 500;
    }

    .info-content p {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .rm-summary {
        background: var(--background-light);
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 16px;
    }

    .rm-summary h4 {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-light);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .rm-summary p {
        font-size: 14px;
        color: var(--text-dark);
        line-height: 1.6;
    }

    .rm-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .badge-count {
        background: var(--primary-color);
        color: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
    }

    .stats-mini {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-mini {
        background: white;
        padding: 16px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        text-align: center;
    }

    .stat-mini h3 {
        font-size: 28px;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 4px;
    }

    .stat-mini p {
        font-size: 12px;
        color: var(--text-light);
    }

     /* ===== Filter Tabs ===== */
    .filter-tabs {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    /* ===== Alert ===== */
    .alert {
        border-radius: 10px;
        padding: 14px 18px;
        font-size: 14px;
    }

    /* ===== Action Buttons ===== */
   .action-group {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    }

    .action-group form {
        margin: 0;
    }

    th.nama-kategori,
    td.nama-kategori {
        text-align: left;
    }

    /* ===== Rekam Medis Status Badge ===== */
.rm-status {
    position: static; /* PENTING */
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.rm-status.aktif {
    background: #dcfce7;
    color: #166534;
}

.rm-status.terhapus {
    background: #fee2e2;
    color: #991b1b;
}

/* ===== Deleted Meta ===== */
.rm-meta {
    margin-top: 16px;
    padding-top: 12px;
    border-top: 1px dashed var(--border-color);
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    color: #6b7280;
}

.rm-meta i {
    color: #9ca3af;
}

.rm-meta strong {
    color: var(--text-dark);
    font-weight: 600;
}

.rm-meta small {
    color: #9ca3af;
    font-size: 12px;
}


</style>

<!-- Statistics -->
<div class="stats-mini">
    <div class="stat-mini">
        <h3>{{ $rekamMedis->count() }}</h3>
        <p>Total Rekam Medis</p>
    </div>
    <div class="stat-mini">
        <h3>{{ $rekamMedis->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
        <p>Bulan Ini</p>
    </div>
    <div class="stat-mini">
        <h3>{{ $rekamMedis->where('created_at', '>=', now()->startOfWeek())->count() }}</h3>
        <p>Minggu Ini</p>
    </div>
</div>

{{-- Filter Tabs --}}
<div class="filter-tabs">
    <a href="{{ route('admin.rekam-medis.index') }}"
       class="btn {{ !request('trashed') ? 'btn-primary' : 'btn-secondary' }}">
        <i class="fas fa-list"></i> Aktif
    </a>

    <a href="{{ route('admin.rekam-medis.index', ['trashed' => 'only']) }}"
       class="btn {{ request('trashed') == 'only' ? 'btn-danger' : 'btn-secondary' }}">
        <i class="fas fa-trash"></i> Terhapus
    </a>

    <a href="{{ route('admin.rekam-medis.index', ['trashed' => 'with']) }}"
       class="btn {{ request('trashed') == 'with' ? 'btn-warning' : 'btn-secondary' }}">
        <i class="fas fa-archive"></i> Semua
    </a>
</div>

{{-- Warning Alert --}}
@if(request('trashed'))
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle"></i>
    Menampilkan data yang sudah dihapus.
    <a href="{{ route('admin.rekam-medis.index') }}" class="fw-bold">Lihat data aktif</a>
</div>
@endif

<!-- Action Button -->
<div style="margin-bottom: 24px;">
    <a href="{{ route('admin.rekam-medis.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i>
        Tambah Rekam Medis
    </a>
</div>

<!-- Rekam Medis List -->
@forelse($rekamMedis as $rm)
<div class="rekam-medis-card" style="position: relative;">


    {{-- HEADER --}}
    <div class="rm-header">
    <div class="rm-header-left">
        <div class="rm-id">RM-{{ str_pad($rm->idrekam_medis, 5, '0', STR_PAD_LEFT) }}</div>
        <div class="rm-date">
            <i class="fas fa-calendar"></i>
            {{ \Carbon\Carbon::parse($rm->created_at)->format('d M Y, H:i') }}
        </div>
    </div>

    <div class="rm-header-right">
        <span class="badge-count">
            <i class="fas fa-notes-medical"></i>
            {{ $rm->details->count() }} Tindakan
        </span>

        @if($rm->trashed())
            <span class="rm-status terhapus">
                <i class="fas fa-trash"></i> Terhapus
            </span>
        @else
            <span class="rm-status aktif">
                <i class="fas fa-check-circle"></i> Aktif
            </span>
        @endif
    </div>
</div>


    {{-- INFO --}}
    <div class="rm-info">
        <div class="info-group">
            <div class="info-icon"><i class="fas fa-paw"></i></div>
            <div class="info-content">
                <h4>Pet</h4>
                <p>{{ $rm->temuDokter->pet->nama }}</p>
            </div>
        </div>

        <div class="info-group">
            <div class="info-icon"><i class="fas fa-user"></i></div>
            <div class="info-content">
                <h4>Pemilik</h4>
                <p>{{ $rm->temuDokter->pet->pemilik->user->nama }}</p>
            </div>
        </div>

        <div class="info-group">
            <div class="info-icon"><i class="fas fa-user-md"></i></div>
            <div class="info-content">
                <h4>Dokter</h4>
                <p>{{ $rm->temuDokter->roleUser->user->nama }}</p>
            </div>
        </div>
    </div>

    {{-- DIAGNOSA --}}
    <div class="rm-summary">
        <h4>Diagnosa</h4>
        <p>{{ \Illuminate\Support\Str::limit($rm->diagnosa, 150) }}</p>
    </div>

    {{-- ACTIONS --}}
    <div class="rm-actions">
        <a href="{{ route('admin.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-primary btn-sm">
            <i class="fas fa-eye"></i> Detail
        </a>

        @if($rm->trashed())
            <form action="{{ route('admin.rekam-medis.restore', $rm->idrekam_medis) }}" method="POST">
                @csrf
                @method('PATCH')
                <button class="btn btn-success btn-sm">
                    <i class="fas fa-undo"></i> Restore
                </button>
            </form>

            <form action="{{ route('admin.rekam-medis.force-delete', $rm->idrekam_medis) }}"
                  method="POST"
                  onsubmit="return confirm('PERMANEN! Data tidak bisa dikembalikan. Yakin?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i> Hapus Permanen
                </button>
            </form>
        @else
            <a href="{{ route('admin.rekam-medis.edit', $rm->idrekam_medis) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>

            <form action="{{ route('admin.rekam-medis.destroy', $rm->idrekam_medis) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus rekam medis ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
        @endif
    </div>

    {{-- DELETED META --}}
    @if($rm->trashed() && $rm->deleted_by)
        <div class="rm-meta">
            <i class="fas fa-user"></i>
            <div>
                <strong>{{ $rm->deletedBy->nama ?? 'Unknown' }}</strong><br>
                <small>{{ \Carbon\Carbon::parse($rm->deleted_at)->format('d M Y, H:i') }}</small>
            </div>
        </div>
    @endif

</div>


@empty
    <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 12px; border: 1px solid var(--border-color);">
        <i class="fas fa-file-medical" style="font-size: 64px; color: var(--text-light); opacity: 0.3; margin-bottom: 16px;"></i>
        <h3>Belum Ada Rekam Medis</h3>
        <p style="color: var(--text-light); margin-bottom: 24px;">Silakan buat rekam medis untuk temu dokter yang sudah selesai</p>
        <a href="{{ route('admin.rekam-medis.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Tambah Rekam Medis Pertama
        </a>
    </div>
@endforelse
@endsection