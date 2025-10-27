<h1>Edit Role User</h1>

<a href="{{ route('admin.role-user.index') }}">
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

<form action="{{ route('admin.role-user.update', $roleUser->idrole_user) }}" method="POST">
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
                                {{ old('iduser', $roleUser->iduser) == $user->iduser ? 'selected' : '' }}>
                            {{ $user->nama }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Role:</label></td>
            <td>
                <select name="idrole" required>
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->idrole }}" 
                                {{ old('idrole', $roleUser->idrole) == $role->idrole ? 'selected' : '' }}>
                            {{ $role->nama_role }}
                        </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Status:</label></td>
            <td>
                <select name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="1" {{ old('status', $roleUser->status) == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status', $roleUser->status) == '0' ? 'selected' : '' }}>Nonaktif</option>
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