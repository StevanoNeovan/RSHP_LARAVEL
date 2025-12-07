@extends('layouts.resepsionis')

@section('title', 'Tambah Pemilik Baru')
@section('page-title', 'Tambah Pemilik Baru')

@section('content')

<div style="margin-bottom: 20px;">
    <a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-primary" style="background: #6b7280;">
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>
</div>

<form method="POST" action="{{ route('resepsionis.pemilik.store') }}">
    @csrf
    
    <div class="card">
        <div class="section-header">
            <i class="fas fa-user-plus"></i>
            <h3>Form Pendaftaran Pemilik Baru</h3>
        </div>
        
        <!-- Info Alert -->
        <div style="padding: 16px; background: #dbeafe; border-left: 4px solid #3b82f6; border-radius: 4px; margin-bottom: 24px;">
            <div style="display: flex; align-items: start; gap: 12px;">
                <i class="fas fa-info-circle" style="color: #3b82f6; font-size: 20px; margin-top: 2px;"></i>
                <div style="font-size: 14px; color: #1e40af; line-height: 1.6;">
                    <strong>Informasi:</strong> Data ini akan digunakan untuk login pemilik ke portal pasien. Pastikan email dan password dicatat dengan baik dan diberikan kepada pemilik.
                </div>
            </div>
        </div>
        
        <!-- Nama -->
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-user"></i> Nama Lengkap *
            </label>
            <input type="text" 
                   name="nama" 
                   class="form-control" 
                   value="{{ old('nama') }}" 
                   placeholder="Masukkan nama lengkap pemilik"
                   required>
            @error('nama')
                <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Email -->
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-envelope"></i> Email *
            </label>
            <input type="email" 
                   name="email" 
                   class="form-control" 
                   value="{{ old('email') }}" 
                   placeholder="contoh@email.com"
                   required>
            <small style="color: #6b7280; font-size: 12px; margin-top: 4px; display: block;">
                Email ini akan digunakan untuk login ke portal pasien
            </small>
            @error('email')
                <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Password -->
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-lock"></i> Password *
            </label>
            <input type="password" 
                   name="password" 
                   class="form-control" 
                   placeholder="Minimal 6 karakter"
                   required>
            <small style="color: #6b7280; font-size: 12px; margin-top: 4px; display: block;">
                Password minimal 6 karakter
            </small>
            @error('password')
                <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Konfirmasi Password -->
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-lock"></i> Konfirmasi Password *
            </label>
            <input type="password" 
                   name="password_confirmation" 
                   class="form-control" 
                   placeholder="Ketik ulang password"
                   required>
            @error('password_confirmation')
                <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- No WhatsApp -->
        <div class="form-group">
            <label class="form-label">
                <i class="fab fa-whatsapp"></i> Nomor WhatsApp *
            </label>
            <input type="text" 
                   name="no_wa" 
                   class="form-control" 
                   value="{{ old('no_wa') }}" 
                   placeholder="08xxxxxxxxxx atau 628xxxxxxxxxx"
                   required>
            <small style="color: #6b7280; font-size: 12px; margin-top: 4px; display: block;">
                Format: 08xxxxxxxxxx (akan otomatis diubah ke format 62)
            </small>
            @error('no_wa')
                <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Alamat -->
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-map-marker-alt"></i> Alamat *
            </label>
            <textarea name="alamat" 
                      rows="4" 
                      class="form-control" 
                      placeholder="Masukkan alamat lengkap"
                      required>{{ old('alamat') }}</textarea>
            @error('alamat')
                <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Action Buttons -->
        <div style="display: flex; gap: 12px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i>
                Simpan Data Pemilik
            </button>
            <a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-primary" style="background: #6b7280;">
                <i class="fas fa-times"></i>
                Batal
            </a>
        </div>
    </div>
</form>

<!-- Tips Card -->
<div class="card" style="background: #fffbeb; border-left: 4px solid #f59e0b;">
    <div style="display: flex; align-items: start; gap: 16px;">
        <i class="fas fa-lightbulb" style="font-size: 32px; color: #f59e0b;"></i>
        <div>
            <h4 style="margin-bottom: 12px; color: #78350f;">Tips Pendaftaran</h4>
            <ul style="margin: 0; padding-left: 20px; color: #78350f; line-height: 1.8;">
                <li>Pastikan email yang dimasukkan valid dan aktif</li>
                <li>Gunakan password yang mudah diingat pemilik namun cukup aman</li>
                <li>Catat password dan berikan kepada pemilik untuk login</li>
                <li>Nomor WhatsApp akan digunakan untuk komunikasi penting</li>
                <li>Verifikasi alamat untuk memudahkan pengiriman dokumen jika diperlukan</li>
            </ul>
        </div>
    </div>
</div>

@endsection