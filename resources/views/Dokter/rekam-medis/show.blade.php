@extends('layouts.dokter')

@section('title', 'Detail Rekam Medis')
@section('page-title', 'Detail Rekam Medis')

@section('content')

<div style="margin-bottom: 20px; display: flex; gap: 12px;">
    <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-primary" style="background: #6b7280;">
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>
    <a href="{{ route('dokter.rekam-medis.edit', $rekamMedis->idrekam_medis) }}" class="btn btn-warning">
        <i class="fas fa-edit"></i>
        Edit Rekam Medis
    </a>
</div>

<!-- Pet & Doctor Info -->
<div class="card">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
        <!-- Pet Info -->
        <div>
            <h3 style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-paw" style="color: #3b82f6;"></i>
                Informasi Pasien
            </h3>
            <div style="display: flex; align-items: center; gap: 16px; padding: 20px; background: #f9fafb; border-radius: 12px;">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); display: flex; align-items: center; justify-content: center; color: white; font-size: 36px;">
                    <i class="fas fa-{{ $rekamMedis->temuDokter->pet->jenis_kelamin == 'M' ? 'mars' : 'venus' }}"></i>
                </div>
                <div>
                    <h4 style="margin: 0 0 8px 0; font-size: 20px; font-weight: 700;">{{ $rekamMedis->temuDokter->pet->nama }}</h4>
                    <p style="margin: 0 0 4px 0; color: #6b7280;">
                        <i class="fas fa-dog"></i> {{ $rekamMedis->temuDokter->pet->ras->jenisHewan->nama_jenis_hewan ?? '-' }}
                    </p>
                    <p style="margin: 0 0 4px 0; color: #6b7280;">
                        <i class="fas fa-dna"></i> {{ $rekamMedis->temuDokter->pet->ras->nama_ras ?? '-' }}
                    </p>
                    <p style="margin: 0; color: #6b7280;">
                        <i class="fas fa-user"></i> {{ $rekamMedis->temuDokter->pet->pemilik->user->nama ?? '-' }}
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Date Info -->
        <div>
            <h3 style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-calendar-alt" style="color: #10b981;"></i>
                Tanggal Pemeriksaan
            </h3>
            <div style="padding: 20px; background: #f9fafb; border-radius: 12px;">
                <div style="margin-bottom: 16px;">
                    <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px; text-transform: uppercase; font-weight: 600;">
                        <i class="fas fa-calendar"></i> Tanggal
                    </div>
                    <div style="font-size: 18px; font-weight: 700; color: #1f2937;">
                        {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d F Y') }}
                    </div>
                </div>
                <div>
                    <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px; text-transform: uppercase; font-weight: 600;">
                        <i class="fas fa-clock"></i> Waktu
                    </div>
                    <div style="font-size: 18px; font-weight: 700; color: #1f2937;">
                        {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('H:i') }} WIB
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Anamnesa -->
<div class="card">
    <h3 style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
        <i class="fas fa-clipboard-list" style="color: #f59e0b;"></i>
        Anamnesa (Keluhan)
    </h3>
    <div style="padding: 16px; background: #fffbeb; border-left: 4px solid #f59e0b; border-radius: 4px;">
        <p style="margin: 0; white-space: pre-wrap; line-height: 1.8;">{{ $rekamMedis->anamnesa }}</p>
    </div>
</div>

<!-- Temuan Klinis -->
<div class="card">
    <h3 style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
        <i class="fas fa-stethoscope" style="color: #3b82f6;"></i>
        Temuan Klinis
    </h3>
    <div style="padding: 16px; background: #dbeafe; border-left: 4px solid #3b82f6; border-radius: 4px;">
        <p style="margin: 0; white-space: pre-wrap; line-height: 1.8;">{{ $rekamMedis->temuan_klinis }}</p>
    </div>
</div>

<!-- Diagnosa -->
<div class="card">
    <h3 style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
        <i class="fas fa-notes-medical" style="color: #10b981;"></i>
        Diagnosa
    </h3>
    <div style="padding: 16px; background: #d1fae5; border-left: 4px solid #10b981; border-radius: 4px;">
        <p style="margin: 0; white-space: pre-wrap; line-height: 1.8;">{{ $rekamMedis->diagnosa }}</p>
    </div>
</div>

<!-- Detail Tindakan/Terapi (CRUD) -->
<div class="card">
    <h3 style="margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
        <i class="fas fa-syringe" style="color: #ef4444;"></i>
        Detail Tindakan & Terapi ({{ $rekamMedis->details->count() }})
    </h3>
    
    <!-- Form ADD Detail -->
    <div style="padding: 24px; background: #f0fdf4; border: 2px dashed #10b981; border-radius: 12px; margin-bottom: 24px;">
        <h4 style="margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px; color: #065f46;">
            <i class="fas fa-plus-circle"></i>
            Tambah Tindakan Baru
        </h4>
        
        <form method="POST" action="{{ route('dokter.rekam-medis.add-detail', $rekamMedis->idrekam_medis) }}">
            @csrf
            <div style="display: grid; gap: 16px;">
                <div>
                    <label style="font-weight: 600; margin-bottom: 8px; display: block; font-size: 14px;">
                        <i class="fas fa-notes-medical"></i> Pilih Tindakan/Terapi *
                    </label>
                    <select name="idkode_tindakan_terapi" required 
                            style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px; background: white;">
                        <option value="">-- Pilih Tindakan --</option>
                        @foreach($kodeTindakan->groupBy('kategori.nama_kategori') as $kategori => $items)
                        <optgroup label="{{ $kategori }}">
                            @foreach($items as $tindakan)
                            <option value="{{ $tindakan->idkode_tindakan_terapi }}">
                                [{{ $tindakan->kode }}] {{ $tindakan->deskripsi_tindakan_terapi }}
                            </option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label style="font-weight: 600; margin-bottom: 8px; display: block; font-size: 14px;">
                        <i class="fas fa-comment-medical"></i> Detail Tambahan (Opsional)
                    </label>
                    <textarea name="detail" rows="3" 
                              style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-family: inherit; font-size: 14px;"
                              placeholder="Contoh: Dosis, frekuensi, catatan khusus, dll..."></textarea>
                </div>
                
                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i>
                        Tambah Tindakan
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <!-- List Details -->
    @if($rekamMedis->details->count() > 0)
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb; text-align: left;">
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb; width: 50px;">No</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb; width: 100px;">Kode</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Deskripsi Tindakan</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Kategori</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Detail</th>
                    <th style="padding: 12px; border-bottom: 2px solid #e5e7eb; text-align: center; width: 80px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekamMedis->details as $index => $detail)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 12px; text-align: center; font-weight: 600;">{{ $index + 1 }}</td>
                    <td style="padding: 12px;">
                        <span style="display: inline-block; padding: 6px 12px; background: #3b82f620; color: #3b82f6; border-radius: 6px; font-weight: 700; font-family: monospace; font-size: 13px;">
                            {{ $detail->tindakan->kode }}
                        </span>
                    </td>
                    <td style="padding: 12px;">
                        <strong style="display: block; margin-bottom: 4px;">{{ $detail->tindakan->deskripsi_tindakan_terapi }}</strong>
                        <div style="display: flex; gap: 8px; margin-top: 8px;">
                            <span style="display: inline-block; padding: 4px 8px; background: #f59e0b20; color: #f59e0b; border-radius: 4px; font-size: 11px; font-weight: 600;">
                                {{ $detail->tindakan->kategori->nama_kategori ?? '-' }}
                            </span>
                            <span style="display: inline-block; padding: 4px 8px; background: #3b82f620; color: #3b82f6; border-radius: 4px; font-size: 11px; font-weight: 600;">
                                {{ $detail->tindakan->kategoriKlinis->nama_kategori_klinis ?? '-' }}
                            </span>
                        </div>
                    </td>
                    <td style="padding: 12px;">
                        <span style="display: inline-block; padding: 4px 10px; background: #10b98120; color: #10b981; border-radius: 4px; font-size: 12px; font-weight: 600;">
                            {{ $detail->tindakan->kategori->nama_kategori ?? '-' }}
                        </span>
                    </td>
                    <td style="padding: 12px;">
                        {{ $detail->detail ?? '-' }}
                    </td>
                    <td style="padding: 12px; text-align: center;">
                        <form method="POST" 
                              action="{{ route('dokter.rekam-medis.remove-detail', [$rekamMedis->idrekam_medis, $detail->iddetail_rekam_medis]) }}" 
                              onsubmit="return confirm('Yakin ingin menghapus tindakan ini?')"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 13px;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div style="text-align: center; padding: 32px; color: #6b7280; background: #f9fafb; border-radius: 8px;">
        <i class="fas fa-info-circle" style="font-size: 48px; margin-bottom: 12px; opacity: 0.5;"></i>
        <p style="margin: 0;">Belum ada detail tindakan/terapi. Gunakan form di atas untuk menambahkan.</p>
    </div>
    @endif
</div>

@endsection