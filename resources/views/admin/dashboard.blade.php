<x-admin-layout>
    <x-slot name="header">
        Tổng quan hệ thống
    </x-slot>

    <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-1000">

        <!-- Hero Banner -->
        <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 p-10 lg:p-12 rounded-[2.5rem] text-white shadow-2xl">
            <div class="relative z-10 max-w-2xl">
                <p class="text-sky-400 text-xs font-black uppercase tracking-widest mb-3">Dashboard Overview</p>
                <h2 class="text-3xl lg:text-4xl font-black mb-3 tracking-tight leading-tight">
                    Chào mừng quay lại, {{ explode(' ', Auth::user()->name)[0] }} 👋
                </h2>
                <p class="text-slate-400 text-base leading-relaxed mb-6">
                    Hệ thống đang hoạt động ổn định.
                    @if($stats['new_users_today'] > 0)
                        Hôm nay có <span class="text-sky-400 font-bold">{{ $stats['new_users_today'] }} người dùng mới</span> đăng ký.
                    @else
                        Chưa có người dùng mới đăng ký hôm nay.
                    @endif
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 bg-white text-slate-900 rounded-2xl font-black text-sm hover:scale-105 transition-transform flex items-center gap-2 shadow-lg">
                        <span class="material-symbols-outlined text-sm">group</span> Quản lý Người dùng
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="px-6 py-2.5 bg-sky-500/20 text-sky-300 border border-sky-500/30 rounded-2xl font-bold text-sm hover:bg-sky-500/30 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">person_add</span> Thêm User
                    </a>
                </div>
            </div>

            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-80 h-80 bg-sky-500/10 rounded-full blur-3xl -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 right-20 w-48 h-48 bg-cyan-500/5 rounded-full blur-3xl -mb-10"></div>
            <span class="material-symbols-outlined absolute right-8 top-1/2 -translate-y-1/2 text-white/[0.03] text-[14rem] font-thin rotate-12 pointer-events-none select-none">monitoring</span>
        </div>

        <!-- Stats Bento Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Users -->
            <div class="glass-card p-6 rounded-[2rem] shadow-sm border border-white/60 transition-all hover:shadow-xl hover:-translate-y-1 group">
                <div class="flex items-center justify-between mb-5">
                    <div class="w-12 h-12 bg-sky-500/10 rounded-2xl flex items-center justify-center text-sky-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">groups</span>
                    </div>
                    @if($stats['new_users_week'] > 0)
                    <div class="text-emerald-600 flex items-center gap-0.5 text-[10px] font-black bg-emerald-500/10 px-2 py-1 rounded-lg uppercase tracking-wider">
                        <span class="material-symbols-outlined text-xs">trending_up</span>
                        +{{ $stats['new_users_week'] }} tuần
                    </div>
                    @endif
                </div>
                <h3 class="text-3xl font-black text-slate-900 tracking-tighter mb-0.5">{{ number_format($stats['total_users']) }}</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tổng người dùng</p>
            </div>

            <!-- Active Users -->
            <div class="glass-card p-6 rounded-[2rem] shadow-sm border border-white/60 transition-all hover:shadow-xl hover:-translate-y-1 group">
                <div class="flex items-center justify-between mb-5">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">verified_user</span>
                    </div>
                    <div class="flex items-center gap-1 text-[10px] font-black text-emerald-600 bg-emerald-500/10 px-2 py-1 rounded-lg uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Online
                    </div>
                </div>
                <h3 class="text-3xl font-black text-slate-900 tracking-tighter mb-0.5">{{ number_format($stats['active_users']) }}</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Đang hoạt động</p>
            </div>

            <!-- Locked Users -->
            <div class="glass-card p-6 rounded-[2rem] shadow-sm border border-white/60 transition-all hover:shadow-xl hover:-translate-y-1 group">
                <div class="flex items-center justify-between mb-5">
                    <div class="w-12 h-12 bg-rose-500/10 rounded-2xl flex items-center justify-center text-rose-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">lock</span>
                    </div>
                </div>
                <h3 class="text-3xl font-black text-slate-900 tracking-tighter mb-0.5">{{ number_format($stats['locked_users']) }}</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Đã bị khóa</p>
            </div>

            <!-- Total CVs -->
            <div class="glass-card p-6 rounded-[2rem] shadow-sm border border-white/60 transition-all hover:shadow-xl hover:-translate-y-1 group">
                <div class="flex items-center justify-between mb-5">
                    <div class="w-12 h-12 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">description</span>
                    </div>
                </div>
                <h3 class="text-3xl font-black text-slate-900 tracking-tighter mb-0.5">{{ number_format($stats['total_cvs']) }}</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tổng CV</p>
            </div>
        </div>

        <!-- Second Stats Row -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Admin -->
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 p-6 rounded-[2rem] shadow-lg transition-all hover:shadow-2xl hover:-translate-y-1 group">
                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-sky-400 mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-xl">admin_panel_settings</span>
                </div>
                <h3 class="text-2xl font-black text-white tracking-tighter mb-0.5">{{ $stats['admin_count'] }}</h3>
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Quản trị viên</p>
            </div>

            <!-- Employer -->
            <div class="bg-gradient-to-br from-sky-500 to-cyan-500 p-6 rounded-[2rem] shadow-lg shadow-sky-500/20 transition-all hover:shadow-2xl hover:-translate-y-1 group">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-white mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-xl">business</span>
                </div>
                <h3 class="text-2xl font-black text-white tracking-tighter mb-0.5">{{ $stats['employer_count'] }}</h3>
                <p class="text-[10px] font-bold text-white/60 uppercase tracking-widest">Nhà tuyển dụng</p>
            </div>

            <!-- Candidate -->
            <div class="bg-gradient-to-br from-emerald-500 to-teal-500 p-6 rounded-[2rem] shadow-lg shadow-emerald-500/20 transition-all hover:shadow-2xl hover:-translate-y-1 group">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-white mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-xl">person_search</span>
                </div>
                <h3 class="text-2xl font-black text-white tracking-tighter mb-0.5">{{ $stats['candidate_count'] }}</h3>
                <p class="text-[10px] font-bold text-white/60 uppercase tracking-widest">Ứng viên</p>
            </div>

            <!-- Total Analyses -->
            <div class="bg-gradient-to-br from-amber-500 to-orange-500 p-6 rounded-[2rem] shadow-lg shadow-amber-500/20 transition-all hover:shadow-2xl hover:-translate-y-1 group">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-white mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-xl">analytics</span>
                </div>
                <h3 class="text-2xl font-black text-white tracking-tighter mb-0.5">{{ $stats['total_analyses'] }}</h3>
                <p class="text-[10px] font-bold text-white/60 uppercase tracking-widest">Lượt phân tích AI</p>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Registration Chart -->
            <div class="col-span-12 lg:col-span-8 glass-card rounded-[2.5rem] p-8 border border-white/60">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h4 class="text-xl font-black text-slate-900 tracking-tight">Đăng ký mới</h4>
                        <p class="text-xs text-slate-400 font-medium mt-1">7 ngày gần nhất</p>
                    </div>
                    <div class="flex items-center gap-2 bg-sky-50 text-sky-600 px-3 py-1.5 rounded-xl">
                        <span class="material-symbols-outlined text-sm">calendar_month</span>
                        <span class="text-xs font-bold">{{ $stats['new_users_week'] }} user mới</span>
                    </div>
                </div>

                <!-- Simple Bar Chart -->
                <div class="flex items-end justify-between gap-3 h-48 px-2">
                    @php $maxCount = max(array_column($usersByDay, 'count'), 1); @endphp
                    @foreach($usersByDay as $day)
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <span class="text-xs font-black text-slate-600">{{ $day['count'] }}</span>
                        <div class="w-full rounded-2xl transition-all hover:opacity-80 relative group"
                             style="height: {{ max(($day['count'] / $maxCount) * 100, 6) }}%;
                                    background: linear-gradient(180deg, #38bdf8 0%, #0ea5e9 100%);
                                    min-height: 12px;">
                            <div class="absolute inset-0 rounded-2xl bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $day['label'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Info Panel -->
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <!-- System Status -->
                <div class="glass-card rounded-[2rem] p-7 border border-white/60">
                    <h4 class="text-lg font-black text-slate-900 tracking-tight mb-5">Trạng thái hệ thống</h4>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-emerald-500/10 rounded-xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-emerald-500 text-sm">database</span>
                                </div>
                                <span class="text-sm font-bold text-slate-700">Database</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-wider">Online</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-emerald-500/10 rounded-xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-emerald-500 text-sm">dns</span>
                                </div>
                                <span class="text-sm font-bold text-slate-700">Server</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-wider">Online</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-sky-500/10 rounded-xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-sky-500 text-sm">smart_toy</span>
                                </div>
                                <span class="text-sm font-bold text-slate-700">AI Engine</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-wider">Ready</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Role Distribution -->
                <div class="glass-card rounded-[2rem] p-7 border border-white/60">
                    <h4 class="text-lg font-black text-slate-900 tracking-tight mb-5">Phân bổ vai trò</h4>
                    <div class="space-y-3">
                        @php
                            $total = max($stats['total_users'], 1);
                            $adminPct = round($stats['admin_count'] / $total * 100);
                            $employerPct = round($stats['employer_count'] / $total * 100);
                            $candidatePct = round($stats['candidate_count'] / $total * 100);
                        @endphp

                        <div>
                            <div class="flex justify-between items-center mb-1.5">
                                <span class="text-xs font-bold text-slate-600">Admin</span>
                                <span class="text-[10px] font-black text-slate-400">{{ $adminPct }}%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-slate-700 to-slate-500 rounded-full transition-all duration-1000" style="width: {{ $adminPct }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-1.5">
                                <span class="text-xs font-bold text-slate-600">Nhà tuyển dụng</span>
                                <span class="text-[10px] font-black text-slate-400">{{ $employerPct }}%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-sky-500 to-cyan-400 rounded-full transition-all duration-1000" style="width: {{ $employerPct }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-1.5">
                                <span class="text-xs font-bold text-slate-600">Ứng viên</span>
                                <span class="text-[10px] font-black text-slate-400">{{ $candidatePct }}%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-400 rounded-full transition-all duration-1000" style="width: {{ $candidatePct }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Users Table -->
        <div class="glass-card rounded-[2.5rem] p-2 border border-white/60 overflow-hidden">
            <div class="p-8 flex items-center justify-between">
                <div>
                    <h4 class="text-xl font-black text-slate-900 tracking-tight">Thành viên mới nhất</h4>
                    <p class="text-xs text-slate-400 font-medium mt-1">{{ $recentUsers->count() }} người dùng gần đây</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-1.5 text-sm font-bold text-sky-500 hover:text-sky-600 transition-colors">
                    Xem tất cả <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b border-slate-100">
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Người dùng</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Vai trò</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Trạng thái</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Ngày tham gia</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($recentUsers as $user)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center font-black text-sm text-slate-400 group-hover:from-sky-50 group-hover:to-sky-100 group-hover:text-sky-500 transition-all">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 text-sm leading-tight">{{ $user->name }}</p>
                                        <p class="text-[11px] text-slate-400 font-medium">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-4">
                                @php
                                    $roleColors = [
                                        'admin'     => 'bg-slate-800 text-white',
                                        'employer'  => 'bg-sky-500/10 text-sky-600',
                                        'candidate' => 'bg-emerald-500/10 text-emerald-600',
                                    ];
                                    $roleLabels = [
                                        'admin'     => 'Admin',
                                        'employer'  => 'NTD',
                                        'candidate' => 'Ứng viên',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider {{ $roleColors[$user->role] ?? 'bg-slate-100 text-slate-500' }}">
                                    {{ $roleLabels[$user->role] ?? $user->role }}
                                </span>
                            </td>
                            <td class="px-8 py-4">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1 text-[10px] font-black text-emerald-600 uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Hoạt động
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[10px] font-black text-rose-600 uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span> Bị khóa
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-4">
                                <p class="text-xs font-bold text-slate-600">{{ $user->created_at->translatedFormat('d M, Y') }}</p>
                                <p class="text-[10px] text-slate-400 font-bold">{{ $user->created_at->diffForHumans() }}</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Platform Summary -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <div class="glass-card rounded-[2rem] p-7 border border-white/60 flex items-center gap-5 group hover:shadow-xl transition-all">
                <div class="w-14 h-14 bg-sky-500/10 rounded-2xl flex items-center justify-center text-sky-600 group-hover:scale-110 transition-transform flex-shrink-0">
                    <span class="material-symbols-outlined text-3xl">description</span>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tighter">{{ number_format($stats['total_cvs']) }}</h3>
                    <p class="text-xs font-bold text-slate-400">CV đã tạo trên hệ thống</p>
                </div>
            </div>

            <div class="glass-card rounded-[2rem] p-7 border border-white/60 flex items-center gap-5 group hover:shadow-xl transition-all">
                <div class="w-14 h-14 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform flex-shrink-0">
                    <span class="material-symbols-outlined text-3xl">work</span>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tighter">{{ number_format($stats['total_jds']) }}</h3>
                    <p class="text-xs font-bold text-slate-400">Mô tả công việc (JD)</p>
                </div>
            </div>

            <div class="glass-card rounded-[2rem] p-7 border border-white/60 flex items-center gap-5 group hover:shadow-xl transition-all">
                <div class="w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform flex-shrink-0">
                    <span class="material-symbols-outlined text-3xl">auto_awesome</span>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tighter">{{ number_format($stats['total_analyses']) }}</h3>
                    <p class="text-xs font-bold text-slate-400">Lượt phân tích AI</p>
                </div>
            </div>
        </div>

    </div>

</x-admin-layout>
