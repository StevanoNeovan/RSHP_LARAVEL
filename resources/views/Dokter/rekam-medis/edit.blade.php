@extends('layouts.dokter')
@section('title', 'Edit Rekam Medis')
@section('page-title', 'Edit Rekam Medis')
@section('content')

<a href="{{ route('dokter.rekam-medis.show', $rekamMedis->idrekam_medis) }}" class="btn btn-primary" style="background:#6b7280; margin-bottom:20px">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<form method="POST" action="{{ route('dokter.rekam-medis.update', $rekamMedis->idrekam_medis) }}">
    @csrf
    @method('PUT')
    
    <div class="card">
        <div class="section-header">
            <i class="fas fa-edit"></i>
            <h3>Edit Rekam Medis - {{ $rekamMedis->temuDokter->pet->nama }}</h3>
        </div>
        
        <div style="margin-bottom:20px">
            <label style="font-weight:600; margin-bottom:8px; display:block; font-size:14px">
                <i class="fas fa-clipboard-list"></i> Anamnesa (Keluhan) *
            </label>
            <textarea name="anamnesa" rows="4" required 
                      style="width:100%; padding:12px; border:1px solid #e5e7eb; border-radius:8px; font-family: inherit; font-size: 14px;"
                      placeholder="Jelaskan keluhan atau gejala yang dialami pasien...">{{ old('anamnesa', $rekamMedis->anamnesa) }}</textarea>
            @error('anamnesa')
                <div style="color:#ef4444; font-size:13px; margin-top:4px">{{ $message }}</div>
            @enderror
        </div>
        
        <div style="margin-bottom:20px">
            <label style="font-weight:600; margin-bottom:8px; display:block; font-size:14px">
                <i class="fas fa-stethoscope"></i> Temuan Klinis *
            </label>
            <textarea name="temuan_klinis" rows="4" required 
                      style="width:100%; padding:12px; border:1px solid #e5e7eb; border-radius:8px; font-family: inherit; font-size: 14px;"
                      placeholder="Catat hasil pemeriksaan fisik dan temuan klinis...">{{ old('temuan_klinis', $rekamMedis->temuan_klinis) }}</textarea>
            @error('temuan_klinis')
                <div style="color:#ef4444; font-size:13px; margin-top:4px">{{ $message }}</div>
            @enderror
        </div>
        
        <div style="margin-bottom:20px">
            <label style="font-weight:600; margin-bottom:8px; display:block; font-size:14px">
                <i class="fas fa-notes-medical"></i> Diagnosa *
            </label>
            <textarea name="diagnosa" rows="4" required 
                      style="width:100%; padding:12px; border:1px solid #e5e7eb; border-radius:8px; font-family: inherit; font-size: 14px;"
                      placeholder="Tuliskan diagnosa berdasarkan anamnesa dan temuan klinis...">{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
            @error('diagnosa')
                <div style="color:#ef4444; font-size:13px; margin-top:4px">{{ $message }}</div>
            @enderror
        </div>
        
        <div style="padding:16px; background:#fffbeb; border-left:4px solid #f59e0b; border-radius:4px; margin-bottom:20px">
            <div style="display:flex; align-items:start; gap:12px">
                <i class="fas fa-info-circle" style="color:#f59e0b; font-size:20px; margin-top:2px"></i>
                <div style="font-size:13px; color:#78350f">
                    <strong>Catatan:</strong> Detail tindakan/terapi dapat dikelola di halaman detail rekam medis setelah menyimpan perubahan ini.
                </div>
            </div>
        </div>
        
        <div style="display:flex; gap:12px">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('dokter.rekam-medis.show', $rekamMedis->idrekam_medis) }}" class="btn btn-primary" style="background:#6b7280">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </div>
</form>

@endsection