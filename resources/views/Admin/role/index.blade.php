<h1>Daftar Role</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('admin.role.create') }}">
    <button>Tambah Role</button>
</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($role as $index => $r)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $r->nama_role }}</td>
            <td>
                <a href="{{ route('admin.role.edit', $r->idrole) }}">
                    <button>Edit</button>
                </a>
                
                <form action="{{ route('admin.role.destroy', $r->idrole) }}" 
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
            <td colspan="3">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>