<h1>Daftar User dengan Role</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('admin.role-user.create') }}">
    <button>Tambah Role User</button>
</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($roleUsers as $index => $roleUser)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $roleUser->user->nama }}</td>
            <td>{{ $roleUser->user->email }}</td>
            <td>{{ $roleUser->role->nama_role }}</td>
            <td>
                @if($roleUser->status == 1)
                    <span style="color: green;">Aktif</span>
                @else
                    <span style="color: red;">Nonaktif</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.role-user.edit', $roleUser->idrole_user) }}">
                    <button>Edit</button>
                </a>
                
                <form action="{{ route('admin.role-user.destroy', $roleUser->idrole_user) }}" 
                      method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>