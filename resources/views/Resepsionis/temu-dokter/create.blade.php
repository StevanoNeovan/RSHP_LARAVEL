@extends('layouts.resepsionis')
@section('title', 'Buat Jadwal Temu Dokter')
@section('content')
<a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-primary" style="background:#6b7280;margin-bottom:20px"><i class="fas fa-arrow-left"></i> Kembali</a>

<form method="POST" action="{{ route('resepsionis.temu-dokter.store') }}">
@csrf
<div class="card">
    <div class="section-header"><i class="fas fa-calendar-plus"></i><h3>Form Jadwal Temu Dokter</h3></div>
    
    <div style="padding:16px;background:#dbeafe;border-left:4px solid #3b82f6;border-radius:4px;margin-bottom:24px">
        <div style="font-size:14px;color:#1e40af"><strong>Info:</strong> No. urut berikutnya untuk hari yang dipilih: <strong style="font-size:20px">{{ $nextNumber }}</strong></div>
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-calendar"></i> Tanggal & Waktu *</label>
        <input type="datetime-local" name="waktu_daftar" class="form-control" value="{{ old('waktu_daftar', now()->format('Y-m-d\TH:i')) }}" required>
        @error('waktu_daftar')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-paw"></i> Pilih Pet *</label>
        <select name="idpet" class="form-control" required>
            <option value="">-- Pilih Pet --</option>
            @foreach($pets as $p)
            <option value="{{ $p->idpet }}" {{ old('idpet')==$p->idpet?'selected':'' }}>
                {{ $p->nama }} - {{ $p->pemilik->user->nama??'-' }} ({{ $p->ras->nama_ras??'-' }})
            </option>
            @endforeach
        </select>
        @error('idpet')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-user-md"></i> Pilih Dokter *</label>
        <select name="idrole_user" class="form-control" required>
            <option value="">-- Pilih Dokter --</option>
            @foreach($dokter as $d)
            <option value="{{ $d->idrole_user }}" {{ old('idrole_user')==$d->idrole_user?'selected':'' }}>{{ $d->user->nama }}</option>
            @endforeach
        </select>
        @error('idrole_user')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div style="display:flex;gap:12px;padding-top:20px;border-top:1px solid #e5e7eb">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Buat Jadwal</button>
        <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-primary" style="background:#6b7280"><i class="fas fa-times"></i> Batal</a>
    </div>
</div>
</form>
@endsection