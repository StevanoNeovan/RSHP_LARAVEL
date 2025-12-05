<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $jenisHewan = JenisHewan::with('rasHewan')->get();
        return view('admin.ras-hewan.index', compact('jenisHewan'));
    }

    public function create()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRasHewan($request);
        $this->createRasHewan($validated);

        return redirect()->route('admin.ras-hewan.index')
            ->with('success', 'Ras Hewan berhasil ditambahkan');
    }

    public function edit(Request $request, $idjenis_hewan)
    {
        $jenisHewan = JenisHewan::findOrFail($idjenis_hewan);
        $listRas = RasHewan::where('idjenis_hewan', $idjenis_hewan)->get();

        $rasHewan = null;
        if ($request->has('ras')) {
            $rasHewan = RasHewan::where('idras_hewan', $request->ras)->first();
        }

        return view('Admin.ras-hewan.edit', compact('jenisHewan', 'listRas', 'rasHewan'));
    }


    public function update(Request $request, $id)
    {
        $validated = $this->validateRasHewan($request);
        
        $rasHewan = RasHewan::findOrFail($id);
        $rasHewan->update([
            'nama_ras' => $this->formatNamaRas($validated['nama_ras']),
            'idjenis_hewan' => $validated['idjenis_hewan']
        ]);

        return redirect()->route('admin.ras-hewan.index')
            ->with('success', 'Ras Hewan berhasil diupdate');
    }

    public function deleteForm()
    {
        $ras = RasHewan::with('jenisHewan')->get();

        return view('admin.ras-hewan.delete', compact('ras'));
    }

   public function destroy(Request $request)
    {
        $request->validate([
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan'
        ]);

        $ras = RasHewan::findOrFail($request->idras_hewan);
        $ras->delete();

        return redirect()->route('ras-hewan.index')
            ->with('success', 'Ras Hewan berhasil dihapus');
    }



    // ========== HELPER FUNCTIONS ==========

    private function validateRasHewan(Request $request)
    {
        return $request->validate([
            'nama_ras' => 'required|string|max:100|min:2',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan'
        ], [
            'nama_ras.required' => 'Nama ras wajib diisi',
            'nama_ras.min' => 'Nama ras minimal 2 karakter',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih',
            'idjenis_hewan.exists' => 'Jenis hewan tidak valid'
        ]);
    }

    private function createRasHewan(array $validated)
    {
        RasHewan::create([
            'nama_ras' => $this->formatNamaRas($validated['nama_ras']),
            'idjenis_hewan' => $validated['idjenis_hewan']
        ]);
    }

    private function formatNamaRas(string $nama): string
    {
        return ucwords(strtolower(trim($nama)));
    }
}