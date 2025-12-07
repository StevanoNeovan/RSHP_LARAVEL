<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;

class RekamMedisDokterController extends Controller
{
    public function index()
    {
        $idRoleUserDokter = Auth::user()->roleUser->first()->idrole_user;
        
        $rekamMedis = RekamMedis::where('dokter_pemeriksa', $idRoleUserDokter)
            ->with([
                'temuDokter.pet.pemilik.user',
                'temuDokter.pet.ras',
                'details.tindakan'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('dokter.rekam-medis.index', compact('rekamMedis'));
    }
    
    public function show($id)
    {
        $idRoleUserDokter = Auth::user()->roleUser->first()->idrole_user;
        
        // Pastikan rekam medis ini dibuat oleh dokter yang login
        $rekamMedis = RekamMedis::where('dokter_pemeriksa', $idRoleUserDokter)
            ->with([
                'temuDokter.pet.pemilik.user',
                'temuDokter.pet.ras',
                'details.tindakan.kategori',
                'details.tindakan.kategoriKlinis'
            ])
            ->findOrFail($id);
        
        $kodeTindakan = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        
        return view('dokter.rekam-medis.show', compact('rekamMedis', 'kodeTindakan'));
    }
    
    public function edit($id)
    {
        $idRoleUserDokter = Auth::user()->roleUser->first()->idrole_user;
        
        $rekamMedis = RekamMedis::where('dokter_pemeriksa', $idRoleUserDokter)
            ->with(['temuDokter.pet', 'details.tindakan'])
            ->findOrFail($id);
        
        return view('dokter.rekam-medis.edit', compact('rekamMedis'));
    }
    
    public function update(Request $request, $id)
    {
        $idRoleUserDokter = Auth::user()->roleUser->first()->idrole_user;
        
        $validated = $request->validate([
            'anamnesa' => 'required|string|max:1000|min:10',
            'temuan_klinis' => 'required|string|max:1000|min:10',
            'diagnosa' => 'required|string|max:1000|min:5',
        ], [
            'anamnesa.required' => 'Anamnesa wajib diisi',
            'anamnesa.min' => 'Anamnesa minimal 10 karakter',
            'temuan_klinis.required' => 'Temuan klinis wajib diisi',
            'temuan_klinis.min' => 'Temuan klinis minimal 10 karakter',
            'diagnosa.required' => 'Diagnosa wajib diisi',
            'diagnosa.min' => 'Diagnosa minimal 5 karakter',
        ]);
        
        $rekamMedis = RekamMedis::where('dokter_pemeriksa', $idRoleUserDokter)->findOrFail($id);
        
        $rekamMedis->update([
            'anamnesa' => ucfirst(trim($validated['anamnesa'])),
            'temuan_klinis' => ucfirst(trim($validated['temuan_klinis'])),
            'diagnosa' => ucfirst(trim($validated['diagnosa'])),
        ]);
        
        return redirect()->route('dokter.rekam-medis.show', $id)
            ->with('success', 'Rekam medis berhasil diupdate');
    }
    
    // CRUD Detail Rekam Medis
    public function addDetail(Request $request, $id)
    {
        $idRoleUserDokter = Auth::user()->roleUser->first()->idrole_user;
        
        // Validasi bahwa rekam medis ini milik dokter yang login
        $rekamMedis = RekamMedis::where('dokter_pemeriksa', $idRoleUserDokter)->findOrFail($id);
        
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
    
    public function removeDetail($id, $detailId)
    {
        $idRoleUserDokter = Auth::user()->roleUser->first()->idrole_user;
        
        // Validasi rekam medis milik dokter yang login
        $rekamMedis = RekamMedis::where('dokter_pemeriksa', $idRoleUserDokter)->findOrFail($id);
        
        $detail = DetailRekamMedis::where('idrekam_medis', $id)
            ->where('iddetail_rekam_medis', $detailId)
            ->firstOrFail();
        
        $detail->delete();
        
        return redirect()->back()->with('success', 'Detail tindakan berhasil dihapus');
    }
}