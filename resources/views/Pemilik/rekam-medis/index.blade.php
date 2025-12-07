@extends('layouts.pemilik')

@section('title', 'Rekam Medis')
@section('page-title', 'Rekam Medis')

@section('content')

<div class="card">
    <div class="section-header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-file-medical"></i>
            <h3>Riwayat Rekam Medis</h3>
        </div>
        <div style="color: #6b7280; font-size: 14px;">
            Total: <strong>{{ $rekamMedis->total() }}</strong> rekam medis
        </div>
    </div>
    
    @if($rekamMedis->count() > 0)
    <div style="display: grid; gap: 20px;">
        @foreach($rekamMedis as $rekam)
        <div class="card" style="padding: 20px; border-left: 4px solid #10b981;">
            <div style="display: grid; grid-template-columns: 1fr auto; gap: 20px; align-items: start;">
                <!-- Left Side: Info -->
                <div>
                    <!-- Pet Info -->
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; color: white; font-size: 20px;">
                            <i class="fas fa-{{ $rekam->temuDokter->pet->jenis_kelamin == 'M' ? 'mars' : 'venus' }}"></i>
                        </div>
                        <div>
                            <h4 style="margin: 0 0 4px 0; font-size: 18px; font-weight: 700;">{{ $rekam->temuDokter->pet->nama }}</h4>
                            <p style="margin: 0; font-size: 14px; color: #6b7280;">{{ $rekam->temuDokter->pet->ras->nama_ras ?? '-' }}</p>
                        </div>
                    </div>
                    
                    <!-- Metadata Grid -->
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 16px; padding: 16px; background: #f9fafb; border-radius: 8px;">
                        <div>
                            <div style="font-size: 11px; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">
                                <i class="fas fa-calendar"></i> Tanggal Pemeriksaan
                            </div>
                            <div style="font-size: 14px; font-weight: 600; color: #1f2937;">
                                {{ \Carbon\Carbon::parse($rekam->created_at)->format('d M Y, H:i') }}
                            </div>
                        </div>
                        <div>
                            <div style="font-size: 11px; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">
                                <i class="fas fa-user-md"></i> Dokter Pemeriksa
                            </div>
                            <div style="font-size: 14px; font-weight: 600; color: #1f2937;">
                                {{ $rekam->temuDokter->roleUser->user->nama ?? '-' }}
                            </div>
                        </div>
                        <div>
                            <div style="font-size: 11px; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">
                                <i class="fas fa-notes-medical"></i> Jumlah Tindakan
                            </div>
                            <div style="font-size: 14px; font-weight: 600; color: #10b981;">
                                {{ $rekam->details->count() }} tindakan/terapi
                            </div>
                        </div>
                        <div>
                            <div style="font-size: 11px; color: #6b7280; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">
                                <i class="fas fa-hashtag"></i> No. Urut
                            </div>
                            <div style="font-size: 14px; font-weight: 600; color: #1f2937;">
                                {{ $rekam->temuDokter->no_urut }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Diagnosa Preview -->
                    <div style="padding: 12px; background: #dbeafe; border-left: 3px solid #3b82f6; border-radius: 4px; margin-bottom: 12px;">
                        <div style="font-size: 11px; color: #1e40af; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">Diagnosa</div>
                        <div style="font-size: 14px; color: #1f2937;">
                            {{ \Illuminate\Support\Str::limit($rekam->diagnosa, 150) }}
                        </div>
                    </div>
                </div>
                
                <!-- Right Side: Action Button -->
                <div style="display: flex; flex-direction: column; gap: 8px; min-width: 150px;">
                    <a href="{{ route('pemilik.rekam-medis.show', $rekam->idrekam_medis) }}" class="btn btn-primary" style="justify-content: center; white-space: nowrap;">
                        <i class="fas fa-eye"></i>
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div style="margin-top: 24px; display: flex; justify-content: center;">
        {{ $rekamMedis->links() }}
    </div>
    @else
    <div style="text-align: center; padding: 48px;">
        <i class="fas fa-file-medical" style="font-size: 64px; color: #e5e7eb; margin-bottom: 16px;"></i>
        <h3 style="color: #6b7280; margin-bottom: 8px;">Belum Ada Rekam Medis</h3>
        <p style="color: #9ca3af;">Rekam medis akan muncul setelah pemeriksaan dokter selesai.</p>
    </div>
    @endif
</div>

@endsection