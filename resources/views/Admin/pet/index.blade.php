@extends('layouts.admin')

@section('title', 'Data Pet')
@section('page-title', 'Manajemen Pet')

@section('content')
<style>
    .table-container {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .table-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-box {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .search-input {
        padding: 10px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        width: 250px;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary-color);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: var(--background-light);
    }

    th {
        padding: 16px 24px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    td {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color);
        font-size: 14px;
    }

    tbody tr:hover {
        background: var(--background-light);
    }

    .pet-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .pet-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 18px;
    }

    .pet-details h4 {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 2px;
    }

    .pet-details p {
        font-size: 12px;
        color: var(--text-light);
    }

    .badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .badge-male {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-female {
        background: #fce7f3;
        color: #be185d;
    }

    .btn-group {
        display: flex;
        gap: 8px;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-light);
    }

    .empty-state i {
        font-size: 64px;
        margin-bottom: 16px;
        opacity: 0.3;
    }

    .empty-state h3 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-dark);
    }

    /* ===== Filter Tabs ===== */
    .filter-tabs {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    /* ===== Alert ===== */
    .alert {
        border-radius: 10px;
        padding: 14px 18px;
        font-size: 14px;
    }

    /* ===== Action Buttons ===== */
   .action-group {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    }

    .action-group form {
        margin: 0;
    }

    th.nama-kategori,
    td.nama-kategori {
        text-align: left;
    }
    }
</style>

{{-- Filter Tabs --}}
<div class="filter-tabs">
    <a href="{{ route('admin.pet.index') }}"
       class="btn {{ !request('trashed') ? 'btn-primary' : 'btn-secondary' }}">
        <i class="fas fa-list"></i> Aktif
    </a>

    <a href="{{ route('admin.pet.index', ['trashed' => 'only']) }}"
       class="btn {{ request('trashed') == 'only' ? 'btn-danger' : 'btn-secondary' }}">
        <i class="fas fa-trash"></i> Terhapus
    </a>

    <a href="{{ route('admin.pet.index', ['trashed' => 'with']) }}"
       class="btn {{ request('trashed') == 'with' ? 'btn-warning' : 'btn-secondary' }}">
        <i class="fas fa-archive"></i> Semua
    </a>
</div>

{{-- Warning Alert --}}
@if(request('trashed'))
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle"></i>
    Menampilkan data yang sudah dihapus.
    <a href="{{ route('admin.pet.index') }}" class="fw-bold">Lihat data aktif</a>
</div>
@endif

{{-- Table Card --}}
<div class="table-container">
    <div class="table-header">
        <h2 class="table-title">
            <i class="fas fa-cat"></i>
            Data Pet
        </h2>
        <div class="search-box">
            <input type="text" class="search-input" placeholder="Cari nama pet atau pemilik..." id="searchInput">
            <a href="{{ route('admin.pet.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Pet
            </a>
        </div>
    </div>

    @if($pets->count() > 0)
        <table id="petTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pet</th>
                    <th>Pemilik</th>
                    <th>Ras / Jenis</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th class="nama-kategori">Status</th>
                    <th class="nama-kategori">Dihapus Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pets as $index => $pet)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="pet-info">
                            <div class="pet-avatar">
                                {{ strtoupper(substr($pet->nama, 0, 1)) }}
                            </div>
                            <div class="pet-details">
                                <h4>{{ $pet->nama }}</h4>
                                <p>{{ $pet->warna_tanda }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <strong>{{ $pet->pemilik->user->nama }}</strong><br>
                        <small style="color: var(--text-light);">{{ $pet->pemilik->no_wa }}</small>
                    </td>
                    <td>
                        <strong>{{ $pet->ras->nama_ras }}</strong><br>
                        <small style="color: var(--text-light);">{{ $pet->ras->jenisHewan->nama_jenis_hewan }}</small>
                    </td>
                    <td>{{ App\Http\Controllers\Admin\PetController::calculateAge($pet->tanggal_lahir) }}</td>
                    <td>
                        @if($pet->jenis_kelamin == 'M')
                            <span class="badge badge-male">
                                <i class="fas fa-mars"></i> Jantan
                            </span>
                        @else
                            <span class="badge badge-female">
                                <i class="fas fa-venus"></i> Betina
                            </span>
                        @endif
                    </td></td>
                        <td>
                            @if($pet->trashed())
                                <span class="badge badge-danger">Terhapus</span>
                            @else
                                <span class="badge badge-success">Aktif</span>
                            @endif
                        </td>
                        <td>
                            @if($pet->trashed() && $pet->deleted_by)
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-user" style="color: #6b7280;"></i>
                                    <div>
                                        <strong>{{ $pet->deletedBy->nama ?? 'Unknown' }}</strong><br>
                                        <small style="color: #6b7280;">
                                            {{ \Carbon\Carbon::parse($pet->deleted_at)->format('d M Y, H:i') }}
                                        </small>
                                    </div>
                                </div>
                            @else
                                <span style="color: #9ca3af;">-</span>
                            @endif
                        </td>
                     <td>
                        <div class="action-group">
                    
                            @if($pet->trashed())
                                {{-- Restore --}}
                                <form action="{{ route('admin.pet.restore', $pet->idpet) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm">
                                        <i class="fas fa-undo"></i> Restore
                                    </button>
                                </form>

                                {{-- Force Delete --}}
                                <form action="{{ route('admin.pet.force-delete', $pet->idpet) }}"
                                    method="POST"
                                    onsubmit="return confirm('PERMANEN! Data tidak bisa dikembalikan. Yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Hapus Permanen
                                    </button>
                                </form>
                            @else
                                {{-- Edit --}}
                                <a href="{{ route('admin.pet.edit', $pet->idpet) }}"
                                class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.pet.destroy', $pet->idpet) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <i class="fas fa-cat"></i>
            <h3>Belum Ada Data Pet</h3>
            <p>Silakan tambahkan data pet terlebih dahulu</p>
            <a href="{{ route('admin.pet.create') }}" class="btn btn-primary" style="margin-top: 16px;">
                <i class="fas fa-plus"></i>
                Tambah Pet Pertama
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Simple search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('#petTable tbody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
</script>
@endpush