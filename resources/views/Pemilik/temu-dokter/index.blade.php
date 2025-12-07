@extends('layouts.pemilik')

@section('title', 'Jadwal Temu Dokter')
@section('page-title', 'Jadwal Temu Dokter')

@section('content')

<div class="card">
    <div class="section-header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-calendar-check"></i>
            <h3>Riwayat Temu Dokter</h3>
        </div>
        <div style="color: #6b7280; font-size: 14px;">
            Total: <strong>{{ $temuDokter->total() }}</strong> jadwal
        </div>
    </div>
    
    @if($temuDokter->count() > 0)
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb; text-align: left;">
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">No. Urut</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Pet</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Tanggal & Waktu</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Dokter</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Status</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($temuDokter as $temu)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 12px;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; background: #10b98120; color: #10b981; font-weight: 700; font-size: 16px;">
                            {{ $temu->no_urut }}
                        </div>
                    </td>
                    <td style="padding: 12px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; color: white;">
                                <i class="fas fa-{{ $temu->pet->jenis_kelamin == 'M' ? 'mars' : 'venus' }}"></i>
                            </div>
                            <div>
                                <strong style="display: block; margin-bottom: 2px;">{{ $temu->pet->nama }}</strong>
                                <small style="color: #6b7280;">{{ $temu->pet->ras->nama_ras ?? '-' }}</small>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 12px;">
                        <div style="display: flex; align-items: center; gap: 8px; color: #6b7280;">
                            <i class="fas fa-calendar"></i>
                            <div>
                                <strong style="display: block; color: #1f2937;">{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d M Y') }}</strong>
                                <small>{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('H:i') }} WIB</small>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 12px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-user-md" style="color: #6b7280;"></i>
                            <span>{{ $temu->roleUser->user->nama ?? '-' }}</span>
                        </div>
                    </td>
                    <td style="padding: 12px;">
                        @php
                            $statusMap = [
                                'W' => ['text' => 'Menunggu', 'color' => '#f59e0b', 'bg' => '#f59e0b20', 'icon' => 'clock'],
                                'P' => ['text' => 'Dalam Pemeriksaan', 'color' => '#3b82f6', 'bg' => '#3b82f620', 'icon' => 'stethoscope'],
                                'S' => ['text' => 'Selesai', 'color' => '#10b981', 'bg' => '#10b98120', 'icon' => 'check-circle'],
                                'B' => ['text' => 'Batal', 'color' => '#ef4444', 'bg' => '#ef444420', 'icon' => 'times-circle']
                            ];
                            $status = $statusMap[$temu->status] ?? ['text' => 'Unknown', 'color' => '#6b7280', 'bg' => '#6b728020', 'icon' => 'question-circle'];
                        @endphp
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 12px; font-size: 13px; font-weight: 600; background: {{ $status['bg'] }}; color: {{ $status['color'] }};">
                            <i class="fas fa-{{ $status['icon'] }}"></i>
                            {{ $status['text'] }}
                        </span>
                    </td>
                    <td style="padding: 12px; text-align: center;">
                        <a href="{{ route('pemilik.temu-dokter.show', $temu->idreservasi_dokter) }}" class="btn btn-primary" style="padding: 8px 16px; font-size: 13px;">
                            <i class="fas fa-eye"></i>
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div style="margin-top: 24px; display: flex; justify-content: center;">
        {{ $temuDokter->links() }}
    </div>
    @else
    <div style="text-align: center; padding: 48px;">
        <i class="fas fa-calendar-times" style="font-size: 64px; color: #e5e7eb; margin-bottom: 16px;"></i>
        <h3 style="color: #6b7280; margin-bottom: 8px;">Belum Ada Jadwal Temu Dokter</h3>
        <p style="color: #9ca3af;">Hubungi resepsionis untuk membuat jadwal temu dokter.</p>
    </div>
    @endif
</div>

@endsection