<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Admin Panel') }} - Quản trị hệ thống</title>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Custom Styling for Admin -->
        <style>
            .admin-sidebar {
                background: linear-gradient(180deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.98) 100%);
                backdrop-filter: blur(12px);
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(8px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .sidebar-link-active {
                background: linear-gradient(90deg, rgba(56, 189, 248, 0.1) 0%, rgba(56, 189, 248, 0.05) 100%);
                border-left: 4px solid #38bdf8;
                color: #38bdf8 !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#f8fafc] text-slate-900 border-box">
        <div class="flex min-h-screen overflow-hidden">
            <!-- Sidebar -->
            <aside class="admin-sidebar flex-shrink-0 text-slate-300 flex flex-col fixed h-full z-50" style="width: 280px;">
                <!-- Logo -->
                <div class="px-8 py-8 flex items-center gap-3">
                    <div class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center shadow-lg shadow-sky-500/30">
                        <span class="material-symbols-outlined text-white text-2xl">shield_person</span>
                    </div>
                    <div>
                        <h1 class="text-white font-black text-xl tracking-tight leading-none">ADMIN</h1>
                        <p class="text-[10px] text-sky-400 font-bold uppercase tracking-[0.2em]">Management</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 space-y-2 overflow-y-auto py-4 no-scrollbar">
                    <div class="px-4 mb-4">
                        <p class="text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Hệ thống</p>
                    </div>
                    
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : 'hover:bg-white/5' }}">
                        <span class="material-symbols-outlined {{ request()->routeIs('admin.dashboard') ? 'text-sky-400' : 'text-slate-400 group-hover:text-white' }}">dashboard</span>
                        <span class="font-bold text-sm">Tổng quan</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('admin.users.*') ? 'sidebar-link-active' : 'hover:bg-white/5' }}">
                        <span class="material-symbols-outlined {{ request()->routeIs('admin.users.*') ? 'text-sky-400' : 'text-slate-400 group-hover:text-white' }}">group</span>
                        <span class="font-bold text-sm">Quản lý User</span>
                    </a>

                    <div class="px-4 mt-8 mb-4">
                        <p class="text-[10px] font-extrabold text-slate-500 uppercase tracking-widest">Nội dung</p>
                    </div>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all group">
                        <span class="material-symbols-outlined text-slate-400 group-hover:text-white">description</span>
                        <span class="font-bold text-sm">Quản lý CV</span>
                    </a>

                    <a href="{{ route('admin.jobs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('admin.jobs.*') ? 'sidebar-link-active' : 'hover:bg-white/5' }}">
                        <span class="material-symbols-outlined {{ request()->routeIs('admin.jobs.*') ? 'text-sky-400' : 'text-slate-400 group-hover:text-white' }}">work</span>
                        <span class="font-bold text-sm">Quản lý Job</span>
                    </a>
                </nav>

                <!-- Footer Sidebar -->
                <div class="p-6 border-t border-white/5">
                    <div class="bg-white/5 p-4 rounded-2xl flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center font-bold text-sky-400 border border-white/10">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-500 font-bold uppercase truncate">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full py-3 bg-red-500/10 hover:bg-red-500/20 text-red-500 rounded-xl font-bold text-xs transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">logout</span> Đăng xuất
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 min-h-screen relative overflow-y-auto" style="margin-left: 280px;">
                <!-- Topbar -->
                <header class="h-20 flex items-center justify-between px-10 sticky top-0 bg-[#f8fafc]/80 backdrop-blur-md z-40">
                    <div class="flex items-center gap-2">
                        <span class="text-slate-400 text-sm">Admin / </span>
                        <span class="text-slate-900 text-sm font-bold">{{ $header ?? '' }}</span>
                    </div>

                    <div class="flex items-center gap-4">
                        <button class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:border-slate-300 transition-all">
                            <span class="material-symbols-outlined text-xl">notifications</span>
                        </button>
                        <button class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:border-slate-300 transition-all">
                            <span class="material-symbols-outlined text-xl">search</span>
                        </button>
                    </div>
                </header>

                <!-- Page Content -->
                <div class="px-10 py-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        @stack('scripts')
    </body>
</html>
