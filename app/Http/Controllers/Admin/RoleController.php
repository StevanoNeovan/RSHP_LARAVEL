<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();
        return view('admin.role.index', compact('role'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRole($request);
        $this->createRole($validated);

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil ditambahkan');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateRole($request);
        
        $role = Role::findOrFail($id);
        $role->update([
            'nama_role' => $this->formatNamaRole($validated['nama_role'])
        ]);

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil diupdate');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil dihapus');
    }

    // ========== HELPER FUNCTIONS ==========

    private function validateRole(Request $request)
    {
        return $request->validate([
            'nama_role' => 'required|string|max:100|min:3'
        ], [
            'nama_role.required' => 'Nama role wajib diisi',
            'nama_role.max' => 'Nama role maksimal 100 karakter',
            'nama_role.min' => 'Nama role minimal 3 karakter'
        ]);
    }

    private function createRole(array $validated)
    {
        Role::create([
            'nama_role' => $this->formatNamaRole($validated['nama_role'])
        ]);
    }

    private function formatNamaRole(string $nama): string
    {
        return ucwords(strtolower(trim($nama)));
    }
}