<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetPemilikController extends Controller
{
   public function index()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik()->with(['pets.ras.jenisHewan'])->first();
        
        if (!$pemilik) {
            return redirect()->route('pemilik.dashboard')
                ->withErrors(['error' => 'Data pemilik tidak ditemukan']);
        }
        
        $pets = $pemilik->pets;
        
        return view('pemilik.pets.index', compact('pets', 'pemilik'));
    }
    
    public function show($id)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        
        if (!$pemilik) {
            return redirect()->route('pemilik.dashboard')
                ->withErrors(['error' => 'Data pemilik tidak ditemukan']);
        }
        
        // ✅ FIXED: Pastikan pet ini milik pemilik yang login
        $pet = $pemilik->pets()
            ->with(['ras.jenisHewan'])
            ->findOrFail($id);
        
        // ✅ FIXED: Ambil temu dokter untuk pet ini
        $temuDokterList = \App\Models\TemuDokter::where('idpet', $pet->idpet)
            ->with(['roleUser.user', 'rekamMedis'])
            ->orderBy('waktu_daftar', 'desc')
            ->get();
        
        // ✅ FIXED: Ambil rekam medis melalui temu dokter
        // Karena struktur: pet → temu_dokter → rekam_medis
        $temuDokterIds = $temuDokterList->pluck('idreservasi_dokter');
        
        $rekamMedisList = \App\Models\RekamMedis::whereIn('idreservasi_dokter', $temuDokterIds)
            ->with(['temuDokter.roleUser.user', 'details.tindakan'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('pemilik.pets.show', compact('pet', 'pemilik', 'temuDokterList', 'rekamMedisList'));
    }
}
