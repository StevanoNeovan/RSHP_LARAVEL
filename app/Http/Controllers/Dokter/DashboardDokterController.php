<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use App\Models\Pet;

class DashboardDokterController extends Controller
{
    public function index()
    {
        // Ambil role_user ID dokter yang login
        $idRoleUserDokter = Auth::user()->roleUser->first()->idrole_user;

        // Total rekam medis yang dibuat dokter ini
        $total_rekam_medis = RekamMedis::where('dokter_pemeriksa', $idRoleUserDokter)->count();
        
        // Total reservasi hari ini untuk dokter ini
        $total_reservasi = TemuDokter::where('idrole_user', $idRoleUserDokter)
                                      ->whereDate('waktu_daftar', now()->today())
                                      ->count();
        
        // Total pasien (semua pet)
        $total_pets = Pet::count();

        // Jadwal temu dokter hari ini
        $jadwal_hari_ini = TemuDokter::where('idrole_user', $idRoleUserDokter)
                                      ->whereDate('waktu_daftar', now()->today())
                                      ->with(['pet.pemilik.user', 'pet.ras'])
                                      ->orderBy('no_urut', 'asc')
                                      ->get();

        return view('dokter.dashboard-dokter', [
            'total_rekam_medis' => $total_rekam_medis,
            'total_reservasi' => $total_reservasi,
            'total_pets' => $total_pets,
            'dokter' => Auth::user(),
            'jadwal_hari_ini' => $jadwal_hari_ini,
        ]);
    }
}
