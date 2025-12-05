@extends('layouts.admin')

@section('title', 'Hapus Ras Hewan')
@section('page-title', 'Hapus Ras Hewan')

@section('content')

<style>
    .section-wrapper {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        max-width: 760px;
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
    .select {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
</style>

<div class="section-wrapper">
    <form action="{{ route('ras-hewan.destroy') }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="form-row">
            <div class="form-label">Pilih Ras</div>
            <div class="form-control-area">
               <select name="idras_hewan" class="select" required>
                    <option value="">-- Pilih Ras Hewan --</option>
                    @foreach($ras as $r)
                        <option value="{{ $r->idras_hewan }}">{{ $r->nama_ras }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-danger">
                Hapus
            </button>
        </div>
    </form>
</div>

@endsection
