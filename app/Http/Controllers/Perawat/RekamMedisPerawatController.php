<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{RekamMedis, DetailRekamMedis, KodeTindakanTerapi, TemuDokter};

class RekamMedisPerawatController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with([
                'temuDokter.pet.pemilik.user',
                'temuDokter.pet.ras',
                'temuDokter.roleUser.user',
                'details.tindakan'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('perawat.rekam-medis.index', compact('rekamMedis'));
    }
    
    public function show($id)
    {
        $rekamMedis = RekamMedis::with([
                'temuDokter.pet.pemilik.user',
                'temuDokter.pet.ras',
                'temuDokter.roleUser.user',
                'details.tindakan.kategori',
                'details.tindakan.kategoriKlinis'
            ])
            ->findOrFail($id);
        
        return view('perawat.rekam-medis.show', compact('rekamMedis'));
    }
    
    public function create()
    {
        // Ambil temu dokter yang belum ada rekam medis dan status selesai
        $temuDokterList = TemuDokter::whereDoesntHave('rekamMedis')
            ->where('status', 'S')
            ->with(['pet.pemilik.user', 'pet.ras', 'roleUser.user'])
            ->orderBy('waktu_daftar', 'desc')
            ->get();
        
        return view('perawat.rekam-medis.create', compact('temuDokterList'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'anamnesa' => 'required|string|max:1000|min:10',
            'temuan_klinis' => 'required|string|max:1000|min:10',
            'diagnosa' => 'required|string|max:1000|min:5',
        ], [
            'idreservasi_dokter.required' => 'Temu dokter wajib dipilih',
            'anamnesa.required' => 'Anamnesa wajib diisi',
            'anamnesa.min' => 'Anamnesa minimal 10 karakter',
            'temuan_klinis.required' => 'Temuan klinis wajib diisi',
            'diagnosa.required' => 'Diagnosa wajib diisi',
        ]);
        
        // Get temu dokter
        $temuDokter = TemuDokter::findOrFail($validated['idreservasi_dokter']);
        
        $rekamMedis = RekamMedis::create([
            'idreservasi_dokter' => $validated['idreservasi_dokter'],
            'created_at' => now(),
            'anamnesa' => ucfirst(trim($validated['anamnesa'])),
            'temuan_klinis' => ucfirst(trim($validated['temuan_klinis'])),
            'diagnosa' => ucfirst(trim($validated['diagnosa'])),
            'dokter_pemeriksa' => $temuDokter->idrole_user
        ]);
        
        return redirect()->route('perawat.rekam-medis.show', $rekamMedis->idrekam_medis)
            ->with('success', 'Rekam medis berhasil dibuat');
    }
    
    public function edit($id)
    {
        $rekamMedis = RekamMedis::with(['temuDokter.pet', 'details.tindakan'])->findOrFail($id);
        return view('perawat.rekam-medis.edit', compact('rekamMedis'));
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'anamnesa' => 'required|string|max:1000|min:10',
            'temuan_klinis' => 'required|string|max:1000|min:10',
            'diagnosa' => 'required|string|max:1000|min:5',
        ]);
        
        $rekamMedis = RekamMedis::findOrFail($id);
        
        $rekamMedis->update([
            'anamnesa' => ucfirst(trim($validated['anamnesa'])),
            'temuan_klinis' => ucfirst(trim($validated['temuan_klinis'])),
            'diagnosa' => ucfirst(trim($validated['diagnosa'])),
        ]);
        
        return redirect()->route('perawat.rekam-medis.show', $id)
            ->with('success', 'Rekam medis berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        
        // Delete all details first
        $rekamMedis->details()->delete();
        
        // Delete rekam medis
        $rekamMedis->delete();
        
        return redirect()->route('perawat.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil dihapus');
    }
    
    public function addDetail(Request $request, $id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        
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
        $detail = DetailRekamMedis::where('idrekam_medis', $id)
            ->where('iddetail_rekam_medis', $detailId)
            ->firstOrFail();
        
        $detail->delete();
        
        return redirect()->back()->with('success', 'Detail tindakan berhasil dihapus');
    }
}