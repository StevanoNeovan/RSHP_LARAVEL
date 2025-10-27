<h1>Edit Kode Tindakan Terapi</h1>

<a href="{{ route('admin.kode-tindakan-terapi.index') }}">
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

<form action="{{ route('admin.kode-tindakan-terapi.update', $kodeTindakanTerapi->idkode_tindakan_terapi) }}" method="POST">
    @csrf
    @method('PUT')
    
    <table>
        <tr>
            <td><label>Kode:</label></td>
            <td>
                <input type="text" name="kode" 
                       value="{{ old('kode', $kodeTindakanTerapi->kode) }}" 
                       maxlength="5"
                       required>
            </td>
        </tr>
        <tr>
            <td><label>Deskripsi Tindakan Terapi:</label></td>
            <td>
                <textarea name="deskripsi_tindakan_terapi" 
                          rows="4" 
                          cols="50" 
                          required>{{ old('deskripsi_tindakan_terapi', $kodeTindakanTerapi->deskripsi_tindakan_terapi) }}</textarea>
            </td>
        </tr>
        <tr>
            <td><label>Kategori:</label></td>
            <td>
                <select name="idkategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->idkategori }}" 
                                {{ old('idkategori', $kodeTindakanTerapi->idkategori) == $kat->idkategori ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Kategori Klinis:</label></td>
            <td>
                <select name="idkategori_klinis" required>
                    <option value="">-- Pilih Kategori Klinis --</option>
                    @foreach($kategoriKlinis as $klinis)
                        <option value="{{ $klinis->idkategori_klinis }}" 
                                {{ old('idkategori_klinis', $kodeTindakanTerapi->idkategori_klinis) == $klinis->idkategori_klinis ? 'selected' : '' }}>
                            {{ $klinis->nama_kategori_klinis }}
                        </option>
                    @endforeach
                </select>
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