@extends('layouts.app')

@section('content')
<div class="container" style="padding:20px;">
    <h1>Dashboard Administrator</h1>
    <p>Selamat datang, <b>{{ Auth::user()->nama }}</b>!</p>
    <hr>

    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap:20px; margin-top:30px;">

        {{-- Card: Manajemen User --}}
        <div style="border:1px solid #ccc; border-radius:10px; padding:20px; text-align:center;">
            <h3>Manajemen User</h3>
            <p>Lihat dan kelola data user serta role mereka.</p>
            <a href="{{ route('admin.user.index') }}">Lihat Data</a>
        </div>

        {{-- Card: Jenis Hewan --}}
        <div style="border:1px solid #ccc; border-radius:10px; padding:20px; text-align:center;">
            <h3>Manajemen Jenis Hewan</h3>
            <p>Kelola jenis hewan yang tersedia di sistem.</p>
            <a href="{{ route('admin.jenis-hewan.index') }}">Lihat Data</a>
        </div>

        {{-- Card: Ras Hewan --}}
        <div style="border:1px solid #ccc; border-radius:10px; padding:20px; text-align:center;">
            <h3>Manajemen Ras Hewan</h3>
            <p>Kelola daftar ras berdasarkan jenis hewan.</p>
            <a href="{{ route('admin.ras-hewan.index') }}">Lihat Data</a>
        </div>

        {{-- Card: Kategori --}}
        <div style="border:1px solid #ccc; border-radius:10px; padding:20px; text-align:center;">
            <h3>Manajemen Kategori</h3>
            <p>Atur kategori tindakan atau terapi.</p>
            <a href="{{ route('admin.kategori.index') }}">Lihat Data</a>
        </div>

        {{-- Card: Kategori Klinis --}}
        <div style="border:1px solid #ccc; border-radius:10px; padding:20px; text-align:center;">
            <h3>Manajemen Kategori Klinis</h3>
            <p>Lihat kategori klinis untuk tindakan atau terapi.</p>
            <a href="{{ route('admin.kategori-klinis.index') }}">Lihat Data</a>
        </div>

        {{-- Card: Kode Tindakan Terapi --}}
        <div style="border:1px solid #ccc; border-radius:10px; padding:20px; text-align:center;">
            <h3>Manajemen Tindakan Terapi</h3>
            <p>Kelola daftar kode tindakan dan terapi.</p>
            <a href="{{ route('admin.kode-tindakan-terapi.index') }}">Lihat Data</a>
        </div>

        {{-- Card: Pemilik & Hewan --}}
        <div style="border:1px solid #ccc; border-radius:10px; padding:20px; text-align:center;">
            <h3>Data Pemilik & Hewan</h3>
            <p>Lihat data pemilik hewan dan peliharaannya.</p>
            <a href="{{ route('admin.pemilik.index') }}">Lihat Data</a>
        </div>

        {{-- Card: Rekam Medis --}}
        <div style="border:1px solid #ccc; border-radius:10px; padding:20px; text-align:center;">
            <h3>Rekam Medis</h3>
            <p>Lihat semua rekam medis pasien hewan.</p>
            <a href="{{ route('admin.rekam-medis.index') }}">Lihat Data</a>
        </div>

    </div>
</div>
@endsection
