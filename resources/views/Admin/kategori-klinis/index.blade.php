<h1>Daftar Kategori Klinis</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('admin.kategori-klinis.create') }}">
    <button>Tambah Kategori Klinis</button>
</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori Klinis</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kategoriKlinis as $index => $kat)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $kat->nama_kategori_klinis }}</td>
            <td>
                <a href="{{ route('admin.kategori-klinis.edit', $kat->idkategori_klinis) }}">
                    <button>Edit</button>
                </a>
                
                <form action="{{ route('admin.kategori-klinis.destroy', $kat->idkategori_klinis) }}" 
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