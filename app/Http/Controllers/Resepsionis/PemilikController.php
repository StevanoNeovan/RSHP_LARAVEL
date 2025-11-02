<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function create()
    {
        return view('resepsionis.pemilik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:15',
        ]);

        Pemilik::create($request->all());

        return redirect()->route('resepsionis.dashboard')->with('success', 'Data pemilik berhasil ditambahkan!');
    }
}
