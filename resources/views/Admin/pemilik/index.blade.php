@extends('layouts.admin')

@section('title', 'Data Pemilik')
@section('page-title', 'Manajemen Pemilik')

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
        flex-wrap: wrap;
        gap: 16px;
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
        flex-wrap: wrap;
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

    .owner-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .owner-avatar {
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
        flex-shrink: 0;
    }

    .owner-details h4 {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 2px;
    }

    .owner-details p {
        font-size: 12px;
        color: var(--text-light);
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: var(--text-dark);
    }

    .contact-item i {
        color: var(--primary-color);
        font-size: 12px;
        width: 16px;
    }

    .contact-item a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
    }

    .contact-item a:hover {
        text-decoration: underline;
    }

    .badge-count {
        background: var(--primary-color);
        color: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
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

    .stats-mini {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-mini-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .stat-mini-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    }

    .stat-mini-content h3 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1;
    }

    .stat-mini-content p {
        font-size: 13px;
        color: var(--text-light);
        margin-top: 4px;
    }

    @media (max-width: 768px) {
        .search-input {
            width: 100%;
        }
        
        .table-header {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-box {
            flex-direction: column;
        }
    }
</style>

<!-- Statistics -->
<div class="stats-mini">
    <div class="stat-mini-card">
        <div class="stat-mini-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $pemilik->count() }}</h3>
            <p>Total Pemilik</p>
        </div>
    </div>
    <div class="stat-mini-card">
        <div class="stat-mini-icon" style="background: linear-gradient(135deg, var(--secondary-color), #059669);">
            <i class="fas fa-paw"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $pemilik->sum(function($p) { return $p->pets->count(); }) }}</h3>
            <p>Total Pet Terdaftar</p>
        </div>
    </div>
    <div class="stat-mini-card">
        <div class="stat-mini-icon" style="background: linear-gradient(135deg, var(--accent-color), #d97706);">
            <i class="fas fa-user-plus"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $pemilik->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
            <p>Pemilik Baru Bulan Ini</p>
        </div>
    </div>
</div>

<div class="table-container">
    <div class="table-header">
        <h2 class="table-title">
            <i class="fas fa-user-friends"></i>
            Data Pemilik
        </h2>
        <div class="search-box">
            <input type="text" class="search-input" placeholder="Cari nama atau nomor WA..." id="searchInput">
            <a href="{{ route('admin.pemilik.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Pemilik
            </a>
        </div>
    </div>

    @if($pemilik->count() > 0)
        <table id="pemilikTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th>Pet Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemilik as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="owner-info">
                            <div class="owner-avatar">
                                {{ strtoupper(substr($p->user->nama, 0, 1)) }}
                            </div>
                            <div class="owner-details">
                                <h4>{{ $p->user->nama }}</h4>
                                <p>{{ $p->user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <a href="https://wa.me/{{ $p->no_wa }}" target="_blank">{{ $p->no_wa }}</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="max-width: 250px;">
                            {{ \Illuminate\Support\Str::limit($p->alamat, 50) }}
                        </div>
                    </td>
                    <td>
                        @if($p->pets->count() > 0)
                            <span class="badge-count">
                                <i class="fas fa-paw"></i> {{ $p->pets->count() }} Pet
                            </span>
                        @else
                            <span style="color: var(--text-light); font-size: 13px;">Belum ada pet</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.pemilik.edit', $p->idpemilik) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.pemilik.destroy', $p->idpemilik) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus pemilik {{ $p->user->nama }}? Pastikan tidak ada pet yang terdaftar.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <i class="fas fa-user-friends"></i>
            <h3>Belum Ada Data Pemilik</h3>
            <p>Silakan tambahkan data pemilik terlebih dahulu</p>
            <a href="{{ route('admin.pemilik.create') }}" class="btn btn-primary" style="margin-top: 16px;">
                <i class="fas fa-plus"></i>
                Tambah Pemilik Pertama
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
        const tableRows = document.querySelectorAll('#pemilikTable tbody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
</script>
@endpush