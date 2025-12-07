@extends('layouts.dokter')
@section('title', 'Detail Temu Dokter')
@section('page-title', 'Detail Temu Dokter')
@section('content')

<a href="{{ route('dokter.temu-dokter.index') }}" class="btn btn-primary" style="background: #6b7280; margin-bottom: 20px;">
    <i class="fas fa-arrow-left"></i> Kembali
</a>

<!-- Status Banner -->
@php
    $statusMap = [
        'W' => ['text' => 'Menunggu', 'color' => '#f59e0b', 'bg' => '#fffbeb', 'icon' => 'clock'],
        'P' => ['text' => 'Dalam Pemeriksaan', 'color' => '#3b82f6', 'bg' => '#dbeafe', 'icon' => 'stethoscope'],
        'S' => ['text' => 'Selesai', 'color' => '#10b981', 'bg' => '#d1fae5', 'icon' => 'check-circle'],
        'B' => ['text' => 'Batal', 'color' => '#ef4444', 'bg' => '#fee2e2', 'icon' => 'times-circle']
    ];
    $status = $statusMap[$temuDokter->status] ?? ['text' => 'Unknown', 'color' => '#6b7280', 'bg' => '#f3f4f6', 'icon' => 'question-circle'];
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
        </div>
        <div style="text-align: center; padding: 20px; background: white; border-radius: 12px;">
            <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px; font-weight: 600;">No. Urut</div>
            <div style="font-size: 48px; font-weight: 700; color: {{ $status['color'] }};">{{ $temuDokter->no_urut }}</div>
        </div>
    </div>
</div>

<!-- Info Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
    <!-- Pet Info -->
    <div class="card">
        <h3 style="margin-bottom: 16px;"><i class="fas fa-paw" style="color: #3b82f6;"></i> Pasien</h3>
        <div style="display: flex; gap: 16px; padding: 20px; background: #f9fafb; border-radius: 12px;">
            <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); display: flex; align-items: center; justify-content: center; color: white; font-size: 28px;">
                <i class="fas fa-{{ $temuDokter->pet->jenis_kelamin == 'M' ? 'mars' : 'venus' }}"></i>
            </div>
            <div>
                <h4 style="margin: 0 0 8px 0; font-size: 18px; font-weight: 700;">{{ $temuDokter->pet->nama }}</h4>
                <p style="margin: 0 0 4px 0; color: #6b7280; font-size: 14px;">{{ $temuDokter->pet->ras->nama_ras ?? '-' }}</p>
                <p style="margin: 0; font-size: 14px;">
                    <span style="padding: 4px 10px; border-radius: 12px; background: {{ $temuDokter->pet->jenis_kelamin == 'M' ? '#3b82f620' : '#ec489920' }}; color: {{ $temuDokter->pet->jenis_kelamin == 'M' ? '#3b82f6' : '#ec4899' }}; font-weight: 600; font-size: 12px;">
                        {{ $temuDokter->pet->jenis_kelamin == 'M' ? 'Jantan' : 'Betina' }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Pemilik Info -->
    <div class="card">
        <h3 style="margin-bottom: 16px;"><i class="fas fa-user" style="color: #10b981;"></i> Pemilik</h3>
        <div style="padding: 20px; background: #f9fafb; border-radius: 12px;">
            <h4 style="margin: 0 0 8px 0; font-size: 18px; font-weight: 700;">{{ $temuDokter->pet->pemilik->user->nama ?? '-' }}</h4>
            <p style="margin: 0; color: #6b7280;">{{ $temuDokter->pet->pemilik->user->email ?? '-' }}</p>
        </div>
    </div>
    
    <!-- Schedule Info -->
    <div class="card">
        <h3 style="margin-bottom: 16px;"><i class="fas fa-calendar" style="color: #f59e0b;"></i> Jadwal</h3>
        <div style="padding: 20px; background: #f9fafb; border-radius: 12px;">
            <div style="margin-bottom: 12px;">
                <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px;">Tanggal</div>
                <div style="font-size: 16px; font-weight: 700;">{{ \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('d F Y') }}</div>
            </div>
            <div>
                <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px;">Waktu</div>
                <div style="font-size: 16px; font-weight: 700;">{{ \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('H:i') }} WIB</div>
            </div>
        </div>
    </div>
</div>

<!-- Rekam Medis -->
@if($temuDokter->status == 'S' && $temuDokter->rekamMedis)
<div class="card" style="border-left: 6px solid #10b981;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3><i class="fas fa-file-medical"></i> Rekam Medis</h3>
        <a href="{{ route('dokter.rekam-medis.show', $temuDokter->rekamMedis->idrekam_medis) }}" class="btn btn-primary">
            <i class="fas fa-eye"></i> Lihat Detail Lengkap
        </a>
    </div>
    
    <div style="padding: 16px; background: #d1fae5; border-left: 4px solid #10b981; border-radius: 4px;">
        <div style="font-size: 11px; color: #065f46; text-transform: uppercase; font-weight: 600; margin-bottom: 8px;">Diagnosa</div>
        <div style="font-size: 16px; color: #1f2937;">{{ $temuDokter->rekamMedis->diagnosa }}</div>
    </div>
@endif

@endsection