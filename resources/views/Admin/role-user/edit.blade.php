@extends('layouts.admin')

@section('title', 'Edit Role User')
@section('page-title', 'Edit Role User')

@section('content')
<style>
    .form-container {
        max-width: 760px;
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
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 6px;
    }

    .form-card-header p {
        font-size: 14px;
        color: var(--text-light);
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }

    .form-label .required {
        color: var(--danger-color);
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 12px 16px;
        border-radius: 8px;
        border: 2px solid var(--border-color);
        font-size: 14px;
        transition: all .2s ease;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-error {
        font-size: 12px;
        color: var(--danger-color);
        margin-top: 6px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
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
        transform: translateY(-1px);
    }
</style>

<div class="form-container">
    <div class="form-card">

        <div class="form-card-header">
            <h3>
                <i class="fas fa-user-shield"></i>
                Edit Role User
            </h3>
            <p>Perbarui role dan status user dalam sistem</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Terdapat kesalahan:</strong>
                <ul style="margin:8px 0 0 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.role-user.update', $roleUser->idrole_user) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- USER --}}
            <div class="form-group">
                <label class="form-label">
                    User <span class="required">*</span>
                </label>
                <select name="iduser" class="form-select" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->iduser }}"
                            {{ old('iduser', $roleUser->iduser) == $user->iduser ? 'selected' : '' }}>
                            {{ $user->nama }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- ROLE --}}
            <div class="form-group">
                <label class="form-label">
                    Role <span class="required">*</span>
                </label>
                <select name="idrole" class="form-select" required>
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->idrole }}"
                            {{ old('idrole', $roleUser->idrole) == $role->idrole ? 'selected' : '' }}>
                            {{ $role->nama_role }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- STATUS --}}
            <div class="form-group">
                <label class="form-label">
                    Status <span class="required">*</span>
                </label>
                <select name="status" class="form-select" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="1" {{ old('status', $roleUser->status) == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status', $roleUser->status) == '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            {{-- ACTIONS --}}
            <div class="form-actions">
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </button>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>

                <a href="{{ route('admin.role-user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
