@extends('layouts.perawat')
@section('title', 'Data Pasien')
@section('content')

<div class="card">
    <div class="section-header">
        <div style="display:flex;align-items:center;gap:12px"><i class="fas fa-paw"></i><h3>Daftar Pasien ({{ $pasien->total() }})</h3></div>
    </div>
    
    <form method="GET" style="margin-bottom:24px">
        <div style="display:flex;gap:12px">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama pasien atau pemilik..." style="flex:1;padding:12px;border:1px solid #e5e7eb;border-radius:8px">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
            @if($search)<a href="{{ route('perawat.pasien.index') }}" class="btn btn-primary" style="background:#6b7280"><i class="fas fa-times"></i></a>@endif
        </div>
    </form>
    
    @if($pasien->count() > 0)
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px">
        @foreach($pasien as $pet)
        <div class="card" style="padding:20px;cursor:pointer;border-left:4px solid #7c3aed" onclick="window.location='{{ route('perawat.pasien.show', $pet->idpet) }}'">
            <div style="display:flex;align-items:center;gap:16px;margin-bottom:16px">
                <div style="width:60px;height:60px;border-radius:50%;background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);display:flex;align-items:center;justify-content:center;color:white;font-size:28px">
                    <i class="fas fa-{{ $pet->jenis_kelamin=='M'?'mars':'venus' }}"></i>
                </div>
                <div style="flex:1">
                    <h4 style="margin:0 0 4px;font-size:18px;font-weight:700">{{ $pet->nama }}</h4>
                    <p style="margin:0;font-size:13px;color:#6b7280">{{ $pet->ras->nama_ras??'-' }}</p>
                </div>
            </div>
            <div style="padding:12px;background:#f9fafb;border-radius:8px">
                <div style="font-size:11px;color:#6b7280;margin-bottom:4px">Pemilik</div>
                <div style="font-weight:600">{{ $pet->pemilik->user->nama??'-' }}</div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $pasien->links() }}
    @else
    <div style="text-align:center;padding:48px"><i class="fas fa-paw" style="font-size:64px;color:#e5e7eb;margin-bottom:16px"></i><h3 style="color:#6b7280">Tidak ada data</h3></div>
    @endif
</div>

@endsection
