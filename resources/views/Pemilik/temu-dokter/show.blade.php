@extends('layouts.pemilik')

@section('title', 'Detail Temu Dokter')
@section('page-title', 'Detail Temu Dokter')

@section('content')

<div style="margin-bottom: 20px;">
    <a href="{{ route('pemilik.temu-dokter.index') }}" class="btn btn-primary" style="background: #6b7280;">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Jadwal
    </a>
</div>

<!-- Status Banner -->
@php
    $statusMap = [
        'W' => [
            'text' => 'Menunggu',
            'color' => '#f59e0b',
            'bg' => '#fffbeb',
            'icon' => 'clock',
            'description' => 'Anda sudah terdaftar dalam antrian. Mohon datang sesuai jadwal dan tunggu panggilan nomor urut Anda.'
        ],
        'P' => [
            'text' => 'Dalam Pemeriksaan',
            'color' => '#3b82f6',
            'bg' => '#dbeafe',
            'icon' => 'stethoscope',
            'description' => 'Hewan Anda sedang dalam proses pemeriksaan oleh dokter. Mohon menunggu hingga pemeriksaan selesai.'
        ],
        'S' => [
            'text' => 'Selesai',
            'color' => '#10b981',
            'bg' => '#d1fae5',
            'icon' => 'check-circle',
            'description' => 'Pemeriksaan telah selesai. Anda dapat melihat hasil rekam medis di bawah ini atau di menu Rekam Medis.'
        ],
        'B' => [
            'text' => 'Batal',
            'color' => '#ef4444',
            'bg' => '#fee2e2',
            'icon' => 'times-circle',
            'description' => 'Jadwal temu dokter ini telah dibatalkan. Silakan hubungi resepsionis untuk membuat jadwal baru.'
        ]
    ];
    $status = $statusMap[$temuDokter->status] ?? [
        'text' => 'Unknown',
        'color' => '#6b7280',
        'bg' => '#f3f4f6',
        'icon' => 'question-circle',
        'description' => 'Status tidak diketahui'
    ];
@endphp

<div class="card" style="background: {{ $status['bg'] }}; border-left: 6px solid {{ $status['color'] }};">
    <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 70px; height: 70px; border-radius: 50%; background: {{ $status['color'] }}; display: flex; align-items: center; justify-content: center; color: white; font-size: 32px;">
            <i class="fas fa-{{ $status['icon'] }}"></i>
        </div>
        <div style="flex: 1;">
            <h2 style="margin: 0 0 8px 0; color: {{ $status['color'] }}; font-size: 24px; font-weight: 700;">
                Status: {{ $status['text'] }}
            </h2>
            <p style="margin: 0; color: #1f2937; line-height: 1.6;">
                {{ $status['description'] }}
            </p>
        </div>
        <div style="text-align: center; padding: 20px; background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px; font-weight: 600; text-transform: uppercase;">No. Urut</div>
            <div style="font-size: 48px; font-weight: 700; color: {{ $status['color'] }};">{{ $temuDokter->no_urut }}</div>
        </div>
    </div>
</div>

<!-- Main Info Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 24px;">
    
    <!-- Pet Info Card -->
    <div class="card">
        <h3 style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-paw" style="color: #10b981;"></i>
            Informasi Hewan
        </h3>
        
        <div style="display: flex; align-items: center; gap: 16px; padding: 20px; background: #f9fafb; border-radius: 12px;">
            <div style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; color: white; font-size: 32px;">
                <i class="fas fa-{{ $temuDokter->pet->jenis_kelamin == 'M' ? 'mars' : 'venus' }}"></i>
            </div>
            <div style="flex: 1;">
                <h4 style="margin: 0 0 8px 0; font-size: 20px; font-weight: 700;">{{ $temuDokter->pet->nama }}</h4>
                <p style="margin: 0 0 4px 0; color: #6b7280; font-size: 14px;">
                    <i class="fas fa-dog"></i> {{ $temuDokter->pet->ras->jenisHewan->nama_jenis_hewan ?? '-' }}
                </p>
                <p style="margin: 0; color: #6b7280; font-size: 14px;">
                    <i class="fas fa-dna"></i> {{ $temuDokter->pet->ras->nama_ras ?? '-' }}
                </p>
                <p style="margin: 4px 0 0 0; font-size: 14px;">
                    <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 12px; background: {{ $temuDokter->pet->jenis_kelamin == 'M' ? '#3b82f620' : '#ec489920' }}; color: {{ $temuDokter->pet->jenis_kelamin == 'M' ? '#3b82f6' : '#ec4899' }}; font-weight: 600;">
                        <i class="fas fa-{{ $temuDokter->pet->jenis_kelamin == 'M' ? 'male' : 'female' }}"></i>
                        {{ $temuDokter->pet->jenis_kelamin == 'M' ? 'Jantan' : 'Betina' }}
                    </span>
                    <span style="color: #6b7280; margin-left: 8px;">
                        {{ \Carbon\Carbon::parse($temuDokter->pet->tanggal_lahir)->age }} tahun
                    </span>
                </p>
            </div>
        </div>
        
        <div style="margin-top: 16px; text-align: center;">
            <a href="{{ route('pemilik.pets.show', $temuDokter->pet->idpet) }}" class="btn btn-primary" style="width: 100%; justify-content: center;">
                <i class="fas fa-eye"></i>
                Lihat Profil Pet
            </a>
        </div>
    </div>
    
    <!-- Doctor Info Card -->
    <div class="card">
        <h3 style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-user-md" style="color: #3b82f6;"></i>
            Dokter Pemeriksa
        </h3>
        
        <div style="padding: 20px; background: #f9fafb; border-radius: 12px;">
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                <div style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); display: flex; align-items: center; justify-content: center; color: white; font-size: 28px; font-weight: 700;">
                    {{ strtoupper(substr($temuDokter->roleUser->user->nama ?? 'D', 0, 1)) }}
                </div>
                <div>
                    <h4 style="margin: 0 0 4px 0; font-size: 18px; font-weight: 700;">
                        {{ $temuDokter->roleUser->user->nama ?? '-' }}
                    </h4>
                    <p style="margin: 0; color: #6b7280; font-size: 14px;">Dokter Hewan</p>
                </div>
            </div>
            
            <div style="padding: 12px; background: white; border-radius: 8px; border: 1px solid #e5e7eb;">
                <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px;">Email</div>
                <div style="font-size: 14px; font-weight: 600; color: #1f2937;">
                    {{ $temuDokter->roleUser->user->email ?? '-' }}
                </div>
            </div>
        </div>
    </div>
    
    <!-- Schedule Info Card -->
    <div class="card">
        <h3 style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-calendar-alt" style="color: #f59e0b;"></i>
            Jadwal & Waktu
        </h3>
        
        <div style="padding: 20px; background: #f9fafb; border-radius: 12px;">
            <div style="margin-bottom: 16px;">
                <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px; text-transform: uppercase; font-weight: 600;">
                    <i class="fas fa-calendar"></i> Tanggal
                </div>
                <div style="font-size: 18px; font-weight: 700; color: #1f2937;">
                    {{ \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('d F Y') }}
                </div>
            </div>
            
            <div style="margin-bottom: 16px;">
                <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px; text-transform: uppercase; font-weight: 600;">
                    <i class="fas fa-clock"></i> Waktu Daftar
                </div>
                <div style="font-size: 18px; font-weight: 700; color: #1f2937;">
                    {{ \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('H:i') }} WIB
                </div>
            </div>
            
            <div>
                <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px; text-transform: uppercase; font-weight: 600;">
                    <i class="fas fa-hourglass-half"></i> Waktu Tunggu
                </div>
                <div style="font-size: 18px; font-weight: 700; color: #1f2937;">
                    @php
                        $now = \Carbon\Carbon::now();
                        $waktuDaftar = \Carbon\Carbon::parse($temuDokter->waktu_daftar);
                        
                        if ($temuDokter->status == 'S' || $temuDokter->status == 'B') {
                            echo '-';
                        } elseif ($now->lt($waktuDaftar)) {
                            $diff = $now->diff($waktuDaftar);
                            echo $diff->days > 0 ? $diff->days . ' hari lagi' : 'Hari ini';
                        } else {
                            echo 'Sedang berjalan';
                        }
                    @endphp
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- Rekam Medis Section (Only show if status = Selesai) -->
@if($temuDokter->status == 'S' && $temuDokter->rekamMedis)
<div class="card" style="border-left: 6px solid #10b981;">
    <div class="section-header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-file-medical"></i>
            <h3>Hasil Rekam Medis</h3>
        </div>
        <a href="{{ route('pemilik.rekam-medis.show', $temuDokter->rekamMedis->idrekam_medis) }}" class="btn btn-primary">
            <i class="fas fa-eye"></i>
            Lihat Detail Lengkap
        </a>
    </div>
    
    @php
        $rekam = $temuDokter->rekamMedis;
    @endphp
    
    <!-- Diagnosa Preview -->
    <div style="padding: 16px; background: #d1fae5; border-left: 4px solid #10b981; border-radius: 4px; margin-bottom: 16px;">
        <div style="font-size: 11px; color: #065f46; text-transform: uppercase; font-weight: 600; margin-bottom: 8px;">
            <i class="fas fa-notes-medical"></i> Diagnosa
        </div>
        <div style="font-size: 16px; color: #1f2937; line-height: 1.8;">
            {{ $rekam->diagnosa }}
        </div>
    </div>
    
    <!-- Quick Info Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 16px;">
        <div style="padding: 16px; background: #f9fafb; border-radius: 8px;">
            <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px; font-weight: 600;">
                <i class="fas fa-calendar-check"></i> Tanggal Pemeriksaan
            </div>
            <div style="font-size: 16px; font-weight: 700; color: #1f2937;">
                {{ \Carbon\Carbon::parse($rekam->created_at)->format('d M Y, H:i') }}
            </div>
        </div>
        
        <div style="padding: 16px; background: #f9fafb; border-radius: 8px;">
            <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px; font-weight: 600;">
                <i class="fas fa-syringe"></i> Jumlah Tindakan
            </div>
            <div style="font-size: 16px; font-weight: 700; color: #10b981;">
                {{ $rekam->details->count() }} tindakan/terapi
            </div>
        </div>
    </div>
    
    <!-- Tindakan Preview (First 3) -->
    @if($rekam->details->count() > 0)
    <div style="border-top: 1px solid #e5e7eb; padding-top: 16px;">
        <h4 style="margin-bottom: 12px; display: flex; align-items: center; gap: 8px; color: #6b7280; font-size: 14px; font-weight: 600; text-transform: uppercase;">
            <i class="fas fa-list"></i> Tindakan yang Dilakukan
        </h4>
        
        <div style="display: grid; gap: 8px;">
            @foreach($rekam->details->take(3) as $detail)
            <div style="display: flex; align-items: start; gap: 12px; padding: 12px; background: #f9fafb; border-radius: 8px;">
                <span style="display: inline-block; padding: 6px 12px; background: #10b98120; color: #10b981; border-radius: 6px; font-weight: 700; font-family: monospace; font-size: 14px;">
                    {{ $detail->tindakan->kode }}
                </span>
                <div style="flex: 1;">
                    <strong style="display: block; margin-bottom: 4px;">{{ $detail->tindakan->deskripsi_tindakan_terapi }}</strong>
                    @if($detail->detail)
                        <p style="margin: 0; color: #6b7280; font-size: 14px;">{{ $detail->detail }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        
        @if($rekam->details->count() > 3)
        <div style="margin-top: 12px; text-align: center;">
            <a href="{{ route('pemilik.rekam-medis.show', $rekam->idrekam_medis) }}" style="color: #10b981; text-decoration: none; font-weight: 600;">
                <i class="fas fa-plus-circle"></i>
                Lihat {{ $rekam->details->count() - 3 }} tindakan lainnya
            </a>
        </div>
        @endif
    </div>
    @endif
</div>

@elseif($temuDokter->status == 'S' && !$temuDokter->rekamMedis)
<!-- Status Selesai tapi belum ada rekam medis -->
<div class="card" style="border-left: 6px solid #f59e0b;">
    <div style="display: flex; align-items: center; gap: 16px; padding: 20px; background: #fffbeb; border-radius: 8px;">
        <i class="fas fa-exclamation-triangle" style="font-size: 48px; color: #f59e0b;"></i>
        <div>
            <h3 style="margin: 0 0 8px 0; color: #92400e;">Rekam Medis Sedang Diproses</h3>
            <p style="margin: 0; color: #78350f;">
                Pemeriksaan sudah selesai, namun rekam medis masih dalam proses penyusunan oleh dokter. Silakan cek kembali nanti atau hubungi resepsionis.
            </p>
        </div>
    </div>
</div>

@elseif($temuDokter->status == 'W')
<!-- Info untuk status Menunggu -->
<div class="card" style="border-left: 6px solid #3b82f6;">
    <div style="padding: 20px; background: #dbeafe; border-radius: 8px;">
        <h3 style="margin: 0 0 12px 0; display: flex; align-items: center; gap: 8px; color: #1e40af;">
            <i class="fas fa-info-circle"></i>
            Informasi Penting
        </h3>
        <ul style="margin: 0; padding-left: 20px; color: #1f2937; line-height: 2;">
            <li>Datang <strong>15 menit sebelum</strong> waktu yang dijadwalkan</li>
            <li>Bawa <strong>kartu identitas pemilik</strong> dan buku kesehatan hewan (jika ada)</li>
            <li>Pastikan hewan dalam kondisi <strong>tenang dan aman</strong> saat dibawa</li>
            <li>Jika ada <strong>keluhan khusus</strong>, catat untuk disampaikan ke dokter</li>
            <li>Hubungi resepsionis jika ingin <strong>membatalkan atau mengubah jadwal</strong></li>
        </ul>
    </div>
</div>

@elseif($temuDokter->status == 'B')
<!-- Info untuk status Batal -->
<div class="card" style="border-left: 6px solid #ef4444;">
    <div style="padding: 20px; background: #fee2e2; border-radius: 8px; text-align: center;">
        <i class="fas fa-times-circle" style="font-size: 64px; color: #dc2626; margin-bottom: 16px;"></i>
        <h3 style="margin: 0 0 12px 0; color: #991b1b;">Jadwal Telah Dibatalkan</h3>
        <p style="margin: 0 0 20px 0; color: #7f1d1d;">
            Jika ingin membuat jadwal baru, silakan hubungi resepsionis kami.
        </p>
        <a href="https://wa.me/6285678999999" target="_blank" class="btn btn-primary" style="background: #10b981;">
            <i class="fab fa-whatsapp"></i>
            Hubungi Resepsionis
        </a>
    </div>
</div>
@endif

@endsection