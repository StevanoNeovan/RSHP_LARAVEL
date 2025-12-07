<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilPemilikController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik()->with(['pets.ras.jenisHewan'])->first();
        
        if (!$pemilik) {
            return redirect()->route('pemilik.dashboard')
                ->withErrors(['error' => 'Data pemilik tidak ditemukan']);
        }
        
        return view('pemilik.profil', compact('user', 'pemilik'));
    }
}
