@extends('layouts.pemilik')

@section('title', 'Detail Pet')
@section('page-title', 'Detail Pet')

@section('content')

<div style="margin-bottom: 20px;">
    <a href="{{ route('pemilik.pets.index') }}" class="btn btn-primary" style="background: #6b7280;">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Pet
    </a>
</div>

<!-- Pet Profile Card -->
<div class="card">
    <div style="display: grid; grid-template-columns: 200px 1fr; gap: 32px; align-items: start;">
        <!-- Avatar -->
        <div style="text-align: center;">
            <div style="width: 180px; height: 180px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; color: white; font-size: 80px; font-weight: 700; margin: 0 auto 16px; border: 6px solid #e5e7eb; box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);">
                <i class="fas fa-{{ $pet->jenis_kelamin == 'M' ? 'mars' : 'venus' }}"></i>
            </div>
            <h2 style="margin: 0 0 8px 0; font-size: 28px; font-weight: 700;">{{ $pet->nama }}</h2>
            <p style="color: #6b7280; font-size: 16px; margin: 0;">{{ $pet->ras->nama_ras ?? '-' }}</p>
            
            <!-- Gender Badge -->
            <div style="margin-top: 16px;">
                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; background: {{ $pet->jenis_kelamin == 'M' ? '#3b82f620' : '#ec489920' }}; color: {{ $pet->jenis_kelamin == 'M' ? '#3b82f6' : '#ec4899' }};">
                    <i class="fas fa-{{ $pet->jenis_kelamin == 'M' ? 'male' : 'female' }}"></i>
                    {{ $pet->jenis_kelamin == 'M' ? 'Jantan' : 'Betina' }}
                </span>
            </div>
        </div>
        
        <!-- Pet Info Details -->
        <div>
            <h3 style="margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-info-circle" style="color: #10b981;"></i>
                Informasi Lengkap
            </h3>
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; width: 200px; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-paw" style="width: 20px;"></i> Nama Lengkap
                    </td>
                    <td style="padding: 16px 0; font-size: 16px; font-weight: 600;">{{ $pet->nama }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-dog" style="width: 20px;"></i> Jenis Hewan
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">{{ $pet->ras->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-dna" style="width: 20px;"></i> Ras
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">{{ $pet->ras->nama_ras ?? '-' }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-birthday-cake" style="width: 20px;"></i> Tanggal Lahir
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">
                        {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d F Y') }}
                        <span style="color: #6b7280; font-size: 14px; margin-left: 8px;">
                            ({{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} tahun)
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-{{ $pet->jenis_kelamin == 'M' ? 'male' : 'female' }}" style="width: 20px;"></i> Jenis Kelamin
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">
                        <span style="display: inline-flex; align-items: center; gap: 6px; color: {{ $pet->jenis_kelamin == 'M' ? '#3b82f6' : '#ec4899' }}; font-weight: 600;">
                            <i class="fas fa-{{ $pet->jenis_kelamin == 'M' ? 'male' : 'female' }}"></i>
                            {{ $pet->jenis_kelamin == 'M' ? 'Jantan' : 'Betina' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280; vertical-align: top;">
                        <i class="fas fa-palette" style="width: 20px;"></i> Warna/Tanda Khusus
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">{{ $pet->warna_tanda }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 24px;">
    <!-- Total Temu Dokter -->
    <div class="card" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Total Temu Dokter</div>
                <div style="font-size: 36px; font-weight: 700;">{{ $temuDokterList->count() }}</div>
            </div>
            <div style="font-size: 48px; opacity: 0.3;">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>
    
    <!-- Umur -->
    <div class="card" style="background: linear-gradient(135deg, #10b981, #059669); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Umur</div>
                <div style="font-size: 36px; font-weight: 700;">{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }}</div>
                <div style="font-size: 14px; opacity: 0.9;">tahun</div>
            </div>
            <div style="font-size: 48px; opacity: 0.3;">
                <i class="fas fa-birthday-cake"></i>
            </div>
        </div>
    </div>
    
    <!-- Status Kesehatan -->
    <div class="card" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Status Terakhir</div>
                <div style="font-size: 20px; font-weight: 600;">
                    @if($rekamMedisList->count() > 0)
                        Terpantau
                    @else
                        Belum Ada Data
                    @endif
                </div>
            </div>
            <div style="font-size: 48px; opacity: 0.3;">
                <i class="fas fa-heartbeat"></i>
            </div>
        </div>
    </div>
</div>

<!-- Riwayat Rekam Medis -->
<div class="card">
    <div class="section-header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-file-medical"></i>
            <h3>Riwayat Rekam Medis ({{ $rekamMedisList->count() }})</h3>
        </div>
    </div>
    
    @if($rekamMedisList->count() > 0)
    <div style="display: grid; gap: 16px;">
        @foreach($rekamMedisList as $rekam)
        <div class="card" style="padding: 20px; border-left: 4px solid #10b981; transition: all 0.3s ease;" 
             onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'"
             onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
            
            <div style="display: grid; grid-template-columns: 1fr auto; gap: 20px; align-items: start;">
                <!-- Info -->
                <div>
                    <!-- Date & Doctor -->
                    <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 12px; flex-wrap: wrap;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-calendar" style="color: #6b7280;"></i>
                            <strong style="color: #1f2937;">{{ \Carbon\Carbon::parse($rekam->created_at)->format('d M Y, H:i') }}</strong>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-user-md" style="color: #6b7280;"></i>
                            <span style="color: #6b7280;">{{ $rekam->temuDokter->roleUser->user->nama ?? '-' }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-hashtag" style="color: #6b7280;"></i>
                            <span style="padding: 4px 10px; background: #10b98120; color: #10b981; border-radius: 6px; font-weight: 700; font-size: 12px;">
                                No. {{ $rekam->temuDokter->no_urut }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Diagnosa Preview -->
                    <div style="padding: 12px; background: #dbeafe; border-left: 3px solid #3b82f6; border-radius: 4px; margin-bottom: 8px;">
                        <div style="font-size: 11px; color: #1e40af; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">Diagnosa</div>
                        <div style="font-size: 14px; color: #1f2937;">
                            {{ \Illuminate\Support\Str::limit($rekam->diagnosa, 200) }}
                        </div>
                    </div>
                    
                    <!-- Tindakan Count -->
                    <div style="display: flex; align-items: center; gap: 8px; color: #6b7280; font-size: 14px;">
                        <i class="fas fa-syringe"></i>
                        <span>{{ $rekam->details->count() }} tindakan/terapi</span>
                    </div>
                </div>
                
                <!-- Action Button -->
                <div>
                    <a href="{{ route('pemilik.rekam-medis.show', $rekam->idrekam_medis) }}" class="btn btn-primary" style="white-space: nowrap;">
                        <i class="fas fa-eye"></i>
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div style="text-align: center; padding: 48px; color: #6b7280;">
        <i class="fas fa-file-medical" style="font-size: 64px; margin-bottom: 16px; opacity: 0.3;"></i>
        <h3 style="margin-bottom: 8px;">Belum Ada Rekam Medis</h3>
        <p style="color: #9ca3af;">Rekam medis akan muncul setelah pemeriksaan dokter selesai.</p>
    </div>
    @endif
</div>

<!-- Health Tips Card -->
<div class="card" style="background: linear-gradient(135deg, #10b981, #059669); color: white;">
    <div style="display: flex; align-items: start; gap: 20px;">
        <div style="font-size: 48px; opacity: 0.3;">
            <i class="fas fa-heartbeat"></i>
        </div>
        <div>
            <h3 style="margin-bottom: 12px; font-size: 20px;">
                <i class="fas fa-lightbulb"></i>
                Tips Kesehatan untuk {{ $pet->nama }}
            </h3>
            <ul style="list-style: none; padding: 0; margin: 0; line-height: 2;">
                <li><i class="fas fa-check-circle"></i> Berikan makanan bergizi seimbang sesuai usia</li>
                <li><i class="fas fa-check-circle"></i> Pastikan vaksinasi rutin terjadwal</li>
                <li><i class="fas fa-check-circle"></i> Cek kesehatan minimal 6 bulan sekali</li>
                <li><i class="fas fa-check-circle"></i> Jaga kebersihan dan aktivitas fisik</li>
            </ul>
        </div>
    </div>
</div>

@endsection