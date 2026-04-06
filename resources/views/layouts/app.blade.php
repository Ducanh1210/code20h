<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CODE20H') }} | Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

        <!-- Bootstrap (CDN) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; height: 100vh; overflow: hidden; }
            .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }

            /* Sidebar */
            .admin-sidebar {
                width: 280px;
                min-height: 100vh;
                background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
                transition: all 0.3s ease;
                position: fixed;
                left: 0;
                top: 0;
                z-index: 40;
            }
            .admin-sidebar .sidebar-brand {
                padding: 28px 24px;
                border-bottom: 1px solid rgba(255,255,255,0.06);
            }
            .admin-sidebar .sidebar-brand h1 {
                font-size: 18px;
                font-weight: 700;
                color: #fff;
                letter-spacing: -0.5px;
                margin: 0;
            }
            .admin-sidebar .sidebar-brand span {
                font-size: 11px;
                color: #64748b;
                font-weight: 500;
                letter-spacing: 1px;
                text-transform: uppercase;
            }
            .admin-sidebar .nav-section {
                padding: 20px 16px 8px;
            }
            .admin-sidebar .nav-section-title {
                font-size: 10px;
                font-weight: 700;
                color: #475569;
                letter-spacing: 1.5px;
                text-transform: uppercase;
                padding: 0 12px;
                margin-bottom: 8px;
            }
            .admin-sidebar .nav-item {
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 12px 16px;
                margin: 2px 0;
                border-radius: 10px;
                color: #94a3b8;
                text-decoration: none;
                font-size: 14px;
                font-weight: 500;
                transition: all 0.2s ease;
            }
            .admin-sidebar .nav-item:hover {
                color: #e2e8f0;
                background: rgba(255,255,255,0.05);
            }
            .admin-sidebar .nav-item.active {
                color: #fff;
                background: rgba(79, 70, 229, 0.15);
                border: 1px solid rgba(79, 70, 229, 0.2);
            }
            .admin-sidebar .nav-item.active .material-symbols-outlined {
                color: #6366f1;
            }
            .admin-sidebar .nav-item .material-symbols-outlined {
                font-size: 20px;
            }

            /* Main content */
            .admin-main {
                margin-left: 280px;
                height: 100vh;
                display: flex;
                flex-direction: column;
                background: #f8fafc;
            }

            /* Top bar */
            .admin-topbar {
                background: #fff;
                border-bottom: 1px solid #e2e8f0;
                padding: 0 32px;
                height: 64px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-shrink: 0;
                z-index: 30;
            }
            .admin-topbar .page-title {
                font-size: 16px;
                font-weight: 600;
                color: #1e293b;
            }

            /* User dropdown */
            .user-dropdown {
                position: relative;
            }
            .user-dropdown-btn {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 6px 12px;
                border-radius: 10px;
                border: none;
                background: transparent;
                cursor: pointer;
                transition: all 0.2s;
            }
            .user-dropdown-btn:hover {
                background: #f1f5f9;
            }
            .user-avatar {
                width: 36px;
                height: 36px;
                border-radius: 10px;
                background: linear-gradient(135deg, #4f46e5, #7c3aed);
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-weight: 700;
                font-size: 14px;
            }
            .user-dropdown-menu {
                position: absolute;
                right: 0;
                top: 100%;
                margin-top: 8px;
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
                padding: 6px;
                min-width: 200px;
                display: none;
                z-index: 50;
            }
            .user-dropdown:hover .user-dropdown-menu {
                display: block;
            }
            .user-dropdown-menu a,
            .user-dropdown-menu button {
                display: flex;
                align-items: center;
                gap: 10px;
                width: 100%;
                padding: 10px 14px;
                border: none;
                background: transparent;
                color: #475569;
                font-size: 13px;
                font-weight: 500;
                text-decoration: none;
                border-radius: 8px;
                transition: all 0.15s;
                cursor: pointer;
                text-align: left;
            }
            .user-dropdown-menu a:hover,
            .user-dropdown-menu button:hover {
                background: #f1f5f9;
                color: #1e293b;
            }
            .user-dropdown-menu .text-danger:hover {
                background: #fef2f2;
                color: #dc2626;
            }

            /* Scrollbar */
            .main-content-scroll {
                flex: 1;
                overflow-y: auto;
                padding: 32px;
            }
            .main-content-scroll::-webkit-scrollbar {
                width: 6px;
            }
            .main-content-scroll::-webkit-scrollbar-track {
                background: #f1f5f9;
            }
            .main-content-scroll::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 10px;
            }
            .main-content-scroll::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
        </style>
    </head>
    <body class="antialiased">

        <!-- Sidebar -->
        @include('layouts.navigation')

        <!-- Main Content -->
        <div class="admin-main">
            <!-- Top Bar -->
            <div class="admin-topbar">
                <div class="page-title">
                    @if (isset($header))
                        {{ $header }}
                    @endif
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="user-dropdown">
                        <button class="user-dropdown-btn">
                            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                            <div style="text-align:left">
                                <div style="font-size:13px;font-weight:600;color:#1e293b">{{ Auth::user()->name }}</div>
                                <div style="font-size:11px;color:#94a3b8">{{ Auth::user()->role === 'admin' ? 'Quản trị viên' : 'Thành viên' }}</div>
                            </div>
                            <span class="material-symbols-outlined" style="font-size:18px;color:#94a3b8">expand_more</span>
                        </button>
                        <div class="user-dropdown-menu">
                            <a href="{{ route('profile.edit') }}">
                                <span class="material-symbols-outlined" style="font-size:18px">person</span>
                                Hồ sơ cá nhân
                            </a>
                            <a href="{{ url('/') }}">
                                <span class="material-symbols-outlined" style="font-size:18px">storefront</span>
                                Về trang chủ
                            </a>
                            <hr style="margin:4px 0;border-color:#e2e8f0">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-danger">
                                    <span class="material-symbols-outlined" style="font-size:18px">logout</span>
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="main-content-scroll">
                <div class="container-fluid p-0">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
