<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;

class ProfilDokterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roleUser = $user->roleUser->first();
        
        if (!$roleUser) {
            return redirect()->route('dokter.dashboard')
                ->withErrors(['error' => 'Data role user tidak ditemukan']);
        }
        
        // Statistik dokter
        $total_rekam_medis = RekamMedis::where('dokter_pemeriksa', $roleUser->idrole_user)->count();
        
        $rekam_medis_bulan_ini = RekamMedis::where('dokter_pemeriksa', $roleUser->idrole_user)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        return view('dokter.profil', compact('user', 'roleUser', 'total_rekam_medis', 'rekam_medis_bulan_ini'));
    }
}