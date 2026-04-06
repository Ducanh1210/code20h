<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight text-primary mb-2">Phân tích mức độ phù hợp AI</h2>
                <p class="text-slate-500 max-w-lg">So sánh CV của bạn với mô tả công việc (JD) để tìm ra khoảng cách kỹ năng.</p>
            </div>
            <div class="p-1 bg-surface-container rounded-2xl flex gap-1">
                <button class="px-4 py-2 bg-white shadow-sm rounded-xl text-primary font-bold text-xs uppercase tracking-widest">Phân tích CV</button>
                <button class="px-4 py-2 text-slate-500 font-bold text-xs uppercase tracking-widest hover:bg-white/50 rounded-xl transition-all">Gợi ý chỉnh sửa</button>
            </div>
        </div>
    </x-slot>

    <!-- Score Header (Reference 2.blade.php) -->
    <div class="grid grid-cols-12 gap-8 mb-12">
        <div class="col-span-12 lg:col-span-4 bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col items-center justify-center relative overflow-hidden group text-center">
            <div class="absolute -right-12 -top-12 w-48 h-48 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/10 transition-colors"></div>
            <p class="text-[10px] font-extrabold text-slate-400 mb-6 uppercase tracking-widest">Điểm phù hợp tổng quát</p>
            <div class="relative w-48 h-48 mb-6">
                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                    <circle class="text-slate-100" cx="50" cy="50" fill="transparent" r="45" stroke="currentColor" stroke-dasharray="282.7" stroke-dashoffset="0" stroke-width="10"></circle>
                    <circle class="text-secondary score-glow" cx="50" cy="50" fill="transparent" r="45" stroke="currentColor" stroke-dasharray="282.7" stroke-dashoffset="33.9" stroke-linecap="round" stroke-width="10"></circle>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-5xl font-extrabold text-primary">88</span>
                </div>
            </div>
            <div class="px-6 py-2 bg-green-100 text-green-700 text-xs font-extrabold rounded-full uppercase tracking-tighter">PHÙ HỢP CAO</div>
        </div>

        <!-- AI Feedback Bento -->
        <div class="col-span-12 lg:col-span-8 grid grid-cols-2 gap-6">
            <div class="p-6 bg-primary text-white rounded-[2rem] shadow-xl relative overflow-hidden">
                <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-white/5 text-[10rem]">trending_up</span>
                <p class="text-[10px] font-bold text-primary-fixed opacity-60 uppercase mb-4 tracking-widest">Điểm mạnh của bạn</p>
                <h4 class="text-xl font-bold mb-4">Kỹ năng kỹ thuật vượt trội</h4>
                <p class="text-sm opacity-80 leading-relaxed">CV của bạn đáp ứng đầy đủ yêu cầu về <strong>React</strong> và <strong>Node.js</strong> mà nhà tuyển dụng yêu cầu.</p>
            </div>
            <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase mb-4 tracking-widest">Cần cải thiện</p>
                <h4 class="text-xl font-bold text-primary mb-4">Kỹ năng mềm & Leadership</h4>
                <p class="text-sm text-slate-500 leading-relaxed italic">"JD nhấn mạnh vào khả năng quản lý đội nhóm, điều này chưa được nêu rõ trong CV hiện tại của bạn."</p>
            </div>
        </div>
    </div>

    <!-- Details Section -->
    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
        <h3 class="text-2xl font-bold text-primary mb-8 headline">Chi tiết đối sánh kỹ năng</h3>
        <div class="space-y-8">
            <div class="grid grid-cols-2 gap-8 items-center pb-6 border-b border-slate-50">
                <div>
                    <h4 class="font-bold text-primary text-sm mb-1 uppercase tracking-wider">Frontend Development</h4>
                    <p class="text-xs text-slate-400">Yêu cầu: React, Next.js, Tailwind CSS</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex-1 h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-secondary w-[95%] rounded-full"></div>
                    </div>
                    <span class="text-sm font-bold text-secondary">95%</span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8 items-center pb-6 border-b border-slate-50">
                <div>
                    <h4 class="font-bold text-primary text-sm mb-1 uppercase tracking-wider">Cloud & DevOps</h4>
                    <p class="text-xs text-slate-400">Yêu cầu: AWS, Docker, Kubernetes</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex-1 h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-amber-400 w-[60%] rounded-full"></div>
                    </div>
                    <span class="text-sm font-bold text-amber-500">60%</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
