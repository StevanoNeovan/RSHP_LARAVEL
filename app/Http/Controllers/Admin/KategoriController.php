<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateKategori($request);
        $this->createKategori($validated);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateKategori($request);
        
        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $this->formatNamaKategori($validated['nama_kategori'])
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }

    // ========== HELPER FUNCTIONS ==========

    private function validateKategori(Request $request)
    {
        return $request->validate([
            'nama_kategori' => 'required|string|max:100|min:3'
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter'
        ]);
    }

    private function createKategori(array $validated)
    {
        Kategori::create([
            'nama_kategori' => $this->formatNamaKategori($validated['nama_kategori'])
        ]);
    }

    private function formatNamaKategori(string $nama): string
    {
        return ucwords(strtolower(trim($nama)));
    }
}