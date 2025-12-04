<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;
use Carbon\Carbon;

class TemuDokterController extends Controller
{
    /**
     * Display a listing of temu dokter
     */
    public function index()
    {
        $temuDokter = TemuDokter::with(['pet.pemilik.user', 'roleUser.user', 'roleUser.role'])
            ->orderBy('waktu_daftar', 'desc')
            ->get();
        
        return view('Admin.temu-dokter.index', compact('temuDokter'));
    }

    /**
     * Show the form for creating a new temu dokter
     */
    public function create()
    {
        $pets = Pet::with(['pemilik.user', 'ras.jenisHewan'])->get();
        
        // Get dokter (role_user dengan idrole = 2 dan status = 1)
        $dokter = RoleUser::with(['user', 'role'])
            ->where('idrole', 2)
            ->where('status', 1)
            ->get();
        
        // Get nomor urut hari ini
        $today = Carbon::today();
        $lastNumber = TemuDokter::whereDate('waktu_daftar', $today)->max('no_urut');
        $nextNumber = $lastNumber ? $lastNumber + 1 : 1;
        
        return view('Admin.temu-dokter.create', compact('pets', 'dokter', 'nextNumber'));
    }

    /**
     * Store a newly created temu dokter
     */
    public function store(Request $request)
    {
        $validated = $this->validateTemuDokter($request);
        $this->createTemuDokter($validated);

        return redirect()->route('admin.temu-dokter.index')
            ->with('success', 'Reservasi Temu Dokter berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified temu dokter
     */
    public function edit($id)
    {
        $temuDokter = TemuDokter::findOrFail($id);
        $pets = Pet::with(['pemilik.user', 'ras.jenisHewan'])->get();
        
        $dokter = RoleUser::with(['user', 'role'])
            ->where('idrole', 2)
            ->where('status', 1)
            ->get();
        
        return view('Admin.temu-dokter.edit', compact('temuDokter', 'pets', 'dokter'));
    }

    /**
     * Update the specified temu dokter
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validateTemuDokter($request, $id);
        
        $temuDokter = TemuDokter::findOrFail($id);
        $temuDokter->update([
            'idpet' => $validated['idpet'],
            'idrole_user' => $validated['idrole_user'],
            'status' => $validated['status'],
            'waktu_daftar' => $validated['waktu_daftar']
        ]);

        return redirect()->route('admin.temu-dokter.index')
            ->with('success', 'Data Temu Dokter berhasil diupdate');
    }

    /**
     * Remove the specified temu dokter
     */
    public function destroy($id)
    {
        $temuDokter = TemuDokter::findOrFail($id);
        $temuDokter->delete();

        return redirect()->route('admin.temu-dokter.index')
            ->with('success', 'Data Temu Dokter berhasil dihapus');
    }

    /**
     * Update status temu dokter
     */
    public function updateStatus($id, $status)
    {
        $temuDokter = TemuDokter::findOrFail($id);
        $temuDokter->update(['status' => $status]);

        $statusText = $this->getStatusText($status);
        return redirect()->back()
            ->with('success', "Status berhasil diubah menjadi: {$statusText}");
    }

    // ========== HELPER FUNCTIONS ==========

    /**
     * Validate temu dokter data
     */
    private function validateTemuDokter(Request $request, $id = null)
    {
        return $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'waktu_daftar' => 'required|date',
            'status' => 'required|in:W,P,S,B'
        ], [
            'idpet.required' => 'Pet wajib dipilih',
            'idpet.exists' => 'Pet tidak valid',
            'idrole_user.required' => 'Dokter wajib dipilih',
            'idrole_user.exists' => 'Dokter tidak valid',
            'waktu_daftar.required' => 'Waktu daftar wajib diisi',
            'waktu_daftar.date' => 'Format waktu tidak valid',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid'
        ]);
    }

    /**
     * Create new temu dokter
     */
    private function createTemuDokter(array $validated)
    {
        // Get nomor urut berdasarkan tanggal
        $date = Carbon::parse($validated['waktu_daftar'])->startOfDay();
        $lastNumber = TemuDokter::whereDate('waktu_daftar', $date)->max('no_urut');
        $nextNumber = $lastNumber ? $lastNumber + 1 : 1;

        TemuDokter::create([
            'idpet' => $validated['idpet'],
            'idrole_user' => $validated['idrole_user'],
            'waktu_daftar' => $validated['waktu_daftar'],
            'status' => $validated['status'],
            'no_urut' => $nextNumber
        ]);
    }

    /**
     * Get status badge class
     */
    public static function getStatusBadge($status)
    {
        $badges = [
            'W' => 'warning',  // Menunggu
            'P' => 'info',     // Dalam Pemeriksaan
            'S' => 'success',  // Selesai
            'B' => 'danger'    // Batal
        ];

        return $badges[$status] ?? 'secondary';
    }

    /**
     * Get status text
     */
    public static function getStatusText($status)
    {
        $statuses = [
            'W' => 'Menunggu',
            'P' => 'Dalam Pemeriksaan',
            'S' => 'Selesai',
            'B' => 'Batal'
        ];

        return $statuses[$status] ?? 'Unknown';
    }

    /**
     * Get status icon
     */
    public static function getStatusIcon($status)
    {
        $icons = [
            'W' => 'clock',
            'P' => 'stethoscope',
            'S' => 'check-circle',
            'B' => 'times-circle'
        ];

        return $icons[$status] ?? 'question-circle';
    }
}