<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class RasHewanController extends Controller
{
   
    public function index(Request $request)
{
  
    $query = JenisHewan::query();
    
   
    if ($request->trashed == 'only') {
       
        $query->withTrashed()
              ->where(function($q) {
                  
                  $q->whereNotNull('deleted_at') 
                  
                    ->orWhereHas('rasHewan', function($subQuery) {
                        $subQuery->onlyTrashed();
                    });
              });
              
    } elseif ($request->trashed == 'with') {
        $query->withTrashed();
    }
    
    // Load ras hewan
    $jenisHewan = $query->with(['rasHewan' => function($q) use ($request) {
        if ($request->trashed == 'only') {
           
            $q->onlyTrashed();
        } elseif ($request->trashed == 'with') {
            $q->withTrashed();
        }
    }])->get();
    
    return view('admin.ras-hewan.index', compact('jenisHewan'));
}

    /**
     * Show the form for creating a new ras hewan
     */
    public function create()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }

    /**
     * Store a newly created ras hewan
     */
    public function store(Request $request)
    {
        $validated = $this->validateRasHewan($request);
        $this->createRasHewan($validated);

        return redirect()->route('admin.ras-hewan.index')
            ->with('success', 'Ras Hewan berhasil ditambahkan');
    }

    /**
     * Show the form for editing (dengan filter per jenis)
     */
    public function edit(Request $request, $idjenis_hewan)
    {
        $jenisHewan = JenisHewan::findOrFail($idjenis_hewan);
        
        // List ras untuk jenis hewan ini (dengan soft delete filter)
        $listRasQuery = RasHewan::where('idjenis_hewan', $idjenis_hewan);
        
        if ($request->trashed == 'only') {
            $listRasQuery->onlyTrashed();
        } elseif ($request->trashed == 'with') {
            $listRasQuery->withTrashed();
        }
        
        $listRas = $listRasQuery->get();

        // Ras yang dipilih untuk diedit
        $rasHewan = null;
        if ($request->has('ras')) {
            $rasHewan = RasHewan::withTrashed()->where('idras_hewan', $request->ras)->first();
        }

        return view('Admin.ras-hewan.edit', compact('jenisHewan', 'listRas', 'rasHewan'));
    }

    /**
     * Update the specified ras hewan
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validateRasHewan($request);
        
        $rasHewan = RasHewan::withTrashed()->findOrFail($id);
        $rasHewan->update([
            'nama_ras' => $this->formatNamaRas($validated['nama_ras']),
            'idjenis_hewan' => $validated['idjenis_hewan']
        ]);

        return redirect()->route('admin.ras-hewan.index')
            ->with('success', 'Ras Hewan berhasil diupdate');
    }

    /**
     * Show delete form with list of ras hewan filtered by jenis
     */
    public function deleteForm(Request $request, $idjenis_hewan)
    {
        $jenisHewan = JenisHewan::findOrFail($idjenis_hewan);
        
        // List ras untuk delete form (dengan soft delete filter)
        $rasQuery = RasHewan::where('idjenis_hewan', $idjenis_hewan);
        
        if ($request->trashed == 'only') {
            $rasQuery->onlyTrashed();
        } elseif ($request->trashed == 'with') {
            $rasQuery->withTrashed();
        }
        
        $ras = $rasQuery->get();
        
        return view('admin.ras-hewan.delete', compact('ras', 'jenisHewan'));
    }

    /**
     * Remove the specified ras hewan (SOFT DELETE)
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan'
        ], [
            'idras_hewan.required' => 'Ras hewan wajib dipilih',
            'idras_hewan.exists' => 'Ras hewan tidak ditemukan'
        ]);

        try {
            $ras = RasHewan::findOrFail($request->idras_hewan);
            
            // Check if ras is being used by any pet
            if ($ras->pet()->count() > 0) {
                return back()->withErrors([
                    'idras_hewan' => 'Ras hewan tidak dapat dihapus karena masih digunakan oleh ' . $ras->pet()->count() . ' pet'
                ])->withInput();
            }
            
            $namaRas = $ras->nama_ras;
            $ras->delete(); // SOFT DELETE

            return redirect()->route('admin.ras-hewan.index')
                ->with('success', "Ras Hewan '{$namaRas}' berhasil dihapus");
        } catch (\Exception $e) {
            return back()->withErrors([
                'idras_hewan' => 'Terjadi kesalahan saat menghapus ras hewan: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Restore soft deleted ras hewan
     */
    public function restore($id)
    {
        $rasHewan = RasHewan::withTrashed()->findOrFail($id);
        $rasHewan->restore();
        
        return redirect()->back()
            ->with('success', 'Ras Hewan "' . $rasHewan->nama_ras . '" berhasil dipulihkan');
    }

    /**
     * Force delete (permanent)
     */
    public function forceDelete($id)
    {
        $rasHewan = RasHewan::withTrashed()->findOrFail($id);
        
        // Check if ras is being used by any pet (including soft deleted)
        if ($rasHewan->pet()->withTrashed()->count() > 0) {
            return back()->withErrors([
                'error' => 'Tidak dapat menghapus permanen. Masih ada pet yang menggunakan ras ini (termasuk yang sudah dihapus).'
            ]);
        }
        
        $namaRas = $rasHewan->nama_ras;
        $rasHewan->forceDelete();
        
        return redirect()->back()
            ->with('success', "Ras Hewan '{$namaRas}' berhasil dihapus permanen");
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