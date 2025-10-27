<h1>Edit Kategori Klinis</h1>

<a href="{{ route('admin.kategori-klinis.index') }}">
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

<form action="{{ route('admin.kategori-klinis.update', $kategoriKlinis->idkategori_klinis) }}" method="POST">
    @csrf
    @method('PUT')
    
    <table>
        <tr>
            <td><label>Nama Kategori Klinis:</label></td>
            <td>
                <input type="text" name="nama_kategori_klinis" 
                       value="{{ old('nama_kategori_klinis', $kategoriKlinis->nama_kategori_klinis) }}" 
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