<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - RSHP UNAIR</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
            pointer-events: none;
        }

        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .register-container {
            width: 100%;
            max-width: 1100px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            position: relative;
            z-index: 1;
        }

        /* Left Side - Branding */
        .register-left {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 60px 50px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .register-left::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .register-left::after {
            content: '';
            position: absolute;
            bottom: -150px;
            left: -150px;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 32px;
            position: relative;
            z-index: 1;
        }

        .brand-logo img {
            width: 70px;
            height: 70px;
            background: white;
            padding: 8px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .brand-text h1 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 4px;
            letter-spacing: -0.5px;
        }

        .brand-text p {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 500;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-content h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
            line-height: 1.3;
        }

        .welcome-content p {
            font-size: 15px;
            line-height: 1.7;
            opacity: 0.95;
            margin-bottom: 32px;
        }

        .benefits {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .benefit-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .benefit-text {
            flex: 1;
        }

        .benefit-text h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .benefit-text p {
            font-size: 12px;
            opacity: 0.8;
            margin: 0;
        }

        /* Right Side - Register Form */
        .register-right {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-height: 90vh;
            overflow-y: auto;
        }

        .register-right::-webkit-scrollbar {
            width: 6px;
        }

        .register-right::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .register-right::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }

        .register-header {
            margin-bottom: 32px;
        }

        .register-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .register-header p {
            font-size: 15px;
            color: #6b7280;
        }

        /* Alert Messages */
        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            animation: slideInDown 0.3s ease;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #065f46;
        }

        .alert-danger {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        .alert i {
            font-size: 18px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981;
            background: white;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .invalid-feedback {
            display: block;
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
            font-weight: 500;
        }

        .password-strength {
            margin-top: 8px;
            font-size: 12px;
            color: #6b7280;
        }

        .strength-bar {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            margin-top: 4px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .btn-register {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            margin-top: 24px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .already-member {
            text-align: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .already-member span {
            color: #6b7280;
            font-size: 14px;
        }

        .already-member a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
            margin-left: 4px;
            transition: color 0.3s ease;
        }

        .already-member a:hover {
            color: #059669;
        }

        .back-home {
            text-align: center;
            margin-top: 16px;
        }

        .back-home a {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.3s ease;
        }

        .back-home a:hover {
            color: #10b981;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .register-container {
                grid-template-columns: 1fr;
            }

            .register-left {
                display: none;
            }

            .register-right {
                padding: 40px 30px;
                max-height: none;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0;
            }

            .register-container {
                border-radius: 0;
                min-height: 100vh;
            }

            .register-right {
                padding: 32px 24px;
            }

            .register-header h2 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Left Side - Branding -->
        <div class="register-left">
            <div class="brand-logo">
                <img src="{{ asset('assets/images/06b159d24e64b44e75d5f7a0a72fcde74da910b3.png') }}" alt="Logo RSHP UNAIR">
                <div class="brand-text">
                    <h1>RSHP UNAIR</h1>
                    <p>Rumah Sakit Hewan Pendidikan</p>
                </div>
            </div>

            <div class="welcome-content">
                <h2>Bergabung dengan RSHP UNAIR</h2>
                <p>Daftar sekarang untuk mengakses layanan kesehatan hewan terbaik dan mengelola data kesehatan hewan peliharaan Anda.</p>

                <div class="benefits">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="benefit-text">
                            <h4>Tim Dokter Berpengalaman</h4>
                            <p>Konsultasi dengan dokter hewan profesional</p>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <div class="benefit-text">
                            <h4>Rekam Medis Digital</h4>
                            <p>Akses riwayat kesehatan hewan kapan saja</p>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="benefit-text">
                            <h4>Booking Online</h4>
                            <p>Reservasi temu dokter dengan mudah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="register-right">
            <div class="register-header">
                <h2>Buat Akun</h2>
                <p>Isi formulir di bawah untuk mendaftar</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Terdapat kesalahan:</strong>
                        <ul style="margin: 8px 0 0 20px; padding: 0;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama Lengkap -->
                <div class="form-group">
                    <label for="nama">Nama Lengkap *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input 
                            id="nama" 
                            type="text" 
                            class="form-control @error('nama') is-invalid @enderror" 
                            name="nama" 
                            value="{{ old('nama') }}" 
                            required 
                            autocomplete="name" 
                            autofocus
                            placeholder="Masukkan nama lengkap">
                    </div>
                    @error('nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input 
                            id="email" 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="email"
                            placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            id="password" 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            placeholder="Minimal 6 karakter">
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <span id="strengthText">Kekuatan password: <strong>-</strong></span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password-confirm">Konfirmasi Password *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            id="password-confirm" 
                            type="password" 
                            class="form-control" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            placeholder="Ketik ulang password">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus"></i>
                    <span>Daftar Sekarang</span>
                </button>

                <!-- Captcha -->
                <div class="form-group">
                    <label style="display: flex; align-items: start; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="terms" required style="margin-top: 4px;">
                        <span style="font-size: 13px; color: #6b7280;">
                            Saya menyetujui 
                            <a href="#" style="color: #10b981; font-weight: 600;">Syarat & Ketentuan</a> 
                            dan 
                            <a href="#" style="color: #10b981; font-weight: 600;">Kebijakan Privasi</a>
                        </span>
                    </label>
                </div>

                <!-- Already Member -->
                <div class="already-member">
                    <span>Sudah punya akun?</span>
                    <a href="{{ route('login') }}">Login di sini</a>
                </div>

                <!-- Back to Home -->
                <div class="back-home">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Password Strength Checker
        const passwordInput = document.getElementById('password');
        const strengthFill = document.getElementById('strengthFill');
        const strengthText = document.getElementById('strengthText');

        passwordInput.addEventListener('input', function() {
            const value = this.value;
            let strength = 0;
            let text = '';
            let color = '';

            if (value.length === 0) {
                strengthFill.style.width = '0%';
                strengthText.innerHTML = 'Kekuatan password: <strong>-</strong>';
                return;
            }

            // Check password strength
            if (value.length >= 6) strength += 25;
            if (value.length >= 8) strength += 25;
            if (/[a-z]/.test(value) && /[A-Z]/.test(value)) strength += 25;
            if (/[0-9]/.test(value)) strength += 15;
            if (/[^a-zA-Z0-9]/.test(value)) strength += 10;

            // Set text and color
            if (strength < 40) {
                text = 'Lemah';
                color = '#ef4444';
            } else if (strength < 70) {
                text = 'Sedang';
                color = '#f59e0b';
            } else {
                text = 'Kuat';
                color = '#10b981';
            }

            strengthFill.style.width = strength + '%';
            strengthFill.style.backgroundColor = color;
            strengthText.innerHTML = `Kekuatan password: <strong style="color: ${color}">${text}</strong>`;
        });
    </script>
</body>
</html>