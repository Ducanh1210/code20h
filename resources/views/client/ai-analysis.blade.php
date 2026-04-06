<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight text-primary mb-2">So sánh CV với JD</h2>
                <p class="text-slate-500 max-w-lg">Phân tích mức độ phù hợp giữa CV và mô tả công việc bằng AI.</p>
            </div>
            <div class="p-1 bg-surface-container rounded-2xl flex gap-1">
                <button onclick="switchTab('compare')" id="tab-compare" class="tab-btn px-4 py-2 bg-white shadow-sm rounded-xl text-primary font-bold text-xs uppercase tracking-widest">So sánh CV-JD</button>
                <button onclick="switchTab('analyze')" id="tab-analyze" class="tab-btn px-4 py-2 text-slate-500 font-bold text-xs uppercase tracking-widest hover:bg-white/50 rounded-xl transition-all">Phân tích CV</button>
            </div>
        </div>
    </x-slot>

    <style>
        .score-circle { transition: stroke-dashoffset 1.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .result-card { animation: slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) both; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
        .result-card:nth-child(2) { animation-delay: 0.1s; }
        .result-card:nth-child(3) { animation-delay: 0.2s; }
        .result-card:nth-child(4) { animation-delay: 0.3s; }
        .skeleton { background: linear-gradient(90deg, #f1f5f9 0%, #e2e8f0 50%, #f1f5f9 100%); background-size: 200% 100%; animation: shimmer 1.5s infinite; border-radius: 12px; }
        @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }
        .pulse-dot { width: 8px; height: 8px; border-radius: 50%; animation: pulse 1.2s infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.4; transform: scale(0.8); } }
        .skill-bar-fill { transition: width 1.2s cubic-bezier(0.16, 1, 0.3, 1); }
        .fade-in { animation: fadeIn 0.4s ease both; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>

    {{-- Tab 1: So sánh CV với JD --}}
    <div id="panel-compare">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
            {{-- Select CV --}}
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                <label class="flex items-center gap-2 text-sm font-bold text-primary mb-2">
                    <span class="material-symbols-outlined text-indigo-500 text-lg">description</span>
                    Chọn CV
                </label>
                <select id="cv-select" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 transition-all">
                    <option value="">-- Chọn CV của bạn --</option>
                    @foreach($cvs as $cv)
                        <option value="{{ $cv->id }}">{{ $cv->title }} ({{ $cv->created_at->format('d/m/Y') }})</option>
                    @endforeach
                </select>
                @if($cvs->isEmpty())
                    <p class="text-xs text-amber-500 mt-2 flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        Chưa có CV. <a href="{{ route('client.cv-management') }}" class="underline font-bold">Tạo CV</a>
                    </p>
                @endif
            </div>

            {{-- Select JD --}}
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                <label class="flex items-center gap-2 text-sm font-bold text-primary mb-2">
                    <span class="material-symbols-outlined text-emerald-500 text-lg">work</span>
                    Chọn Công việc (JD)
                </label>
                <select id="jd-select" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition-all">
                    <option value="">-- Chọn mô tả công việc --</option>
                    @foreach($jds as $jd)
                        <option value="{{ $jd->id }}">{{ $jd->title }} - {{ $jd->company_name }}</option>
                    @endforeach
                </select>
                @if($jds->isEmpty())
                    <p class="text-xs text-amber-500 mt-2 flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        Chưa có JD. <a href="{{ route('client.jobs') }}" class="underline font-bold">Thêm JD</a>
                    </p>
                @endif
            </div>
        </div>

        {{-- Action Button --}}
        <div class="text-center mb-8">
            <button onclick="runComparison()" id="btn-compare"
                class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-indigo-600 to-cyan-500 text-white font-bold rounded-2xl shadow-lg shadow-indigo-200/40 hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] transition-all text-sm disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                <span class="material-symbols-outlined text-lg">auto_awesome</span>
                <span id="btn-compare-text">Phân tích bằng AI</span>
                <div id="btn-compare-spinner" class="hidden">
                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </button>
        </div>

        {{-- Loading Skeleton --}}
        <div id="loading-skeleton" class="hidden mb-10">
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 lg:col-span-4">
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 flex flex-col items-center">
                        <div class="skeleton w-32 h-4 mb-6"></div>
                        <div class="skeleton w-48 h-48 rounded-full mb-6"></div>
                        <div class="skeleton w-28 h-8 rounded-full"></div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-8 space-y-6">
                    <div class="skeleton w-full h-40 rounded-[2rem]"></div>
                    <div class="skeleton w-full h-40 rounded-[2rem]"></div>
                </div>
            </div>
            <div class="flex items-center justify-center gap-3 mt-8 text-slate-400">
                <div class="pulse-dot bg-indigo-500"></div>
                <span class="text-sm font-medium">AI đang phân tích CV và JD...</span>
            </div>
        </div>

        {{-- Results Container --}}
        <div id="results-container" class="hidden">
            {{-- Score + Summary Row --}}
            <div class="grid grid-cols-12 gap-8 mb-8">
                {{-- Score Circle --}}
                <div class="col-span-12 lg:col-span-4 result-card">
                    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col items-center justify-center relative overflow-hidden group text-center h-full">
                        <div class="absolute -right-12 -top-12 w-48 h-48 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-colors"></div>
                        <p class="text-[10px] font-extrabold text-slate-400 mb-4 uppercase tracking-widest">Điểm phù hợp tổng quát</p>
                        <div class="relative w-44 h-44 mb-4">
                            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                                <circle class="text-slate-100" cx="50" cy="50" fill="transparent" r="45" stroke="currentColor" stroke-dasharray="282.7" stroke-dashoffset="0" stroke-width="8"></circle>
                                <circle id="score-arc" class="score-circle" cx="50" cy="50" fill="transparent" r="45" stroke="currentColor" stroke-dasharray="282.7" stroke-dashoffset="282.7" stroke-linecap="round" stroke-width="8"></circle>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span id="score-number" class="text-5xl font-extrabold text-primary">0</span>
                                <span class="text-xs text-slate-400 font-bold">/ 100</span>
                            </div>
                        </div>
                        <div id="score-badge" class="px-5 py-2 text-xs font-extrabold rounded-full uppercase tracking-tighter"></div>
                        <p id="result-summary" class="text-xs text-slate-500 mt-4 leading-relaxed max-w-[240px]"></p>
                    </div>
                </div>

                {{-- Strengths & Weaknesses --}}
                <div class="col-span-12 lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="result-card">
                        <div class="p-6 bg-white border-2 border-emerald-200 rounded-[2rem] shadow-sm relative overflow-hidden h-full">
                            <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-emerald-100 text-[8rem]">trending_up</span>
                            <p class="text-[10px] font-bold text-emerald-600 uppercase mb-3 tracking-widest">Điểm mạnh của bạn</p>
                            <div id="strengths-list" class="space-y-3"></div>
                        </div>
                    </div>

                    {{-- Weaknesses --}}
                    <div class="result-card">
                        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm relative overflow-hidden h-full">
                            <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-slate-100 text-[8rem]">trending_down</span>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-3 tracking-widest">Cần cải thiện</p>
                            <div id="weaknesses-list" class="space-y-3"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Skill Breakdown --}}
            <div class="result-card mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-indigo-600">analytics</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary">Chi tiết đối sánh kỹ năng</h3>
                </div>
                <div id="skill-breakdown" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"></div>
            </div>

            {{-- Experience Analysis --}}
            <div class="result-card bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-amber-600">work_history</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary">Phân tích kinh nghiệm làm việc</h3>
                </div>
                <div id="experience-analysis" class="space-y-4"></div>
            </div>

            {{-- Missing Skills + Suggestions --}}
            <div class="grid grid-cols-12 gap-8 mb-8">
                <div class="col-span-12 lg:col-span-6 result-card">
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 h-full">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-9 h-9 rounded-lg bg-red-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-red-500 text-lg">error</span>
                            </div>
                            <h4 class="font-bold text-primary">Kỹ năng còn thiếu</h4>
                        </div>
                        <div id="missing-skills" class="flex flex-wrap gap-2"></div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-6 result-card">
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 h-full">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-amber-500 text-lg">lightbulb</span>
                            </div>
                            <h4 class="font-bold text-primary">Gợi ý cải thiện</h4>
                        </div>
                        <ul id="suggestions-list" class="space-y-2"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tab 2: Phân tích CV --}}
    <div id="panel-analyze" class="hidden">
        <div class="max-w-2xl mx-auto mb-8">
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-indigo-600">person_search</span>
                    </div>
                    <h3 class="font-bold text-primary text-lg">Chọn CV để phân tích</h3>
                </div>
                <select id="cv-analyze-select" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 transition-all mb-4">
                    <option value="">-- Chọn CV --</option>
                    @foreach($cvs as $cv)
                        <option value="{{ $cv->id }}">{{ $cv->title }} ({{ $cv->created_at->format('d/m/Y') }})</option>
                    @endforeach
                </select>
                <button onclick="runCvAnalysis()" id="btn-analyze-cv"
                    class="w-full flex items-center justify-center gap-3 px-6 py-3 bg-gradient-to-r from-indigo-600 to-cyan-500 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.01] active:scale-[0.99] transition-all text-sm uppercase tracking-wider disabled:opacity-50 disabled:cursor-not-allowed">
                    <span class="material-symbols-outlined text-lg">smart_toy</span>
                    <span id="btn-analyze-text">Phân tích CV bằng AI</span>
                    <div id="btn-analyze-spinner" class="hidden">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </button>
            </div>
        </div>

        {{-- CV Analysis Loading --}}
        <div id="cv-loading" class="hidden max-w-3xl mx-auto">
            <div class="space-y-4">
                <div class="skeleton w-full h-24 rounded-[2rem]"></div>
                <div class="skeleton w-full h-32 rounded-[2rem]"></div>
                <div class="skeleton w-full h-24 rounded-[2rem]"></div>
            </div>
            <div class="flex items-center justify-center gap-3 mt-6 text-slate-400">
                <div class="pulse-dot bg-indigo-500"></div>
                <span class="text-sm font-medium">AI đang trích xuất thông tin từ CV...</span>
            </div>
        </div>

        {{-- CV Analysis Results --}}
        <div id="cv-results" class="hidden max-w-4xl mx-auto">
            {{-- Candidate Info --}}
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 mb-6 result-card">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center shadow-lg">
                        <span class="material-symbols-outlined text-white text-3xl">person</span>
                    </div>
                    <div>
                        <h3 id="cv-candidate-name" class="text-xl font-bold text-primary"></h3>
                        <p id="cv-job-title" class="text-sm text-slate-500"></p>
                    </div>
                </div>
                <p id="cv-overall" class="text-sm text-slate-600 mt-4 leading-relaxed bg-slate-50 p-4 rounded-xl"></p>
            </div>

            {{-- Skills --}}
            <div class="grid grid-cols-12 gap-6 mb-6">
                <div class="col-span-12 md:col-span-6 result-card">
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 h-full">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="material-symbols-outlined text-indigo-600">code</span>
                            <h4 class="font-bold text-primary">Kỹ năng kỹ thuật</h4>
                        </div>
                        <div id="cv-tech-skills" class="flex flex-wrap gap-2"></div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 result-card">
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 h-full">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="material-symbols-outlined text-emerald-600">group</span>
                            <h4 class="font-bold text-primary">Kỹ năng mềm</h4>
                        </div>
                        <div id="cv-soft-skills" class="flex flex-wrap gap-2"></div>
                    </div>
                </div>
            </div>

            {{-- Experience --}}
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 mb-6 result-card">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-amber-600">work_history</span>
                    <h4 class="font-bold text-primary">Kinh nghiệm làm việc</h4>
                </div>
                <div id="cv-experience" class="space-y-4"></div>
            </div>

            {{-- Projects --}}
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 mb-6 result-card">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-cyan-600">rocket_launch</span>
                    <h4 class="font-bold text-primary">Dự án</h4>
                </div>
                <div id="cv-projects" class="space-y-4"></div>
            </div>

            {{-- Achievements + Education --}}
            <div class="grid grid-cols-12 gap-6 mb-6">
                <div class="col-span-12 md:col-span-6 result-card">
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 h-full">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="material-symbols-outlined text-yellow-600">emoji_events</span>
                            <h4 class="font-bold text-primary">Thành tựu</h4>
                        </div>
                        <ul id="cv-achievements" class="space-y-2"></ul>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 result-card">
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 h-full">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="material-symbols-outlined text-indigo-600">school</span>
                            <h4 class="font-bold text-primary">Học vấn</h4>
                        </div>
                        <div id="cv-education" class="space-y-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- History Section --}}
    @if($history->isNotEmpty())
    <div class="mt-12">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-slate-600">history</span>
            </div>
            <h3 class="text-xl font-bold text-primary">Lịch sử phân tích</h3>
        </div>
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-6 py-4 font-bold text-slate-500 uppercase tracking-wider text-xs">CV</th>
                        <th class="text-left px-6 py-4 font-bold text-slate-500 uppercase tracking-wider text-xs">Công việc (JD)</th>
                        <th class="text-center px-6 py-4 font-bold text-slate-500 uppercase tracking-wider text-xs">Điểm</th>
                        <th class="text-left px-6 py-4 font-bold text-slate-500 uppercase tracking-wider text-xs">Ngày</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($history as $match)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-primary">{{ $match->cv->title ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $match->jobDescription->title ?? 'N/A' }} <span class="text-slate-400">- {{ $match->jobDescription->company_name ?? '' }}</span></td>
                        <td class="px-6 py-4 text-center">
                            @php $s = $match->match_score; @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                {{ $s >= 70 ? 'bg-emerald-100 text-emerald-700' : ($s >= 40 ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                {{ number_format($s, 0) }}%
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-400 text-xs">{{ $match->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <script>
        const CSRF = '{{ csrf_token() }}';

        // Tab switching
        function switchTab(tab) {
            document.getElementById('panel-compare').classList.toggle('hidden', tab !== 'compare');
            document.getElementById('panel-analyze').classList.toggle('hidden', tab !== 'analyze');

            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'shadow-sm', 'text-primary');
                btn.classList.add('text-slate-500');
            });
            const active = document.getElementById('tab-' + tab);
            active.classList.add('bg-white', 'shadow-sm', 'text-primary');
            active.classList.remove('text-slate-500');
        }

        // ============ CV vs JD Comparison ============
        async function runComparison() {
            const cvId = document.getElementById('cv-select').value;
            const jdId = document.getElementById('jd-select').value;
            if (!cvId || !jdId) { alert('Vui lòng chọn cả CV và JD.'); return; }

            const btn = document.getElementById('btn-compare');
            btn.disabled = true;
            document.getElementById('btn-compare-text').textContent = 'Đang phân tích...';
            document.getElementById('btn-compare-spinner').classList.remove('hidden');
            document.getElementById('results-container').classList.add('hidden');
            document.getElementById('loading-skeleton').classList.remove('hidden');

            try {
                const res = await fetch('{{ route("client.ai-analysis.compare") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                    body: JSON.stringify({ cv_id: cvId, jd_id: jdId })
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.error || 'Đã xảy ra lỗi.');
                renderComparisonResults(json.data);
            } catch (e) {
                alert('Lỗi: ' + e.message);
            } finally {
                btn.disabled = false;
                document.getElementById('btn-compare-text').textContent = 'Phân tích bằng AI';
                document.getElementById('btn-compare-spinner').classList.add('hidden');
                document.getElementById('loading-skeleton').classList.add('hidden');
            }
        }

        function renderComparisonResults(data) {
            const container = document.getElementById('results-container');
            container.classList.remove('hidden');

            // Score
            const score = data.match_score || 0;
            const arc = document.getElementById('score-arc');
            const offset = 282.7 - (282.7 * score / 100);
            const scoreColor = score >= 70 ? '#10b981' : (score >= 40 ? '#f59e0b' : '#ef4444');
            arc.style.stroke = scoreColor;
            setTimeout(() => { arc.style.strokeDashoffset = offset; }, 100);

            // Animate score number
            animateNumber('score-number', 0, score, 1500);

            // Badge
            const badge = document.getElementById('score-badge');
            const level = data.match_level || (score >= 70 ? 'Phù hợp cao' : (score >= 40 ? 'Phù hợp trung bình' : 'Chưa phù hợp'));
            badge.textContent = level;
            badge.className = 'px-5 py-2 text-xs font-extrabold rounded-full uppercase tracking-tighter ' +
                (score >= 70 ? 'bg-emerald-100 text-emerald-700' : (score >= 40 ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700'));

            // Summary
            document.getElementById('result-summary').textContent = data.summary || '';

            // Strengths
            const strengthsList = document.getElementById('strengths-list');
            strengthsList.innerHTML = '';
            (data.strengths || []).forEach(s => {
                strengthsList.innerHTML += `
                    <div class="bg-emerald-50 rounded-xl p-3 border border-emerald-100">
                        <h5 class="font-bold text-sm mb-1 text-emerald-800">${s.title}</h5>
                        <p class="text-xs text-slate-600 leading-relaxed">${s.detail}</p>
                    </div>`;
            });

            // Weaknesses
            const weaknessesList = document.getElementById('weaknesses-list');
            weaknessesList.innerHTML = '';
            (data.weaknesses || []).forEach(w => {
                weaknessesList.innerHTML += `
                    <div class="bg-slate-50 rounded-xl p-3">
                        <h5 class="font-bold text-primary text-sm mb-1">${w.title}</h5>
                        <p class="text-xs text-slate-500 leading-relaxed">${w.detail}</p>
                    </div>`;
            });

            // Skill Breakdown
            const skillEl = document.getElementById('skill-breakdown');
            skillEl.innerHTML = '';
            (data.skill_breakdown || []).forEach((sk, idx) => {
                const barColor = sk.score >= 70 ? 'bg-emerald-500' : (sk.score >= 40 ? 'bg-amber-400' : 'bg-red-400');
                const textColor = sk.score >= 70 ? 'text-emerald-600' : (sk.score >= 40 ? 'text-amber-600' : 'text-red-500');
                const borderColor = sk.score >= 70 ? 'border-emerald-200' : (sk.score >= 40 ? 'border-amber-200' : 'border-red-200');
                const bgColor = sk.score >= 70 ? 'bg-emerald-50/50' : (sk.score >= 40 ? 'bg-amber-50/50' : 'bg-red-50/50');
                const strokeColor = sk.score >= 70 ? '#10b981' : (sk.score >= 40 ? '#f59e0b' : '#ef4444');
                const circum = 2 * Math.PI * 28;
                const dashOffset = circum - (circum * sk.score / 100);

                skillEl.innerHTML += `
                    <div class="bg-white p-5 rounded-2xl border ${borderColor} ${bgColor} hover:shadow-md transition-all duration-300" style="animation: slideUp 0.4s ease both; animation-delay: ${idx * 0.08}s">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="relative w-14 h-14 flex-shrink-0">
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 64 64">
                                    <circle cx="32" cy="32" r="28" fill="transparent" stroke="#e2e8f0" stroke-width="4"></circle>
                                    <circle class="score-circle" cx="32" cy="32" r="28" fill="transparent" stroke="${strokeColor}" stroke-width="4" stroke-linecap="round"
                                        stroke-dasharray="${circum.toFixed(1)}" stroke-dashoffset="${circum.toFixed(1)}" data-offset="${dashOffset.toFixed(1)}"></circle>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-xs font-black ${textColor}">${sk.score}%</span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h5 class="font-bold text-primary text-sm truncate">${sk.category}</h5>
                                <p class="text-[11px] text-slate-400 mt-0.5 line-clamp-2">Yêu cầu: ${sk.required}</p>
                            </div>
                        </div>
                        <div class="h-1.5 bg-slate-200/70 rounded-full overflow-hidden">
                            <div class="skill-bar-fill h-full ${barColor} rounded-full" style="width: 0%" data-width="${sk.score}%"></div>
                        </div>
                    </div>`;
            });
            // Animate skill bars + circles
            setTimeout(() => {
                document.querySelectorAll('#skill-breakdown .skill-bar-fill').forEach(bar => {
                    bar.style.width = bar.dataset.width;
                });
                document.querySelectorAll('#skill-breakdown .score-circle').forEach(circle => {
                    circle.style.transition = 'stroke-dashoffset 1.2s cubic-bezier(0.4, 0, 0.2, 1)';
                    circle.style.strokeDashoffset = circle.dataset.offset;
                });
            }, 200);

            // Missing Skills
            const missingEl = document.getElementById('missing-skills');
            missingEl.innerHTML = '';
            (data.missing_skills || []).forEach(ms => {
                missingEl.innerHTML += `<span class="px-3 py-1.5 bg-red-50 text-red-600 text-xs font-bold rounded-lg border border-red-100">${ms}</span>`;
            });
            if (!(data.missing_skills || []).length) {
                missingEl.innerHTML = '<p class="text-sm text-slate-400 italic">Không phát hiện kỹ năng thiếu 🎉</p>';
            }

            // Suggestions
            const sugEl = document.getElementById('suggestions-list');
            sugEl.innerHTML = '';
            (data.improvement_suggestions || []).forEach((s, i) => {
                sugEl.innerHTML += `
                    <li class="flex items-start gap-2">
                        <span class="w-6 h-6 rounded-lg bg-amber-50 text-amber-600 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">${i+1}</span>
                        <span class="text-sm text-slate-600 leading-relaxed">${s}</span>
                    </li>`;
            });

            // Experience Analysis
            const expEl = document.getElementById('experience-analysis');
            expEl.innerHTML = '';
            const experiences = data.experience_analysis || [];
            if (experiences.length > 0) {
                experiences.forEach(exp => {
                    // Sanitize AI relevance output
                    const relevance = parseInt(String(exp.relevance || 0).replace(/[^0-9]/g, ''), 10) || 0;
                    
                    const barColor = relevance >= 70 ? 'bg-emerald-500' : (relevance >= 40 ? 'bg-amber-400' : 'bg-red-400');
                    const textColor = relevance >= 70 ? 'text-emerald-600' : (relevance >= 40 ? 'text-amber-600' : 'text-red-500');
                    const borderColor = relevance >= 70 ? 'border-emerald-200' : (relevance >= 40 ? 'border-amber-200' : 'border-red-200');
                    const bgColor = relevance >= 70 ? 'bg-emerald-50/50' : (relevance >= 40 ? 'bg-amber-50/50' : 'bg-red-50/50');
                    const strokeColor = relevance >= 70 ? '#10b981' : (relevance >= 40 ? '#f59e0b' : '#ef4444');
                    
                    const MathPi = Math.PI;
                    const r = 28;
                    const circum = 2 * MathPi * r;
                    const dashOffset = circum - (circum * relevance / 100);

                    expEl.innerHTML += `
                        <div class="bg-white p-5 rounded-2xl border ${borderColor} ${bgColor} hover:shadow-md transition-all duration-300 mb-4">
                            <div class="flex items-center gap-4 mb-3">
                                <!-- Circle Progress -->
                                <div class="relative w-14 h-14 flex-shrink-0">
                                    <svg class="w-full h-full transform -rotate-90 drop-shadow-sm" viewBox="0 0 64 64">
                                        <circle cx="32" cy="32" r="28" fill="transparent" stroke="#e2e8f0" stroke-width="4"></circle>
                                        <circle class="score-circle-exp" cx="32" cy="32" r="28" fill="transparent" stroke="${strokeColor}" stroke-width="4" stroke-linecap="round"
                                            stroke-dasharray="${circum.toFixed(1)}" stroke-dashoffset="${circum.toFixed(1)}" data-offset="${dashOffset.toFixed(1)}"></circle>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-xs font-black ${textColor}">${relevance}%</span>
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <h5 class="font-bold text-primary text-sm truncate">${exp.role || 'Vị trí'}</h5>
                                        <span class="text-[10px] text-slate-400 font-bold bg-white px-2 py-0.5 rounded border border-slate-100 whitespace-nowrap shadow-sm">${exp.period || ''}</span>
                                    </div>
                                    <p class="text-[11px] font-bold text-slate-500 mb-0.5 truncate">${exp.company || 'Công ty N/A'}</p>
                                    <p class="text-[11px] text-slate-500 italic line-clamp-2 leading-relaxed">"${exp.note || 'Không có bình luận.'}"</p>
                                </div>
                            </div>
                            
                            <!-- Bottom Progress Bar -->
                            <div class="h-1.5 w-full bg-slate-200/70 rounded-full overflow-hidden relative">
                                <div class="skill-bar-fill absolute top-0 left-0 h-full ${barColor} rounded-full" style="width: 0%" data-width="${relevance}%"></div>
                            </div>
                        </div>`;
                });

                // Secure animation trigger
                requestAnimationFrame(() => {
                    setTimeout(() => {
                        document.querySelectorAll('#experience-analysis .skill-bar-fill').forEach(bar => {
                            if(bar.dataset.width) bar.style.width = bar.dataset.width;
                        });
                        document.querySelectorAll('#experience-analysis .score-circle-exp').forEach(circle => {
                            circle.style.transition = 'stroke-dashoffset 1.2s cubic-bezier(0.4, 0, 0.2, 1)';
                            if(circle.dataset.offset) circle.style.strokeDashoffset = circle.dataset.offset;
                        });
                    }, 100);
                });
            } else {
                expEl.innerHTML = '<p class="text-sm text-slate-400 italic">Không có thông tin kinh nghiệm làm việc trong CV</p>';
            }
        }

        function animateNumber(elementId, start, end, duration) {
            const el = document.getElementById(elementId);
            const range = end - start;
            const startTime = performance.now();
            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                el.textContent = Math.round(start + range * eased);
                if (progress < 1) requestAnimationFrame(update);
            }
            requestAnimationFrame(update);
        }

        // ============ CV Analysis ============
        async function runCvAnalysis() {
            const cvId = document.getElementById('cv-analyze-select').value;
            if (!cvId) { alert('Vui lòng chọn CV.'); return; }

            const btn = document.getElementById('btn-analyze-cv');
            btn.disabled = true;
            document.getElementById('btn-analyze-text').textContent = 'Đang phân tích...';
            document.getElementById('btn-analyze-spinner').classList.remove('hidden');
            document.getElementById('cv-results').classList.add('hidden');
            document.getElementById('cv-loading').classList.remove('hidden');

            try {
                const res = await fetch('{{ route("client.ai-analysis.analyze-cv") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                    body: JSON.stringify({ cv_id: cvId })
                });
                const json = await res.json();
                if (!res.ok) throw new Error(json.error || 'Đã xảy ra lỗi.');
                renderCvAnalysis(json.data);
            } catch (e) {
                alert('Lỗi: ' + e.message);
            } finally {
                btn.disabled = false;
                document.getElementById('btn-analyze-text').textContent = 'Phân tích CV bằng AI';
                document.getElementById('btn-analyze-spinner').classList.add('hidden');
                document.getElementById('cv-loading').classList.add('hidden');
            }
        }

        function renderCvAnalysis(data) {
            document.getElementById('cv-results').classList.remove('hidden');

            document.getElementById('cv-candidate-name').textContent = data.candidate_name || 'Ứng viên';
            document.getElementById('cv-job-title').textContent = data.job_title || '';
            document.getElementById('cv-overall').textContent = data.overall_assessment || '';

            // Tech skills
            const techEl = document.getElementById('cv-tech-skills');
            techEl.innerHTML = '';
            ((data.skills?.technical) || []).forEach(s => {
                techEl.innerHTML += `<span class="px-3 py-1.5 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-lg border border-indigo-100">${s}</span>`;
            });
            if (!techEl.innerHTML) techEl.innerHTML = '<p class="text-sm text-slate-400 italic">Không có</p>';

            // Soft skills
            const softEl = document.getElementById('cv-soft-skills');
            softEl.innerHTML = '';
            ((data.skills?.soft) || []).forEach(s => {
                softEl.innerHTML += `<span class="px-3 py-1.5 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-lg border border-emerald-100">${s}</span>`;
            });
            if (!softEl.innerHTML) softEl.innerHTML = '<p class="text-sm text-slate-400 italic">Không có</p>';

            // Experience
            const expEl = document.getElementById('cv-experience');
            expEl.innerHTML = '';
            (data.experience || []).forEach(exp => {
                const highlights = (exp.highlights || []).map(h => `<li class="text-xs text-slate-500">${h}</li>`).join('');
                expEl.innerHTML += `
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex items-center justify-between mb-1">
                            <h5 class="font-bold text-primary text-sm">${exp.company || ''}</h5>
                            <span class="text-xs text-slate-400">${exp.period || ''}</span>
                        </div>
                        <p class="text-xs text-slate-500 mb-2 font-medium">${exp.role || ''}</p>
                        <ul class="space-y-1 list-disc list-inside">${highlights}</ul>
                    </div>`;
            });
            if (!expEl.innerHTML) expEl.innerHTML = '<p class="text-sm text-slate-400 italic">Không có kinh nghiệm được đề cập</p>';

            // Projects
            const projEl = document.getElementById('cv-projects');
            projEl.innerHTML = '';
            (data.projects || []).forEach(p => {
                const techs = (p.tech || []).map(t => `<span class="px-2 py-0.5 bg-cyan-50 text-cyan-700 text-[10px] font-bold rounded">${t}</span>`).join('');
                projEl.innerHTML += `
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <h5 class="font-bold text-primary text-sm mb-1">${p.name || ''}</h5>
                        <p class="text-xs text-slate-500 mb-2">${p.description || ''}</p>
                        <div class="flex flex-wrap gap-1">${techs}</div>
                    </div>`;
            });
            if (!projEl.innerHTML) projEl.innerHTML = '<p class="text-sm text-slate-400 italic">Không có dự án nào</p>';

            // Achievements
            const achEl = document.getElementById('cv-achievements');
            achEl.innerHTML = '';
            (data.achievements || []).forEach(a => {
                achEl.innerHTML += `
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-yellow-500 text-sm mt-0.5">star</span>
                        <span class="text-sm text-slate-600">${a}</span>
                    </li>`;
            });
            if (!achEl.innerHTML) achEl.innerHTML = '<li class="text-sm text-slate-400 italic">Không có</li>';

            // Education
            const eduEl = document.getElementById('cv-education');
            eduEl.innerHTML = '';
            (data.education || []).forEach(e => {
                eduEl.innerHTML += `
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <h5 class="font-bold text-primary text-sm">${e.school || ''}</h5>
                        <p class="text-xs text-slate-500">${e.major || ''} ${e.period ? '(' + e.period + ')' : ''}</p>
                        ${e.gpa ? '<p class="text-xs text-indigo-500 font-bold mt-1">GPA: ' + e.gpa + '</p>' : ''}
                    </div>`;
            });
            if (!eduEl.innerHTML) eduEl.innerHTML = '<p class="text-sm text-slate-400 italic">Không có</p>';
        }
    </script>
</x-app-layout>
