<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-primary tracking-tight mb-1">
            @auth
                @php
                    $hour = now()->hour;
                    $greeting = $hour < 12 ? 'Chào buổi sáng' : ($hour < 18 ? 'Chào buổi chiều' : 'Chào buổi tối');
                @endphp
                {{ $greeting }}, {{ explode(' ', Auth::user()->name)[0] }} 👋
            @else
                Chào bạn!
            @endauth
        </h2>
        <p class="text-slate-500 text-sm">Hãy bắt đầu hành trình sự nghiệp cùng AI Career Tailor hôm nay.</p>
    </x-slot>

    <!-- Stats Cards -->
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="p-5 bg-white rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-lg hover:-translate-y-0.5 transition-all">
            <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary flex-shrink-0">
                <span class="material-symbols-outlined">description</span>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-primary">{{ str_pad($cvCount, 2, '0', STR_PAD_LEFT) }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-nowrap">Tổng số CV</p>
            </div>
        </div>
        <div class="p-5 bg-white rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-lg hover:-translate-y-0.5 transition-all">
            <div class="w-12 h-12 bg-secondary/10 rounded-2xl flex items-center justify-center text-secondary flex-shrink-0">
                <span class="material-symbols-outlined">work</span>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-secondary">{{ str_pad($jdCount, 2, '0', STR_PAD_LEFT) }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-nowrap">Mô tả công việc</p>
            </div>
        </div>
        <div class="p-5 bg-white rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-lg hover:-translate-y-0.5 transition-all">
            <div class="w-12 h-12 bg-tertiary/10 rounded-2xl flex items-center justify-center text-tertiary flex-shrink-0">
                <span class="material-symbols-outlined">analytics</span>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-tertiary">{{ str_pad($analysisCount, 2, '0', STR_PAD_LEFT) }}</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-nowrap">Đã phân tích</p>
            </div>
        </div>
        <div class="p-5 bg-gradient-to-br from-primary to-primary-container rounded-3xl shadow-lg shadow-primary/10 flex items-center gap-4 hover:-translate-y-0.5 transition-all">
            <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center text-white flex-shrink-0">
                <span class="material-symbols-outlined">auto_awesome</span>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-white">AI</p>
                <p class="text-[10px] font-bold text-white/60 uppercase tracking-widest text-nowrap">Sẵn sàng</p>
            </div>
        </div>
    </section>

    <!-- Main Dashboard Grid -->
    <div class="grid grid-cols-12 gap-6">
        <!-- Left Column -->
        <div class="col-span-12 lg:col-span-8 space-y-6">

            <!-- Quick Start Actions (Bento Style) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('client.cv-management') }}" class="relative overflow-hidden group bg-gradient-to-br from-primary to-primary-container p-8 rounded-3xl text-white shadow-xl hover:shadow-2xl hover:scale-[1.01] transition-all no-underline min-h-[180px] flex flex-col justify-between">
                    <div class="relative z-10">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-xl">upload_file</span>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Tải lên CV của bạn</h3>
                        <p class="text-white/60 text-sm leading-relaxed">AI sẽ tự động bóc tách và phân tích điểm mạnh của bạn.</p>
                    </div>
                    <span class="material-symbols-outlined absolute right-4 bottom-4 text-white/[0.07] text-7xl font-thin rotate-12 group-hover:rotate-6 transition-transform pointer-events-none">upload_file</span>
                </a>

                <a href="{{ route('client.ai-analysis') }}" class="relative overflow-hidden group bg-white p-8 rounded-3xl border border-slate-200/60 shadow-sm hover:shadow-xl hover:scale-[1.01] transition-all no-underline min-h-[180px] flex flex-col justify-between">
                    <div class="relative z-10">
                        <div class="w-10 h-10 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary mb-4">
                            <span class="material-symbols-outlined text-xl">psychology</span>
                        </div>
                        <h3 class="text-lg font-bold text-primary mb-2">Phân tích CV với AI</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Kiểm tra mức độ phù hợp và nhận gợi ý chỉnh sửa CV.</p>
                    </div>
                    <span class="material-symbols-outlined absolute right-4 bottom-4 text-slate-100 text-7xl font-thin -rotate-12 group-hover:-rotate-6 transition-transform pointer-events-none">content_paste_search</span>
                </a>
            </div>

            <!-- Recent CVs Section -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100/60 p-6">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-lg font-bold text-primary">CV Gần đây</h3>
                    <a class="text-xs font-bold text-secondary flex items-center hover:underline" href="{{ route('client.cv-management') }}">
                        Xem tất cả <span class="material-symbols-outlined text-sm ml-1">arrow_forward</span>
                    </a>
                </div>

                @if($recentCvs->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($recentCvs as $cv)
                        <div class="p-4 rounded-2xl bg-slate-50/50 border border-slate-100 hover:bg-white hover:shadow-md hover:border-primary/10 transition-all group cursor-pointer">
                            <div class="flex items-start gap-3 mb-3">
                                <div class="w-10 h-10 bg-slate-200/60 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-primary group-hover:text-white transition-colors flex-shrink-0">
                                    <span class="material-symbols-outlined text-xl">article</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-primary truncate">{{ $cv->title ?: 'CV #'.$cv->id }}</h4>
                                    <p class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $cv->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @if($cv->extracted_skills && count($cv->extracted_skills) > 0)
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach(array_slice($cv->extracted_skills, 0, 3) as $skill)
                                        <span class="bg-primary/5 text-primary/70 px-2 py-0.5 rounded-lg text-[10px] font-bold">{{ $skill }}</span>
                                    @endforeach
                                    @if(count($cv->extracted_skills) > 3)
                                        <span class="text-[10px] text-slate-400 font-bold">+{{ count($cv->extracted_skills) - 3 }}</span>
                                    @endif
                                </div>
                            @else
                                <div class="flex items-center gap-1.5 text-[10px] text-slate-400 font-medium">
                                    <span class="material-symbols-outlined text-xs">info</span> Chưa có dữ liệu kỹ năng
                                </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10">
                        <span class="material-symbols-outlined text-slate-200 text-6xl mb-3 block">folder_open</span>
                        <p class="text-sm font-bold text-slate-400 mb-1">Chưa có CV nào</p>
                        <p class="text-xs text-slate-400 mb-4">Tạo CV đầu tiên để bắt đầu hành trình sự nghiệp</p>
                        <a href="{{ route('client.cv-management') }}" class="inline-flex items-center gap-2 px-5 py-2 bg-primary text-white text-sm font-bold rounded-full hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-sm">add</span> Tạo CV mới
                        </a>
                    </div>
                @endif
            </div>

            <!-- Recent Analysis Results -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100/60 p-6">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-lg font-bold text-primary">Kết quả phân tích gần đây</h3>
                    <a class="text-xs font-bold text-secondary flex items-center hover:underline" href="{{ route('client.ai-analysis') }}">
                        Phân tích mới <span class="material-symbols-outlined text-sm ml-1">arrow_forward</span>
                    </a>
                </div>

                @if($recentMatches->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentMatches as $match)
                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50/50 border border-slate-100 hover:bg-white hover:shadow-md transition-all group">
                            <!-- Score Circle -->
                            <div class="relative w-14 h-14 flex-shrink-0">
                                @php
                                    $score = round($match->match_score);
                                    $circumference = 2 * 3.14159 * 20;
                                    $offset = $circumference - ($score / 100) * $circumference;
                                    $scoreColor = $score >= 80 ? '#10b981' : ($score >= 60 ? '#f59e0b' : '#ef4444');
                                @endphp
                                <svg class="w-14 h-14 transform -rotate-90" viewBox="0 0 48 48">
                                    <circle cx="24" cy="24" r="20" fill="none" stroke="#f1f5f9" stroke-width="4"/>
                                    <circle cx="24" cy="24" r="20" fill="none" stroke="{{ $scoreColor }}" stroke-width="4" stroke-linecap="round"
                                            stroke-dasharray="{{ $circumference }}" stroke-dashoffset="{{ $offset }}"/>
                                </svg>
                                <span class="absolute inset-0 flex items-center justify-center text-xs font-black text-slate-700">{{ $score }}%</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-primary truncate">{{ $match->cv->title ?? 'CV' }} ↔ {{ $match->jobDescription->title ?? 'JD' }}</h4>
                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $match->created_at->diffForHumans() }}</p>
                                @if($match->missing_skills && count($match->missing_skills) > 0)
                                    <div class="flex flex-wrap gap-1 mt-1.5">
                                        @foreach(array_slice($match->missing_skills, 0, 2) as $skill)
                                            <span class="bg-rose-50 text-rose-500 px-2 py-0.5 rounded-lg text-[9px] font-bold">Thiếu: {{ $skill }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <span class="material-symbols-outlined text-slate-300 group-hover:text-primary transition-colors">chevron_right</span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10">
                        <span class="material-symbols-outlined text-slate-200 text-6xl mb-3 block">query_stats</span>
                        <p class="text-sm font-bold text-slate-400 mb-1">Chưa có kết quả phân tích</p>
                        <p class="text-xs text-slate-400 mb-4">So sánh CV với JD để nhận đánh giá từ AI</p>
                        <a href="{{ route('client.ai-analysis') }}" class="inline-flex items-center gap-2 px-5 py-2 bg-secondary text-white text-sm font-bold rounded-full hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-sm">psychology</span> Phân tích ngay
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-span-12 lg:col-span-4 space-y-6">

            <!-- AI Suggestion Card -->
            <div class="glass-panel p-6 rounded-3xl relative overflow-hidden">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-secondary to-tertiary rounded-full flex items-center justify-center text-white shadow-lg shadow-secondary/30">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">psychology</span>
                    </div>
                    <div>
                        <span class="text-sm font-bold text-primary block leading-tight">Career Tailor AI</span>
                        <span class="text-[10px] text-slate-400 font-medium">Trợ lý sự nghiệp</span>
                    </div>
                </div>
                @if($cvCount > 0)
                    <p class="text-primary/80 text-sm leading-relaxed">
                        Bạn hiện có <strong>{{ $cvCount }} CV</strong> và <strong>{{ $analysisCount }} lượt phân tích</strong>.
                        @if($analysisCount == 0)
                            Hãy thử phân tích CV với AI để nhận gợi ý cải thiện!
                        @else
                            Tiếp tục cập nhật để tối ưu hồ sơ của bạn!
                        @endif
                    </p>
                @else
                    <p class="text-primary/80 text-sm leading-relaxed">
                        Chào mừng bạn đến với <strong>AI Career Tailor</strong>! Hãy bắt đầu bằng cách tạo CV đầu tiên để AI phân tích và gợi ý cải thiện.
                    </p>
                @endif
            </div>

            <!-- Quick Navigation -->
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <h3 class="text-sm font-bold text-primary mb-4">Truy cập nhanh</h3>
                <div class="space-y-2">
                    <a href="{{ route('client.cv-management') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-primary/5 hover:border-primary/10 border border-transparent transition-all group no-underline">
                        <div class="w-9 h-9 bg-primary/10 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-lg">description</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-slate-700 group-hover:text-primary transition-colors">Quản lý CV</p>
                            <p class="text-[10px] text-slate-400">{{ $cvCount }} hồ sơ</p>
                        </div>
                        <span class="material-symbols-outlined text-slate-300 text-sm group-hover:text-primary transition-colors">chevron_right</span>
                    </a>
                    <a href="{{ route('client.jobs') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-secondary/5 hover:border-secondary/10 border border-transparent transition-all group no-underline">
                        <div class="w-9 h-9 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary group-hover:bg-secondary group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-lg">work</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-slate-700 group-hover:text-secondary transition-colors">Danh sách JD</p>
                            <p class="text-[10px] text-slate-400">{{ $jdCount }} mô tả công việc</p>
                        </div>
                        <span class="material-symbols-outlined text-slate-300 text-sm group-hover:text-secondary transition-colors">chevron_right</span>
                    </a>
                    <a href="{{ route('client.ai-analysis') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-tertiary/5 hover:border-tertiary/10 border border-transparent transition-all group no-underline">
                        <div class="w-9 h-9 bg-tertiary/10 rounded-xl flex items-center justify-center text-tertiary group-hover:bg-tertiary group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-lg">psychology</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-slate-700 group-hover:text-tertiary transition-colors">Phân tích AI</p>
                            <p class="text-[10px] text-slate-400">{{ $analysisCount }} lượt phân tích</p>
                        </div>
                        <span class="material-symbols-outlined text-slate-300 text-sm group-hover:text-tertiary transition-colors">chevron_right</span>
                    </a>
                    <a href="{{ route('client.roadmap') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-primary/5 hover:border-primary/10 border border-transparent transition-all group no-underline">
                        <div class="w-9 h-9 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-lg">model_training</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-slate-700 group-hover:text-emerald-600 transition-colors">Lộ trình học</p>
                            <p class="text-[10px] text-slate-400">Phát triển kỹ năng</p>
                        </div>
                        <span class="material-symbols-outlined text-slate-300 text-sm group-hover:text-emerald-600 transition-colors">chevron_right</span>
                    </a>
                </div>
            </div>

            <!-- Recent JDs -->
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-primary">JD Gần đây</h3>
                    <a class="text-[10px] font-bold text-secondary hover:underline" href="{{ route('client.jobs') }}">Xem tất cả</a>
                </div>

                @if($recentJds->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentJds as $jd)
                        <div class="flex items-center gap-3 group cursor-pointer">
                            <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-secondary group-hover:text-white transition-colors flex-shrink-0">
                                <span class="material-symbols-outlined text-lg">work</span>
                            </div>
                            <div class="flex-1 min-w-0 border-b border-slate-50 pb-3 group-last:border-none group-last:pb-0">
                                <h4 class="text-sm font-bold text-primary truncate group-hover:text-secondary transition-colors">{{ $jd->title }}</h4>
                                @if($jd->company_name)
                                    <p class="text-[10px] text-slate-400 font-medium truncate">{{ $jd->company_name }} • {{ $jd->created_at->diffForHumans() }}</p>
                                @else
                                    <p class="text-[10px] text-slate-400 font-medium">{{ $jd->created_at->diffForHumans() }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6">
                        <span class="material-symbols-outlined text-slate-200 text-4xl mb-2 block">work_off</span>
                        <p class="text-xs text-slate-400">Chưa có mô tả công việc nào</p>
                    </div>
                @endif
            </div>

            <!-- How It Works -->
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 p-6 rounded-[2rem] text-white shadow-lg">
                <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sky-400 text-sm">lightbulb</span>
                    Cách sử dụng
                </h3>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-sky-500/20 rounded-lg flex items-center justify-center text-sky-400 text-xs font-black flex-shrink-0 mt-0.5">1</div>
                        <p class="text-xs text-slate-400 leading-relaxed"><span class="text-white font-bold">Tạo CV</span> — Tải lên hoặc tạo CV từ template có sẵn</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-sky-500/20 rounded-lg flex items-center justify-center text-sky-400 text-xs font-black flex-shrink-0 mt-0.5">2</div>
                        <p class="text-xs text-slate-400 leading-relaxed"><span class="text-white font-bold">Thêm JD</span> — Dán mô tả công việc bạn muốn ứng tuyển</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-sky-500/20 rounded-lg flex items-center justify-center text-sky-400 text-xs font-black flex-shrink-0 mt-0.5">3</div>
                        <p class="text-xs text-slate-400 leading-relaxed"><span class="text-white font-bold">AI phân tích</span> — Nhận điểm matching và gợi ý cải thiện</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-emerald-500/20 rounded-lg flex items-center justify-center text-emerald-400 text-xs font-black flex-shrink-0 mt-0.5">4</div>
                        <p class="text-xs text-slate-400 leading-relaxed"><span class="text-white font-bold">Lộ trình</span> — Theo dõi và phát triển kỹ năng còn thiếu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('fab')
        <a href="{{ route('client.cv-management') }}" class="fixed bottom-8 right-8 w-14 h-14 bg-primary text-white rounded-2xl shadow-2xl shadow-primary/30 flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50 group no-underline">
            <span class="material-symbols-outlined text-2xl">edit_note</span>
            <span class="absolute right-full mr-3 bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none shadow-lg">Viết CV mới</span>
        </a>
    @endpush
</x-app-layout>
