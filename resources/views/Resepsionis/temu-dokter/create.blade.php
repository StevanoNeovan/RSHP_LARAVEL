<!doctype html>
<html>
<head><title>Temu Dokter</title></head>
<body>
    <h1>Pendaftaran Temu Dokter</h1>

    <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST">
        @csrf
        <label>Pilih Pet:</label>
        <select name="id_pet">
            @foreach($pets as $pet)
                <option value="{{ $pet->id }}">{{ $pet->nama_hewan }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Daftarkan</button>
    </form>

    <a href="{{ route('resepsionis.dashboard') }}">Kembali</a>
</body>
</html>
