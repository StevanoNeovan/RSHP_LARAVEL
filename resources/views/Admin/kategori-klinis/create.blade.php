@extends('layouts.admin')

@section('title', 'Tambah Kategori Klinis')
@section('page-title', 'Tambah Kategori Klinis')

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
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-card-header">
            <h3>
                <i class="fas fa-stethoscope"></i>
                Form Tambah Kategori Klinis
            </h3>
            <p>Tambahkan kategori klinis baru untuk klasifikasi tindakan</p>
        </div>

        <div class="info-box">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Kategori Klinis</strong> digunakan untuk mengklasifikasikan apakah suatu tindakan termasuk <strong>Terapi</strong> atau <strong>Tindakan</strong> medis.
            </div>
        </div>

        <form action="{{ route('admin.kategori-klinis.store') }}" method="POST">
            @csrf

            <!-- Nama Kategori Klinis -->
            <div class="form-group">
                <label class="form-label">
                    Nama Kategori Klinis <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    name="nama_kategori_klinis" 
                    class="form-input @error('nama_kategori_klinis') error @enderror" 
                    value="{{ old('nama_kategori_klinis') }}"
                    placeholder="Contoh: Terapi, Tindakan"
                    required
                    autofocus
                >
                @error('nama_kategori_klinis')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Masukkan nama kategori klinis (minimal 3 karakter, maksimal 50 karakter)</div>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Kategori Klinis
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-redo"></i>
                    Reset
                </button>
                <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection