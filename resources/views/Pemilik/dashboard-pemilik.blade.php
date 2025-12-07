@extends('layouts.pemilik')

@section('title', 'Dashboard Pemilik')
@section('page-title', 'Dashboard')

@section('content')
<!-- Welcome Banner -->
<div class="welcome-banner">
    <h2>Selamat Datang, {{ $user->nama }}! 👋</h2>
    <p>Terima kasih telah mempercayakan kesehatan hewan kesayangan Anda kepada RSHP UNAIR. Kelola informasi pet, lihat jadwal reservasi, dan akses rekam medis dengan mudah.</p>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-header">
            <div>
                <div class="stat-value">{{ $total_pets }}</div>
                <div class="stat-label">Total Pet Terdaftar</div>
            </div>
            <div class="stat-icon primary">
                <i class="fas fa-paw"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-header">
            <div>
                <div class="stat-value">{{ $total_reservasi }}</div>
                <div class="stat-label">Total Reservasi</div>
            </div>
            <div class="stat-icon secondary">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-header">
            <div>
                <div class="stat-value">{{ $total_rekam_medis }}</div>
                <div class="stat-label">Rekam Medis</div>
            </div>
            <div class="stat-icon accent">
                <i class="fas fa-file-medical"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <div class="section-header">
        <i class="fas fa-bolt"></i>
        <h3>Akses Cepat</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
        <a href="{{ route('pemilik.pets.index') }}" class="btn btn-primary" style="justify-content: center;">
            <i class="fas fa-paw"></i>
            <span>Lihat Pet Saya</span>
        </a>
        <a href="{{ route('pemilik.temu-dokter.index') }}" class="btn btn-primary" style="justify-content: center;">
            <i class="fas fa-calendar-check"></i>
            <span>Jadwal Temu Dokter</span>
        </a>
        <a href="{{ route('pemilik.rekam-medis.index') }}" class="btn btn-primary" style="justify-content: center;">
            <i class="fas fa-file-medical"></i>
            <span>Rekam Medis</span>
        </a>
    </div>
</div>

<!-- Recent Activities -->
@if(isset($recent_temu_dokter) && $recent_temu_dokter->count() > 0)
<div class="card">
    <div class="section-header">
        <i class="fas fa-history"></i>
        <h3>Riwayat Temu Dokter Terbaru</h3>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb; text-align: left;">
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">No. Urut</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Pet</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Tanggal</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Dokter</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recent_temu_dokter as $temu)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 12px;">{{ $temu->no_urut }}</td>
                    <td style="padding: 12px;">
                        <strong>{{ $temu->pet->nama }}</strong><br>
                        <small style="color: #6b7280;">{{ $temu->pet->ras->nama_ras ?? '-' }}</small>
                    </td>
                    <td style="padding: 12px;">{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d M Y, H:i') }}</td>
                    <td style="padding: 12px;">{{ $temu->roleUser->user->nama ?? '-' }}</td>
                    <td style="padding: 12px;">
                        @php
                            $statusMap = [
                                'W' => ['text' => 'Menunggu', 'color' => '#f59e0b'],
                                'P' => ['text' => 'Dalam Pemeriksaan', 'color' => '#3b82f6'],
                                'S' => ['text' => 'Selesai', 'color' => '#10b981'],
                                'B' => ['text' => 'Batal', 'color' => '#ef4444']
                            ];
                            $status = $statusMap[$temu->status] ?? ['text' => 'Unknown', 'color' => '#6b7280'];
                        @endphp
                        <span style="display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; background: {{ $status['color'] }}20; color: {{ $status['color'] }};">
                            {{ $status['text'] }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- My Pets Summary -->
@if($pemilik && $pemilik->pets->count() > 0)
<div class="card">
    <div class="section-header">
        <i class="fas fa-paw"></i>
        <h3>Pet Saya</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 16px;">
        @foreach($pemilik->pets as $pet)
        <div style="border: 1px solid #e5e7eb; border-radius: 12px; padding: 16px; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">
                    <i class="fas fa-{{ $pet->jenis_kelamin == 'M' ? 'mars' : 'venus' }}"></i>
                </div>
                <div>
                    <h4 style="margin: 0; font-size: 16px; font-weight: 600;">{{ $pet->nama }}</h4>
                    <p style="margin: 0; font-size: 12px; color: #6b7280;">{{ $pet->ras->nama_ras ?? '-' }}</p>
                </div>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 12px; color: #6b7280; padding-top: 12px; border-top: 1px solid #e5e7eb;">
                <span><i class="fas fa-birthday-cake"></i> {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} tahun</span>
                <span><i class="fas fa-{{ $pet->jenis_kelamin == 'M' ? 'male' : 'female' }}"></i> {{ $pet->jenis_kelamin == 'M' ? 'Jantan' : 'Betina' }}</span>
            </div>
        </div>
        @endforeach
    </div>
    
    <div style="margin-top: 16px; text-align: center;">
        <a href="{{ route('pemilik.pets.index') }}" class="btn btn-primary">
            <i class="fas fa-eye"></i>
            Lihat Semua Pet
        </a>
    </div>
</div>
@endif

@endsection