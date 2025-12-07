@extends('layouts.dokter')
@section('title', 'Jadwal Temu Dokter')
@section('page-title', 'Jadwal Temu Dokter')
@section('content')

<div class="card">
    <div class="section-header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-calendar-check"></i>
            <h3>Jadwal Temu Dokter ({{ $temuDokter->total() }})</h3>
        </div>
    </div>
    
    @if($temuDokter->count() > 0)
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb; text-align: left;">
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">No. Urut</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Pasien</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Pemilik</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Tanggal & Waktu</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Status</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($temuDokter as $temu)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 12px;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; background: #3b82f620; color: #3b82f6; font-weight: 700; font-size: 16px;">
                            {{ $temu->no_urut }}
                        </div>
                    </td>
                    <td style="padding: 12px;">
                        <strong>{{ $temu->pet->nama }}</strong><br>
                        <small style="color: #6b7280;">{{ $temu->pet->ras->nama_ras ?? '-' }}</small>
                    </td>
                    <td style="padding: 12px;">{{ $temu->pet->pemilik->user->nama ?? '-' }}</td>
                    <td style="padding: 12px;">
                        <div>{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d M Y') }}</div>
                        <small style="color: #6b7280;">{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('H:i') }} WIB</small>
                    </td>
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
                        <span style="display: inline-flex; padding: 6px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; background: {{ $status['color'] }}20; color: {{ $status['color'] }};">
                            {{ $status['text'] }}
                        </span>
                    </td>
                    <td style="padding: 12px; text-align: center;">
                        <a href="{{ route('dokter.temu-dokter.show', $temu->idreservasi_dokter) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 13px;">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 24px; display: flex; justify-content: center;">
        {{ $temuDokter->links() }}
    </div>
    @else
    <div style="text-align: center; padding: 48px;">
        <i class="fas fa-calendar-times" style="font-size: 64px; color: #e5e7eb; margin-bottom: 16px;"></i>
        <h3 style="color: #6b7280;">Belum Ada Jadwal</h3>
    </div>
    @endif
</div>

@endsection