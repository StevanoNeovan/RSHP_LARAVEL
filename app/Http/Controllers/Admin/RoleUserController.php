<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Role;

class RoleUserController extends Controller
{
    public function index()
    {
        $roleUsers = RoleUser::with(['user', 'role'])->get();
        return view('admin.role-user.index', compact('roleUsers'));
    }

    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.role-user.create', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRoleUser($request);
        $this->createRoleUser($validated);

        return redirect()->route('admin.role-user.index')
            ->with('success', 'Role User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $roleUser = RoleUser::findOrFail($id);
        $users = User::all();
        $roles = Role::all();
        return view('admin.role-user.edit', compact('roleUser', 'users', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateRoleUser($request);
        
        $roleUser = RoleUser::findOrFail($id);
        $roleUser->update($validated);

        return redirect()->route('admin.role-user.index')
            ->with('success', 'Role User berhasil diupdate');
    }

    public function destroy($id)
    {
        $roleUser = RoleUser::findOrFail($id);
        $roleUser->delete();

        return redirect()->route('admin.role-user.index')
            ->with('success', 'Role User berhasil dihapus');
    }

    // ========== HELPER FUNCTIONS ==========

    private function validateRoleUser(Request $request)
    {
        return $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required|in:0,1'
        ], [
            'iduser.required' => 'User wajib dipilih',
            'iduser.exists' => 'User tidak valid',
            'idrole.required' => 'Role wajib dipilih',
            'idrole.exists' => 'Role tidak valid',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid'
        ]);
    }

    private function createRoleUser(array $validated)
    {
        // Check apakah user sudah punya role yang sama
        $exists = RoleUser::where('iduser', $validated['iduser'])
                          ->where('idrole', $validated['idrole'])
                          ->exists();

        if ($exists) {
            return back()->withErrors(['error' => 'User sudah memiliki role ini'])->withInput();
        }

        RoleUser::create($validated);
    }
}