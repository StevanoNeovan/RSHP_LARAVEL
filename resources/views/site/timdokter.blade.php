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
</body>
</html>