<?php
namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\TemuDokter;

class TemuDokterDokterController extends Controller
{
    public function index()
    {
        $idRoleUserDokter = Auth::user()->roleUser->first()->idrole_user;
        
        $temuDokter = TemuDokter::where('idrole_user', $idRoleUserDokter)
            ->with(['pet.pemilik.user', 'pet.ras', 'rekamMedis'])
            ->orderBy('waktu_daftar', 'desc')
            ->paginate(15);
        
        return view('dokter.temu-dokter.index', compact('temuDokter'));
    }
    
    public function show($id)
    {
        $idRoleUserDokter = Auth::user()->roleUser->first()->idrole_user;
        
        // Pastikan temu dokter ini untuk dokter yang login
        $temuDokter = TemuDokter::where('idrole_user', $idRoleUserDokter)
            ->with(['pet.pemilik.user', 'pet.ras', 'rekamMedis.details.tindakan'])
            ->findOrFail($id);
        
        return view('dokter.temu-dokter.show', compact('temuDokter'));
    }
}