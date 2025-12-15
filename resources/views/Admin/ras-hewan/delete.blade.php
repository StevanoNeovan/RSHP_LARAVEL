@extends('layouts.admin')

@section('title', 'Hapus Ras Hewan')
@section('page-title', 'Hapus Ras Hewan')

@section('content')
<style>
    :root {
        --danger-red:#dc2626;
        --danger-light:#fee2e2;
        --danger-border:#fca5a5;
        --neutral-bg:#f9fafb;
        --neutral-border:#e5e7eb;
        --text-dark:#1f2937;
        --text-light:#6b7280;
    }

    .form-container {
        max-width: 760px;
        margin: 0 auto;
    }

    .form-card {
        background: #fff;
        border-radius: 14px;
        padding: 32px;
        border: 1px solid var(--neutral-border);
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }

    .form-card-header {
        border-bottom: 1px solid var(--neutral-border);
        padding-bottom: 20px;
        margin-bottom: 26px;
    }

    .form-card-header h3 {
        font-size: 21px;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-card-header h3 i {
        color: var(--danger-red);
        font-size: 22px;
    }

    .form-card-header p {
        margin-top: 6px;
        color: var(--text-light);
        font-size: 14px;
    }

    .warning-box {
        background: var(--danger-light);
        border: 1px solid var(--danger-border);
        padding: 18px;
        border-radius: 10px;
        display: flex;
        gap: 14px;
        align-items: start;
        margin-bottom: 26px;
    }

    .warning-box i {
        font-size: 24px;
        color: var(--danger-red);
        margin-top: 2px;
    }

    .form-group {
    margin-bottom: 22px;
}

.form-label {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    display:block;
    color: var(--text-dark);
}

.required {
    color: var(--danger-red);
}

.form-input,
.form-select {
    width: 100%;
    padding: 12px 14px;
    border-radius: 8px;
    border: 1.8px solid var(--neutral-border);
    font-size: 14px;
    transition: 0.25s;
}

.form-select:focus,
.form-input:focus {
    border-color: var(--danger-red);
    box-shadow: 0 0 0 3px rgba(220,38,38,0.12);
    outline: none;
}

.form-help {
    font-size: 12px;
    margin-top: 6px;
    color: var(--text-light);
}

.form-error {
    font-size: 12px;
    margin-top: 5px;
    color: var(--danger-red);
}

.preview-card {
    background: #fff;
    border: 1px solid var(--danger-border);
    border-radius: 10px;
    padding: 18px 20px;
    margin-top: 16px;
    display: none;
}

.preview-card.active {
    display: block;
}

.preview-card h4 {
    font-size: 15px;
    font-weight: 600;
    color: var(--danger-red);
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.preview-info {
    display: grid;
    grid-template-columns: 160px 1fr;
    gap: 10px 12px;
}

.preview-label {
    color: var(--text-light);
    font-size: 13px;
}

.preview-value {
    font-weight: 600;
    color: var(--text-dark);
    font-size: 14px;
}

.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 30px;
    border-top: 1px solid var(--neutral-border);
    padding-top: 22px;
}

.btn-danger {
    background: var(--danger-red) !important;
    border: none;
}

.btn-secondary {
    background: var(--neutral-bg);
    border: 1px solid var(--neutral-border);
    color: var(--text-dark);
}

.btn-secondary:hover {
    background: var(--neutral-border);
}

.empty-state {
    text-align: center;
    padding: 40px 20px;
}

.empty-state i {
    font-size: 50px;
    opacity: 0.25;
}

.filter-tabs {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.filter-tab {
    padding: 8px 16px;
    background: white;
    border: 2px solid var(--neutral-border);
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    color: var(--text-dark);
}

.filter-tab:hover {
    background: var(--neutral-bg);
    border-color: var(--danger-red);
}

.filter-tab.active {
    background: var(--danger-red);
    color: white;
    border-color: var(--danger-red);
}

</style>
<div class="form-container">
    <div class="form-card">
        <!-- HEADER -->
    <div class="form-card-header">
        <h3><i class="fas fa-trash-alt"></i> Hapus Ras Hewan - {{ $jenisHewan->nama_jenis_hewan }}</h3>
        <p>Pilih ras dari <strong>{{ $jenisHewan->nama_jenis_hewan }}</strong> yang ingin dihapus</p>
    </div>

    <!-- WARNING -->
    <div class="warning-box">
        <i class="fas fa-exclamation-circle"></i>
        <div>
            <strong>Peringatan!</strong>
            <ul style="margin-top: 8px; padding-left: 20px;">
                <li>Pastikan tidak ada pet yang menggunakan ras ini.</li>
                <li>Data akan di-soft delete (bisa dipulihkan nanti).</li>
                <li>Untuk hapus permanen, gunakan fitur Force Delete di menu Terhapus.</li>
            </ul>
        </div>
    </div>

    @if($ras->count() > 0)

    <form action="{{ route('admin.ras-hewan.destroy') }}" method="POST">
        @csrf
        @method('DELETE')

        <input type="hidden" name="idjenis_hewan" value="{{ $jenisHewan->idjenis_hewan }}">

        <!-- FIELD JENIS -->
        <div class="form-group">
            <label class="form-label">Jenis Hewan</label>
            <input class="form-input" value="{{ $jenisHewan->nama_jenis_hewan }}" disabled>
            <div class="form-help">
                <i class="fas fa-info-circle"></i> Jenis hewan tidak dapat diubah.
            </div>
        </div>

        <!-- FIELD PILIH RAS -->
        <div class="form-group">
            <label class="form-label">Ras yang Akan Dihapus <span class="required">*</span></label>

            <select name="idras_hewan" id="rasSelect" class="form-select" required>
                <option value="">-- Pilih Ras Hewan --</option>
                @foreach($ras as $r)
                    <option value="{{ $r->idras_hewan }}" data-ras="{{ $r->nama_ras }}">
                        {{ $r->nama_ras }}
                        @if($r->trashed())
                            (Sudah Dihapus)
                        @endif
                    </option>
                @endforeach
            </select>

            @if($errors->has('idras_hewan'))
                <div class="form-error">{{ $errors->first('idras_hewan') }}</div>
            @else
                <div class="form-help">Pilih ras dari jenis {{ $jenisHewan->nama_jenis_hewan }}.</div>
            @endif

            <!-- PREVIEW -->
            <div class="preview-card" id="previewCard">
                <h4><i class="fas fa-info-circle"></i> Data yang Akan Dihapus</h4>
                <div class="preview-info">
                    <div class="preview-label">Jenis Hewan</div>
                    <div class="preview-value">{{ $jenisHewan->nama_jenis_hewan }}</div>

                    <div class="preview-label">Nama Ras</div>
                    <div class="preview-value" id="previewRas">-</div>
                </div>
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="form-actions">
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Hapus Ras
            </button>
            <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

    </form>

    @else

    <div class="empty-state">
        <i class="fas fa-inbox"></i>
        <h3 style="margin-top: 14px;">
            @if(request('trashed') == 'only')
                Tidak Ada Ras yang Terhapus
            @else
                Belum Ada Ras untuk {{ $jenisHewan->nama_jenis_hewan }}
            @endif
        </h3>
        <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-primary" style="margin-top: 16px;">Kembali</a>
    </div>

    @endif
</div>
</div>
@endsection
@push('scripts')
<script>
const rasSelect = document.getElementById("rasSelect");
const preview = document.getElementById("previewCard");
const previewRas = document.getElementById("previewRas");

rasSelect.addEventListener("change", function() {
    const opt = this.options[this.selectedIndex];

    if (!opt.value) {
        preview.classList.remove("active");
        previewRas.textContent = "-";
        return;
    }

    previewRas.textContent = opt.dataset.ras;
    preview.classList.add("active");
});
</script>
@endpush