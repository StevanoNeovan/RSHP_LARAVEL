<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSHP UNAIR - Rumah Sakit Hewan Pendidikan Universitas Airlangga</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header" id="header">
        <div class="header-container">
            <div class="logo-section">
                <img src="assets/images/06b159d24e64b44e75d5f7a0a72fcde74da910b3.png" alt="Logo RSHP UNAIR dengan simbol medis veteriner" class="logo" />
                <div class="logo-text">
                    <h1>RSHP UNAIR</h1>
                    <p>Rumah Sakit Hewan Pendidikan</p>
                </div>
            </div>
            
            <nav class="main-nav">
                <ul class="nav-menu">
                    <li><a href="#beranda" class="nav-link active">Beranda</a></li>
                    <li class="dropdown">
                        <a href="#layanan" class="nav-link">Layanan <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#rawat-jalan">Rawat Jalan</a></li>
                            <li><a href="#rawat-inap">Rawat Inap</a></li>
                            <li><a href="#operasi">Bedah & Operasi</a></li>
                            <li><a href="#emergency">Layanan Darurat</a></li>
                        </ul>
                    </li>
                    <li><a href="#dokter" class="nav-link">Tim Dokter</a></li>
                    <li><a href="#tentang" class="nav-link">Tentang</a></li>
                    <li><a href="#kontak" class="nav-link">Kontak</a></li>
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
                <a href="login.php" class="btn-login">
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

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="hero-background">
            <img src="assets/images/hero image.jpg" alt="Ruang pemeriksaan modern RSHP UNAIR dengan dokter hewan sedang memeriksa anjing" />
            <div class="hero-overlay"></div>
        </div>
        
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-award"></i>
                <span>Terakreditasi A - Standar Internasional</span>
            </div>
            
            <h1 class="hero-title">
                Kesehatan Terbaik untuk <span class="highlight">Sahabat Setia</span> Anda
            </h1>
            
            <p class="hero-subtitle">
                RSHP UNAIR memberikan pelayanan kesehatan hewan terdepan dengan teknologi modern, 
                tim dokter berpengalaman, dan fasilitas lengkap untuk kesembuhan optimal hewan kesayangan Anda.
            </p>
            
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">15,000+</div>
                    <div class="stat-label">Hewan Ditangani</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">25+</div>
                    <div class="stat-label">Dokter Spesialis</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Layanan Darurat</div>
                </div>
            </div>
            
            <div class="hero-actions">
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-calendar-plus"></i>
                    Buat Janji Temu
                </a>
                <a href="#layanan" class="btn btn-secondary">
                    <i class="fas fa-stethoscope"></i>
                    Lihat Layanan
                </a>
            </div>
        </div>
    </section>

    <!-- Emergency Alert -->
    <div class="emergency-banner">
        <div class="container">
            <div class="emergency-content">
                <i class="fas fa-ambulance"></i>
                <div class="emergency-info">
                    <strong>Layanan Darurat 24 Jam</strong>
                    <span>Hubungi (031) 5992-911 untuk kondisi darurat hewan Anda</span>
                </div>
                <a href="tel:0315992911" class="btn btn-emergency">
                    <i class="fas fa-phone"></i>
                    Hubungi Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <section class="services" id="layanan">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Layanan Unggulan</span>
                <h2>Pelayanan Kesehatan Hewan Terlengkap</h2>
                <p>Kami menyediakan berbagai layanan medis komprehensif untuk kesehatan optimal hewan kesayangan Anda</p>
            </div>
            
            <div class="services-grid">
                <div class="service-card primary">
                    <div class="service-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3>Konsultasi & Pemeriksaan</h3>
                    <p>Konsultasi dokter spesialis, pemeriksaan rutin, diagnosis penyakit, dan program pencegahan</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Pemeriksaan fisik lengkap</li>
                        <li><i class="fas fa-check"></i> Konsultasi nutrisi</li>
                        <li><i class="fas fa-check"></i> Program vaksinasi</li>
                    </ul>
                    <a href="#" class="service-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-x-ray"></i>
                    </div>
                    <h3>Diagnostik & Laboratorium</h3>
                    <p>Fasilitas diagnostik modern dengan teknologi terdepan untuk diagnosis yang akurat</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Rontgen & USG</li>
                        <li><i class="fas fa-check"></i> Lab darah & urin</li>
                        <li><i class="fas fa-check"></i> Endoskopi</li>
                    </ul>
                    <a href="#" class="service-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-procedures"></i>
                    </div>
                    <h3>Bedah & Operasi</h3>
                    <p>Layanan bedah dengan standar medis tinggi dan peralatan modern</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Bedah umum & khusus</li>
                        <li><i class="fas fa-check"></i> Sterilisasi</li>
                        <li><i class="fas fa-check"></i> Operasi darurat</li>
                    </ul>
                    <a href="#" class="service-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <h3>Rawat Inap</h3>
                    <p>Fasilitas rawat inap nyaman dengan perawatan 24 jam dari tim medis berpengalaman</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> ICU hewan</li>
                        <li><i class="fas fa-check"></i> Monitoring 24/7</li>
                        <li><i class="fas fa-check"></i> Perawatan post-operasi</li>
                    </ul>
                    <a href="#" class="service-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-cut"></i>
                    </div>
                    <h3>Grooming & Perawatan</h3>
                    <p>Layanan grooming profesional dan perawatan estetika untuk kesehatan kulit dan bulu</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Mandi & grooming</li>
                        <li><i class="fas fa-check"></i> Perawatan kuku</li>
                        <li><i class="fas fa-check"></i> Spa hewan</li>
                    </ul>
                    <a href="#" class="service-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <h3>Layanan Darurat</h3>
                    <p>Siap melayani kondisi darurat hewan 24/7 dengan tim medis siaga</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Panggilan darurat</li>
                        <li><i class="fas fa-check"></i> Ambulans hewan</li>
                        <li><i class="fas fa-check"></i> Penanganan trauma</li>
                    </ul>
                    <a href="#" class="service-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-choose">
        <div class="container">
            <div class="why-choose-content">
                <div class="why-choose-text">
                    <span class="section-badge">Mengapa Memilih Kami</span>
                    <h2>Keunggulan RSHP UNAIR</h2>
                    <p class="why-intro">
                        Dengan pengalaman puluhan tahun, kami berkomitmen memberikan pelayanan terbaik 
                        untuk kesehatan hewan kesayangan Anda.
                    </p>
                    
                    <div class="advantages">
                        <div class="advantage-item">
                            <div class="advantage-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="advantage-content">
                                <h4>Tim Dokter Berpengalaman</h4>
                                <p>Dokter hewan lulusan terbaik dengan sertifikasi internasional dan pengalaman puluhan tahun</p>
                            </div>
                        </div>
                        
                        <div class="advantage-item">
                            <div class="advantage-icon">
                                <i class="fas fa-microscope"></i>
                            </div>
                            <div class="advantage-content">
                                <h4>Teknologi Medis Terdepan</h4>
                                <p>Peralatan medis modern dan teknologi diagnostik terbaru untuk hasil yang akurat</p>
                            </div>
                        </div>
                        
                        <div class="advantage-item">
                            <div class="advantage-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="advantage-content">
                                <h4>Pelayanan Penuh Kasih</h4>
                                <p>Menangani setiap hewan dengan penuh kasih sayang dan perhatian khusus</p>
                            </div>
                        </div>
                        
                        <div class="advantage-item">
                            <div class="advantage-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="advantage-content">
                                <h4>Standar Keamanan Tinggi</h4>
                                <p>Protokol keamanan dan sterilisasi sesuai standar internasional</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="why-choose-image">
                    <img src="assets/images/young-handsome-physician-medical-robe-with-stethoscope.jpg" alt="Dokter hewan profesional sedang memeriksa anjing golden retriever di klinik modern" />
                    <div class="experience-badge">
                        <div class="badge-content">
                            <span class="badge-number">25+</span>
                            <span class="badge-text">Tahun Pengalaman</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctors Team -->
    <section class="doctors" id="dokter">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Tim Medis</span>
                <h2>Dokter Hewan Berpengalaman</h2>
                <p>Tim dokter spesialis kami siap memberikan perawatan terbaik untuk hewan kesayangan Anda</p>
            </div>
            
            <div class="doctors-grid">
                <div class="doctor-card">
                    <div class="doctor-image">
                        <img src="assets/images/sarah.jpg" alt="Dr. Sarah Wijaya, dokter hewan spesialis bedah di RSHP UNAIR" />
                        <div class="doctor-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <div class="doctor-info">
                        <h3>Dr. Sarah Wijaya, DVM</h3>
                        <p class="doctor-specialty">Spesialis Bedah & Ortopedi</p>
                        <p class="doctor-experience">15+ tahun pengalaman</p>
                        <div class="doctor-credentials">
                            <span><i class="fas fa-graduation-cap"></i> S1 FKH UNAIR, S2 UC Davis</span>
                        </div>
                    </div>
                </div>
                
                <div class="doctor-card">
                    <div class="doctor-image">
                        <img src="assets/images/ahmad rizki.jpg" alt="Dr. Ahmad Rizki, dokter hewan spesialis penyakit dalam di RSHP UNAIR" />
                        <div class="doctor-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <div class="doctor-info">
                        <h3>Dr. Ahmad Rizki, DVM, MSc</h3>
                        <p class="doctor-specialty">Spesialis Penyakit Dalam</p>
                        <p class="doctor-experience">12+ tahun pengalaman</p>
                        <div class="doctor-credentials">
                            <span><i class="fas fa-graduation-cap"></i> S1 FKH UNAIR, S2 University of Melbourne</span>
                        </div>
                    </div>
                </div>
                
                <div class="doctor-card">
                    <div class="doctor-image">
                        <img src="assets/images/maria.jpg" alt="Dr. Maria Kusuma, dokter hewan spesialis dermatologi di RSHP UNAIR" />
                        <div class="doctor-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <div class="doctor-info">
                        <h3>Dr. Maria Kusuma, DVM</h3>
                        <p class="doctor-specialty">Spesialis Dermatologi</p>
                        <p class="doctor-experience">10+ tahun pengalaman</p>
                        <div class="doctor-credentials">
                            <span><i class="fas fa-graduation-cap"></i> S1 FKH UNAIR, Fellowship Cornell</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="tentang">
        <div class="container">
            <div class="about-content">
                <div class="about-image">
                    <img src="assets/images/doktor hewan.jpg" alt="Gedung modern RSHP UNAIR dengan logo universitas dan tanda medis" />
                </div>
                
                <div class="about-text">
                    <span class="section-badge">Tentang RSHP UNAIR</span>
                    <h2>Rumah Sakit Hewan Terdepan di Indonesia Timur</h2>
                    
                    <p>
                        RSHP UNAIR merupakan rumah sakit hewan pendidikan yang berafiliasi dengan 
                        Fakultas Kedokteran Hewan Universitas Airlangga. Sejak didirikan, kami telah 
                        melayani ribuan hewan dengan standar medis internasional.
                    </p>
                    
                    <p>
                        Sebagai institusi pendidikan, kami berkomitmen tidak hanya dalam memberikan 
                        pelayanan kesehatan terbaik, tetapi juga dalam mengembangkan ilmu kedokteran 
                        hewan melalui penelitian dan pengabdian masyarakat.
                    </p>
                    
                    <div class="about-highlights">
                        <div class="highlight-item">
                            <i class="fas fa-award"></i>
                            <div>
                                <h4>Terakreditasi A</h4>
                                <p>Standar pelayanan internasional</p>
                            </div>
                        </div>
                        
                        <div class="highlight-item">
                            <i class="fas fa-university"></i>
                            <div>
                                <h4>Afiliasi UNAIR</h4>
                                <p>Didukung riset dan teknologi terkini</p>
                            </div>
                        </div>
                        
                        <div class="highlight-item">
                            <i class="fas fa-globe"></i>
                            <div>
                                <h4>Jejaring Internasional</h4>
                                <p>Kerjasama dengan universitas dunia</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="about-actions">
                        <a href="#kontak" class="btn btn-primary">
                            <i class="fas fa-calendar-check"></i>
                            Buat Janji Temu
                        </a>
                        <a href="#" class="btn btn-outline">
                            <i class="fas fa-download"></i>
                            Download Brosur
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="kontak">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info">
                    <span class="section-badge">Hubungi Kami</span>
                    <h2>Informasi Kontak & Lokasi</h2>
                    
                    <div class="contact-items">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Alamat</h4>
                                <p>Kampus C Universitas Airlangga<br>
                                Jl. Mulyorejo, Surabaya 60115<br>
                                Jawa Timur, Indonesia</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon emergency">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Telepon & Darurat</h4>
                                <p>Resepsionis: <a href="tel:0315992785">(031) 5992-785</a><br>
                                Darurat 24/7: <a href="tel:0315992911">(031) 5992-911</a><br>
                                WhatsApp: <a href="https://wa.me/6281234567890">+62 812-3456-7890</a></p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Email</h4>
                                <p>Info: <a href="mailto:info@rshp.unair.ac.id">info@rshp.unair.ac.id</a><br>
                                Darurat: <a href="mailto:emergency@rshp.unair.ac.id">emergency@rshp.unair.ac.id</a><br>
                                Administrasi: <a href="mailto:admin@rshp.unair.ac.id">admin@rshp.unair.ac.id</a></p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Jam Operasional</h4>
                                <p>Senin - Jumat: 08:00 - 20:00<br>
                                Sabtu: 08:00 - 16:00<br>
                                Minggu: 09:00 - 15:00<br>
                                <strong>Darurat: 24/7</strong></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-media">
                        <h4>Ikuti Kami</h4>
                        <div class="social-links">
                            <a href="#" class="social-link facebook">
                                <i class="fab fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>
                            <a href="#" class="social-link instagram">
                                <i class="fab fa-instagram"></i>
                                <span>Instagram</span>
                            </a>
                            <a href="#" class="social-link youtube">
                                <i class="fab fa-youtube"></i>
                                <span>YouTube</span>
                            </a>
                            <a href="#" class="social-link tiktok">
                                <i class="fab fa-tiktok"></i>
                                <span>TikTok</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form-section">
                    <div class="contact-form-card">
                        <h3><i class="fas fa-calendar-plus"></i> Buat Janji Temu</h3>
                        <p>Isi form di bawah untuk membuat janji temu dengan dokter hewan kami</p>
                        
                        <form class="appointment-form" id="appointmentForm">
                            <div class="form-group">
                                <label for="ownerName">Nama Pemilik</label>
                                <input type="text" id="ownerName" name="owner_name" required>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone">Nomor Telepon</label>
                                    <input type="tel" id="phone" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="petName">Nama Hewan</label>
                                <input type="text" id="petName" name="pet_name" required>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="petType">Jenis Hewan</label>
                                    <select id="petType" name="pet_type" required>
                                        <option value="">Pilih jenis hewan</option>
                                        <option value="anjing">Anjing</option>
                                        <option value="kucing">Kucing</option>
                                        <option value="burung">Burung</option>
                                        <option value="kelinci">Kelinci</option>
                                        <option value="hamster">Hamster</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="service">Layanan</label>
                                    <select id="service" name="service" required>
                                        <option value="">Pilih layanan</option>
                                        <option value="konsultasi">Konsultasi Umum</option>
                                        <option value="vaksinasi">Vaksinasi</option>
                                        <option value="grooming">Grooming</option>
                                        <option value="bedah">Bedah</option>
                                        <option value="rawat-inap">Rawat Inap</option>
                                        <option value="darurat">Darurat</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="appointmentDate">Tanggal Kunjungan</label>
                                    <input type="date" id="appointmentDate" name="appointment_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="appointmentTime">Waktu</label>
                                    <select id="appointmentTime" name="appointment_time" required>
                                        <option value="">Pilih waktu</option>
                                        <option value="08:00">08:00</option>
                                        <option value="09:00">09:00</option>
                                        <option value="10:00">10:00</option>
                                        <option value="11:00">11:00</option>
                                        <option value="13:00">13:00</option>
                                        <option value="14:00">14:00</option>
                                        <option value="15:00">15:00</option>
                                        <option value="16:00">16:00</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="notes">Catatan Tambahan</label>
                                <textarea id="notes" name="notes" rows="3" placeholder="Jelaskan kondisi hewan atau keluhan..."></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-full">
                                <i class="fas fa-paper-plane"></i>
                                Kirim Permintaan Janji Temu
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <img src="assets/images/06b159d24e64b44e75d5f7a0a72fcde74da910b3.png" alt="Logo RSHP UNAIR" />
                        <div>
                            <h3>RSHP UNAIR</h3>
                            <p>Rumah Sakit Hewan Pendidikan</p>
                        </div>
                    </div>
                    <p class="footer-desc">
                        Memberikan pelayanan kesehatan hewan terbaik dengan standar medis internasional, 
                        didukung oleh tim dokter berpengalaman dan teknologi modern.
                    </p>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li><a href="#">Konsultasi & Pemeriksaan</a></li>
                        <li><a href="#">Bedah & Operasi</a></li>
                        <li><a href="#">Diagnostik & Lab</a></li>
                        <li><a href="#">Rawat Inap</a></li>
                        <li><a href="#">Layanan Darurat 24/7</a></li>
                        <li><a href="#">Grooming & Perawatan</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Informasi</h4>
                    <ul>
                        <li><a href="#">Tentang RSHP UNAIR</a></li>
                        <li><a href="#">Tim Dokter</a></li>
                        <li><a href="#">Fasilitas</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Berita & Artikel</a></li>
                        <li><a href="#">Testimoni</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Kontak Darurat</h4>
                    <div class="contact-emergency">
                        <div class="emergency-item">
                            <i class="fas fa-phone-alt"></i>
                            <div>
                                <strong>Darurat 24/7</strong>
                                <a href="tel:0315992911">(031) 5992-911</a>
                            </div>
                        </div>
                        <div class="emergency-item">
                            <i class="fab fa-whatsapp"></i>
                            <div>
                                <strong>WhatsApp</strong>
                                <a href="https://wa.me/6281234567890">+62 812-3456-7890</a>
                            </div>
                        </div>
                        <div class="emergency-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>Email Darurat</strong>
                                <a href="mailto:emergency@rshp.unair.ac.id">emergency@rshp.unair.ac.id</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; <?= date('Y') ?> RSHP UNAIR - Rumah Sakit Hewan Pendidikan Universitas Airlangga. All rights reserved.</p>
                    <div class="footer-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- CSS Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #10b981;
            --accent-color: #f59e0b;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --background-light: #f9fafb;
            --white: #ffffff;
            --border-color: #e5e7eb;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 30px rgba(0,0,0,0.15);
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo {
            width: 50px;
            height: 50px;
            border-radius: 8px;
        }

        .logo-text h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 2px;
        }

        .logo-text p {
            font-size: 12px;
            color: var(--text-light);
            font-weight: 500;
        }

        .main-nav .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }

        .nav-link {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            padding: 8px 0;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--primary-color);
            border-radius: 1px;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 15px);
            left: 0;
            background: white;
            min-width: 200px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            list-style: none;
            border: 1px solid var(--border-color);
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu a {
            display: block;
            padding: 12px 20px;
            color: var(--text-dark);
            text-decoration: none;
            font-size: 14px;
            border-radius: 8px;
            margin: 4px;
            transition: all 0.2s ease;
        }

        .dropdown-menu a:hover {
            background: var(--background-light);
            color: var(--primary-color);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .emergency-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border-radius: 8px;
            font-size: 14px;
        }

        .emergency-info i {
            font-size: 16px;
        }

        .emergency-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .emergency-label {
            font-size: 11px;
            opacity: 0.9;
        }

        .emergency-number {
            font-weight: 700;
            font-size: 14px;
        }

        .btn-login {
            background: var(--primary-color);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 4px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background: var(--text-dark);
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 600px;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
        }

        .hero-background img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, 
                rgba(37, 99, 235, 0.8) 0%, 
                rgba(29, 78, 216, 0.6) 50%,
                rgba(16, 185, 129, 0.4) 100%
            );
            z-index: -1;
        }

        .hero-content {
            color: white;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding: 0 20px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 24px;
        }

        .highlight {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            line-height: 1.6;
            margin-bottom: 40px;
            opacity: 0.95;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--accent-color);
            line-height: 1;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 4px;
        }

        .hero-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-color), #d97706);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
        }

        .btn-emergency {
            background: var(--danger-color);
            color: white;
        }

        .btn-emergency:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .btn-full {
            width: 100%;
            justify-content: center;
        }

        /* Emergency Banner */
        .emergency-banner {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 15px 0;
            position: sticky;
            top: 80px;
            z-index: 999;
        }

        .emergency-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .emergency-content .emergency-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .emergency-content i {
            font-size: 1.5rem;
        }

        /* Section Styling */
        section {
            padding: 80px 0;
        }

        .section-header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 60px;
        }

        .section-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .section-header h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .section-header p {
            font-size: 1.1rem;
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Services Section */
        .services {
            background: var(--background-light);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .service-card {
            background: white;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-top: 4px solid var(--primary-color);
            position: relative;
            overflow: hidden;
        }

        .service-card.primary {
            border-top-color: var(--accent-color);
            background: linear-gradient(135deg, #fef3c7 0%, white 50%);
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 24px;
        }

        .service-card.primary .service-icon {
            background: linear-gradient(135deg, var(--accent-color), #d97706);
        }

        .service-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .service-card p {
            color: var(--text-light);
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .service-features {
            list-style: none;
            margin-bottom: 24px;
        }

        .service-features li {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            color: var(--text-light);
            font-size: 14px;
        }

        .service-features i {
            color: var(--success-color);
            font-size: 12px;
        }

        .service-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .service-link:hover {
            gap: 12px;
        }

        /* Why Choose Section */
        .why-choose-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .why-choose-text {
            position: relative;
        }

        .why-intro {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .advantages {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .advantage-item {
            display: flex;
            gap: 20px;
        }

        .advantage-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--secondary-color), #059669);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .advantage-content h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .advantage-content p {
            color: var(--text-light);
            line-height: 1.6;
        }

        .why-choose-image {
            position: relative;
        }

        .why-choose-image img {
            width: 100%;
            height: 600px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .experience-badge {
            position: absolute;
            bottom: 30px;
            left: 30px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
        }

        .badge-number {
            display: block;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .badge-text {
            font-size: 0.9rem;
            color: var(--text-light);
            font-weight: 600;
        }

        /* Doctors Section */
        .doctors {
            background: var(--background-light);
        }

        .doctors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .doctor-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .doctor-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }

        .doctor-image {
            position: relative;
            overflow: hidden;
        }

        .doctor-image img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .doctor-card:hover .doctor-image img {
            transform: scale(1.05);
        }

        .doctor-social {
            position: absolute;
            bottom: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .doctor-card:hover .doctor-social {
            opacity: 1;
        }

        .doctor-social a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .doctor-social a:hover {
            background: var(--primary-color);
            color: white;
        }

        .doctor-info {
            padding: 30px;
        }

        .doctor-info h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .doctor-specialty {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 4px;
        }

        .doctor-experience {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 16px;
        }

        .doctor-credentials {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        /* About Section */
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .about-image img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .about-text p {
            color: var(--text-light);
            margin-bottom: 20px;
            line-height: 1.7;
            font-size: 1.1rem;
        }

        .about-highlights {
            margin: 40px 0;
        }

        .highlight-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
        }

        .highlight-item i {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--accent-color), #d97706);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .highlight-item h4 {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .highlight-item p {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .about-actions {
            display: flex;
            gap: 20px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        /* Contact Section */
        .contact {
            background: var(--background-light);
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
        }

        .contact-items {
            display: flex;
            flex-direction: column;
            gap: 30px;
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .contact-item {
            display: flex;
            gap: 20px;
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .contact-icon.emergency {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
        }

        .contact-details h4 {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .contact-details p {
            color: var(--text-light);
            line-height: 1.6;
        }

        .contact-details a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .contact-details a:hover {
            text-decoration: underline;
        }

        .social-media h4 {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .social-links {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .social-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: white;
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .social-link:hover {
            transform: translateY(-2px);
        }

        .social-link.facebook:hover {
            border-color: #1877f2;
            color: #1877f2;
        }

        .social-link.instagram:hover {
            border-color: #e4405f;
            color: #e4405f;
        }

        .social-link.youtube:hover {
            border-color: #ff0000;
            color: #ff0000;
        }

        .social-link.tiktok:hover {
            border-color: #000000;
            color: #000000;
        }

        /* Contact Form */
        .contact-form-section {
            position: relative;
        }

        .contact-form-card {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .contact-form-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .contact-form-card p {
            color: var(--text-light);
            margin-bottom: 30px;
        }

        .appointment-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        /* Footer */
        .footer {
            background: var(--text-dark);
            color: white;
            padding: 60px 0 20px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .footer-logo img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
        }

        .footer-logo h3 {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 700;
        }

        .footer-logo p {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .footer-desc {
            color: #9ca3af;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .footer-social {
            display: flex;
            gap: 12px;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }

        .footer-section h4 {
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: 10px;
        }

        .footer-section a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--primary-color);
        }

        .contact-emergency {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .emergency-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .emergency-item i {
            width: 35px;
            height: 35px;
            background: var(--danger-color);
            color: white;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .emergency-item strong {
            display: block;
            font-size: 0.85rem;
            margin-bottom: 2px;
        }

        .emergency-item a {
            color: var(--accent-color);
            font-weight: 600;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 30px;
        }

        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
            }

            .main-nav {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
            }

            .main-nav.active {
                max-height: 400px;
            }

            .nav-menu {
                flex-direction: column;
                padding: 20px;
                gap: 0;
            }

            .nav-menu li {
                width: 100%;
                border-bottom: 1px solid var(--border-color);
            }

            .nav-link {
                display: block;
                padding: 15px 0;
            }

            .dropdown-menu {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: none;
                box-shadow: none;
                background: var(--background-light);
                margin-top: 10px;
            }

            .header-actions {
                flex-direction: column;
                gap: 10px;
            }

            .emergency-info {
                order: 2;
            }

            .hero-stats {
                gap: 20px;
            }

            .stat-number {
                font-size: 2rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .why-choose-content,
            .about-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .doctors-grid {
                grid-template-columns: 1fr;
            }

            .contact-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .form-row {
                flex-direction: column;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
            }

            .hero-actions {
                flex-direction: column;
            }

            .emergency-content {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .section-header h2 {
                font-size: 1.8rem;
            }

            .service-card,
            .contact-form-card {
                padding: 20px;
            }
        }
    </style>

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        const mobileToggle = document.getElementById('mobileToggle');
        const mainNav = document.querySelector('.main-nav');

        mobileToggle.addEventListener('click', () => {
            mainNav.classList.toggle('active');
            mobileToggle.classList.toggle('active');
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerHeight = document.getElementById('header').offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Active navigation link
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        // Set minimum date for appointment
        const appointmentDate = document.getElementById('appointmentDate');
        if (appointmentDate) {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            appointmentDate.min = tomorrow.toISOString().split('T')[0];
        }

        // Form submission
        const appointmentForm = document.getElementById('appointmentForm');
        if (appointmentForm) {
            appointmentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
                submitBtn.disabled = true;
                
                // Simulate form submission
                setTimeout(() => {
                    alert('Terima kasih! Permintaan janji temu Anda telah dikirim. Tim kami akan menghubungi Anda segera.');
                    this.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 2000);
            });
        }

        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.addEventListener('DOMContentLoaded', () => {
            const animateElements = document.querySelectorAll('.service-card, .doctor-card, .advantage-item');
            animateElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });
        });
    </script>
</body>
</html>