<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Career Tailor') }}</title>

        <!-- Styles / Scripts -->
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
    <body class="font-sans antialiased bg-surface text-on-surface selection:bg-primary/10">
        <div class="min-h-screen">
            <!-- Sidebar Navigation -->
            @include('layouts.sidebar')

            <!-- Top Application Bar -->
            @include('layouts.topnav')

            <!-- Main Content Canvas -->
            <main class="pl-64 pt-16 min-h-screen">
                <div class="p-8 max-w-7xl mx-auto">
                    <!-- Heading Section (Optional) -->
                    @if (isset($header))
                        <div class="mb-8">
                            {{ $header }}
                        </div>
                    @endif

                    <!-- Page Content -->
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!-- Optional: Floating Action Button (Global or per-page) -->
        @stack('fab')
    </body>
</html>
