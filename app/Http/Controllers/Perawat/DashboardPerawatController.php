<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use App\Models\Pet;

class DashboardPerawatController extends Controller
{
    public function index()
    {
      
        $total_rekam_medis = RekamMedis::count();
        $total_reservasi = TemuDokter::count();
        $total_pets = Pet::count();

       
        $perawat = Auth::user();

        return view('perawat.dashboard-perawat', [
            'total_rekam_medis' => $total_rekam_medis,
            'total_reservasi' => $total_reservasi,
            'total_pets' => $total_pets,
            'perawat' => $perawat,
        ]);
    }
}