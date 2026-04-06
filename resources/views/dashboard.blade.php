<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-extrabold text-primary tracking-tight mb-2">
            @auth
                Chào buổi sáng, {{ explode(' ', Auth::user()->name)[0] }}
            @else
                Chào bạn!
            @endauth
        </h2>
        <p class="text-slate-500 text-lg">Hôm nay AI đã chuẩn bị 5 gợi ý công việc mới phù hợp với bạn.</p>
    </x-slot>

    <!-- Hero Stats Section -->
    <section class="flex flex-col md:flex-row justify-end items-end gap-6 mb-8">
        <div class="flex gap-4">
            <div class="p-4 bg-white rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 min-w-[180px]">
                <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">description</span>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-primary">12</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-nowrap">Tổng số CV</p>
                </div>
            </div>
            <div class="p-4 bg-white rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 min-w-[180px]">
                <div class="w-12 h-12 bg-secondary/10 rounded-2xl flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined">analytics</span>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-secondary">08</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-nowrap">Đã phân tích</p>
                </div>
            </div>
            <div class="p-4 bg-white rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 min-w-[180px]">
                <div class="w-12 h-12 bg-tertiary/10 rounded-2xl flex items-center justify-center text-tertiary">
                    <span class="material-symbols-outlined">auto_awesome</span>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-tertiary">05</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-nowrap">Gợi ý mới</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Dashboard Grid -->
    <div class="grid grid-cols-12 gap-8">
        <!-- Left Column: Quick Actions & Recent CVs -->
        <div class="col-span-12 lg:col-span-8 space-y-8">
            <!-- Quick Start Section (Bento Style) -->
            <div class="grid grid-cols-2 gap-4">
                <div class="relative overflow-hidden group bg-gradient-to-br from-primary to-primary-container p-8 rounded-3xl text-white shadow-xl">
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-2">Tải lên CV của bạn</h3>
                        <p class="text-white/70 text-sm mb-6 max-w-[200px]">AI sẽ tự động bóc tách và phân tích điểm mạnh của bạn.</p>
                        <button class="bg-white text-primary px-6 py-2 rounded-full font-bold text-sm hover:scale-105 transition-transform">Bắt đầu ngay</button>
                    </div>
                    <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-white/10 text-9xl font-thin rotate-12">upload_file</span>
                </div>
                <div class="relative overflow-hidden group bg-white p-8 rounded-3xl border border-slate-200/60 shadow-sm">
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold text-primary mb-2">Dán JD công việc</h3>
                        <p class="text-slate-500 text-sm mb-6 max-w-[200px]">Kiểm tra mức độ phù hợp và nhận gợi ý chỉnh sửa CV.</p>
                        <button class="bg-primary text-white px-6 py-2 rounded-full font-bold text-sm hover:scale-105 transition-transform">Phân tích JD</button>
                    </div>
                    <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-slate-100 text-9xl font-thin -rotate-12">content_paste_search</span>
                </div>
            </div>

            <!-- Recent CV Cards -->
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-primary">CV Gần đây</h3>
                    <a class="text-sm font-bold text-secondary flex items-center hover:underline" href="{{ route('client.cv-management') }}">
                        Xem tất cả <span class="material-symbols-outlined text-sm ml-1">arrow_forward</span>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- CV Card 1 -->
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm hover:shadow-xl transition-all group cursor-pointer border border-transparent hover:border-primary/10">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">article</span>
                            </div>
                            <div class="bg-secondary/10 px-3 py-1 rounded-full text-secondary text-[10px] font-extrabold uppercase font-headline">Matching: 92%</div>
                        </div>
                        <h4 class="text-lg font-bold text-primary mb-1">Senior UI/UX Designer</h4>
                        <p class="text-slate-400 text-xs mb-4">Cập nhật 2 giờ trước • Tiếng Anh</p>
                        <div class="flex gap-2">
                            <span class="bg-surface-container text-slate-600 px-3 py-1 rounded-xl text-[10px] font-bold uppercase tracking-wider">Portfolio</span>
                            <span class="bg-surface-container text-slate-600 px-3 py-1 rounded-xl text-[10px] font-bold uppercase tracking-wider">Design System</span>
                        </div>
                    </div>
                    <!-- CV Card 2 -->
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm hover:shadow-xl transition-all group cursor-pointer border border-transparent hover:border-primary/10">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">article</span>
                            </div>
                            <div class="bg-tertiary/10 px-3 py-1 rounded-full text-tertiary text-[10px] font-extrabold uppercase font-headline">Matching: 78%</div>
                        </div>
                        <h4 class="text-lg font-bold text-primary mb-1">Product Manager CV</h4>
                        <p class="text-slate-400 text-xs mb-4">Cập nhật 1 ngày trước • Tiếng Việt</p>
                        <div class="flex gap-2">
                            <span class="bg-surface-container text-slate-600 px-3 py-1 rounded-xl text-[10px] font-bold uppercase tracking-wider">Strategy</span>
                            <span class="bg-surface-container text-slate-600 px-3 py-1 rounded-xl text-[10px] font-bold uppercase tracking-wider">Agile</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Matching Jobs & AI Suggestion -->
        <div class="col-span-12 lg:col-span-4 space-y-8">
            <!-- AI Suggestion Bubble (Glassmorphism) -->
            <div class="glass-panel p-6 rounded-3xl relative overflow-hidden">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-secondary to-tertiary rounded-full flex items-center justify-center text-white shadow-lg shadow-secondary/30">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">psychology</span>
                    </div>
                    <span class="text-sm font-bold text-primary">Gợi ý từ Career Tailor AI</span>
                </div>
                <p class="text-primary/80 text-sm leading-relaxed italic">
                    "Dựa trên 12 CV của bạn, kỹ năng <strong>Figma</strong> và <strong>React</strong> đang có nhu cầu tăng 15% trong tuần này. Hãy cân nhắc cập nhật các dự án liên quan để tăng tỷ lệ trúng tuyển!"
                </p>
            </div>

            <!-- Matching Jobs List -->
            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                <h3 class="text-xl font-bold text-primary mb-6">Việc làm phù hợp</h3>
                <div class="space-y-6">
                    <!-- Job Item 1 -->
                    <div class="flex gap-4 group cursor-pointer">
                        <div class="w-12 h-12 bg-surface-container rounded-2xl overflow-hidden flex-shrink-0">
                            <img alt="Company Logo" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name=Google&background=4285F4&color=fff" />
                        </div>
                        <div class="flex-1 min-w-0 border-b border-slate-100 pb-4 group-last:border-none">
                            <h4 class="text-sm font-bold text-primary truncate group-hover:text-secondary transition-colors font-headline">Senior Product Designer</h4>
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Google • Singapore</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-extrabold text-secondary">$4,500 - $6,000</span>
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[10px] text-secondary" style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="text-[10px] font-extrabold text-secondary">98% Match</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="w-full mt-8 py-3 border border-slate-200 rounded-2xl text-slate-600 font-bold text-sm hover:bg-slate-50 transition-colors">Khám phá thêm việc làm</button>
            </div>
        </div>

        @if(Auth::check() && Auth::user()->role === 'admin' && isset($totalUsers))
            <!-- Admin Stats Section -->
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 border-start border-primary border-5">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-uppercase text-muted small fw-bold mb-1" style="letter-spacing: 1px;">Tổng người dùng</div>
                                <div class="h2 fw-bold mb-0 text-dark">{{ $totalUsers }}</div>
                            </div>
                            <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-4">
                                <span class="material-symbols-outlined fs-2">group</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 border-start border-dark border-5">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-uppercase text-muted small fw-bold mb-1" style="letter-spacing: 1px;">Tài khoản Admin</div>
                                <div class="h2 fw-bold mb-0 text-dark">{{ $adminCount }}</div>
                            </div>
                            <div class="p-3 bg-dark bg-opacity-10 text-dark rounded-4">
                                <span class="material-symbols-outlined fs-2">admin_panel_settings</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            @if(isset($recentUsers))
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-light border-0 px-4 py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark">Thành viên mới gia nhập</h5>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-link link-primary fw-bold text-decoration-none small">Xem tất cả</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            @foreach($recentUsers as $user)
                                <div class="col-md-6 col-lg-4">
                                    <div class="d-flex align-items-center p-3 bg-light rounded-4 border-0 transition-all hover-shadow">
                                        <div class="rounded-3 bg-primary text-white d-flex align-items-center justify-content-center fw-bold me-3" style="width: 48px; height: 48px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div class="text-truncate">
                                            <div class="fw-bold text-dark text-truncate">{{ $user->name }}</div>
                                            <div class="small text-muted text-truncate">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @else
            <!-- Non-Admin Section -->
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-4 me-3">
                                <span class="material-symbols-outlined fs-2">lock</span>
                            </div>
                            <h5 class="mb-0 fw-bold text-dark">Thông tin</h5>
                        </div>
                        <p class="text-muted small italic mb-0">Hệ thống đang bảo mật dữ liệu cá nhân của bạn. Cập nhật thông tin định kỳ để đảm bảo an toàn.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('fab')
        <button class="fixed bottom-8 right-8 w-16 h-16 bg-primary text-white rounded-2xl shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50 group">
            <span class="material-symbols-outlined text-3xl">edit_note</span>
            <span class="absolute right-full mr-4 bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">Viết CV mới bằng AI</span>
        </button>
    @endpush
</x-app-layout>
