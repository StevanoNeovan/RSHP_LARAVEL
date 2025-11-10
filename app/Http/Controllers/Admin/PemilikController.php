=== HELPER FUNCTIONS ========== HELPER FUNCTIONS ==========

    private function validatePemilik(Request $request)
    {
        return $request->validate([
            'no_wa' => 'required|string|max:45|min:10|regex:/^[0-9]+$/',
            'alamat' => 'required|string|max:100|min:5',
            'iduser' => 'required|exists:user,iduser'
        ], [
            'no_wa.required' => 'Nomor WhatsApp wajib diisi',
            'no_wa.min' => 'Nomor WhatsApp minimal 10 digit',
            'no_wa.regex' => 'Nomor WhatsApp hanya boleh angka',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 5 karakter',
            'iduser.required' => 'User wajib dipilih',
            'iduser.exists' => 'User tidak valid'
        ]);
    }

    private function createPemilik(array $validated)
    {
        // Check apakah user sudah jadi pemilik
        $exists = Pemilik::where('iduser', $validated['iduser'])->exists();

        if ($exists) {
            return back()->withErrors(['error' => 'User sudah terdaftar sebagai pemilik'])->withInput();
        }

        Pemilik::create([
            'no_wa' => $this->formatNoWA($validated['no_wa']),
            'alamat' => ucfirst(trim($validated['alamat'])),
            'iduser' => $validated['iduser']
        ]);
    }

    private function formatNoWA(string $no): string
    {
        // Hilangkan karakter selain angka
        $no = preg_replace('/[^0-9]/', '', $no);
        
        // Jika dimulai dengan 62, biarkan
        // Jika dimulai dengan 0, replace dengan 62
        if (substr($no, 0, 1) === '0') {
            $no = '62' . substr($no, 1);
        }
        
        return $no;
    }
}