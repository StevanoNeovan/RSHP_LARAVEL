<!-- Header -->
<header class="header" id="header">
    <div class="header-container">
        <div class="logo-section">
            <img src="{{ asset('assets/images/06b159d24e64b44e75d5f7a0a72fcde74da910b3.png') }}" 
                 alt="Logo RSHP UNAIR dengan simbol medis veteriner" 
                 class="logo" />
            <div class="logo-text">
                <h1>RSHP UNAIR</h1>
                <p>Rumah Sakit Hewan Pendidikan</p>
            </div>
        </div>
        
        <nav class="main-nav">
            <ul class="nav-menu">
                <li><a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
                
                <li class="dropdown">
                    <a href="{{ url('/layanan') }}" class="nav-link {{ request()->is('layanan') ? 'active' : '' }}">
                        Layanan <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/layanan#rawat-jalan') }}">Rawat Jalan</a></li>
                        <li><a href="{{ url('/layanan#rawat-inap') }}">Rawat Inap</a></li>
                        <li><a href="{{ url('/layanan#operasi') }}">Bedah & Operasi</a></li>
                        <li><a href="{{ url('/layanan#emergency') }}">Layanan Darurat</a></li>
                    </ul>
                </li>

                <li><a href="{{ url('/timdokter') }}" class="nav-link {{ request()->is('timdokter') ? 'active' : '' }}">Tim Dokter</a></li>
                <li><a href="{{ url('/tentang') }}" class="nav-link {{ request()->is('tentang') ? 'active' : '' }}">Tentang</a></li>
                <li><a href="{{ url('/kontak') }}" class="nav-link {{ request()->is('kontak') ? 'active' : '' }}">Kontak</a></li>
            </ul>
        </nav>
        
        <div class="header-actions">
            <div class="emergency-info">
                <i class="fas fa-phone-alt"></i>
                <div class="emergency-text">
                    <span class="emergency-label">Darurat 24/7</span>
                    <span class="emergency-number">(031) 5992-911</span>
                </div>
            </div>
            <a href="{{ url('/login') }}" class="btn-login">
                <i class="fas fa-user-circle"></i>
                Portal Pasien
            </a>
        </div>
        
        <button class="mobile-menu-toggle" id="mobileToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
