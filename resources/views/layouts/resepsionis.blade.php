<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Resepsionis') - RSHP UNAIR</title>
    
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

        /* Cards */
        .card {
            background: var(--white);
            border-radius: 12px;
            padding: 24px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 24px;
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

        .btn-success {
            background: var(--secondary-color);
            color: white;
        }

        .btn-warning {
            background: var(--accent-color);
            color: white;
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text-dark);
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
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

        .alert-danger {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .content-area {
                padding: 20px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('resepsionis.dashboard') }}" class="sidebar-logo">
                <img src="{{ asset('assets/images/06b159d24e64b44e75d5f7a0a72fcde74da910b3.png') }}" alt="Logo RSHP UNAIR">
                <div class="sidebar-logo-text">
                    <h1>RSHP UNAIR</h1>
                    <p>Portal Resepsionis</p>
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
            
            <a href="{{ route('resepsionis.dashboard') }}" class="menu-item {{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-section-title">MANAJEMEN DATA</div>

            <a href="{{ route('resepsionis.pemilik.index') }}" class="menu-item {{ request()->routeIs('resepsionis.pemilik.*') ? 'active' : '' }}">
                <i class="fas fa-user-friends"></i>
                <span>Data Pemilik</span>
            </a>

            <a href="{{ route('resepsionis.pet.index') }}" class="menu-item {{ request()->routeIs('resepsionis.pet.*') ? 'active' : '' }}">
                <i class="fas fa-paw"></i>
                <span>Data Pet</span>
            </a>

            <div class="menu-section-title">RESERVASI</div>

            <a href="{{ route('resepsionis.temu-dokter.index') }}" class="menu-item {{ request()->routeIs('resepsionis.temu-dokter.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Temu Dokter</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <h1>
                <i class="fas fa-desktop"></i>
                @yield('page-title', 'Dashboard')
            </h1>
            <div class="user-info">
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h3>{{ Auth::user()->nama }}</h3>
                        <p>Resepsionis</p>
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

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Terdapat kesalahan:</strong>
                        <ul style="margin-top: 8px; padding-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Main Content -->
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>