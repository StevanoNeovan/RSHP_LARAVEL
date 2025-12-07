@extends('layouts.dokter')

@section('title', 'Profil Dokter')
@section('page-title', 'Profil Saya')

@section('content')

<div class="card">
    <div class="section-header">
        <i class="fas fa-user-md"></i>
        <h3>Informasi Dokter</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: 200px 1fr; gap: 32px; align-items: start;">
        <!-- Avatar -->
        <div style="text-align: center;">
            <div style="width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); display: flex; align-items: center; justify-content: center; color: white; font-size: 64px; font-weight: 700; margin: 0 auto 16px; border: 5px solid #e5e7eb;">
                {{ strtoupper(substr($user->nama, 0, 1)) }}
            </div>
            <h3 style="margin: 0; font-size: 20px; font-weight: 700;">{{ $user->nama }}</h3>
            <p style="color: #6b7280; font-size: 14px; margin-top: 4px;">Dokter Hewan</p>
            
            <div style="margin-top: 16px; padding: 12px; background: #dbeafe; border-radius: 8px;">
                <div style="font-size: 11px; color: #1e40af; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Status</div>
                <div style="font-size: 14px; font-weight: 700; color: #1e40af;">
                    @if($roleUser->status == 1)
                        <i class="fas fa-check-circle"></i> Aktif
                    @else
                        <i class="fas fa-times-circle"></i> Non-Aktif
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Info Details -->
        <div>
            <table style="width: 100%; border-collapse: collapse;">
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; width: 200px; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-user" style="width: 20px;"></i> Nama Lengkap
                    </td>
                    <td style="padding: 16px 0; font-size: 16px; font-weight: 600;">{{ $user->nama }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-envelope" style="width: 20px;"></i> Email
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">{{ $user->email }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-user-tag" style="width: 20px;"></i> Role
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">{{ $roleUser->role->nama_role ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-id-badge" style="width: 20px;"></i> ID Role User
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">
                        <span style="display: inline-block; padding: 4px 12px; background: #3b82f620; color: #3b82f6; border-radius: 6px; font-weight: 700; font-family: monospace;">
                            #{{ $roleUser->idrole_user }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
    
    <!-- Total Rekam Medis -->
    <div class="card" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Total Rekam Medis</div>
                <div style="font-size: 48px; font-weight: 700; margin-bottom: 8px;">{{ $total_rekam_medis }}</div>
                <div style="font-size: 13px; opacity: 0.9;">Semua waktu</div>
            </div>
            <div style="font-size: 64px; opacity: 0.2;">
                <i class="fas fa-file-medical"></i>
            </div>
        </div>
    </div>
    
    <!-- Rekam Medis Bulan Ini -->
    <div class="card" style="background: linear-gradient(135deg, #10b981, #059669); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Bulan Ini</div>
                <div style="font-size: 48px; font-weight: 700; margin-bottom: 8px;">{{ $rekam_medis_bulan_ini }}</div>
                <div style="font-size: 13px; opacity: 0.9;">{{ now()->format('F Y') }}</div>
            </div>
            <div style="font-size: 64px; opacity: 0.2;">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>

    <!-- Performance Badge -->
    <div class="card" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white;">
        <div style="text-align: center; padding: 20px 0;">
            <i class="fas fa-award" style="font-size: 48px; margin-bottom: 12px; opacity: 0.9;"></i>
            <div style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Performance Rating</div>
            <div style="font-size: 32px; font-weight: 700;">
                @php
                    $rating = $total_rekam_medis >= 100 ? 'Excellent' : 
                              ($total_rekam_medis >= 50 ? 'Good' : 
                              ($total_rekam_medis >= 10 ? 'Fair' : 'Getting Started'));
                @endphp
                {{ $rating }}
            </div>
        </div>
    </div>

</div>

<!-- Activity Info -->
<div class="card">
    <div class="section-header">
        <i class="fas fa-chart-line"></i>
        <h3>Aktivitas Profesional</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
        <div style="padding: 20px; background: #f9fafb; border-radius: 12px; text-align: center;">
            <i class="fas fa-stethoscope" style="font-size: 32px; color: #3b82f6; margin-bottom: 12px;"></i>
            <div style="font-size: 28px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">{{ $total_rekam_medis }}</div>
            <div style="font-size: 13px; color: #6b7280; font-weight: 600;">Pasien Ditangani</div>
        </div>
        
        <div style="padding: 20px; background: #f9fafb; border-radius: 12px; text-align: center;">
            <i class="fas fa-clock" style="font-size: 32px; color: #10b981; margin-bottom: 12px;"></i>
            <div style="font-size: 28px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">
                {{ $roleUser->created_at ? \Carbon\Carbon::parse($roleUser->created_at)->diffInMonths(now()) : 0 }}
            </div>
            <div style="font-size: 13px; color: #6b7280; font-weight: 600;">Bulan Pengalaman</div>
        </div>
        
        <div style="padding: 20px; background: #f9fafb; border-radius: 12px; text-align: center;">
            <i class="fas fa-calendar" style="font-size: 32px; color: #f59e0b; margin-bottom: 12px;"></i>
            <div style="font-size: 28px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">{{ $rekam_medis_bulan_ini }}</div>
            <div style="font-size: 13px; color: #6b7280; font-weight: 600;">Aktivitas Bulan Ini</div>
        </div>
        
        <div style="padding: 20px; background: #f9fafb; border-radius: 12px; text-align: center;">
            <i class="fas fa-user-check" style="font-size: 32px; color: #10b981; margin-bottom: 12px;"></i>
            <div style="font-size: 28px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">
                {{ $roleUser->status == 1 ? 'Aktif' : 'Non-Aktif' }}
            </div>
            <div style="font-size: 13px; color: #6b7280; font-weight: 600;">Status Akun</div>
        </div>
    </div>
</div>

<!-- Professional Note -->
<div class="card" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white;">
    <div style="display: flex; align-items: start; gap: 20px;">
        <div style="font-size: 48px; opacity: 0.3;">
            <i class="fas fa-user-md"></i>
        </div>
        <div>
            <h3 style="margin-bottom: 12px; font-size: 20px;">
                <i class="fas fa-quote-left"></i>
                Komitmen Profesional
            </h3>
            <p style="line-height: 1.8; opacity: 0.95; margin: 0;">
                Sebagai dokter hewan, tanggung jawab utama adalah memberikan pelayanan kesehatan terbaik untuk setiap pasien. 
                Terus tingkatkan keahlian dan dedikasi dalam merawat hewan kesayangan pemilik yang mempercayakan kepada kita.
            </p>
        </div>
    </div>
</div>

@endsection