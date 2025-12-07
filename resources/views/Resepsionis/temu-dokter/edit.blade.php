@extends('layouts.resepsionis')
@section('title', 'Edit Jadwal')
@section('content')
<a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-primary" style="background:#6b7280;margin-bottom:20px"><i class="fas fa-arrow-left"></i> Kembali</a>

<form method="POST" action="{{ route('resepsionis.temu-dokter.update', $temuDokter->idreservasi_dokter) }}">
@csrf @method('PUT')
<div class="card">
    <div class="section-header"><i class="fas fa-edit"></i><h3>Edit Jadwal Temu Dokter</h3></div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-calendar"></i> Tanggal & Waktu *</label>
        <input type="datetime-local" name="waktu_daftar" class="form-control" value="{{ old('waktu_daftar', \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('Y-m-d\TH:i')) }}" required>
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-paw"></i> Pet *</label>
        <select name="idpet" class="form-control" required>
            @foreach($pets as $p)
            <option value="{{ $p->idpet }}" {{ old('idpet',$temuDokter->idpet)==$p->idpet?'selected':'' }}>
                {{ $p->nama }} - {{ $p->pemilik->user->nama??'-' }}
            </option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-user-md"></i> Dokter *</label>
        <select name="idrole_user" class="form-control" required>
            @foreach($dokter as $d)
            <option value="{{ $d->idrole_user }}" {{ old('idrole_user',$temuDokter->idrole_user)==$d->idrole_user?'selected':'' }}>{{ $d->user->nama }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-info-circle"></i> Status *</label>
        <select name="status" class="form-control" required>
            <option value="W" {{ old('status',$temuDokter->status)=='W'?'selected':'' }}>Menunggu</option>
            <option value="P" {{ old('status',$temuDokter->status)=='P'?'selected':'' }}>Dalam Pemeriksaan</option>
            <option value="S" {{ old('status',$temuDokter->status)=='S'?'selected':'' }}>Selesai</option>
            <option value="B" {{ old('status',$temuDokter->status)=='B'?'selected':'' }}>Batal</option>
        </select>
    </div>
    
    <div style="display:flex;gap:12px;padding-top:20px;border-top:1px solid #e5e7eb">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-primary" style="background:#6b7280"><i class="fas fa-times"></i> Batal</a>
    </div>
</div>
</form>
@endsection