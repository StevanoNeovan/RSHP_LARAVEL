@extends('layouts.admin')

@section('title', 'Edit Temu Dokter')
@section('page-title', 'Edit Reservasi Temu Dokter')

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

    .number-preview {
        background: linear-gradient(135deg, var(--accent-color), #d97706);
        color: white;
        padding: 24px;
        border-radius: 12px;
        margin-bottom: 32px;
        text-align: center;
    }

    .number-preview h4 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
        opacity: 0.9;
    }

    .number-preview .number {
        font-size: 48px;
        font-weight: 700;
        line-height: 1;
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
    .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-input.error,
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
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-top: 8px;
    }

    .radio-card {
        border: 2px solid var(--border-color);
        border-radius: 8px;
        padding: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .radio-card:hover {
        border-color: var(--primary-color);
        background: rgba(37, 99, 235, 0.05);
    }

    .radio-card input[type="radio"] {
        width: 20px;
        height: 20px;
    }

    .radio-card.selected {
        border-color: var(--primary-color);
        background: rgba(37, 99, 235, 0.1);
    }

    .radio-card-content h4 {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
        margin-bottom: 2px;
    }

    .radio-card-content p {
        font-size: 12px;
        color: var(--text-light);
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
                <i class="fas fa-edit"></i>
                Form Edit Reservasi Temu Dokter
            </h3>
            <p>Update informasi reservasi pemeriksaan hewan</p>
        </div>

        <!-- Nomor Antrian Preview -->
        <div class="number-preview">
            <h4>Nomor Antrian</h4>
            <div class="number">{{ str_pad($temuDokter->no_urut, 3, '0', STR_PAD_LEFT) }}</div>
        </div>

        <form action="{{ route('admin.temu-dokter.update', $temuDokter->idreservasi_dokter) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Pilih Pet -->
            <div class="form-group">
                <label class="form-label">
                    Pilih Pet <span class="required">*</span>
                </label>
                <select name="idpet" id="petSelect" class="form-select @error('idpet') error @enderror" required>
                    <option value="">-- Pilih Pet --</option>
                    @foreach($pets as $pet)
                        <option value="{{ $pet->idpet }}" 
                            data-owner="{{ $pet->pemilik->user->nama }}"
                            data-phone="{{ $pet->pemilik->no_wa }}"
                            {{ old('idpet', $temuDokter->idpet) == $pet->idpet ? 'selected' : '' }}>
                            {{ $pet->nama }} - {{ $pet->ras->nama_ras }} ({{ $pet->pemilik->user->nama }})
                        </option>
                    @endforeach
                </select>
                @error('idpet')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Pilih pet yang akan diperiksa</div>
                @enderror
            </div>

            <!-- Info Pemilik (Auto-fill) -->
            <div id="ownerInfo" style="display: none; background: var(--background-light); padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                <h4 style="font-size: 14px; font-weight: 600; margin-bottom: 12px;">
                    <i class="fas fa-info-circle"></i> Informasi Pemilik
                </h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div>
                        <small style="color: var(--text-light);">Nama Pemilik</small>
                        <p id="ownerName" style="font-weight: 600; margin-top: 4px;">-</p>
                    </div>
                    <div>
                        <small style="color: var(--text-light);">No. WhatsApp</small>
                        <p id="ownerPhone" style="font-weight: 600; margin-top: 4px;">-</p>
                    </div>
                </div>
            </div>

            <!-- Pilih Dokter -->
            <div class="form-group">
                <label class="form-label">
                    Pilih Dokter <span class="required">*</span>
                </label>
                <select name="idrole_user" class="form-select @error('idrole_user') error @enderror" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokter as $dok)
                        <option value="{{ $dok->idrole_user }}" 
                            {{ old('idrole_user', $temuDokter->idrole_user) == $dok->idrole_user ? 'selected' : '' }}>
                            {{ $dok->user->nama }}
                        </option>
                    @endforeach
                </select>
                @error('idrole_user')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Pilih dokter yang akan memeriksa</div>
                @enderror
            </div>

            <!-- Waktu Daftar -->
            <div class="form-group">
                <label class="form-label">
                    Waktu Daftar <span class="required">*</span>
                </label>
                <input 
                    type="datetime-local" 
                    name="waktu_daftar" 
                    class="form-input @error('waktu_daftar') error @enderror" 
                    value="{{ old('waktu_daftar', \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('Y-m-d\TH:i')) }}"
                    required
                >
                @error('waktu_daftar')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Tentukan waktu reservasi</div>
                @enderror
            </div>

            <!-- Status -->
            <div class="form-group">
                <label class="form-label">
                    Status <span class="required">*</span>
                </label>
                <div class="radio-group">
                    <label class="radio-card {{ old('status', $temuDokter->status) == 'W' ? 'selected' : '' }}" 
                        onclick="this.classList.add('selected'); document.querySelectorAll('.radio-card').forEach(c => c !== this && c.classList.remove('selected'))">
                        <input type="radio" name="status" value="W" 
                            {{ old('status', $temuDokter->status) == 'W' ? 'checked' : '' }} required>
                        <div class="radio-card-content">
                            <h4><i class="fas fa-clock" style="color: #f59e0b;"></i> Menunggu</h4>
                            <p>Status awal reservasi</p>
                        </div>
                    </label>
                    <label class="radio-card {{ old('status', $temuDokter->status) == 'P' ? 'selected' : '' }}" 
                        onclick="this.classList.add('selected'); document.querySelectorAll('.radio-card').forEach(c => c !== this && c.classList.remove('selected'))">
                        <input type="radio" name="status" value="P" 
                            {{ old('status', $temuDokter->status) == 'P' ? 'checked' : '' }} required>
                        <div class="radio-card-content">
                            <h4><i class="fas fa-stethoscope" style="color: #3b82f6;"></i> Dalam Pemeriksaan</h4>
                            <p>Sedang diperiksa dokter</p>
                        </div>
                    </label>
                    <label class="radio-card {{ old('status', $temuDokter->status) == 'S' ? 'selected' : '' }}" 
                        onclick="this.classList.add('selected'); document.querySelectorAll('.radio-card').forEach(c => c !== this && c.classList.remove('selected'))">
                        <input type="radio" name="status" value="S" 
                            {{ old('status', $temuDokter->status) == 'S' ? 'checked' : '' }} required>
                        <div class="radio-card-content">
                            <h4><i class="fas fa-check-circle" style="color: #10b981;"></i> Selesai</h4>
                            <p>Pemeriksaan selesai</p>
                        </div>
                    </label>
                    <label class="radio-card {{ old('status', $temuDokter->status) == 'B' ? 'selected' : '' }}" 
                        onclick="this.classList.add('selected'); document.querySelectorAll('.radio-card').forEach(c => c !== this && c.classList.remove('selected'))">
                        <input type="radio" name="status" value="B" 
                            {{ old('status', $temuDokter->status) == 'B' ? 'checked' : '' }} required>
                        <div class="radio-card-content">
                            <h4><i class="fas fa-times-circle" style="color: #ef4444;"></i> Batal</h4>
                            <p>Reservasi dibatalkan</p>
                        </div>
                    </label>
                </div>
                @error('status')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Update Reservasi
                </button>
                <a href="{{ route('admin.temu-dokter.index') }}" class="btn btn-secondary">
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
    // Auto-fill owner info when pet is selected
    const petSelect = document.getElementById('petSelect');
    const ownerInfo = document.getElementById('ownerInfo');
    const ownerName = document.getElementById('ownerName');
    const ownerPhone = document.getElementById('ownerPhone');

    petSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        
        if (selectedOption.value) {
            ownerInfo.style.display = 'block';
            ownerName.textContent = selectedOption.dataset.owner;
            ownerPhone.textContent = selectedOption.dataset.phone;
        } else {
            ownerInfo.style.display = 'none';
        }
    });

    // Trigger on page load
    window.addEventListener('load', function() {
        if (petSelect.value) {
            petSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush