@extends('layouts.admin')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User Baru')

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

    .info-box {
        background: #dbeafe;
        border: 1px solid #93c5fd;
        color: #1e40af;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        display: flex;
        align-items: start;
        gap: 12px;
        font-size: 14px;
    }

    .info-box i {
        font-size: 20px;
        margin-top: 2px;
    }

    .password-strength {
        margin-top: 8px;
        height: 4px;
        background: var(--border-color);
        border-radius: 2px;
        overflow: hidden;
        display: none;
    }

    .password-strength.active {
        display: block;
    }

    .password-strength-bar {
        height: 100%;
        width: 0%;
        transition: all 0.3s ease;
    }

    .password-strength.weak .password-strength-bar {
        width: 33%;
        background: #ef4444;
    }

    .password-strength.medium .password-strength-bar {
        width: 66%;
        background: #f59e0b;
    }

    .password-strength.strong .password-strength-bar {
        width: 100%;
        background: #10b981;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-card-header">
            <h3>
                <i class="fas fa-user-plus"></i>
                Form Tambah User
            </h3>
            <p>Buat akun user baru untuk sistem RSHP UNAIR</p>
        </div>

        <div class="info-box">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Catatan Penting:</strong>
                <ul style="margin-top: 8px; padding-left: 20px;">
                    <li>Setelah user dibuat, atur role di menu <strong>Role User</strong></li>
                    <li>Password minimal 6 karakter</li>
                    <li>Email harus unik dan valid</li>
                </ul>
            </div>
        </div>

        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="form-group">
                <label class="form-label">
                    Nama Lengkap <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    name="nama" 
                    class="form-input @error('nama') error @enderror" 
                    value="{{ old('nama') }}"
                    placeholder="Contoh: Dr. Ahmad Wijaya"
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
                    value="{{ old('email') }}"
                    placeholder="contoh@mail.com"
                    required
                >
                @error('email')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Email akan digunakan untuk login</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label class="form-label">
                    Password <span class="required">*</span>
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password"
                    class="form-input @error('password') error @enderror"
                    placeholder="Minimal 6 karakter"
                    required
                >
                <div class="password-strength" id="passwordStrength">
                    <div class="password-strength-bar"></div>
                </div>
                @error('password')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Password minimal 6 karakter (kombinasi huruf dan angka lebih baik)</div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-group">
                <label class="form-label">
                    Konfirmasi Password <span class="required">*</span>
                </label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    class="form-input @error('password_confirmation') error @enderror"
                    placeholder="Ketik ulang password"
                    required
                >
                @error('password_confirmation')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Ketik ulang password untuk konfirmasi</div>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan User
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-redo"></i>
                    Reset Form
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

@push('scripts')
<script>
    // Password strength indicator
    const passwordInput = document.getElementById('password');
    const strengthIndicator = document.getElementById('passwordStrength');

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        
        if (password.length === 0) {
            strengthIndicator.classList.remove('active', 'weak', 'medium', 'strong');
            return;
        }
        
        strengthIndicator.classList.add('active');
        
        let strength = 0;
        
        // Check length
        if (password.length >= 6) strength++;
        if (password.length >= 10) strength++;
        
        // Check for numbers
        if (/\d/.test(password)) strength++;
        
        // Check for lowercase and uppercase
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        
        // Check for special characters
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        
        strengthIndicator.classList.remove('weak', 'medium', 'strong');
        
        if (strength <= 2) {
            strengthIndicator.classList.add('weak');
        } else if (strength <= 4) {
            strengthIndicator.classList.add('medium');
        } else {
            strengthIndicator.classList.add('strong');
        }
    });
</script>
@endpush