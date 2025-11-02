@extends('layouts.app')

@section('content')
<div class="container" style="padding:20px;">
    <h1>Manajemen User (Read-only)</h1>
    <p>Total user: {{ $users->count() }}</p>
    <hr>

    <table border="1" cellpadding="6" cellspacing="0" style="width:100%; border-collapse:collapse;">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role (aktif)</th>
                <th>Semua Role (history)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $u)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $u->nama }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        {{-- tampilkan role yang status == 1 (aktif) jika ada --}}
                        @php
                            $activeRole = $u->roleUser->firstWhere('status', 1);
                        @endphp

                        @if($activeRole && $activeRole->role)
                            {{ $activeRole->role->nama_role }} (id: {{ $activeRole->idrole }})
                        @else
                            - (tidak ada role aktif)
                        @endif
                    </td>
                    <td>
                        @if($u->roleUser && $u->roleUser->count())
                            <ul style="margin:0; padding-left:16px;">
                                @foreach($u->roleUser as $ru)
                                    <li>
                                        {{ $ru->role->nama_role ?? 'Role terhapus' }} 
                                        @if($ru->status == 1) <strong>(aktif)</strong> @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align:center;">Tidak ada data user.</td></tr>
            @endforelse
        </tbody>
    </table>

    <p style="margin-top:12px;">
        <a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
    </p>
</div>
@endsection
