@extends('layouts.admin')

@section('title', 'Tambah Kode Tindakan Terapi')
@section('page-title', 'Tambah Kode Tindakan Terapi')

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
        flex-wrap: wrap;
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

        <!-- Header -->
        <div class="form-card-header">
            <h3>
                <i class="fas fa-notes-medical"></i>
                Form Tambah Kode Tindakan Terapi
            </h3>
            <p>Tambahkan kode tindakan terapi yang akan digunakan dalam sistem</p>
        </div>

        <!-- Info -->
        <div class="info-box">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Kode Tindakan Terapi</strong> digunakan untuk mengidentifikasi jenis tindakan atau terapi
                yang dilakukan pada pasien secara terstandarisasi.
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.kode-tindakan-terapi.store') }}" method="POST">
            @csrf

            <!-- Kode -->
            <div class="form-group">
                <label class="form-label">
                    Kode <span class="required">*</span>
                </label>
                <input
                    type="text"
                    name="kode"
                    maxlength="5"
                    value="{{ old('kode') }}"
                    class="form-input @error('kode') error @enderror"
                    placeholder="Contoh: TR001"
                    required
                    autofocus
                >
                @error('kode')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Kode unik maksimal 5 karakter</div>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="form-group">
                <label class="form-label">
                    Deskripsi Tindakan Terapi <span class="required">*</span>
                </label>
                <textarea
                    name="deskripsi_tindakan_terapi"
                    rows="4"
                    class="form-input @error('deskripsi_tindakan_terapi') error @enderror"
                    placeholder="Masukkan deskripsi tindakan atau terapi"
                    required
                >{{ old('deskripsi_tindakan_terapi') }}</textarea>
                @error('deskripsi_tindakan_terapi')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="form-group">
                <label class="form-label">
                    Kategori <span class="required">*</span>
                </label>
                <select
                    name="idkategori"
                    class="form-input @error('idkategori') error @enderror"
                    required
                >
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->idkategori }}"
                            {{ old('idkategori') == $kat->idkategori ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Kategori Klinis -->
            <div class="form-group">
                <label class="form-label">
                    Kategori Klinis <span class="required">*</span>
                </label>
                <select
                    name="idkategori_klinis"
                    class="form-input @error('idkategori_klinis') error @enderror"
                    required
                >
                    <option value="">-- Pilih Kategori Klinis --</option>
                    @foreach($kategoriKlinis as $klinis)
                        <option value="{{ $klinis->idkategori_klinis }}"
                            {{ old('idkategori_klinis') == $klinis->idkategori_klinis ? 'selected' : '' }}>
                            {{ $klinis->nama_kategori_klinis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Kode
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-redo"></i>
                    Reset
                </button>
                <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
