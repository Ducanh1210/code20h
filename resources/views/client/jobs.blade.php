<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <h2 class="text-3xl font-extrabold tracking-tight text-primary uppercase">Quản lý Mô tả Công việc (JD)</h2>
                <p class="text-slate-500 text-lg">Lưu trữ và phân tích các yêu cầu tuyển dụng để tối ưu CV.</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="document.getElementById('create-jd-modal').classList.remove('hidden')" class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-black rounded-xl hover:shadow-xl transition-all uppercase text-xs tracking-widest">
                    <span class="material-symbols-outlined text-xl">add</span>
                    Thêm JD mới
                </button>
            </div>
        </div>
    </x-slot>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center gap-3 animate-fade-in">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            <span class="text-sm font-bold text-emerald-700">{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl animate-fade-in">
            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined text-red-500">error</span>
                <span class="text-sm font-bold text-red-700">Vui lòng kiểm tra lại thông tin:</span>
            </div>
            <ul class="list-disc list-inside text-xs text-red-600 space-y-1 ml-6">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Filters Bar -->
    <form action="{{ route('client.jobs') }}" method="GET" class="flex flex-wrap items-center gap-4 mb-8 bg-surface-container-low/50 p-4 rounded-3xl">
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-100 flex-1 min-w-[200px]">
            <span class="material-symbols-outlined text-slate-400 text-sm">search</span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm vị trí..." class="bg-transparent border-none text-xs font-bold p-0 w-full focus:ring-0 outline-none">
        </div>
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-100">
            <span class="material-symbols-outlined text-slate-400 text-sm">school</span>
            <input type="text" name="domain" value="{{ request('domain') }}" placeholder="Chuyên ngành..." class="bg-transparent border-none text-xs font-bold p-0 w-32 focus:ring-0 outline-none">
        </div>
        <button type="submit" class="p-2.5 bg-primary text-white rounded-xl hover:bg-primary-dark transition-colors">
            <span class="material-symbols-outlined">filter_list</span>
        </button>
        <div class="ml-auto text-[10px] font-black text-slate-400 uppercase tracking-widest">
            Hiển thị <span class="text-primary">{{ $jds->total() }}</span> JD
        </div>
    </form>

    <!-- JD Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($jds as $jd)
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-outline-variant/10 hover:shadow-2xl hover:shadow-primary/5 transition-all group flex flex-col relative overflow-hidden">
                {{-- Top: icon --}}
                <div class="flex justify-between items-start mb-6 relative z-10">
                    <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center shadow-sm font-black italic">
                        JD
                    </div>
                    @if($jd->domain)
                        <span class="text-[9px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-600">
                            {{ $jd->domain }}
                        </span>
                    @endif
                </div>

                {{-- Title + Company --}}
                <div class="mb-4 relative z-10">
                    <h3 class="text-xl font-bold text-primary mb-1.5 group-hover:text-amber-600 transition-colors headline leading-tight">{{ $jd->title }}</h3>
                    <p class="text-slate-500 text-sm font-semibold flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">apartment</span>
                        {{ $jd->company_name }}
                    </p>
                </div>

                {{-- Description preview --}}
                @if($jd->description)
                    <p class="text-slate-400 text-xs leading-relaxed mb-4 line-clamp-3 relative z-10">{{ Str::limit($jd->description, 120) }}</p>
                @endif

                {{-- Footer --}}
                <div class="mt-auto pt-6 flex items-center justify-between border-t border-slate-50 relative z-10">
                    <button onclick='viewJd(@json($jd))' class="text-primary font-black text-[10px] flex items-center gap-2 group/btn uppercase tracking-widest">
                        Chi tiết
                        <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                    <div class="flex items-center gap-2">
                        <span class="text-[9px] font-bold text-slate-300 uppercase tracking-widest">{{ $jd->created_at->diffForHumans() }}</span>
                        <button onclick='openEditModal(@json($jd))' class="text-slate-300 hover:text-amber-600 transition-colors">
                            <span class="material-symbols-outlined text-xl">edit</span>
                        </button>
                        <form action="{{ route('client.jobs.destroy', $jd) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa JD này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-300 hover:text-red-500 transition-colors">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 flex flex-col items-center justify-center text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-5xl text-slate-200">work_off</span>
                </div>
                <h3 class="text-2xl font-bold text-primary mb-2">Chưa có JD nào</h3>
                <p class="text-slate-400 text-sm max-w-xs mx-auto mb-8">Hãy lưu các bản mô tả công việc bạn đang ứng tuyển để AI thực hiện so sánh và đề xuất.</p>
                <button onclick="document.getElementById('create-jd-modal').classList.remove('hidden')" class="px-8 py-4 bg-primary text-white font-black rounded-2xl hover:scale-105 transition-transform uppercase text-xs tracking-widest shadow-xl shadow-primary/20">
                    Thêm JD đầu tiên
                </button>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $jds->withQueryString()->links() }}
    </div>

    {{-- ============================== --}}
    {{-- CREATE JD MODAL --}}
    {{-- ============================== --}}
    <div id="create-jd-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-md" onclick="if(event.target===this)this.classList.add('hidden')">
        <form action="{{ route('client.jobs.store') }}" method="POST" class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl relative animate-fade-in flex flex-col max-h-[90vh] overflow-hidden">
            @csrf
            {{-- Header --}}
            <div class="sticky top-0 bg-white z-30 px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    
                    <div>
                        <h3 class="text-lg font-extrabold text-primary tracking-tight">Thêm Mô tả Công việc mới</h3>
                        <p class="text-slate-400 text-[10px] font-medium">Điền thông tin JD để AI so sánh với CV của bạn</p>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="flex-1 overflow-y-auto px-6 py-5 custom-scrollbar space-y-5">

                {{-- Section 1: Thông tin cơ bản --}}
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-5 h-5 rounded-md bg-indigo-500 text-white text-[10px] font-bold flex items-center justify-center">1</span>
                        <h4 class="text-xs font-bold text-primary uppercase tracking-wider">Thông tin cơ bản</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-0.5">Tên doanh nghiệp <span class="text-red-400">*</span></label>
                            <input type="text" name="company_name" required placeholder="VD: FPT Software, VNG..." value="{{ old('company_name') }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-medium text-primary focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100/50 focus:bg-white outline-none transition-all placeholder:text-slate-300">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-0.5">Vị trí tuyển dụng <span class="text-red-400">*</span></label>
                            <input type="text" name="title" required placeholder="VD: Backend Developer Intern" value="{{ old('title') }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-medium text-primary focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100/50 focus:bg-white outline-none transition-all placeholder:text-slate-300">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-0.5">Chuyên ngành</label>
                            <input type="text" name="domain" placeholder="VD: Công nghệ thông tin, Kỹ thuật phần mềm..." value="{{ old('domain') }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-medium text-primary focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100/50 focus:bg-white outline-none transition-all placeholder:text-slate-300">
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100">

                {{-- Section 2: Mô tả công việc --}}
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-5 h-5 rounded-md bg-emerald-500 text-white text-[10px] font-bold flex items-center justify-center">2</span>
                        <h4 class="text-xs font-bold text-primary uppercase tracking-wider">Mô tả công việc</h4>
                    </div>
                    <textarea name="description" rows="4" placeholder="Dán nội dung mô tả công việc tại đây...&#10;&#10;VD: Phát triển và bảo trì các ứng dụng web sử dụng Laravel..."
                        class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-medium text-slate-600 focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100/50 focus:bg-white outline-none transition-all resize-none placeholder:text-slate-300">{{ old('description') }}</textarea>
                </div>

                <hr class="border-slate-100">

                {{-- Section 3: Yêu cầu & Quyền lợi --}}
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-5 h-5 rounded-md bg-amber-500 text-white text-[10px] font-bold flex items-center justify-center">3</span>
                        <h4 class="text-xs font-bold text-primary uppercase tracking-wider">Yêu cầu & Quyền lợi</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-0.5">Yêu cầu kỹ năng</label>
                            <textarea name="requirements" rows="3" placeholder="VD:&#10;- Kiến thức về Laravel, PHP&#10;- Kỹ năng Teamwork tốt"
                                class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-medium text-slate-600 focus:border-amber-400 focus:ring-4 focus:ring-amber-100/50 focus:bg-white outline-none transition-all resize-none placeholder:text-slate-300">{{ old('requirements') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-0.5">Quyền lợi & Đãi ngộ</label>
                            <textarea name="benefits" rows="3" placeholder="VD:&#10;- Lương hỗ trợ 3-5 triệu&#10;- Cơm trưa, mentor 1-1"
                                class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-medium text-slate-600 focus:border-amber-400 focus:ring-4 focus:ring-amber-100/50 focus:bg-white outline-none transition-all resize-none placeholder:text-slate-300">{{ old('benefits') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="sticky bottom-0 bg-white z-30 px-6 py-4 border-t border-slate-100 flex items-center justify-between">
                <button type="button" onclick="document.getElementById('create-jd-modal').classList.add('hidden')" class="px-4 py-2 text-slate-400 font-bold text-[10px] uppercase tracking-widest hover:text-slate-600 transition-colors">
                    Hủy bỏ
                </button>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition-all text-xs uppercase tracking-widest shadow-md shadow-indigo-100 flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">save_as</span>
                    Lưu JD
                </button>
            </div>
        </form>
    </div>

    {{-- ============================== --}}
    {{-- EDIT JD MODAL --}}
    {{-- ============================== --}}
    <div id="edit-jd-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-md" onclick="if(event.target===this)this.classList.add('hidden')">
        <form id="edit-jd-form" method="POST" class="bg-white w-full max-w-4xl rounded-3xl shadow-2xl relative animate-fade-in flex flex-col max-h-[90vh] overflow-hidden">
            @csrf
            @method('PATCH')
            {{-- Header --}}
            <div class="sticky top-0 bg-white z-30 px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-lg">edit_note</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold text-primary tracking-tight">Cập nhật JD</h3>
                        <p class="text-slate-400 text-[10px] font-medium uppercase tracking-widest">Chỉnh sửa thông tin để AI đánh giá lại</p>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="flex-1 overflow-y-auto px-10 py-8 custom-scrollbar bg-slate-50/10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    {{-- Cột trái --}}
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">
                                <span class="material-symbols-outlined text-sm">apartment</span>
                                Tên doanh nghiệp <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="edit-company_name" name="company_name" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-medium text-primary focus:border-amber-400 focus:ring-4 focus:ring-amber-100/50 outline-none transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">
                                <span class="material-symbols-outlined text-sm">school</span>
                                Chuyên ngành phù hợp
                            </label>
                            <input type="text" id="edit-domain" name="domain" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-medium text-primary focus:border-amber-400 focus:ring-4 focus:ring-amber-100/50 outline-none transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">
                                <span class="material-symbols-outlined text-sm">description</span>
                                Mô tả công việc
                            </label>
                            <textarea id="edit-description" name="description" rows="6" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-medium text-slate-600 focus:border-amber-400 focus:ring-4 focus:ring-amber-100/50 outline-none transition-all resize-none"></textarea>
                        </div>
                    </div>

                    {{-- Cột phải --}}
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">
                                <span class="material-symbols-outlined text-sm">work</span>
                                Vị trí thực tập <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="edit-title" name="title" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-medium text-primary focus:border-amber-400 focus:ring-4 focus:ring-amber-100/50 outline-none transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">
                                <span class="material-symbols-outlined text-sm">bolt</span>
                                Yêu cầu kỹ năng
                            </label>
                            <textarea id="edit-requirements" name="requirements" rows="4" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-medium text-slate-600 focus:border-amber-400 focus:ring-4 focus:ring-amber-100/50 outline-none transition-all resize-none"></textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">
                                <span class="material-symbols-outlined text-sm">card_giftcard</span>
                                Quyền lợi & Đãi ngộ
                            </label>
                            <textarea id="edit-benefits" name="benefits" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-medium text-slate-600 focus:border-amber-400 focus:ring-4 focus:ring-amber-100/50 outline-none transition-all resize-none"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="sticky bottom-0 bg-white z-30 px-6 py-4 border-t border-slate-100 flex items-center justify-between">
                <button type="button" onclick="document.getElementById('edit-jd-modal').classList.add('hidden')" class="px-4 py-2 text-slate-400 font-bold text-[10px] uppercase tracking-widest hover:text-slate-600 transition-colors">
                    Hủy bỏ
                </button>
                <button type="submit" class="px-6 py-2.5 bg-amber-600 text-white font-bold rounded-lg hover:bg-amber-700 transition-all text-xs uppercase tracking-widest shadow-md shadow-amber-100 flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">update</span>
                    Cập nhật
                </button>
            </div>
        </form>
    </div>

    {{-- ============================== --}}
    {{-- VIEW JD DETAIL MODAL --}}
    {{-- ============================== --}}
    <div id="view-jd-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-md" onclick="if(event.target===this)this.classList.add('hidden')">
        <div class="bg-white w-full max-w-5xl rounded-[2.5rem] shadow-2xl relative animate-fade-in flex flex-col max-h-[90vh] overflow-hidden border border-white/20">
            {{-- Header --}}
            <div class="sticky top-0 bg-white z-30 px-6 py-4 border-b border-slate-100">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="text-[9px] font-bold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-md uppercase tracking-wider">Chi tiết JD</span>
                    <span id="view-domain-badge" class="text-[9px] font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-md uppercase tracking-wider"></span>
                </div>
                <h3 id="view-title" class="text-xl font-extrabold text-primary tracking-tight mb-1"></h3>
                <p id="view-company" class="text-slate-500 text-sm font-bold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base text-slate-300">apartment</span>
                    <span id="view-company-text"></span>
                </p>
            </div>

            {{-- Body --}}
            <div class="flex-1 overflow-y-auto px-6 py-5 custom-scrollbar space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Cột trái --}}
                    <div id="view-desc-section" class="space-y-3">
                        <h5 class="flex items-center gap-2 text-[10px] font-bold text-slate-900 uppercase tracking-widest">
                            <span class="w-6 h-[2px] bg-primary/20"></span>
                            Mô tả công việc
                        </h5>
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <p id="view-description" class="text-slate-600 leading-relaxed whitespace-pre-wrap font-medium text-sm text-justify"></p>
                        </div>
                    </div>

                    {{-- Cột phải --}}
                    <div class="space-y-6">
                        <div id="view-req-section" class="space-y-3">
                            <h5 class="flex items-center gap-2 text-[10px] font-bold text-slate-900 uppercase tracking-widest">
                                <span class="w-6 h-[2px] bg-primary/20"></span>
                                Yêu cầu kỹ năng
                            </h5>
                            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                                <p id="view-requirements" class="text-slate-600 leading-relaxed whitespace-pre-wrap font-medium text-sm text-justify"></p>
                            </div>
                        </div>

                        <div id="view-ben-section" class="space-y-3">
                            <h5 class="flex items-center gap-2 text-[10px] font-bold text-emerald-600 uppercase tracking-widest">
                                <span class="w-6 h-[2px] bg-emerald-200"></span>
                                Quyền lợi
                            </h5>
                            <div class="bg-emerald-50/20 p-6 rounded-2xl border border-emerald-100/50">
                                <p id="view-benefits" class="text-emerald-800 leading-relaxed whitespace-pre-wrap font-medium text-sm text-justify"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="sticky bottom-0 bg-white z-30 px-6 py-4 border-t border-slate-100 flex items-center gap-3">
                <a href="{{ route('client.ai-analysis') }}" class="flex-1 px-4 py-2 bg-primary text-white font-bold rounded-lg text-[10px] uppercase tracking-widest hover:bg-primary-dark transition-all flex items-center justify-center gap-2 border border-primary">
                    <span class="material-symbols-outlined text-sm">psychology</span>
                    Đối soát CV
                </a>
                <button onclick="openInterviewModal()" class="flex-1 px-4 py-2 bg-indigo-600 text-white font-bold rounded-lg text-[10px] uppercase tracking-widest hover:bg-indigo-700 transition-all flex items-center justify-center gap-2 border border-indigo-600">
                    <span class="material-symbols-outlined text-sm">quiz</span>
                    Học Phỏng Vấn
                </button>
                <button onclick="document.getElementById('view-jd-modal').classList.add('hidden')" class="px-4 py-2 bg-slate-100 text-slate-400 font-bold rounded-lg text-[10px] uppercase tracking-widest hover:bg-slate-200 transition-all border border-slate-200">Đóng</button>
            </div>
        </div>
    </div>

    {{-- ============================== --}}
    {{-- INTERVIEW QUESTIONS MODAL --}}
    {{-- ============================== --}}
    <div id="interview-questions-modal" class="hidden fixed inset-0 z-[110] flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-md" onclick="if(event.target===this)this.classList.add('hidden')">
        <div class="bg-white w-full max-w-4xl rounded-[2.5rem] shadow-2xl relative animate-fade-in flex flex-col max-h-[90vh] overflow-hidden border border-white/20">
            {{-- Header --}}
            <div class="sticky top-0 bg-white z-30 px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-lg">neurology</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold text-primary tracking-tight">Bộ câu hỏi Phỏng Vấn AI</h3>
                        <p class="text-slate-400 text-[10px] font-medium mt-0.5">Được sinh tự động từ mô tả công việc (JD)</p>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="flex-1 overflow-y-auto px-10 py-8 custom-scrollbar bg-slate-50/30" id="iq-container">
                <!-- Data injection here -->
            </div>
            
            {{-- Footer --}}
            <div class="sticky bottom-0 bg-white/90 backdrop-blur-xl z-30 px-10 py-6 border-t border-slate-100 flex items-center justify-end">
                <button onclick="document.getElementById('interview-questions-modal').classList.add('hidden'); document.getElementById('view-jd-modal').classList.remove('hidden');" class="px-8 py-3 bg-slate-100 text-slate-500 font-bold rounded-xl text-xs uppercase tracking-widest hover:bg-slate-200 transition-all">Quay lại JD</button>
            </div>
        </div>
    </div>

    {{-- JAVASCRIPT --}}
    <script>
        let currentJd = null;

        function openEditModal(jd) {
            const form = document.getElementById('edit-jd-form');
            form.action = `/jobs/${jd.id}`;
            document.getElementById('edit-company_name').value = jd.company_name || '';
            document.getElementById('edit-title').value = jd.title || '';
            document.getElementById('edit-domain').value = jd.domain || '';
            document.getElementById('edit-description').value = jd.description || '';
            document.getElementById('edit-requirements').value = jd.requirements || '';
            document.getElementById('edit-benefits').value = jd.benefits || '';
            document.getElementById('edit-jd-modal').classList.remove('hidden');
        }

        function viewJd(jd) {
            currentJd = jd;
            document.getElementById('view-title').innerText = jd.title || '';
            document.getElementById('view-domain-badge').innerText = jd.domain || 'Thông dụng';
            document.getElementById('view-company-text').innerText = jd.company_name || '';

            const descSection = document.getElementById('view-desc-section');
            if (jd.description) {
                document.getElementById('view-description').innerText = jd.description;
                descSection.classList.remove('hidden');
            } else { descSection.classList.add('hidden'); }

            const reqSection = document.getElementById('view-req-section');
            if (jd.requirements) {
                document.getElementById('view-requirements').innerText = jd.requirements;
                reqSection.classList.remove('hidden');
            } else { reqSection.classList.add('hidden'); }

            const benSection = document.getElementById('view-ben-section');
            if (jd.benefits) {
                document.getElementById('view-benefits').innerText = jd.benefits;
                benSection.classList.remove('hidden');
            } else { benSection.classList.add('hidden'); }

            document.getElementById('view-jd-modal').classList.remove('hidden');
        }

        function openInterviewModal() {
            document.getElementById('view-jd-modal').classList.add('hidden');
            const modal = document.getElementById('interview-questions-modal');
            modal.classList.remove('hidden');
            renderInterviewQuestions(currentJd);
        }

        async function generateInterviewQuestions(btn) {
            if(!currentJd) return;
            const originalText = btn.innerHTML;
            btn.innerHTML = `<span class="material-symbols-outlined animate-spin text-sm">refresh</span> Đang phân tích JD...`;
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');

            try {
                const res = await fetch(`/jobs/${currentJd.id}/generate-questions`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const data = await res.json();
                if(data.success) {
                    currentJd.interview_questions = data.data;
                    renderInterviewQuestions(currentJd);
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
        
        function renderInterviewQuestions(jd) {
            const container = document.getElementById('iq-container');
            if(!jd.interview_questions) {
                container.innerHTML = `
                    <div class="py-20 flex flex-col items-center justify-center text-center">
                        <div class="w-24 h-24 bg-indigo-50 border border-indigo-100 rounded-[2rem] flex items-center justify-center mb-6 shadow-inner">
                            <span class="material-symbols-outlined text-5xl text-indigo-400">smart_toy</span>
                        </div>
                        <h4 class="text-2xl font-black text-primary mb-2">Chưa có câu hỏi phỏng vấn nào</h4>
                        <p class="text-slate-500 text-sm mb-8 font-medium max-w-sm">AI sẽ phân tích mô tả công việc (JD) này để biên soạn bộ câu hỏi sát thực tế nhất.</p>
                        <button onclick="generateInterviewQuestions(this)" class="px-8 py-4 bg-indigo-600 text-white font-black rounded-2xl hover:scale-[1.03] hover:shadow-xl hover:shadow-indigo-600/20 active:scale-[0.98] transition-all flex items-center gap-3 uppercase tracking-widest text-xs">
                            <span class="material-symbols-outlined">auto_awesome</span> Tạo bộ câu hỏi ngay
                        </button>
                    </div>
                `;
                return;
            }

            // Render existing questions
            let html = '<div class="space-y-10">';
            const levels = [
                { key: 'easy', title: 'Câu hỏi Cơ bản', color: 'emerald', icon: 'filter_1' },
                { key: 'medium', title: 'Tình huống & Áp dụng', color: 'amber', icon: 'filter_2' },
                { key: 'hard', title: 'Chuyên sâu & Khó', color: 'red', icon: 'filter_3' }
            ];

            levels.forEach(lvl => {
                 let qs = jd.interview_questions[lvl.key];
                 if(qs && qs.length > 0) {
                     html += `
                        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-${lvl.color}-100/50">
                            <h5 class="flex items-center gap-3 font-black text-${lvl.color}-600 uppercase tracking-[0.2em] text-xs mb-6 pb-4 border-b border-${lvl.color}-50/50">
                                <span class="material-symbols-outlined text-lg">${lvl.icon}</span>
                                ${lvl.title}
                            </h5>
                            <div class="grid gap-5">
                     `;
                     qs.forEach((q, i) => {
                         html += `
                            <div class="group relative">
                                <div class="flex items-start gap-4">
                                    <div class="w-8 h-8 rounded-full bg-${lvl.color}-50 text-${lvl.color}-700 font-black flex items-center justify-center shadow-sm text-xs shrink-0 mt-0.5 border border-${lvl.color}-100">
                                        ${i+1}
                                    </div>
                                    <div class="flex-1 space-y-3">
                                        <div class="flex items-start justify-between gap-4">
                                            <h6 class="font-bold text-primary text-[15px] leading-relaxed">${q.question}</h6>
                                            <span class="text-[9px] font-black text-slate-400 bg-slate-100 px-2.5 py-1 rounded-md uppercase tracking-wider shrink-0 border border-slate-200/50">${q.type || 'Chung'}</span>
                                        </div>
                                        <div class="text-sm text-slate-600 bg-slate-50/80 p-4 rounded-2xl border border-slate-100/80 group-hover:bg-${lvl.color}-50/30 group-hover:border-${lvl.color}-100/50 transition-colors">
                                            <strong class="flex items-center gap-1.5 text-${lvl.color}-700 text-xs mb-1 uppercase tracking-widest font-black">
                                                <span class="material-symbols-outlined text-sm">lightbulb</span> Gợi ý trả lời
                                            </strong> 
                                            <p class="leading-relaxed font-medium">${q.hint}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         `;
                     });
                     html += `</div></div>`;
                 }
            });

            html += `
                <div class="flex justify-center mt-6 pt-4">
                    <button onclick="generateInterviewQuestions(this)" class="px-6 py-3 bg-slate-100 text-slate-500 font-bold rounded-xl hover:bg-slate-200 transition-all flex items-center gap-2 text-xs uppercase tracking-widest">
                        <span class="material-symbols-outlined text-sm">refresh</span> Sinh bộ câu hỏi khác
                    </button>
                </div>
            </div>`;
            container.innerHTML = html;
        }
    </script>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fade-in { animation: fade-in 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        {{-- Custom Scrollbar --}}
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
    </style>
</x-app-layout>
