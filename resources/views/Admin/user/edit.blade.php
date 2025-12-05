@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit Data User')

@section('content')
<style>
    .form-container {
        max-width: 800px;
    }

    .form-card {
        background: white;
        border-radius: 12px;
        padding: 32px;
        border: 1px solid var(--border-color);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .form-card-header {
        margin-bottom: 32px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--border-color);
    }

    .form-card-header h3 {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
    }

    .form-card-header p {
        color: var(--text-light);
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-label .required {
        color: var(--danger-color);
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-input.error {
        border-color: var(--danger-color);
    }

    .form-help {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 6px;
    }

    .form-error {
        font-size: 12px;
        color: var(--danger-color);
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 2px solid var(--border-color);
    }

    .btn-secondary {
        background: var(--background-light);
        color: var(--text-dark);
        border: 2px solid var(--border-color);
    }

    .btn-secondary:hover {
        background: var(--border-color);
        transform: translateY(-2px);
    }

    .warning-box {
        background: #fef3c7;
        border: 1px solid #fcd34d;
        color: #92400e;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        display: flex;
        align-items: start;
        gap: 12px;
        font-size: 14px;
    }

    .warning-box i {
        font-size: 20px;
        margin-top: 2px;
    }

    .role-badge {
        background: var(--background-light);
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
    }

    .role-badge h4 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--text-dark);
    }

    .role-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .role-item {
        padding: 6px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        background: #dbeafe;
        color: #1e40af;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-card-header">
            <h3>
                <i class="fas fa-edit"></i>
                Form Edit User
            </h3>
            <p>Update informasi user: <strong>{{ $user->nama }}</strong></p>
        </div>

        <div class="warning-box">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Perhatian:</strong> Mengubah email akan mempengaruhi login user. Kosongkan password jika tidak ingin mengubahnya.
            </div>
        </div>

        @if($user->roleUser->where('status', 1)->count() > 0 || $user->pemilik)
        <div class="role-badge">
            <h4><i class="fas fa-user-tag"></i> Role & Status Saat Ini</h4>
            <div class="role-list">
                @foreach($user->roleUser->where('status', 1) as $roleUser)
                    <span class="role-item">{{ $roleUser->role->nama_role }}</span>
                @endforeach
                @if($user->pemilik)
                    <span class="role-item" style="background: #d1fae5; color: #065f46;">Pemilik (Non-Staf)</span>
                @endif
            </div>
        </div>
        @endif

        <form action="{{ route('admin.user.update', $user->iduser) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="form-group">
                <label class="form-label">
                    Nama Lengkap <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    name="nama" 
                    class="form-input @error('nama') error @enderror" 
                    value="{{ old('nama', $user->nama) }}"
                    required
                >
                @error('nama')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Nama lengkap user (minimal 3 karakter)</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label class="form-label">
                    Email <span class="required">*</span>
                </label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-input @error('email') error @enderror" 
                    value="{{ old('email', $user->email) }}"
                    required
                >
                @error('email')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Email untuk login (harus unik)</div>
                @enderror
            </div>

            <!-- Password (Optional) -->
            <div class="form-group">
                <label class="form-label">
                    Password Baru (Opsional)
                </label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-input @error('password') error @enderror"
                    placeholder="Kosongkan jika tidak ingin mengubah password"
                >
                @error('password')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Isi hanya jika ingin mengganti password (minimal 6 karakter)</div>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Update Data
                </button>
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection