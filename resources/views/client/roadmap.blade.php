<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <h2 class="text-3xl font-extrabold tracking-tight text-primary">Lộ trình & Phỏng vấn</h2>
                <p class="text-slate-500 text-lg">AI đã cá nhân hóa lộ trình dựa trên kỹ năng còn thiếu của bạn.</p>
            </div>
            <div class="p-1 bg-surface-container rounded-2xl flex gap-1">
                <button class="px-6 py-2 bg-white shadow-sm rounded-xl text-primary font-bold text-xs uppercase tracking-widest transition-all">Lộ trình học tập</button>
                <button class="px-6 py-2 text-slate-500 font-bold text-xs uppercase tracking-widest hover:bg-white/50 rounded-xl transition-all">Câu hỏi phỏng vấn</button>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-12 gap-8 mb-12">
        <!-- Learning Progress (Reference 3.blade.php) -->
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
                    <span class="text-6xl font-extrabold tracking-tighter text-primary">64%</span>
                    <span class="text-secondary font-bold text-xs uppercase tracking-widest">Hoàn thành</span>
                </div>
                <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden mt-6">
                    <div class="bg-gradient-to-r from-secondary to-primary h-full w-[64%] score-glow"></div>
                </div>
            </div>
            <p class="text-xs font-bold text-slate-400 mt-8 leading-relaxed italic">"Bạn cần thêm khoảng <span class="text-primary tracking-tight">12 giờ</span> để hoàn thành các kỹ năng còn thiếu."</p>
        </div>

        <!-- Featured Roadmap Section -->
        <div class="col-span-12 lg:col-span-8 bg-primary p-8 rounded-[2rem] text-white relative overflow-hidden shadow-2xl">
            <span class="material-symbols-outlined absolute right-0 bottom-0 text-white/5 text-[15rem] -rotate-12">model_training</span>
            <div class="relative z-10 h-full flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-2">Trọng tâm hôm nay</h3>
                    <p class="text-primary-fixed opacity-70 max-w-sm mb-6">Nâng cao kỹ năng Phân tích dữ liệu & Thiết kế hệ thống thông minh.</p>
                </div>
                <div class="flex gap-4 overflow-x-auto no-scrollbar py-2">
                    <div class="min-w-[180px] p-4 bg-white/10 backdrop-blur-md rounded-2xl border border-white/10 hover:bg-white/20 transition-all cursor-pointer">
                        <span class="material-symbols-outlined mb-3 text-secondary-fixed">monitoring</span>
                        <p class="font-bold text-sm">User Metrics</p>
                        <p class="text-[10px] opacity-60 font-bold uppercase tracking-widest">45 phút bài tập</p>
                    </div>
                    <div class="min-w-[180px] p-4 bg-white/10 backdrop-blur-md rounded-2xl border border-white/10 hover:bg-white/20 transition-all cursor-pointer">
                        <span class="material-symbols-outlined mb-3 text-secondary-fixed">auto_awesome_motion</span>
                        <p class="font-bold text-sm">System Design</p>
                        <p class="text-[10px] opacity-60 font-bold uppercase tracking-widest">1h 20 phút video</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline Roadmap -->
    <div class="grid grid-cols-12 gap-8">
        <div class="col-span-12 lg:col-span-7 space-y-8">
            <h3 class="text-2xl font-bold text-primary headline">Lộ trình chi tiết</h3>
            <div class="space-y-0 relative before:content-[''] before:absolute before:left-[19px] before:top-4 before:bottom-4 before:w-[2px] before:bg-slate-100">
                <!-- Step 1 (Completed) -->
                <div class="relative pl-12 pb-10 group">
                    <div class="absolute left-0 top-1 w-10 h-10 rounded-full bg-secondary text-white flex items-center justify-center z-10 ring-4 ring-surface">
                        <span class="material-symbols-outlined text-xl">check</span>
                    </div>
                    <div class="p-6 bg-surface-container-low rounded-[2rem] group-hover:bg-white group-hover:shadow-xl transition-all duration-300 border border-transparent group-hover:border-slate-100">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="font-bold text-primary text-lg headline">Kỹ năng nghiên cứu (User Research)</h4>
                            <span class="text-[10px] font-extrabold text-secondary bg-secondary/10 px-3 py-1 rounded-full uppercase leading-none">Hoàn thành</span>
                        </div>
                        <p class="text-sm text-slate-500 mb-4 leading-relaxed">Phân tích các phương pháp phỏng vấn, khảo sát nhu cầu người dùng.</p>
                    </div>
                </div>
                <!-- Step 2 (Active) -->
                <div class="relative pl-12 pb-10 group">
                    <div class="absolute left-0 top-1 w-10 h-10 rounded-full bg-white border-4 border-secondary text-secondary flex items-center justify-center z-10 ring-4 ring-surface">
                        <span class="material-symbols-outlined text-xl">play_arrow</span>
                    </div>
                    <div class="p-8 bg-white shadow-2xl shadow-secondary/10 rounded-[2.5rem] border border-secondary/20">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="font-bold text-primary text-xl headline">Hệ thống thiết kế (Design Systems)</h4>
                            <div class="flex items-center gap-2 text-[10px] font-extrabold text-primary px-3 py-1 bg-primary-fixed rounded-full">
                                <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse"></span> ĐANG HỌC
                            </div>
                        </div>
                        <p class="text-sm text-slate-500 mb-6 leading-relaxed">Xây dựng quy chuẩn component, màu sắc và typography chuyên nghiệp.</p>
                        <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-secondary w-[40%] rounded-full score-glow"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar: Interview Questions -->
        <div class="col-span-12 lg:col-span-5">
            <div class="bg-surface-container-low p-8 rounded-[2rem] border border-slate-100 sticky top-24">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-bold text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">question_answer</span> Câu hỏi phỏng vấn
                    </h3>
                    <button class="text-[10px] font-extrabold text-secondary uppercase tracking-widest hover:underline">Xem 24 câu hỏi</button>
                </div>
                <div class="space-y-4">
                    <div class="p-5 bg-white rounded-[1.5rem] hover:translate-x-1 transition-all group cursor-pointer border border-transparent hover:border-slate-100">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 text-[10px] font-extrabold rounded uppercase tracking-tighter leading-none">Trung bình</span>
                        </div>
                        <p class="text-sm font-bold text-primary leading-snug group-hover:text-secondary transition-colors underline-offset-2">"Làm thế nào để bạn đo lường thành công của một tính năng mới?"</p>
                    </div>
                    <div class="p-5 bg-white border-l-4 border-error rounded-xl hover:translate-x-1 transition-all group cursor-pointer">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2 py-0.5 bg-red-100 text-error text-[10px] font-extrabold rounded uppercase tracking-tighter leading-none">Khó</span>
                        </div>
                        <p class="text-sm font-bold text-primary leading-snug group-hover:text-error transition-colors underline-offset-2">"Quy trình thiết kế cho hệ thống quy mô hàng triệu người dùng?"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
