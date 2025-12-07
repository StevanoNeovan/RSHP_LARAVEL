@extends('layouts.perawat')
@section('title', 'Detail Rekam Medis')
@section('content')

<div style="margin-bottom:20px;display:flex;gap:12px">
    <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-primary" style="background:#6b7280"><i class="fas fa-arrow-left"></i> Kembali</a>
    <a href="{{ route('perawat.rekam-medis.edit', $rekamMedis->idrekam_medis) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
    <form method="POST" action="{{ route('perawat.rekam-medis.destroy', $rekamMedis->idrekam_medis) }}" onsubmit="return confirm('Yakin hapus rekam medis ini?')" style="display:inline">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
    </form>
</div>

<div class="card">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px">
        <div>
            <h3 style="margin-bottom:16px"><i class="fas fa-paw" style="color:#7c3aed"></i> Informasi Pasien</h3>
            <div style="display:flex;align-items:center;gap:16px;padding:20px;background:#f9fafb;border-radius:12px">
                <div style="width:80px;height:80px;border-radius:50%;background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);display:flex;align-items:center;justify-content:center;color:white;font-size:36px">
                    <i class="fas fa-{{ $rekamMedis->temuDokter->pet->jenis_kelamin=='M'?'mars':'venus' }}"></i>
                </div>
                <div>
                    <h4 style="margin:0 0 8px;font-size:20px;font-weight:700">{{ $rekamMedis->temuDokter->pet->nama }}</h4>
                    <p style="margin:0;color:#6b7280"><i class="fas fa-dog"></i> {{ $rekamMedis->temuDokter->pet->ras->jenisHewan->nama_jenis_hewan??'-' }}</p>
                    <p style="margin:4px 0 0;color:#6b7280"><i class="fas fa-user"></i> {{ $rekamMedis->temuDokter->pet->pemilik->user->nama??'-' }}</p>
                </div>
            </div>
        </div>
        
        <div>
            <h3 style="margin-bottom:16px"><i class="fas fa-calendar-alt" style="color:#7c3aed"></i> Tanggal Pemeriksaan</h3>
            <div style="padding:20px;background:#f9fafb;border-radius:12px">
                <div style="margin-bottom:16px">
                    <div style="font-size:12px;color:#6b7280;margin-bottom:4px"><i class="fas fa-calendar"></i> Tanggal</div>
                    <div style="font-size:18px;font-weight:700">{{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d F Y') }}</div>
                </div>
                <div style="margin-bottom:16px">
                    <div style="font-size:12px;color:#6b7280;margin-bottom:4px"><i class="fas fa-clock"></i> Waktu</div>
                    <div style="font-size:18px;font-weight:700">{{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('H:i') }} WIB</div>
                </div>
                <div>
                    <div style="font-size:12px;color:#6b7280;margin-bottom:4px"><i class="fas fa-user-md"></i> Dokter</div>
                    <div style="font-size:16px;font-weight:600">{{ $rekamMedis->temuDokter->roleUser->user->nama??'-' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h3 style="margin-bottom:16px"><i class="fas fa-clipboard-list" style="color:#f59e0b"></i> Anamnesa</h3>
    <div style="padding:16px;background:#fffbeb;border-left:4px solid #f59e0b;border-radius:4px">
        <p style="margin:0;white-space:pre-wrap;line-height:1.8">{{ $rekamMedis->anamnesa }}</p>
    </div>
</div>

<div class="card">
    <h3 style="margin-bottom:16px"><i class="fas fa-stethoscope" style="color:#3b82f6"></i> Temuan Klinis</h3>
    <div style="padding:16px;background:#dbeafe;border-left:4px solid #3b82f6;border-radius:4px">
        <p style="margin:0;white-space:pre-wrap;line-height:1.8">{{ $rekamMedis->temuan_klinis }}</p>
    </div>
</div>

<div class="card">
    <h3 style="margin-bottom:16px"><i class="fas fa-notes-medical" style="color:#10b981"></i> Diagnosa</h3>
    <div style="padding:16px;background:#d1fae5;border-left:4px solid #10b981;border-radius:4px">
        <p style="margin:0;white-space:pre-wrap;line-height:1.8">{{ $rekamMedis->diagnosa }}</p>
    </div>
</div>

<!-- Detail Tindakan with CRUD -->
<div class="card">
    <h3 style="margin-bottom:20px"><i class="fas fa-syringe" style="color:#ef4444"></i> Detail Tindakan & Terapi ({{ $rekamMedis->details->count() }})</h3>
    
    @if($rekamMedis->details->count() > 0)
    <div style="overflow-x:auto;margin-bottom:24px">
        <table style="width:100%;border-collapse:collapse">
            <thead>
                <tr style="background:#f9fafb;text-align:left">
                    <th style="padding:12px;border-bottom:2px solid #e5e7eb">No</th>
                    <th style="padding:12px;border-bottom:2px solid #e5e7eb">Kode</th>
                    <th style="padding:12px;border-bottom:2px solid #e5e7eb">Deskripsi</th>
                    <th style="padding:12px;border-bottom:2px solid #e5e7eb">Detail</th>
                    <th style="padding:12px;border-bottom:2px solid #e5e7eb;text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekamMedis->details as $i => $d)
                <tr style="border-bottom:1px solid #e5e7eb">
                    <td style="padding:12px;text-align:center;font-weight:600">{{ $i+1 }}</td>
                    <td style="padding:12px"><span style="padding:6px 12px;background:#10b98120;color:#10b981;border-radius:6px;font-weight:700">{{ $d->tindakan->kode }}</span></td>
                    <td style="padding:12px"><strong>{{ $d->tindakan->deskripsi_tindakan_terapi }}</strong></td>
                    <td style="padding:12px">{{ $d->detail??'-' }}</td>
                    <td style="padding:12px;text-align:center">
                        <form method="POST" action="{{ route('perawat.rekam-medis.remove-detail', [$rekamMedis->idrekam_medis, $d->iddetail_rekam_medis]) }}" onsubmit="return confirm('Yakin hapus?')" style="display:inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding:6px 12px;font-size:13px"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    
    <!-- Add Detail Form -->
    <div style="padding:24px;background:#f0fdf4;border:2px dashed #10b981;border-radius:12px">
        <h4 style="margin:0 0 16px;color:#065f46"><i class="fas fa-plus-circle"></i> Tambah Tindakan Baru</h4>
        <form method="POST" action="{{ route('perawat.rekam-medis.add-detail', $rekamMedis->idrekam_medis) }}">
            @csrf
            <div style="display:grid;gap:16px">
                <div>
                    <label style="font-weight:600;margin-bottom:8px;display:block;font-size:14px">Pilih Tindakan *</label>
                    <select name="idkode_tindakan_terapi" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach(\App\Models\KodeTindakanTerapi::with(['kategori','kategoriKlinis'])->get()->groupBy('kategori.nama_kategori') as $kat => $items)
                        <optgroup label="{{ $kat }}">
                            @foreach($items as $t)
                            <option value="{{ $t->idkode_tindakan_terapi }}">[{{ $t->kode }}] {{ $t->deskripsi_tindakan_terapi }}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="font-weight:600;margin-bottom:8px;display:block;font-size:14px">Detail Tambahan</label>
                    <textarea name="detail" rows="3" class="form-control" placeholder="Dosis, frekuensi, catatan..."></textarea>
                </div>
                <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</button>
            </div>
        </form>
    </div>
</div>

@endsection