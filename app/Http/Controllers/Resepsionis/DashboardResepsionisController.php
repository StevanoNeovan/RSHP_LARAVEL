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
        $jumlahTemuDokter = TemuDokter::whereDate('waktu_daftar', today())->count();

        return view('resepsionis.dashboard-resepsionis', compact('jumlahPemilik', 'jumlahPet', 'jumlahTemuDokter'));
    }
}
