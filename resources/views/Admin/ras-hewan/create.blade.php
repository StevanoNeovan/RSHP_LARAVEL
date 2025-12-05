@extends('layouts.admin')

@section('title', 'Tambah Ras Hewan')
@section('page-title', 'Tambah Ras Hewan')

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

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 12px;
    }
</style>

@if($errors->any())
    <div class="alert alert-danger" style="margin-bottom: 16px;">
        <ul style="margin:0; padding-left:18px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="section-wrapper">

    <p class="subtitle">Silakan isi data ras hewan di bawah ini.</p>

    <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
        @csrf

        {{-- JENIS HEWAN --}}
        <div class="form-row">
            <div class="form-label">Jenis Hewan</div>
            <div class="form-control-area">
                <select name="idjenis_hewan" class="select" required>
                    <option value="">-- Pilih Jenis Hewan --</option>
                    @foreach($jenisHewan as $jenis)
                        <option value="{{ $jenis->idjenis_hewan }}"
                            {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>
                            {{ $jenis->nama_jenis_hewan }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- NAMA RAS --}}
        <div class="form-row">
            <div class="form-label">Nama Ras</div>
            <div class="form-control-area">
                <input type="text" name="nama_ras" class="input"
                       value="{{ old('nama_ras') }}" required>
            </div>
        </div>

        {{-- ACTION BUTTON --}}
        <div class="form-actions">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

    </form>
</div>

@endsection
