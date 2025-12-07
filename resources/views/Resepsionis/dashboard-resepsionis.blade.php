@extends('layouts.resepsionis')

@section('title', 'Dashboard Resepsionis')
@section('page-title', 'Dashboard')

@section('content')

<!-- Welcome Banner -->
<div style="background: linear-gradient(135deg, #10b981, #059669); padding: 32px; border-radius: 16px; color: white; margin-bottom: 32px; box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);">
    <h2 style="font-size: 28px; margin-bottom: 8px;">Selamat Datang, {{ Auth::user()->nama }}! 👋</h2>
    <p style="font-size: 16px; opacity: 0.95; line-height: 1.6;">Kelola data pemilik, pet, dan jadwal temu dokter dengan efisien. Berikan pelayanan terbaik untuk setiap pengunjung klinik.</p>
</div>

<!-- Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; margin-bottom: 32px;">
    
    <!-- Total Pemilik -->
    <div style="background: white; padding: 24px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: all 0.3s ease;" 
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 24px;">
                <i class="fas fa-user-friends"></i>
            </div>
        </div>
        <div style="font-size: 36px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">{{ $jumlahPemilik }}</div>
        <div style="font-size: 14px; color: #6b7280; font-weight: 500;">Total Pemilik Terdaftar</div>
        <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid #e5e7eb;">
            <a href="{{ route('resepsionis.pemilik.index') }}" style="color: #10b981; text-decoration: none; font-size: 13px; font-weight: 600;">
                Lihat Data <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Pet -->
    <div style="background: white; padding: 24px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: all 0.3s ease;" 
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center; color: #3b82f6; font-size: 24px;">
                <i class="fas fa-paw"></i>
            </div>
        </div>
        <div style="font-size: 36px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">{{ $jumlahPet }}</div>
        <div style="font-size: 14px; color: #6b7280; font-weight: 500;">Total Pet Terdaftar</div>
        <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid #e5e7eb;">
            <a href="{{ route('resepsionis.pet.index') }}" style="color: #3b82f6; text-decoration: none; font-size: 13px; font-weight: 600;">
                Lihat Data <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Temu Dokter Hari Ini -->
    <div style="background: white; padding: 24px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: all 0.3s ease;" 
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 24px;">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
        <div style="font-size: 36px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">{{ $jumlahTemuDokterHariIni }}</div>
        <div style="font-size: 14px; color: #6b7280; font-weight: 500;">Jadwal Hari Ini</div>
        <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid #e5e7eb;">
            <a href="{{ route('resepsionis.temu-dokter.index') }}" style="color: #f59e0b; text-decoration: none; font-size: 13px; font-weight: 600;">
                Lihat Jadwal <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Temu Dokter Minggu Ini -->
    <div style="background: white; padding: 24px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: all 0.3s ease;" 
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(139, 92, 246, 0.1); display: flex; align-items: center; justify-content: center; color: #8b5cf6; font-size: 24px;">
                <i class="fas fa-calendar-week"></i>
            </div>
        </div>
        <div style="font-size: 36px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">{{ $jumlahTemuDokterMingguIni }}</div>
        <div style="font-size: 14px; color: #6b7280; font-weight: 500;">Jadwal Minggu Ini</div>
    </div>

</div>

<!-- Quick Actions -->
<div class="card">
    <div class="section-header">
        <i class="fas fa-bolt"></i>
        <h3>Aksi Cepat</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
        <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-success" style="justify-content: center;">
            <i class="fas fa-user-plus"></i>
            <span>Daftar Pemilik Baru</span>
        </a>
        <a href="{{ route('resepsionis.pet.create') }}" class="btn btn-primary" style="justify-content: center;">
            <i class="fas fa-plus-circle"></i>
            <span>Daftar Pet Baru</span>
        </a>
        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn btn-warning" style="justify-content: center;">
            <i class="fas fa-calendar-plus"></i>
            <span>Buat Jadwal Temu</span>
        </a>
        <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-primary" style="background: #8b5cf6; justify-content: center;">
            <i class="fas fa-list"></i>
            <span>Lihat Semua Jadwal</span>
        </a>
    </div>
</div>

<!-- Status Breakdown Hari Ini -->
@if(isset($statusBreakdown) && $statusBreakdown->count() > 0)
<div class="card">
    <div class="section-header">
        <i class="fas fa-chart-pie"></i>
        <h3>Status Temu Dokter Hari Ini</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
        @php
            $statusMap = [
                'W' => ['text' => 'Menunggu', 'color' => '#f59e0b', 'icon' => 'clock'],
                'P' => ['text' => 'Dalam Pemeriksaan', 'color' => '#3b82f6', 'icon' => 'stethoscope'],
                'S' => ['text' => 'Selesai', 'color' => '#10b981', 'icon' => 'check-circle'],
                'B' => ['text' => 'Batal', 'color' => '#ef4444', 'icon' => 'times-circle']
            ];
        @endphp
        
        @foreach($statusMap as $key => $status)
            <div style="padding: 20px; background: {{ $status['color'] }}10; border-left: 4px solid {{ $status['color'] }}; border-radius: 8px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                    <i class="fas fa-{{ $status['icon'] }}" style="font-size: 24px; color: {{ $status['color'] }};"></i>
                    <div style="font-size: 14px; color: #6b7280; font-weight: 600;">{{ $status['text'] }}</div>
                </div>
                <div style="font-size: 32px; font-weight: 700; color: {{ $status['color'] }};">
                    {{ $statusBreakdown->get($key, 0) }}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

<!-- Jadwal Temu Dokter Hari Ini -->
@if(isset($temuDokterHariIni) && $temuDokterHariIni->count() > 0)
<div class="card">
    <div class="section-header">
        <i class="fas fa-calendar-day"></i>
        <h3>Jadwal Temu Dokter Hari Ini ({{ $temuDokterHariIni->count() }})</h3>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb; text-align: left;">
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">No. Urut</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Pasien</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Pemilik</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Dokter</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Waktu</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Status</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($temuDokterHariIni as $temu)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 12px;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; background: #10b98120; color: #10b981; font-weight: 700; font-size: 16px;">
                            {{ $temu->no_urut }}
                        </div>
                    </td>
                    <td style="padding: 12px;">
                        <strong>{{ $temu->pet->nama }}</strong><br>
                        <small style="color: #6b7280;">{{ $temu->pet->ras->nama_ras ?? '-' }}</small>
                    </td>
                    <td style="padding: 12px;">{{ $temu->pet->pemilik->user->nama ?? '-' }}</td>
                    <td style="padding: 12px;">{{ $temu->roleUser->user->nama ?? '-' }}</td>
                    <td style="padding: 12px;">{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('H:i') }} WIB</td>
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
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; background: {{ $status['color'] }}20; color: {{ $status['color'] }};">
                            {{ $status['text'] }}
                        </span>
                    </td>
                    <td style="padding: 12px; text-align: center;">
                        <a href="{{ route('resepsionis.temu-dokter.edit', $temu->idreservasi_dokter) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 13px;">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 16px; text-align: center;">
        <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-primary">
            <i class="fas fa-list"></i>
            Lihat Semua Jadwal
        </a>
    </div>
</div>
@else
<div class="card">
    <div style="text-align: center; padding: 48px; color: #6b7280;">
        <i class="fas fa-calendar-times" style="font-size: 64px; margin-bottom: 16px; opacity: 0.3;"></i>
        <h3 style="margin-bottom: 8px;">Belum Ada Jadwal Hari Ini</h3>
        <p style="color: #9ca3af; margin-bottom: 24px;">Buat jadwal temu dokter baru untuk hari ini</p>
        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn btn-success">
            <i class="fas fa-calendar-plus"></i>
            Buat Jadwal Baru
        </a>
    </div>
</div>
@endif

<!-- Recent Activities -->
@if(isset($recentActivities) && $recentActivities->count() > 0)
<div class="card">
    <div class="section-header">
        <i class="fas fa-history"></i>
        <h3>Aktivitas Terbaru</h3>
    </div>
    
    <div style="display: grid; gap: 12px;">
        @foreach($recentActivities as $activity)
        <div style="display: flex; align-items: center; gap: 16px; padding: 16px; background: #f9fafb; border-radius: 8px; border-left: 3px solid #10b981;">
            <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; color: white; font-size: 16px;">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div style="flex: 1;">
                <div style="font-weight: 600; color: #1f2937; margin-bottom: 4px;">
                    {{ $activity->pet->nama }} - {{ $activity->pet->pemilik->user->nama ?? '-' }}
                </div>
                <div style="font-size: 13px; color: #6b7280;">
                    <i class="fas fa-user-md"></i> {{ $activity->roleUser->user->nama ?? '-' }} • 
                    <i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($activity->waktu_daftar)->format('d M Y, H:i') }}
                </div>
            </div>
            <div>
                @php
                    $statusMap = [
                        'W' => ['text' => 'Menunggu', 'color' => '#f59e0b'],
                        'P' => ['text' => 'Proses', 'color' => '#3b82f6'],
                        'S' => ['text' => 'Selesai', 'color' => '#10b981'],
                        'B' => ['text' => 'Batal', 'color' => '#ef4444']
                    ];
                    $status = $statusMap[$activity->status] ?? ['text' => 'Unknown', 'color' => '#6b7280'];
                @endphp
                <span style="display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; background: {{ $status['color'] }}20; color: {{ $status['color'] }};">
                    {{ $status['text'] }}
                </span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Tips Section -->
<div class="card" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none;">
    <div style="display: flex; align-items: start; gap: 20px;">
        <div style="font-size: 48px; opacity: 0.3;">
            <i class="fas fa-lightbulb"></i>
        </div>
        <div>
            <h3 style="margin-bottom: 12px; font-size: 20px;">
                <i class="fas fa-info-circle"></i>
                Tips untuk Resepsionis
            </h3>
            <ul style="list-style: none; padding: 0; margin: 0; line-height: 2;">
                <li><i class="fas fa-check-circle"></i> Selalu konfirmasi data pemilik sebelum membuat jadwal</li>
                <li><i class="fas fa-check-circle"></i> Pastikan nomor urut sudah benar untuk hari yang dipilih</li>
                <li><i class="fas fa-check-circle"></i> Update status temu dokter secara berkala</li>
                <li><i class="fas fa-check-circle"></i> Hubungi pemilik jika ada perubahan jadwal</li>
            </ul>
        </div>
    </div>
</div>

@endsection