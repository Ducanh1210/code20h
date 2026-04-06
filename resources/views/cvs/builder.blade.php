<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('client.cv-management') }}" class="p-2 hover:bg-slate-100 rounded-full transition-colors">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h2 class="text-xl font-bold text-primary">{{ $cv->title }} <span class="text-slate-300 font-normal ml-2">/ A4 Precision Mode</span></h2>
            </div>
            <div class="flex items-center gap-6">
                <!-- Theme Picker -->
                <div class="flex items-center gap-2 px-4 py-1.5 bg-white rounded-full shadow-sm border border-slate-100" x-data="{}">
                    <span class="text-[9px] font-black uppercase text-slate-400 mr-2">Theme:</span>
                    <template x-for="c in ['blue', 'green', 'orange', 'red']">
                        <button @click="content.settings.theme = c; $dispatch('theme-change')" 
                                :class="content.settings.theme === c ? 'ring-2 ring-offset-2 ring-primary scale-110' : ''"
                                class="w-4 h-4 rounded-full transition-all"
                                :style="'background-color: var(--theme-' + c + ')'">
                        </button>
                    </template>
                </div>

                <!-- Zoom Control -->
                <div class="flex items-center gap-3 px-4 py-1.5 bg-white rounded-full shadow-sm border border-slate-100">
                    <span class="material-symbols-outlined text-slate-300 text-sm">zoom_in</span>
                    <input type="range" min="0.5" max="1.5" step="0.1" x-model="zoom" class="w-24 h-1 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-primary">
                    <span class="text-[10px] font-bold text-slate-500 w-8" x-text="Math.round(zoom * 100) + '%'"></span>
                </div>

                <div class="flex items-center gap-3">
                    <span id="save-status" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest opacity-0 transition-opacity">Đã lưu</span>
                    <button @click="saveCv()" class="px-6 py-2 bg-primary text-white font-black rounded-xl hover:shadow-lg transition-all uppercase text-xs tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">save</span>
                        Lưu hồ sơ
                    </button>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Include External Assets -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <div class="flex h-[calc(100vh-64px)] overflow-hidden bg-slate-50" x-data="cvBuilder()">
        
        <!-- Hidden Image Input -->
        <input type="file" id="image-upload" class="hidden" accept="image/*" @change="handleImageUpload">

        <!-- Left Controls -->
        <div class="w-80 shrink-0 bg-white border-r border-slate-100 p-8 overflow-y-auto space-y-8">
            <div class="space-y-4">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Thao tác nhanh</h3>
                <button @click="print()" class="w-full py-4 bg-slate-50 hover:bg-primary/5 hover:text-primary rounded-2xl flex items-center justify-center gap-3 text-slate-400 transition-all font-black text-[10px] uppercase tracking-widest">
                    <span class="material-symbols-outlined text-lg">print</span>
                    Xuất file PDF / In
                </button>
                <button @click="addSection('left')" class="w-full py-4 bg-slate-50 hover:bg-slate-100 rounded-2xl flex items-center justify-center gap-3 text-slate-400 transition-all font-black text-[10px] uppercase tracking-widest font-bold">
                    <span class="material-symbols-outlined text-lg">add_circle</span>
                    Mục cột trái
                </button>
                <button @click="addSection('right')" class="w-full py-4 bg-slate-50 hover:bg-slate-100 rounded-2xl flex items-center justify-center gap-3 text-slate-400 transition-all font-black text-[10px] uppercase tracking-widest font-bold">
                    <span class="material-symbols-outlined text-lg">add_circle</span>
                    Mục cột phải
                </button>
            </div>

            <!-- AI Section (Mini) -->
            <div :class="'bg-gradient-to-br from-slate-900 to-slate-800 rounded-[2rem] p-6 text-white relative overflow-hidden ring-4 ring-' + content.settings.theme + '-500/20 transition-all'">
                <div class="relative z-10 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm text-yellow-400">auto_awesome</span>
                        <h4 class="text-[10px] font-black uppercase tracking-widest">AI Careertailor</h4>
                    </div>
                    <p class="text-[11px] text-slate-400 leading-relaxed italic">"Bố cục A4 giúp Robot (ATS) quét dữ liệu nhanh hơn 40%. Đang tối ưu..."</p>
                </div>
            </div>
        </div>

        <!-- Main Workspace -->
        <div class="flex-1 overflow-auto p-12 scroll-smooth" id="scroll-workspace">
            <div class="flex flex-col items-center gap-12 origin-top transition-transform duration-300" :style="'transform: scale(' + zoom + ')'">
                
                <!-- Page 1 -->
                <div class="page-a4 bg-white shadow-2xl relative overflow-hidden" id="page-1">
                    <!-- Curved Background Decorations (SVG) -->
                    <div class="absolute top-0 left-0 w-full h-[260px] pointer-events-none z-0">
                        <svg viewBox="0 0 800 260" class="w-full h-full preserve-3d" preserveAspectRatio="none">
                            <path d="M0,0 L800,0 L800,80 C600,160 300,-20 0,80 Z" :fill="'var(--theme-' + content.settings.theme + ')'" fill-opacity="1"/>
                            <path d="M0,0 L500,0 C300,120 100,20 0,160 Z" :fill="'var(--theme-' + content.settings.theme + ')'" fill-opacity="0.3"/>
                        </svg>
                    </div>

                    <!-- Page Grid Overlay -->
                    <div class="absolute inset-0 pattern-grid opacity-[0.03] pointer-events-none"></div>

                    <!-- Content Layer -->
                    <div class="relative z-10 p-[15mm] h-full flex flex-col">
                        
                        <!-- Header Section -->
                        <div class="flex items-start gap-8 mb-12">
                            <!-- Circular Profile Image -->
                            <div class="relative group shrink-0">
                                <div class="w-[38mm] h-[38mm] rounded-full border-[6px] border-white shadow-2xl overflow-hidden bg-slate-50 transition-all">
                                    <img :src="content.header.image || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(content.header.name) + '&size=256&background=random'" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="absolute inset-x-0 -bottom-4 flex justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button @click="triggerImageUpload()" class="bg-primary text-white p-2 rounded-full shadow-lg hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined text-sm">photo_camera</span>
                                    </button>
                                    <button x-show="content.header.image" @click="content.header.image = null" class="bg-rose-500 text-white p-2 rounded-full shadow-lg hover:scale-110 transition-transform ml-2">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Name & Basic Info -->
                            <div class="flex-1 pt-4">
                                <h1 contenteditable="true" @blur="content.header.name = $event.target.innerText" x-text="content.header.name" 
                                    class="text-4xl font-black text-primary headline tracking-tighter uppercase mb-2 outline-none"></h1>
                                <div contenteditable="true" @blur="content.header.job_title = $event.target.innerText" x-text="content.header.job_title" 
                                     :class="'inline-block px-4 py-1.5 text-white text-xs font-black rounded-lg uppercase tracking-widest mb-6 bg-' + content.settings.theme + '-600'"></div>
                                
                                <!-- Contact Info Grid -->
                                <div class="grid grid-cols-2 gap-y-2 gap-x-6 border-t border-slate-100 pt-5">
                                    <template x-for="(icon, key) in {'phone': 'phone', 'dob': 'calendar_today', 'gender': 'person', 'email': 'mail'}">
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-sm" :class="'text-' + content.settings.theme + '-300'" x-text="icon"></span>
                                            <div contenteditable="true" @blur="content.header[key] = $event.target.innerText" x-text="content.header[key]" class="text-[11px] font-bold text-slate-600 outline-none"></div>
                                        </div>
                                    </template>
                                    <div class="flex items-center gap-3 col-span-2">
                                        <span class="material-symbols-outlined text-sm" :class="'text-' + content.settings.theme + '-300'">location_on</span>
                                        <div contenteditable="true" @blur="content.header.address = $event.target.innerText" x-text="content.header.address" class="text-[11px] font-bold text-slate-600 outline-none"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Two Column Body -->
                        <div class="flex gap-10 flex-1 overflow-hidden" id="content-container">
                            <!-- Left Column -->
                            <div class="w-[35%] space-y-10" id="column-left">
                                <template x-for="(section, sIndex) in content.left_sections" :key="section.id">
                                    <div class="group relative section-block pb-4" :data-id="section.id">
                                        
                                        <!-- Direct Manipulation Toolbar -->
                                        <div class="absolute -right-2 -top-6 opacity-0 group-hover:opacity-100 transition-all flex items-center bg-white shadow-xl border border-slate-200 rounded-lg overflow-hidden z-20 scale-90">
                                            <button @click="moveSection('left', sIndex, -1)" class="p-1 px-2 bg-yellow-400 text-black hover:bg-yellow-500"><span class="material-symbols-outlined text-sm">arrow_upward</span></button>
                                            <button @click="moveSection('left', sIndex, 1)" class="p-1 px-2 bg-yellow-400 text-black hover:bg-yellow-500 border-l border-white/20"><span class="material-symbols-outlined text-sm">arrow_downward</span></button>
                                            <button @click="removeSection('left', sIndex)" class="p-1 px-3 bg-slate-500 text-white hover:bg-rose-500 text-[10px] font-black uppercase">Xóa</button>
                                            <button @click="addItem(section)" class="p-1 px-3 bg-primary text-white hover:bg-blue-700 text-[10px] font-black uppercase">Thêm</button>
                                        </div>

                                        <!-- Header with Dots/Line -->
                                        <div class="flex items-center gap-3 mb-4">
                                            <h3 contenteditable="true" @blur="section.title = $event.target.innerText" x-text="section.title" 
                                                class="text-sm font-black text-primary headline tracking-widest whitespace-nowrap outline-none uppercase"></h3>
                                            <div class="flex-1 h-1 rounded-full bg-slate-100 flex items-center justify-end px-1 gap-1">
                                                <div :class="'w-1.5 h-1.5 rounded-full bg-' + content.settings.theme + '-500'"></div>
                                                <div :class="'w-1 h-1 rounded-full opacity-50 bg-' + content.settings.theme + '-500'"></div>
                                            </div>
                                        </div>

                                        <!-- Text Logic -->
                                        <div x-show="section.type === 'text'" contenteditable="true" @input="section.content = $event.target.innerText" x-text="section.content"
                                             class="text-[11px] text-slate-600 leading-relaxed font-medium outline-none whitespace-pre-wrap px-2"></div>

                                        <!-- List Logic -->
                                        <div x-show="!section.type" class="space-y-6 px-2">
                                            <template x-for="(item, iIndex) in section.items" :key="iIndex">
                                                <div class="space-y-1 group/item relative">
                                                    <!-- Item Toolbar -->
                                                    <div class="absolute -right-4 -top-4 opacity-0 group-hover/item:opacity-100 transition-all flex items-center bg-white shadow-lg border border-slate-100 rounded overflow-hidden z-20 scale-75">
                                                        <button @click="moveItem(section, iIndex, -1)" class="p-1 bg-slate-100 hover:bg-yellow-400"><span class="material-symbols-outlined text-xs">arrow_upward</span></button>
                                                        <button @click="moveItem(section, iIndex, 1)" class="p-1 bg-slate-100 hover:bg-yellow-400 border-l border-white/20"><span class="material-symbols-outlined text-xs">arrow_downward</span></button>
                                                        <button @click="removeLevelItem(section, iIndex)" class="p-1 px-2 bg-slate-300 text-white hover:bg-rose-500 text-[8px] font-black uppercase">Xóa</button>
                                                    </div>

                                                    <div contenteditable="true" @blur="item.title = $event.target.innerText" x-text="item.title" class="text-[11px] font-black text-primary outline-none"></div>
                                                    <div contenteditable="true" @blur="item.subtitle = $event.target.innerText" x-text="item.subtitle" class="text-[10px] font-bold text-slate-400 italic outline-none"></div>
                                                    <div :class="'inline-block px-2 py-0.5 text-[9px] font-black text-white rounded bg-' + content.settings.theme + '-600'" 
                                                         contenteditable="true" @blur="item.date = $event.target.innerText" x-text="item.date"></div>
                                                    <div contenteditable="true" @input="item.description = $event.target.innerText" x-text="item.description" 
                                                         class="text-[10px] text-slate-500 leading-relaxed mt-1 outline-none whitespace-pre-wrap"></div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Right Column -->
                            <div class="flex-1 space-y-10" id="column-right">
                                <template x-for="(section, sIndex) in content.right_sections" :key="section.id">
                                    <div class="group relative section-block pb-6" :data-id="section.id">
                                        
                                        <!-- Direct Manipulation Toolbar -->
                                        <div class="absolute -right-2 -top-6 opacity-0 group-hover:opacity-100 transition-all flex items-center bg-white shadow-xl border border-slate-200 rounded-lg overflow-hidden z-20 scale-90">
                                            <button @click="moveSection('right', sIndex, -1)" class="p-1 px-2 bg-yellow-400 text-black hover:bg-yellow-500"><span class="material-symbols-outlined text-sm">arrow_upward</span></button>
                                            <button @click="moveSection('right', sIndex, 1)" class="p-1 px-2 bg-yellow-400 text-black hover:bg-yellow-500 border-l border-white/20"><span class="material-symbols-outlined text-sm">arrow_downward</span></button>
                                            <button @click="removeSection('right', sIndex)" class="p-1 px-3 bg-slate-500 text-white hover:bg-rose-500 text-[10px] font-black uppercase">Xóa</button>
                                            <button @click="addItem(section)" class="p-1 px-3 bg-primary text-white hover:bg-blue-700 text-[10px] font-black uppercase">Thêm</button>
                                        </div>

                                        <!-- Header with Dots/Line -->
                                        <div class="flex items-center gap-3 mb-6">
                                            <h3 contenteditable="true" @blur="section.title = $event.target.innerText" x-text="section.title" 
                                                class="text-sm font-black text-primary headline tracking-widest whitespace-nowrap outline-none uppercase"></h3>
                                            <div class="flex-1 h-3 rounded-full bg-slate-100/50 flex items-center justify-end px-1 gap-1">
                                                <div :class="'w-6 h-1 rounded-full bg-' + content.settings.theme + '-600'"></div>
                                                <div :class="'w-1.5 h-1.5 rounded-full bg-' + content.settings.theme + '-300'"></div>
                                                <div :class="'w-1 h-1 rounded-full bg-' + content.settings.theme + '-200'"></div>
                                            </div>
                                        </div>

                                        <!-- Text Logic -->
                                        <div x-show="section.type === 'text'" contenteditable="true" @input="section.content = $event.target.innerText" x-text="section.content"
                                             class="text-[11px] text-slate-600 leading-relaxed font-medium outline-none whitespace-pre-wrap px-2"></div>

                                        <!-- List Logic -->
                                        <div x-show="!section.type" class="space-y-8 px-2">
                                            <template x-for="(item, iIndex) in section.items" :key="iIndex">
                                                <div class="space-y-2 relative pl-4 border-l-2 border-slate-50 group/item">
                                                    <!-- Item Toolbar -->
                                                    <div class="absolute -right-4 -top-4 opacity-0 group-hover/item:opacity-100 transition-all flex items-center bg-white shadow-lg border border-slate-100 rounded overflow-hidden z-20 scale-75">
                                                        <button @click="moveItem(section, iIndex, -1)" class="p-1 bg-slate-100 hover:bg-yellow-400"><span class="material-symbols-outlined text-xs">arrow_upward</span></button>
                                                        <button @click="moveItem(section, iIndex, 1)" class="p-1 bg-slate-100 hover:bg-yellow-400 border-l border-white/20"><span class="material-symbols-outlined text-xs">arrow_downward</span></button>
                                                        <button @click="removeLevelItem(section, iIndex)" class="p-1 px-2 bg-slate-300 text-white hover:bg-rose-500 text-[8px] font-black uppercase">Xóa</button>
                                                    </div>

                                                    <div class="flex justify-between items-start">
                                                        <div contenteditable="true" @blur="item.title = $event.target.innerText" x-text="item.title" class="text-[11px] font-black text-primary uppercase outline-none flex-1"></div>
                                                        <div :class="'px-3 py-1 text-[9px] font-black text-white rounded-full bg-' + content.settings.theme + '-600 whitespace-nowrap'" 
                                                             contenteditable="true" @blur="item.date = $event.target.innerText" x-text="item.date"></div>
                                                    </div>
                                                    <div contenteditable="true" @blur="item.subtitle = $event.target.innerText" x-text="item.subtitle" class="text-[10px] font-bold text-slate-500 italic outline-none"></div>
                                                    <div contenteditable="true" @input="item.description = $event.target.innerText" x-text="item.description" 
                                                         class="text-[10px] text-slate-500 leading-relaxed outline-none whitespace-pre-wrap"></div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Footer Decoration -->
                        <div class="absolute bottom-0 left-0 w-full h-[60px] pointer-events-none">
                            <svg viewBox="0 0 800 60" class="w-full h-full" preserveAspectRatio="none">
                                <path d="M0,60 L800,60 L800,0 C600,40 200,-20 0,60 Z" :fill="'var(--theme-' + content.settings.theme + ')'" fill-opacity="1"/>
                            </svg>
                            <div class="absolute bottom-4 right-8 text-[9px] font-black text-white/50 tracking-widest italic">© Joboko.com</div>
                        </div>
                    </div>
                </div>

                <!-- Page 2 (Auto-created or Placeholder) -->
                <div class="page-a4 bg-white shadow-2xl relative overflow-hidden flex flex-col items-center justify-center group" id="page-2">
                    <div class="absolute inset-0 pattern-grid opacity-[0.03] pointer-events-none"></div>
                    <div class="text-center space-y-4 opacity-10 group-hover:opacity-40 transition-opacity">
                        <span class="material-symbols-outlined text-6xl">note_add</span>
                        <p class="text-xs font-black uppercase tracking-widest text-slate-400">Trang 2 (Tự động kích hoạt khi tràn nội dung)</p>
                    </div>
                    
                    <!-- Page Number Overlay -->
                    <div class="absolute bottom-4 left-4 flex items-center gap-2 px-3 py-1 bg-slate-900/5 rounded-full">
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Trang 2</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Script Block -->
    <script>
        function cvBuilder() {
            return {
                content: @json($cv->content),
                zoom: 0.9,
                autoSaveTimeout: null,
                
                init() {
                    // Inject CSS Variables for Dynamic Themes
                    const style = document.createElement('style');
                    style.innerHTML = `
                        :root {
                            --theme-blue: #1e40af;
                            --theme-green: #15803d;
                            --theme-orange: #ea580c;
                            --theme-red: #be123c;
                        }
                        .page-a4 {
                            width: 210mm;
                            height: 297mm;
                            min-height: 297mm;
                        }
                        .pattern-grid {
                            background-image: radial-gradient(#000 0.5px, transparent 0.5px);
                            background-size: 15px 15px;
                        }
                        @media print {
                            body * { visibility: hidden; }
                            .page-a4, .page-a4 * { visibility: visible; }
                            .page-a4 { position: absolute; left: 0; top: 0; box-shadow: none; margin: 0; }
                            .no-print { display: none !important; }
                        }
                    `;
                    document.head.appendChild(style);

                    this.$watch('content', () => {
                        clearTimeout(this.autoSaveTimeout);
                        this.autoSaveTimeout = setTimeout(() => this.saveCv(), 2000);
                    }, { deep: true });
                },

                triggerImageUpload() {
                    document.getElementById('image-upload').click();
                },

                handleImageUpload(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = (f) => {
                        this.content.header.image = f.target.result;
                    };
                    reader.readAsDataURL(file);
                },

                moveSection(side, index, dir) {
                    const sections = side === 'left' ? this.content.left_sections : this.content.right_sections;
                    const newIndex = index + dir;
                    if (newIndex >= 0 && newIndex < sections.length) {
                        const temp = sections[index];
                        sections[index] = sections[newIndex];
                        sections[newIndex] = temp;
                    }
                },

                moveItem(section, index, dir) {
                    if (!section.items) return;
                    const newIndex = index + dir;
                    if (newIndex >= 0 && newIndex < section.items.length) {
                        const temp = section.items[index];
                        section.items[index] = section.items[newIndex];
                        section.items[newIndex] = temp;
                    }
                },

                addSection(side) {
                    const sections = side === 'left' ? this.content.left_sections : this.content.right_sections;
                    sections.push({
                        id: 'sec_' + Date.now(),
                        title: 'MỤC MỚI',
                        content: 'Nội dung mới...',
                        type: 'text',
                        items: []
                    });
                },

                addItem(section) {
                    if (!section.items) section.items = [];
                    section.type = null; // Ensure it's treated as list
                    section.items.push({ 
                        title: 'TIÊU ĐỀ MỚI', 
                        subtitle: 'Phụ đề / Vị trí', 
                        date: '2024 - Nay', 
                        description: 'Mô tả chi tiết công việc hoặc thành tích...' 
                    });
                },

                removeSection(side, index) {
                    if (confirm('Xóa toàn bộ mục này?')) {
                        const sections = side === 'left' ? this.content.left_sections : this.content.right_sections;
                        sections.splice(index, 1);
                    }
                },

                removeLevelItem(section, index) {
                    if (confirm('Xóa đầu mục này?')) {
                        section.items.splice(index, 1);
                    }
                },

                saveCv() {
                    const status = document.getElementById('save-status');
                    if(status) {
                        status.innerText = 'Đang lưu...';
                        status.classList.remove('opacity-0');
                    }

                    fetch('{{ route('client.cv-builder.save', $cv) }}', {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ content: this.content })
                    })
                    .then(r => r.json())
                    .then(() => {
                        if(status) {
                            status.innerText = 'Đã lưu';
                            setTimeout(() => status.classList.add('opacity-0'), 1500);
                        }
                    });
                },

                print() {
                    window.print();
                }
            }
        }
    </script>

    <style>
        .headline { font-family: 'Be Vietnam Pro', sans-serif; }
        [contenteditable]:focus { outline: none; }
        .page-a4 { transition: transform 0.3s; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</x-app-layout>

