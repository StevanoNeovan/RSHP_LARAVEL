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
</body>
</html>