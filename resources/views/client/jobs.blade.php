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
        <form action="{{ route('client.jobs.store') }}" method="POST" class="bg-white w-full max-w-3xl rounded-3xl shadow-2xl relative animate-fade-in flex flex-col max-h-[90vh] overflow-hidden">
            @csrf
            {{-- Header --}}
            <div class="sticky top-0 bg-white z-30 px-8 pt-7 pb-5 border-b border-slate-100">
                <button type="button" onclick="document.getElementById('create-jd-modal').classList.add('hidden')" class="absolute right-6 top-6 w-9 h-9 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl">add_task</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-extrabold text-primary tracking-tight">Thêm Mô tả Công việc mới</h3>
                        <p class="text-slate-400 text-xs">Điền thông tin JD để AI so sánh với CV của bạn</p>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="flex-1 overflow-y-auto px-8 py-6 custom-scrollbar space-y-6">

                {{-- Section 1: Thông tin cơ bản --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-6 h-6 rounded-lg bg-indigo-500 text-white text-xs font-bold flex items-center justify-center">1</span>
                        <h4 class="text-sm font-bold text-primary">Thông tin cơ bản</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5 ml-0.5">Tên doanh nghiệp <span class="text-red-400">*</span></label>
                            <input type="text" name="company_name" required placeholder="VD: FPT Software, VNG..." value="{{ old('company_name') }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-primary focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 focus:bg-white outline-none transition-all placeholder:text-slate-300">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5 ml-0.5">Vị trí tuyển dụng <span class="text-red-400">*</span></label>
                            <input type="text" name="title" required placeholder="VD: Backend Developer Intern" value="{{ old('title') }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-primary focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 focus:bg-white outline-none transition-all placeholder:text-slate-300">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5 ml-0.5">Chuyên ngành</label>
                            <input type="text" name="domain" placeholder="VD: Công nghệ thông tin, Kỹ thuật phần mềm..." value="{{ old('domain') }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-primary focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 focus:bg-white outline-none transition-all placeholder:text-slate-300">
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100">

                {{-- Section 2: Mô tả công việc --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-6 h-6 rounded-lg bg-emerald-500 text-white text-xs font-bold flex items-center justify-center">2</span>
                        <h4 class="text-sm font-bold text-primary">Mô tả công việc</h4>
                    </div>
                    <textarea name="description" rows="5" placeholder="Dán nội dung mô tả công việc tại đây...&#10;&#10;VD: Phát triển và bảo trì các ứng dụng web sử dụng Laravel..."
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-white outline-none transition-all resize-none placeholder:text-slate-300">{{ old('description') }}</textarea>
                </div>

                <hr class="border-slate-100">

                {{-- Section 3: Yêu cầu & Quyền lợi --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-6 h-6 rounded-lg bg-amber-500 text-white text-xs font-bold flex items-center justify-center">3</span>
                        <h4 class="text-sm font-bold text-primary">Yêu cầu & Quyền lợi</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5 ml-0.5">Yêu cầu kỹ năng</label>
                            <textarea name="requirements" rows="4" placeholder="VD:&#10;- Kiến thức về Laravel, PHP&#10;- Kỹ năng Teamwork tốt"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-white outline-none transition-all resize-none placeholder:text-slate-300">{{ old('requirements') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5 ml-0.5">Quyền lợi & Đãi ngộ</label>
                            <textarea name="benefits" rows="4" placeholder="VD:&#10;- Lương hỗ trợ 3-5 triệu&#10;- Cơm trưa, mentor 1-1"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-white outline-none transition-all resize-none placeholder:text-slate-300">{{ old('benefits') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="sticky bottom-0 bg-white z-30 px-8 py-5 border-t border-slate-100 flex items-center justify-between">
                <button type="button" onclick="document.getElementById('create-jd-modal').classList.add('hidden')" class="px-5 py-2.5 text-slate-400 font-semibold text-sm hover:text-slate-600 transition-colors">
                    Hủy bỏ
                </button>
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-cyan-500 text-white font-bold rounded-xl hover:scale-[1.02] active:scale-[0.98] transition-all text-sm shadow-lg shadow-indigo-200/40 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">save</span>
                    Lưu JD
                </button>
            </div>
        </form>
    </div>

    {{-- ============================== --}}
    {{-- EDIT JD MODAL --}}
    {{-- ============================== --}}
    <div id="edit-jd-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-md" onclick="if(event.target===this)this.classList.add('hidden')">
        <form id="edit-jd-form" method="POST" class="bg-white w-full max-w-5xl rounded-[2.5rem] shadow-2xl relative animate-fade-in flex flex-col max-h-[90vh] overflow-hidden border border-white/20">
            @csrf
            @method('PATCH')
            {{-- Header --}}
            <div class="sticky top-0 bg-white/80 backdrop-blur-xl z-30 px-10 pt-8 pb-5 border-b border-slate-100/50">
                <button type="button" onclick="document.getElementById('edit-jd-modal').classList.add('hidden')" class="absolute right-8 top-8 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all duration-300">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
                <div class="flex items-center gap-4 mb-1">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center shadow-inner">
                        <span class="material-symbols-outlined text-2xl">edit_note</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-primary headline tracking-tight">Cập nhật JD</h3>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest leading-none">Chỉnh sửa thông tin để AI đánh giá lại</p>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="flex-1 overflow-y-auto px-10 py-8 custom-scrollbar bg-slate-50/10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    {{-- Cột trái --}}
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">
                                <span class="material-symbols-outlined text-sm">apartment</span>
                                Tên doanh nghiệp <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="edit-company_name" name="company_name" required class="w-full bg-white border-2 border-slate-100 rounded-xl px-5 py-3 font-bold text-primary focus:border-amber-500 focus:ring-4 focus:ring-amber-500/5 outline-none transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">
                                <span class="material-symbols-outlined text-sm">school</span>
                                Chuyên ngành phù hợp
                            </label>
                            <input type="text" id="edit-domain" name="domain" class="w-full bg-white border-2 border-slate-100 rounded-xl px-5 py-3 font-bold text-primary focus:border-amber-500 focus:ring-4 focus:ring-amber-500/5 outline-none transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">
                                <span class="material-symbols-outlined text-sm">description</span>
                                Mô tả công việc
                            </label>
                            <textarea id="edit-description" name="description" rows="8" class="w-full bg-white border-2 border-slate-100 rounded-2xl px-5 py-4 font-medium text-slate-600 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/5 outline-none transition-all resize-none min-h-[220px]"></textarea>
                        </div>
                    </div>

                    {{-- Cột phải --}}
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">
                                <span class="material-symbols-outlined text-sm">work</span>
                                Vị trí thực tập <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="edit-title" name="title" required class="w-full bg-white border-2 border-slate-100 rounded-xl px-5 py-3 font-bold text-primary focus:border-amber-500 focus:ring-4 focus:ring-amber-500/5 outline-none transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">
                                <span class="material-symbols-outlined text-sm">bolt</span>
                                Yêu cầu kỹ năng
                            </label>
                            <textarea id="edit-requirements" name="requirements" rows="4" class="w-full bg-white border-2 border-slate-100 rounded-2xl px-5 py-4 font-medium text-slate-600 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/5 outline-none transition-all resize-none min-h-[110px]"></textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">
                                <span class="material-symbols-outlined text-sm">card_giftcard</span>
                                Quyền lợi & Đãi ngộ
                            </label>
                            <textarea id="edit-benefits" name="benefits" rows="3" class="w-full bg-white border-2 border-slate-100 rounded-2xl px-5 py-4 font-medium text-slate-600 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/5 outline-none transition-all resize-none min-h-[100px]"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="sticky bottom-0 bg-white/90 backdrop-blur-xl z-30 px-10 py-6 border-t border-slate-100 flex items-center justify-between">
                <button type="button" onclick="document.getElementById('edit-jd-modal').classList.add('hidden')" class="px-6 py-3 text-slate-400 font-black text-[10px] uppercase tracking-widest hover:text-slate-600 transition-colors">
                    Hủy bỏ
                </button>
                <button type="submit" class="px-12 py-4 bg-amber-600 text-white font-black rounded-2xl hover:scale-[1.02] active:scale-[0.98] transition-all uppercase tracking-widest text-xs shadow-2xl shadow-amber-600/30 flex items-center gap-3">
                    <span class="material-symbols-outlined">update</span>
                    Cập nhật ngay
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
            <div class="sticky top-0 bg-white/80 backdrop-blur-xl z-30 px-10 pt-10 pb-6 border-b border-slate-100/50">
                <button type="button" onclick="document.getElementById('view-jd-modal').classList.add('hidden')" class="absolute right-8 top-8 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all duration-300">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="text-[10px] font-black text-amber-600 bg-amber-50 px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm">Chi tiết JD</span>
                    <span id="view-domain-badge" class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm"></span>
                </div>
                <h3 id="view-title" class="text-3xl font-black text-primary headline tracking-tight mb-2"></h3>
                <p id="view-company" class="text-slate-500 text-lg font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg text-slate-300">apartment</span>
                    <span id="view-company-text"></span>
                </p>
            </div>

            {{-- Body --}}
            <div class="flex-1 overflow-y-auto px-10 py-8 custom-scrollbar bg-slate-50/10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    {{-- Cột trái --}}
                    <div id="view-desc-section" class="space-y-4">
                        <h5 class="flex items-center gap-3 text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">
                            <span class="w-8 h-[2px] bg-primary/20"></span>
                            Mô tả công việc
                        </h5>
                        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm min-h-[300px]">
                            <p id="view-description" class="text-slate-600 leading-relaxed whitespace-pre-wrap font-medium text-sm text-justify"></p>
                        </div>
                    </div>

                    {{-- Cột phải --}}
                    <div class="space-y-8">
                        <div id="view-req-section" class="space-y-4">
                            <h5 class="flex items-center gap-3 text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                <span class="w-8 h-[2px] bg-primary/20"></span>
                                Yêu cầu kỹ năng
                            </h5>
                            <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                                <p id="view-requirements" class="text-slate-600 leading-relaxed whitespace-pre-wrap font-medium text-sm text-justify"></p>
                            </div>
                        </div>

                        <div id="view-ben-section" class="space-y-4">
                            <h5 class="flex items-center gap-3 text-[11px] font-black text-emerald-600 uppercase tracking-[0.2em]">
                                <span class="w-8 h-[2px] bg-emerald-200"></span>
                                Quyền lợi hấp dẫn
                            </h5>
                            <div class="bg-emerald-50/20 p-8 rounded-[2rem] border border-emerald-100/50 shadow-sm">
                                <p id="view-benefits" class="text-emerald-800 leading-relaxed whitespace-pre-wrap font-medium text-sm text-justify"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="sticky bottom-0 bg-white/90 backdrop-blur-xl z-30 px-10 py-6 border-t border-slate-100 flex items-center gap-4">
                <a href="{{ route('client.ai-analysis') }}" class="flex-1 px-8 py-4 bg-primary text-white font-black rounded-2xl text-xs uppercase tracking-widest hover:scale-[1.02] active:scale-[0.98] transition-all shadow-2xl shadow-primary/30 flex items-center justify-center gap-3">
                    <span class="material-symbols-outlined">psychology</span>
                    Đối soát CV ngay
                </a>
                <button onclick="document.getElementById('view-jd-modal').classList.add('hidden')" class="px-8 py-4 bg-slate-100 text-slate-500 font-bold rounded-2xl text-[10px] uppercase tracking-widest hover:bg-slate-200 transition-all">Đóng</button>
            </div>
        </div>
    </div>

    {{-- JAVASCRIPT --}}
    <script>
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
