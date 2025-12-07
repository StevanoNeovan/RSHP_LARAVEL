@extends('layouts.pemilik')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')
<div class="card">
    <div class="section-header">
        <i class="fas fa-user"></i>
        <h3>Informasi Pribadi</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: 200px 1fr; gap: 32px; align-items: start;">
        <!-- Avatar -->
        <div style="text-align: center;">
            <div style="width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; color: white; font-size: 64px; font-weight: 700; margin: 0 auto 16px; border: 5px solid #e5e7eb;">
                {{ strtoupper(substr($user->nama, 0, 1)) }}
            </div>
            <h3 style="margin: 0; font-size: 20px; font-weight: 700;">{{ $user->nama }}</h3>
            <p style="color: #6b7280; font-size: 14px;">Pemilik Hewan</p>
        </div>
        
        <!-- Info Details -->
        <div>
            <table style="width: 100%; border-collapse: collapse;">
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; width: 200px; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-envelope" style="width: 20px;"></i> Email
                    </td>
                    <td style="padding: 16px 0;">{{ $user->email }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-phone" style="width: 20px;"></i> WhatsApp
                    </td>
                    <td style="padding: 16px 0;">
                        @if($pemilik && $pemilik->no_wa)
                            {{ $pemilik->no_wa }}
                            <a href="https://wa.me/{{ $pemilik->no_wa }}" target="_blank" style="color: #10b981; text-decoration: none; margin-left: 8px;">
                                <i class="fab fa-whatsapp"></i> Chat
                            </a>
                        @else
                            <span style="color: #6b7280;">-</span>
                        @endif
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280; vertical-align: top;">
                        <i class="fas fa-map-marker-alt" style="width: 20px;"></i> Alamat
                    </td>
                    <td style="padding: 16px 0;">
                        @if($pemilik && $pemilik->alamat)
                            {{ $pemilik->alamat }}
                        @else
                            <span style="color: #6b7280;">-</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-paw" style="width: 20px;"></i> Total Pet
                    </td>
                    <td style="padding: 16px 0;">
                        <strong style="color: #10b981; font-size: 18px;">{{ $pemilik ? $pemilik->pets->count() : 0 }}</strong> Hewan
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Pet List -->
@if($pemilik && $pemilik->pets->count() > 0)
<div class="card">
    <div class="section-header">
        <i class="fas fa-paw"></i>
        <h3>Daftar Hewan Peliharaan</h3>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb; text-align: left;">
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">No</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Nama</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Jenis & Ras</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Kelamin</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Umur</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Warna/Tanda</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemilik->pets as $index => $pet)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 12px;">{{ $index + 1 }}</td>
                    <td style="padding: 12px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; color: white; font-size: 16px;">
                                <i class="fas fa-{{ $pet->jenis_kelamin == 'M' ? 'mars' : 'venus' }}"></i>
                            </div>
                            <strong>{{ $pet->nama }}</strong>
                        </div>
                    </td>
                    <td style="padding: 12px;">
                        {{ $pet->ras->jenisHewan->nama_jenis_hewan ?? '-' }}<br>
                        <small style="color: #6b7280;">{{ $pet->ras->nama_ras ?? '-' }}</small>
                    </td>
                    <td style="padding: 12px;">
                        <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; background: {{ $pet->jenis_kelamin == 'M' ? '#3b82f620' : '#ec489920' }}; color: {{ $pet->jenis_kelamin == 'M' ? '#3b82f6' : '#ec4899' }};">
                            <i class="fas fa-{{ $pet->jenis_kelamin == 'M' ? 'male' : 'female' }}"></i>
                            {{ $pet->jenis_kelamin == 'M' ? 'Jantan' : 'Betina' }}
                        </span>
                    </td>
                    <td style="padding: 12px;">
                        {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} tahun
                        <br><small style="color: #6b7280;">{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d M Y') }}</small>
                    </td>
                    <td style="padding: 12px;">{{ $pet->warna_tanda }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="card" style="text-align: center; padding: 48px;">
    <i class="fas fa-paw" style="font-size: 64px; color: #e5e7eb; margin-bottom: 16px;"></i>
    <h3 style="color: #6b7280; margin-bottom: 8px;">Belum Ada Pet Terdaftar</h3>
    <p style="color: #9ca3af;">Hubungi resepsionis untuk mendaftarkan hewan peliharaan Anda.</p>
</div>
@endif

@endsection