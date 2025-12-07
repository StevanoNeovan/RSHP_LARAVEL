<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pemilik;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/pemilik/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        // Set session untuk pemilik
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_nama' => $user->nama,
            'user_email' => $user->email,
            'user_role' => 'pemilik',
            'user_role_name' => 'Pemilik',
            'user_type' => 'pemilik',
        ]);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())
                ->with('success', 'Registrasi berhasil! Selamat datang di RSHP UNAIR.');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:500', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:user,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'nama.max' => 'Nama maksimal 500 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Create user
        $user = User::create([
            'nama' => $this->formatNama($data['nama']),
            'email' => strtolower(trim($data['email'])),
            'password' => Hash::make($data['password']),
        ]);

        // Automatically create pemilik record
        // Data akan dilengkapi nanti melalui profil
        Pemilik::create([
            'iduser' => $user->iduser,
            'no_wa' => null,
            'alamat' => null,
        ]);

        return $user;
    }

    /**
     * Format nama (Title Case)
     *
     * @param  string  $nama
     * @return string
     */
    private function formatNama(string $nama): string
    {
        return ucwords(strtolower(trim($nama)));
    }
}