<?php
namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\{RekamMedis, TemuDokter, Pet};
use Illuminate\Support\Facades\Auth;

class DashboardPerawatController extends Controller
{
    public function index()
    {
        $total_rekam_medis = RekamMedis::count();
        $total_reservasi = TemuDokter::whereDate('waktu_daftar', today())->count();
        $total_pets = Pet::count();
        
        // Rekam medis terbaru
        $recentRekamMedis = RekamMedis::with(['temuDokter.pet.pemilik.user', 'temuDokter.roleUser.user'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Jadwal hari ini
        $jadwalHariIni = TemuDokter::whereDate('waktu_daftar', today())
            ->with(['pet.pemilik.user', 'roleUser.user'])
            ->orderBy('no_urut', 'asc')
            ->get();
        
        return view('perawat.dashboard-perawat', compact(
            'total_rekam_medis',
            'total_reservasi',
            'total_pets',
            'recentRekamMedis',
            'jadwalHariIni'
        ));
    }
}
