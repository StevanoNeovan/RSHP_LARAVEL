@extends('layouts.resepsionis')
@section('title', 'Edit Pet')
@section('content')
<a href="{{ route('resepsionis.pet.index') }}" class="btn btn-primary" style="background:#6b7280;margin-bottom:20px"><i class="fas fa-arrow-left"></i> Kembali</a>

<form method="POST" action="{{ route('resepsionis.pet.update', $pet->idpet) }}">
@csrf @method('PUT')
<div class="card">
    <div class="section-header"><i class="fas fa-edit"></i><h3>Edit Data Pet</h3></div>
    
    <!-- Same fields as create but with values -->
    <div class="form-group">
        <label class="form-label"><i class="fas fa-paw"></i> Nama Pet *</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $pet->nama) }}" required>
        @error('nama')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-user"></i> Pemilik *</label>
        <select name="idpemilik" class="form-control" required>
            @foreach($pemilik as $p)
            <option value="{{ $p->idpemilik }}" {{ old('idpemilik',$pet->idpemilik)==$p->idpemilik?'selected':'' }}>{{ $p->user->nama }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-dna"></i> Ras *</label>
        <select name="idras_hewan" class="form-control" required>
            @foreach($rasHewan as $r)
            <option value="{{ $r->idras_hewan }}" {{ old('idras_hewan',$pet->idras_hewan)==$r->idras_hewan?'selected':'' }}>{{ $r->jenisHewan->nama_jenis_hewan }} - {{ $r->nama_ras }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-birthday-cake"></i> Tanggal Lahir *</label>
        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}" max="{{ date('Y-m-d') }}" required>
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin *</label>
        <div style="display:flex;gap:16px">
            <label style="display:flex;align-items:center;gap:8px">
                <input type="radio" name="jenis_kelamin" value="M" {{ old('jenis_kelamin',$pet->jenis_kelamin)=='M'?'checked':'' }} required>
                <span>Jantan</span>
            </label>
            <label style="display:flex;align-items:center;gap:8px">
                <input type="radio" name="jenis_kelamin" value="F" {{ old('jenis_kelamin',$pet->jenis_kelamin)=='F'?'checked':'' }} required>
                <span>Betina</span>
            </label>
        </div>
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-palette"></i> Warna/Tanda *</label>
        <input type="text" name="warna_tanda" class="form-control" value="{{ old('warna_tanda', $pet->warna_tanda) }}" required>
    </div>
    
    <div style="display:flex;gap:12px;padding-top:20px;border-top:1px solid #e5e7eb">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('resepsionis.pet.index') }}" class="btn btn-primary" style="background:#6b7280"><i class="fas fa-times"></i> Batal</a>
    </div>
</div>
</form>
@endsection