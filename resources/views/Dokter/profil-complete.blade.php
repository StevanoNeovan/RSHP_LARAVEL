@extends('layouts.dokter')

@section('title', 'Lengkapi Profil Dokter')
@section('page-title', 'Lengkapi Profil')

@section('content')

<!-- Welcome Banner -->
<div style="background: linear-gradient(135deg, #3b82f6, #2563eb); padding: 32px; border-radius: 16px; color: white; margin-bottom: 32px; box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);">
    <h2 style="font-size: 28px; margin-bottom: 12px;">
        <i class="fas fa-user-circle"></i> Selamat Datang, Dr. {{ $user->nama }}!
    </h2>
    <p style="font-size: 16px; opacity: 0.95; line-height: 1.6;">
        Untuk melanjutkan, silakan lengkapi data profil Anda terlebih dahulu. Data ini akan digunakan untuk identifikasi dan komunikasi dengan pemilik hewan.
    </p>
</div>

<!-- Form Card -->
<div class="card">
    <div class="section-header">
        <i class="fas fa-id-card"></i>
        <h3>Data Profil Dokter</h3>
    </div>
    
    <form method="POST" action="{{ route('dokter.profil.store-complete') }}">
        @csrf
        
        <!-- User Info (Read-only) -->
        <div style="padding: 20px; background: #f0f9ff; border-left: 4px solid #3b82f6; border-radius: 8px; margin-bottom: 24px;">
            <h4 style="margin-bottom: 12px; color: #1e40af;"><i class="fas fa-info-circle"></i> Informasi Akun</h4>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
                <div>
                    <strong style="color: #6b7280;">Nama:</strong>
                    <span style="color: #1f2937;">{{ $user->nama }}</span>
                </div>
                <div>
                    <strong style="color: #6b7280;">Email:</strong>
                    <span style="color: #1f2937;">{{ $user->email }}</span>
                </div>
            </div>
        </div>
        
        <!-- Alamat -->
        <div style="margin-bottom: 20px;">
            <label style="font-weight: 600; margin-bottom: 8px; display: block; font-size: 14px;">
                <i class="fas fa-map-marker-alt"></i> Alamat Lengkap *
            </label>
            <textarea name="alamat" rows="3" required 
                      style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-family: inherit; font-size: 14px;"
                      placeholder="Contoh: Jl. Raya Mulyosari No. 123, Surabaya">{{ old('alamat') }}</textarea>
            @error('alamat')
                <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- No HP -->
        <div style="margin-bottom: 20px;">
            <label style="font-weight: 600; margin-bottom: 8px; display: block; font-size: 14px;">
                <i class="fas fa-phone"></i> Nomor HP *
            </label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" required 
                   style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;"
                   placeholder="Contoh: 081234567890">
            <small style="color: #6b7280; font-size: 12px; display: block; margin-top: 4px;">
                <i class="fas fa-info-circle"></i> Format: Angka saja tanpa spasi atau simbol
            </small>
            @error('no_hp')
                <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Bidang Dokter -->
        <div style="margin-bottom: 20px;">
            <label style="font-weight: 600; margin-bottom: 8px; display: block; font-size: 14px;">
                <i class="fas fa-stethoscope"></i> Bidang Spesialisasi *
            </label>
            <input type="text" name="bidang_dokter" value="{{ old('bidang_dokter') }}" required 
                   style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;"
                   placeholder="Contoh: Bedah, Penyakit Dalam, Umum, dll.">
            @error('bidang_dokter')
                <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Jenis Kelamin -->
        <div style="margin-bottom: 20px;">
            <label style="font-weight: 600; margin-bottom: 8px; display: block; font-size: 14px;">
                <i class="fas fa-venus-mars"></i> Jenis Kelamin *
            </label>
            <div style="display: flex; gap: 24px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} required>
                    <span>Laki-laki</span>
                </label>
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} required>
                    <span>Perempuan</span>
                </label>
            </div>
            @error('jenis_kelamin')
                <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Notice -->
        <div style="padding: 16px; background: #fffbeb; border-left: 4px solid #f59e0b; border-radius: 4px; margin-bottom: 24px;">
            <div style="display: flex; align-items: start; gap: 12px;">
                <i class="fas fa-exclamation-triangle" style="color: #f59e0b; font-size: 20px; margin-top: 2px;"></i>
                <div style="font-size: 13px; color: #78350f;">
                    <strong>Penting:</strong> Pastikan semua data yang Anda masukkan sudah benar. Data ini akan ditampilkan kepada pemilik hewan dan digunakan untuk administrasi klinik.
                </div>
            </div>
        </div>
        
        <!-- Submit Button -->
        <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn btn-success" style="padding: 12px 32px;">
                <i class="fas fa-check-circle"></i>
                Simpan & Lanjutkan
            </button>
        </div>
    </form>
</div>

<!-- Help Card -->
<div style="padding: 20px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); border-radius: 12px; border-left: 4px solid #3b82f6;">
    <h4 style="margin-bottom: 8px; color: #1e40af;">
        <i class="fas fa-question-circle"></i> Butuh Bantuan?
    </h4>
    <p style="margin: 0; color: #1e40af; font-size: 14px;">
        Jika Anda mengalami kesulitan dalam mengisi form ini, silakan hubungi administrator melalui email atau WhatsApp yang tertera di sistem.
    </p>
</div>

@endsection