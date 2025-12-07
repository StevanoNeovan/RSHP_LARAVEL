@extends('layouts.pemilik')

@section('title', 'Pet Saya')
@section('page-title', 'Pet Saya')

@section('content')

@if($pets->count() > 0)
<div class="card">
    <div class="section-header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-paw"></i>
            <h3>Daftar Hewan Peliharaan ({{ $pets->count() }})</h3>
        </div>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
        @foreach($pets as $pet)
        <div class="card" style="padding: 20px; transition: all 0.3s ease; cursor: pointer;" 
             onclick="window.location='{{ route('pemilik.pets.show', $pet->idpet) }}'"
             onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.15)'"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
            
            <!-- Header -->
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid #e5e7eb;">
                <div style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; color: white; font-size: 32px;">
                    <i class="fas fa-{{ $pet->jenis_kelamin == 'M' ? 'mars' : 'venus' }}"></i>
                </div>
                <div style="flex: 1;">
                    <h4 style="margin: 0 0 4px 0; font-size: 18px; font-weight: 700; color: #1f2937;">{{ $pet->nama }}</h4>
                    <p style="margin: 0; font-size: 14px; color: #6b7280;">{{ $pet->ras->nama_ras ?? '-' }}</p>
                </div>
            </div>
            
            <!-- Info Grid -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 16px;">
                <div>
                    <div style="font-size: 11px; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">Jenis</div>
                    <div style="font-size: 14px; font-weight: 600; color: #1f2937;">{{ $pet->ras->jenisHewan->nama_jenis_hewan ?? '-' }}</div>
                </div>
                <div>
                    <div style="font-size: 11px; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">Umur</div>
                    <div style="font-size: 14px; font-weight: 600; color: #1f2937;">{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} tahun</div>
                </div>
                <div>
                    <div style="font-size: 11px; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">Kelamin</div>
                    <div style="font-size: 14px; font-weight: 600; color: {{ $pet->jenis_kelamin == 'M' ? '#3b82f6' : '#ec4899' }};">
                        <i class="fas fa-{{ $pet->jenis_kelamin == 'M' ? 'male' : 'female' }}"></i>
                        {{ $pet->jenis_kelamin == 'M' ? 'Jantan' : 'Betina' }}
                    </div>
                </div>
                <div>
                    <div style="font-size: 11px; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">Warna</div>
                    <div style="font-size: 14px; font-weight: 600; color: #1f2937;">{{ $pet->warna_tanda }}</div>
                </div>
            </div>
            
            <!-- Action Button -->
            <a href="{{ route('pemilik.pets.show', $pet->idpet) }}" class="btn btn-primary" style="width: 100%; justify-content: center; text-decoration: none;">
                <i class="fas fa-eye"></i>
                Lihat Detail
            </a>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="card" style="text-align: center; padding: 64px 32px;">
    <i class="fas fa-paw" style="font-size: 80px; color: #e5e7eb; margin-bottom: 24px;"></i>
    <h3 style="color: #6b7280; margin-bottom: 12px; font-size: 24px;">Belum Ada Pet Terdaftar</h3>
    <p style="color: #9ca3af; margin-bottom: 24px;">Hubungi resepsionis untuk mendaftarkan hewan peliharaan Anda.</p>
    <a href="https://wa.me/6285678999999" target="_blank" class="btn btn-primary">
        <i class="fab fa-whatsapp"></i>
        Hubungi Resepsionis
    </a>
</div>
@endif

@endsection