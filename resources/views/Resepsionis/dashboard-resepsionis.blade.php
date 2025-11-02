<!doctype html>
<html>
<head>
    <title>Dashboard Resepsionis</title>
</head>
<body>
    <h1>Dashboard Resepsionis</h1>
    <p>Selamat datang, {{ Auth::user()->name ?? 'Resepsionis' }}</p>
    <hr>

    <h2>Data Singkat</h2>
    <ul>
        <li>Jumlah Pemilik: {{ $jumlahPemilik }}</li>
        <li>Jumlah Pet: {{ $jumlahPet }}</li>
        <li>Temu Dokter Hari Ini: {{ $jumlahTemuDokter }}</li>
    </ul>

    <hr>
    <h2>Menu</h2>
    <ul>
        <li><a href="{{ route('resepsionis.pemilik.create') }}">Registrasi Pemilik</a></li>
        <li><a href="{{ route('resepsionis.pet.create') }}">Registrasi Pet</a></li>
        <li><a href="{{ route('resepsionis.temu-dokter.create') }}">Temu Dokter</a></li>
    </ul>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
</body>
</html>
