<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use Session;

class LoginController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // ✅ EAGER LOAD semua relasi yang diperlukan
        $user = User::with([
            'pemilik.pets',  // Load pemilik dan pets-nya
            'roleUser' => function($query) {
                $query->where('status', 1); // Hanya role yang aktif
            },
            'roleUser.role'  // Load nama role
        ])
        ->where('email', $request->input('email'))
        ->first();

        // Cek apakah user ada
        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan'])
                ->withInput();
        }
        
        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah'])
                ->withInput();
        }

        // Login user ke session
        Auth::login($user);

        // ==================================================================
        // LOGIKA LOGIN - URUTAN PRIORITAS
        // ==================================================================

        // 🔹 PRIORITAS 1: CEK APAKAH USER ADALAH PEMILIK (NON-STAFF)
        // User yang HANYA punya data di tabel pemilik, tanpa role_user
        if ($user->pemilik && $user->roleUser->isEmpty()) {
            
            // Set session untuk Pemilik Non-Staff
            $request->session()->put([
                'user_id' => $user->iduser,
                'user_nama' => $user->nama,
                'user_email' => $user->email,
                'user_role' => 'pemilik',           // ✅ String khusus untuk pemilik
                'user_role_name' => 'Pemilik',
                'user_type' => 'pemilik',           // ✅ Tambahan identifier
                'idpemilik' => $user->pemilik->idpemilik,  // ✅ Simpan ID pemilik
            ]);

            return redirect()->route('pemilik.dashboard')
                ->with('success', 'Selamat datang, ' . $user->nama . '!');
        }

        // 🔹 PRIORITAS 2: CEK APAKAH USER ADALAH STAFF (PUNYA ROLE_USER)
        $activeRole = $user->roleUser->first(); // Ambil role pertama yang aktif

        if ($activeRole) {
            
            $namaRole = $activeRole->role->nama_role ?? 'User';
            $userRole = (string) $activeRole->idrole;

            // Set session untuk Staff
            $sessionData = [
                'user_id' => $user->iduser,
                'user_nama' => $user->nama,
                'user_email' => $user->email,
                'user_role' => $userRole,           // ✅ ID role (1,2,3,4,5)
                'user_role_name' => $namaRole,
                'user_status' => $activeRole->status,
                'idrole_user' => $activeRole->idrole_user,  // ✅ Simpan ID role_user
            ];

            // Jika staff ini JUGA pemilik, tambahkan info pemilik
            if ($user->pemilik) {
                $sessionData['idpemilik'] = $user->pemilik->idpemilik;
                $sessionData['is_also_pemilik'] = true;  // ✅ Flag tambahan
            }

            $request->session()->put($sessionData);

            // Redirect berdasarkan role
            switch ($userRole) {
                case '1':  // Administrator
                    return redirect()->route('admin.dashboard')
                        ->with('success', 'Selamat datang, Administrator!');
                
                case '2':  // Dokter
                    return redirect()->route('dokter.dashboard')
                        ->with('success', 'Selamat datang, Dokter!');
                
                case '3':  // Perawat
                    return redirect()->route('perawat.dashboard')
                        ->with('success', 'Selamat datang, Perawat!');
                
                case '4':  // Resepsionis
                    return redirect()->route('resepsionis.dashboard')
                        ->with('success', 'Selamat datang, Resepsionis!');
                
                case '5':  // Pemilik (Staff) - Pemilik yang juga staff
                    return redirect()->route('pemilik.dashboard')
                        ->with('success', 'Selamat datang, ' . $user->nama . '!');
                
                default:
                    return redirect('/')
                        ->with('success', 'Login berhasil!');
            }
        }

        // 🔹 PRIORITAS 3: JIKA TIDAK PUNYA PEMILIK DAN TIDAK PUNYA ROLE
        // User ini tidak valid untuk sistem
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->withErrors([
            'email' => 'Akun Anda tidak memiliki hak akses. Hubungi administrator.'
        ]);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda telah logout');
    }
}