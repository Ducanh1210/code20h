<x-admin-layout>
    <x-slot name="header">
        Tổng quan hệ thống
    </x-slot>

    <div class="space-y-10 animate-in fade-in slide-in-from-bottom-4 duration-1000">
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800 p-12 rounded-[3rem] text-white shadow-2xl">
            <div class="relative z-10 max-w-2xl">
                <h2 class="text-4xl font-black mb-4 tracking-tight">Chào mừng quay lại, Admin 👋</h2>
                <p class="text-slate-400 text-lg leading-relaxed mb-8">
                    Hệ thống đang hoạt động ổn định. Bạn có <span class="text-sky-400 font-bold">{{ $stats['new_users_today'] }} người dùng mới</span> đăng ký trong hôm nay.
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('admin.users.index') }}" class="px-8 py-3 bg-white text-slate-900 rounded-2xl font-black text-sm hover:scale-105 transition-transform flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">group</span> Quản lý Người dùng
                    </a>
                    <a href="{{ route('admin.jobs.index') }}" class="px-8 py-3 bg-sky-400 text-white rounded-2xl font-black text-sm hover:scale-105 transition-transform flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">work</span> Quản lý JD
                    </a>
                </div>
            </div>
            
            <!-- Abstract shapes for premium look -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-purple-500/5 rounded-full blur-3xl mr-20 -mb-20"></div>
            <span class="material-symbols-outlined absolute right-12 top-1/2 -translate-y-1/2 text-white/5 text-[15rem] font-thin rotate-12 pointer-events-none">monitoring</span>
        </div>

        <!-- Quick Stats Bento Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Total Users -->
            <div class="glass-card p-8 rounded-[2.5rem] shadow-sm border border-white transition-all hover:shadow-2xl group">
                <div class="w-14 h-14 bg-sky-500/10 rounded-2xl flex items-center justify-center text-sky-600 mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">groups</span>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tổng thành viên</p>
                        <h3 class="text-4xl font-black text-slate-900 tracking-tighter">{{ number_format($stats['total_users']) }}</h3>
                    </div>
                    <div class="text-emerald-500 flex items-center gap-1 text-xs font-bold bg-emerald-500/10 px-2 py-1 rounded-lg">
                        <span class="material-symbols-outlined text-sm">trending_up</span> +12%
                    </div>
                </div>
            </div>

            <!-- Total CVs -->
            <div class="glass-card p-8 rounded-[2.5rem] shadow-sm border border-white transition-all hover:shadow-2xl group">
                <div class="w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-600 mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">description</span>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">CV trên hệ thống</p>
                        <h3 class="text-4xl font-black text-slate-900 tracking-tighter">{{ number_format($stats['total_cvs']) }}</h3>
                    </div>
                    <div class="text-sky-500 flex items-center gap-1 text-xs font-bold bg-sky-500/10 px-2 py-1 rounded-lg">
                        <span class="material-symbols-outlined text-sm">auto_awesome</span> AI Ready
                    </div>
                </div>
            </div>

            <!-- Servers/System -->
            <div class="glass-card p-8 rounded-[2.5rem] shadow-sm border border-white transition-all hover:shadow-2xl group">
                <div class="w-14 h-14 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-600 mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">database</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Trạng thái Database</p>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                        <h3 class="text-xl font-bold text-slate-900 tracking-tight">Đang kết nối</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Placeholder -->
        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 lg:col-span-8 glass-card rounded-[2.5rem] p-10 border border-white">
                <div class="flex justify-between items-center mb-8">
                    <h4 class="text-2xl font-black text-slate-900 tracking-tight">Hoạt động mới nhất</h4>
                    <button class="text-sky-500 font-bold text-sm hover:underline">Chi tiết</button>
                </div>
                
                <div class="space-y-6">
                    <div class="flex items-center gap-4 py-4 border-b border-slate-50 last:border-none">
                        <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 font-bold">A</div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-slate-900">Admin đã cập nhật vai trò cho người dùng <span class="text-sky-500">duc.anh@gmail.com</span></p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">2 giờ trước</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 py-4 border-b border-slate-50 last:border-none">
                        <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 font-bold">C</div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-slate-900">Người dùng mới <span class="text-sky-500">tuan.nt@gmail.com</span> đã đăng ký ứng tuyển.</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">5 giờ trước</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-4 space-y-8">
                <div class="bg-sky-500 p-8 rounded-[2.5rem] text-white shadow-xl shadow-sky-500/20">
                    <h4 class="text-xl font-black mb-4">Ghi chú nhanh</h4>
                    <textarea class="w-full bg-white/10 border-none rounded-2xl text-white placeholder:text-white/40 text-sm focus:ring-white/20 h-40 resize-none font-medium" placeholder="Nhập ghi chú tại đây..."></textarea>
                    <button class="w-full mt-4 py-3 bg-white text-sky-500 rounded-2xl font-black text-sm hover:bg-sky-50 transition-colors">Lưu ghi chú</button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
