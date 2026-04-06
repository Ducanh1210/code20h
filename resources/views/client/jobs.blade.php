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

    <!-- Filters Bar for JDs -->
    <form action="{{ route('client.jobs') }}" method="GET" class="flex flex-wrap items-center gap-4 mb-8 bg-surface-container-low/50 p-4 rounded-3xl">
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-100 flex-1 min-w-[200px]">
            <span class="material-symbols-outlined text-slate-400 text-sm">search</span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm vị trí..." class="bg-transparent border-none text-xs font-bold p-0 w-full focus:ring-0 outline-none">
        </div>
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-100">
            <span class="material-symbols-outlined text-slate-400 text-sm">business_center</span>
            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Lĩnh vực:</span>
            <input type="text" name="domain" value="{{ request('domain') }}" placeholder="VD: Backend" class="bg-transparent border-none text-xs font-bold p-0 w-32 focus:ring-0 outline-none">
        </div>
        <button type="submit" class="p-2.5 bg-primary text-white rounded-xl hover:bg-primary-dark transition-colors">
            <span class="material-symbols-outlined">filter_list</span>
        </button>
        <div class="ml-auto text-[10px] font-black text-slate-400 uppercase tracking-widest">
            Hiển thị <span class="text-primary">{{ $jds->total() }}</span> JD
        </div>
    </form>

    <!-- JD Grid/List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($jds as $jd)
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-outline-variant/10 hover:shadow-2xl hover:shadow-primary/5 transition-all group flex flex-col relative overflow-hidden">
                <div class="flex justify-between items-start mb-8 relative z-10">
                    <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center shadow-sm font-black italic">
                        JD
                    </div>
                    <div class="flex items-end gap-2">
                        <form action="{{ route('client.jobs.destroy', $jd) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa JD này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-300 hover:text-error transition-colors">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="mb-8 relative z-10">
                    <h3 class="text-xl font-bold text-primary mb-2 group-hover:text-amber-600 transition-colors headline leading-tight">{{ $jd->title }}</h3>
                    <div class="flex items-center gap-4">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">business</span>
                            {{ $jd->domain ?? 'Thông dụng' }}
                        </p>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">schedule</span>
                            {{ $jd->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <div class="mt-auto pt-6 flex items-center justify-between border-t border-slate-50 relative z-10">
                    <button onclick="viewJd({{ $jd->id }}, '{{ addslashes($jd->title) }}', '{{ addslashes($jd->domain ?? 'Thông dụng') }}', '{{ addslashes($jd->description) }}')" class="text-primary font-black text-[10px] flex items-center gap-2 group/btn uppercase tracking-widest">
                        Chi tiết yêu cầu
                        <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                    <div class="flex items-center gap-2">
                        <button onclick="editJd({{ $jd->id }}, '{{ addslashes($jd->title) }}', '{{ addslashes($jd->domain ?? '') }}', '{{ addslashes($jd->description) }}')" class="text-slate-300 hover:text-amber-600 transition-colors">
                            <span class="material-symbols-outlined text-xl">edit</span>
                        </button>
                        <form action="{{ route('client.jobs.destroy', $jd) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa JD này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-300 hover:text-error transition-colors">
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

    <!-- Create JD Modal -->
    <div id="create-jd-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/40 backdrop-blur-sm">
        <div class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl p-10 relative animate-fade-in outline-none border-none">
            <button onclick="document.getElementById('create-jd-modal').classList.add('hidden')" class="absolute right-6 top-6 text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-2xl font-bold text-primary mb-2 italic">Lưu mô tả công việc mới</h3>
            <p class="text-slate-500 mb-8 font-medium">Sao chép thông tin từ tin tuyển dụng để AI bắt đầu đối soát.</p>
            
            <form action="{{ route('client.jobs.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 px-1">Vị trí công việc</label>
                        <input type="text" name="title" required placeholder="VD: Backend Developer" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 px-1">Lĩnh vực (Domain)</label>
                        <input type="text" name="domain" placeholder="VD: FinTech, E-commerce" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 px-1">Mô tả chi tiết & Yêu cầu</label>
                    <textarea name="description" rows="8" required placeholder="Dán nội dung Job Description tại đây..." class="w-full bg-slate-50 border-none rounded-3xl px-6 py-4 font-medium text-slate-600 focus:ring-2 focus:ring-primary/20 outline-none"></textarea>
                </div>
                <button type="submit" class="w-full py-5 bg-primary text-white font-black rounded-2xl hover:brightness-110 transition-all uppercase tracking-[0.2em] text-xs shadow-xl shadow-primary/30">
                    Lưu JD & Sẵn sàng đối chiếu
                </button>
            </form>
        </div>
    </div>

    <!-- Edit JD Modal -->
    <div id="edit-jd-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/40 backdrop-blur-sm">
        <div class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl p-10 relative animate-fade-in outline-none border-none">
            <button onclick="document.getElementById('edit-jd-modal').classList.add('hidden')" class="absolute right-6 top-6 text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-2xl font-bold text-primary mb-2 italic">Cập nhật Mô tả Công việc</h3>
            <p class="text-slate-500 mb-8 font-medium">Điều chỉnh lại thông tin JD để cải thiện kết quả phân tích AI.</p>
            
            <form id="edit-jd-form" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 px-1">Vị trí công việc</label>
                        <input type="text" id="edit-jd-title" name="title" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 px-1">Lĩnh vực (Domain)</label>
                        <input type="text" id="edit-jd-domain" name="domain" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 px-1">Mô tả chi tiết & Yêu cầu</label>
                    <textarea id="edit-jd-description" name="description" rows="8" required class="w-full bg-slate-50 border-none rounded-3xl px-6 py-4 font-medium text-slate-600 focus:ring-2 focus:ring-primary/20 outline-none"></textarea>
                </div>
                <button type="submit" class="w-full py-5 bg-amber-600 text-white font-black rounded-2xl hover:brightness-110 transition-all uppercase tracking-[0.2em] text-xs shadow-xl shadow-amber-600/30">
                    Cập nhật JD
                </button>
            </form>
        </div>
    </div>

    <!-- View JD Modal -->
    <div id="view-jd-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/40 backdrop-blur-sm">
        <div class="bg-white w-full max-w-3xl rounded-[3rem] shadow-2xl p-12 relative animate-fade-in overflow-hidden">
            <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl animate-pulse"></div>
            <button onclick="document.getElementById('view-jd-modal').classList.add('hidden')" class="absolute right-8 top-8 text-slate-400 hover:text-primary transition-colors z-20">
                <span class="material-symbols-outlined">close</span>
            </button>
            
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-[10px] font-black text-amber-600 bg-amber-50 px-3 py-1 rounded-full uppercase tracking-widest">Thông tin Job Description</span>
                    <span id="view-jd-domain-badge" class="text-[10px] font-black text-slate-400 bg-slate-50 px-3 py-1 rounded-full uppercase tracking-widest"></span>
                </div>
                <h3 id="view-jd-title" class="text-3xl font-black text-primary mb-6 headline leading-tight"></h3>
                <div class="prose prose-slate max-w-none">
                    <div class="bg-surface-container-low/30 p-8 rounded-3xl border border-slate-50 italic">
                        <p id="view-jd-description" class="text-slate-600 leading-relaxed whitespace-pre-wrap font-medium"></p>
                    </div>
                </div>
                <div class="mt-10 flex gap-4">
                    <a href="{{ route('client.ai-analysis') }}" class="px-8 py-3 bg-primary text-white font-black rounded-xl text-xs uppercase tracking-widest hover:shadow-lg transition-all">Đối soát với CV</a>
                    <button onclick="document.getElementById('view-jd-modal').classList.add('hidden')" class="px-8 py-3 bg-slate-100 text-slate-500 font-bold rounded-xl text-xs uppercase tracking-widest hover:bg-slate-200 transition-all">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Logic for Dynamic JD Modals -->
    <script>
        function editJd(id, title, domain, description) {
            const form = document.getElementById('edit-jd-form');
            form.action = `/jobs/${id}`;
            document.getElementById('edit-jd-title').value = title;
            document.getElementById('edit-jd-domain').value = domain;
            document.getElementById('edit-jd-description').value = description;
            document.getElementById('edit-jd-modal').classList.remove('hidden');
        }

        function viewJd(id, title, domain, description) {
            document.getElementById('view-jd-title').innerText = title;
            document.getElementById('view-jd-domain-badge').innerText = domain;
            document.getElementById('view-jd-description').innerText = description;
            document.getElementById('view-jd-modal').classList.remove('hidden');
        }
    </script>


    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fade-in { animation: fade-in 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
</x-app-layout>
