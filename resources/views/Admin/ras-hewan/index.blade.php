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

    .btn-delete {
        background: #ef4444;
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

    <a href="{{ route('admin.ras-hewan.create') }}">
        <button class="btn-primary">+ Tambah Ras Hewan</button>
    </a>
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
        <td>{{ $jenis->nama_jenis_hewan }}</td>

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

        {{-- Tombol Edit/Hapus --}}
        <td>
            <a href="{{ route('admin.ras-hewan.edit', $jenis->idjenis_hewan) }}">
                <button class="action-btn btn-edit">Edit</button>
            </a>

            <form action="{{ route('admin.ras-hewan.destroy', $jenis->idjenis_hewan) }}" 
                  method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="action-btn btn-delete"
                        onclick="return confirm('Yakin ingin menghapus jenis hewan ini?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
@endforeach
</tbody>

</table>
</div>
@endsection