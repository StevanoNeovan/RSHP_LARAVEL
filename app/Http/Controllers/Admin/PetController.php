<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class PetController extends Controller
{
    /**
     * Display a listing of pets
     */
    public function index()
    {
        $pets = Pet::with(['pemilik.user', 'ras.jenisHewan'])->get();
        return view('Admin.pet.index', compact('pets'));
    }

    /**
     * Show the form for creating a new pet
     */
    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        $jenisHewan = JenisHewan::all();
        $rasHewan = RasHewan::with('jenisHewan')->get();
        
        return view('Admin.pet.create', compact('pemilik', 'jenisHewan', 'rasHewan'));
    }

    /**
     * Store a newly created pet
     */
    public function store(Request $request)
    {
        $validated = $this->validatePet($request);
        $this->createPet($validated);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Data Pet berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified pet
     */
    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $pemilik = Pemilik::with('user')->get();
        $jenisHewan = JenisHewan::all();
        $rasHewan = RasHewan::with('jenisHewan')->get();
        
        return view('Admin.pet.edit', compact('pet', 'pemilik', 'jenisHewan', 'rasHewan'));
    }

    /**
     * Update the specified pet
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validatePet($request);
        
        $pet = Pet::findOrFail($id);
        $pet->update([
            'nama' => $this->formatNama($validated['nama']),
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'warna_tanda' => $validated['warna_tanda'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'idpemilik' => $validated['idpemilik'],
            'idras_hewan' => $validated['idras_hewan']
        ]);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Data Pet berhasil diupdate');
    }

    /**
     * Remove the specified pet
     */
    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return redirect()->route('admin.pet.index')
            ->with('success', 'Data Pet berhasil dihapus');
    }

    // ========== HELPER FUNCTIONS ==========

    /**
     * Validate pet data
     */
    private function validatePet(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:100|min:2',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'warna_tanda' => 'required|string|max:45|min:2',
            'jenis_kelamin' => 'required|in:M,F',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan'
        ], [
            'nama.required' => 'Nama hewan wajib diisi',
            'nama.min' => 'Nama hewan minimal 2 karakter',
            'nama.max' => 'Nama hewan maksimal 100 karakter',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date' => 'Format tanggal tidak valid',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh lebih dari hari ini',
            'warna_tanda.required' => 'Warna/tanda khusus wajib diisi',
            'warna_tanda.min' => 'Warna/tanda khusus minimal 2 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid',
            'idpemilik.required' => 'Pemilik wajib dipilih',
            'idpemilik.exists' => 'Pemilik tidak valid',
            'idras_hewan.required' => 'Ras hewan wajib dipilih',
            'idras_hewan.exists' => 'Ras hewan tidak valid'
        ]);
    }

    /**
     * Create new pet
     */
    private function createPet(array $validated)
    {
        Pet::create([
            'nama' => $this->formatNama($validated['nama']),
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'warna_tanda' => ucfirst(trim($validated['warna_tanda'])),
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'idpemilik' => $validated['idpemilik'],
            'idras_hewan' => $validated['idras_hewan']
        ]);
    }

    /**
     * Format nama pet (Title Case)
     */
    private function formatNama(string $nama): string
    {
        return ucwords(strtolower(trim($nama)));
    }

    /**
     * Calculate age from birth date
     */
    public static function calculateAge($birthDate)
    {
        $today = new \DateTime();
        $birth = new \DateTime($birthDate);
        $age = $today->diff($birth);
        
        if ($age->y > 0) {
            return $age->y . ' tahun';
        } elseif ($age->m > 0) {
            return $age->m . ' bulan';
        } else {
            return $age->d . ' hari';
        }
    }
}