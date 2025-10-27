<h1>Tambah Jenis Hewan</h1>

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

<form action="{{ route('admin.jenis-hewan.store') }}" method="POST">
    @csrf
    
    <table>
        <tr>
            <td><label>Nama Jenis Hewan:</label></td>
            <td>
                <input type="text" name="nama_jenis_hewan" 
                       value="{{ old('nama_jenis_hewan') }}" 
                       required>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit">Simpan</button>
                <button type="reset">Reset</button>
            </td>
        </tr>
    </table>
</form>