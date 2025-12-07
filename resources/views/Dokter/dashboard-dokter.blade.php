@extends('layouts.dokter')

@section('title', 'Dashboard Dokter')
@section('page-title', 'Dashboard')

@section('content')

<!-- Welcome Banner -->
<div style="background: linear-gradient(135deg, #3b82f6, #2563eb); padding: 32px; border-radius: 16px; color: white; margin-bottom: 32px; box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);">
    <h2 style="font-size: 28px; margin-bottom: 8px;">Selamat Datang, Dr. {{ $dokter->nama }}! 👨‍⚕️</h2>
    <p style="font-size: 16px; opacity: 0.95; line-height: 1.6;">Berikan pelayanan kesehatan terbaik untuk hewan dengan profesionalisme dan dedikasi tinggi.</p>
</div>

<!-- Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; margin-bottom: 32px;">
    
    <!-- Total Rekam Medis -->
    <div style="background: white; padding: 24px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: all 0.3s ease;" 
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center; color: #3b82f6; font-size: 24px;">
                <i class="fas fa-file-medical"></i>
            </div>
        </div>
        <div style="font-size: 36px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">{{ $total_rekam_medis }}</div>
        <div style="font-size: 14px; color: #6b7280; font-weight: 500;">Total Rekam Medis</div>
    </div>

    <!-- Reservasi Hari Ini -->
    <div style="background: white; padding: 24px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: all 0.3s ease;" 
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 24px;">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
        <div style="font-size: 36px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">{{ $total_reservasi }}</div>
        <div style="font-size: 14px; color: #6b7280; font-weight: 500;">Reservasi Hari Ini</div>
    </div>

    <!-- Total Pasien -->
    <div style="background: white; padding: 24px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: all 0.3s ease;" 
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 24px;">
                <i class="fas fa-paw"></i>
            </div>
        </div>
        <div style="font-size: 36px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">{{ $total_pets }}</div>
        <div style="font-size: 14px; color: #6b7280; font-weight: 500;">Total Pasien</div>
    </div>

</div>

<!-- Quick Actions -->
<div class="card">
    <div class="section-header">
        <i class="fas fa-bolt"></i>
        <h3>Akses Cepat</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
        <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-primary" style="justify-content: center;">
            <i class="fas fa-file-medical"></i>
            <span>Lihat Rekam Medis</span>
        </a>
        <a href="{{ route('dokter.pasien.index') }}" class="btn btn-primary" style="justify-content: center;">
            <i class="fas fa-paw"></i>
            <span>Data Pasien</span>
        </a>
        <a href="{{ route('dokter.temu-dokter.index') }}" class="btn btn-primary" style="justify-content: center;">
            <i class="fas fa-calendar-check"></i>
            <span>Jadwal Hari Ini</span>
        </a>
    </div>
</div>

<!-- Jadwal Hari Ini -->
@if(isset($jadwal_hari_ini) && $jadwal_hari_ini->count() > 0)
<div class="card">
    <div class="section-header">
        <i class="fas fa-calendar-day"></i>
        <h3>Jadwal Temu Dokter Hari Ini ({{ $jadwal_hari_ini->count() }})</h3>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb; text-align: left;">
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">No. Urut</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Pasien</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Pemilik</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Waktu</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Status</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwal_hari_ini as $jadwal)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 12px;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; background: #3b82f620; color: #3b82f6; font-weight: 700; font-size: 16px;">
                            {{ $jadwal->no_urut }}
                        </div>
                    </td>
                    <td style="padding: 12px;">
                        <strong>{{ $jadwal->pet->nama }}</strong><br>
                        <small style="color: #6b7280;">{{ $jadwal->pet->ras->nama_ras ?? '-' }}</small>
                    </td>
                    <td style="padding: 12px;">{{ $jadwal->pet->pemilik->user->nama ?? '-' }}</td>
                    <td style="padding: 12px;">{{ \Carbon\Carbon::parse($jadwal->waktu_daftar)->format('H:i') }}</td>
                    <td style="padding: 12px;">
                        @php
                            $statusMap = [
                                'W' => ['text' => 'Menunggu', 'color' => '#f59e0b'],
                                'P' => ['text' => 'Dalam Pemeriksaan', 'color' => '#3b82f6'],
                                'S' => ['text' => 'Selesai', 'color' => '#10b981'],
                                'B' => ['text' => 'Batal', 'color' => '#ef4444']
                            ];
                            $status = $statusMap[$jadwal->status] ?? ['text' => 'Unknown', 'color' => '#6b7280'];
                        @endphp
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; background: {{ $status['color'] }}20; color: {{ $status['color'] }};">
                            {{ $status['text'] }}
                        </span>
                    </td>
                    <td style="padding: 12px; text-align: center;">
                        <a href="{{ route('dokter.temu-dokter.show', $jadwal->idreservasi_dokter) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 13px;">
                            <i class="fas fa-eye"></i>
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection