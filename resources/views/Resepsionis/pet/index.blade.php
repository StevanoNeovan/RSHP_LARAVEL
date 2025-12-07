@extends('layouts.resepsionis')
@section('title', 'Data Pet')

@section('content')
<div class="card" style="padding:24px;border-radius:12px">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:22px">
        <h4 style="font-weight:700;font-size:20px;display:flex;align-items:center;gap:8px">
            <i class="fas fa-paw text-success" style="font-size: 20px; color: #059669;"></i> Daftar Pet ({{ $pets->total() }})
        </h4>

        <a href="{{ route('resepsionis.pet.create') }}" 
           class="btn btn-primary"
           style="border-radius:10px;padding:10px 18px;font-weight:600;display:flex;align-items:center;gap:8px">
            <i class="fas fa-plus"></i> Tambah Pet Baru
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" style="margin-bottom:24px">
        <div style="display:flex;gap:12px">
            <input type="text" 
                   name="search" 
                   value="{{ $search }}"
                   class="form-control"
                   placeholder="Cari nama pet atau pemilik..."
                   style="padding:12px;border-radius:10px">

            <button class="btn btn-success" style="border-radius:10px;padding:0 20px">
                <i class="fas fa-search"></i> Cari
            </button>

            @if($search)
            <a href="{{ route('resepsionis.pet.index') }}" 
               class="btn btn-secondary"
               style="border-radius:10px;background:#9ca3af!important;padding:0 18px">
               <i class="fas fa-times"></i>
            </a>
            @endif
        </div>
    </form>

    @if($pets->count() > 0)
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:20px">

        @foreach($pets as $pet)
        <div class="card shadow-sm"
             style="padding:20px;border-radius:12px;border:1px solid #e5e7eb">

            <div style="display:flex;align-items:center;gap:16px;margin-bottom:16px">
                <div style="
                    width:60px;height:60px;border-radius:50%;
                    display:flex;align-items:center;justify-content:center;
                    color:white;font-size:22px;
                    background:{{ $pet->jenis_kelamin=='M' ? '#0ea5e9' : '#ec4899' }};
                ">
                    <i class="fas fa-{{ $pet->jenis_kelamin=='M'?'mars':'venus' }}"></i>
                </div>

                <div>
                    <h5 style="margin:0;font-weight:700;font-size:18px">{{ $pet->nama }}</h5>
                    <p style="margin:0;color:#6b7280;font-size:13px">{{ $pet->ras->nama_ras ?? '-' }}</p>
                </div>
            </div>

            <div style="
                background:#f8fafc;
                padding:10px 12px;
                border-radius:10px;
                margin-bottom:16px;
                border:1px solid #e5e7eb;
            ">
                <div style="font-size:12px;color:#64748b;margin-bottom:4px">
                    <i class="fas fa-user"></i> Pemilik
                </div>
                <strong style="font-size:14px">{{ $pet->pemilik->user->nama ?? '-' }}</strong>
            </div>

            {{-- BUTTON AREA — FIXED & RAPI --}}
            <div style="
                display:flex;
                gap:10px;
                align-items:center;
            ">
                <a href="{{ route('resepsionis.pet.edit', $pet->idpet) }}"
                   class="btn btn-warning"
                   style="
                        flex:1;
                        border-radius:10px;
                        padding:7px;
                        font-weight:600;
                        display:flex;
                        justify-content:center;
                        align-items:center;
                        gap:6px;
                   ">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <form method="POST" action="{{ route('resepsionis.pet.destroy', $pet->idpet) }}" 
                      onsubmit="return confirm('Hapus pet ini?')" 
                      style="flex:1">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger"
                            style="
                                width:100%;
                                border-radius:10px;
                                padding:10px;
                                font-weight:600;
                                display:flex;
                                justify-content:center;
                                align-items:center;
                                gap:6px;
                            ">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>

        </div>
        @endforeach

    </div>

    <div class="mt-3">{{ $pets->links() }}</div>

    @else
    <div style="text-align:center;padding:48px;color:#6b7280">
        <i class="fas fa-paw" style="font-size:60px;color:#d1d5db;margin-bottom:16px"></i>
        <h5>{{ $search ? 'Tidak ada hasil ditemukan' : 'Belum ada data pet' }}</h5>
    </div>
    @endif
</div>
@endsection
