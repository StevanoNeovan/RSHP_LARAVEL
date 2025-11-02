<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use App\Models\Pet;

class DashboardDokterController extends Controller
{

   public function index()
{
    
    $idRoleUserDokter = Auth::user()->roleUser->first()->idrole_user;

    
    $total_rekam_medis = RekamMedis::where('dokter_pemeriksa', $idRoleUserDokter)->count();
    
   
    $total_reservasi_today = TemuDokter::where('idrole_user', $idRoleUserDokter)
                                      ->whereDate('waktu_daftar', now()->today())
                                      ->count();
    
    
    $total_pets = Pet::count();

    return view('dokter.dashboard-dokter', [
        'total_rekam_medis' => $total_rekam_medis,
        'total_reservasi' => $total_reservasi_today, // Kirim data yg baru
        'total_pets' => $total_pets,
        'dokter' => Auth::user(),
    ]);
    }
}