<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class PasienDokterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        
        $pasien = Pet::with(['pemilik.user', 'ras.jenisHewan'])
            ->when($search, function($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhereHas('pemilik.user', function($q) use ($search) {
                          $q->where('nama', 'like', "%{$search}%");
                      });
            })
            ->orderBy('nama', 'asc')
            ->paginate(12);
        
        return view('dokter.pasien.index', compact('pasien', 'search'));
    }
    
    public function show($id)
    {
        $pasien = Pet::with(['pemilik.user', 'ras.jenisHewan', 'temuDokter.rekamMedis'])
            ->findOrFail($id);
        
        // Ambil rekam medis via temu dokter
        $temuDokterIds = $pasien->temuDokter->pluck('idreservasi_dokter');
        
        $rekamMedisList = \App\Models\RekamMedis::whereIn('idreservasi_dokter', $temuDokterIds)
            ->with(['temuDokter.roleUser.user', 'details.tindakan'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('dokter.pasien.show', compact('pasien', 'rekamMedisList'));
    }
}