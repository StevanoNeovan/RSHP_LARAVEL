<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use App\Models\RoleUser;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of rekam medis
     */
    public function index()
    {
        $rekamMedis = RekamMedis::with([
            'temuDokter.pet.pemilik.user',
            'temuDokter.pet.ras.jenisHewan',
            'temuDokter.roleUser.user',
            'details.tindakan'
        ])->orderBy('created_at', 'desc')->get();
        
        return view('Admin.rekam-medis.index', compact('rekamMedis'));
    }

    /**
     * Show the form for creating a new rekam medis
     */
    public function create()
    {
        // Ambil temu dokter yang sudah selesai dan belum punya rekam medis
        $temuDokter = TemuDokter::with(['pet.pemilik.user', 'pet.ras', 'roleUser.user'])
            ->where('status', 'S')
            ->whereDoesntHave('rekamMedis')
            ->get();
        
        // Ambil semua dokter aktif
        $dokter = RoleUser::with(['user', 'role'])
            ->where('idrole', 2)
            ->where('status', 1)
            ->get();
        
        return view('Admin.rekam-medis.create', compact('temuDokter', 'dokter'));
    }

    /**
     * Store a newly created rekam medis
     */
    public function store(Request $request)
    {
        $validated = $this->validateRekamMedis($request);
        $rekamMedis = $this->createRekamMedis($validated);

        return redirect()->route('admin.rekam-medis.show', $rekamMedis->idrekam_medis)
            ->with('success', 'Rekam Medis berhasil dibuat. Silakan tambahkan detail tindakan/terapi.');
    }

    /**
     * Display the specified rekam medis
     */
    public function show($id)
    {
        $rekamMedis = RekamMedis::with([
            'temuDokter.pet.pemilik.user',
            'temuDokter.pet.ras.jenisHewan',
            'temuDokter.roleUser.user',
            'details.tindakan.kategori',
            'details.tindakan.kategoriKlinis'
        ])->findOrFail($id);
        
        $kodeTindakan = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        
        return view('Admin.rekam-medis.show', compact('rekamMedis', 'kodeTindakan'));
    }

    /**
     * Show the form for editing the specified rekam medis
     */
    public function edit($id)
    {
        $rekamMedis = RekamMedis::with(['temuDokter.pet', 'temuDokter.roleUser.user'])->findOrFail($id);
        
        $dokter = RoleUser::with(['user', 'role'])
            ->where('idrole', 2)
            ->where('status', 1)
            ->get();
        
        return view('Admin.rekam-medis.edit', compact('rekamMedis', 'dokter'));
    }

    /**
     * Update the specified rekam medis
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validateRekamMedis($request, $id);
        
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->update([
            'anamnesa' => $validated['anamnesa'],
            'temuan_klinis' => $validated['temuan_klinis'],
            'diagnosa' => $validated['diagnosa'],
            'dokter_pemeriksa' => $validated['dokter_pemeriksa']
        ]);

        return redirect()->route('admin.rekam-medis.show', $id)
            ->with('success', 'Rekam Medis berhasil diupdate');
    }

    /**
     * Remove the specified rekam medis
     */
    public function destroy($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        
        // Delete all details first
        $rekamMedis->details()->delete();
        
        // Delete rekam medis
        $rekamMedis->delete();

        return redirect()->route('admin.rekam-medis.index')
            ->with('success', 'Rekam Medis berhasil dihapus');
    }

    /**
     * Add detail tindakan to rekam medis
     */
    public function addDetail(Request $request, $id)
    {
        $validated = $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string|max:1000'
        ]);

        DetailRekamMedis::create([
            'idrekam_medis' => $id,
            'idkode_tindakan_terapi' => $validated['idkode_tindakan_terapi'],
            'detail' => $validated['detail']
        ]);

        return redirect()->back()->with('success', 'Detail tindakan berhasil ditambahkan');
    }

    /**
     * Remove detail tindakan from rekam medis
     */
    public function removeDetail($id, $detailId)
    {
        $detail = DetailRekamMedis::where('idrekam_medis', $id)
            ->where('iddetail_rekam_medis', $detailId)
            ->firstOrFail();
        
        $detail->delete();

        return redirect()->back()->with('success', 'Detail tindakan berhasil dihapus');
    }

    // ========== HELPER FUNCTIONS ==========

    /**
     * Validate rekam medis data
     */
    private function validateRekamMedis(Request $request, $id = null)
    {
        $rules = [
            'anamnesa' => 'required|string|max:1000|min:10',
            'temuan_klinis' => 'required|string|max:1000|min:10',
            'diagnosa' => 'required|string|max:1000|min:5',
            'dokter_pemeriksa' => 'required|exists:role_user,idrole_user'
        ];

        // Only validate idreservasi_dokter when creating
        if (!$id) {
            $rules['idreservasi_dokter'] = 'required|exists:temu_dokter,idreservasi_dokter';
        }

        return $request->validate($rules, [
            'idreservasi_dokter.required' => 'Temu dokter wajib dipilih',
            'idreservasi_dokter.exists' => 'Temu dokter tidak valid',
            'anamnesa.required' => 'Anamnesa wajib diisi',
            'anamnesa.min' => 'Anamnesa minimal 10 karakter',
            'anamnesa.max' => 'Anamnesa maksimal 1000 karakter',
            'temuan_klinis.required' => 'Temuan klinis wajib diisi',
            'temuan_klinis.min' => 'Temuan klinis minimal 10 karakter',
            'temuan_klinis.max' => 'Temuan klinis maksimal 1000 karakter',
            'diagnosa.required' => 'Diagnosa wajib diisi',
            'diagnosa.min' => 'Diagnosa minimal 5 karakter',
            'diagnosa.max' => 'Diagnosa maksimal 1000 karakter',
            'dokter_pemeriksa.required' => 'Dokter pemeriksa wajib dipilih',
            'dokter_pemeriksa.exists' => 'Dokter pemeriksa tidak valid'
        ]);
    }

    /**
     * Create new rekam medis
     */
    private function createRekamMedis(array $validated)
    {
        return RekamMedis::create([
            'idreservasi_dokter' => $validated['idreservasi_dokter'],
            'anamnesa' => ucfirst(trim($validated['anamnesa'])),
            'temuan_klinis' => ucfirst(trim($validated['temuan_klinis'])),
            'diagnosa' => ucfirst(trim($validated['diagnosa'])),
            'dokter_pemeriksa' => $validated['dokter_pemeriksa'],
            'created_at' => now()
        ]);
    }
}