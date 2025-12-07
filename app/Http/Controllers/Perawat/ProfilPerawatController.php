<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;
use App\Models\Perawat;

class ProfilPerawatController extends Controller
{
    /**
     * Tampilkan halaman profil (UPDATED)
     */
    public function index()
    {
        $user = Auth::user();
        $roleUser = $user->roleUser->first();
        
        if (!$roleUser) {
            return redirect()->route('perawat.dashboard')
                ->withErrors(['error' => 'Data role user tidak ditemukan']);
        }
        
        // ✅ AMBIL DATA PERAWAT
        $perawat = Perawat::where('iduser', $user->iduser)->first();
        
        // ✅ Jika belum ada data perawat, redirect ke complete
        if (!$perawat) {
            return redirect()->route('perawat.profil.complete')
                ->with('info', 'Silakan lengkapi data profil Anda terlebih dahulu');
        }
        
        // Statistik perawat (sesuaikan dengan kebutuhan)
        $total_rekam_medis = RekamMedis::count();
        
        $rekam_medis_bulan_ini = RekamMedis::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        return view('perawat.profil', compact('user', 'roleUser', 'perawat', 'total_rekam_medis', 'rekam_medis_bulan_ini'));
    }

    /**
     * ✅ NEW: Tampilkan form lengkapi profil (first-time setup)
     */
    public function showCompleteForm()
    {
        $user = Auth::user();
        
        // Kalau sudah punya data perawat, redirect ke profil biasa
        $perawat = Perawat::where('iduser', $user->iduser)->first();
        if ($perawat) {
            return redirect()->route('perawat.profil')
                ->with('info', 'Profil Anda sudah lengkap');
        }
        
        return view('perawat.profil-complete', compact('user'));
    }

    /**
     * ✅ NEW: Simpan data profil pertama kali
     */
    public function storeComplete(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'alamat' => 'required|string|max:100|min:5',
            'no_hp' => 'required|string|max:45|min:10|regex:/^[0-9]+$/',
            'pendidikan' => 'required|string|max:100|min:3',
            'jenis_kelamin' => 'required|in:L,P',
        ], [
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 5 karakter',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'no_hp.min' => 'Nomor HP minimal 10 digit',
            'no_hp.regex' => 'Nomor HP hanya boleh angka',
            'pendidikan.required' => 'Pendidikan wajib diisi',
            'pendidikan.min' => 'Pendidikan minimal 3 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid',
        ]);
        
        // Cek apakah sudah ada (prevent duplicate)
        $exists = Perawat::where('iduser', Auth::id())->exists();
        if ($exists) {
            return redirect()->route('perawat.profil')
                ->with('info', 'Profil Anda sudah lengkap');
        }
        
        // Insert data
        Perawat::create([
            'iduser' => Auth::id(),
            'alamat' => ucfirst(trim($validated['alamat'])),
            'no_hp' => $this->formatNoHP($validated['no_hp']),
            'pendidikan' => ucwords(strtolower(trim($validated['pendidikan']))),
            'jenis_kelamin' => $validated['jenis_kelamin'],
        ]);
        
        return redirect()->route('perawat.dashboard')
            ->with('success', 'Profil berhasil dilengkapi! Selamat bergabung.');
    }

    /**
     * ✅ NEW: Update profil
     */
    public function update(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'alamat' => 'required|string|max:100|min:5',
            'no_hp' => 'required|string|max:45|min:10|regex:/^[0-9]+$/',
            'pendidikan' => 'required|string|max:100|min:3',
            'jenis_kelamin' => 'required|in:L,P',
        ], [
            'alamat.required' => 'Alamat wajib diisi',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'pendidikan.required' => 'Pendidikan wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
        ]);
        
        // Update data
        $perawat = Perawat::where('iduser', Auth::id())->firstOrFail();
        $perawat->update([
            'alamat' => ucfirst(trim($validated['alamat'])),
            'no_hp' => $this->formatNoHP($validated['no_hp']),
            'pendidikan' => ucwords(strtolower(trim($validated['pendidikan']))),
            'jenis_kelamin' => $validated['jenis_kelamin'],
        ]);
        
        return back()->with('success', 'Profil berhasil diupdate!');
    }

    /**
     * Helper: Format nomor HP
     */
    private function formatNoHP(string $no): string
    {
        // Remove all non-numeric characters
        $no = preg_replace('/[^0-9]/', '', $no);
        
        // If starts with 0, replace with 62
        if (substr($no, 0, 1) === '0') {
            $no = '62' . substr($no, 1);
        }
        
        // If doesn't start with 62, add it
        if (substr($no, 0, 2) !== '62') {
            $no = '62' . $no;
        }
        
        return $no;
    }
}