<h1>Edit Jenis Hewan</h1>

<a href="{{ route('admin.jenis-hewan.index') }}">
    <button>Kembali</button>
</a>

<br><br>

@if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.jenis-hewan.update', $jenisHewan->idjenis_hewan) }}" method="POST">
    @csrf
    @method('PUT')
    
    <table>
        <tr>
            <td><label>Nama Jenis Hewan:</label></td>
            <td>
                <input type="text" name="nama_jenis_hewan" 
                       value="{{ old('nama_jenis_hewan', $jenisHewan->nama_jenis_hewan) }}" 
                       required>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit">Update</button>
                <button type="reset">Reset</button>
            </td>
        </tr>
    </table>
</form>