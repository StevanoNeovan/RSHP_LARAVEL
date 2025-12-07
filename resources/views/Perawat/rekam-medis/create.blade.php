@extends('layouts.perawat')
@section('title', 'Buat Rekam Medis')
@section('content')

<a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-primary" style="background:#6b7280;margin-bottom:20px"><i class="fas fa-arrow-left"></i> Kembali</a>

<form method="POST" action="{{ route('perawat.rekam-medis.store') }}">
@csrf
<div class="card">
    <div class="section-header"><i class="fas fa-plus-circle"></i><h3>Form Rekam Medis Baru</h3></div>
    
    @if($temuDokterList->count() > 0)
    <div class="form-group">
        <label class="form-label"><i class="fas fa-calendar-check"></i> Pilih Temu Dokter *</label>
        <select name="idreservasi_dokter" class="form-control" required>
            <option value="">-- Pilih Temu Dokter --</option>
            @foreach($temuDokterList as $td)
            <option value="{{ $td->idreservasi_dokter }}" {{ old('idreservasi_dokter')==$td->idreservasi_dokter?'selected':'' }}>
                [{{ $td->no_urut }}] {{ $td->pet->nama }} - {{ $td->pet->pemilik->user->nama??'-' }} ({{ \Carbon\Carbon::parse($td->waktu_daftar)->format('d M Y') }})
            </option>
            @endforeach
        </select>
        @error('idreservasi_dokter')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-clipboard-list"></i> Anamnesa (Keluhan) *</label>
        <textarea name="anamnesa" rows="4" class="form-control" placeholder="Jelaskan keluhan atau gejala yang dialami pasien..." required>{{ old('anamnesa') }}</textarea>
        @error('anamnesa')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-stethoscope"></i> Temuan Klinis *</label>
        <textarea name="temuan_klinis" rows="4" class="form-control" placeholder="Catat hasil pemeriksaan fisik dan temuan klinis..." required>{{ old('temuan_klinis') }}</textarea>
        @error('temuan_klinis')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-notes-medical"></i> Diagnosa *</label>
        <textarea name="diagnosa" rows="4" class="form-control" placeholder="Tuliskan diagnosa berdasarkan anamnesa dan temuan klinis..." required>{{ old('diagnosa') }}</textarea>
        @error('diagnosa')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div style="padding:16px;background:#fffbeb;border-left:4px solid #f59e0b;border-radius:4px;margin-bottom:20px">
        <div style="font-size:13px;color:#78350f"><i class="fas fa-info-circle"></i> <strong>Catatan:</strong> Detail tindakan/terapi dapat ditambahkan setelah rekam medis dibuat.</div>
    </div>
    
    <div style="display:flex;gap:12px;padding-top:20px;border-top:1px solid #e5e7eb">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Rekam Medis</button>
        <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-primary" style="background:#6b7280"><i class="fas fa-times"></i> Batal</a>
    </div>
    
    @else
    <div style="text-align:center;padding:48px">
        <i class="fas fa-exclamation-triangle" style="font-size:64px;color:#f59e0b;margin-bottom:16px"></i>
        <h3 style="color:#78350f;margin-bottom:8px">Tidak Ada Temu Dokter yang Tersedia</h3>
        <p style="color:#6b7280">Rekam medis hanya dapat dibuat untuk temu dokter yang berstatus "Selesai" dan belum memiliki rekam medis.</p>
    </div>
    @endif
</div>
</form>

@endsection