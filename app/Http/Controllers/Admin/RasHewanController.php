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
        $rasHewan = RasHewan::with('jenisHewan')->get();
        return view('admin.ras-hewan.index', compact('rasHewan'));
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

    public function edit($id)
    {
        $rasHewan = RasHewan::findOrFail($id);
        $jenisHewan = JenisHewan::all();
        return view('admin.ras-hewan.edit', compact('rasHewan', 'jenisHewan'));
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

    public function destroy($id)
    {
        $rasHewan = RasHewan::findOrFail($id);
        $rasHewan->delete();

        return redirect()->route('admin.ras-hewan.index')
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