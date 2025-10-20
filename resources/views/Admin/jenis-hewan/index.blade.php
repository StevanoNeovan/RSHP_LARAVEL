<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID Jenis Hewan</th>
            <th>Nama Jenis Hewan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jenisHewan as $index => $hewan)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $hewan->nama_jenis_hewan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>