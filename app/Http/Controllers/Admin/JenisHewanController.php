<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('admin.jenis-hewan.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $validated = $this->validateJenisHewan($request);
        $this->createJenisHewan($validated);

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis Hewan berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        return view('admin.jenis-hewan.edit', compact('jenisHewan'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $validated = $this->validateJenisHewan($request);
        
        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->update([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan'])
        ]);

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis Hewan berhasil diupdate');
    }

    // Hapus data
    public function destroy($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->delete();

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis Hewan berhasil dihapus');
    }

    // ========== HELPER FUNCTIONS ==========

    /**
     * Validasi data Jenis Hewan
     */
    private function validateJenisHewan(Request $request)
    {
        return $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|min:3'
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi',
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 100 karakter',
            'nama_jenis_hewan.min' => 'Nama jenis hewan minimal 3 karakter'
        ]);
    }

    /**
     * Membuat data Jenis Hewan baru
     */
    private function createJenisHewan(array $validated)
    {
        JenisHewan::create([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan'])
        ]);
    }

    /**
     * Format nama jenis hewan (Title Case)
     */
    private function formatNamaJenisHewan(string $nama): string
    {
        return ucwords(strtolower(trim($nama)));
    }
}