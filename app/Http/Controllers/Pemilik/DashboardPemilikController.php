<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TemuDokter;
use App\Models\RekamMedis;

class DashboardPemilikController extends Controller
{
    /**
     * Display dashboard for Pemilik
     */
    public function index()
    {
        $user = Auth::user();

        // ✅ VALIDASI: Pastikan user punya data pemilik
        if (!$user->pemilik) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Data pemilik tidak ditemukan. Hubungi administrator.']);
        }

        // Ambil data pemilik dengan relasi pets
        $pemilik = $user->pemilik()->with(['pets.ras.jenisHewan'])->first();

        // ✅ Ambil semua ID pet yang dimiliki pemilik ini
        $petIds = $pemilik->pets->pluck('idpet')->toArray();

        // ✅ Hitung total pets
        $total_pets = count($petIds);

        // ✅ Hitung total reservasi (temu dokter) untuk semua pet milik pemilik ini
        $total_reservasi = 0;
        if ($total_pets > 0) {
            $total_reservasi = TemuDokter::whereIn('idpet', $petIds)->count();
        }

        // ✅ Hitung total rekam medis untuk semua pet milik pemilik ini
        // Karena rekam medis tidak langsung connect ke pet, kita cari via temu_dokter
        $total_rekam_medis = 0;
        if ($total_pets > 0) {
            // Ambil semua ID temu dokter untuk pet-pet ini
            $temuDokterIds = TemuDokter::whereIn('idpet', $petIds)
                ->pluck('idreservasi_dokter')
                ->toArray();
            
            // Hitung rekam medis yang terkait dengan temu dokter tersebut
            if (count($temuDokterIds) > 0) {
                $total_rekam_medis = RekamMedis::whereIn('idreservasi_dokter', $temuDokterIds)->count();
            }
        }

        // ✅ Ambil recent activities (opsional untuk dashboard)
        $recent_temu_dokter = [];
        if ($total_pets > 0) {
            $recent_temu_dokter = TemuDokter::whereIn('idpet', $petIds)
                ->with([
                    'pet.ras',
                    'roleUser.user',
                    'rekamMedis'
                ])
                ->orderBy('waktu_daftar', 'desc')
                ->limit(5)
                ->get();
        }

        return view('pemilik.dashboard-pemilik', [
            'user' => $user,
            'pemilik' => $pemilik,
            'total_pets' => $total_pets,
            'total_reservasi' => $total_reservasi,
            'total_rekam_medis' => $total_rekam_medis,
            'recent_temu_dokter' => $recent_temu_dokter,  // ✅ Data tambahan untuk dashboard
        ]);
    }
}