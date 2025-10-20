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
</body>
</html>