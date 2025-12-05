@extends('layouts.admin')

@section('title', 'Edit Pemilik')
@section('page-title', 'Edit Data Pemilik')

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
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-input.error,
    .form-select.error,
    .form-textarea.error {
        border-color: var(--danger-color);
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
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

    .user-preview {
        background: var(--background-light);
        padding: 16px;
        border-radius: 8px;
        margin-top: 12px;
        display: none;
    }

    .user-preview.active {
        display: block;
    }

    .user-preview h4 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--text-dark);
    }

    .user-preview-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-preview-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent-color), #d97706);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 20px;
    }

    .user-preview-details h5 {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 4px;
    }

    .user-preview-details p {
        font-size: 13px;
        color: var(--text-light);
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

    .pet-count-badge {
        background: linear-gradient(135deg, var(--secondary-color), #059669);
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .pet-count-badge i {
        font-size: 24px;
    }

    .pet-count-badge div h4 {
        font-weight: 600;
        margin-bottom: 4px;
    }

    .pet-count-badge div p {
        font-size: 13px;
        opacity: 0.9;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-card-header">
            <h3>
                <i class="fas fa-edit"></i>
                Form Edit Pemilik
            </h3>
            <p>Update informasi pemilik: <strong>{{ $pemilik->user->nama }}</strong></p>
        </div>

        @if($pemilik->pets->count() > 0)
        <div class="pet-count-badge">
            <i class="fas fa-paw"></i>
            <div>
                <h4>{{ $pemilik->pets->count() }} Pet Terdaftar</h4>
                <p>Pemilik ini memiliki {{ $pemilik->pets->count() }} hewan yang terdaftar di sistem</p>
            </div>
        </div>
        @endif

        <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Pilih User -->
            <div class="form-group">
                <label class="form-label">
                    Pilih User <span class="required">*</span>
                </label>
                <select 
                    name="iduser" 
                    id="userSelect" 
                    class="form-select @error('iduser') error @enderror" 
                    required
                >
                    <option value="">-- Pilih User yang Akan Jadi Pemilik --</option>
                    @foreach($users as $user)
                        <option 
                            value="{{ $user->iduser }}"
                            data-nama="{{ $user->nama }}"
                            data-email="{{ $user->email }}"
                            {{ old('iduser', $pemilik->iduser) == $user->iduser ? 'selected' : '' }}
                        >
                            {{ $user->nama }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('iduser')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Pilih user yang akan didaftarkan sebagai pemilik hewan</div>
                @enderror

                <!-- User Preview -->
                <div class="user-preview active" id="userPreview">
                    <h4><i class="fas fa-user"></i> Informasi User</h4>
                    <div class="user-preview-info">
                        <div class="user-preview-avatar" id="previewAvatar">
                            {{ strtoupper(substr($pemilik->user->nama, 0, 1)) }}
                        </div>
                        <div class="user-preview-details">
                            <h5 id="previewNama">{{ $pemilik->user->nama }}</h5>
                            <p id="previewEmail">{{ $pemilik->user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nomor WhatsApp -->
            <div class="form-group">
                <label class="form-label">
                    Nomor WhatsApp <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    name="no_wa" 
                    class="form-input @error('no_wa') error @enderror" 
                    value="{{ old('no_wa', $pemilik->no_wa) }}"
                    placeholder="08xxxxxxxxxx atau 628xxxxxxxxxx"
                    required
                >
                @error('no_wa')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Nomor WhatsApp aktif untuk komunikasi (minimal 10 digit, hanya angka)</div>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="form-group">
                <label class="form-label">
                    Alamat Lengkap <span class="required">*</span>
                </label>
                <textarea 
                    name="alamat" 
                    class="form-textarea @error('alamat') error @enderror" 
                    placeholder="Contoh: Jl. Raya Kampung Baru No. 123, RT 05/RW 03"
                    required
                >{{ old('alamat', $pemilik->alamat) }}</textarea>
                @error('alamat')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @else
                    <div class="form-help">Alamat lengkap tempat tinggal pemilik (minimal 5 karakter)</div>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Update Data
                </button>
                <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">
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
    // Auto-fill user preview when user is selected
    const userSelect = document.getElementById('userSelect');
    const userPreview = document.getElementById('userPreview');
    const previewAvatar = document.getElementById('previewAvatar');
    const previewNama = document.getElementById('previewNama');
    const previewEmail = document.getElementById('previewEmail');

    userSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        
        if (selectedOption.value) {
            const nama = selectedOption.dataset.nama;
            const email = selectedOption.dataset.email;
            
            userPreview.classList.add('active');
            previewAvatar.textContent = nama.charAt(0).toUpperCase();
            previewNama.textContent = nama;
            previewEmail.textContent = email;
        } else {
            userPreview.classList.remove('active');
        }
    });

    // Trigger on page load
    window.addEventListener('load', function() {
        if (userSelect.value) {
            userSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush