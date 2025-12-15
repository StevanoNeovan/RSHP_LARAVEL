<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index(Request $request)
{
    $query = KategoriKlinis::query();

    // filter soft delete
    if ($request->trashed == 'only') {
        $query->onlyTrashed();     
    } elseif ($request->trashed == 'with') {
        $query->withTrashed();     
    }

    $kategoriKlinis = $query->get();

    return view('admin.kategori-klinis.index', compact('kategoriKlinis'));
    }
    /**
     * Restore soft deleted record
     */
    public function restore($id)
    {
        $kategoriKlinis= KategoriKlinis::withTrashed()->findOrFail($id);
        $kategoriKlinis->restore();
        
        return redirect()->back()
            ->with('success', 'Data berhasil dipulihkan');
    }

    /**
     * Force delete (permanent)
     */
    public function forceDelete($id)
    {
        $kategoriKlinis = KategoriKlinis::withTrashed()->findOrFail($id);
        $kategoriKlinis->forceDelete();
        
        return redirect()->back()
            ->with('success', 'Data berhasil dihapus permanen');
    }


    public function create()
    {
        return view('admin.kategori-klinis.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateKategoriKlinis($request);
        $this->createKategoriKlinis($validated);

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori Klinis berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        return view('admin.kategori-klinis.edit', compact('kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateKategoriKlinis($request);
        
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        $kategoriKlinis->update([
            'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($validated['nama_kategori_klinis'])
        ]);

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori Klinis berhasil diupdate');
    }

    public function destroy($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        $kategoriKlinis->delete();

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori Klinis berhasil dihapus');
    }

    // ========== HELPER FUNCTIONS ==========

    private function validateKategoriKlinis(Request $request)
    {
        return $request->validate([
            'nama_kategori_klinis' => 'required|string|max:50|min:3'
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 50 karakter',
            'nama_kategori_klinis.min' => 'Nama kategori klinis minimal 3 karakter'
        ]);
    }

    private function createKategoriKlinis(array $validated)
    {
        KategoriKlinis::create([
            'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($validated['nama_kategori_klinis'])
        ]);
    }

    private function formatNamaKategoriKlinis(string $nama): string
    {
        return ucwords(strtolower(trim($nama)));
    }
}