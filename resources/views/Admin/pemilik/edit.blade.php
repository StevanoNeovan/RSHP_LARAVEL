<h1>Edit Pemilik</h1>

<a href="{{ route('admin.pemilik.index') }}">
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

<form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
    @csrf
    @method('PUT')
    
    <table>
        <tr>
            <td><label>User:</label></td>
            <td>
                <select name="iduser" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->iduser }}" 
                                {{ old('iduser', $pemilik->iduser) == $user->iduser ? 'selected' : '' }}>
                            {{ $user->nama }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td><label>No. WhatsApp:</label></td>
            <td>
                <input type="text" name="no_wa" 
                       value="{{ old('no_wa', $pemilik->no_wa) }}" 
                       maxlength="45"
                       placeholder="08xxxxxxxxxx"
                       required>
            </td>
        </tr>
        <tr>
            <td><label>Alamat:</label></td>
            <td>
                <textarea name="alamat" 
                          rows="3" 
                          cols="50" 
                          maxlength="100"
                          required>{{ old('alamat', $pemilik->alamat) }}</textarea>
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