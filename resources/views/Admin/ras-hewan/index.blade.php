@extends('layouts.admin')

@section('title', 'Ras Hewan')
@section('page-title', 'Master Data Ras Hewan')

@section('content')

<style>
    .header-section {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .header-title h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .header-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-tabs {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
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
        text-decoration: none;
        color: var(--text-dark);
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

    .btn-primary {
        background: var(--primary-color);
        border: none;
        padding: 10px 16px;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary:hover {
        opacity: .9;
    }

    .btn-danger {
        background: var(--danger-color);
        border: none;
        padding: 10px 16px;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-danger:hover {
        opacity: .9;
    }

    .table-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 12px;
    }

    table th {
        background: var(--background-light);
        padding: 12px;
        text-align: left;
        font-size: 14px;
        color: var(--text-dark);
        border-bottom: 1px solid var(--border-color);
    }

    table td {
        padding: 12px;
        border-bottom: 1px solid var(--border-color);
        font-size: 14px;
    }

    .action-btn {
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        color: white;
        text-decoration: none;
        display: inline-block;
        margin-right: 4px;
    }

    .btn-edit {
        background: #3b82f6;
    }

    .btn-delete {
        background: #ef4444;
    }

    .btn-success {
        background: #10b981;
    }

    .empty-state {
        text-align: center;
        padding: 40px 0;
        color: var(--text-light);
    }

    .badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
        margin-left: 8px;
    }

    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    .alert {
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .alert-warning {
        background: #fef3c7;
        border: 1px solid #fcd34d;
        color: #92400e;
    }

    .ras-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 0;
    }

    .ras-item.deleted {
        opacity: 0.6;
        text-decoration: line-through;
    }
</style>

{{-- Header --}}
<div class="header-section">
    <div class="header-title">
        <h2>Daftar Ras Hewan</h2>
    </div>

    <div class="header-actions">
        <a href="{{ route('admin.ras-hewan.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Ras Hewan
        </a>
    </div>
</div>

{{-- Filter Tabs --}}
<div class="filter-tabs">
    <a href="{{ route('admin.ras-hewan.index') }}" 
       class="filter-tab {{ !request('trashed') ? 'active' : '' }}">
        <i class="fas fa-list"></i>
        Aktif
    </a>
    
    <a href="{{ route('admin.ras-hewan.index', ['trashed' => 'only']) }}" 
       class="filter-tab {{ request('trashed') == 'only' ? 'active' : '' }}">
        <i class="fas fa-trash"></i>
        Terhapus
    </a>
    
    <a href="{{ route('admin.ras-hewan.index', ['trashed' => 'with']) }}" 
       class="filter-tab {{ request('trashed') == 'with' ? 'active' : '' }}">
        <i class="fas fa-archive"></i>
        Semua Data
    </a>
</div>

{{-- Warning Alert --}}
@if(request('trashed'))
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle"></i>
    <div>
        Menampilkan data yang sudah dihapus. 
        <a href="{{ route('admin.ras-hewan.index') }}" style="font-weight: 600; text-decoration: underline;">
            Lihat data aktif
        </a>
    </div>
</div>
@endif

{{-- Table per Jenis Hewan --}}
@foreach ($jenisHewan as $index => $jenis)
<div class="table-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <h3 style="margin: 0; font-size: 18px;">
            <i class="fas fa-paw"></i> {{ $jenis->nama_jenis_hewan }}
            
            @if($jenis->trashed())
                <span class="badge badge-danger">Jenis Dihapus</span>
            @endif
        </h3>
        
        <div style="display: flex; gap: 8px;">
            @if(!$jenis->trashed())
                <a href="{{ route('admin.ras-hewan.edit', $jenis->idjenis_hewan) }}" class="action-btn btn-edit">
                    <i class="fas fa-edit"></i> Edit Ras
                </a>
                
                @if($jenis->rasHewan->count() > 0)
                    <a href="{{ route('admin.ras-hewan.delete-form', $jenis->idjenis_hewan) }}" class="action-btn btn-delete">
                        <i class="fas fa-trash"></i> Hapus Ras
                    </a>
                @endif
            @endif
        </div>
    </div>

    @if ($jenis->rasHewan->count())
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($jenis->rasHewan as $ras)
                <li class="ras-item {{ $ras->trashed() ? 'deleted' : '' }}">
                    <span>
                        {{ $ras->nama_ras }}
                        
                        @if($ras->trashed())
                            <span class="badge badge-danger">Dihapus</span>
                        @endif
                    </span>
                    
                    @if($ras->trashed() && request('trashed'))
                        <div style="display: flex; gap: 4px;">
                            {{-- Restore Button --}}
                            <form action="{{ route('admin.ras-hewan.restore', $ras->idras_hewan) }}" 
                                  method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="action-btn btn-success" 
                                        onclick="return confirm('Pulihkan ras {{ $ras->nama_ras }}?')">
                                    <i class="fas fa-undo"></i> Restore
                                </button>
                            </form>
                            
                            {{-- Force Delete Button --}}
                            <form action="{{ route('admin.ras-hewan.force-delete', $ras->idras_hewan) }}" 
                                  method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete" 
                                        onclick="return confirm('PERMANEN! Data tidak bisa dikembalikan. Yakin hapus {{ $ras->nama_ras }}?')">
                                    <i class="fas fa-trash-alt"></i> Hapus Permanen
                                </button>
                            </form>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p style="color: #888; font-style: italic; margin: 16px 0;">
            Belum ada ras untuk jenis hewan ini
        </p>
    @endif
</div>
@endforeach

@if($jenisHewan->count() == 0)
<div class="table-card">
    <div class="empty-state">
        <i class="fas fa-inbox" style="font-size: 48px; opacity: 0.3; margin-bottom: 16px;"></i>
        <h3>Tidak ada data</h3>
        <p>Silakan ubah filter atau tambah data baru</p>
    </div>
</div>
@endif

@endsection