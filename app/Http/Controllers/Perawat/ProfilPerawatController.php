<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;

class ProfilPerawatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roleUser = $user->roleUser->first();
        
        if (!$roleUser) {
            return redirect()->route('perawat.dashboard')
                ->withErrors(['error' => 'Data role user tidak ditemukan']);
        }
        
        // Statistik perawat
        $total_rekam_medis = RekamMedis::where('perawat_pemeriksa', $roleUser->idrole_user)->count();
        
        $rekam_medis_bulan_ini = RekamMedis::where('perawat_pemeriksa', $roleUser->idrole_user)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        return view('perawat.profil', compact('user', 'roleUser', 'total_rekam_medis', 'rekam_medis_bulan_ini'));
    }
}