<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class KodeTindakanTerapiController extends Controller
{
    public function index(Request $request)
{
    $query = KodeTindakanTerapi::query();

    // filter soft delete
    if ($request->trashed == 'only') {
        $query->onlyTrashed();      
    } elseif ($request->trashed == 'with') {
        $query->withTrashed();      
    }

    $kodeTindakanTerapi = $query->get();

    return view('admin.kode-tindakan-terapi.index', compact('kodeTindakanTerapi'));
    }
    /**
     * Restore soft deleted record
     */
    public function restore($id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::withTrashed()->findOrFail($id);
        $kodeTindakanTerapi->restore();
        
        return redirect()->back()
            ->with('success', 'Data berhasil dipulihkan');
    }

    /**
     * Force delete (permanent)
     */
    public function forceDelete($id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::withTrashed()->findOrFail($id);
        $kodeTindakanTerapi->forceDelete();
        
        return redirect()->back()
            ->with('success', 'Data berhasil dihapus permanen');
    }

    public function create()
    {
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kode-tindakan-terapi.create', compact('kategori', 'kategoriKlinis'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateKodeTindakanTerapi($request);
        $this->createKodeTindakanTerapi($validated);

        return redirect()->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Kode Tindakan Terapi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kode-tindakan-terapi.edit', compact('kodeTindakanTerapi', 'kategori', 'kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateKodeTindakanTerapi($request);
        
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $kodeTindakanTerapi->update([
            'kode' => $this->formatKode($validated['kode']),
            'deskripsi_tindakan_terapi' => ucfirst(trim($validated['deskripsi_tindakan_terapi'])),
            'idkategori' => $validated['idkategori'],
            'idkategori_klinis' => $validated['idkategori_klinis']
        ]);

        return redirect()->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Kode Tindakan Terapi berhasil diupdate');
    }

    public function destroy($id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $kodeTindakanTerapi->delete();

        return redirect()->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Kode Tindakan Terapi berhasil dihapus');
    }

    // ========== HELPER FUNCTIONS ==========

    private function validateKodeTindakanTerapi(Request $request)
    {
        return $request->validate([
            'kode' => 'required|string|max:5|min:2',
            'deskripsi_tindakan_terapi' => 'required|string|max:1000|min:5',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis'
        ], [
            'kode.required' => 'Kode tindakan wajib diisi',
            'kode.max' => 'Kode maksimal 5 karakter',
            'deskripsi_tindakan_terapi.required' => 'Deskripsi wajib diisi',
            'deskripsi_tindakan_terapi.min' => 'Deskripsi minimal 5 karakter',
            'idkategori.required' => 'Kategori wajib dipilih',
            'idkategori_klinis.required' => 'Kategori klinis wajib dipilih'
        ]);
    }

    private function createKodeTindakanTerapi(array $validated)
    {
        KodeTindakanTerapi::create([
            'kode' => $this->formatKode($validated['kode']),
            'deskripsi_tindakan_terapi' => ucfirst(trim($validated['deskripsi_tindakan_terapi'])),
            'idkategori' => $validated['idkategori'],
            'idkategori_klinis' => $validated['idkategori_klinis']
        ]);
    }

    private function formatKode(string $kode): string
    {
        return strtoupper(trim($kode));
    }
}