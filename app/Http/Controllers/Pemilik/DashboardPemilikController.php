<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TemuDokter;
use App\Models\RekamMedis;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $pemilik = $user->pemilik;

        $petIds = $pemilik->pets()->pluck('idpet'); 

        $total_pets = $petIds->count();

        $total_reservasi = TemuDokter::whereIn('idpet', $petIds)->count();

        $total_rekam_medis = RekamMedis::whereIn('idpet', $petIds)->count();

        return view('pemilik.dashboard-pemilik', [
            'user' => $user, 
            'total_pets' => $total_pets,
            'total_reservasi' => $total_reservasi,
            'total_rekam_medis' => $total_rekam_medis,
        ]);
    }
}