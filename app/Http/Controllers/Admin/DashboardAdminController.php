<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Models\RasHewan;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('Admin.dashboard-admin', [
            'jenisHewan' => JenisHewan::all(),
            'kategori' => Kategori::all(),
            'kategoriKlinis' => KategoriKlinis::all(),
            'kodeTindakan' => KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get(),
            'rasHewan' => RasHewan::with('jenisHewan')->get(),
        ]);
    }
}
