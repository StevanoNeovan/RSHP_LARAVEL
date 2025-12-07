@extends('layouts.perawat')
@section('title', 'Detail Pasien')
@section('content')

<a href="{{ route('perawat.pasien.index') }}" class="btn btn-primary" style="background:#6b7280;margin-bottom:20px"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div style="display:grid;grid-template-columns:200px 1fr;gap:32px">
        <div style="text-align:center">
            <div style="width:180px;height:180px;border-radius:50%;background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);display:flex;align-items:center;justify-content:center;color:white;font-size:80px;margin:0 auto 16px;border:6px solid #e5e7eb">
                <i class="fas fa-{{ $pasien->jenis_kelamin=='M'?'mars':'venus' }}"></i>
            </div>
            <h2 style="margin:0 0 8px;font-size:28px;font-weight:700">{{ $pasien->nama }}</h2>
            <p style="color:#6b7280;font-size:16px">{{ $pasien->ras->nama_ras??'-' }}</p>
        </div>
        
        <div>
            <h3 style="margin-bottom:20px"><i class="fas fa-info-circle" style="color:#7c3aed"></i> Informasi Pasien</h3>
            <table style="width:100%;border-collapse:collapse">
                <tr style="border-bottom:1px solid #e5e7eb">
                    <td style="padding:16px 0;width:200px;font-weight:600;color:#6b7280"><i class="fas fa-dog"></i> Jenis Hewan</td>
                    <td style="padding:16px 0">{{ $pasien->ras->jenisHewan->nama_jenis_hewan??'-' }}</td>
                </tr>
                <tr style="border-bottom:1px solid #e5e7eb">
                    <td style="padding:16px 0;font-weight:600;color:#6b7280"><i class="fas fa-birthday-cake"></i> Tanggal Lahir</td>
                    <td style="padding:16px 0">{{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d F Y') }} ({{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->age }} tahun)</td>
                </tr>
                <tr style="border-bottom:1px solid #e5e7eb">
                    <td style="padding:16px 0;font-weight:600;color:#6b7280"><i class="fas fa-palette"></i> Warna/Tanda</td>
                    <td style="padding:16px 0">{{ $pasien->warna_tanda }}</td>
                </tr>
                <tr>
                    <td style="padding:16px 0;font-weight:600;color:#6b7280"><i class="fas fa-user"></i> Pemilik</td>
                    <td style="padding:16px 0;font-weight:600;color:#7c3aed">{{ $pasien->pemilik->user->nama??'-' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="section-header"><i class="fas fa-file-medical"></i><h3>Riwayat Rekam Medis ({{ $rekamMedisList->count() }})</h3></div>
    
    @if($rekamMedisList->count() > 0)
    <div style="display:grid;gap:16px">
        @foreach($rekamMedisList as $rm)
        <div class="card" style="padding:20px;border-left:4px solid #7c3aed">
            <div style="margin-bottom:12px"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($rm->created_at)->format('d M Y, H:i') }} • <i class="fas fa-user-md"></i> {{ $rm->temuDokter->roleUser->user->nama??'-' }}</div>
            <div style="padding:12px;background:#f3dbfe;border-left:3px solid #7c3aed;border-radius:4px;margin-bottom:8px">
                <div style="font-size:11px;color:#811eaf;text-transform:uppercase;font-weight:600;margin-bottom:4px">Diagnosa</div>
                <div style="font-size:14px;color:#1f2937">{{ \Illuminate\Support\Str::limit($rm->diagnosa,200) }}</div>
            </div>
            <a href="{{ route('perawat.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-primary" style="padding:8px 16px;font-size:13px"><i class="fas fa-eye"></i> Lihat Detail</a>
        </div>
        @endforeach
    </div>
    @else
    <div style="text-align:center;padding:48px;color:#6b7280"><i class="fas fa-file-medical" style="font-size:64px;margin-bottom:16px;opacity:0.3"></i><h3>Belum Ada Rekam Medis</h3></div>
    @endif
</div>

@endsection