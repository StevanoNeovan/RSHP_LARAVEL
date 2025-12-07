@extends('layouts.perawat')
@section('title', 'Dashboard Perawat')
@section('page-title', 'Dashboard')
@section('content')

<div style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);padding:32px;border-radius:16px;color:white;margin-bottom:32px;box-shadow:0 8px 24px rgba(190, 59, 246, 0.3)">
    <h2 style="font-size:28px;margin-bottom:8px">Selamat Datang, {{ Auth::user()->nama }}! 👨‍⚕️</h2>
    <p style="font-size:16px;opacity:0.95">Bantu dokter dalam mengelola rekam medis dan memberikan perawatan terbaik untuk hewan.</p>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:24px;margin-bottom:32px">
    <div style="background:white;padding:24px;border-radius:12px;border:1px solid #e5e7eb;box-shadow:0 1px 3px rgba(0,0,0,0.1)">
        <div style="width:50px;height:50px;border-radius:12px;background:rgba(59,130,246,0.1);display:flex;align-items:center;justify-content:center;color:#3b82f6;font-size:24px;margin-bottom:16px">
            <i class="fas fa-file-medical"></i>
        </div>
        <div style="font-size:36px;font-weight:700;color:#1f2937;margin-bottom:4px">{{ $total_rekam_medis }}</div>
        <div style="font-size:14px;color:#6b7280">Total Rekam Medis</div>
    </div>
    
    <div style="background:white;padding:24px;border-radius:12px;border:1px solid #e5e7eb;box-shadow:0 1px 3px rgba(0,0,0,0.1)">
        <div style="width:50px;height:50px;border-radius:12px;background:rgba(16,185,129,0.1);display:flex;align-items:center;justify-content:center;color:#10b981;font-size:24px;margin-bottom:16px">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div style="font-size:36px;font-weight:700;color:#1f2937;margin-bottom:4px">{{ $total_reservasi }}</div>
        <div style="font-size:14px;color:#6b7280">Jadwal Hari Ini</div>
    </div>
    
    <div style="background:white;padding:24px;border-radius:12px;border:1px solid #e5e7eb;box-shadow:0 1px 3px rgba(0,0,0,0.1)">
        <div style="width:50px;height:50px;border-radius:12px;background:rgba(245,158,11,0.1);display:flex;align-items:center;justify-content:center;color:#f59e0b;font-size:24px;margin-bottom:16px">
            <i class="fas fa-paw"></i>
        </div>
        <div style="font-size:36px;font-weight:700;color:#1f2937;margin-bottom:4px">{{ $total_pets }}</div>
        <div style="font-size:14px;color:#6b7280">Total Pasien</div>
    </div>
</div>

<div class="card">
    <div class="section-header"><i class="fas fa-bolt"></i><h3>Aksi Cepat</h3></div>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px">
        <a href="{{ route('perawat.rekam-medis.create') }}" class="btn btn-success" style="justify-content:center"><i class="fas fa-plus-circle"></i> Buat Rekam Medis</a>
        <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-primary" style="justify-content:center"><i class="fas fa-file-medical"></i> Lihat Rekam Medis</a>
        <a href="{{ route('perawat.pasien.index') }}" class="btn btn-primary" style="justify-content:center"><i class="fas fa-paw"></i> Data Pasien</a>
    </div>
</div>

@if(isset($recentRekamMedis) && $recentRekamMedis->count() > 0)
<div class="card">
    <div class="section-header"><i class="fas fa-history"></i><h3>Rekam Medis Terbaru</h3></div>
    @foreach($recentRekamMedis as $rm)
    <div style="padding:16px;margin-bottom:12px;background:#f9fafb;border-left:4px solid #7c3aed;border-radius:8px">
        <div style="display:flex;justify-content:space-between;align-items:start">
            <div>
                <strong>{{ $rm->temuDokter->pet->nama }}</strong> - {{ $rm->temuDokter->pet->pemilik->user->nama??'-' }}
                <div style="font-size:13px;color:#6b7280;margin-top:4px">
                    <i class="fas fa-user-md"></i> {{ $rm->temuDokter->roleUser->user->nama??'-' }} • 
                    <i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($rm->created_at)->format('d M Y, H:i') }}
                </div>
            </div>
            <a href="{{ route('perawat.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-primary" style="padding:6px 12px;font-size:13px"><i class="fas fa-eye"></i></a>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection