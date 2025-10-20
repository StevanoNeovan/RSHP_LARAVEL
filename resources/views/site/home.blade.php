
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSHP UNAIR - Rumah Sakit Hewan Pendidikan Universitas Airlangga</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
</head>
<body>

    @include('layouts.navbar_home')


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
                <a href="{{ url('/layanan') }}" class="btn btn-secondary">
                    <i class="fas fa-stethoscope"></i>
                    Lihat Layanan
                </a>
            </div>
        </div>
    </section>


    <!-- Emergency Alert -->
    <div class="emergency-banner">
        <div class="container-emergency">
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

    <script src="{{ asset('assets/js/home.js') }}"></script>

</body>
</html>