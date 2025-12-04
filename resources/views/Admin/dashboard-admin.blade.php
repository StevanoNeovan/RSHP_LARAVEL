@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Administrator')

@section('content')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--primary-color);
    }

    .stat-card.success::before {
        background: var(--secondary-color);
    }

    .stat-card.warning::before {
        background: var(--accent-color);
    }

    .stat-card.danger::before {
        background: var(--danger-color);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    }

    .stat-card.success .stat-icon {
        background: linear-gradient(135deg, var(--secondary-color), #059669);
    }

    .stat-card.warning .stat-icon {
        background: linear-gradient(135deg, var(--accent-color), #d97706);
    }

    .stat-card.danger .stat-icon {
        background: linear-gradient(135deg, var(--danger-color), #dc2626);
    }

    .stat-number {
        font-size: 36px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1;
    }

    .stat-label {
        font-size: 14px;
        color: var(--text-light);
        margin-top: 8px;
        font-weight: 500;
    }

    .stat-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 12px;
        color: var(--primary-color);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: gap 0.2s ease;
    }

    .stat-link:hover {
        gap: 10px;
    }

    .quick-actions {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        margin-bottom: 32px;
    }

    .quick-actions h3 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text-dark);
    }

    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        padding: 20px;
        background: var(--background-light);
        border: 2px solid var(--border-color);
        border-radius: 10px;
        text-decoration: none;
        color: var(--text-dark);
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        background: white;
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .action-btn i {
        font-size: 32px;
        color: var(--primary-color);
    }

    .action-btn span {
        font-size: 14px;
        font-weight: 600;
        text-align: center;
    }

    .welcome-banner {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 32px;
        border-radius: 12px;
        margin-bottom: 32px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .welcome-banner h1 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .welcome-banner p {
        font-size: 16px;
        opacity: 0.95;
    }
</style>

<!-- Welcome Banner -->
<div class="welcome-banner">
    <h1>👋 Selamat Datang, {{ Auth::user()->nama }}!</h1>
    <p>Kelola sistem RSHP UNAIR dengan mudah dan efisien. Semua data master dan transaksi dalam satu tempat.</p>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <!-- Total Jenis Hewan -->
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-number">{{ $jenisHewan->count() }}</div>
                <div class="stat-label">Jenis Hewan</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-paw"></i>
            </div>
        </div>
        <a href="{{ route('admin.jenis-hewan.index') }}" class="stat-link">
            Lihat Detail <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <!-- Total Ras Hewan -->
    <div class="stat-card success">
        <div class="stat-header">
            <div>
                <div class="stat-number">{{ $rasHewan->count() }}</div>
                <div class="stat-label">Ras Hewan</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-dog"></i>
            </div>
        </div>
        <a href="{{ route('admin.ras-hewan.index') }}" class="stat-link">
            Lihat Detail <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <!-- Total Kategori -->
    <div class="stat-card warning">
        <div class="stat-header">
            <div>
                <div class="stat-number">{{ $kategori->count() }}</div>
                <div class="stat-label">Kategori</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-folder"></i>
            </div>
        </div>
        <a href="{{ route('admin.kategori.index') }}" class="stat-link">
            Lihat Detail <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <!-- Total Kode Tindakan -->
    <div class="stat-card danger">
        <div class="stat-header">
            <div>
                <div class="stat-number">{{ $kodeTindakan->count() }}</div>
                <div class="stat-label">Kode Tindakan</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-notes-medical"></i>
            </div>
        </div>
        <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="stat-link">
            Lihat Detail <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h3>
        <i class="fas fa-bolt"></i>
        Aksi Cepat
    </h3>
    <div class="action-grid">
        <a href="{{ route('admin.jenis-hewan.create') }}" class="action-btn">
            <i class="fas fa-plus-circle"></i>
            <span>Tambah Jenis Hewan</span>
        </a>
        <a href="{{ route('admin.ras-hewan.create') }}" class="action-btn">
            <i class="fas fa-plus-circle"></i>
            <span>Tambah Ras Hewan</span>
        </a>
        <a href="{{ route('admin.kode-tindakan-terapi.create') }}" class="action-btn">
            <i class="fas fa-plus-circle"></i>
            <span>Tambah Kode Tindakan</span>
        </a>
        <a href="{{ route('admin.pemilik.create') }}" class="action-btn">
            <i class="fas fa-user-plus"></i>
            <span>Tambah Pemilik</span>
        </a>
        <a href="{{ route('admin.pet.create') }}" class="action-btn">
            <i class="fas fa-cat"></i>
            <span>Tambah Pet</span>
        </a>
        <a href="{{ route('admin.user.index') }}" class="action-btn">
            <i class="fas fa-users"></i>
            <span>Kelola User</span>
        </a>
    </div>
</div>

<!-- Data Summary -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-chart-bar"></i>
            Ringkasan Data Master
        </h3>
    </div>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 2px solid var(--border-color);">
                <th style="padding: 12px; text-align: left; color: var(--text-light); font-size: 13px; font-weight: 600;">Data Master</th>
                <th style="padding: 12px; text-align: center; color: var(--text-light); font-size: 13px; font-weight: 600;">Total</th>
                <th style="padding: 12px; text-align: right; color: var(--text-light); font-size: 13px; font-weight: 600;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 16px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: rgba(37, 99, 235, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--primary-color);">
                            <i class="fas fa-paw"></i>
                        </div>
                        <span style="font-weight: 600;">Jenis Hewan</span>
                    </div>
                </td>
                <td style="padding: 16px; text-align: center; font-weight: 700; font-size: 18px; color: var(--primary-color);">
                    {{ $jenisHewan->count() }}
                </td>
                <td style="padding: 16px; text-align: right;">
                    <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-primary" style="padding: 8px 16px; font-size: 13px;">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 16px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: rgba(16, 185, 129, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--secondary-color);">
                            <i class="fas fa-dog"></i>
                        </div>
                        <span style="font-weight: 600;">Ras Hewan</span>
                    </div>
                </td>
                <td style="padding: 16px; text-align: center; font-weight: 700; font-size: 18px; color: var(--secondary-color);">
                    {{ $rasHewan->count() }}
                </td>
                <td style="padding: 16px; text-align: right;">
                    <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-success" style="padding: 8px 16px; font-size: 13px;">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 16px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: rgba(245, 158, 11, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--accent-color);">
                            <i class="fas fa-folder"></i>
                        </div>
                        <span style="font-weight: 600;">Kategori</span>
                    </div>
                </td>
                <td style="padding: 16px; text-align: center; font-weight: 700; font-size: 18px; color: var(--accent-color);">
                    {{ $kategori->count() }}
                </td>
                <td style="padding: 16px; text-align: right;">
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-warning" style="padding: 8px 16px; font-size: 13px;">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                </td>
            </tr>
            <tr>
                <td style="padding: 16px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 40px; height: 40px; background: rgba(239, 68, 68, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--danger-color);">
                            <i class="fas fa-notes-medical"></i>
                        </div>
                        <span style="font-weight: 600;">Kode Tindakan Terapi</span>
                    </div>
                </td>
                <td style="padding: 16px; text-align: center; font-weight: 700; font-size: 18px; color: var(--danger-color);">
                    {{ $kodeTindakan->count() }}
                </td>
                <td style="padding: 16px; text-align: right;">
                    <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-danger" style="padding: 8px 16px; font-size: 13px;">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection