<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <h2 class="text-3xl font-extrabold tracking-tight text-primary">Quản lý CV</h2>
                <p class="text-slate-500 text-lg">Tối ưu hóa hành trình sự nghiệp với trợ lý AI chuyên nghiệp.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-outline-variant/30 text-primary font-semibold rounded-xl hover:bg-slate-50 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-xl">upload</span>
                    Tải CV lên
                </button>
                <button class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-bold rounded-xl hover:shadow-xl transition-all">
                    <span class="material-symbols-outlined text-xl">add</span>
                    Tạo CV mới
                </button>
            </div>
        </div>
    </x-slot>

    <!-- Filters Bar -->
    <div class="flex flex-wrap items-center gap-4 mb-8 bg-surface-container-low/50 p-4 rounded-3xl">
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-100">
            <span class="material-symbols-outlined text-slate-400 text-sm">calendar_today</span>
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Ngày tạo:</span>
            <select class="bg-transparent border-none text-xs font-bold p-0 pr-6 focus:ring-0">
                <option>Tất cả thời gian</option>
                <option>7 ngày qua</option>
                <option>30 ngày qua</option>
            </select>
        </div>
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-100">
            <span class="material-symbols-outlined text-slate-400 text-sm">filter_list</span>
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Vị trí:</span>
            <select class="bg-transparent border-none text-xs font-bold p-0 pr-6 focus:ring-0">
                <option>Tất cả công việc</option>
                <option>Product Manager</option>
                <option>UI/UX Designer</option>
                <option>Software Engineer</option>
            </select>
        </div>
        <div class="ml-auto text-xs font-bold text-slate-500 uppercase tracking-widest">
            Hiển thị <span class="text-primary">06</span> bản thảo CV
        </div>
    </div>

    <!-- CV Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1: Featured CV -->
        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-outline-variant/10 hover:shadow-xl transition-all group flex flex-col">
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-16 bg-primary/5 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-3xl">description</span>
                </div>
                <div class="flex flex-col items-end gap-2">
                    <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-extrabold rounded-full uppercase tracking-tight">Khớp 92%</span>
                    <button class="w-8 h-8 rounded-full hover:bg-slate-100 flex items-center justify-center transition-colors">
                        <span class="material-symbols-outlined text-slate-400">more_vert</span>
                    </button>
                </div>
            </div>
            <div class="mb-6">
                <h3 class="text-xl font-bold text-primary mb-1 group-hover:text-secondary transition-colors headline">Senior Product Designer</h3>
                <p class="text-slate-400 text-xs flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">schedule</span>
                    Cập nhật 2 giờ trước
                </p>
            </div>
            <div class="flex items-center gap-2 mb-8 flex-wrap">
                <span class="px-2 py-1 bg-surface-container text-slate-600 text-[10px] font-bold uppercase rounded-lg">Figma</span>
                <span class="px-2 py-1 bg-surface-container text-slate-600 text-[10px] font-bold uppercase rounded-lg">AI Integration</span>
            </div>
            <div class="mt-auto pt-4 flex items-center justify-between border-t border-slate-50">
                <button class="text-primary font-bold text-xs flex items-center gap-2 group/btn uppercase tracking-wider">
                    Xem chi tiết
                    <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                </button>
                <div class="flex -space-x-2">
                    <div class="w-7 h-7 rounded-full bg-secondary-fixed text-secondary flex items-center justify-center text-[10px] font-bold border-2 border-white uppercase">AI</div>
                    <div class="w-7 h-7 rounded-full bg-tertiary-fixed text-tertiary flex items-center justify-center text-[10px] font-bold border-2 border-white uppercase">DS</div>
                </div>
            </div>
        </div>

        <!-- Add New Action Card -->
        <button class="border-2 border-dashed border-outline-variant/30 rounded-[2rem] p-6 flex flex-col items-center justify-center text-slate-400 hover:border-primary hover:text-primary hover:bg-primary/5 transition-all group min-h-[280px]">
            <div class="w-16 h-16 rounded-full bg-slate-50 group-hover:bg-primary/10 flex items-center justify-center mb-4 transition-colors">
                <span class="material-symbols-outlined text-3xl">add_circle</span>
            </div>
            <h3 class="font-bold text-lg text-primary">Tạo bản nháp mới</h3>
            <p class="text-xs font-bold uppercase tracking-widest mt-1 opacity-60">Tối ưu cho vị trí cụ thể</p>
        </button>
    </div>

    <!-- Bottom Tip Section -->
    <div class="mt-12 p-8 bg-gradient-to-br from-primary to-secondary rounded-[2.5rem] text-white relative overflow-hidden">
        <div class="absolute right-0 top-0 w-1/3 h-full opacity-10 pointer-events-none">
            <span class="material-symbols-outlined text-[200px]">auto_awesome</span>
        </div>
        <div class="relative z-10 max-w-2xl">
            <h4 class="text-2xl font-bold mb-4">Gợi ý từ AI: Tăng khả năng trúng tuyển</h4>
            <p class="text-blue-100 mb-6 leading-relaxed">
                Bạn có <span class="font-bold text-white underline decoration-2 underline-offset-4">3 CV</span> đã hơn 6 tháng chưa cập nhật. Các công ty thường đánh giá cao những ứng viên cập nhật liên tục.
            </p>
            <div class="flex items-center gap-4">
                <button class="px-6 py-2.5 bg-white text-primary font-extrabold rounded-xl hover:shadow-lg transition-all text-xs uppercase tracking-widest">
                    Cập nhật ngay
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
