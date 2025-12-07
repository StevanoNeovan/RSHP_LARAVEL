@extends('layouts.perawat')
@section('title', 'Rekam Medis')
@section('content')

<div class="card">

    <!-- Header -->
    <div class="section-header">
        <div style="display:flex; align-items:center; gap:12px;">
            <i class="fas fa-file-medical"></i>
            <h3>Daftar Rekam Medis ({{ $rekamMedis->total() }})</h3>
        </div>

        <a href="{{ route('perawat.rekam-medis.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Buat Rekam Medis
        </a>
    </div>

    @if($rekamMedis->count() > 0)
    <div style="display:grid; gap:20px;">

        @foreach($rekamMedis as $rm)
        <div class="card" 
             style="padding:20px; border-left:4px solid #7c3aed; border-radius:10px;">

            <div style="
                display:grid; 
                grid-template-columns:1fr auto; 
                gap:20px;
                align-items:start;
            ">

                <!-- INFO HEWAN -->
                <div>
                    <div style="display:flex; align-items:center; gap:16px; margin-bottom:16px;">
                        <div style="
                            width:50px; height:50px; 
                            border-radius:50%; 
                            background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
                            display:flex; 
                            align-items:center; 
                            justify-content:center; 
                            color:white; 
                            font-size:20px;
                        ">
                            <i class="fas fa-{{ $rm->temuDokter->pet->jenis_kelamin=='M'?'mars':'venus' }}"></i>
                        </div>

                        <div>
                            <h4 style="margin:0 0 4px; font-size:18px; font-weight:700;">
                                {{ $rm->temuDokter->pet->nama }}
                            </h4>
                            <p style="margin:0; font-size:14px; color:#6b7280;">
                                {{ $rm->temuDokter->pet->ras->nama_ras ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <!-- GRID INFORMASI -->
                    <div style="
                        display:grid; 
                        grid-template-columns:repeat(3,1fr); 
                        gap:16px; 
                        margin-bottom:16px; 
                        padding:16px; 
                        background:#f9fafb; 
                        border-radius:8px;
                    ">
                        <div>
                            <div style="font-size:11px; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:4px;">
                                <i class="fas fa-calendar"></i> Tanggal
                            </div>
                            <div style="font-size:14px; font-weight:600;">
                                {{ \Carbon\Carbon::parse($rm->created_at)->format('d M Y') }}
                            </div>
                        </div>

                        <div>
                            <div style="font-size:11px; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:4px;">
                                <i class="fas fa-user"></i> Pemilik
                            </div>
                            <div style="font-size:14px; font-weight:600;">
                                {{ $rm->temuDokter->pet->pemilik->user->nama ?? '-' }}
                            </div>
                        </div>

                        <div>
                            <div style="font-size:11px; color:#6b7280; text-transform:uppercase; font-weight:600; margin-bottom:4px;">
                                <i class="fas fa-user-md"></i> Dokter
                            </div>
                            <div style="font-size:14px; font-weight:600;">
                                {{ $rm->temuDokter->roleUser->user->nama ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <!-- DIAGNOSA -->
                    <div style="
                        padding:12px; 
                        background:#f5eaff; 
                        border-left:3px solid #7c3aed; 
                        border-radius:6px;
                    ">
                        <div style="font-size:11px; color:#7c3aed; text-transform:uppercase; font-weight:700; margin-bottom:4px;">
                            Diagnosa
                        </div>
                        <div style="font-size:14px;">
                            {{ \Illuminate\Support\Str::limit($rm->diagnosa, 150) }}
                        </div>
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div style="
                    display:flex; 
                    flex-direction:column; 
                    gap:8px; 
                    min-width:130px;
                ">
                    <a href="{{ route('perawat.rekam-medis.show', $rm->idrekam_medis) }}" 
                       class="btn btn-primary" 
                       style="justify-content:center;">
                        <i class="fas fa-eye"></i> Detail
                    </a>

                    <a href="{{ route('perawat.rekam-medis.edit', $rm->idrekam_medis) }}" 
                       class="btn btn-warning" 
                       style="justify-content:center;">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <form method="POST" 
                          action="{{ route('perawat.rekam-medis.destroy', $rm->idrekam_medis) }}"
                          onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-danger" 
                                style="justify-content:center; width:100%;">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>

            </div>

        </div>
        @endforeach

    </div>

    <div style="margin-top:20px;">
        {{ $rekamMedis->links() }}
    </div>

    @else

    <!-- EMPTY STATE -->
    <div style="text-align:center; padding:48px;">
        <i class="fas fa-file-medical" 
           style="font-size:64px; color:#e5e7eb; margin-bottom:16px;"></i>

        <h3 style="color:#6b7280; margin-bottom:8px;">Belum Ada Rekam Medis</h3>
        <p style="color:#9ca3af;">Tambahkan rekam medis baru untuk pasien</p>
    </div>

    @endif

</div>

@endsection
