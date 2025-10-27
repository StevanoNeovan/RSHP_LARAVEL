<h1>Tambah Kategori</h1>

<a href="{{ route('admin.kategori.index') }}">
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

<form action="{{ route('admin.kategori.store') }}" method="POST">
    @csrf
    
    <table>
        <tr>
            <td><label>Nama Kategori:</label></td>
            <td>
                <input type="text" name="nama_kategori" 
                       value="{{ old('nama_kategori') }}" 
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