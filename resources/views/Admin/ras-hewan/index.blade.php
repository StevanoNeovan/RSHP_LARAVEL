@extends('layouts.admin')

@section('title', 'Jenis Hewan')
@section('page-title', 'Master Data Jenis Hewan')

@section('content')

<style>
    .header-section {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .header-title h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .header-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-primary {
        background: var(--primary-color);
        border: none;
        padding: 10px 16px;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-primary:hover {
        opacity: .9;
    }

    .btn-danger {
        background: var(--danger-color);
        border: none;
        padding: 10px 16px;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-danger:hover {
        opacity: .9;
    }

    .table-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid var(--border-color);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 12px;
    }

    table th {
        background: var(--background-light);
        padding: 12px;
        text-align: left;
        font-size: 14px;
        color: var(--text-dark);
        border-bottom: 1px solid var(--border-color);
    }

    table td {
        padding: 12px;
        border-bottom: 1px solid var(--border-color);
        font-size: 14px;
    }

    .action-btn {
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        color: white;
    }

    .btn-edit {
        background: #3b82f6;
    }

    .empty-state {
        text-align: center;
        padding: 40px 0;
        color: var(--text-light);
    }
</style>

{{-- Header --}}
<div class="header-section">
    <div class="header-title">
        <h2>Daftar Ras Hewan</h2>
    </div>

    <div class="header-actions">
        <a href="{{ route('admin.ras-hewan.create') }}">
            <button class="btn-primary">
                <i class="fas fa-plus"></i> Tambah Ras Hewan
            </button>
        </a>
    </div>
</div>

{{-- Table Card --}}
<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Hewan</th>
                <th>Nama Ras</th>
                <th>Aksi</th>
            </tr>
    </thead>
  <tbody>
@foreach ($jenisHewan as $index => $jenis)
    <tr>
        <td>{{ $index + 1 }}</td>

        {{-- Nama Jenis Hewan --}}
        <td><strong>{{ $jenis->nama_jenis_hewan }}</strong></td>

        {{-- Daftar Ras --}}
        <td>
            @if ($jenis->rasHewan->count())
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach ($jenis->rasHewan as $ras)
                        <li>{{ $ras->nama_ras }}</li>
                    @endforeach
                </ul>
            @else
                <span style="color: #888;">Belum ada ras</span>
            @endif
        </td>

        {{-- Tombol Edit & Hapus --}}
        <td>
            <div style="display: flex; gap: 8px;">
                <a href="{{ route('admin.ras-hewan.edit', $jenis->idjenis_hewan) }}">
                    <button class="action-btn btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </a>
                @if($jenis->rasHewan->count() > 0)
                    <a href="{{ route('admin.ras-hewan.delete-form', $jenis->idjenis_hewan) }}">
                        <button class="action-btn" style="background: #ef4444;">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </a>
                @endif
            </div>
        </td>
    </tr>
@endforeach
</tbody>

</table>
</div>
@endsection