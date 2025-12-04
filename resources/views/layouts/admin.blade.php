<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - RSHP UNAIR</title>
    
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
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #10b981;
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
            background: var(--white);
            border-right: 1px solid var(--border-color);
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid var(--border-color);
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
            border-radius: 8px;
        }

        .sidebar-logo-text h1 {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 2px;
        }

        .sidebar-logo-text p {
            font-size: 11px;
            color: var(--text-light);
            font-weight: 500;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-section {
            margin-bottom: 24px;
        }

        .menu-section-title {
            padding: 0 20px 8px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-light);
            letter-spacing: 0.5px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: var(--background-light);
            color: var(--primary-color);
            border-left-color: var(--primary-color);
        }

        .menu-item.active {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-color);
            border-left-color: var(--primary-color);
            font-weight: 600;
        }

        .menu-item i {
            width: 20px;
            font-size: 18px;
            text-align: center;
        }

        .menu-item span {
            font-size: 14px;
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

        .top-bar-left h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
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
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .card-title {
            font-size: 18px;
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
        }

        .btn-success {
            background: var(--secondary-color);
            color: white;
        }

        .btn-success:hover {
            background: #059669;
            transform: translateY(-2px);
        }

        .btn-warning {
            background: var(--accent-color);
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
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

        .alert-info {
            background: #dbeafe;
            border: 1px solid #93c5fd;
            color: #1e40af;
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
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                <img src="{{ asset('assets/images/06b159d24e64b44e75d5f7a0a72fcde74da910b3.png') }}" alt="Logo RSHP UNAIR">
                <div class="sidebar-logo-text">
                    <h1>RSHP UNAIR</h1>
                    <p>Administrator Panel</p>
                </div>
            </a>
        </div>

        <nav class="sidebar-menu">
            <!-- Dashboard -->
            <div class="menu-section">
                <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- Master Data -->
            <div class="menu-section">
                <div class="menu-section-title">Master Data</div>
                <a href="{{ route('admin.jenis-hewan.index') }}" class="menu-item {{ request()->routeIs('admin.jenis-hewan.*') ? 'active' : '' }}">
                    <i class="fas fa-paw"></i>
                    <span>Jenis Hewan</span>
                </a>
                <a href="{{ route('admin.ras-hewan.index') }}" class="menu-item {{ request()->routeIs('admin.ras-hewan.*') ? 'active' : '' }}">
                    <i class="fas fa-dog"></i>
                    <span>Ras Hewan</span>
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="menu-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                    <i class="fas fa-folder"></i>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('admin.kategori-klinis.index') }}" class="menu-item {{ request()->routeIs('admin.kategori-klinis.*') ? 'active' : '' }}">
                    <i class="fas fa-stethoscope"></i>
                    <span>Kategori Klinis</span>
                </a>
                <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="menu-item {{ request()->routeIs('admin.kode-tindakan-terapi.*') ? 'active' : '' }}">
                    <i class="fas fa-notes-medical"></i>
                    <span>Kode Tindakan</span>
                </a>
            </div>

            <!-- User Management -->
            <div class="menu-section">
                <div class="menu-section-title">User Management</div>
                <a href="{{ route('admin.user.index') }}" class="menu-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>User</span>
                </a>
                <a href="{{ route('admin.role.index') }}" class="menu-item {{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
                    <i class="fas fa-user-tag"></i>
                    <span>Role</span>
                </a>
                <a href="{{ route('admin.role-user.index') }}" class="menu-item {{ request()->routeIs('admin.role-user.*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield"></i>
                    <span>Role User</span>
                </a>
            </div>

            <!-- Transactional Data -->
            <div class="menu-section">
                <div class="menu-section-title">Data Transaksi</div>
                <a href="{{ route('admin.pemilik.index') }}" class="menu-item {{ request()->routeIs('admin.pemilik.*') ? 'active' : '' }}">
                    <i class="fas fa-user-friends"></i>
                    <span>Pemilik</span>
                </a>
                <a href="{{ route('admin.pet.index') }}" class="menu-item {{ request()->routeIs('admin.pet.*') ? 'active' : '' }}">
                    <i class="fas fa-cat"></i>
                    <span>Pet</span>
                </a>
                <a href="{{ route('admin.temu-dokter.index') }}" class="menu-item {{ request()->routeIs('admin.temu-dokter.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>Temu Dokter</span>
                </a>
                <a href="{{ route('admin.rekam-medis.index') }}" class="menu-item {{ request()->routeIs('admin.rekam-medis.*') ? 'active' : '' }}">
                    <i class="fas fa-file-medical"></i>
                    <span>Rekam Medis</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="top-bar-left">
                <h2>@yield('page-title', 'Dashboard')</h2>
            </div>
            <div class="top-bar-right">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h3>{{ Auth::user()->nama }}</h3>
                        <p>Administrator</p>
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