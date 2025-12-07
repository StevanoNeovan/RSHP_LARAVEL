<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TemuDokterResepsionisController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->query('tanggal', today()->format('Y-m-d'));
        
        $temuDokter = TemuDokter::whereDate('waktu_daftar', $tanggal)
            ->with(['pet.pemilik.user', 'pet.ras', 'roleUser.user'])
            ->orderBy('no_urut', 'asc')
            ->get();
        
        return view('resepsionis.temu-dokter.index', compact('temuDokter', 'tanggal'));
    }
    
    public function create()
    {
        $pets = Pet::with(['pemilik.user', 'ras.jenisHewan'])->get();
        $dokter = RoleUser::with(['user', 'role'])
            ->where('idrole', 2)
            ->where('status', 1)
            ->get();
        
        // Next number for today
        $lastNumber = TemuDokter::whereDate('waktu_daftar', today())->max('no_urut');
        $nextNumber = $lastNumber ? $lastNumber + 1 : 1;
        
        return view('resepsionis.temu-dokter.create', compact('pets', 'dokter', 'nextNumber'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'waktu_daftar' => 'required|date',
        ]);
        
        $date = Carbon::parse($validated['waktu_daftar'])->startOfDay();
        $lastNumber = TemuDokter::whereDate('waktu_daftar', $date)->max('no_urut');
        $nextNumber = $lastNumber ? $lastNumber + 1 : 1;
        
        TemuDokter::create([
            'idpet' => $validated['idpet'],
            'idrole_user' => $validated['idrole_user'],
            'waktu_daftar' => $validated['waktu_daftar'],
            'status' => 'W', // Waiting
            'no_urut' => $nextNumber
        ]);
        
        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Temu dokter berhasil ditambahkan dengan No. Urut ' . $nextNumber);
    }
    
    public function edit($id)
    {
        $temuDokter = TemuDokter::findOrFail($id);
        $pets = Pet::with(['pemilik.user', 'ras.jenisHewan'])->get();
        $dokter = RoleUser::with(['user', 'role'])
            ->where('idrole', 2)
            ->where('status', 1)
            ->get();
        
        return view('resepsionis.temu-dokter.edit', compact('temuDokter', 'pets', 'dokter'));
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'waktu_daftar' => 'required|date',
            'status' => 'required|in:W,P,S,B',
        ]);
        
        $temuDokter = TemuDokter::findOrFail($id);
        $temuDokter->update($validated);
        
        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Data temu dokter berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $temuDokter = TemuDokter::findOrFail($id);
        
        // Check if has rekam medis
        if ($temuDokter->rekamMedis) {
            return back()->withErrors(['error' => 'Tidak dapat menghapus temu dokter yang sudah memiliki rekam medis']);
        }
        
        $temuDokter->delete();
        
        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Data temu dokter berhasil dihapus');
    }
    
    public function updateStatus($id, $status)
    {
        $temuDokter = TemuDokter::findOrFail($id);
        $temuDokter->update(['status' => $status]);
        
        $statusText = [
            'W' => 'Menunggu',
            'P' => 'Dalam Pemeriksaan',
            'S' => 'Selesai',
            'B' => 'Batal'
        ];
        
        return redirect()->back()
            ->with('success', "Status berhasil diubah menjadi: {$statusText[$status]}");
    }
}