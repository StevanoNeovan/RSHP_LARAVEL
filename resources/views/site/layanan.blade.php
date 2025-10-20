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
</body>
</html>