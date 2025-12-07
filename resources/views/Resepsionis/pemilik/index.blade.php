@extends('layouts.resepsionis')

@section('title', 'Data Pemilik')
@section('page-title', 'Data Pemilik')

@section('content')

<div class="card" style="padding: 24px; border-radius: 12px;">

    {{-- Header --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-user-friends" style="font-size: 20px; color: #059669;"></i>
            <h3 style="margin: 0; font-weight: 700; font-size: 20px;">Daftar Pemilik ({{ $pemilik->total() }})</h3>
        </div>

        <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-success" 
           style="padding: 10px 16px; font-weight: 600; border-radius: 8px;">
            <i class="fas fa-user-plus"></i> Tambah Pemilik Baru
        </a>
    </div>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('resepsionis.pemilik.index') }}" style="margin-bottom: 24px;">
        <div style="display: flex; gap: 12px; align-items: center;">
            <div style="flex: 1; position: relative;">
                <i class="fas fa-search"
                   style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 14px; color: #9ca3af;"></i>
                <input type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari nama, email, atau nomor WA..."
                    style="
                        width: 100%;
                        padding: 12px 14px 12px 40px;
                        border: 1px solid #d1d5db;
                        border-radius: 8px;
                        font-size: 14px;
                    ">
            </div>

            <button type="submit" class="btn btn-primary" 
                style="padding: 10px 16px; border-radius: 8px;">
                <i class="fas fa-search"></i> Cari
            </button>

            @if($search)
            <a href="{{ route('resepsionis.pemilik.index') }}" 
               class="btn btn-secondary"
               style="padding: 10px 16px; background: #6b7280; border-radius: 8px;">
                <i class="fas fa-times"></i> Reset
            </a>
            @endif
        </div>
    </form>

    {{-- Data Table --}}
    @if($pemilik->count() > 0)
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f3f4f6;">
                    <th style="padding: 14px; text-align: left; font-weight: 600;">ID</th>
                    <th style="padding: 14px; text-align: left; font-weight: 600;">Nama</th>
                    <th style="padding: 14px; text-align: left; font-weight: 600;">Email</th>
                    <th style="padding: 14px; text-align: left; font-weight: 600;">No. WhatsApp</th>
                    <th style="padding: 14px; text-align: left; font-weight: 600;">Alamat</th>
                    <th style="padding: 14px; text-align: center; font-weight: 600;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pemilik as $p)
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    {{-- ID --}}
                    <td style="padding: 14px;">
                        <div style="
                            background: #10b98120;
                            color: #059669;
                            padding: 6px 12px;
                            border-radius: 6px;
                            display: inline-block;
                            font-weight: 700;
                            font-family: monospace;">
                            #{{ $p->idpemilik }}
                        </div>
                    </td>

                    {{-- Nama --}}
                    <td style="padding: 14px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="
                                width: 42px;
                                height: 42px;
                                border-radius: 50%;
                                background: linear-gradient(135deg, #10b981, #059669);
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                color: white;
                                font-size: 16px;
                                font-weight: 700;">
                                {{ strtoupper(substr($p->user->nama ?? 'U', 0, 1)) }}
                            </div>
                            <strong>{{ $p->user->nama ?? '-' }}</strong>
                        </div>
                    </td>

                    {{-- Email --}}
                    <td style="padding: 14px;">{{ $p->user->email ?? '-' }}</td>

                    {{-- WhatsApp --}}
                    <td style="padding: 14px;">
                        <a href="https://wa.me/{{ $p->no_wa }}" target="_blank"
                           style="color: #10b981; text-decoration: none; font-weight: 600;">
                            <i class="fab fa-whatsapp"></i> {{ $p->no_wa }}
                        </a>
                    </td>

                    {{-- Alamat --}}
                    <td style="padding: 14px;">{{ Str::limit($p->alamat, 40) }}</td>

                    {{-- Aksi --}}
                    <td style="padding: 14px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 8px;">

                            {{-- Edit --}}
                            <a href="{{ route('resepsionis.pemilik.edit', $p->idpemilik) }}" 
                               class="btn btn-warning"
                               style="padding: 8px 12px; border-radius: 8px;">
                                <i class="fas fa-edit"></i>
                            </a>

                            {{-- Delete --}}
                            <form method="POST" 
                                  action="{{ route('resepsionis.pemilik.destroy', $p->idpemilik) }}"
                                  onsubmit="return confirm('Yakin ingin menghapus pemilik ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger"
                                        style="padding: 8px 12px; border-radius: 8px;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div style="margin-top: 24px; display: flex; justify-content: center;">
        {{ $pemilik->links() }}
    </div>

    @else
    {{-- Empty State --}}
    <div style="text-align: center; padding: 48px;">
        <i class="fas fa-user-friends" style="font-size: 64px; color: #d1d5db; margin-bottom: 16px;"></i>

        <h3 style="color: #6b7280;">
            {{ $search ? 'Tidak Ada Hasil untuk "' . $search . '"' : 'Belum Ada Data Pemilik' }}
        </h3>

        <p style="color: #9ca3af; margin-bottom: 24px;">
            {{ $search ? 'Coba kata kunci lain atau reset pencarian.' : 'Mulai dengan menambahkan pemilik baru.' }}
        </p>

        @if(!$search)
        <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-success">
            <i class="fas fa-user-plus"></i> Tambah Pemilik Baru
        </a>
        @endif
    </div>
    @endif

</div>

@endsection
