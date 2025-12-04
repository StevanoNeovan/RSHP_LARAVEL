@extends('layouts.admin')

@section('title', 'Tambah Rekam Medis')
@section('page-title', 'Buat Rekam Medis Baru')

@section('content')
<style>
    .form-container {
        max-width: 900px;
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

    .alert-info {
        background: #dbeafe;
        border: 1px solid #93c5fd;
        color: #1e40af;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        display: flex;
        align-items: start;
        gap: 12px;
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

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-input.error,
    .form-select.error,
    .form-textarea.error {
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

    .pet-preview {
        background: var(--background-light);
        padding: 20px;
        border-radius: 8px;
        margin-top: 12px;
        display: none;
    }

    .pet-preview.active {
        display: block;
    }

    .pet-preview h4 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 16px;
        color: var(--text-dark);
    }

    .pet-preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .pet-preview-item {
        display: flex;
        align-items: start;
        gap: 10px;
    }

    .pet-preview-item i {
        color: var(--primary-color);
        margin-top: 2px;
    }

    .pet-preview-item div small {
        display: block;
        color: var(--text-light);
        font-size: 11px;
        margin-bottom: 2px;
    }

    .pet-preview-item div strong {
        font-size: 13px;
        color: var(--text-dark);
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
                <i class="fas fa-file-medical-alt"></i>
                Form Rekam Medis Baru
            </h3>
            <p>Buat rekam medis untuk temu dokter yang sudah selesai</p>
        </div>

        @if($temuDokter->isEmpty())
            <div class="alert-info">
                <i class="fas fa-info-circle" style="font-size: 20px;"></i>
                <div>
                    <strong>Tidak ada temu dokter yang bisa dibuatkan rekam medis</strong>
                    <p style="margin-top: 4px; font-size: 13px;">Pastikan ada temu dokter dengan status "Selesai" yang belum memiliki rekam medis.</p>
                </div>
            </div>
            <a href="{{ route('admin.temu-dokter.index') }}" class="btn btn-primary">
                <i class="fas fa-calendar-check"></i>
                Lihat Temu Dokter
            </a>
        @else
            <form action="{{ route('admin.rekam-medis.store') }}" method="POST">
                @csrf

                <!-- Pilih Temu Dokter -->
                <div class="form-group">
                    <label class="form-label">
                        Pilih Temu Dokter <span class="required">*</span>
                    </label>
                    <select 
                        name="idreservasi_dokter" 
                        id="temuDokterSelect" 
                        class="form-select @error('idreservasi_dokter') error @enderror" 
                        required
                    >
                        <option value="">-- Pilih Temu Dokter yang Sudah Selesai --</option>
                        @foreach($temuDokter as $td)
                            <option 
                                value="{{ $td->idreservasi_dokter }}"
                                data-pet="{{ $td->pet->nama }}"
                                data-ras="{{ $td->pet->ras->nama_ras }}"
                                data-owner="{{ $td->pet->pemilik->user->nama }}"
                                data-phone="{{ $td->pet->pemilik->no_wa }}"
                                data-dokter="{{ $td->roleUser->user->nama }}"
                                data-dokter-id="{{ $td->roleUser->idrole_user }}"
                                data-tanggal="{{ \Carbon\Carbon::parse($td->waktu_daftar)->format('d M Y, H:i') }}"
                                {{ old('idreservasi_dokter') == $td->idreservasi_dokter ? 'selected' : '' }}
                            >
                                No. {{ $td->no_urut }} - {{ $td->pet->nama }} ({{ $td->pet->pemilik->user->nama }}) - {{ \Carbon\Carbon::parse($td->waktu_daftar)->format('d M Y') }}
                            </option>
                        @endforeach
                    </select>
                    @error('idreservasi_dokter')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @else
                        <div class="form-help">Pilih temu dokter yang sudah selesai untuk dibuatkan rekam medis</div>
                    @enderror

                    <!-- Pet Preview -->
                    <div class="pet-preview" id="petPreview">
                        <h4><i class="fas fa-info-circle"></i> Informasi Temu Dokter</h4>
                        <div class="pet-preview-grid">
                            <div class="pet-preview-item">
                                <i class="fas fa-paw"></i>
                                <div>
                                    <small>Nama Pet</small>
                                    <strong id="previewPet">-</strong>
                                </div>
                            </div>
                            <div class="pet-preview-item">
                                <i class="fas fa-dog"></i>
                                <div>
                                    <small>Ras</small>
                                    <strong id="previewRas">-</strong>
                                </div>
                            </div>
                            <div class="pet-preview-item">
                                <i class="fas fa-user"></i>
                                <div>
                                    <small>Pemilik</small>
                                    <strong id="previewOwner">-</strong>
                                </div>
                            </div>
                            <div class="pet-preview-item">
                                <i class="fas fa-user-md"></i>
                                <div>
                                    <small>Dokter</small>
                                    <strong id="previewDokter">-</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dokter Pemeriksa -->
                <div class="form-group">
                    <label class="form-label">
                        Dokter Pemeriksa <span class="required">*</span>
                    </label>
                    <select name="dokter_pemeriksa" id="dokterSelect" class="form-select @error('dokter_pemeriksa') error @enderror" required>
                        <option value="">-- Pilih Dokter Pemeriksa --</option>
                        @foreach($dokter as $dok)
                            <option value="{{ $dok->idrole_user }}" {{ old('dokter_pemeriksa') == $dok->idrole_user ? 'selected' : '' }}>
                                {{ $dok->user->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('dokter_pemeriksa')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @else
                        <div class="form-help">Akan otomatis terisi sesuai dokter dari temu dokter yang dipilih</div>
                    @enderror
                </div>

                <!-- Anamnesa -->
                <div class="form-group">
                    <label class="form-label">
                        Anamnesa (Keluhan & Riwayat) <span class="required">*</span>
                    </label>
                    <textarea 
                        name="anamnesa" 
                        class="form-textarea @error('anamnesa') error @enderror" 
                        placeholder="Contoh: Pet tidak mau makan sejak 2 hari yang lalu, muntah 3x, lemas, dehidrasi..."
                        required
                    >{{ old('anamnesa') }}</textarea>
                    @error('anamnesa')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @else
                        <div class="form-help">Tulis keluhan utama dan riwayat penyakit pet (minimal 10 karakter)</div>
                    @enderror
                </div>

                <!-- Temuan Klinis -->
                <div class="form-group">
                    <label class="form-label">
                        Temuan Klinis <span class="required">*</span>
                    </label>
                    <textarea 
                        name="temuan_klinis" 
                        class="form-textarea @error('temuan_klinis') error @enderror" 
                        placeholder="Contoh: Suhu tubuh 39.5°C, mukosa pucat, detak jantung 120x/menit, palpasi abdomen nyeri..."
                        required
                    >{{ old('temuan_klinis') }}</textarea>
                    @error('temuan_klinis')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @else
                        <div class="form-help">Tulis hasil pemeriksaan fisik dan klinis (minimal 10 karakter)</div>
                    @enderror
                </div>

                <!-- Diagnosa -->
                <div class="form-group">
                    <label class="form-label">
                        Diagnosa <span class="required">*</span>
                    </label>
                    <textarea 
                        name="diagnosa" 
                        class="form-textarea @error('diagnosa') error @enderror" 
                        placeholder="Contoh: Gastroenteritis akut, Dehidrasi sedang..."
                        required
                    >{{ old('diagnosa') }}</textarea>
                    @error('diagnosa')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @else
                        <div class="form-help">Tulis diagnosa penyakit berdasarkan anamnesa dan temuan klinis (minimal 5 karakter)</div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan & Lanjut ke Detail Tindakan
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-redo"></i>
                        Reset Form
                    </button>
                    <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    const temuDokterSelect = document.getElementById('temuDokterSelect');
    const dokterSelect = document.getElementById('dokterSelect');
    const petPreview = document.getElementById('petPreview');

    temuDokterSelect.addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        
        if (option.value) {
            // Show preview
            petPreview.classList.add('active');
            
            // Fill preview
            document.getElementById('previewPet').textContent = option.dataset.pet;
            document.getElementById('previewRas').textContent = option.dataset.ras;
            document.getElementById('previewOwner').textContent = option.dataset.owner;
            document.getElementById('previewDokter').textContent = option.dataset.dokter;
            
            // Auto-select dokter
            dokterSelect.value = option.dataset.dokterId;
        } else {
            petPreview.classList.remove('active');
            dokterSelect.value = '';
        }
    });

    // Trigger on load if old value exists
    if (temuDokterSelect.value) {
        temuDokterSelect.dispatchEvent(new Event('change'));
    }
</script>
@endpush