<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use Carbon\Carbon;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        // Total statistik
        $jumlahPemilik = Pemilik::count();
        $jumlahPet = Pet::count();
        
        // Temu dokter hari ini
        $jumlahTemuDokterHariIni = TemuDokter::whereDate('waktu_daftar', today())->count();
        
        // Temu dokter hari ini dengan detail
        $temuDokterHariIni = TemuDokter::whereDate('waktu_daftar', today())
            ->with(['pet.pemilik.user', 'pet.ras', 'roleUser.user'])
            ->orderBy('no_urut', 'asc')
            ->get();
        
        // Temu dokter minggu ini
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $jumlahTemuDokterMingguIni = TemuDokter::whereBetween('waktu_daftar', [$startOfWeek, $endOfWeek])->count();
        
        // Pendaftaran baru minggu ini
        $pendaftaranBaruMingguIni = Pemilik::count();

        // Pet terdaftar bulan ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $petBulanIni = Pet::count();
        
        // Status breakdown hari ini
        $statusBreakdown = TemuDokter::whereDate('waktu_daftar', today())
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');
        
        // Recent activities (5 pendaftaran terakhir)
        $recentActivities = TemuDokter::with(['pet.pemilik.user', 'pet.ras', 'roleUser.user'])
            ->orderBy('waktu_daftar', 'desc')
            ->limit(5)
            ->get();

        return view('resepsionis.dashboard-resepsionis', compact(
            'jumlahPemilik',
            'jumlahPet',
            'jumlahTemuDokterHariIni',
            'temuDokterHariIni',
            'jumlahTemuDokterMingguIni',
            'pendaftaranBaruMingguIni',
            'petBulanIni',
            'statusBreakdown',
            'recentActivities'
        ));
    }
}