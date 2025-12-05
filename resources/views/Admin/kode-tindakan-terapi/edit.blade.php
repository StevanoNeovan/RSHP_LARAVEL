@extends('layouts.admin')

@section('title', 'Edit Kode Tindakan Terapi')
@section('page-title', 'Edit Kode Tindakan Terapi')

@section('content')

<style>
    .section-wrapper {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        max-width: 760px;
    }

    .subtitle {
        color: #6c757d;
        margin-top: -6px;
        margin-bottom: 24px;
    }

    .form-row {
        display: flex;
        align-items: center;
        margin-bottom: 18px;
        gap: 18px;
    }

    .form-label {
        width: 180px;
        font-weight: 600;
    }

    .form-control-area {
        flex: 1;
    }

    .input, 
    .select, 
    textarea {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        background: #fff;
    }

    textarea {
        height: 120px;
        resize: vertical;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
    }
</style>

<div class="section-wrapper">

    <h3 style="margin:0;">Edit Kode Tindakan Terapi</h3>
    <p class="subtitle">Perbarui informasi kode, deskripsi, dan kategori</p>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terdapat kesalahan:</strong>
            <ul style="margin: 10px 0 0 15px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kode-tindakan-terapi.update', $kodeTindakanTerapi->idkode_tindakan_terapi) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- KODE --}}
        <div class="form-row">
            <div class="form-label">Kode</div>
            <div class="form-control-area">
                <input 
                    type="text"
                    name="kode"
                    class="input"
                    maxlength="5"
                    value="{{ old('kode', $kodeTindakanTerapi->kode) }}"
                    required>
            </div>
        </div>

        {{-- DESKRIPSI --}}
        <div class="form-row" style="align-items: flex-start;">
            <div class="form-label">Deskripsi</div>
            <div class="form-control-area">
                <textarea 
                    name="deskripsi_tindakan_terapi"
                    required>{{ old('deskripsi_tindakan_terapi', $kodeTindakanTerapi->deskripsi_tindakan_terapi) }}</textarea>
            </div>
        </div>

        {{-- KATEGORI --}}
        <div class="form-row">
            <div class="form-label">Kategori</div>
            <div class="form-control-area">
                <select name="idkategori" class="select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->idkategori }}"
                            {{ old('idkategori', $kodeTindakanTerapi->idkategori) == $kat->idkategori ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- KATEGORI KLINIS --}}
        <div class="form-row">
            <div class="form-label">Kategori Klinis</div>
            <div class="form-control-area">
                <select name="idkategori_klinis" class="select" required>
                    <option value="">-- Pilih Kategori Klinis --</option>
                    @foreach($kategoriKlinis as $klinis)
                        <option value="{{ $klinis->idkategori_klinis }}"
                            {{ old('idkategori_klinis', $kodeTindakanTerapi->idkategori_klinis) == $klinis->idkategori_klinis ? 'selected' : '' }}>
                            {{ $klinis->nama_kategori_klinis }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="reset" class="btn btn-secondary">Reset</button>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update
            </button>

            <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

    </form>
</div>

@endsection
