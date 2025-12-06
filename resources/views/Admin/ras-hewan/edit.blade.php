@extends('layouts.admin')

@section('title', 'Edit Ras Hewan')
@section('page-title', 'Edit Ras Hewan')

@section('content')

<style>
    .section-wrapper {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        max-width: 760px;
        position: relative;
    }

    .back-btn-wrapper {
        position: absolute;
        top: 24px;
        right: 24px;
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

    .input, .select {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        background: #fff;
    }

    .divider {
        border-bottom: 1px solid #eee;
        margin: 22px 0 22px 0;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 12px;
    }
</style>

<div class="section-wrapper">

    {{-- TOMBOL KEMBALI SELALU TAMPIL --}}
    <div class="back-btn-wrapper">
        <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <h3 style="margin:0;">Edit Ras Hewan</h3>
    <p class="subtitle">Pilih ras yang mau diubah, lalu masukkan nama baru</p>

    {{-- FORM PILIH RAS --}}
    <form method="GET" action="">
        <div class="form-row">
            <div class="form-label">Jenis Hewan</div>
            <div class="form-control-area">
                <input type="text"
                       class="input"
                       value="{{ $jenisHewan->nama_jenis_hewan }}"
                       disabled>
            </div>
        </div>

        <div class="form-row">
            <div class="form-label">Pilih Ras Hewan</div>
            <div class="form-control-area">
                <select name="ras" class="select" onchange="this.form.submit()">
                    <option value="">-- Pilih Ras --</option>
                    @foreach($listRas as $ras)
                        <option value="{{ $ras->idras_hewan }}"
                            {{ request('ras') == $ras->idras_hewan ? 'selected' : '' }}>
                            {{ $ras->nama_ras }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    {{-- FORM EDIT --}}
    @if($rasHewan)
    <div class="divider"></div>

    <form method="POST" action="{{ route('admin.ras-hewan.update', $rasHewan->idras_hewan) }}">
        @csrf
        @method('PUT')

        <input type="hidden" name="idjenis_hewan" value="{{ $jenisHewan->idjenis_hewan }}">

        <div class="form-row">
            <div class="form-label">Nama Ras Baru</div>
            <div class="form-control-area">
                <input 
                    type="text"
                    class="input"
                    name="nama_ras"
                    value="{{ old('nama_ras', $rasHewan->nama_ras) }}"
                    required>
            </div>
        </div>

        <div class="form-actions">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Update
            </button>
        </div>
    </form>
    @endif

</div>

@endsection
