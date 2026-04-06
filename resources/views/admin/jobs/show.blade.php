<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-sky-500">visibility</span>
            <span>Chi tiết Job Description</span>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <!-- Header Card -->
        <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800 p-10 rounded-[3rem] text-white shadow-2xl">
            <div class="relative z-10">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            @if($job->domain)
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-sky-500/20 text-sky-300 border border-sky-500/20">
                                    {{ $job->domain }}
                                </span>
                            @endif
                            <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-white/10 text-slate-300 border border-white/10">
                                ID: #{{ $job->id }}
                            </span>
                        </div>
                        <h2 class="text-3xl font-black tracking-tight mb-2">{{ $job->title }}</h2>
                        <p class="text-slate-400 text-sm">Đăng bởi <span class="text-sky-400 font-bold">{{ $job->employer->name ?? 'N/A' }}</span> · {{ $job->created_at->translatedFormat('d/m/Y H:i') }}</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.jobs.edit', $job) }}" class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-2xl font-bold text-sm transition-all active:scale-95 flex items-center gap-2 border border-white/10">
                            <span class="material-symbols-outlined text-sm">edit</span> Chỉnh sửa
                        </a>
                        <a href="{{ route('admin.jobs.index') }}" class="px-6 py-3 bg-white text-slate-900 rounded-2xl font-black text-sm hover:scale-105 transition-transform flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">arrow_back</span> Quay lại
                        </a>
                    </div>
                </div>
            </div>
            <div class="absolute top-0 right-0 w-80 h-80 bg-sky-500/10 rounded-full blur-3xl -mr-16 -mt-16"></div>
            <span class="material-symbols-outlined absolute right-10 top-1/2 -translate-y-1/2 text-white/5 text-[12rem] font-thin rotate-12 pointer-events-none">work</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description -->
                <div class="glass-card rounded-[2.5rem] shadow-sm border border-white p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-sky-500/10 rounded-xl flex items-center justify-center text-sky-600">
                            <span class="material-symbols-outlined">description</span>
                        </div>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight">Mô tả công việc</h3>
                    </div>
                    @if($job->description)
                        <div class="text-sm text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50 p-6 rounded-2xl">{{ $job->description }}</div>
                    @else
                        <div class="text-center py-8">
                            <span class="material-symbols-outlined text-4xl text-slate-200 mb-2">edit_note</span>
                            <p class="text-sm text-slate-300">Chưa có mô tả chi tiết</p>
                        </div>
                    @endif
                </div>

                <!-- Requirements -->
                <div class="glass-card rounded-[2.5rem] shadow-sm border border-white p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-amber-500/10 rounded-xl flex items-center justify-center text-amber-600">
                            <span class="material-symbols-outlined">checklist</span>
                        </div>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight">Yêu cầu công việc</h3>
                        @if($job->requirements && is_array($job->requirements))
                            <span class="px-3 py-1 rounded-full text-[10px] font-black bg-amber-500/10 text-amber-600">
                                {{ count($job->requirements) }} yêu cầu
                            </span>
                        @endif
                    </div>

                    @if($job->requirements && is_array($job->requirements) && count($job->requirements) > 0)
                        <div class="space-y-3">
                            @foreach($job->requirements as $index => $req)
                                <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-2xl group hover:bg-sky-50/50 transition-colors">
                                    <div class="w-7 h-7 rounded-lg bg-sky-500/10 text-sky-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <span class="text-xs font-black">{{ $index + 1 }}</span>
                                    </div>
                                    <p class="text-sm text-slate-700 font-medium leading-relaxed">{{ $req }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <span class="material-symbols-outlined text-4xl text-slate-200 mb-2">playlist_add</span>
                            <p class="text-sm text-slate-300">Chưa có yêu cầu cụ thể</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-8">
                <!-- Meta Info -->
                <div class="glass-card rounded-[2.5rem] shadow-sm border border-white p-8">
                    <h4 class="text-sm font-black text-slate-900 tracking-tight mb-6">Thông tin chi tiết</h4>
                    <div class="space-y-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-sky-500/10 flex items-center justify-center text-sky-600">
                                <span class="material-symbols-outlined text-lg">person</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Người đăng</p>
                                <p class="text-sm font-bold text-slate-900">{{ $job->employer->name ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-600">
                                <span class="material-symbols-outlined text-lg">mail</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Email</p>
                                <p class="text-sm font-bold text-slate-900">{{ $job->employer->email ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-600">
                                <span class="material-symbols-outlined text-lg">category</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Lĩnh vực</p>
                                <p class="text-sm font-bold text-slate-900">{{ $job->domain ?? 'Chưa phân loại' }}</p>
                            </div>
                        </div>

                        <hr class="border-slate-100">

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500">
                                <span class="material-symbols-outlined text-lg">calendar_today</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ngày tạo</p>
                                <p class="text-sm font-bold text-slate-900">{{ $job->created_at->translatedFormat('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500">
                                <span class="material-symbols-outlined text-lg">update</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Cập nhật lần cuối</p>
                                <p class="text-sm font-bold text-slate-900">{{ $job->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="glass-card rounded-[2.5rem] shadow-sm border border-white p-8">
                    <h4 class="text-sm font-black text-slate-900 tracking-tight mb-6">Thao tác nhanh</h4>
                    <div class="space-y-3">
                        <a href="{{ route('admin.jobs.edit', $job) }}" class="w-full py-3 bg-sky-50 hover:bg-sky-100 text-sky-600 rounded-2xl font-bold text-sm transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">edit</span> Chỉnh sửa JD
                        </a>
                        <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa JD này? Hành động không thể hoàn tác.')">
                            @csrf
                            @method('DELETE')
                            <button class="w-full py-3 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-2xl font-bold text-sm transition-colors flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm">delete</span> Xóa JD
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
