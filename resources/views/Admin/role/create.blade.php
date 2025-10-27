<h1>Tambah Role</h1>

<a href="{{ route('admin.role.index') }}">
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

<form action="{{ route('admin.role.store') }}" method="POST">
    @csrf
    
    <table>
        <tr>
            <td><label>Nama Role:</label></td>
            <td>
                <input type="text" name="nama_role" 
                       value="{{ old('nama_role') }}" 
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