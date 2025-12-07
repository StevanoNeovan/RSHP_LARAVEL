<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PemilikResepsionisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        
        $pemilik = Pemilik::with('user')
            ->when($search, function($query) use ($search) {
                $query->whereHas('user', function($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('idpemilik', 'desc')
            ->paginate(10);
        
        return view('resepsionis.pemilik.index', compact('pemilik', 'search'));
    }
    
    public function create()
    {
        return view('resepsionis.pemilik.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:500|min:3',
            'email' => 'required|email|max:200|unique:user,email',
            'password' => 'required|min:6|confirmed',
            'no_wa' => 'required|string|max:45|min:10|regex:/^[0-9]+$/',
            'alamat' => 'required|string|max:100|min:5',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi',
            'no_wa.regex' => 'Nomor WhatsApp hanya boleh angka',
            'alamat.required' => 'Alamat wajib diisi',
        ]);
        
        DB::beginTransaction();
        try {
            // Create user
            $user = User::create([
                'nama' => ucwords(strtolower(trim($validated['nama']))),
                'email' => strtolower(trim($validated['email'])),
                'password' => Hash::make($validated['password']),
            ]);
            
            // Create pemilik
            Pemilik::create([
                'no_wa' => $this->formatNoWA($validated['no_wa']),
                'alamat' => ucfirst(trim($validated['alamat'])),
                'iduser' => $user->iduser
            ]);
            
            DB::commit();
            return redirect()->route('resepsionis.pemilik.index')
                ->with('success', 'Data pemilik berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()])
                ->withInput();
        }
    }
    
    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('resepsionis.pemilik.edit', compact('pemilik'));
    }
    
    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required|string|max:500|min:3',
            'email' => 'required|email|max:200|unique:user,email,' . $pemilik->iduser . ',iduser',
            'no_wa' => 'required|string|max:45|min:10|regex:/^[0-9]+$/',
            'alamat' => 'required|string|max:100|min:5',
        ]);
        
        DB::beginTransaction();
        try {
            // Update user
            $pemilik->user->update([
                'nama' => ucwords(strtolower(trim($validated['nama']))),
                'email' => strtolower(trim($validated['email'])),
            ]);
            
            // Update pemilik
            $pemilik->update([
                'no_wa' => $this->formatNoWA($validated['no_wa']),
                'alamat' => ucfirst(trim($validated['alamat'])),
            ]);
            
            DB::commit();
            return redirect()->route('resepsionis.pemilik.index')
                ->with('success', 'Data pemilik berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal mengupdate data: ' . $e->getMessage()])
                ->withInput();
        }
    }
    
    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        
        // Check if pemilik has pets
        if ($pemilik->pets()->count() > 0) {
            return back()->withErrors(['error' => 'Tidak dapat menghapus pemilik yang memiliki pet terdaftar']);
        }
        
        DB::beginTransaction();
        try {
            $user = $pemilik->user;
            $pemilik->delete();
            $user->delete();
            
            DB::commit();
            return redirect()->route('resepsionis.pemilik.index')
                ->with('success', 'Data pemilik berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }
    
    private function formatNoWA(string $no): string
    {
        $no = preg_replace('/[^0-9]/', '', $no);
        if (substr($no, 0, 1) === '0') {
            $no = '62' . substr($no, 1);
        }
        if (substr($no, 0, 2) !== '62') {
            $no = '62' . $no;
        }
        return $no;
    }
}