@extends('layouts.admin')

@section('title', 'Data Role')
@section('page-title', 'Manajemen Role')

@section('content')
<style>
    .role-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .role-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .role-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--primary-color);
    }

    .role-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .role-card.admin::before {
        background: linear-gradient(180deg, #ef4444, #dc2626);
    }

    .role-card.dokter::before {
        background: linear-gradient(180deg, #06b6d4, #0891b2);
    }

    .role-card.perawat::before {
        background: linear-gradient(180deg, #8b5cf6, #7c3aed);
    }

    .role-card.resepsionis::before {
        background: linear-gradient(180deg, #f59e0b, #d97706);
    }

    .role-card.pemilik::before {
        background: linear-gradient(180deg, #10b981, #059669);
    }

    .role-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        margin-bottom: 16px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    }

    .role-card.admin .role-icon {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .role-card.dokter .role-icon {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
    }

    .role-card.perawat .role-icon {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    }

    .role-card.resepsionis .role-icon {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .role-card.pemilik .role-icon {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .role-name {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .role-id {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 16px;
    }

    .role-stats {
        background: var(--background-light);
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 16px;
        text-align: center;
    }

    .role-stats .number {
        font-size: 32px;
        font-weight: 700;
        color: var(--primary-color);
        line-height: 1;
    }

    .role-stats .label {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 4px;
    }

    .role-actions {
        display: flex;
        gap: 8px;
    }

    .btn-sm {
        padding: 8px 12px;
        font-size: 12px;
        flex: 1;
    }

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

    .header-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .header-title h2 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .stats-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 16px;
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

    .stat-content h3 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1;
    }

    .stat-content p {
        font-size: 13px;
        color: var(--text-light);
        margin-top: 4px;
    }

    .empty-state {
        background: white;
        border-radius: 12px;
        padding: 60px 20px;
        text-align: center;
        border: 1px solid var(--border-color);
    }

    .empty-state i {
        font-size: 64px;
        color: var(--text-light);
        opacity: 0.3;
        margin-bottom: 16px;
    }

    .empty-state h3 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-dark);
    }

    @media (max-width: 768px) {
        .role-grid {
            grid-template-columns: 1fr;
        }
    }

    .role-status {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 12px;
    }

    .role-status.aktif {
        background: #dcfce7;
        color: #166534;
    }

    .role-status.terhapus {
        background: #fee2e2;
        color: #991b1b;
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

    /* ===== Status Badge Floating ===== */
    .role-status {
        position: absolute;
        top: 16px;
        right: 16px;
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .role-status.aktif {
        background: #dcfce7;
        color: #166534;
    }

    .role-status.terhapus {
        background: #fee2e2;
        color: #991b1b;
    }

    /* ===== Actions Button Layout ===== */
    .role-actions {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-top: 16px;
    }

    .role-actions form {
        margin: 0;
    }

    .role-actions .btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    /* ===== Role Meta (Deleted By) ===== */
.role-meta {
    margin-top: 16px;
    padding-top: 12px;
    border-top: 1px dashed var(--border-color);
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    color: #6b7280;
}

.role-meta i {
    font-size: 14px;
    color: #9ca3af;
}

.role-meta strong {
    color: var(--text-dark);
    font-weight: 600;
}

.role-meta .meta-time {
    font-size: 12px;
    color: #9ca3af;
}


</style>

<!-- Statistics Summary -->
<div class="stats-summary">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-user-tag"></i>
        </div>
        <div class="stat-content">
            <h3>{{ $role->count() }}</h3>
            <p>Total Role</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, var(--secondary-color), #059669);">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-content">
            @php
                $totalUsers = 0;
                foreach($role as $r) {
                    $totalUsers += \App\Models\RoleUser::where('idrole', $r->idrole)->where('status', 1)->count();
                }
            @endphp
            <h3>{{ $totalUsers }}</h3>
            <p>User Aktif</p>
        </div>
    </div>
</div>

<!-- Header Section -->
<div class="header-section">
    <div class="header-title">
        <i class="fas fa-user-shield" style="font-size: 32px; color: var(--primary-color);"></i>
        <div>
            <h2>Manajemen Role</h2>
            <p style="margin: 0; color: var(--text-light); font-size: 14px;">Kelola hak akses sistem</p>
        </div>
    </div>
    <a href="{{ route('admin.role.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i>
        Tambah Role
    </a>
</div>

{{-- Filter Tabs --}}
<div class="filter-tabs">
    <a href="{{ route('admin.role.index') }}"
       class="btn {{ !request('trashed') ? 'btn-primary' : 'btn-secondary' }}">
        <i class="fas fa-list"></i> Aktif
    </a>

    <a href="{{ route('admin.role.index', ['trashed' => 'only']) }}"
       class="btn {{ request('trashed') == 'only' ? 'btn-danger' : 'btn-secondary' }}">
        <i class="fas fa-trash"></i> Terhapus
    </a>

    <a href="{{ route('admin.role.index', ['trashed' => 'with']) }}"
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

<!-- Role Cards -->
@if($role->count() > 0)
    <div class="role-grid">
        @foreach($role as $r)
            @php
                $roleClass = 'default';
                $iconClass = 'fa-user-tag';
                
                switch($r->idrole) {
                    case 1:
                        $roleClass = 'admin';
                        $iconClass = 'fa-user-shield';
                        break;
                    case 2:
                        $roleClass = 'dokter';
                        $iconClass = 'fa-user-md';
                        break;
                    case 3:
                        $roleClass = 'perawat';
                        $iconClass = 'fa-user-nurse';
                        break;
                    case 4:
                        $roleClass = 'resepsionis';
                        $iconClass = 'fa-user-tie';
                        break;
                    case 5:
                        $roleClass = 'pemilik';
                        $iconClass = 'fa-user';
                        break;
                }
                
                $userCount = \App\Models\RoleUser::where('idrole', $r->idrole)->where('status', 1)->count();
            @endphp
            
             <div class="role-card {{ $roleClass }}">

                {{-- STATUS BADGE --}}
                @if($r->trashed())
                    <div class="role-status terhapus">
                        <i class="fas fa-trash"></i> Terhapus
                    </div>
                @else
                    <div class="role-status aktif">
                        <i class="fas fa-check-circle"></i> Aktif
                    </div>
                @endif

                {{-- ICON --}}
                <div class="role-icon">
                    <i class="fas {{ $iconClass }}"></i>
                </div>

                {{-- ROLE INFO --}}
                <div class="role-name">{{ $r->nama_role }}</div>
                <div class="role-id">Role ID: {{ $r->idrole }}</div>

                {{-- STATS --}}
                <div class="role-stats">
                    <div class="number">{{ $userCount }}</div>
                    <div class="label">User Aktif</div>
                </div>

                {{-- ACTIONS --}}
                <div class="role-actions">
                    @if($r->trashed())
                        <form action="{{ route('admin.role.restore', $r->idrole) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm">
                                <i class="fas fa-undo"></i> Restore
                            </button>
                        </form>

                        <form action="{{ route('admin.role.force-delete', $r->idrole) }}"
                            method="POST"
                            onsubmit="return confirm('PERMANEN! Data tidak bisa dikembalikan. Yakin?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Hapus Permanen
                            </button>
                        </form>
                    @else
                        <a href="{{ route('admin.role.edit', $r->idrole) }}"
                        class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('admin.role.destroy', $r->idrole) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    @endif
                </div>

                {{-- DELETED META --}}
                @if($r->trashed() && $r->deleted_by)
                    <div class="role-meta">
                        <i class="fas fa-user"></i>
                        <div>
                            <strong>{{ $r->deletedBy->nama ?? 'Unknown' }}</strong>
                            <div class="meta-time">
                                {{ \Carbon\Carbon::parse($r->deleted_at)->format('d M Y, H:i') }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        @endforeach
    </div>
@else
    <div class="empty-state">
        <i class="fas fa-user-tag"></i>
        <h3>Belum Ada Data Role</h3>
    </div>
@endif
@endsection