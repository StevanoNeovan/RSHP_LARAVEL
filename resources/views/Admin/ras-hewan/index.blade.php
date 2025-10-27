<h1>Daftar Ras Hewan</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('admin.ras-hewan.create') }}">
    <button>Tambah Ras Hewan</button>
</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Ras</th>
            <th>Jenis Hewan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rasHewan as $index => $ras)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $ras->nama_ras }}</td>
            <td>{{ $ras->jenisHewan->nama_jenis_hewan }}</td>
            <td>
                <a href="{{ route('admin.ras-hewan.edit', $ras->idras_hewan) }}">
                    <button>Edit</button>
                </a>
                
                <form action="{{ route('admin.ras-hewan.destroy', $ras->idras_hewan) }}" 
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
            <td colspan="4">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>