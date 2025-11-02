@extends('layouts.app') 

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perawat - RSHP UNAIR</title>
    
    {{-- CSS FontAwesome (Opsional, tapi ikon tidak akan muncul jika dihapus) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
</head>
<body>
    {{-- Kolom 1: Sidebar --}}
    <table border="1" width="100%">
        <tr>
            <td width="20%" valign="top">
                <div>
                    <h2><i class="fas fa-user-nurse"></i> RSHP UNAIR</h2>
                    <p>Perawat</p>
                </div>
                <hr>
                <nav>
                    <ul>
                        <li>
                            {{-- LINK SUDAH DIPERBAIKI --}}
                            <a href="{{ route('perawat.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            {{-- LINK SUDAH DIPERBAIKI --}}
                            <a href="{{ route('perawat.rekam-medis.index') }}">
                                <i class="fas fa-file-medical"></i>
                                <span>Kelola Rekam Medis</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </td>

            {{-- Kolom 2: Konten Utama --}}
            <td width="80%" valign="top" style="padding: 20px;">
                
                {{-- Bagian Atas: Judul dan Logout --}}
                <table width="100%">
                    <tr>
                        <td>
                            <h1><i class="fas fa-th-large"></i> Dashboard Perawat</h1>
                        </td>
                        <td align="right">
                            {{-- TOMBOL LOGOUT SUDAH DIPERBAIKI --}}
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </td>
                    </tr>
                </table>
                <hr>

                {{-- Banner Selamat Datang --}}
                <div style="background-color: #f0f0f0; padding: 20px; margin-top: 20px; margin-bottom: 20px;">
                    {{-- NAMA PERAWAT SUDAH DISESUAIKAN --}}
                    <h2>Selamat Datang, {{ $perawat->nama }}! 👋</h2>
                    <p>Bantu dokter dan berikan perawatan terbaik untuk pasien hewan.</p>
                </div>

                {{-- Statistik (Card) --}}
                <table width="100%" border="1" cellpadding="10" style="margin-bottom: 20px;">
                    <thead>
                        <tr>
                            <th width="33%">Total Rekam Medis</th>
                            <th width="33%">Total Reservasi</th>
                            <th width="33%">Total Pet</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <tr>
                            <td>
                                <i class="fas fa-file-medical" style="font-size: 30px;"></i>
                                {{-- DATA SUDAH DISESUAIKAN --}}
                                <h1 style="font-size: 3em; margin: 0;">{{ $total_rekam_medis }}</h1>
                            </td>
                            <td>
                                <i class="fas fa-calendar-check" style="font-size: 30px;"></i>
                                {{-- DATA SUDAH DISESUAIKAN --}}
                                <h1 style="font-size: 3em; margin: 0;">{{ $total_reservasi }}</h1>
                            </td>
                            <td>
                                <i class="fas fa-paw" style="font-size: 30px;"></i>
                                {{-- DATA SUDAH DISESUAIKAN --}}
                                <h1 style="font-size: 3em; margin: 0;">{{ $total_pets }}</h1>
                            </td>
                        </tr>
                    </tbody>
                </table>

                {{-- Akses Cepat --}}
                <table width="100%" cellpadding="10">
                    <tr>
                        <td width="50%" align="center" style="border: 1px solid #ccc; padding: 20px;">
                            {{-- LINK SUDAH DIPERBAIKI --}}
                            <a href="{{ route('perawat.rekam-medis.index') }}">
                                <div><i class="fas fa-file-medical" style="font-size: 35px;"></i></div>
                                <h3>Kelola Rekam Medis</h3>
                                <p>Bantu dokter mempersiapkan data rekam medis</p>
                            </a>
                        </td>
                        <td width="50%" align="center" style="border: 1px solid #ccc; padding: 20px;">
                            {{-- LINK (CONTOH) --}}
                            <a href="#">
                                <div><i class="fas fa-calendar-alt" style="font-size: 35px;"></i></div>
                                <h3>Lihat Jadwal</h3>
                                <p>Lihat jadwal temu dokter dan rawat inap</p>
                            </a>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>
</html>

{{-- Jika Anda tidak pakai @extends, hapus baris @endsection di bawah ini --}}
@endsection