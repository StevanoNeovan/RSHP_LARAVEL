<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pemilik</th>
            <th>No Wa</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pemilik as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->no_wa }}</td>
            <td>{{ $item->alamat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>