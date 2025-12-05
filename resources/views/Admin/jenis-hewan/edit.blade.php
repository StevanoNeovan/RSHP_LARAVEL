@extends('layouts.admin')

@section('title', 'Edit Jenis Hewan')
@section('page-title', 'Edit Jenis Hewan')

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

    <h3 style="margin:0;">Edit Jenis Hewan</h3>
    <p class="subtitle">Masukkan nama baru</p>

    {{-- FORM EDIT JENIS HEWAN --}}

    <form action="{{ route('admin.jenis-hewan.update', $jenisHewan->idjenis_hewan) }}" method="POST">
    @csrf
    @method('PUT')

        <input type="hidden" name="idjenis_hewan" value="{{ $jenisHewan->idjenis_hewan }}">

        <div class="form-row">
            <div class="form-label">Nama Jenis Hewan</div>
            <div class="form-control-area">
                <input 
                    type="text"
                    class="input"
                    name="nama_jenis_hewan"
                    value="{{ old('nama_jenis_hewan', $jenisHewan->nama_jenis_hewan) }}"
                    required>
            </div>
        </div>

        <div class="form-actions">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Update</button>
            <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
            </div>
    </form>
</div>

@endsection