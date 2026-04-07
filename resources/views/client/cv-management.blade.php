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
    <div class="bg-white/40 p-4 rounded-[2.5rem] mb-8 border border-white/60 shadow-sm backdrop-blur-xl">
        <form action="{{ route('client.cv-management') }}" method="GET" class="flex flex-col lg:flex-row items-center justify-between gap-4">
            <!-- Left: Search -->
            <div class="flex items-center gap-3 px-5 py-3.5 bg-white rounded-2xl shadow-sm border border-slate-200/50 transition-all focus-within:ring-4 focus-within:ring-primary/5 flex-1 w-full lg:max-w-2xl group">
                <span class="material-symbols-outlined text-slate-400 text-xl group-focus-within:text-primary transition-colors">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm tên hồ sơ, vị trí..." class="bg-transparent border-none text-sm font-bold p-0 w-full focus:ring-0 text-slate-700 placeholder:text-slate-400 placeholder:font-medium">
            </div>

            <!-- Right: Time Range & Button Group -->
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                <!-- Time Range -->
                <div class="flex items-center gap-3 px-5 py-3.5 bg-white rounded-2xl shadow-sm border border-slate-200/50 transition-all focus-within:ring-4 focus-within:ring-primary/5 w-full sm:w-[240px] group">
                    <span class="material-symbols-outlined text-slate-400 text-xl group-focus-within:text-primary transition-colors">calendar_today</span>
                    <div class="relative flex-1">
                        <select name="date_range" class="bg-transparent border-none text-sm font-bold p-0 w-full focus:ring-0 appearance-none cursor-pointer text-slate-700" onchange="this.form.submit()">
                            <option value="">Vùng thời gian</option>
                            <option value="7_days" {{ request('date_range') == '7_days' ? 'selected' : '' }}>7 ngày qua</option>
                            <option value="30_days" {{ request('date_range') == '30_days' ? 'selected' : '' }}>30 ngày qua</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-0 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-lg">expand_more</span>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    @if(request()->anyFilled(['search', 'date_range']))
                        <a href="{{ route('client.cv-management') }}" class="flex items-center justify-center w-12 h-12 bg-slate-100 text-slate-600 rounded-2xl hover:bg-slate-200 transition-all shrink-0">
                            <span class="material-symbols-outlined text-lg">restart_alt</span>
                        </a>
                    @endif
                    <button type="submit" class="flex items-center justify-center gap-2 px-8 py-3.5 bg-primary text-white font-black rounded-2xl hover:shadow-xl hover:brightness-110 active:scale-95 transition-all text-xs uppercase tracking-[0.15em] shadow-lg shadow-primary/20 flex-1 lg:flex-none">
                        <span class="material-symbols-outlined text-lg">filter_list</span>
                        <span>Lọc ngay</span>
                    </button>
                </div>
            </div>
        </form>
        
        <div class="flex items-center gap-2 mt-3 px-2">
            <div class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></div>
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                HIỆN CÓ <span class="text-primary font-black">{{ $cvs->total() }}</span> HỒ SƠ PHÙ HỢP
            </span>
        </div>
    </div>

    <!-- CV Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($cvs as $cv)
            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-200/60 hover:shadow-2xl hover:shadow-primary/5 hover:border-primary/30 transition-all group flex flex-col relative overflow-hidden">
                @if($cv->is_uploaded)
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/10 transition-colors pointer-events-none"></div>
                @endif
                
                <div class="flex gap-6 relative z-10 mb-2">
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

                    <!-- Mini CV Preview (Thumbnail Square) -->
                    <div class="relative w-20 h-20 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm overflow-hidden transform group-hover:scale-105 transition-all duration-300 shrink-0 ring-4 ring-slate-50 cursor-pointer" onclick="viewCv({{ $cv->id }}, '{{ addslashes($cv->title) }}')">
                        <div id="raw-content-{{ $cv->id }}" class="hidden">{{ $cv->content['text'] ?? '' }}</div>
                        @if($cv->is_uploaded)
                            <div class="absolute inset-0 bg-indigo-50 flex flex-col items-center justify-center gap-1 backdrop-blur-[2px]">
                                <span class="material-symbols-outlined text-[28px] text-indigo-500 italic">description</span>
                                <span class="text-[7px] font-black text-indigo-600 uppercase tracking-widest bg-white/80 px-2 py-0.5 rounded-full shadow-sm">BẢN GỐC</span>
                            </div>
                        @else
                            @if(!empty($cv->content['header']['image']))
                                <!-- Avatar Fills the Square -->
                                <img src="{{ $cv->content['header']['image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            @else
                                <!-- Dynamic Themed Avatar Placeholder -->
                                <div class="w-full h-full flex items-center justify-center bg-slate-100/50 group-hover:bg-slate-100 transition-colors">
                                     <div class="w-12 h-12 rounded-full flex items-center justify-center shadow-sm transform group-hover:scale-110 transition-all duration-300" style="background-color: {{ $themeColor }}">
                                         <span class="material-symbols-outlined text-[24px] text-white">person</span>
                                     </div>
                                </div>
                            @endif
                        @endif
                    </div>

                    <!-- Right Info Block -->
                    <div class="flex-1 flex flex-col min-w-0">
                        <!-- Title & Options -->
                        <div class="flex justify-between items-start gap-2 mb-1">
                            <h3 id="title-{{ $cv->id }}" 
                                contenteditable="true" 
                                onblur="renameCv(event, {{ $cv->id }})"
                                onkeydown="if(event.key === 'Enter'){ event.preventDefault(); this.blur(); }"
                                class="text-base font-bold text-slate-800 focus:text-primary mb-0 headline leading-tight outline-none focus:bg-slate-50 focus:px-2 rounded focus:ring-2 focus:ring-primary/10 cursor-text -ml-1 line-clamp-2">
                                {{ $cv->title }}
                            </h3>
                            
                            <!-- 3 dots action menu -->
                            <div class="relative shrink-0 text-left -mr-2" x-data="{ open: false }">
                                <button @click="open = !open" class="w-7 h-7 rounded-full hover:bg-slate-100 flex items-center justify-center transition-colors">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">more_vert</span>
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-1 w-44 bg-white rounded-xl shadow-xl shadow-slate-200/50 border border-slate-100 z-50 py-1.5 animate-fade-in origin-top-right">
                                    @if(!$cv->is_uploaded)
                                        <button onclick="editCv({{ $cv->id }}, '{{ addslashes($cv->title) }}')" class="w-full text-left px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-primary transition-colors flex items-center gap-2">
                                            <span class="material-symbols-outlined text-sm">edit</span> Tên & Nội dung
                                        </button>
                                        <button onclick="viewCv({{ $cv->id }}, '{{ addslashes($cv->title) }}')" class="w-full text-left px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-primary transition-colors flex items-center gap-2">
                                            <span class="material-symbols-outlined text-sm">visibility</span> Xem nội dung
                                        </button>
                                    @else
                                        <button onclick="editCv({{ $cv->id }}, '{{ addslashes($cv->title) }}', true)" class="w-full text-left px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-primary transition-colors flex items-center gap-2">
                                            <span class="material-symbols-outlined text-sm">edit</span> Đổi tên File
                                        </button>
                                        <button onclick="viewCv({{ $cv->id }}, '{{ addslashes($cv->title) }}')" class="w-full text-left px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-primary transition-colors flex items-center gap-2">
                                            <span class="material-symbols-outlined text-sm">document_scanner</span> Text trích xuất
                                        </button>
                                        <a href="{{ Storage::url($cv->file_path) }}" target="_blank" class="w-full text-left px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-primary transition-colors flex items-center gap-2">
                                            <span class="material-symbols-outlined text-sm">description</span> Xem Bản Gốc
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5 mb-2.5">
                            <span class="material-symbols-outlined text-[11px]">schedule</span>
                            Cập nhật lúc: {{ $cv->updated_at->diffForHumans() }}
                        </div>

                        <span id="save-indicator-{{ $cv->id }}" class="hidden px-2 py-0.5 bg-emerald-50 text-emerald-600 text-[8px] font-black rounded-md uppercase tracking-tighter animate-pulse border border-emerald-100 w-fit mb-auto">Đang lưu..</span>
                        
                        <!-- Tags -->
                        <div class="flex items-center gap-2 mt-auto">
                            <span id="status-badge-{{ $cv->id }}" class="px-2 py-0.5 bg-emerald-50 border border-emerald-100 text-emerald-600 text-[8px] font-black rounded-md uppercase tracking-widest">SẴN SÀNG</span>
                            @if($cv->is_uploaded)
                                <span class="px-2 py-0.5 bg-indigo-50 border border-indigo-100 text-indigo-600 text-[8px] font-black rounded-md uppercase tracking-widest">TÀI LIỆU GỐC</span>
                            @else
                                <span class="px-2 py-0.5 bg-sky-50 border border-sky-100 text-sky-600 text-[8px] font-black rounded-md uppercase tracking-widest">A4 BUILDER</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer Separator & Actions -->
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-end relative z-10">
                    <div class="flex items-center gap-2">
                        @if(!$cv->is_uploaded)
                            <a href="{{ route('client.cv-builder', $cv) }}" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all hover:scale-110 shadow-sm">
                                <span class="material-symbols-outlined text-[15px]">brush</span>
                            </a>
                        @endif
                        <form action="{{ route('client.cv-management.destroy', $cv) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa hồ sơ này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-rose-500 hover:text-white transition-all hover:scale-110 shadow-sm">
                                <span class="material-symbols-outlined text-[15px]">delete</span>
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
                    <p id="edit-content-msg" class="text-[10px] text-slate-400 mt-2 px-2 hidden">Bạn không thể sửa nội dung của file tải lên.</p>
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
        function editCv(id, title, isUploaded = false) {
            const form = document.getElementById('edit-cv-form');
            form.action = `/cv-management/${id}`;
            document.getElementById('edit-title').value = title;
            
            const contentBox = document.getElementById('edit-content');
            const contentMsg = document.getElementById('edit-content-msg');
            
            if (isUploaded) {
                contentBox.classList.add('hidden');
                contentMsg.classList.remove('hidden');
                contentBox.value = '';
            } else {
                contentBox.classList.remove('hidden');
                contentMsg.classList.add('hidden');
                contentBox.value = document.getElementById('raw-content-' + id).innerText;
            }
            document.getElementById('edit-modal').classList.remove('hidden');
        }

        function viewCv(id, title) {
            document.getElementById('view-title').innerText = title;
            let text = document.getElementById('raw-content-' + id).innerText.trim();
            if(!text) text = 'Chưa có hoặc không thể trích xuất nội dung từ hồ sơ này.';
            document.getElementById('view-content').innerText = text;
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

        // Keep modal open if there are validation errors
        @if(old('is_upload_form') == '1' && $errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('upload-modal').classList.remove('hidden');
            });
        @endif
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
                
                @if($errors->has('cv_file') && old('is_upload_form') == '1')
                    <div class="bg-rose-50 text-rose-500 text-xs font-bold p-3 rounded-lg border border-rose-100 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">error</span>
                        {{ $errors->first('cv_file') }}
                    </div>
                @endif
                <input type="hidden" name="is_upload_form" value="1">

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 px-1">Tiêu đề hồ sơ</label>
                    <input type="text" name="title" required value="{{ old('title') }}" placeholder="VD: CV - Nguyễn Văn A - Java Dev" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-primary focus:ring-2 focus:ring-primary/20">
                </div>
                <div class="border-2 border-dashed border-slate-100 rounded-3xl p-10 flex flex-col items-center justify-center bg-slate-50 relative group hover:border-primary/30 transition-colors">
                    <input type="file" name="cv_file" required accept=".pdf,.doc,.docx" 
                           onchange="document.getElementById('filename-display').innerText = this.files[0] ? this.files[0].name : 'Kéo thả hoặc Click để chọn file';"
                           class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                    <span class="material-symbols-outlined text-5xl text-slate-200 group-hover:text-primary transition-colors mb-4">cloud_upload</span>
                    <p id="filename-display" class="text-xs font-bold text-slate-400 uppercase tracking-widest text-center px-4 mix-blend-multiply">Kéo thả hoặc Click để chọn file</p>
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
