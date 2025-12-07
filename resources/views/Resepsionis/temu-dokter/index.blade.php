@extends('layouts.resepsionis')
@section('title', 'Jadwal Temu Dokter')

@section('content')
<div class="card">

   
    <!-- Header -->
    <div style="
        display:flex; 
        align-items:center; 
        justify-content:space-between; 
        margin-bottom:24px;
    ">

        <div style="display:flex; align-items:center; gap:10px;">
            <i class="fas fa-calendar-check" style="font-size:20px; color:#059669;"></i>
            <h3 style="margin:0; font-weight:700;">Jadwal Temu Dokter</h3>
        </div>

        <a href="{{ route('resepsionis.temu-dokter.create') }}" 
           class="btn btn-success" 
           style="display:flex; align-items:center; gap:6px;">
            <i class="fas fa-calendar-plus"></i> Buat Jadwal Baru
        </a>
    </div>

    <!-- Filter -->
    <form method="GET" style="margin-bottom:24px;">
        <div style="display:flex; gap:12px; align-items:center;">
            <label style="font-weight:600;"><i class="fas fa-calendar"></i> Pilih Tanggal:</label>

            <div style="position:relative;">
                <input type="date" name="tanggal" value="{{ $tanggal }}" 
                       class="form-control"
                       style="padding:10px 12px; border-radius:8px; border:1px solid #e5e7eb;">
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 16px; border-radius: 8px;"> 
                <i class="fas fa-search"></i> Lihat
            </button>

            <a href="{{ route('resepsionis.temu-dokter.index') }}" 
               class="btn btn-primary" style=" padding: 7px 16px; border-radius: 8px; background:#6b7280;">
                <i class="fas fa-calendar-day"></i> Hari Ini
            </a>
        </div>
    </form>

    @if($temuDokter->count() > 0)
    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f9fafb; text-align:left;">
                    <th style="padding:12px; border-bottom:2px solid #e5e7eb;">No.</th>
                    <th style="padding:12px; border-bottom:2px solid #e5e7eb;">Pasien</th>
                    <th style="padding:12px; border-bottom:2px solid #e5e7eb;">Pemilik</th>
                    <th style="padding:12px; border-bottom:2px solid #e5e7eb;">Dokter</th>
                    <th style="padding:12px; border-bottom:2px solid #e5e7eb;">Waktu</th>
                    <th style="padding:12px; border-bottom:2px solid #e5e7eb;">Status</th>
                    <th style="padding:12px; border-bottom:2px solid #e5e7eb; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($temuDokter as $td)
                <tr style="border-bottom:1px solid #e5e7eb;">
                    <td style="padding:12px;">
                        <div style="
                            display:flex; 
                            width:40px; 
                            height:40px; 
                            border-radius:8px; 
                            background:#10b98120; 
                            color:#10b981; 
                            font-weight:700; 
                            align-items:center; 
                            justify-content:center;">
                            {{ $td->no_urut }}
                        </div>
                    </td>

                    <td style="padding:12px;">
                        <strong>{{ $td->pet->nama }}</strong>
                        <br>
                        <small style="color:#6b7280;">
                            {{ $td->pet->ras->nama_ras ?? '-' }}
                        </small>
                    </td>

                    <td style="padding:12px;">
                        {{ $td->pet->pemilik->user->nama ?? '-' }}
                    </td>

                    <td style="padding:12px;">
                        {{ $td->roleUser->user->nama ?? '-' }}
                    </td>

                    <td style="padding:12px;">
                        {{ \Carbon\Carbon::parse($td->waktu_daftar)->format('H:i') }}
                    </td>

                    <td style="padding:12px;">
                        @php
                            $st = [
                                'W' => ['Menunggu', '#f59e0b'],
                                'P' => ['Proses',   '#3b82f6'],
                                'S' => ['Selesai',  '#10b981'],
                                'B' => ['Batal',    '#ef4444'],
                            ];
                            $s = $st[$td->status] ?? ['?', '#6b7280'];
                        @endphp

                        <span style="
                            padding:6px 12px;
                            border-radius:12px;
                            font-size:12px;
                            font-weight:600;
                            background:{{ $s[1] }}20;
                            color:{{ $s[1] }};">
                            {{ $s[0] }}
                        </span>
                    </td>

                    <td style="padding:12px; text-align:center;">
                        <div style="display:flex; gap:8px; justify-content:center;">

                            <!-- Edit -->
                            <a href="{{ route('resepsionis.temu-dokter.edit', $td->idreservasi_dokter) }}"
                               class="btn btn-warning" 
                               style="padding:6px 12px; font-size:13px;">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Mulai Proses -->
                            @if($td->status == 'W')
                            <form method="POST" 
                                  action="{{ route('resepsionis.temu-dokter.update-status', [$td->idreservasi_dokter,'P']) }}"
                                  style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-primary"
                                        style="padding:6px 12px; font-size:13px; background:#3b82f6;">
                                    <i class="fas fa-play"></i>
                                </button>
                            </form>
                            @endif

                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @else
    <!-- Empty State -->
    <div style="text-align:center; padding:48px;">
        <i class="fas fa-calendar-times" style="font-size:64px; color:#e5e7eb; margin-bottom:16px;"></i>
        <h3 style="color:#6b7280; margin-bottom:8px;">
            Tidak ada jadwal untuk tanggal ini
        </h3>
        <p style="color:#9ca3af; margin-bottom:24px;">
            Tambahkan jadwal baru untuk pasien
        </p>
        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn btn-success">
            <i class="fas fa-calendar-plus"></i> Buat Jadwal
        </a>
    </div>
    @endif

</div>
@endsection
