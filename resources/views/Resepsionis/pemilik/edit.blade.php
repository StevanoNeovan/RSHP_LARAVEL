@extends('layouts.resepsionis')
@section('title', 'Edit Pemilik')
@section('content')
<a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-primary" style="background:#6b7280;margin-bottom:20px"><i class="fas fa-arrow-left"></i> Kembali</a>

<form method="POST" action="{{ route('resepsionis.pemilik.update', $pemilik->idpemilik) }}">
@csrf @method('PUT')
<div class="card">
    <div class="section-header"><i class="fas fa-edit"></i><h3>Edit Data Pemilik</h3></div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap *</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $pemilik->user->nama) }}" required>
        @error('nama')<div style="color:#ef4444;font-size:13px;margin-top:4px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-envelope"></i> Email *</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $pemilik->user->email) }}" required>
        @error('email')<div style="color:#ef4444;font-size:13px;margin-top:4px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fab fa-whatsapp"></i> Nomor WhatsApp *</label>
        <input type="text" name="no_wa" class="form-control" value="{{ old('no_wa', $pemilik->no_wa) }}" required>
        @error('no_wa')<div style="color:#ef4444;font-size:13px;margin-top:4px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat *</label>
        <textarea name="alamat" rows="4" class="form-control" required>{{ old('alamat', $pemilik->alamat) }}</textarea>
        @error('alamat')<div style="color:#ef4444;font-size:13px;margin-top:4px">{{ $message }}</div>@enderror
    </div>
    
    <div style="display:flex;gap:12px;padding-top:20px;border-top:1px solid #e5e7eb">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Perubahan</button>
        <a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-primary" style="background:#6b7280"><i class="fas fa-times"></i> Batal</a>
    </div>
</div>
</form>
@endsection
