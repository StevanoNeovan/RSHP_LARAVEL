<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class PetResepsionisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        
        $pets = Pet::with(['pemilik.user', 'ras.jenisHewan'])
            ->when($search, function($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhereHas('pemilik.user', function($q) use ($search) {
                          $q->where('nama', 'like', "%{$search}%");
                      });
            })
            ->orderBy('idpet', 'desc')
            ->paginate(12);
        
        return view('resepsionis.pet.index', compact('pets', 'search'));
    }
    
    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        $jenisHewan = JenisHewan::all();
        $rasHewan = RasHewan::with('jenisHewan')->get();
        
        return view('resepsionis.pet.create', compact('pemilik', 'jenisHewan', 'rasHewan'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|min:2',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'warna_tanda' => 'required|string|max:45|min:2',
            'jenis_kelamin' => 'required|in:M,F',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan'
        ]);
        
        Pet::create([
            'nama' => ucwords(strtolower(trim($validated['nama']))),
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'warna_tanda' => ucfirst(trim($validated['warna_tanda'])),
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'idpemilik' => $validated['idpemilik'],
            'idras_hewan' => $validated['idras_hewan']
        ]);
        
        return redirect()->route('resepsionis.pet.index')
            ->with('success', 'Data pet berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $pemilik = Pemilik::with('user')->get();
        $jenisHewan = JenisHewan::all();
        $rasHewan = RasHewan::with('jenisHewan')->get();
        
        return view('resepsionis.pet.edit', compact('pet', 'pemilik', 'jenisHewan', 'rasHewan'));
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|min:2',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'warna_tanda' => 'required|string|max:45|min:2',
            'jenis_kelamin' => 'required|in:M,F',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan'
        ]);
        
        $pet = Pet::findOrFail($id);
        $pet->update([
            'nama' => ucwords(strtolower(trim($validated['nama']))),
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'warna_tanda' => ucfirst(trim($validated['warna_tanda'])),
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'idpemilik' => $validated['idpemilik'],
            'idras_hewan' => $validated['idras_hewan']
        ]);
        
        return redirect()->route('resepsionis.pet.index')
            ->with('success', 'Data pet berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        
        // Check if pet has temu dokter
        if ($pet->temuDokter()->count() > 0) {
            return back()->withErrors(['error' => 'Tidak dapat menghapus pet yang sudah memiliki temu dokter']);
        }
        
        $pet->delete();
        
        return redirect()->route('resepsionis.pet.index')
            ->with('success', 'Data pet berhasil dihapus');
    }
}