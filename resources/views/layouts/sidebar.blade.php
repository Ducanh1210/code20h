<aside class="fixed left-0 top-0 h-full flex flex-col bg-surface dark:bg-slate-950 h-screen w-64 border-r-0 z-50">
    <div class="p-6 flex flex-col gap-1">
        <h1 class="text-xl font-bold tracking-tight text-primary dark:text-white">Career Tailor</h1>
        <p class="text-[10px] text-slate-500 font-bold tracking-widest uppercase">AI Assistant</p>
    </div>
    <nav class="flex-1 mt-4 space-y-1">
        <!-- Dashboard / Overview -->
        <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-primary text-white scale-95 shadow-lg shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-200/50' }} rounded-xl mx-2 duration-150 transition-all font-medium" 
           href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span>Tổng quan</span>
        </a>

        <!-- CV Management -->
        <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('client.cv-management') ? 'bg-primary text-white scale-95 shadow-lg shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-200/50' }} rounded-xl mx-2 duration-150 transition-all font-medium" 
           href="{{ route('client.cv-management') }}">
            <span class="material-symbols-outlined">description</span>
            <span>Hồ sơ của tôi</span>
        </a>

        <!-- Jobs -->
        <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('client.jobs') ? 'bg-primary text-white scale-95 shadow-lg shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-200/50' }} rounded-xl mx-2 duration-150 transition-all font-medium" 
           href="{{ route('client.jobs') }}">
            <span class="material-symbols-outlined">work</span>
            <span>Danh sách JD</span>
        </a>

        <!-- AI Analysis -->
        <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('client.ai-analysis') ? 'bg-primary text-white scale-95 shadow-lg shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-200/50' }} rounded-xl mx-2 duration-150 transition-all font-medium" 
           href="{{ route('client.ai-analysis') }}">
            <span class="material-symbols-outlined">psychology</span>
            <span>Phân tích AI</span>
        </a>

        <!-- Learning Path -->
        <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('client.roadmap') ? 'bg-primary text-white scale-95 shadow-lg shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-200/50' }} rounded-xl mx-2 duration-150 transition-all font-medium" 
           href="{{ route('client.roadmap') }}">
            <span class="material-symbols-outlined">model_training</span>
            <span>Lộ trình học</span>
        </a>
    </nav>

    <div class="p-4">
        <button class="w-full py-3 bg-gradient-to-br from-primary to-primary-container text-white rounded-full font-bold shadow-lg shadow-primary/20 hover:brightness-110 transition-all flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span>
            Tạo CV mới
        </button>
    </div>

    <div class="mt-auto border-t border-slate-200/50 p-2 space-y-1">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-error dark:text-error hover:bg-error-container/20 transition-colors mx-2 rounded-xl">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-medium">Đăng xuất</span>
                </button>
            </form>
            
            <div class="flex items-center gap-3 px-4 py-4 mt-2 bg-surface-container-low rounded-xl mx-2">
                <img alt="User Avatar" class="w-10 h-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF" />
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-primary truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500 font-bold uppercase truncate">Premium Member</p>
                </div>
            </div>
        @else
            <div class="px-4 py-4 mt-2 bg-surface-container-low rounded-xl mx-2 text-center">
                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mb-3">Tham gia Career Tailor</p>
                <div class="space-y-2">
                    <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 py-2.5 bg-primary text-white rounded-xl text-[10px] font-extrabold uppercase tracking-widest hover:brightness-110 transition-all shadow-md shadow-primary/20">
                        <span class="material-symbols-outlined text-xs">login</span>
                        Đăng nhập
                    </a>
                    <a href="{{ route('register') }}" class="w-full flex items-center justify-center gap-2 py-2.5 bg-white border border-slate-200 text-primary rounded-xl text-[10px] font-extrabold uppercase tracking-widest hover:bg-slate-50 transition-all">
                        Đăng ký
                    </a>
                </div>
            </div>
        @endauth
    </div>
</aside>
