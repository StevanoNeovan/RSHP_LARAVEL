<h1>Edit Ras Hewan</h1>

<a href="{{ route('admin.ras-hewan.index') }}">
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

<form action="{{ route('admin.ras-hewan.update', $rasHewan->idras_hewan) }}" method="POST">
    @csrf
    @method('PUT')
    
    <table>
        <tr>
            <td><label>Jenis Hewan:</label></td>
            <td>
                <select name="idjenis_hewan" required>
                    <option value="">-- Pilih Jenis Hewan --</option>
                    @foreach($jenisHewan as $jenis)
                        <option value="{{ $jenis->idjenis_hewan }}" 
                                {{ old('idjenis_hewan', $rasHewan->idjenis_hewan) == $jenis->idjenis_hewan ? 'selected' : '' }}>
                            {{ $jenis->nama_jenis_hewan }}
                        </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Nama Ras:</label></td>
            <td>
                <input type="text" name="nama_ras" 
                       value="{{ old('nama_ras', $rasHewan->nama_ras) }}" 
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