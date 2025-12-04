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
        align-items: start;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--border-color);
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

<!-- Action Button -->
<div style="margin-bottom: 24px;">
    <a href="{{ route('admin.rekam-medis.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i>
        Tambah Rekam Medis
    </a>
</div>

<!-- Rekam Medis List -->
@forelse($rekamMedis as $rm)
    <div class="rekam-medis-card">
        <div class="rm-header">
            <div>
                <div class="rm-id">RM-{{ str_pad($rm->idrekam_medis, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="rm-date">
                    <i class="fas fa-calendar"></i>
                    {{ \Carbon\Carbon::parse($rm->created_at)->format('d M Y, H:i') }}
                </div>
            </div>
            <span class="badge-count">
                <i class="fas fa-notes-medical"></i>
                {{ $rm->details->count() }} Tindakan
            </span>
        </div>

        <div class="rm-info">
            <div class="info-group">
                <div class="info-icon">
                    <i class="fas fa-paw"></i>
                </div>
                <div class="info-content">
                    <h4>Pet</h4>
                    <p>{{ $rm->temuDokter->pet->nama }}</p>
                </div>
            </div>

            <div class="info-group">
                <div class="info-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="info-content">
                    <h4>Pemilik</h4>
                    <p>{{ $rm->temuDokter->pet->pemilik->user->nama }}</p>
                </div>
            </div>

            <div class="info-group">
                <div class="info-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="info-content">
                    <h4>Dokter Pemeriksa</h4>
                    <p>{{ $rm->temuDokter->roleUser->user->nama }}</p>
                </div>
            </div>
        </div>

        <div class="rm-summary">
            <h4>Diagnosa</h4>
            <p>{{ \Illuminate\Support\Str::limit($rm->diagnosa, 150) }}</p>
        </div>

        <div class="rm-actions">
            <a href="{{ route('admin.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-eye"></i> Lihat Detail
            </a>
            <a href="{{ route('admin.rekam-medis.edit', $rm->idrekam_medis) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('admin.rekam-medis.destroy', $rm->idrekam_medis) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus rekam medis ini? Semua detail tindakan akan ikut terhapus.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
        </div>
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