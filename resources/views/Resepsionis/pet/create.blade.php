<!doctype html>
<html>
<head><title>Registrasi Pet</title></head>
<body>
    <h1>Registrasi Pet</h1>

    <form action="{{ route('resepsionis.pet.store') }}" method="POST">
        @csrf
        <label>Nama Hewan:</label>
        <input type="text" name="nama_hewan"><br><br>

        <label>Pemilik:</label>
        <select name="id_pemilik">
            @foreach($pemilik as $p)
                <option value="{{ $p->id }}">{{ $p->nama_pemilik }}</option>
            @endforeach
        </select><br><br>

        <label>Jenis Hewan:</label>
        <select name="id_jenis">
            @foreach($jenis as $j)
                <option value="{{ $j->id }}">{{ $j->nama_jenis }}</option>
            @endforeach
        </select><br><br>

        <label>Ras:</label>
        <select name="id_ras">
            @foreach($ras as $r)
                <option value="{{ $r->id }}">{{ $r->nama_ras }}</option>
            @endforeach
        </select><br><br>

        <label>Umur (tahun):</label>
        <input type="number" name="umur"><br><br>

        <label>Jenis Kelamin:</label>
        <input type="text" name="jk"><br><br>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('resepsionis.dashboard') }}">Kembali</a>
</body>
</html>
