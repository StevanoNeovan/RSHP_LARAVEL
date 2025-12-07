<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        $jumlahPemilik = Pemilik::count();
        $jumlahPet = Pet::count();
        $jumlahTemuDokterHariIni = TemuDokter::whereDate('waktu_daftar', today())->count();
        
        // Temu dokter hari ini
        $temuDokterHariIni = TemuDokter::whereDate('waktu_daftar', today())
            ->with(['pet.pemilik.user', 'pet.ras', 'roleUser.user'])
            ->orderBy('no_urut', 'asc')
            ->get();

        return view('resepsionis.dashboard-resepsionis', compact(
            'jumlahPemilik', 
            'jumlahPet', 
            'jumlahTemuDokterHariIni',
            'temuDokterHariIni'
        ));
    }
}
