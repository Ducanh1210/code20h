<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <h2 class="text-3xl font-extrabold tracking-tight text-primary">Lộ trình & Phỏng vấn</h2>
                <p class="text-slate-500 text-lg">AI đã cá nhân hóa lộ trình dựa trên kỹ năng còn thiếu của bạn.</p>
            </div>
            <div class="p-1 bg-surface-container rounded-2xl flex gap-1">
                <button id="btn-tab-roadmap" onclick="switchTab('roadmap')" class="px-6 py-2 bg-white shadow-sm rounded-xl text-primary font-bold text-xs uppercase tracking-widest transition-all">Lộ trình học tập</button>
                <button id="btn-tab-interview" onclick="switchTab('interview')" class="px-6 py-2 text-slate-500 font-bold text-xs uppercase tracking-widest hover:bg-white/50 rounded-xl transition-all">Câu hỏi phỏng vấn</button>
            </div>
        </div>
    </x-slot>

    <!-- JD selector bar (Global) -->
    <div class="mb-8">
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-xl">work_history</span>
                </div>
                <div>
                    <h3 class="text-base font-black text-primary">Vị trí ứng tuyển</h3>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Chọn công việc để xem lộ trình học tập</p>
                </div>
            </div>
            <select id="jd-selector" onchange="globalSelectJd(this.value)" class="bg-slate-50 border border-slate-200 text-primary text-sm font-bold rounded-xl px-4 py-2.5 w-full sm:max-w-md outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 truncate">
                <option value="">-- Chọn Mô tả Công việc (JD) --</option>
                @foreach($jds as $jd)
                    <option value="{{ $jd->id }}" {{ (isset($lastMatch) && $lastMatch->job_description_id == $jd->id) ? 'selected' : '' }}>
                        {{ Str::limit($jd->title, 40) }} — {{ $jd->company_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="content-roadmap">
        <div id="rm-main-content">
            <div class="grid grid-cols-12 gap-8 mb-12">
                <!-- Learning Progress -->
                <div class="col-span-12 lg:col-span-4 bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col justify-between relative overflow-hidden group min-h-[320px]">
                    <div class="absolute -right-12 -top-12 w-48 h-48 bg-secondary/5 rounded-full blur-3xl group-hover:bg-secondary/10 transition-colors"></div>
                    <div>
                        <div class="flex items-center justify-between mb-8">
                            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Tiến độ tổng quát</span>
                            <div class="w-12 h-12 bg-secondary/10 rounded-2xl flex items-center justify-center text-secondary">
                                <span class="material-symbols-outlined">analytics</span>
                            </div>
                        </div>
                        <div class="flex items-baseline gap-2 mb-2">
                            <span id="rm-progress-percent" class="text-6xl font-extrabold tracking-tighter text-primary">0%</span>
                            <span class="text-secondary font-bold text-xs uppercase tracking-widest">Hoàn thành</span>
                        </div>
                        <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden mt-6">
                            <div id="rm-progress-bar" class="bg-gradient-to-r from-secondary to-primary h-full w-[0%] score-glow transition-all duration-1000"></div>
                        </div>
                    </div>
                    <p id="rm-time-estimate" class="text-xs font-bold text-slate-400 mt-8 leading-relaxed italic">Chọn JD để tính toán lộ trình học tập.</p>
                </div>

                <!-- Featured Roadmap Section -->
                <div class="col-span-12 lg:col-span-8 bg-primary p-8 rounded-[2rem] text-white relative overflow-hidden shadow-2xl">
                    <span class="material-symbols-outlined absolute right-0 bottom-0 text-white/5 text-[15rem] -rotate-12">model_training</span>
                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Trọng tâm hôm nay</h3>
                            <p id="rm-focus-summary" class="text-primary-fixed opacity-70 max-w-sm mb-6">Xác định các kỹ năng ưu tiên để đạt được mục tiêu ứng tuyển.</p>
                        </div>
                        <div id="rm-focus-container" class="flex gap-4 overflow-x-auto no-scrollbar py-2">
                            <!-- Focus items injection -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline Roadmap -->
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 lg:col-span-12 space-y-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-primary headline">Lộ trình học tập chi tiết</h3>
                        <div id="rm-reanalyze-container"></div>
                    </div>
                    <div id="rm-timeline-container" class="space-y-0 relative before:content-[''] before:absolute before:left-[19px] before:top-4 before:bottom-4 before:w-[2px] before:bg-slate-100">
                        <!-- Step injection here -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Empty/Analysis Placeholder -->
        <div id="rm-placeholder" class="hidden py-24 flex flex-col items-center justify-center text-center bg-white rounded-[2.5rem] border border-slate-100 shadow-sm transition-all">
            <div class="w-24 h-24 bg-indigo-50 text-indigo-600 rounded-[2rem] flex items-center justify-center mb-6 shadow-inner">
                <span class="material-symbols-outlined text-5xl">psychology</span>
            </div>
            <h3 class="text-2xl font-black text-primary mb-2">Chưa có lộ trình học tập</h3>
            <p id="rm-placeholder-text" class="text-slate-500 text-sm max-w-sm mb-8 font-medium">Chúng tôi chưa tìm thấy dữ liệu phân tích giữa CV và JD này. Hãy để AI giúp bạn vạch ra lộ trình ngay!</p>
            <div id="rm-placeholder-action">
                <!-- Action button injection -->
            </div>
        </div>
    </div>
    </div>
    
    <div id="content-interview" class="hidden space-y-6">
        <!-- Quiz container -->
        <div id="iq-container" class="bg-surface-container-low rounded-2xl min-h-[350px] p-5">
            <div class="py-16 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-white border border-slate-100 rounded-2xl flex items-center justify-center mb-5 shadow-sm">
                    <span class="material-symbols-outlined text-4xl text-slate-300">swipe_up</span>
                </div>
                <h4 class="text-lg font-bold text-slate-400 mb-1">Vui lòng chọn một JD</h4>
                <p class="text-slate-400 text-sm max-w-xs">Hãy chọn JD ở trên để bắt đầu luyện phỏng vấn với AI.</p>
            </div>
        </div>
    </div>

    <script>
        const jdsData = @json($jds->keyBy('id'));
        let currentJdId = document.getElementById('jd-selector').value;
        let quizState = { answers: {}, submitted: {} };

        // Initial load
        if (currentJdId) {
            globalSelectJd(currentJdId);
        }

        function switchTab(tab) {
            const btnRoadmap = document.getElementById('btn-tab-roadmap');
            const btnInterview = document.getElementById('btn-tab-interview');
            const contentRoadmap = document.getElementById('content-roadmap');
            const contentInterview = document.getElementById('content-interview');

            if (tab === 'roadmap') {
                btnRoadmap.className = "px-6 py-2 bg-white shadow-sm rounded-xl text-primary font-bold text-xs uppercase tracking-widest transition-all";
                btnInterview.className = "px-6 py-2 text-slate-500 font-bold text-xs uppercase tracking-widest hover:bg-white/50 rounded-xl transition-all";
                contentRoadmap.classList.remove('hidden');
                contentInterview.classList.add('hidden');
            } else {
                btnInterview.className = "px-6 py-2 bg-white shadow-sm rounded-xl text-primary font-bold text-xs uppercase tracking-widest transition-all";
                btnRoadmap.className = "px-6 py-2 text-slate-500 font-bold text-xs uppercase tracking-widest hover:bg-white/50 rounded-xl transition-all";
                contentInterview.classList.remove('hidden');
                contentRoadmap.classList.add('hidden');
            }
        }

        function globalSelectJd(id) {
            currentJdId = id;
            quizState = { answers: {}, submitted: {} };
            
            if (!id) {
                // Reset both tabs to empty state
                document.getElementById('rm-main-content').classList.add('hidden');
                document.getElementById('rm-placeholder').classList.remove('hidden');
                document.getElementById('rm-placeholder-text').innerText = "Vui lòng chọn một công việc ở trên để AI gợi ý lộ trình học tập.";
                document.getElementById('rm-placeholder-action').innerHTML = "";
                
                document.getElementById('iq-container').innerHTML = `
                    <div class="py-16 flex flex-col items-center justify-center text-center">
                        <div class="w-20 h-20 bg-white border border-slate-100 rounded-2xl flex items-center justify-center mb-5 shadow-sm">
                            <span class="material-symbols-outlined text-4xl text-slate-300">swipe_up</span>
                        </div>
                        <h4 class="text-lg font-bold text-slate-400 mb-1">Vui lòng chọn một JD</h4>
                        <p class="text-slate-400 text-sm max-w-xs">Hãy chọn JD ở trên để bắt đầu luyện phỏng vấn với AI.</p>
                    </div>
                `;
                return;
            }

            // Load Roadmap
            fetchRoadmap(id);
            
            // Load Interview (Quiz logic remains same but uses current jd)
            renderQuiz(jdsData[id]);
        }

        async function fetchRoadmap(id) {
            const mainContent = document.getElementById('rm-main-content');
            const placeholder = document.getElementById('rm-placeholder');
            
            // Show loading state in main content if it was visible
            document.getElementById('rm-progress-percent').innerText = "...";
            
            try {
                const res = await fetch(`/ai-analysis/roadmap/${id}`);
                const data = await res.json();
                
                if (data.success) {
                    mainContent.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    renderRoadmap(data);
                    
                    // Add Re-analyze button
                    document.getElementById('rm-reanalyze-container').innerHTML = `
                        <button onclick="startAiAnalysis(${data.cv_id || 'null'}, ${id})" class="px-4 py-2 bg-slate-100 text-slate-600 font-bold rounded-xl text-xs hover:bg-slate-200 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">refresh</span> Phân tích lại
                        </button>
                    `;
                } else if (data.needs_analysis) {
                    mainContent.classList.add('hidden');
                    placeholder.classList.remove('hidden');
                    document.getElementById('rm-placeholder-text').innerText = data.error;
                    document.getElementById('rm-placeholder-action').innerHTML = `
                        <button onclick="startAiAnalysis(${data.cv_id}, ${data.jd_id})" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-all flex items-center gap-2 shadow-lg shadow-indigo-100 uppercase tracking-widest text-xs">
                            <span class="material-symbols-outlined text-lg">bolt</span> Phân tích & Tạo lộ trình ngay
                        </button>
                    `;
                } else {
                    mainContent.classList.add('hidden');
                    placeholder.classList.remove('hidden');
                    document.getElementById('rm-placeholder-text').innerText = data.error || "Lỗi không xác định.";
                }
            } catch (e) {
                console.error(e);
            }
        }

        async function startAiAnalysis(cv_id, jd_id) {
            const btn = document.querySelector('#rm-placeholder-action button') || document.querySelector('#rm-reanalyze-container button');
            const originalText = btn.innerHTML;
            btn.innerHTML = `<span class="material-symbols-outlined animate-spin text-lg">refresh</span> AI đang phân tích...`;
            btn.disabled = true;
            btn.classList.add('opacity-70');

            try {
                const res = await fetch(`/ai-analysis/compare`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ cv_id, jd_id })
                });
                const data = await res.json();
                if (data.success) {
                    fetchRoadmap(jd_id);
                } else {
                    alert(data.error || "Có lỗi xảy ra.");
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    btn.classList.remove('opacity-70');
                }
            } catch (e) {
                alert("Lỗi hệ thống. Thử lại sau.");
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        }

        function renderRoadmap(data) {
            const rm = data.roadmap;
            // Update Progress
            const progress = rm.current_progress || 0;
            document.getElementById('rm-progress-percent').innerText = progress + "%";
            document.getElementById('rm-progress-bar').style.width = progress + "%";
            document.getElementById('rm-time-estimate').innerText = `Bạn cần khoảng ${rm.estimated_time || '...'} để hoàn thành các kỹ năng còn thiếu.`;
            
            // Update Focus
            document.getElementById('rm-focus-summary').innerText = `Kỹ năng ưu tiên hôm nay: ${rm.focus_today?.join(' & ') || 'Chưa xác định'}`;
            const focusContainer = document.getElementById('rm-focus-container');
            focusContainer.innerHTML = '';
            (rm.focus_today || []).forEach((skill, idx) => {
                focusContainer.innerHTML += `
                    <div class="min-w-[180px] p-4 bg-white/10 backdrop-blur-md rounded-2xl border border-white/10 hover:bg-white/20 transition-all cursor-pointer">
                        <span class="material-symbols-outlined mb-3 text-secondary-fixed">${idx === 0 ? 'monitoring' : 'auto_awesome_motion'}</span>
                        <p class="font-bold text-sm truncate">${skill}</p>
                        <p class="text-[10px] opacity-60 font-bold uppercase tracking-widest">Trọng tâm học tập</p>
                    </div>
                `;
            });

            // Update Timeline
            const timelineContainer = document.getElementById('rm-timeline-container');
            timelineContainer.innerHTML = '';
            (rm.steps || []).forEach((step, idx) => {
                const isActive = step.status === 'active';
                const isCompleted = step.status === 'completed';
                
                let iconClass = "bg-slate-100 text-slate-400";
                let icon = "schedule";
                let stepClass = "p-6 bg-surface-container-low rounded-[2rem]";
                
                if (isCompleted) {
                    iconClass = "bg-secondary text-white";
                    icon = "check";
                } else if (isActive) {
                    iconClass = "bg-white border-4 border-secondary text-secondary";
                    icon = "play_arrow";
                    stepClass = "p-8 bg-white shadow-2xl shadow-secondary/10 rounded-[2.5rem] border border-secondary/20";
                }

                timelineContainer.innerHTML += `
                    <div class="relative pl-12 pb-10 group">
                        <div class="absolute left-0 top-1 w-10 h-10 rounded-full ${iconClass} flex items-center justify-center z-10 ring-4 ring-surface">
                            <span class="material-symbols-outlined text-xl">${icon}</span>
                        </div>
                        <div class="${stepClass} group-hover:bg-white group-hover:shadow-xl transition-all duration-300 border border-transparent group-hover:border-slate-100">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="font-bold text-primary text-lg headline">${step.title}</h4>
                                    ${step.duration ? `<span class="inline-flex items-center gap-1 text-[10px] font-bold text-slate-400 bg-slate-50 px-2 py-0.5 rounded mt-1 border border-slate-100"><span class="material-symbols-outlined text-[12px]">schedule</span> ${step.duration}</span>` : ''}
                                </div>
                                <span class="text-[10px] font-extrabold px-3 py-1 rounded-full uppercase leading-none ${isCompleted ? 'text-secondary bg-secondary/10' : (isActive ? 'text-primary bg-primary-fixed' : 'text-slate-400 bg-slate-100')}">
                                    ${isActive ? '<span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse inline-block mr-1"></span> Đang học' : (isCompleted ? 'Hoàn thành' : 'Chờ học')}
                                </span>
                            </div>
                            <p class="text-sm text-slate-500 mb-4 leading-relaxed">${step.description}</p>
                            
                            ${step.topics && step.topics.length > 0 ? `
                                <div class="flex flex-wrap gap-1.5 mb-4">
                                    ${step.topics.map(topic => `<span class="px-2 py-0.5 bg-indigo-50/50 text-indigo-500 text-[10px] font-bold rounded-md border border-indigo-100/50"># ${topic}</span>`).join('')}
                                </div>
                            ` : ''}

                            ${isActive ? `
                                <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden mt-4">
                                    <div class="h-full bg-secondary w-[30%] rounded-full score-glow animate-pulse"></div>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                `;
            });
        }

        async function generateInterviewQuestions(btn) {
            if(!currentJdId) return;
            const jd = jdsData[currentJdId];
            const originalText = btn.innerHTML;
            btn.innerHTML = `<span class="material-symbols-outlined animate-spin text-sm">refresh</span> AI đang soạn đề...`;
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');

            try {
                const res = await fetch(`/jobs/${jd.id}/generate-questions`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
                    }
                });
                const data = await res.json();
                if(data.success) {
                    jdsData[jd.id].interview_questions = data.data;
                    quizState = { answers: {}, submitted: {} };
                    renderQuiz(jdsData[jd.id]);
                } else {
                    alert(data.error || 'Có lỗi xảy ra.');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    btn.classList.remove('opacity-70', 'cursor-not-allowed');
                }
            } catch(e) {
                alert('Có lỗi mạng hoặc máy chủ. Thử lại sau.');
                btn.innerHTML = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-70', 'cursor-not-allowed');
            }
        }

        function renderQuiz(jd) {
            const container = document.getElementById('iq-container');
            if(!jd.interview_questions || Object.keys(jd.interview_questions).length === 0) {
                container.innerHTML = `
                    <div class="py-16 flex flex-col items-center justify-center text-center">
                        <div class="w-20 h-20 bg-indigo-50 border border-indigo-100 rounded-2xl flex items-center justify-center mb-5">
                            <span class="material-symbols-outlined text-4xl text-indigo-400">smart_toy</span>
                        </div>
                        <h4 class="text-xl font-black text-primary mb-2">Bắt đầu luyện phỏng vấn</h4>
                        <p class="text-slate-500 text-sm mb-6 font-medium max-w-sm">AI sẽ soạn bộ đề trắc nghiệm & điền chỗ trống từ JD "<strong>${jd.title}</strong>"</p>
                        <button onclick="generateInterviewQuestions(this)" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2 uppercase tracking-widest text-xs">
                            <span class="material-symbols-outlined text-lg">auto_awesome</span> Tạo bộ đề luyện tập
                        </button>
                    </div>
                `;
                return;
            }
            // ... (keep the rest of renderQuiz and other quiz helper functions)

            const data = jd.interview_questions;
            const levels = [
                { key: 'easy', title: 'Cơ bản', color: 'emerald', icon: 'sentiment_satisfied', gradient: 'from-emerald-500 to-teal-400' },
                { key: 'medium', title: 'Trung bình', color: 'amber', icon: 'psychology', gradient: 'from-amber-500 to-orange-400' },
                { key: 'hard', title: 'Nâng cao', color: 'red', icon: 'local_fire_department', gradient: 'from-red-500 to-rose-400' }
            ];

            let totalQ = 0;
            levels.forEach(l => { if(data[l.key]) totalQ += data[l.key].length; });

            let html = '';

            // Compact score header
            html += `
                <div class="bg-white rounded-2xl p-4 mb-6 shadow-sm border border-slate-100 flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">emoji_events</span>
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-sm font-black text-primary truncate">${jd.title}</h3>
                            <p class="text-[10px] text-slate-400 font-medium">${totalQ} câu · Trắc nghiệm & Điền chỗ trống</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <div class="text-right">
                            <span class="text-xl font-black text-primary" id="score-num">0</span>
                            <span class="text-xs text-slate-400 font-bold">/${totalQ}</span>
                        </div>
                        <div class="w-11 h-11 relative">
                            <svg class="w-11 h-11 -rotate-90" viewBox="0 0 36 36">
                                <circle cx="18" cy="18" r="15.5" fill="none" stroke="#f1f5f9" stroke-width="3"/>
                                <circle id="score-ring" cx="18" cy="18" r="15.5" fill="none" stroke="#6366f1" stroke-width="3" stroke-dasharray="97.4" stroke-dashoffset="97.4" stroke-linecap="round" style="transition: stroke-dashoffset 0.6s ease"/>
                            </svg>
                        </div>
                    </div>
                </div>
            `;

            // Questions by level
            levels.forEach(lvl => {
                const qs = data[lvl.key];
                if(!qs || qs.length === 0) return;

                html += `
                    <div class="mb-8">
                        <div class="flex items-center gap-2.5 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br ${lvl.gradient} text-white flex items-center justify-center">
                                <span class="material-symbols-outlined text-base">${lvl.icon}</span>
                            </div>
                            <h4 class="font-black text-primary text-base">${lvl.title}</h4>
                            <span class="text-[10px] text-slate-400 font-bold">${qs.length} câu</span>
                        </div>
                        <div class="grid gap-4">
                `;

                qs.forEach((q, i) => {
                    const qid = `${lvl.key}_${i}`;
                    if(q.format === 'multiple_choice') {
                        html += renderMCQ(q, qid, lvl);
                    } else if(q.format === 'fill_blank') {
                        html += renderFillBlank(q, qid, lvl);
                    }
                });

                html += `</div></div>`;
            });

            // Footer
            html += `
                <div class="flex items-center justify-center gap-3 mt-6 pt-5 border-t border-slate-100">
                    <button onclick="generateInterviewQuestions(this)" class="px-5 py-2.5 bg-slate-100 text-slate-600 font-bold rounded-xl text-xs hover:bg-slate-200 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">refresh</span> Đề mới
                    </button>
                    <button onclick="resetQuiz()" class="px-5 py-2.5 bg-indigo-50 text-indigo-600 font-bold rounded-xl text-xs hover:bg-indigo-100 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">restart_alt</span> Làm lại
                    </button>
                </div>
            `;

            container.innerHTML = html;
        }

        function renderMCQ(q, qid, lvl) {
            const opts = q.options || {};
            let optHtml = '';
            ['A','B','C','D'].forEach(k => {
                if(!opts[k]) return;
                optHtml += `
                    <button id="opt-${qid}-${k}" onclick="selectMCQ('${qid}','${k}','${q.correct}')" 
                        class="w-full text-left p-3 rounded-xl border-2 border-slate-100 hover:border-indigo-300 hover:bg-indigo-50/40 transition-all flex items-center gap-3 mcq-option">
                        <span class="w-7 h-7 rounded-lg bg-slate-100 text-slate-500 font-bold text-xs flex items-center justify-center shrink-0">${k}</span>
                        <span class="text-sm font-medium text-slate-700">${opts[k]}</span>
                    </button>
                `;
            });

            return `
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100" id="card-${qid}">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-[9px] font-black text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md uppercase tracking-wider">Trắc nghiệm</span>
                        <span class="text-[9px] font-bold text-slate-400 bg-slate-50 px-2 py-0.5 rounded-md uppercase tracking-wider">${q.type || 'Technical'}</span>
                    </div>
                    <p class="font-bold text-primary text-sm leading-relaxed mb-4">${q.question}</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2" id="opts-${qid}">
                        ${optHtml}
                    </div>
                    <div id="explain-${qid}" class="hidden mt-4 p-3 rounded-xl border text-sm leading-relaxed"></div>
                </div>
            `;
        }

        function renderFillBlank(q, qid, lvl) {
            const parts = q.question.split('_____');
            let sentenceHtml = '';
            if(parts.length >= 2) {
                sentenceHtml = `<span>${parts[0]}</span><span class="text-indigo-500 font-black mx-1">[ . . . ]</span><span>${parts.slice(1).join('')}</span>`;
            } else {
                sentenceHtml = `<span>${q.question}</span> <span class="text-indigo-500 font-black ml-1">[ . . . ]</span>`;
            }

            return `
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100" id="card-${qid}">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-[9px] font-black text-teal-600 bg-teal-50 px-2 py-0.5 rounded-md uppercase tracking-wider">Điền chỗ trống</span>
                        <span class="text-[9px] font-bold text-slate-400 bg-slate-50 px-2 py-0.5 rounded-md uppercase tracking-wider">${q.type || 'Technical'}</span>
                    </div>
                    <p class="font-semibold text-primary text-sm leading-relaxed mb-4">${sentenceHtml}</p>
                    <div class="flex items-center gap-2" id="fill-row-${qid}">
                        <input type="text" id="input-${qid}" placeholder="Nhập đáp án..." 
                            class="flex-1 max-w-[240px] bg-slate-50 border-2 border-dashed border-indigo-200 rounded-xl px-3 py-2 text-sm text-indigo-700 font-bold outline-none focus:border-indigo-400 focus:bg-white transition-all" 
                            onkeydown="if(event.key==='Enter') checkFillBlank('${qid}')">
                        <button onclick="checkFillBlank('${qid}')" id="btn-check-${qid}" class="px-4 py-2 bg-indigo-600 text-white font-bold rounded-xl text-xs hover:bg-indigo-700 transition-all flex items-center gap-1.5 shrink-0">
                            <span class="material-symbols-outlined text-sm">check</span> Kiểm tra
                        </button>
                    </div>
                    <div id="explain-${qid}" class="hidden mt-4 p-3 rounded-xl border text-sm leading-relaxed"></div>
                </div>
            `;
        }

        function selectMCQ(qid, selected, correct) {
            if(quizState.submitted[qid]) return;
            quizState.submitted[qid] = true;

            const isCorrect = selected === correct;
            quizState.answers[qid] = isCorrect;

            ['A','B','C','D'].forEach(k => {
                const el = document.getElementById(`opt-${qid}-${k}`);
                if(!el) return;
                el.onclick = null;
                el.classList.remove('hover:border-indigo-300', 'hover:bg-indigo-50/40');
                el.classList.add('cursor-default');

                if(k === correct) {
                    el.classList.remove('border-slate-100');
                    el.classList.add('border-emerald-400', 'bg-emerald-50');
                    el.querySelector('span:first-child').classList.remove('bg-slate-100','text-slate-500');
                    el.querySelector('span:first-child').classList.add('bg-emerald-500','text-white');
                } else if(k === selected && !isCorrect) {
                    el.classList.remove('border-slate-100');
                    el.classList.add('border-red-300', 'bg-red-50/50');
                    el.querySelector('span:first-child').classList.remove('bg-slate-100','text-slate-500');
                    el.querySelector('span:first-child').classList.add('bg-red-400','text-white');
                } else {
                    el.classList.add('opacity-40');
                }
            });

            const jd = jdsData[currentJdId];
            const parts = qid.split('_');
            const q = jd.interview_questions[parts[0]][parseInt(parts[1])];

            const explainEl = document.getElementById(`explain-${qid}`);
            explainEl.classList.remove('hidden');
            if(isCorrect) {
                explainEl.className = 'mt-4 p-3 rounded-xl border border-emerald-200 bg-emerald-50/60 text-sm leading-relaxed';
                explainEl.innerHTML = `<span class="font-black text-emerald-700 text-xs">✓ Chính xác!</span> <span class="text-emerald-800">${q.explanation || ''}</span>`;
            } else {
                explainEl.className = 'mt-4 p-3 rounded-xl border border-red-200 bg-red-50/60 text-sm leading-relaxed';
                explainEl.innerHTML = `<span class="font-black text-red-600 text-xs">✗ Sai! Đáp án: ${correct}</span> <span class="text-red-800">${q.explanation || ''}</span>`;
            }
            updateScore();
        }

        function checkFillBlank(qid) {
            if(quizState.submitted[qid]) return;

            const input = document.getElementById(`input-${qid}`);
            const userAnswer = (input.value || '').trim().toLowerCase();
            if(!userAnswer) { input.focus(); return; }

            quizState.submitted[qid] = true;

            const parts = qid.split('_');
            const jd = jdsData[currentJdId];
            const q = jd.interview_questions[parts[0]][parseInt(parts[1])];
            const correctAnswer = (q.answer || '').trim().toLowerCase();

            const isCorrect = userAnswer === correctAnswer || correctAnswer.includes(userAnswer) || userAnswer.includes(correctAnswer);
            quizState.answers[qid] = isCorrect;

            input.disabled = true;
            const checkBtn = document.getElementById(`btn-check-${qid}`);
            if(checkBtn) checkBtn.remove();

            if(isCorrect) {
                input.classList.remove('border-indigo-200', 'bg-slate-50');
                input.classList.add('border-emerald-400', 'bg-emerald-50', 'text-emerald-700');
            } else {
                input.classList.remove('border-indigo-200', 'bg-slate-50');
                input.classList.add('border-red-300', 'bg-red-50', 'text-red-600', 'line-through');
                const row = document.getElementById(`fill-row-${qid}`);
                row.insertAdjacentHTML('beforeend', `<span class="text-xs font-black text-emerald-600 bg-emerald-50 px-2.5 py-1.5 rounded-lg border border-emerald-200 shrink-0">${q.answer}</span>`);
            }

            const explainEl = document.getElementById(`explain-${qid}`);
            explainEl.classList.remove('hidden');
            if(isCorrect) {
                explainEl.className = 'mt-4 p-3 rounded-xl border border-emerald-200 bg-emerald-50/60 text-sm leading-relaxed';
                explainEl.innerHTML = `<span class="font-black text-emerald-700 text-xs">✓ Xuất sắc!</span> <span class="text-emerald-800">${q.explanation || ''}</span>`;
            } else {
                explainEl.className = 'mt-4 p-3 rounded-xl border border-red-200 bg-red-50/60 text-sm leading-relaxed';
                explainEl.innerHTML = `<span class="font-black text-red-600 text-xs">✗ Chưa đúng! Đáp án: <strong>${q.answer}</strong></span> <span class="text-red-800">${q.explanation || ''}</span>`;
            }
            updateScore();
        }

        function updateScore() {
            const totalSubmitted = Object.keys(quizState.submitted).length;
            const totalCorrect = Object.values(quizState.answers).filter(v => v).length;

            const jd = jdsData[currentJdId];
            const data = jd.interview_questions;
            let totalQ = 0;
            ['easy','medium','hard'].forEach(k => { if(data[k]) totalQ += data[k].length; });

            document.getElementById('score-num').textContent = totalSubmitted;

            const ring = document.getElementById('score-ring');
            const circumference = 97.4;
            const progress = totalQ > 0 ? (totalSubmitted / totalQ) : 0;
            ring.style.strokeDashoffset = circumference - (circumference * progress);

            const accuracy = totalSubmitted > 0 ? (totalCorrect / totalSubmitted) : 0;
            if(accuracy >= 0.7) ring.style.stroke = '#10b981';
            else if(accuracy >= 0.4) ring.style.stroke = '#f59e0b';
            else if(totalSubmitted > 0) ring.style.stroke = '#ef4444';

            if(totalSubmitted === totalQ && totalQ > 0) {
                showResults(totalCorrect, totalQ);
            }
        }

        function showResults(correct, total) {
            const pct = Math.round((correct / total) * 100);
            let emoji = '🎉', msg = 'Tuyệt vời!', barColor = 'emerald';
            if(pct < 50) { emoji = '💪'; msg = 'Cần cố gắng thêm!'; barColor = 'red'; }
            else if(pct < 80) { emoji = '👍'; msg = 'Khá tốt!'; barColor = 'amber'; }

            const container = document.getElementById('iq-container');
            const resultHtml = `
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 mb-6 text-center quiz-fade-in">
                    <div class="text-5xl mb-3">${emoji}</div>
                    <h3 class="text-2xl font-black text-primary mb-1">${msg}</h3>
                    <p class="text-slate-500 text-sm font-medium mb-4">Bạn trả lời đúng <strong>${correct}/${total}</strong> câu (${pct}%)</p>
                    <div class="w-full max-w-[200px] mx-auto bg-slate-100 h-3 rounded-full overflow-hidden mb-5">
                        <div class="h-full bg-gradient-to-r from-${barColor}-400 to-${barColor}-500 rounded-full" style="width: ${pct}%; transition: width 1s ease"></div>
                    </div>
                    <div class="flex justify-center gap-3">
                        <button onclick="resetQuiz()" class="px-5 py-2.5 bg-indigo-600 text-white font-bold rounded-xl text-xs hover:bg-indigo-700 transition-all flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">restart_alt</span> Làm lại
                        </button>
                        <button onclick="generateInterviewQuestions(this)" class="px-5 py-2.5 bg-slate-100 text-slate-600 font-bold rounded-xl text-xs hover:bg-slate-200 transition-all flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">refresh</span> Đề mới
                        </button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('afterbegin', resultHtml);
            container.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function resetQuiz() {
            quizState = { answers: {}, submitted: {} };
            if(currentJdId) renderQuiz(jdsData[currentJdId]);
        }
    </script>

    <style>
        @keyframes quizFadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .quiz-fade-in { animation: quizFadeIn 0.35s ease forwards; }
    </style>
</x-app-layout>


