<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;

class PemilikController extends Controller
{
    /**
     * Display a listing of pemilik
     */

    public function index(Request $request)
    {
        $query = Pemilik::query();

        // Filter hanya untuk pemilik
        if ($request->trashed === 'only') {
            $query->onlyTrashed();
        } elseif ($request->trashed === 'with') {
            $query->withTrashed();
        }



        $pemilik = $query->with(['user'])->get();

        return view('admin.pemilik.index', compact('pemilik'));
    }

    public function restore($id)
    {
        $pemilik = Pemilik::withTrashed()->findOrFail($id);
        $pemilik->restore();
        
        return redirect()->back()
            ->with('success', 'Data berhasil dipulihkan');
    }

    /**
     * Force delete (permanent)
     */
    public function forceDelete($id)
    {
        $pemilik = Pemilik::withTrashed()->findOrFail($id);
        $pemilik->forceDelete();
        
        return redirect()->back()
            ->with('success', 'Data berhasil dihapus permanen');
    }


    /**
     * Show the form for creating a new pemilik
     */
    public function create()
    {
        $users = User::all();
        return view('Admin.pemilik.create', compact('users'));
    }

    /**
     * Store a newly created pemilik
     */
    public function store(Request $request)
    {
        $validated = $this->validatePemilik($request);
        
        // Check if user already has pemilik record
        $exists = Pemilik::where('iduser', $validated['iduser'])->exists();
        
        if ($exists) {
            return back()->withErrors(['iduser' => 'User sudah terdaftar sebagai pemilik'])->withInput();
        }
        
        $this->createPemilik($validated);

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Data Pemilik berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified pemilik
     */
    public function edit($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $users = User::all();
        return view('Admin.pemilik.edit', compact('pemilik', 'users'));
    }

    /**
     * Update the specified pemilik
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validatePemilik($request);
        
        // Check if another pemilik already uses this user
        $exists = Pemilik::where('iduser', $validated['iduser'])
                        ->where('idpemilik', '!=', $id)
                        ->exists();
        
        if ($exists) {
            return back()->withErrors(['iduser' => 'User sudah terdaftar sebagai pemilik lain'])->withInput();
        }
        
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->update([
            'no_wa' => $this->formatNoWA($validated['no_wa']),
            'alamat' => ucfirst(trim($validated['alamat'])),
            'iduser' => $validated['iduser']
        ]);

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Data Pemilik berhasil diupdate');
    }

    /**
     * Remove the specified pemilik
     */
    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->delete();

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Data Pemilik berhasil dihapus');
    }

    // ========== HELPER FUNCTIONS ==========

    /**
     * Validate pemilik data
     */
    private function validatePemilik(Request $request)
    {
        return $request->validate([
            'no_wa' => 'required|string|max:45|min:10|regex:/^[0-9]+$/',
            'alamat' => 'required|string|max:100|min:5',
            'iduser' => 'required|exists:user,iduser'
        ], [
            'no_wa.required' => 'Nomor WhatsApp wajib diisi',
            'no_wa.min' => 'Nomor WhatsApp minimal 10 digit',
            'no_wa.regex' => 'Nomor WhatsApp hanya boleh angka',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 5 karakter',
            'iduser.required' => 'User wajib dipilih',
            'iduser.exists' => 'User tidak valid'
        ]);
    }

    /**
     * Create new pemilik
     */
    private function createPemilik(array $validated)
    {
        Pemilik::create([
            'no_wa' => $this->formatNoWA($validated['no_wa']),
            'alamat' => ucfirst(trim($validated['alamat'])),
            'iduser' => $validated['iduser']
        ]);
    }

    /**
     * Format WhatsApp number (normalize to 62xxx format)
     */
    private function formatNoWA(string $no): string
    {
        // Remove all non-numeric characters
        $no = preg_replace('/[^0-9]/', '', $no);
        
        // If starts with 0, replace with 62
        if (substr($no, 0, 1) === '0') {
            $no = '62' . substr($no, 1);
        }
        
        // If doesn't start with 62, add it
        if (substr($no, 0, 2) !== '62') {
            $no = '62' . $no;
        }
        
        return $no;
    }
}