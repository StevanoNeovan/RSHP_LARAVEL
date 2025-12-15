@extends('layouts.admin')

@section('title', 'Detail User')
@section('page-title', 'Detail User')

@section('content')
<style>
    .detail-container {
        max-width: 1000px;
    }

    .detail-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 32px;
        border-radius: 12px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 24px;
    }

    .detail-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        font-weight: 700;
        border: 4px solid rgba(255, 255, 255, 0.3);
    }

    .detail-info h1 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .detail-info p {
        font-size: 14px;
        opacity: 0.9;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    .detail-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
    }

    .detail-card h3 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--border-color);
    }

    .info-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-size: 13px;
        color: var(--text-light);
        width: 140px;
        flex-shrink: 0;
    }

    .info-value {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
        flex: 1;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
        margin-right: 4px;
        margin-bottom: 4px;
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

    .badge-active {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-inactive {
        background: #f3f4f6;
        color: #6b7280;
    }

    .pet-list {
        list-style: none;
        margin-top: 16px;
    }

    .pet-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: var(--background-light);
        border-radius: 8px;
        margin-bottom: 8px;
    }

    .pet-item i {
        color: var(--primary-color);
        font-size: 20px;
    }

    .pet-item strong {
        color: var(--text-dark);
    }

    .pet-item small {
        color: var(--text-light);
        font-size: 12px;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    .reset-password-form {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        margin-bottom: 24px;
    }

    .reset-password-form h3 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    @media (max-width: 768px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
        
        .detail-header {
            flex-direction: column;
            text-align: center;
        }
        
        
    }
</style>

<div class="detail-container">
    <!-- Header -->
    <div class="detail-header">
        <div class="detail-avatar">
            {{ strtoupper(substr($user->nama, 0, 1)) }}
        </div>
        <div class="detail-info">
            <h1>{{ $user->nama }}</h1>
            <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            <p><i class="fas fa-id-badge"></i> User ID: {{ $user->iduser }}</p>
        </div>
    </div>

    <!-- Info Grid -->
    <div class="detail-grid">
        <div class="detail-card">
            <h3>
                <i class="fas fa-user"></i>
                Informasi Dasar
            </h3>
            <div class="info-row">
                <span class="info-label">Nama Lengkap</span>
                <span class="info-value">{{ $user->nama }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value">{{ $user->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">User ID</span>
                <span class="info-value">{{ $user->iduser }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status Akun</span>
                <span class="info-value">
                    @if($user->roleUser->where('status', 1)->count() > 0 || $user->pemilik)
                        <span class="badge badge-active">Aktif</span>
                    @else
                        <span class="badge badge-inactive">Tidak Aktif</span>
                    @endif
                </span>
            </div>
        </div>

        <div class="detail-card">
            <h3>
                <i class="fas fa-user-tag"></i>
                Role & Akses
            </h3>
            <div class="info-row">
                <span class="info-label">Role Aktif</span>
                <span class="info-value">
                    @if($user->roleUser->where('status', 1)->count() > 0)
                        @foreach($user->roleUser->where('status', 1) as $roleUser)
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
                                {{ $roleUser->role->nama_role }}
                            </span>
                        @endforeach
                    @else
                        <span style="color: var(--text-light);">Belum ada role</span>
                    @endif
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Total Role</span>
                <span class="info-value">{{ $user->roleUser->count() }} Role ({{ $user->roleUser->where('status', 1)->count() }} aktif)</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status Pemilik</span>
                <span class="info-value">
                    @if($user->pemilik)
                        <span class="badge badge-pemilik">Terdaftar sebagai Pemilik</span>
                    @else
                        <span style="color: var(--text-light);">Bukan pemilik</span>
                    @endif
                </span>
            </div>
        </div>
    </div>

    <!-- Pemilik Info (if applicable) -->
    @if($user->pemilik)
    <div class="detail-card" style="margin-bottom: 24px;">
        <h3>
            <i class="fas fa-home"></i>
            Informasi Pemilik
        </h3>
        <div class="info-row">
            <span class="info-label">Nomor WhatsApp</span>
            <span class="info-value">
                <a href="https://wa.me/{{ $user->pemilik->no_wa }}" target="_blank" style="color: var(--primary-color); text-decoration: none;">
                    <i class="fab fa-whatsapp"></i> {{ $user->pemilik->no_wa }}
                </a>
            </span>
        </div>
        <div class="info-row">
            <span class="info-label">Alamat</span>
            <span class="info-value">{{ $user->pemilik->alamat }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Jumlah Pet</span>
            <span class="info-value">
                <span class="badge badge-pemilik">{{ $user->pemilik->pets->count() }} Pet</span>
            </span>
        </div>

        @if($user->pemilik->pets->count() > 0)
        <h4 style="margin-top: 20px; font-size: 14px; font-weight: 600; color: var(--text-dark);">
            <i class="fas fa-paw"></i> Daftar Pet
        </h4>
        <ul class="pet-list">
            @foreach($user->pemilik->pets as $pet)
            <li class="pet-item">
                <i class="fas fa-cat"></i>
                <div>
                    <strong>{{ $pet->nama }}</strong><br>
                    <small>{{ $pet->ras->nama_ras }} - {{ $pet->jenis_kelamin == 'M' ? 'Jantan' : 'Betina' }}</small>
                </div>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
    @endif

    <!-- Reset Password Form (Admin Only) -->
    @if(auth()->user()->roleUser->where('idrole', 1)->where('status', 1)->count() > 0)
    <div class="reset-password-form">
        <h3>
            <i class="fas fa-key"></i>
            Reset Password User
        </h3>
        <p style="color: var(--text-light); margin-bottom: 20px; font-size: 14px;">
            Fitur ini untuk mereset password user jika mereka lupa. Password baru minimal 6 karakter.
        </p>
        
        <form action="{{ route('admin.user.reset-password', $user->iduser) }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px;">Password Baru</label>
                    <input 
                        type="password" 
                        name="new_password" 
                        class="form-input" 
                        placeholder="Minimal 6 karakter"
                        required
                    >
                </div>
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px;">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        name="new_password_confirmation" 
                        class="form-input" 
                        placeholder="Ketik ulang password"
                        required
                    >
                </div>
            </div>
            <button type="submit" class="btn btn-warning" onclick="return confirm('Yakin ingin mereset password user {{ $user->nama }}?')">
                <i class="fas fa-key"></i>
                Reset Password
            </button>
        </form>
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('admin.user.edit', $user->iduser) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i>
            Edit User
        </a>
        <a href="{{ route('admin.role-user.index') }}" class="btn btn-primary">
            <i class="fas fa-user-shield"></i>
            Kelola Role User
        </a>
        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Kembali ke List
        </a>
        @if($user->iduser != auth()->user()->iduser)
        <form action="{{ route('admin.user.destroy', $user->iduser) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus user {{ $user->nama }}? Pastikan tidak ada role atau data terkait.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i>
                Hapus User
            </button>
        </form>
        @endif
    </div>
</div>
@endsection