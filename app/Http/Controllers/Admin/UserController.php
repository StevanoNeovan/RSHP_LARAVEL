<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // pastikan middleware admin kalau perlu
    public function __construct()
    {
        $this->middleware('isAdministrator');
    }

    /**
     * Display a listing of users (read-only).
     */
    public function index()
    {
        // ambil semua user beserta relation roleUser -> role
        // asumsikan di User model ada relation roleUser() yang hasMany ke RoleUser
        $users = User::with(['roleUser.role'])->get();

        return view('Admin.user.index', compact('users'));
    }
}
