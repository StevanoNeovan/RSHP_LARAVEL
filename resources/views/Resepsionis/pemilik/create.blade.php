<!doctype html>
<html>
<head><title>Registrasi Pemilik</title></head>
<body>
    <h1>Registrasi Pemilik</h1>

    <form action="{{ route('resepsionis.pemilik.store') }}" method="POST">
        @csrf
        <label>Nama Pemilik:</label>
        <input type="text" name="nama_pemilik"><br><br>

        <label>Alamat:</label>
        <input type="text" name="alamat"><br><br>

        <label>No. Telepon:</label>
        <input type="text" name="no_telp"><br><br>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('resepsionis.dashboard') }}">Kembali</a>
</body>
</html>
