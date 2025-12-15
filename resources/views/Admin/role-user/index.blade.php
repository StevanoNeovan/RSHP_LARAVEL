@extends('layouts.admin')

@section('title', 'Role User')
@section('page-title', 'Manajemen Role User')

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
</style>

{{-- Header --}}
<div class="card header-section">
    <div class="header-title">
        <h2>Daftar User dengan Role</h2>
    </div>

    <a href="{{ route('admin.role-user.create') }}">
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Role User
        </button>
    </a>
</div>

{{-- Filter Tabs --}}
<div class="filter-tabs">
    <a href="{{ route('admin.role-user.index') }}"
       class="btn {{ !request('trashed') ? 'btn-primary' : 'btn-secondary' }}">
        <i class="fas fa-list"></i> Aktif
    </a>

    <a href="{{ route('admin.role-user.index', ['trashed' => 'only']) }}"
       class="btn {{ request('trashed') == 'only' ? 'btn-danger' : 'btn-secondary' }}">
        <i class="fas fa-trash"></i> Terhapus
    </a>

    <a href="{{ route('admin.role-user.index', ['trashed' => 'with']) }}"
       class="btn {{ request('trashed') == 'with' ? 'btn-warning' : 'btn-secondary' }}">
        <i class="fas fa-archive"></i> Semua
    </a>
</div>

{{-- Warning Alert --}}
@if(request('trashed'))
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle"></i>
    Menampilkan data yang sudah dihapus.
    <a href="{{ route('admin.role-user.index') }}" class="fw-bold">Lihat data aktif</a>
</div>
@endif


{{-- Table Card --}}
<div class="table-card">
    <table>
        <thead>
            <tr>
                <th class="nama-kategori">No</th>
                <th class="nama-kategori">Nama User</th>
                <th class="nama-kategori">Email</th>
                <th class="nama-kategori">Role</th>
                <th class="nama-kategori">Status</th>
                <th style="width: 150px;">Dihapus Oleh</th>
                <th style="width: 150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roleUsers as $index => $roleUser)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $roleUser->user->nama }}</td>
                <td>{{ $roleUser->user->email }}</td>
                <td>{{ $roleUser->role?->nama_role ?? 'Role Dihapus' }}</td>
                 <td>
                    @if($roleUser->trashed())
                        <span class="badge badge-danger">Terhapus</span>
                    @else
                        <span class="badge badge-success">Aktif</span>
                    @endif
                </td>
                <td>
                        {{-- Cek apakah data ROLE_USER ini yang dihapus & punya data deleted_by --}}
                        @if($roleUser->trashed() && $roleUser->deleted_by) 
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-user" style="color: #6b7280;"></i>
                                <div>
                                    {{-- Pastikan relasi 'deletedBy' ada --}}
                                    <strong>{{ $roleUser->deletedBy->nama ?? 'Unknown' }}</strong><br>
                                    <small style="color: #6b7280;">
                                        {{ \Carbon\Carbon::parse($roleUser->deleted_at)->format('d M Y, H:i') }}
                                    </small>
                                </div>
                            </div>
                        @else
                            <span style="color: #9ca3af;">-</span>
                        @endif
                     </td>
                <td>
                    <div class="action-group">
                        @if($roleUser->trashed())
                            <form action="{{ route('admin.role-user.restore', $roleUser->idrole_user) }}"
                                  method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm">
                                    <i class="fas fa-undo"></i> Restore
                                </button>
                            </form>

                            <form action="{{ route('admin.role-user.force-delete', $roleUser->idrole_user) }}"
                                  method="POST"
                                  onsubmit="return confirm('PERMANEN! Data tidak bisa dikembalikan. Yakin?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Hapus Permanen
                                </button>
                            </form>
                        @else
                            <a href="{{ route('admin.role-user.edit', $roleUser->idrole_user) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('admin.role-user.destroy', $roleUser->idrole_user) }}"
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
                <td colspan="6" class="empty-state">
                    <i class="fas fa-info-circle"></i><br>
                    Tidak ada data
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
