<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdministrator');
    }

    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = User::with(['roleUser.role', 'pemilik'])->get();
        return view('Admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('Admin.user.create');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $validated = $this->validateUser($request);
        
        // Check if email already exists
        if (User::where('email', $validated['email'])->exists()) {
            return back()->withErrors(['email' => 'Email sudah terdaftar di sistem'])->withInput();
        }
        
        $this->createUser($validated);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan. Silakan atur role user di menu Role User.');
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit($id)
    {
        $user = User::with(['roleUser.role', 'pemilik'])->findOrFail($id);
        return view('Admin.user.edit', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validateUser($request, $id);
        
        $user = User::findOrFail($id);
        
        // Update data
        $updateData = [
            'nama' => $this->formatNama($validated['nama']),
            'email' => strtolower(trim($validated['email']))
        ];
        
        // Only update password if provided
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }
        
        $user->update($updateData);

        return redirect()->route('admin.user.index')
            ->with('success', 'Data user berhasil diupdate');
    }

    /**
     * Remove the specified user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting current logged in user
        if ($user->iduser == auth()->user()->iduser) {
            return back()->withErrors(['error' => 'Tidak dapat menghapus user yang sedang login']);
        }
        
        // Check if user has related data
        if ($user->roleUser()->count() > 0) {
            return back()->withErrors(['error' => 'User memiliki role aktif. Hapus role user terlebih dahulu.']);
        }
        
        if ($user->pemilik) {
            return back()->withErrors(['error' => 'User terdaftar sebagai pemilik. Hapus data pemilik terlebih dahulu.']);
        }
        
        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus');
    }

    /**
     * Show user detail
     */
    public function show($id)
    {
        $user = User::with(['roleUser.role', 'pemilik.pets'])->findOrFail($id);
        return view('Admin.user.show', compact('user'));
    }

    // ========== HELPER FUNCTIONS ==========

    /**
     * Validate user data
     */
    private function validateUser(Request $request, $id = null)
    {
        $rules = [
            'nama' => 'required|string|max:500|min:3',
            'email' => 'required|email|max:200',
            'password' => $id ? 'nullable' : 'required',
        ];

        // Add unique email validation, except for current user when editing
        if ($id) {
            $rules['email'] .= '|unique:user,email,' . $id . ',iduser';
            $rules['password'] .= '|min:6';
        } else {
            $rules['email'] .= '|unique:user,email';
            $rules['password'] .= '|min:6|confirmed';
        }

        $messages = [
            'nama.required' => 'Nama wajib diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'nama.max' => 'Nama maksimal 500 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ];

        return $request->validate($rules, $messages);
    }

    /**
     * Create new user
     */
    private function createUser(array $validated)
    {
        User::create([
            'nama' => $this->formatNama($validated['nama']),
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
        ]);
    }

    /**
     * Format nama (Title Case)
     */
    private function formatNama(string $nama): string
    {
        return ucwords(strtolower(trim($nama)));
    }

    /**
     * Reset user password (Admin function)
     */
    public function resetPassword(Request $request, $id)
    {
        $validated = $request->validate([
            'new_password' => 'required|min:6|confirmed',
        ], [
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.min' => 'Password minimal 6 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return back()->with('success', 'Password user berhasil direset');
    }
}