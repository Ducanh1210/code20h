<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <h2 class="text-3xl font-extrabold tracking-tight text-primary uppercase">Quản lý Hồ sơ</h2>
                <p class="text-slate-500 text-lg">Tối ưu hóa hành trình sự nghiệp với trợ lý AI chuyên nghiệp.</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="document.getElementById('upload-modal').classList.remove('hidden')" class="flex items-center gap-2 px-5 py-2.5 bg-white border border-outline-variant/30 text-primary font-bold rounded-xl hover:bg-slate-50 transition-all shadow-sm uppercase text-xs tracking-widest">
                    <span class="material-symbols-outlined text-xl">upload</span>
                    Tải CV lên
                </button>
                <a href="{{ route('client.cv-templates') }}" class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-black rounded-xl hover:shadow-xl transition-all uppercase text-xs tracking-widest">
                    <span class="material-symbols-outlined text-xl">add</span>
                    Viết CV mới
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Filters Bar -->
    <form action="{{ route('client.cv-management') }}" method="GET" class="flex flex-wrap items-center gap-4 mb-8 bg-surface-container-low/50 p-4 rounded-3xl">
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-100 flex-1 min-w-[200px]">
            <span class="material-symbols-outlined text-slate-400 text-sm">search</span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm theo tiêu đề..." class="bg-transparent border-none text-xs font-bold p-0 w-full focus:ring-0">
        </div>
        
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-100">
            <span class="material-symbols-outlined text-slate-400 text-sm">calendar_today</span>
            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">Ngày tạo:</span>
            <select name="date_range" onchange="this.form.submit()" class="bg-transparent border-none text-xs font-bold p-0 pr-8 focus:ring-0">
                <option value="">Tất cả thời gian</option>
                <option value="7_days" {{ request('date_range') == '7_days' ? 'selected' : '' }}>7 ngày qua</option>
                <option value="30_days" {{ request('date_range') == '30_days' ? 'selected' : '' }}>30 ngày qua</option>
            </select>
        </div>

        <button type="submit" class="p-2.5 bg-primary text-white rounded-xl hover:bg-primary-dark transition-colors">
            <span class="material-symbols-outlined">filter_list</span>
        </button>

        <div class="ml-auto text-[10px] font-black text-slate-400 uppercase tracking-widest">
            Hiển thị <span class="text-primary">{{ $cvs->total() }}</span> hồ sơ
        </div>
    </form>

    <!-- CV Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($cvs as $cv)
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-outline-variant/10 hover:shadow-2xl hover:shadow-primary/5 transition-all group flex flex-col relative overflow-hidden">
                @if($cv->is_uploaded)
                    <div class="absolute -right-4 -top-4 w-20 h-20 bg-primary/5 rounded-full blur-2xl group-hover:bg-primary/10 transition-colors"></div>
                @endif
                
                <div class="flex justify-between items-start mb-8 relative z-10">
                    @php
                        $themeMap = [
                            'blue' => '#1e40af',
                            'green' => '#15803d',
                            'orange' => '#ea580c',
                            'red' => '#be123c',
                        ];
                        $cvTheme = $cv->content['settings']['theme'] ?? 'blue';
                        $themeColor = $themeMap[$cvTheme] ?? $themeMap['blue'];
                    @endphp

                    <!-- Mini CV Preview (High-Fidelity) -->
                    <div class="relative w-24 h-32 bg-white border border-slate-100 rounded-xl shadow-lg overflow-hidden transform group-hover:scale-110 group-hover:-rotate-2 transition-all duration-500 shrink-0 ring-4 ring-slate-50 group-hover:ring-primary/5 flex flex-col">
                        @if($cv->is_uploaded)
                            <div class="absolute inset-0 bg-indigo-50/30 flex flex-col items-center justify-center gap-2">
                                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600">
                                    <span class="material-symbols-outlined text-2xl italic">upload_file</span>
                                </div>
                                <span class="text-[9px] font-black text-indigo-400 uppercase tracking-widest px-2 py-0.5 bg-white rounded-full shadow-sm">FILE</span>
                            </div>
                        @else
                            <!-- Header Decoration -->
                            <div class="h-8 w-full relative flex-shrink-0" style="background-color: {{ $themeColor }}">
                                <!-- Profile Pic -->
                                <div class="absolute -bottom-2.5 left-2.5 w-6 h-6 rounded-full border-2 border-white bg-slate-50 overflow-hidden shadow-sm z-10">
                                    @if(!empty($cv->content['header']['image']))
                                        <img src="{{ $cv->content['header']['image'] }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                             <span class="material-symbols-outlined text-[10px] text-slate-300">person</span>
                                        </div>
                                    @endif
                                </div>
                                <!-- Header Text Overlay Removed -->
                            </div>

                            <!-- Skeleton Content (Two Columns) -->
                            <div class="p-1 px-1.5 pt-4.5 flex gap-1.5 h-full overflow-hidden">
                                <!-- Left Column (35%) -->
                                <div class="w-[35%] space-y-1.5 border-r border-slate-50 pr-1">
                                    @php
                                        $leftSections = collect($cv->content['left_sections'] ?? [])->take(3);
                                    @endphp
                                    @foreach($leftSections as $section)
                                        <div>
                                            <div class="space-y-0.5 mt-1">
                                                <div class="h-[0.8px] w-full bg-slate-100 rounded-full"></div>
                                                <div class="h-[0.8px] w-4/5 bg-slate-100 rounded-full"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Right Column (65%) -->
                                <div class="flex-1 space-y-1.5 pl-0.5">
                                    @php
                                        $rightSections = collect($cv->content['right_sections'] ?? [])->take(3);
                                    @endphp
                                    @foreach($rightSections as $section)
                                        <div>
                                            <div class="space-y-0.5 mt-1">
                                                <div class="h-[0.8px] w-full bg-slate-100 rounded-full"></div>
                                                <div class="h-[0.8px] w-full bg-slate-50 rounded-full"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Bottom Bar -->
                            <div class="h-0.5 w-full flex-shrink-0" style="background-color: {{ $themeColor }}; opacity: 0.15;"></div>
                        @endif
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        <span id="save-indicator-{{ $cv->id }}" class="hidden px-2 py-0.5 bg-emerald-50 text-emerald-600 text-[8px] font-black rounded-full uppercase tracking-tighter animate-pulse shadow-sm border border-emerald-100">Đang lưu..</span>
                        <span id="status-badge-{{ $cv->id }}" class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-black rounded-full uppercase tracking-tighter">SẴN SÀNG</span>
                        <div class="relative inline-block text-left" x-data="{ open: false }">
                            <button @click="open = !open" class="w-8 h-8 rounded-full hover:bg-slate-100 flex items-center justify-center transition-colors">
                                <span class="material-symbols-outlined text-slate-400">more_vert</span>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-50 z-50 py-2 animate-fade-in">
                                <button onclick="editCv({{ $cv->id }}, '{{ addslashes($cv->title) }}', '{{ $cv->is_uploaded ? '' : addslashes($cv->content['text'] ?? '') }}')" class="w-full text-left px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-50 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                    Chỉnh sửa nâng cao
                                </button>
                                <button onclick="viewCv({{ $cv->id }}, '{{ addslashes($cv->title) }}', '{{ $cv->is_uploaded ? 'File Đã Tải Lên' : addslashes($cv->content['text'] ?? '') }}')" class="w-full text-left px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-50 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-lg">visibility</span>
                                    Xem chi tiết
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-8 relative z-10">
                    <h3 id="title-{{ $cv->id }}" 
                        contenteditable="true" 
                        onblur="renameCv(event, {{ $cv->id }})"
                        onkeydown="if(event.key === 'Enter'){ event.preventDefault(); this.blur(); }"
                        class="text-xl font-bold text-primary mb-2 group-hover:text-secondary transition-colors headline leading-tight outline-none focus:bg-slate-50 focus:px-3 focus:py-1 focus:rounded-xl focus:ring-4 focus:ring-primary/5 cursor-text hover:underline decoration-dotted decoration-primary/30 underline-offset-8">
                        {{ $cv->title }}
                    </h3>
                    <div class="flex items-center gap-4">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">schedule</span>
                            {{ $cv->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <div class="mt-auto pt-6 flex items-center justify-between border-t border-slate-50 relative z-10">
                    <button onclick="viewCv({{ $cv->id }}, '{{ addslashes($cv->title) }}', '{{ $cv->is_uploaded ? 'File Đã Tải Lên' : addslashes($cv->content['text'] ?? '') }}')" class="text-primary font-black text-[10px] flex items-center gap-2 group/btn uppercase tracking-widest">
                        Chi tiết hồ sơ
                        <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                    <div class="flex items-center gap-2">
                        @if(!$cv->is_uploaded)
                            <a href="{{ route('client.cv-builder', $cv) }}" class="text-slate-300 hover:text-secondary transition-colors">
                                <span class="material-symbols-outlined text-xl">edit</span>
                            </a>
                        @endif
                        <form action="{{ route('client.cv-management.destroy', $cv) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa hồ sơ này?')">
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
                    <span class="material-symbols-outlined text-5xl text-slate-200">folder_off</span>
                </div>
                <h3 class="text-2xl font-bold text-primary mb-2">Chưa có hồ sơ nào</h3>
                <p class="text-slate-400 text-sm max-w-xs mx-auto mb-8">Bắt đầu bằng cách tạo mới hoặc tải CV của bạn lên để AI có thể giúp bạn tối ưu.</p>
                <button onclick="document.getElementById('create-modal').classList.remove('hidden')" class="px-8 py-4 bg-primary text-white font-black rounded-2xl hover:scale-105 transition-transform uppercase text-xs tracking-widest shadow-xl shadow-primary/20">
                    Tạo hồ sơ ngay
                </button>
            </div>
        @endforelse
    </div>

    <!-- Modals (Simple Hidden Divs for now) -->
    <!-- Create Modal -->
    <div id="create-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/40 backdrop-blur-sm">
        <div class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl p-10 relative animate-fade-in">
            <button onclick="document.getElementById('create-modal').classList.add('hidden')" class="absolute right-6 top-6 text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-2xl font-bold text-primary mb-2 italic">Tạo hồ sơ trực tuyến</h3>
            <p class="text-slate-500 mb-8 font-medium">Nhập tiêu đề và nội dung kinh nghiệm để AI phân tích.</p>
            
            <form action="{{ route('client.cv-management.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 px-1">Tiêu đề hồ sơ</label>
                    <input type="text" name="title" required placeholder="VD: Senior Frontend Developer - React" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-primary focus:ring-2 focus:ring-primary/20 outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 px-1">Nội dung chi tiết</label>
                    <textarea name="manual_content" rows="6" placeholder="Tóm tắt kinh nghiệm, kỹ năng và các dự án của bạn..." class="w-full bg-slate-50 border-none rounded-3xl px-6 py-4 font-medium text-slate-600 focus:ring-2 focus:ring-primary/20 outline-none"></textarea>
                </div>
                <button type="submit" class="w-full py-5 bg-primary text-white font-black rounded-2xl hover:brightness-110 transition-all uppercase tracking-[0.2em] text-xs shadow-xl shadow-primary/30">
                    Lưu & Phân tích với AI
                </button>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/40 backdrop-blur-sm">
        <div class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl p-10 relative animate-fade-in">
            <button onclick="document.getElementById('edit-modal').classList.add('hidden')" class="absolute right-6 top-6 text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-2xl font-bold text-primary mb-2 italic underline underline-offset-4 decoration-secondary/30">Chỉnh sửa hồ sơ</h3>
            <p class="text-slate-500 mb-8 font-medium">Cập nhật thông tin để AI đưa ra ý kiến chính xác nhất.</p>
            
            <form id="edit-cv-form" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 px-1">Tiêu đề hồ sơ</label>
                    <input type="text" id="edit-title" name="title" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-primary focus:ring-2 focus:ring-primary/20 outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 px-1">Nội dung chi tiết</label>
                    <textarea id="edit-content" name="manual_content" rows="6" class="w-full bg-slate-50 border-none rounded-3xl px-6 py-4 font-medium text-slate-600 focus:ring-2 focus:ring-primary/20 outline-none"></textarea>
                </div>
                <button type="submit" class="w-full py-5 bg-secondary text-white font-black rounded-2xl hover:brightness-110 transition-all uppercase tracking-[0.2em] text-xs shadow-xl shadow-secondary/30">
                    Cập nhật thay đổi
                </button>
            </form>
        </div>
    </div>

    <!-- View Modal (Details) -->
    <div id="view-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/40 backdrop-blur-sm">
        <div class="bg-white w-full max-w-3xl rounded-[3rem] shadow-2xl p-12 relative animate-fade-in overflow-hidden">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-primary/5 rounded-full blur-3xl animate-pulse"></div>
            <button onclick="document.getElementById('view-modal').classList.add('hidden')" class="absolute right-8 top-8 text-slate-400 hover:text-primary transition-colors z-20">
                <span class="material-symbols-outlined">close</span>
            </button>
            
            <div class="relative z-10">
                <span class="text-[10px] font-black text-secondary-fixed bg-secondary/10 px-3 py-1 rounded-full uppercase tracking-widest mb-4 inline-block">Hồ sơ chi tiết</span>
                <h3 id="view-title" class="text-3xl font-black text-primary mb-6 headline leading-tight"></h3>
                <div class="prose prose-slate max-w-none">
                    <p id="view-content" class="text-slate-600 leading-relaxed whitespace-pre-wrap font-medium bg-surface-container-low/30 p-6 rounded-3xl border border-slate-50 italic"></p>
                </div>
                <div class="mt-10 flex gap-4">
                    <button class="px-8 py-3 bg-primary text-white font-black rounded-xl text-xs uppercase tracking-widest hover:shadow-lg transition-all">Phân tích AI</button>
                    <button onclick="document.getElementById('view-modal').classList.add('hidden')" class="px-8 py-3 bg-slate-100 text-slate-500 font-bold rounded-xl text-xs uppercase tracking-widest hover:bg-slate-200 transition-all">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Logic for Dynamic Modals -->
    <script>
        function editCv(id, title, content) {
            const form = document.getElementById('edit-cv-form');
            form.action = `/cv-management/${id}`;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-content').value = content;
            document.getElementById('edit-modal').classList.remove('hidden');
        }

        function viewCv(id, title, content) {
            document.getElementById('view-title').innerText = title;
            document.getElementById('view-content').innerText = content;
            document.getElementById('view-modal').classList.remove('hidden');
        }

        async function renameCv(event, id) {
            const newTitle = event.target.innerText.trim();
            const indicator = document.getElementById('save-indicator-' + id);
            const badge = document.getElementById('status-badge-' + id);
            
            if (!newTitle) return;

            // UI Feedback
            indicator.classList.remove('hidden');
            badge.classList.add('hidden');

            try {
                const response = await fetch(`/cv-management/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ title: newTitle })
                });

                const data = await response.json();
                
                if (data.success) {
                    setTimeout(() => {
                        indicator.innerText = '✔ Đã lưu';
                        indicator.classList.remove('bg-emerald-50', 'text-emerald-600');
                        indicator.classList.add('bg-blue-50', 'text-blue-600');
                        setTimeout(() => {
                            indicator.classList.add('hidden');
                            badge.classList.remove('hidden');
                            indicator.innerText = 'Đang lưu..';
                            indicator.classList.add('bg-emerald-50', 'text-emerald-600');
                            indicator.classList.remove('bg-blue-50', 'text-blue-600');
                        }, 1500);
                    }, 500);
                }
            } catch (err) {
                console.error('Rename failed:', err);
                alert('Có lỗi xảy ra khi đổi tên hồ sơ.');
                indicator.classList.add('hidden');
                badge.classList.remove('hidden');
            }
        }
    </script>


    <!-- Upload Modal -->
    <div id="upload-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-950/40 backdrop-blur-sm">
        <div class="bg-white w-full max-w-xl rounded-[2.5rem] shadow-2xl p-10 relative animate-fade-in">
            <button onclick="document.getElementById('upload-modal').classList.add('hidden')" class="absolute right-6 top-6 text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-2xl font-bold text-primary mb-2 italic">Tải lên hồ sơ (PDF/DOCX)</h3>
            <p class="text-slate-500 mb-8 font-medium">Chọn file CV có sẵn của bạn từ máy tính.</p>
            
            <form action="{{ route('client.cv-management.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 px-1">Tiêu đề hồ sơ</label>
                    <input type="text" name="title" required placeholder="VD: CV - Nguyễn Văn A - Java Dev" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-primary focus:ring-2 focus:ring-primary/20">
                </div>
                <div class="border-2 border-dashed border-slate-100 rounded-3xl p-10 flex flex-col items-center justify-center bg-slate-50 relative group hover:border-primary/30 transition-colors">
                    <input type="file" name="cv_file" required class="absolute inset-0 opacity-0 cursor-pointer">
                    <span class="material-symbols-outlined text-5xl text-slate-200 group-hover:text-primary transition-colors mb-4">cloud_upload</span>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kéo thả hoặc Click để chọn file</p>
                    <p class="text-[10px] text-slate-400 mt-2">Hỗ trợ PDF, DOCX (Tối đa 10MB)</p>
                </div>
                <button type="submit" class="w-full py-5 bg-primary text-white font-black rounded-2xl hover:brightness-110 transition-all uppercase tracking-[0.2em] text-xs shadow-xl shadow-primary/30">
                    Bắt đầu Tải lên
                </button>
            </form>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fade-in { animation: fade-in 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
</x-app-layout>
