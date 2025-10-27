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
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required|in:0,1'
        ]);

        RoleUser::create([
            'iduser' => $request->iduser,
            'idrole' => $request->idrole,
            'status' => $request->status
        ]);

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
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required|in:0,1'
        ]);

        $roleUser = RoleUser::findOrFail($id);
        $roleUser->update([
            'iduser' => $request->iduser,
            'idrole' => $request->idrole,
            'status' => $request->status
        ]);

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
}