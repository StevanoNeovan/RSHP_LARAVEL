<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TemuDokter;

class TemuDokterPemilikController extends Controller
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
        
        // Ambil semua temu dokter untuk pet-pet tersebut
        $temuDokter = TemuDokter::whereIn('idpet', $petIds)
            ->with([
                'pet.ras.jenisHewan',
                'roleUser.user',
                'rekamMedis'
            ])
            ->orderBy('waktu_daftar', 'desc')
            ->paginate(10);
        
        return view('pemilik.temu-dokter.index', compact('temuDokter', 'pemilik'));
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
        
        // Pastikan temu dokter ini untuk pet milik pemilik yang login
        $temuDokter = TemuDokter::whereIn('idpet', $petIds)
            ->with([
                'pet.ras.jenisHewan',
                'roleUser.user',
                'rekamMedis.details.tindakan'
            ])
            ->findOrFail($id);
        
        return view('pemilik.temu-dokter.show', compact('temuDokter', 'pemilik'));
    }
}
