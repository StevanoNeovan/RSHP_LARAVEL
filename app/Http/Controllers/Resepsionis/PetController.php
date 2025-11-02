<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function create()
    {
        $pemilik = Pemilik::all();
        $jenis = JenisHewan::all();
        $ras = RasHewan::all();
        return view('resepsionis.pet.create', compact('pemilik', 'jenis', 'ras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hewan' => 'required|string|max:50',
            'id_pemilik' => 'required|exists:pemilik,id',
            'id_jenis' => 'required|exists:jenis_hewan,id',
            'id_ras' => 'required|exists:ras_hewan,id',
            'umur' => 'nullable|integer',
            'jk' => 'required|string|max:10',
        ]);

        Pet::create($request->all());

        return redirect()->route('resepsionis.dashboard')->with('success', 'Data pet berhasil ditambahkan!');
    }
}
