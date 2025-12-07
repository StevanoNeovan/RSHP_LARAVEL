@extends('layouts.dokter')

@section('title', 'Data Pasien')
@section('page-title', 'Data Pasien')

@section('content')

<div class="card">
    <div class="section-header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-paw"></i>
            <h3>Daftar Pasien ({{ $pasien->total() }})</h3>
        </div>
    </div>
    
    <!-- Search Form -->
    <form method="GET" action="{{ route('dokter.pasien.index') }}" style="margin-bottom: 24px;">
        <div style="display: flex; gap: 12px; align-items: center;">
            <div style="flex: 1; position: relative;">
                <i class="fas fa-search" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                <input type="text" 
                       name="search" 
                       value="{{ $search }}" 
                       placeholder="Cari nama pasien atau pemilik..." 
                       style="width: 100%; padding: 12px 12px 12px 45px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
                Cari
            </button>
            @if($search)
            <a href="{{ route('dokter.pasien.index') }}" class="btn btn-primary" style="background: #6b7280;">
                <i class="fas fa-times"></i>
                Reset
            </a>
            @endif
        </div>
    </form>
    
    @if($pasien->count() > 0)
    <!-- Grid Pasien -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
        @foreach($pasien as $pet)
        <div class="card" 
             style="padding: 20px; cursor: pointer; transition: all 0.3s ease; border-left: 4px solid #3b82f6;" 
             onclick="window.location='{{ route('dokter.pasien.show', $pet->idpet) }}'"
             onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.15)'"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
            
            <!-- Header -->
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); display: flex; align-items: center; justify-content: center; color: white; font-size: 28px;">
                    <i class="fas fa-{{ $pet->jenis_kelamin == 'M' ? 'mars' : 'venus' }}"></i>
                </div>
                <div style="flex: 1;">
                    <h4 style="margin: 0 0 4px 0; font-size: 18px; font-weight: 700; color: #1f2937;">{{ $pet->nama }}</h4>
                    <p style="margin: 0; font-size: 13px; color: #6b7280;">{{ $pet->ras->nama_ras ?? '-' }}</p>
                </div>
            </div>
            
            <!-- Info Grid -->
            <div style="padding: 12px; background: #f9fafb; border-radius: 8px; margin-bottom: 12px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; font-size: 13px;">
                    <div>
                        <div style="color: #6b7280; margin-bottom: 4px;">
                            <i class="fas fa-dog"></i> Jenis
                        </div>
                        <div style="font-weight: 600; color: #1f2937;">
                            {{ Str::limit($pet->ras->jenisHewan->nama_jenis_hewan ?? '-', 12) }}
                        </div>
                    </div>
                    <div>
                        <div style="color: #6b7280; margin-bottom: 4px;">
                            <i class="fas fa-birthday-cake"></i> Umur
                        </div>
                        <div style="font-weight: 600; color: #1f2937;">
                            {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} tahun
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pemilik Info -->
            <div style="padding: 12px; background: #dbeafe; border-radius: 8px; margin-bottom: 12px;">
                <div style="font-size: 11px; color: #1e40af; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">
                    <i class="fas fa-user"></i> Pemilik
                </div>
                <div style="font-size: 14px; font-weight: 600; color: #1e40af;">
                    {{ $pet->pemilik->user->nama ?? '-' }}
                </div>
            </div>
            
            <!-- Gender Badge -->
            <div style="text-align: center;">
                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; background: {{ $pet->jenis_kelamin == 'M' ? '#3b82f620' : '#ec489920' }}; color: {{ $pet->jenis_kelamin == 'M' ? '#3b82f6' : '#ec4899' }};">
                    <i class="fas fa-{{ $pet->jenis_kelamin == 'M' ? 'male' : 'female' }}"></i>
                    {{ $pet->jenis_kelamin == 'M' ? 'Jantan' : 'Betina' }}
                </span>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div style="margin-top: 24px; display: flex; justify-content: center;">
        {{ $pasien->links() }}
    </div>
    
    @else
    <div style="text-align: center; padding: 64px 32px; color: #6b7280;">
        <i class="fas fa-paw" style="font-size: 80px; margin-bottom: 24px; opacity: 0.3;"></i>
        <h3 style="margin-bottom: 12px; font-size: 24px;">
            @if($search)
                Tidak Ada Hasil untuk "{{ $search }}"
            @else
                Belum Ada Data Pasien
            @endif
        </h3>
        <p style="color: #9ca3af; margin-bottom: 24px;">
            @if($search)
                Coba kata kunci lain atau reset pencarian
            @else
                Data pasien akan muncul setelah ada pendaftaran
            @endif
        </p>
    </div>
    @endif
</div>

@endsection