@extends('layouts.perawat')

@section('title', 'Profil Perawat')
@section('page-title', 'Profil Saya')

@section('content')

<div class="card">
    <div class="section-header">
        <i class="fas fa-user-nurse"></i>
        <h3>Informasi Perawat</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: 200px 1fr; gap: 32px; align-items: start;">
        <!-- Avatar -->
        <div style="text-align: center;">
            <div style="width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center; color: white; font-size: 64px; font-weight: 700; margin: 0 auto 16px; border: 5px solid #e5e7eb;">
                {{ strtoupper(substr($user->nama, 0, 1)) }}
            </div>
            <h3 style="margin: 0; font-size: 20px; font-weight: 700;">{{ $user->nama }}</h3>
            <p style="color: #6b7280; font-size: 14px; margin-top: 4px;">Perawat</p>
            
            <div style="margin-top: 16px; padding: 12px; background: #d1fae5; border-radius: 8px;">
                <div style="font-size: 11px; color: #065f46; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Status</div>
                <div style="font-size: 14px; font-weight: 700; color: #065f46;">
                    @if($roleUser->status == 1)
                        <i class="fas fa-check-circle"></i> Aktif
                    @else
                        <i class="fas fa-times-circle"></i> Non-Aktif
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Info Details (Read Mode) -->
        <div id="viewMode">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3>Data Profil</h3>
                <button type="button" onclick="toggleEditMode()" class="btn btn-warning" style="padding: 8px 16px;">
                    <i class="fas fa-edit"></i> Edit Profil
                </button>
            </div>
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; width: 200px; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-user" style="width: 20px;"></i> Nama Lengkap
                    </td>
                    <td style="padding: 16px 0; font-size: 16px; font-weight: 600;">{{ $user->nama }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-envelope" style="width: 20px;"></i> Email
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">{{ $user->email }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-map-marker-alt" style="width: 20px;"></i> Alamat
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">{{ $perawat->alamat }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-phone" style="width: 20px;"></i> Nomor HP
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">{{ $perawat->no_hp }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-graduation-cap" style="width: 20px;"></i> Pendidikan
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">{{ $perawat->pendidikan }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-venus-mars" style="width: 20px;"></i> Jenis Kelamin
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">{{ $perawat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td style="padding: 16px 0; font-weight: 600; color: #6b7280;">
                        <i class="fas fa-id-badge" style="width: 20px;"></i> ID Role User
                    </td>
                    <td style="padding: 16px 0; font-size: 16px;">
                        <span style="display: inline-block; padding: 4px 12px; background: #10b98120; color: #10b981; border-radius: 6px; font-weight: 700; font-family: monospace;">
                            #{{ $roleUser->idrole_user }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Edit Form (Hidden by default) -->
        <div id="editMode" style="display: none;">
            <h3 style="margin-bottom: 20px;">Edit Data Profil</h3>
            
            <form method="POST" action="{{ route('perawat.profil.update') }}">
                @csrf
                @method('PUT')
                
                <!-- Alamat -->
                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; margin-bottom: 8px; display: block; font-size: 14px;">
                        <i class="fas fa-map-marker-alt"></i> Alamat Lengkap *
                    </label>
                    <textarea name="alamat" rows="3" required 
                              style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-family: inherit; font-size: 14px;">{{ old('alamat', $perawat->alamat) }}</textarea>
                    @error('alamat')
                        <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- No HP -->
                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; margin-bottom: 8px; display: block; font-size: 14px;">
                        <i class="fas fa-phone"></i> Nomor HP *
                    </label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $perawat->no_hp) }}" required 
                           style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;">
                    @error('no_hp')
                        <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Pendidikan -->
                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; margin-bottom: 8px; display: block; font-size: 14px;">
                        <i class="fas fa-graduation-cap"></i> Pendidikan Terakhir *
                    </label>
                    <input type="text" name="pendidikan" value="{{ old('pendidikan', $perawat->pendidikan) }}" required 
                           style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;">
                    @error('pendidikan')
                        <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Jenis Kelamin -->
                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; margin-bottom: 8px; display: block; font-size: 14px;">
                        <i class="fas fa-venus-mars"></i> Jenis Kelamin *
                    </label>
                    <div style="display: flex; gap: 24px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $perawat->jenis_kelamin) == 'L' ? 'checked' : '' }} required>
                            <span>Laki-laki</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $perawat->jenis_kelamin) == 'P' ? 'checked' : '' }} required>
                            <span>Perempuan</span>
                        </label>
                    </div>
                    @error('jenis_kelamin')
                        <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Buttons -->
                <div style="display: flex; gap: 12px;">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <button type="button" onclick="toggleEditMode()" class="btn btn-primary" style="background: #6b7280;">
                        <i class="fas fa-times"></i> Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
    
    <!-- Total Rekam Medis -->
    <div class="card" style="background: linear-gradient(135deg, #10b981, #059669); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Total Rekam Medis</div>
                <div style="font-size: 48px; font-weight: 700; margin-bottom: 8px;">{{ $total_rekam_medis }}</div>
                <div style="font-size: 13px; opacity: 0.9;">Semua waktu</div>
            </div>
            <div style="font-size: 64px; opacity: 0.2;">
                <i class="fas fa-file-medical"></i>
            </div>
        </div>
    </div>
    
    <!-- Rekam Medis Bulan Ini -->
    <div class="card" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Bulan Ini</div>
                <div style="font-size: 48px; font-weight: 700; margin-bottom: 8px;">{{ $rekam_medis_bulan_ini }}</div>
                <div style="font-size: 13px; opacity: 0.9;">{{ now()->format('F Y') }}</div>
            </div>
            <div style="font-size: 64px; opacity: 0.2;">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>

    <!-- Performance Badge -->
    <div class="card" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white;">
        <div style="text-align: center; padding: 20px 0;">
            <i class="fas fa-award" style="font-size: 48px; margin-bottom: 12px; opacity: 0.9;"></i>
            <div style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Performance Rating</div>
            <div style="font-size: 32px; font-weight: 700;">
                @php
                    $rating = $total_rekam_medis >= 200 ? 'Excellent' : 
                              ($total_rekam_medis >= 100 ? 'Good' : 
                              ($total_rekam_medis >= 50 ? 'Fair' : 'Getting Started'));
                @endphp
                {{ $rating }}
            </div>
        </div>
    </div>

</div>

<!-- Activity Info -->
<div class="card">
    <div class="section-header">
        <i class="fas fa-chart-line"></i>
        <h3>Aktivitas Profesional</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
        <div style="padding: 20px; background: #f9fafb; border-radius: 12px; text-align: center;">
            <i class="fas fa-hospital-user" style="font-size: 32px; color: #10b981; margin-bottom: 12px;"></i>
            <div style="font-size: 28px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">{{ $total_rekam_medis }}</div>
            <div style="font-size: 13px; color: #6b7280; font-weight: 600;">Rekam Medis Terdaftar</div>
        </div>
        
        <div style="padding: 20px; background: #f9fafb; border-radius: 12px; text-align: center;">
            <i class="fas fa-clock" style="font-size: 32px; color: #3b82f6; margin-bottom: 12px;"></i>
            <div style="font-size: 28px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">
                {{ $roleUser->created_at ? \Carbon\Carbon::parse($roleUser->created_at)->diffInMonths(now()) : 0 }}
            </div>
            <div style="font-size: 13px; color: #6b7280; font-weight: 600;">Bulan Pengalaman</div>
        </div>
        
        <div style="padding: 20px; background: #f9fafb; border-radius: 12px; text-align: center;">
            <i class="fas fa-calendar" style="font-size: 32px; color: #f59e0b; margin-bottom: 12px;"></i>
            <div style="font-size: 28px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">{{ $rekam_medis_bulan_ini }}</div>
            <div style="font-size: 13px; color: #6b7280; font-weight: 600;">Aktivitas Bulan Ini</div>
        </div>
        
        <div style="padding: 20px; background: #f9fafb; border-radius: 12px; text-align: center;">
            <i class="fas fa-user-check" style="font-size: 32px; color: #10b981; margin-bottom: 12px;"></i>
            <div style="font-size: 28px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">
                {{ $roleUser->status == 1 ? 'Aktif' : 'Non-Aktif' }}
            </div>
            <div style="font-size: 13px; color: #6b7280; font-weight: 600;">Status Akun</div>
        </div>
    </div>
</div>

<!-- Professional Note -->
<div class="card" style="background: linear-gradient(135deg, #10b981, #059669); color: white;">
    <div style="display: flex; align-items: start; gap: 20px;">
        <div style="font-size: 48px; opacity: 0.3;">
            <i class="fas fa-user-nurse"></i>
        </div>
        <div>
            <h3 style="margin-bottom: 12px; font-size: 20px;">
                <i class="fas fa-quote-left"></i>
                Komitmen Profesional
            </h3>
            <p style="line-height: 1.8; opacity: 0.95; margin: 0;">
                Sebagai perawat hewan, peran Anda sangat penting dalam memberikan perawatan terbaik dan mendukung tim medis. 
                Terus tingkatkan keterampilan dan dedikasi dalam merawat pasien dengan penuh kasih sayang dan profesionalisme.
            </p>
        </div>
    </div>
</div>

<!-- Educational Resources Card -->
<div class="card">
    <div class="section-header">
        <i class="fas fa-book-medical"></i>
        <h3>Pengembangan Diri</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px;">
        <div style="padding: 16px; background: #f0f9ff; border-left: 4px solid #3b82f6; border-radius: 8px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                <i class="fas fa-graduation-cap" style="font-size: 24px; color: #3b82f6;"></i>
                <h4 style="margin: 0; color: #1e40af;">Pendidikan: {{ $perawat->pendidikan }}</h4>
            </div>
            <p style="margin: 0; color: #6b7280; font-size: 13px;">
                Terus tingkatkan pengetahuan dengan mengikuti workshop dan seminar terkini.
            </p>
        </div>
        
        <div style="padding: 16px; background: #f0fdf4; border-left: 4px solid #10b981; border-radius: 8px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                <i class="fas fa-hands-helping" style="font-size: 24px; color: #10b981;"></i>
                <h4 style="margin: 0; color: #065f46;">Tim Kolaborasi</h4>
            </div>
            <p style="margin: 0; color: #6b7280; font-size: 13px;">
                Bekerja sama dengan dokter dan staf lain untuk hasil perawatan optimal.
            </p>
        </div>
        
        <div style="padding: 16px; background: #fffbeb; border-left: 4px solid #f59e0b; border-radius: 8px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                <i class="fas fa-heart" style="font-size: 24px; color: #f59e0b;"></i>
                <h4 style="margin: 0; color: #78350f;">Empati & Caring</h4>
            </div>
            <p style="margin: 0; color: #6b7280; font-size: 13px;">
                Berikan perhatian penuh kepada setiap pasien dengan kasih sayang.
            </p>
        </div>
    </div>
</div>

<script>
function toggleEditMode() {
    const viewMode = document.getElementById('viewMode');
    const editMode = document.getElementById('editMode');
    
    if (viewMode.style.display === 'none') {
        viewMode.style.display = 'block';
        editMode.style.display = 'none';
    } else {
        viewMode.style.display = 'none';
        editMode.style.display = 'block';
    }
}
</script>

@endsection