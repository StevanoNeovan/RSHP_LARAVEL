@extends('layouts.admin')

@section('title', 'Detail Rekam Medis')
@section('page-title', 'Detail Rekam Medis')

@section('content')
<style>
    .detail-container {
        max-width: 1200px;
    }

    .detail-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 32px;
        border-radius: 12px;
        margin-bottom: 24px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .detail-header h1 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .detail-header p {
        opacity: 0.9;
        font-size: 14px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    .detail-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
    }

    .detail-card h3 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--border-color);
    }

    .info-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-size: 13px;
        color: var(--text-light);
        width: 140px;
        flex-shrink: 0;
    }

    .info-value {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
        flex: 1;
    }

    .medical-section {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        margin-bottom: 24px;
    }

    .medical-section h3 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .medical-content {
        background: var(--background-light);
        padding: 16px;
        border-radius: 8px;
        line-height: 1.8;
        font-size: 14px;
        color: var(--text-dark);
    }

    .tindakan-section {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        margin-bottom: 24px;
    }

    .tindakan-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--border-color);
    }

    .tindakan-header h3 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .tindakan-list {
        margin-bottom: 24px;
    }

    .tindakan-item {
        background: var(--background-light);
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: start;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .tindakan-item:hover {
        border-color: var(--primary-color);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .tindakan-info {
        flex: 1;
    }

    .tindakan-code {
        display: inline-block;
        background: var(--primary-color);
        color: white;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .tindakan-name {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 4px;
        font-size: 14px;
    }

    .tindakan-category {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 8px;
    }

    .tindakan-detail {
        font-size: 13px;
        color: var(--text-dark);
        background: white;
        padding: 8px 12px;
        border-radius: 6px;
        margin-top: 8px;
        border-left: 3px solid var(--primary-color);
    }

    .empty-tindakan {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-light);
    }

    .empty-tindakan i {
        font-size: 48px;
        margin-bottom: 12px;
        opacity: 0.3;
    }

    .add-tindakan-form {
        background: var(--background-light);
        padding: 20px;
        border-radius: 8px;
        border: 2px dashed var(--border-color);
    }

    .add-tindakan-form h4 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 16px;
        color: var(--text-dark);
    }

    .form-row {
        display: grid;
        grid-template-columns: 2fr 3fr auto;
        gap: 12px;
        align-items: end;
    }

    .form-group-inline {
        display: flex;
        flex-direction: column;
    }

    .form-group-inline label {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 6px;
    }

    .form-group-inline select,
    .form-group-inline input {
        padding: 10px 12px;
        border: 2px solid var(--border-color);
        border-radius: 6px;
        font-size: 13px;
    }

    .form-group-inline select:focus,
    .form-group-inline input:focus {
        outline: none;
        border-color: var(--primary-color);
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 2px solid var(--border-color);
    }

    @media (max-width: 768px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="detail-container">
    <!-- Header -->
    <div class="detail-header">
        <h1>📋 Rekam Medis - RM-{{ str_pad($rekamMedis->idrekam_medis, 5, '0', STR_PAD_LEFT) }}</h1>
        <p>Dibuat pada {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d M Y, H:i') }}</p>
    </div>

    <!-- Info Pet & Pemilik -->
    <div class="detail-grid">
        <div class="detail-card">
            <h3>
                <i class="fas fa-paw"></i>
                Informasi Pet
            </h3>
            <div class="info-row">
                <span class="info-label">Nama Pet</span>
                <span class="info-value">{{ $rekamMedis->temuDokter->pet->nama }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Ras</span>
                <span class="info-value">{{ $rekamMedis->temuDokter->pet->ras->nama_ras }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Jenis</span>
                <span class="info-value">{{ $rekamMedis->temuDokter->pet->ras->jenisHewan->nama_jenis_hewan }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Umur</span>
                <span class="info-value">{{ App\Http\Controllers\Admin\PetController::calculateAge($rekamMedis->temuDokter->pet->tanggal_lahir) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Jenis Kelamin</span>
                <span class="info-value">
                    @if($rekamMedis->temuDokter->pet->jenis_kelamin == 'M')
                        <i class="fas fa-mars" style="color: #3b82f6;"></i> Jantan
                    @else
                        <i class="fas fa-venus" style="color: #ec4899;"></i> Betina
                    @endif
                </span>
            </div>
        </div>

        <div class="detail-card">
            <h3>
                <i class="fas fa-user"></i>
                Informasi Pemilik & Dokter
            </h3>
            <div class="info-row">
                <span class="info-label">Nama Pemilik</span>
                <span class="info-value">{{ $rekamMedis->temuDokter->pet->pemilik->user->nama }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">No. WhatsApp</span>
                <span class="info-value">{{ $rekamMedis->temuDokter->pet->pemilik->no_wa }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Alamat</span>
                <span class="info-value">{{ $rekamMedis->temuDokter->pet->pemilik->alamat }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Dokter Pemeriksa</span>
                <span class="info-value">{{ $rekamMedis->temuDokter->roleUser->user->nama }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">No. Antrian</span>
                <span class="info-value">{{ str_pad($rekamMedis->temuDokter->no_urut, 3, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>
    </div>

    <!-- Anamnesa -->
    <div class="medical-section">
        <h3>
            <i class="fas fa-clipboard-list"></i>
            Anamnesa (Keluhan & Riwayat)
        </h3>
        <div class="medical-content">
            {{ $rekamMedis->anamnesa }}
        </div>
    </div>

    <!-- Temuan Klinis -->
    <div class="medical-section">
        <h3>
            <i class="fas fa-stethoscope"></i>
            Temuan Klinis
        </h3>
        <div class="medical-content">
            {{ $rekamMedis->temuan_klinis }}
        </div>
    </div>

    <!-- Diagnosa -->
    <div class="medical-section">
        <h3>
            <i class="fas fa-diagnoses"></i>
            Diagnosa
        </h3>
        <div class="medical-content">
            {{ $rekamMedis->diagnosa }}
        </div>
    </div>

    <!-- Detail Tindakan -->
    <div class="tindakan-section">
        <div class="tindakan-header">
            <h3>
                <i class="fas fa-notes-medical"></i>
                Detail Tindakan & Terapi ({{ $rekamMedis->details->count() }})
            </h3>
        </div>

        <!-- List Tindakan -->
        <div class="tindakan-list">
            @forelse($rekamMedis->details as $detail)
                <div class="tindakan-item">
                    <div class="tindakan-info">
                        <span class="tindakan-code">{{ $detail->tindakan->kode }}</span>
                        <div class="tindakan-name">{{ $detail->tindakan->deskripsi_tindakan_terapi }}</div>
                        <div class="tindakan-category">
                            <i class="fas fa-tag"></i> {{ $detail->tindakan->kategori->nama_kategori }} 
                            | <i class="fas fa-stethoscope"></i> {{ $detail->tindakan->kategoriKlinis->nama_kategori_klinis }}
                        </div>
                        @if($detail->detail)
                            <div class="tindakan-detail">
                                <strong>Keterangan:</strong> {{ $detail->detail }}
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('admin.rekam-medis.remove-detail', ['id' => $rekamMedis->idrekam_medis, 'detailId' => $detail->iddetail_rekam_medis]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tindakan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div class="empty-tindakan">
                    <i class="fas fa-notes-medical"></i>
                    <p>Belum ada detail tindakan. Silakan tambahkan tindakan/terapi di bawah.</p>
                </div>
            @endforelse
        </div>

        <!-- Form Tambah Tindakan -->
        <div class="add-tindakan-form">
            <h4><i class="fas fa-plus-circle"></i> Tambah Tindakan / Terapi</h4>
            <form action="{{ route('admin.rekam-medis.add-detail', $rekamMedis->idrekam_medis) }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group-inline">
                        <label>Kode Tindakan</label>
                        <select name="idkode_tindakan_terapi" id="tindakanSelect" required>
                            <option value="">-- Pilih Tindakan --</option>
                            @foreach($kodeTindakan as $kt)
                                <option value="{{ $kt->idkode_tindakan_terapi }}">
                                    {{ $kt->kode }} - {{ $kt->deskripsi_tindakan_terapi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group-inline">
                        <label>Keterangan Detail (Opsional)</label>
                        <input type="text" name="detail" placeholder="Contoh: Dosis 2x sehari, Dilakukan anastesi lokal...">
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('admin.rekam-medis.edit', $rekamMedis->idrekam_medis) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i>
            Edit Rekam Medis
        </a>
        <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i>
            Kembali ke List
        </a>
        <form action="{{ route('admin.rekam-medis.destroy', $rekamMedis->idrekam_medis) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus rekam medis ini? Semua detail tindakan akan ikut terhapus.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i>
                Hapus Rekam Medis
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Optional: Add search functionality for tindakan select
    const tindakanSelect = document.getElementById('tindakanSelect');
    
    // You can add autocomplete or search functionality here if needed
</script>
@endpush