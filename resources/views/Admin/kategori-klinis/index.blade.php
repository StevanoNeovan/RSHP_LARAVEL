@extends('layouts.admin')

@section('title', 'Kategori Klinis')
@section('page-title', 'Master Data Kategori Klinis')

@section('content')

<style>
    /* ===== Card & Layout ===== */
    .card {
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        margin-bottom: 24px;
    }

    /* ===== Header ===== */
    .header-section {
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

    /* ===== Buttons ===== */
    .btn {
        border-radius: 8px;
        font-weight: 600;
        padding: 8px 14px;
        font-size: 13px;
    }

    .btn-primary {
        background: var(--primary-color);
        color: #fff;
        border: none;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
        border: none;
    }

    .btn-warning {
        background: #f59e0b;
        color: #fff;
        border: none;
    }

    .btn-danger {
        background: #ef4444;
        color: #fff;
        border: none;
    }

    .btn-success {
        background: #22c55e;
        color: #fff;
        border: none;
    }

    .btn:hover {
        opacity: .9;
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

    /* ===== Table ===== */
    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead th {
        background: var(--background-light);
        padding: 14px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: .03em;
        color: var(--text-dark);
        border-bottom: 1px solid var(--border-color);
    }

    tbody td {
        padding: 14px;
        font-size: 14px;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    th.nama-kategori,
    td.nama-kategori {
        text-align: left;
    }


    /* ===== Badge ===== */
    .badge {
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-success {
        background: #dcfce7;
        color: #166534;
    }

    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    /* ===== Action Buttons ===== */
    .action-group {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    /* ===== Empty State ===== */
    .empty-state {
        text-align: center;
        padding: 40px 0;
        color: var(--text-light);
        font-style: italic;
    }

    td .nama-kategori,
    tr .nama-kategori {
        text-align: left;
    }

</style>

{{-- Header --}}
<div class="card header-section">
    <div class="header-title">
        <h2>Daftar Kategori Klinis</h2>
    </div>

    <a href="{{ route('admin.kategori-klinis.create') }}">
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori Klinis
        </button>
    </a>
</div>

{{-- Filter Tabs --}}
<div class="filter-tabs">
    <a href="{{ route('admin.kategori-klinis.index') }}"
       class="btn {{ !request('trashed') ? 'btn-primary' : 'btn-secondary' }}">
        <i class="fas fa-list"></i> Aktif
    </a>

    <a href="{{ route('admin.kategori-klinis.index', ['trashed' => 'only']) }}"
       class="btn {{ request('trashed') == 'only' ? 'btn-danger' : 'btn-secondary' }}">
        <i class="fas fa-trash"></i> Terhapus
    </a>

    <a href="{{ route('admin.kategori-klinis.index', ['trashed' => 'with']) }}"
       class="btn {{ request('trashed') == 'with' ? 'btn-warning' : 'btn-secondary' }}">
        <i class="fas fa-archive"></i> Semua
    </a>
</div>

{{-- Warning Alert --}}
@if(request('trashed'))
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle"></i>
    Menampilkan data yang sudah dihapus.
    <a href="{{ route('admin.kategori-klinis.index') }}" class="fw-bold">Lihat data aktif</a>
</div>
@endif

{{-- Table Card --}}

<div class="table-card">
<table>
    <thead>
        <tr>
            <th class="nama-kategori">No</th>
            <th class="nama-kategori">Nama Kategori Klinis</th>
            <th class="nama-kategori">Status</th>
            <th class="nama-kategori">Dihapus Oleh</th>
            <th class="nama-kategori">Aksi</th>
        </tr>
    </thead>
    <tbody>
            @forelse ($kategoriKlinis as $index => $kat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="nama-kategori">{{ $kat->nama_kategori_klinis }}</td>
                <td>
                    @if($kat->trashed())
                        <span class="badge badge-danger">Terhapus</span>
                    @else
                        <span class="badge badge-success">Aktif</span>
                    @endif
                </td>
                <td>
                         @if($kat->trashed() && $kat->deleted_by)
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-user" style="color: #6b7280;"></i>
                                    <div>
                                        <strong>{{ $kat->deletedBy->nama ?? 'Unknown' }}</strong><br>
                                        <small style="color: #6b7280;">
                                            {{ \Carbon\Carbon::parse($kat->deleted_at)->format('d M Y, H:i') }}
                                        </small>
                                    </div>
                                </div>
                            @else
                                <span style="color: #9ca3af;">-</span>
                            @endif
                    </td>
                <td>
                    <div class="action-group">
                        @if($kat->trashed())
                            <form action="{{ route('admin.kategori-klinis.restore', $kat->idkategori_klinis) }}"
                                  method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm">
                                    <i class="fas fa-undo"></i> Restore
                                </button>
                            </form>

                            <form action="{{ route('admin.kategori-klinis.force-delete', $kat->idkategori_klinis) }}"
                                  method="POST"
                                  onsubmit="return confirm('PERMANEN! Data tidak bisa dikembalikan. Yakin?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Hapus Permanen
                                </button>
                            </form>
                        @else
                            <a href="{{ route('admin.kategori-klinis.edit', $kat->idkategori_klinis) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('admin.kategori-klinis.destroy', $kat->idkategori_klinis) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="empty-state">
                    Tidak ada data kategori klinis
                </td>
            </tr>
            @endforelse
        </tbody>
</table>
</div>
@endsection