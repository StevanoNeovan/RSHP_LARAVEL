@extends('layouts.perawat')
@section('title', 'Edit Rekam Medis')
@section('content')

<a href="{{ route('perawat.rekam-medis.show', $rekamMedis->idrekam_medis) }}" class="btn btn-primary" style="background:#6b7280;margin-bottom:20px"><i class="fas fa-arrow-left"></i> Kembali</a>

<form method="POST" action="{{ route('perawat.rekam-medis.update', $rekamMedis->idrekam_medis) }}">
@csrf @method('PUT')
<div class="card">
    <div class="section-header"><i class="fas fa-edit"></i><h3>Edit Rekam Medis - {{ $rekamMedis->temuDokter->pet->nama }}</h3></div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-clipboard-list"></i> Anamnesa (Keluhan) *</label>
        <textarea name="anamnesa" rows="4" class="form-control" required>{{ old('anamnesa', $rekamMedis->anamnesa) }}</textarea>
        @error('anamnesa')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-stethoscope"></i> Temuan Klinis *</label>
        <textarea name="temuan_klinis" rows="4" class="form-control" required>{{ old('temuan_klinis', $rekamMedis->temuan_klinis) }}</textarea>
        @error('temuan_klinis')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-notes-medical"></i> Diagnosa *</label>
        <textarea name="diagnosa" rows="4" class="form-control" required>{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
        @error('diagnosa')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div style="display:flex;gap:12px;padding-top:20px;border-top:1px solid #e5e7eb">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Perubahan</button>
        <a href="{{ route('perawat.rekam-medis.show', $rekamMedis->idrekam_medis) }}" class="btn btn-primary" style="background:#6b7280"><i class="fas fa-times"></i> Batal</a>
    </div>
</div>
</form>

@endsection