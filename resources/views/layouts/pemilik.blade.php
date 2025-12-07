<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Pemilik') - RSHP UNAIR</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #10b981;
            --primary-dark: #059669;
            --secondary-color: #3b82f6;
            --accent-color: #f59e0b;
            --danger-color: #ef4444;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --background-light: #f9fafb;
            --white: #ffffff;
            --border-color: #e5e7eb;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-logo img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: white;
            padding: 5px;
        }

        .sidebar-logo-text h1 {
            font-size: 20px;
            font-weight: 700;
            color: white;
            margin-bottom: 2px;
        }

        .sidebar-logo-text p {
            font-size: 11px;
            color: rgba(255,255,255,0.9);
            font-weight: 500;
        }

        .user-profile-sidebar {
            padding: 20px;
            background: rgba(255,255,255,0.1);
            margin: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .user-avatar-sidebar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-weight: 700;
            font-size: 32px;
            margin: 0 auto 12px;
            border: 4px solid rgba(255,255,255,0.3);
        }

        .user-name-sidebar {
            font-size: 16px;
            font-weight: 600;
            color: white;
            margin-bottom: 4px;
        }

        .user-email-sidebar {
            font-size: 12px;
            color: rgba(255,255,255,0.8);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-section-title {
            padding: 0 20px 8px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: rgba(255,255,255,0.7);
            letter-spacing: 0.5px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: white;
        }

        .menu-item.active {
            background: rgba(255,255,255,0.2);
            color: white;
            border-left-color: white;
            font-weight: 600;
        }

        .menu-item i {
            width: 20px;
            font-size: 18px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* Top Bar */
        .top-bar {
            background: var(--white);
            border-bottom: 1px solid var(--border-color);
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .top-bar h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .top-bar h1 i {
            color: var(--primary-color);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .user-details h3 {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .user-details p {
            font-size: 12px;
            color: var(--text-light);
        }

        .btn-logout {
            padding: 10px 20px;
            background: var(--danger-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        /* Content Area */
        .content-area {
            padding: 32px;
        }

        /* Welcome Banner */
        .welcome-banner {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            padding: 32px;
            border-radius: 16px;
            color: white;
            margin-bottom: 32px;
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.2);
        }

        .welcome-banner h2 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .welcome-banner p {
            font-size: 16px;
            opacity: 0.95;
            line-height: 1.6;
        }

        /* Cards */
        .card {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 24px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .section-header i {
            font-size: 24px;
            color: var(--primary-color);
        }

        .section-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--white);
            padding: 24px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-icon.primary {
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary-color);
        }

        .stat-icon.secondary {
            background: rgba(59, 130, 246, 0.1);
            color: var(--secondary-color);
        }

        .stat-icon.accent {
            background: rgba(245, 158, 11, 0.1);
            color: var(--accent-color);
        }

        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-light);
            font-weight: 500;
        }

        /* Alert */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #065f46;
        }

        .alert-info {
            background: #dbeafe;
            border: 1px solid #93c5fd;
            color: #1e40af;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .content-area {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('pemilik.dashboard') }}" class="sidebar-logo">
                <img src="{{ asset('assets/images/06b159d24e64b44e75d5f7a0a72fcde74da910b3.png') }}" alt="Logo RSHP UNAIR">
                <div class="sidebar-logo-text">
                    <h1>RSHP UNAIR</h1>
                    <p>Portal Pemilik</p>
                </div>
            </a>
        </div>

        <!-- User Profile in Sidebar -->
        <div class="user-profile-sidebar">
            <div class="user-avatar-sidebar">
                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
            </div>
            <div class="user-name-sidebar">{{ Auth::user()->nama }}</div>
            <div class="user-email-sidebar">{{ Auth::user()->email }}</div>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-section-title">MENU UTAMA</div>
            
            <a href="{{ route('pemilik.dashboard') }}" class="menu-item {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('pemilik.profil') }}" class="menu-item {{ request()->routeIs('pemilik.profil') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>Profil Saya</span>
            </a>

            <a href="{{ route('pemilik.pets.index') }}" class="menu-item {{ request()->routeIs('pemilik.pets.*') ? 'active' : '' }}">
                <i class="fas fa-paw"></i>
                <span>Pet Saya</span>
            </a>

            <div class="menu-section-title">LAYANAN</div>

            <a href="{{ route('pemilik.temu-dokter.index') }}" class="menu-item {{ request()->routeIs('pemilik.temu-dokter.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Jadwal Temu Dokter</span>
            </a>

            <a href="{{ route('pemilik.rekam-medis.index') }}" class="menu-item {{ request()->routeIs('pemilik.rekam-medis.*') ? 'active' : '' }}">
                <i class="fas fa-file-medical"></i>
                <span>Rekam Medis</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <h1>
                <i class="fas fa-th-large"></i>
                @yield('page-title', 'Dashboard')
            </h1>
            <div class="user-info">
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h3>{{ Auth::user()->nama }}</h3>
                        <p>Pemilik Hewan</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Main Content -->
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>