<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-sky-500">work</span>
            <span>Quản lý Job Description</span>
        </div>
    </x-slot>

    <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="glass-card p-6 rounded-[2rem] shadow-sm border border-slate-200/60 transition-all hover:shadow-xl hover:scale-[1.02]">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-sky-500/10 rounded-2xl flex items-center justify-center text-sky-600">
                        <span class="material-symbols-outlined">work</span>
                    </div>
                </div>
                <h4 class="text-3xl font-black text-slate-900 mb-1">{{ $jobs->total() }}</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tổng JD</p>
            </div>

            <div class="glass-card p-6 rounded-[2rem] shadow-sm border border-slate-200/60 transition-all hover:shadow-xl hover:scale-[1.02]">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-600">
                        <span class="material-symbols-outlined">category</span>
                    </div>
                </div>
                <h4 class="text-3xl font-black text-slate-900 mb-1">{{ $domains->count() }}</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Lĩnh vực</p>
            </div>

            <div class="glass-card p-6 rounded-[2rem] shadow-sm border border-slate-200/60 transition-all hover:shadow-xl hover:scale-[1.02]">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-600">
                        <span class="material-symbols-outlined">business</span>
                    </div>
                </div>
                <h4 class="text-3xl font-black text-slate-900 mb-1">{{ $employers->count() }}</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nhà tuyển dụng</p>
            </div>

            <div class="glass-card p-6 rounded-[2rem] shadow-sm border border-slate-200/60 transition-all hover:shadow-xl hover:scale-[1.02]">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-rose-500/10 rounded-2xl flex items-center justify-center text-rose-600">
                        <span class="material-symbols-outlined">today</span>
                    </div>
                </div>
                <h4 class="text-3xl font-black text-slate-900 mb-1">{{ \App\Models\JobDescription::whereDate('created_at', today())->count() }}</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">JD hôm nay</p>
            </div>
        </div>

        <!-- Filter & Search Bar -->
        <div class="glass-card rounded-[2rem] shadow-sm border border-white p-6">
            <form method="GET" action="{{ route('admin.jobs.index') }}" class="flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-[200px] space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Tìm kiếm</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-sky-500 transition-colors">search</span>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            class="w-full pl-12 pr-6 py-3 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-sm text-slate-900 placeholder:text-slate-300"
                            placeholder="Tìm theo tiêu đề, mô tả, lĩnh vực...">
                    </div>
                </div>

                <div class="min-w-[180px] space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Lĩnh vực</label>
                    <div class="relative group">
                        <select name="domain" class="w-full px-4 py-3 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-sm text-slate-900 appearance-none">
                            <option value="">Tất cả lĩnh vực</option>
                            @foreach($domains as $domain)
                                <option value="{{ $domain }}" {{ request('domain') == $domain ? 'selected' : '' }}>{{ $domain }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-lg">expand_more</span>
                    </div>
                </div>

                <div class="min-w-[180px] space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Người đăng</label>
                    <div class="relative group">
                        <select name="employer_id" class="w-full px-4 py-3 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-sm text-slate-900 appearance-none">
                            <option value="">Tất cả</option>
                            @foreach($employers as $emp)
                                <option value="{{ $emp->id }}" {{ request('employer_id') == $emp->id ? 'selected' : '' }}>{{ $emp->name }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-lg">expand_more</span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="px-6 py-3 bg-sky-500 hover:bg-sky-600 text-white rounded-2xl font-bold text-sm shadow-lg shadow-sky-500/25 transition-all active:scale-95 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">filter_alt</span> Lọc
                    </button>
                    @if(request()->hasAny(['search', 'domain', 'employer_id']))
                        <a href="{{ route('admin.jobs.index') }}" class="px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl font-bold text-sm transition-all active:scale-95 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">close</span> Xóa lọc
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Main Table Area -->
        <div class="glass-card rounded-[2.5rem] shadow-sm border border-white overflow-hidden p-2">
            <div class="p-8 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Danh sách Job Description</h3>
                    <p class="text-xs text-slate-400 font-medium">Quản lý và cập nhật mô tả công việc trên hệ thống.</p>
                </div>
                <a href="{{ route('admin.jobs.create') }}" class="flex items-center gap-2 px-6 py-3 bg-sky-500 hover:bg-sky-600 text-white rounded-2xl font-bold text-sm shadow-lg shadow-sky-500/25 transition-all active:scale-95">
                    <span class="material-symbols-outlined">add_circle</span>
                    Thêm JD mới
                </a>
            </div>

            @if($jobs->isEmpty())
                <div class="px-8 py-20 text-center">
                    <div class="w-20 h-20 mx-auto bg-slate-100 rounded-3xl flex items-center justify-center text-slate-300 mb-6">
                        <span class="material-symbols-outlined text-4xl">work_off</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-400 mb-2">Chưa có Job Description nào</h4>
                    <p class="text-sm text-slate-300">Nhấn "Thêm JD mới" để bắt đầu tạo mô tả công việc.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b border-slate-100">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tiêu đề</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Lĩnh vực</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Người đăng</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Yêu cầu</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Ngày tạo</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($jobs as $job)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-sky-50 to-sky-100 flex items-center justify-center text-sky-500 border border-white group-hover:from-sky-100 transition-all">
                                            <span class="material-symbols-outlined">work</span>
                                        </div>
                                        <div class="max-w-[220px]">
                                            <p class="font-bold text-slate-900 text-sm leading-tight truncate">{{ $job->title }}</p>
                                            <p class="text-[11px] text-slate-400 font-medium truncate">{{ Str::limit($job->description, 50) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    @if($job->domain)
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-500/10 text-emerald-600">
                                            {{ $job->domain }}
                                        </span>
                                    @else
                                        <span class="text-slate-300 text-xs">—</span>
                                    @endif
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center font-bold text-slate-400 text-xs">
                                            {{ substr($job->employer->name ?? '?', 0, 1) }}
                                        </div>
                                        <span class="text-xs font-bold text-slate-600">{{ $job->employer->name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    @if($job->requirements && is_array($job->requirements))
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black bg-amber-500/10 text-amber-600">
                                            {{ count($job->requirements) }} yêu cầu
                                        </span>
                                    @else
                                        <span class="text-slate-300 text-xs">—</span>
                                    @endif
                                </td>
                                <td class="px-8 py-5">
                                    <p class="text-xs font-bold text-slate-600 capitalize tracking-tight">
                                        {{ $job->created_at->translatedFormat('d M, Y') }}
                                    </p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                        {{ $job->created_at->diffForHumans() }}
                                    </p>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.jobs.show', $job) }}" class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all shadow-sm" title="Xem chi tiết">
                                            <span class="material-symbols-outlined text-lg">visibility</span>
                                        </a>
                                        <a href="{{ route('admin.jobs.edit', $job) }}" class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center hover:bg-sky-500 hover:text-white transition-all shadow-sm" title="Chỉnh sửa">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa JD này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all shadow-sm" title="Xóa">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-8 py-6 border-t border-slate-100">
                    {{ $jobs->links() }}
                </div>
            @endif
        </div>
    </div>

    @if(session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-8 right-8 bg-sky-500 text-white px-6 py-4 rounded-3xl shadow-2xl flex items-center gap-3 z-[100] animate-in slide-in-from-right-4 duration-500" x-transition.out.opacity.duration.1000ms>
        <span class="material-symbols-outlined">check_circle</span>
        <p class="font-bold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-8 right-8 bg-rose-500 text-white px-6 py-4 rounded-3xl shadow-2xl flex items-center gap-3 z-[100] animate-in slide-in-from-right-4 duration-500" x-transition.out.opacity.duration.1000ms>
        <span class="material-symbols-outlined">error</span>
        <p class="font-bold text-sm">{{ session('error') }}</p>
    </div>
    @endif

</x-admin-layout>
