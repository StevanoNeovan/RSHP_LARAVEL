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
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    public function showLoginForm()
    {
        return view('auth.login');
    }

  public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Eager load SEMUA relasi yang mungkin kita butuhkan
        $user = User::with (['pemilik', 'roleUser' => function($query){
            $query->where('status', '1');
        }, 'roleUser.role'])
        ->where('email', $request->input('email'))
        ->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan'])
                ->withInput();
        }
        
        // Cek Password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah'])
                ->withInput();
        }

        // Login user ke session
        Auth::login($user);

        // ==================================================================
        // LOGIKA BARU YANG DIGABUNGKAN
        // ==================================================================

        // 1. CEK TIPE PEMILIK #1: (Seperti vicky@mail.com)
        // Apakah user ini punya data di tabel 'pemilik'?
        if ($user->pemilik) {
            
            // Set session manual untuk 'Pemilik'
            $request->session()->put([
                'user_id' => $user->iduser,
                'user_nama' => $user->nama,
                'user_email' => $user->email,
                'user_role' => 'pemilik', // Kita set manual
                'user_role_name' => 'Pemilik', // Kita set manual
            ]);

            // Langsung arahkan ke dashboard pemilik
            return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
        }

        // 2. CEK STAF & TIPE PEMILIK #2: (Seperti stevano@pemilik.com)
        // Jika dia bukan pemilik tipe #1, kita cek rolenya
        $activeRole = $user->roleUser->first(); // Ambil role pertama yang aktif

        if ($activeRole) {
            
            $namaRole = $activeRole->role->nama_role ?? 'User';
            $userRole = (string) $activeRole->idrole;

            // Simpan session user (untuk staf)
            $request->session()->put([
                'user_id' => $user->iduser,
                'user_nama' => $user->nama,
                'user_email' => $user->email,
                'user_role' => $userRole,
                'user_role_name' => $namaRole,
                'user_status' => $activeRole->status,
            ]);

            switch ($userRole) {
                case '1':
                    return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
                case '2':
                    return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
                case '3':
                    return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil!');
                case '4':
                    return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil!');
                case '5': 
                    return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
                default:
                    return redirect('/')->with('success', 'Login berhasil!');
            }
        }

        // 3. JIKA BUKAN KEDUANYA (Tidak punya relasi pemilik & tidak punya role)
        Auth::logout(); // Logout paksa
        return redirect('/login')->withErrors(['email' => 'Akun Anda tidak memiliki hak akses.']);
    }

}
