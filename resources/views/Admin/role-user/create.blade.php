@extends('layouts.admin')

@section('title', 'Tambah Role User')
@section('page-title', 'Assign Role ke User')

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

    .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-select.error {
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

    .radio-group {
        display: flex;
        gap: 24px;
        margin-top: 8px;
    }

    .radio-item {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .radio-item input[type="radio"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .radio-item label {
        font-weight: 500;
        cursor: pointer;
        font-size: 14px;
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
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-card-header">
            <h3>
                <i class="fas fa-user-shield"></i>
                Form Assign Role ke User
            </h3>
            <p>Berikan hak akses role kepada user</p>
        </div>

        <div class="warning-box">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Perhatian:</strong> Satu user dapat memiliki beberapa role, tetapi tidak boleh memiliki role yang sama lebih dari sekali.
            </div>
        </div>

        <form action="{{ route('admin.role-user.store') }}" method="POST">
            @csrf

            <!-- Pilih User -->
            <div class="form-group">
                <label class="form-label">
                    Pilih User <span class="required">*</span>
                </label>
                <select name="iduser" class="form-select @error('iduser') error @enderror" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->iduser }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                            {{ $user->nama }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('iduser')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Pilih user yang akan diberikan role</div>
                @enderror
            </div>

            <!-- Pilih Role -->
            <div class="form-group">
                <label class="form-label">
                    Pilih Role <span class="required">*</span>
                </label>
                <select name="idrole" class="form-select @error('idrole') error @enderror" required>
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->idrole }}" {{ old('idrole') == $role->idrole ? 'selected' : '' }}>
                            {{ $role->nama_role }}
                        </option>
                    @endforeach
                </select>
                @error('idrole')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Pilih role yang akan diberikan</div>
                @enderror
            </div>

            <!-- Status -->
            <div class="form-group">
                <label class="form-label">
                    Status <span class="required">*</span>
                </label>
                <div class="radio-group">
                    <div class="radio-item">
                        <input 
                            type="radio" 
                            id="aktif" 
                            name="status" 
                            value="1" 
                            {{ old('status', '1') == '1' ? 'checked' : '' }}
                            required
                        >
                        <label for="aktif">
                            <i class="fas fa-check-circle" style="color: #10b981;"></i> Aktif
                        </label>
                    </div>
                    <div class="radio-item">
                        <input 
                            type="radio" 
                            id="nonaktif" 
                            name="status" 
                            value="0" 
                            {{ old('status') == '0' ? 'checked' : '' }}
                            required
                        >
                        <label for="nonaktif">
                            <i class="fas fa-times-circle" style="color: #ef4444;"></i> Nonaktif
                        </label>
                    </div>
                </div>
                @error('status')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Status aktif akan memberikan akses ke sistem</div>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Assign Role
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-redo"></i>
                    Reset
                </button>
                <a href="{{ route('admin.role-user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection