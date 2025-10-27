<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('admin.pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.pemilik.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_wa' => 'required|string|max:45',
            'alamat' => 'required|string|max:100',
            'iduser' => 'required|exists:user,iduser'
        ]);

        Pemilik::create([
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
            'iduser' => $request->iduser
        ]);

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Pemilik berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $users = User::all();
        return view('admin.pemilik.edit', compact('pemilik', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_wa' => 'required|string|max:45',
            'alamat' => 'required|string|max:100',
            'iduser' => 'required|exists:user,iduser'
        ]);

        $pemilik = Pemilik::findOrFail($id);
        $pemilik->update([
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
            'iduser' => $request->iduser
        ]);

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Pemilik berhasil diupdate');
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->delete();

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Pemilik berhasil dihapus');
    }
}