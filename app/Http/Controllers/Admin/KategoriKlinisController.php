<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kategori-klinis.index', compact('kategoriKlinis'));
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