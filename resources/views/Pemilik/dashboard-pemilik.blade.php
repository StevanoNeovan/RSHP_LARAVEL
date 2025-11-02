@extends('layouts.pemilik') {{-- Sesuaikan ini dengan nama layout utama Anda --}}

@section('content') {{-- Sesuaikan ini dengan nama section di layout Anda --}}

<div class="top-bar">
    <h1><i class="fas fa-th-large"></i> Dashboard Pemilik</h1>
    <div class="user-info">
        <div class="user-profile">
            <div class="user-avatar">
                {{-- Ambil 1 huruf awal dari NAMA USER --}}
                {{ strtoupper(substr($user->nama, 0, 1)) }}
            </div>
            <div class="user-details">
                {{-- Ambil data dari $user yang dikirim Controller --}}
                <h3>{{ $user->nama }}</h3>
                <p>Pemilik Hewan</p>
            </div>
        </div>
        
        {{-- Tombol Logout standar Laravel --}}
        <a href="{{ route('logout') }}" 
           class="btn-logout"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>

<div class="welcome-banner">
    {{-- Ambil nama dari $user --}}
    <h2>Selamat Datang, {{ $user->nama }}! 👋</h2>
    <p>Terima kasih telah mempercayakan kesehatan hewan kesayangan Anda kepada RSHP UNAIR. Kelola informasi pet, lihat jadwal reservasi, dan akses rekam medis dengan mudah.</p>
</div>

<table border="1" width="100%" cellpadding="15">
    <thead>
        <tr align="left">
            <th width="33%">Total Pet Terdaftar</th>
            <th width="33%">Total Reservasi</th>
            <th width="33%">Rekam Medis</th>
        </tr>
    </thead>
    <tbody>
        <tr align="center">
            {{-- Card 1: Total Pet --}}
            <td>
                <h1 style="font-size: 3em; margin: 0;">{{ $total_pets }}</h1>
            </td>
            
            {{-- Card 2: Total Reservasi --}}
            <td>
                <h1 style="font-size: 3em; margin: 0;">{{ $total_reservasi }}</h1>
            </td>
            
            {{-- Card 3: Rekam Medis --}}
            <td>
                <h1 style="font-size: 3em; margin: 0;">{{ $total_rekam_medis }}</h1>
            </td>
        </tr>
    </tbody>
</table>

<div class="quick-actions">
    <div class="section-header">
        <i class="fas fa-bolt" style="font-size: 24px; color: #1e3c72;"></i>
        <h3>Akses Cepat</h3>
    </div>
    <div class="action-buttons">
        {{-- Gunakan helper route() sesuai rute yang kita buat di web.php --}}
        <a href="#" class="action-btn"> {{-- Nanti: {{ route('pemilik.pets.index') }} --}}
            <i class="fas fa-dog"></i>
            <span>Lihat Pet Saya</span>
        </a>
        <a href="#" class="action-btn"> {{-- Nanti: {{ route('pemilik.reservasi.index') }} --}}
            <i class="fas fa-calendar-check"></i>
            <span>Riwayat Reservasi</span>
        </a>
        <a href="#" class="action-btn"> {{-- Nanti: {{ route('pemilik.rekam-medis.index') }} --}}
            <i class="fas fa-file-medical"></i>
            <span>Rekam Medis</span>
        </a>
    </div>
</div>

{{-- 
PENTING: Jangan lupa update juga link di sidebar Anda (di file layout utama) 
agar menggunakan helper route(), contoh:
<a href="{{ route('pemilik.dashboard') }}" class="menu-item ...">
--}}

@endsection