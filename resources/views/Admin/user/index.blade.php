@extends('layouts.admin')

@section('title', 'Data User')
@section('page-title', 'Manajemen User')

@section('content')
<style>
    .table-container {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .table-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .table-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-box {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-input {
        padding: 10px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        width: 250px;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary-color);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: var(--background-light);
    }

    th {
        padding: 16px 24px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    td {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color);
        font-size: 14px;
    }

    tbody tr:hover {
        background: var(--background-light);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 18px;
        flex-shrink: 0;
    }

    .user-avatar.admin {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .user-avatar.dokter {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
    }

    .user-avatar.perawat {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    }

    .user-avatar.pemilik {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .user-details h4 {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 2px;
    }

    .user-details p {
        font-size: 12px;
        color: var(--text-light);
    }

    .badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }

    .badge-admin {
        background: #fee2e2;
        color: #991b1b;
    }

    .badge-dokter {
        background: #cffafe;
        color: #0e7490;
    }

    .badge-perawat {
        background: #ede9fe;
        color: #6b21a8;
    }

    .badge-resepsionis {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-pemilik {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-inactive {
        background: #f3f4f6;
        color: #6b7280;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-light);
    }

    .empty-state i {
        font-size: 64px;
        margin-bottom: 16px;
        opacity: 0.3;
    }

    .empty-state h3 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-dark);
    }

    .stats-mini {
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

    .role-list {
        display: flex;
        flex-direction: column;
        gap: 4px;
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


</style>

<!-- Statistics -->
<div class="stats-mini">
    <div class="stat-mini-card">
        <div class="stat-mini-icon" style="background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $users->count() }}</h3>
            <p>Total User</p>
        </div>
    </div>
    <div class="stat-mini-card">
        <div class="stat-mini-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $users->filter(function($u) { return $u->roleUser->where('idrole', 1)->where('status', 1)->count() > 0; })->count() }}</h3>
            <p>Administrator</p>
        </div>
    </div>
    <div class="stat-mini-card">
        <div class="stat-mini-icon" style="background: linear-gradient(135deg, #06b6d4, #0891b2);">
            <i class="fas fa-user-md"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $users->filter(function($u) { return $u->roleUser->where('idrole', 2)->where('status', 1)->count() > 0; })->count() }}</h3>
            <p>Dokter</p>
        </div>
    </div>
    <div class="stat-mini-card">
        <div class="stat-mini-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
            <i class="fas fa-user"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $users->filter(function($u) { return $u->pemilik !== null; })->count() }}</h3>
            <p>Pemilik</p>
        </div>
    </div>
      <div class="stat-mini-card">
        <div class="stat-mini-icon" style="background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));">
            <i class="fas fa-user"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $users->filter(function($u) { return $u->roleUser->where('idrole', 3)->where('status', 1)->count() > 0; })->count() }}</h3>
            <p>Resepsionis</p>
        </div>
    </div>
    <div class="stat-mini-card">
        <div class="stat-mini-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed)">
            <i class="fas fa-user"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $users->filter(function($u) { return $u->roleUser->where('idrole', 4)->where('status', 1)->count() > 0; })->count() }}</h3>
            <p>Perawat</p>
        </div>
    </div>
</div>

{{-- Filter Tabs --}}
<div class="filter-tabs">
    <a href="{{ route('admin.user.index') }}"
       class="btn {{ !request('trashed') ? 'btn-primary' : 'btn-secondary' }}">
        <i class="fas fa-list"></i> Aktif
    </a>

    <a href="{{ route('admin.user.index', ['trashed' => 'only']) }}"
       class="btn {{ request('trashed') == 'only' ? 'btn-danger' : 'btn-secondary' }}">
        <i class="fas fa-trash"></i> Terhapus
    </a>

    <a href="{{ route('admin.user.index', ['trashed' => 'with']) }}"
       class="btn {{ request('trashed') == 'with' ? 'btn-warning' : 'btn-secondary' }}">
        <i class="fas fa-archive"></i> Semua
    </a>
</div>

{{-- Warning Alert --}}
@if(request('trashed'))
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle"></i>
    Menampilkan data yang sudah dihapus.
    <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="fw-bold">Lihat data aktif</a>
</div>
@endif

{{--- Table Card --}}
<div class="table-container">
    <div class="table-header">
        <h2 class="table-title">
            <i class="fas fa-users"></i>
            Data User
        </h2>
        <div class="search-box">
            <input type="text" class="search-input" placeholder="Cari nama atau email..." id="searchInput">
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah User
            </a>
        </div>
    </div>

    @if($users->count() > 0)
        <table id="userTable">
            <thead>
                <tr>
                    <th class="nama-kategori">No</th>
                    <th class="nama-kategori">User</th>
                    <th class="nama-kategori">Email</th>
                    <th class="nama-kategori">Role Aktif</th>
                    <th class="nama-kategori">Status Role</th>
                    <th class="nama-kategori">Status User</th>
                    <th class="nama-kategori">Dihapus Oleh</th>
                    <th class="nama-kategori">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                @php
                    $activeRoles = $user->roleUser->where('status', 1)->where('deleted_at', null);
                    $primaryRole = $activeRoles->first();
                    $roleClass = 'user';
                    if ($primaryRole) {
                        switch($primaryRole->idrole) {
                            case 1: $roleClass = 'admin'; break;
                            case 2: $roleClass = 'dokter'; break;
                            case 3: $roleClass = 'perawat'; break;
                            case 5: $roleClass = 'pemilik'; break;
                        }
                    } elseif ($user->pemilik) {
                        $roleClass = 'pemilik';
                    }
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar {{ $roleClass }}">
                                {{ strtoupper(substr($user->nama, 0, 1)) }}
                            </div>
                            <div class="user-details">
                                <h4>{{ $user->nama }}</h4>
                                <p>ID: {{ $user->iduser }}</p>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="role-list">
                            @if($activeRoles->count() > 0)
                                @foreach($activeRoles as $roleUser)
                                    @php
                                        $badgeClass = 'badge-inactive';
                                        switch($roleUser->idrole) {
                                            case 1: $badgeClass = 'badge-admin'; break;
                                            case 2: $badgeClass = 'badge-dokter'; break;
                                            case 3: $badgeClass = 'badge-perawat'; break;
                                            case 4: $badgeClass = 'badge-resepsionis'; break;
                                            case 5: $badgeClass = 'badge-pemilik'; break;
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ $roleUser->role->nama_role ?? 'Unknown' }}
                                    </span>
                                @endforeach
                            @elseif($user->pemilik)
                                <span class="badge badge-pemilik">
                                    Pemilik (Non-Staf)
                                </span>
                            @else
                                <span style="color: var(--text-light); font-size: 13px;">Belum ada role</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        @if($activeRoles->count() > 0 || $user->pemilik)
                            <span class="badge badge-pemilik">Aktif</span>
                        @else
                            <span class="badge badge-inactive">Tidak Aktif</span>
                        @endif
                    </td>
                        <td>
                            @if($user->trashed())
                                <span class="badge badge-danger">Terhapus</span>
                            @else
                                <span class="badge badge-success">Aktif</span>
                            @endif
                        </td>
                        <td>
                            @if($user->trashed() && $user->deleted_by)
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-user" style="color: #6b7280;"></i>
                                    <div>
                                        <strong>{{ $user->deletedBy->nama ?? 'Unknown' }}</strong><br>
                                        <small style="color: #6b7280;">
                                            {{ \Carbon\Carbon::parse($user->deleted_at)->format('d M Y, H:i') }}
                                        </small>
                                    </div>
                                </div>
                            @else
                                <span style="color: #9ca3af;">-</span>
                            @endif
                        </td>

                    <td>
                        <div class="action-group">
                            {{-- Detail --}}
                            <a href="{{ route('admin.user.show', $user->iduser) }}"
                            class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> Detail
                            </a>

                            @if($user->trashed())
                                {{-- Restore --}}
                                <form action="{{ route('admin.user.restore', $user->iduser) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm">
                                        <i class="fas fa-undo"></i> Restore
                                    </button>
                                </form>

                                {{-- Force Delete --}}
                                <form action="{{ route('admin.user.force-delete', $user->iduser) }}"
                                    method="POST"
                                    onsubmit="return confirm('PERMANEN! Data tidak bisa dikembalikan. Yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Hapus Permanen
                                    </button>
                                </form>
                            @else
                                {{-- Edit --}}
                                <a href="{{ route('admin.user.edit', $user->iduser) }}"
                                class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.user.destroy', $user->iduser) }}"
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
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <i class="fas fa-users"></i>
            <h3>Tidak Ada Data User</h3>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Simple search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('#userTable tbody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
</script>
@endpush