<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AI Career Tailor') }} - Optimize Your Resume</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        indigo: {
                            50: '#f5f7ff',
                            100: '#ebf0fe',
                            200: '#ced9fd',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        [x-cloak] { display: none !important; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
        .hero-gradient { background: radial-gradient(circle at top right, #e0e7ff 0%, #f8fafc 50%); }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-900 selection:bg-indigo-100 selection:text-indigo-700">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="font-heading font-bold text-xl tracking-tight text-slate-900">AI Career Tailor</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-600">
                    <a href="#features" class="hover:text-indigo-600 transition-colors">Tính năng</a>
                    <a href="#how-it-works" class="hover:text-indigo-600 transition-colors">Cách hoạt động</a>
                    <a href="#" class="hover:text-indigo-600 transition-colors">CV Templates</a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <!-- Group of Action Icons -->
                        <div class="hidden sm:flex items-center gap-2">
                            <button class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition-colors relative">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 border-2 border-white rounded-full"></span>
                            </button>
                            <button class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            </button>
                        </div>
                        
                        <!-- User Dropdown (Tailwind block hover) -->
                        <div class="relative group cursor-pointer pt-2 pb-2">
                            <div class="flex items-center gap-1.5 focus:outline-none">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=e2e8f0&color=475569" alt="Avatar" class="w-10 h-10 rounded-full border border-slate-200 shadow-sm object-cover">
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>

                            <!-- Dropdown Menu Layer -->
                            <div class="absolute right-0 top-full mt-0 w-80 bg-white rounded-2xl shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
                                <!-- User Info -->
                                <div class="p-4 border-b border-slate-100 flex items-center gap-4 bg-slate-50/50 rounded-t-2xl">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=e2e8f0&color=475569" alt="Avatar" class="w-14 h-14 rounded-full border-2 border-white shadow-sm">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->name }}</h4>
                                        <p class="text-[10px] uppercase font-bold text-emerald-600 bg-emerald-100/50 inline-block px-2 py-0.5 rounded-full mt-1 border border-emerald-200/50">Tài khoản đã xác thực</p>
                                        <p class="text-[11px] text-slate-500 truncate mt-1">ID {{ Auth::user()->id }} | {{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                
                                <!-- Links Section -->
                                <div class="p-2 space-y-1 bg-white">
                                    <!-- Tiện ích chức năng -->
                                    <div class="px-3 py-2">
                                        <h5 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> Quản lý tìm việc
                                        </h5>
                                        <div class="space-y-1">
                                            <a href="#" class="block px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition-colors">Việc làm đã lưu</a>
                                            <a href="#" class="block px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition-colors">Việc làm phù hợp với bạn</a>
                                        </div>
                                    </div>
                                    <div class="px-3 py-2 border-t border-slate-50">
                                        <h5 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg> Quản lý CV / Hồ sơ
                                        </h5>
                                        <div class="space-y-1">
                                            <a href="#" class="block px-3 py-1.5 text-sm font-medium text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">CV của tôi</a>
                                            <a href="#" class="block px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition-colors">Đề xuất lộ trình & Học tập</a>
                                        </div>
                                    </div>
                                    
                                    <div class="border-t border-slate-50 mt-1">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full text-left px-5 py-3 text-sm font-bold text-red-600 hover:bg-red-50 rounded-b-2xl transition-colors flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg> Đăng xuất tài khoản
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition-all shadow-sm hover:shadow">
                            Bắt đầu ngay
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-slate-200 rounded flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="font-heading font-semibold text-lg text-slate-900">AI Career Tailor</span>
                </div>
                <div class="flex space-x-6 text-sm text-slate-500">
                    <a href="#" class="hover:text-slate-900">Điều khoản</a>
                    <a href="#" class="hover:text-slate-900">Bảo mật</a>
                    <a href="#" class="hover:text-slate-900">Liên hệ</a>
                </div>
                <p class="text-sm text-slate-400">© 2026 AI Career Tailor. Built for your success.</p>
            </div>
        </div>
    </footer>
</body>
</html>
