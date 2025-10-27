<h1>Daftar Kategori</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('admin.kategori.create') }}">
    <button>Tambah Kategori</button>
</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kategori as $index => $kat)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $kat->nama_kategori }}</td>
            <td>
                <a href="{{ route('admin.kategori.edit', $kat->idkategori) }}">
                    <button>Edit</button>
                </a>
                
                <form action="{{ route('admin.kategori.destroy', $kat->idkategori) }}" 
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