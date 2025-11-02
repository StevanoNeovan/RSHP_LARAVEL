<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{
    public function create()
    {
        $pets = Pet::all();
        return view('resepsionis.temu-dokter.create', compact('pets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pet' => 'required|exists:pet,id',
        ]);

        $today = now()->toDateString();
        $no_urut = TemuDokter::whereDate('created_at', $today)->count() + 1;

        TemuDokter::create([
            'id_pet' => $request->id_pet,
            'tanggal' => $today,
            'no_urut' => $no_urut,
            'status' => 'Menunggu',
        ]);

        return redirect()->route('resepsionis.dashboard')->with('success', 'Pendaftaran temu dokter berhasil!');
    }
}
