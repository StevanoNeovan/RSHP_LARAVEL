@extends('layouts.admin')

@section('title', 'Edit Pet')
@section('page-title', 'Edit Data Pet')

@section('content')
<style>
    .form-container {
        max-width: 800px;
    }

    .form-card {
        background: white;
        border-radius: 12px;
        padding: 32px;
        border: 1px solid var(--border-color);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .form-card-header {
        margin-bottom: 32px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--border-color);
    }

    .form-card-header h3 {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
    }

    .form-card-header p {
        color: var(--text-light);
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-label .required {
        color: var(--danger-color);
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-input.error,
    .form-select.error {
        border-color: var(--danger-color);
    }

    .form-help {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 6px;
    }

    .form-error {
        font-size: 12px;
        color: var(--danger-color);
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .radio-group {
        display: flex;
        gap: 24px;
        margin-top: 8px;
    }

    .radio-item {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .radio-item input[type="radio"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .radio-item label {
        font-weight: 500;
        cursor: pointer;
        font-size: 14px;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 2px solid var(--border-color);
    }

    .btn-secondary {
        background: var(--background-light);
        color: var(--text-dark);
        border: 2px solid var(--border-color);
    }

    .btn-secondary:hover {
        background: var(--border-color);
        transform: translateY(-2px);
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-card-header">
            <h3>
                <i class="fas fa-edit"></i>
                Form Edit Pet
            </h3>
            <p>Update informasi pet: <strong>{{ $pet->nama }}</strong></p>
        </div>

        <form action="{{ route('admin.pet.update', $pet->idpet) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Pet -->
            <div class="form-group">
                <label class="form-label">
                    Nama Pet <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    name="nama" 
                    class="form-input @error('nama') error @enderror" 
                    value="{{ old('nama', $pet->nama) }}"
                    placeholder="Contoh: Milo, Luna, Bobby"
                    required
                >
                @error('nama')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Masukkan nama panggilan pet</div>
                @enderror
            </div>

            <!-- Pemilik -->
            <div class="form-group">
                <label class="form-label">
                    Pemilik <span class="required">*</span>
                </label>
                <select name="idpemilik" class="form-select @error('idpemilik') error @enderror" required>
                    <option value="">-- Pilih Pemilik --</option>
                    @foreach($pemilik as $p)
                        <option value="{{ $p->idpemilik }}" 
                            {{ old('idpemilik', $pet->idpemilik) == $p->idpemilik ? 'selected' : '' }}>
                            {{ $p->user->nama }} - {{ $p->no_wa }}
                        </option>
                    @endforeach
                </select>
                @error('idpemilik')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Jenis Hewan -->
            <div class="form-group">
                <label class="form-label">
                    Jenis Hewan <span class="required">*</span>
                </label>
                <select name="jenis_hewan_temp" id="jenisHewanSelect" class="form-select" required>
                    <option value="">-- Pilih Jenis Hewan --</option>
                    @foreach($jenisHewan as $jenis)
                        <option value="{{ $jenis->idjenis_hewan }}"
                            {{ old('jenis_hewan_temp', $pet->ras->idjenis_hewan) == $jenis->idjenis_hewan ? 'selected' : '' }}>
                            {{ $jenis->nama_jenis_hewan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Ras Hewan -->
            <div class="form-group">
                <label class="form-label">
                    Ras Hewan <span class="required">*</span>
                </label>
                <select name="idras_hewan" id="rasHewanSelect" class="form-select @error('idras_hewan') error @enderror" required>
                    <option value="">-- Pilih Ras Hewan --</option>
                    @foreach($rasHewan as $ras)
                        <option value="{{ $ras->idras_hewan }}" 
                            data-jenis="{{ $ras->idjenis_hewan }}"
                            {{ old('idras_hewan', $pet->idras_hewan) == $ras->idras_hewan ? 'selected' : '' }}>
                            {{ $ras->nama_ras }}
                        </option>
                    @endforeach
                </select>
                @error('idras_hewan')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tanggal Lahir -->
            <div class="form-group">
                <label class="form-label">
                    Tanggal Lahir <span class="required">*</span>
                </label>
                <input 
                    type="date" 
                    name="tanggal_lahir" 
                    class="form-input @error('tanggal_lahir') error @enderror" 
                    value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}"
                    max="{{ date('Y-m-d') }}"
                    required
                >
                @error('tanggal_lahir')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Warna & Tanda Khusus -->
            <div class="form-group">
                <label class="form-label">
                    Warna & Tanda Khusus <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    name="warna_tanda" 
                    class="form-input @error('warna_tanda') error @enderror" 
                    value="{{ old('warna_tanda', $pet->warna_tanda) }}"
                    placeholder="Contoh: Putih bintik hitam"
                    required
                >
                @error('warna_tanda')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-group">
                <label class="form-label">
                    Jenis Kelamin <span class="required">*</span>
                </label>
                <div class="radio-group">
                    <div class="radio-item">
                        <input 
                            type="radio" 
                            id="jantan" 
                            name="jenis_kelamin" 
                            value="M" 
                            {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'M' ? 'checked' : '' }}
                            required
                        >
                        <label for="jantan">
                            <i class="fas fa-mars" style="color: #3b82f6;"></i> Jantan
                        </label>
                    </div>
                    <div class="radio-item">
                        <input 
                            type="radio" 
                            id="betina" 
                            name="jenis_kelamin" 
                            value="F" 
                            {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'F' ? 'checked' : '' }}
                            required
                        >
                        <label for="betina">
                            <i class="fas fa-venus" style="color: #ec4899;"></i> Betina
                        </label>
                    </div>
                </div>
                @error('jenis_kelamin')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Update Data
                </button>
                <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Filter Ras Hewan based on Jenis Hewan
    const jenisSelect = document.getElementById('jenisHewanSelect');
    const rasSelect = document.getElementById('rasHewanSelect');
    const rasOptions = Array.from(rasSelect.options);

    jenisSelect.addEventListener('change', function() {
        const selectedJenis = this.value;
        
        if (!selectedJenis) {
            rasSelect.disabled = true;
            rasSelect.innerHTML = '<option value="">-- Pilih Jenis Hewan Terlebih Dahulu --</option>';
            return;
        }

        rasSelect.disabled = false;
        rasSelect.innerHTML = '<option value="">-- Pilih Ras Hewan --</option>';
        
        rasOptions.forEach(option => {
            if (option.dataset.jenis == selectedJenis) {
                rasSelect.appendChild(option.cloneNode(true));
            }
        });
    });

    // Trigger on page load
    window.addEventListener('load', function() {
        if (jenisSelect.value) {
            jenisSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush