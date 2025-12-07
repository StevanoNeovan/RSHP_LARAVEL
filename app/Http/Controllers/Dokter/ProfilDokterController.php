<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;
use App\Models\Dokter;

class ProfilDokterController extends Controller
{
    /**
     * Tampilkan halaman profil (existing - UPDATED)
     */
    public function index()
    {
        $user = Auth::user();
        $roleUser = $user->roleUser->first();
        
        if (!$roleUser) {
            return redirect()->route('dokter.dashboard')
                ->withErrors(['error' => 'Data role user tidak ditemukan']);
        }
        
        // ✅ AMBIL DATA DOKTER
        $dokter = Dokter::where('iduser', $user->iduser)->first();
        
        // ✅ Jika belum ada data dokter, redirect ke complete
        if (!$dokter) {
            return redirect()->route('dokter.profil.complete')
                ->with('info', 'Silakan lengkapi data profil Anda terlebih dahulu');
        }
        
        // Statistik dokter
        $total_rekam_medis = RekamMedis::where('dokter_pemeriksa', $roleUser->idrole_user)->count();
        
        $rekam_medis_bulan_ini = RekamMedis::where('dokter_pemeriksa', $roleUser->idrole_user)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        return view('dokter.profil', compact('user', 'roleUser', 'dokter', 'total_rekam_medis', 'rekam_medis_bulan_ini'));
    }

    /**
     * ✅ NEW: Tampilkan form lengkapi profil (first-time setup)
     */
    public function showCompleteForm()
    {
        $user = Auth::user();
        
        // Kalau sudah punya data dokter, redirect ke profil biasa
        $dokter = Dokter::where('iduser', $user->iduser)->first();
        if ($dokter) {
            return redirect()->route('dokter.profil')
                ->with('info', 'Profil Anda sudah lengkap');
        }
        
        return view('dokter.profil-complete', compact('user'));
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
            'bidang_dokter' => 'required|string|max:100|min:3',
            'jenis_kelamin' => 'required|in:L,P',
        ], [
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 5 karakter',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'no_hp.min' => 'Nomor HP minimal 10 digit',
            'no_hp.regex' => 'Nomor HP hanya boleh angka',
            'bidang_dokter.required' => 'Bidang dokter wajib diisi',
            'bidang_dokter.min' => 'Bidang dokter minimal 3 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid',
        ]);
        
        // Cek apakah sudah ada (prevent duplicate)
        $exists = Dokter::where('iduser', Auth::id())->exists();
        if ($exists) {
            return redirect()->route('dokter.profil')
                ->with('info', 'Profil Anda sudah lengkap');
        }
        
        // Insert data
        Dokter::create([
            'iduser' => Auth::id(),
            'alamat' => ucfirst(trim($validated['alamat'])),
            'no_hp' => $this->formatNoHP($validated['no_hp']),
            'bidang_dokter' => ucwords(strtolower(trim($validated['bidang_dokter']))),
            'jenis_kelamin' => $validated['jenis_kelamin'],
        ]);
        
        return redirect()->route('dokter.dashboard')
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
            'bidang_dokter' => 'required|string|max:100|min:3',
            'jenis_kelamin' => 'required|in:L,P',
        ], [
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 5 karakter',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'no_hp.min' => 'Nomor HP minimal 10 digit',
            'no_hp.regex' => 'Nomor HP hanya boleh angka',
            'bidang_dokter.required' => 'Bidang dokter wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
        ]);
        
        // Update data
        $dokter = Dokter::where('iduser', Auth::id())->firstOrFail();
        $dokter->update([
            'alamat' => ucfirst(trim($validated['alamat'])),
            'no_hp' => $this->formatNoHP($validated['no_hp']),
            'bidang_dokter' => ucwords(strtolower(trim($validated['bidang_dokter']))),
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