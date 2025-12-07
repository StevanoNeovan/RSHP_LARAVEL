<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;
use App\Models\TemuDokter;

class RekamMedisPemilikController extends Controller
{
   public function index()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        
        if (!$pemilik) {
            return redirect()->route('pemilik.dashboard')
                ->withErrors(['error' => 'Data pemilik tidak ditemukan']);
        }
        
        // Ambil semua pet milik pemilik ini
        $petIds = $pemilik->pets->pluck('idpet');
        
        // Ambil ID temu dokter untuk pet-pet tersebut
        $temuDokterIds = TemuDokter::whereIn('idpet', $petIds)
            ->pluck('idreservasi_dokter');
        
        // Ambil rekam medis berdasarkan temu dokter
        $rekamMedis = RekamMedis::whereIn('idreservasi_dokter', $temuDokterIds)
            ->with([
                'temuDokter.pet.ras.jenisHewan',
                'temuDokter.roleUser.user',
                'details.tindakan.kategori',
                'details.tindakan.kategoriKlinis'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('pemilik.rekam-medis.index', compact('rekamMedis', 'pemilik'));
    }
    
    public function show($id)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        
        if (!$pemilik) {
            return redirect()->route('pemilik.dashboard')
                ->withErrors(['error' => 'Data pemilik tidak ditemukan']);
        }
        
        $petIds = $pemilik->pets->pluck('idpet');
        $temuDokterIds = TemuDokter::whereIn('idpet', $petIds)
            ->pluck('idreservasi_dokter');
        
        // Pastikan rekam medis ini untuk pet milik pemilik yang login
        $rekamMedis = RekamMedis::whereIn('idreservasi_dokter', $temuDokterIds)
            ->with([
                'temuDokter.pet.ras.jenisHewan',
                'temuDokter.roleUser.user',
                'details.tindakan.kategori',
                'details.tindakan.kategoriKlinis'
            ])
            ->findOrFail($id);
        
        return view('pemilik.rekam-medis.show', compact('rekamMedis', 'pemilik'));
    }
}
