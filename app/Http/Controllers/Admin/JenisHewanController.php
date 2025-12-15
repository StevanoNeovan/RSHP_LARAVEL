<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;
use Illuminate\Support\Facades\DB;

class JenisHewanController extends Controller
{
    // Menampilkan semua data (untuk view)
  public function index(Request $request)
{
    $query = JenisHewan::query();

    // filter soft delete
    if ($request->trashed == 'only') {
        $query->onlyTrashed();     
    } elseif ($request->trashed == 'with') {
        $query->withTrashed();     
    }

    $jenisHewan = $query->get();

    return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }
    /**
     * Restore soft deleted record
     */
    public function restore($id)
    {
        $jenisHewan= JenisHewan::withTrashed()->findOrFail($id);
        $jenisHewan->restore();
        
        return redirect()->back()
            ->with('success', 'Data berhasil dipulihkan');
    }

    /**
     * Force delete (permanent)
     */
    public function forceDelete($id)
    {
        $jenisHewan = JenisHewan::withTrashed()->findOrFail($id);
        $jenisHewan->forceDelete();
        
        return redirect()->back()
            ->with('success', 'Data berhasil dihapus permanen');
    }


    // Menampilkan form tambah
    public function create()
    {
        return view('admin.jenis-hewan.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $validated = $this->validateJenisHewan($request);
        $this->createJenisHewan($validated);

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis Hewan berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        return view('admin.jenis-hewan.edit', compact('jenisHewan'));
    }

    // Update data 
    public function update(Request $request, $id)
    {
        $validated = $this->validateJenisHewan($request);
        
        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->update([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan'])
        ]);

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis Hewan berhasil diupdate');
    }

    // Hapus data
    public function destroy($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->delete();

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis Hewan berhasil dihapus');
    }

    // ================= Query Builder =================

    public function indexQuery(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $perPage = max(1, (int) $request->query('per_page', 10));
        $page = max(1, (int) $request->query('page', 1));

        $base = DB::table('jenis_hewan')
            ->select('idjenis_hewan', 'nama_jenis_hewan')
            ->when($search !== '', function ($q) use ($search) {
                $q->where('nama_jenis_hewan', 'like', "%{$search}%");
            });

        $total = (clone $base)->count();
        $items = $base->orderBy('nama_jenis_hewan')
            ->forPage($page, $perPage)
            ->get();

        return response()->json([
            'data' => $items,
            'meta' => [
                'total' => $total,
                'page' => $page,
                'per_page' => $perPage,
                'total_pages' => (int) ceil($total / $perPage),
            ],
        ]);
    }

    public function showQuery($id)
    {
        $row = DB::table('jenis_hewan')
            ->select('idjenis_hewan', 'nama_jenis_hewan')
            ->where('idjenis_hewan', $id)
            ->first();

        if (!$row) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['data' => $row]);
    }

    public function storeQuery(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|min:3',
        ]);

        $id = DB::table('jenis_hewan')->insertGetId([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan']),
        ], 'idjenis_hewan');

        return response()->json(['message' => 'Berhasil menambah', 'id' => $id], 201);
    }


    public function updateQuery(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|min:3',
        ]);

        $affected = DB::table('jenis_hewan')
            ->where('idjenis_hewan', $id)
            ->update([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan']),
            ]);

        if (!$affected) {
            return response()->json(['message' => 'Tidak ada perubahan / data tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Berhasil mengupdate']);
    }


    public function destroyQuery($id)
    {
        $deleted = DB::table('jenis_hewan')->where('idjenis_hewan', $id)->delete();
        if (!$deleted) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json(['message' => 'Berhasil menghapus']);
    }


    public function reportJumlahRas()
    {
        $rows = DB::table('jenis_hewan as j')
            ->leftJoin('ras_hewan as r', 'r.idjenis_hewan', '=', 'j.idjenis_hewan')
            ->select('j.idjenis_hewan', 'j.nama_jenis_hewan', DB::raw('COUNT(r.idras_hewan) as jumlah_ras'))
            ->groupBy('j.idjenis_hewan', 'j.nama_jenis_hewan')
            ->orderBy('j.nama_jenis_hewan')
            ->get();

        return response()->json(['data' => $rows]);
    }

    // ========== HELPER FUNCTIONS ==========

    /**
     * Validasi data Jenis Hewan
     */
    private function validateJenisHewan(Request $request)
    {
        return $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|min:3'
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi',
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 100 karakter',
            'nama_jenis_hewan.min' => 'Nama jenis hewan minimal 3 karakter'
        ]);
    }

    /**
     * Membuat data Jenis Hewan baru (Eloquent)
     */
    private function createJenisHewan(array $validated)
    {
        JenisHewan::create([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan'])
        ]);
    }

    /**
     * Format nama jenis hewan (Title Case)
     */
    private function formatNamaJenisHewan(string $nama): string
    {
        return ucwords(strtolower(trim($nama)));
    }
}
