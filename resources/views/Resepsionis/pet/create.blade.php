@extends('layouts.resepsionis')
@section('title', 'Tambah Pet')
@section('content')
<a href="{{ route('resepsionis.pet.index') }}" class="btn btn-primary" style="background:#6b7280;margin-bottom:20px"><i class="fas fa-arrow-left"></i> Kembali</a>

<form method="POST" action="{{ route('resepsionis.pet.store') }}">
@csrf
<div class="card">
    <div class="section-header"><i class="fas fa-plus-circle"></i><h3>Form Pendaftaran Pet Baru</h3></div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-paw"></i> Nama Pet *</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Contoh: Fluffy, Max, Luna" required>
        @error('nama')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-user"></i> Pemilik *</label>
        <select name="idpemilik" class="form-control" required>
            <option value="">-- Pilih Pemilik --</option>
            @foreach($pemilik as $p)
            <option value="{{ $p->idpemilik }}" {{ old('idpemilik')==$p->idpemilik?'selected':'' }}>{{ $p->user->nama }}</option>
            @endforeach
        </select>
        @error('idpemilik')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-dog"></i> Jenis Hewan *</label>
        <select name="idjenis_hewan" id="jenisHewan" class="form-control" required>
            <option value="">-- Pilih Jenis --</option>
            @foreach($jenisHewan as $j)
            <option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-dna"></i> Ras *</label>
        <select name="idras_hewan" id="rasHewan" class="form-control" required>
            <option value="">-- Pilih Ras --</option>
            @foreach($rasHewan as $r)
            <option value="{{ $r->idras_hewan }}" data-jenis="{{ $r->idjenis_hewan }}">{{ $r->nama_ras }}</option>
            @endforeach
        </select>
        @error('idras_hewan')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-birthday-cake"></i> Tanggal Lahir *</label>
        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" max="{{ date('Y-m-d') }}" required>
        @error('tanggal_lahir')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin *</label>
        <div style="display:flex;gap:16px">
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                <input type="radio" name="jenis_kelamin" value="M" {{ old('jenis_kelamin')=='M'?'checked':'' }} required>
                <span><i class="fas fa-male" style="color:#3b82f6"></i> Jantan</span>
            </label>
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                <input type="radio" name="jenis_kelamin" value="F" {{ old('jenis_kelamin')=='F'?'checked':'' }} required>
                <span><i class="fas fa-female" style="color:#ec4899"></i> Betina</span>
            </label>
        </div>
        @error('jenis_kelamin')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div class="form-group">
        <label class="form-label"><i class="fas fa-palette"></i> Warna/Tanda Khusus *</label>
        <input type="text" name="warna_tanda" class="form-control" value="{{ old('warna_tanda') }}" placeholder="Contoh: Putih bulu panjang, Belang hitam-putih" required>
        @error('warna_tanda')<div style="color:#ef4444;font-size:13px">{{ $message }}</div>@enderror
    </div>
    
    <div style="display:flex;gap:12px;padding-top:20px;border-top:1px solid #e5e7eb">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('resepsionis.pet.index') }}" class="btn btn-primary" style="background:#6b7280"><i class="fas fa-times"></i> Batal</a>
    </div>
</div>
</form>

<script>
document.getElementById('jenisHewan').addEventListener('change', function() {
    const jenis = this.value;
    const rasSelect = document.getElementById('rasHewan');
    Array.from(rasSelect.options).forEach(opt => {
        if (opt.value === '') {
            opt.style.display = 'block';
        } else {
            opt.style.display = opt.dataset.jenis == jenis ? 'block' : 'none';
        }
    });
    rasSelect.value = '';
});
</script>
@endsection