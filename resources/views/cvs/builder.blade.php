<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('client.cv-management') }}" class="p-2 hover:bg-slate-100 rounded-full transition-colors">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h2 class="text-xl font-bold text-primary">
                    {{ $cv->title }} 
                    <span class="text-slate-300 font-normal ml-2">/ A4 Precision Mode</span>
                    <script>
        // Vanilla JS Fallback for Font Size (Bypasses Alpine.js completely)
        window.forceApplyFontSize = function() {
            try {
                const input = document.getElementById('v-font-size');
                const val = parseFloat(input.value) || 10.5;
                const status = document.getElementById('v-status');
                
                console.log('--- FORCING FONT SIZE ---', val);
                
                // 1. Update the CSS Variable on the root container
                const root = document.querySelector('[x-data="cvBuilder()"]');
                if(root) {
                    root.style.setProperty('--base-font-size', val + 'px');
                }
                
                // 2. Direct style update on both pages (for backup)
                const pages = document.querySelectorAll('.page-a4');
                pages.forEach(p => {
                    p.style.setProperty('font-size', val + 'px', 'important');
                });
                
                // 3. Update Alpine state if available (for saving)
                if(window.Alpine) {
                    const el = document.querySelector('[x-data="cvBuilder()"]');
                    if(el && el.__x && el.__x.$data) {
                        el.__x.$data.content.settings.font_size = val;
                    }
                }
                
                // 4. Show success indicator
                status.classList.remove('hidden');
                setTimeout(() => status.classList.add('hidden'), 1500);
                
            } catch (e) {
                console.error('Font Size Update Error:', e);
                alert('Có lỗi sảy ra khi đổi cỡ chữ: ' + e.message);
            }
        };
    </script>
                    <span class="ml-3 px-2 py-0.5 bg-slate-100 text-slate-500 text-[10px] font-black rounded-full uppercase tracking-tighter shadow-sm animate-pulse whitespace-nowrap border border-slate-200">VER 2.13 (BALANCED)</span>
                </h2>
            </div>
            <div class="flex items-center gap-6">
                <!-- Theme Picker (Broadcaster) -->
                <div class="flex items-center gap-2 px-4 py-1.5 bg-white rounded-full shadow-sm border border-slate-100" x-data="{ currentTheme: '{{ $cv->content['settings']['theme'] ?? 'blue' }}' }">
                    <span class="text-[9px] font-black uppercase text-slate-400 mr-2">Màu sắc:</span>
                    <template x-for="c in ['blue', 'green', 'orange', 'red']">
                        <button @click="currentTheme = c; $dispatch('theme-update', c)" 
                                :class="currentTheme === c ? 'ring-2 ring-offset-2 ring-primary scale-110' : ''"
                                class="w-4 h-4 rounded-full transition-all"
                                :style="'background-color: var(--theme-' + c + ')'">
                        </button>
                    </template>
                </div>

                <!-- Zoom Control -->
                <div class="flex items-center gap-3 px-4 py-1.5 bg-white rounded-full shadow-sm border border-slate-100">
                    <span class="material-symbols-outlined text-slate-300 text-sm">zoom_in</span>
                    <input type="range" min="0.5" max="1.5" step="0.1" x-model="zoom" class="w-16 h-1 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-primary">
                    <span class="text-[9px] font-bold text-slate-500 w-8" x-text="Math.round(zoom * 100) + '%'"></span>
                </div>

                <!-- Font Size Control (Compact v2.7) -->
                <div class="flex items-center gap-1.5 px-3 py-1 bg-white rounded-full shadow-sm border border-slate-100 transition-all hover:border-slate-200">
                    <span class="material-symbols-outlined text-slate-300 text-xs">text_fields</span>
                    <input type="number" id="v-font-size" min="5" max="30" step="0.5" 
                           value="{{ $cv->content['settings']['font_size'] ?? 10.5 }}"
                           class="w-10 h-5 bg-transparent border-none rounded text-center text-[11px] font-bold focus:ring-0 p-0 text-slate-600">
                    <button onclick="window.forceApplyFontSize()" 
                            class="px-2.5 py-1 bg-slate-100 hover:bg-primary hover:text-white text-slate-500 text-[9px] font-black rounded-full transition-all uppercase">
                        OK
                    </button>
                    <div id="v-status" class="hidden text-emerald-500 font-bold text-[10px]">✔</div>
                </div>

                <div class="flex items-center gap-3">
                    <span id="save-status" class="flex items-center gap-1 text-[9px] font-black text-emerald-500 uppercase tracking-tighter opacity-0 transition-all">
                        <span id="save-status-icon" class="material-symbols-outlined text-xs">done</span>
                        <span id="save-status-text">Đã lưu</span>
                    </span>

                    <!-- Download PDF Button -->
                    <button onclick="window.print()" class="px-4 py-1.5 bg-slate-800 text-white font-black rounded-full hover:bg-slate-700 hover:shadow-md active:scale-95 transition-all uppercase text-[10px] tracking-widest flex items-center gap-2 group">
                        <span class="material-symbols-outlined text-[16px] group-hover:-translate-y-0.5 transition-transform">download</span>
                        <span>Tải PDF</span>
                    </button>

                    <button @click="saveCv()" class="px-4 py-1.5 bg-primary text-white font-black rounded-full hover:shadow-md active:scale-95 transition-all uppercase text-[10px] tracking-widest flex items-center gap-2 group">
                        <span class="material-symbols-outlined text-[16px] group-hover:rotate-12 transition-transform">save</span>
                        <span>Lưu</span>
                    </button>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Include External Assets -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <div class="flex h-[calc(100vh-64px)] overflow-hidden bg-slate-50" 
         x-data="cvBuilder()"
         @theme-update.window="content.settings.theme = $event.detail"
         :style="'--base-font-size: ' + (content.settings.font_size || 10.5) + 'px'">
        
        <!-- Hidden Image Input -->
        <input type="file" id="image-upload" class="hidden" accept="image/*" @change="handleImageUpload">

        <!-- Left Controls -->
        <div class="w-80 shrink-0 bg-white border-r border-slate-100 p-8 overflow-y-auto space-y-8">
            <div class="space-y-4">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Thao tác nhanh</h3>
                <button @click="print()" class="w-full py-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-2xl font-black uppercase text-xs tracking-widest transition-all flex items-center justify-center gap-3">
                    <span class="material-symbols-outlined text-lg">print</span>
                    Xuất file PDF / In
                </button>
                <button @click="addSection('left')" class="w-full py-4 bg-white border-2 border-slate-100 hover:border-primary/20 hover:bg-slate-50 text-slate-500 rounded-2xl font-black uppercase text-[10px] tracking-widest transition-all flex items-center justify-center gap-3">
                    <span class="material-symbols-outlined text-sm">add_circle</span>
                    Mục Cột Trái
                </button>
                <button @click="addSection('right')" class="w-full py-4 bg-white border-2 border-slate-100 hover:border-primary/20 hover:bg-slate-50 text-slate-500 rounded-2xl font-black uppercase text-[10px] tracking-widest transition-all flex items-center justify-center gap-3">
                    <span class="material-symbols-outlined text-sm">add_circle</span>
                    Mục Cột Phải
                </button>
                <a href="?reset=1" onclick="return confirm('Hành động này sẽ xóa dữ liệu hiện tại và nạp lại bản mẫu FPT Polytechnic chuyên nghiệp. Bạn có chắc chắn?')" class="w-full py-4 bg-rose-50 border-2 border-rose-100 hover:bg-rose-100 text-rose-600 rounded-2xl font-black uppercase text-[10px] tracking-widest transition-all flex items-center justify-center gap-3">
                    <span class="material-symbols-outlined text-sm">history</span>
                    Làm mới dữ liệu mẫu
                </a>
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

        <!-- Main Workspace (Dynamic Pagination 3.0) -->
        <div class="flex-1 overflow-auto p-12 scroll-smooth" id="scroll-workspace">
            <div class="flex flex-col items-center gap-12 origin-top transition-transform duration-300" :style="'transform: scale(' + zoom + ')'">
                
                <!-- Page Rendering Loop -->
                <template x-for="(page, pIndex) in pages" :key="pIndex">
                    <div class="page-a4 bg-white shadow-2xl relative overflow-hidden flex flex-col"
                         :id="'page-' + (pIndex + 1)"
                         :data-template="content.settings.template || 'classic_prof'"
                         :style="'--current-theme: var(--theme-' + content.settings.theme + '); font-size: var(--base-font-size) !important'">
                        
                        <!-- Page 1 Only Decorations -->
                        <template x-if="pIndex === 0">
                            <div class="absolute top-0 left-0 w-full h-[260px] pointer-events-none z-0">
                                <!-- classic_prof -->
                                <svg x-show="(content.settings.template || 'classic_prof') === 'classic_prof'" viewBox="0 0 800 260" class="w-full h-full preserve-3d" preserveAspectRatio="none">
                                    <path d="M0,0 L800,0 L800,80 C600,160 300,-20 0,80 Z" :fill="'var(--theme-' + content.settings.theme + ')'" fill-opacity="1"/>
                                    <path d="M0,0 L500,0 C300,120 100,20 0,160 Z" :fill="'var(--theme-' + content.settings.theme + ')'" fill-opacity="0.3"/>
                                </svg>
                                <!-- modern_bento -->
                                <svg x-show="content.settings.template === 'modern_bento'" viewBox="0 0 800 260" class="w-full h-full preserve-3d" preserveAspectRatio="none">
                                    <rect x="0" y="0" width="800" height="150" :fill="'var(--theme-' + content.settings.theme + ')'" fill-opacity="0.05"/>
                                </svg>
                                <!-- creative_ats -->
                                <svg x-show="content.settings.template === 'creative_ats'" viewBox="0 0 800 260" class="w-full h-full preserve-3d" preserveAspectRatio="none">
                                    <rect x="0" y="0" width="800" height="24" :fill="'var(--theme-' + content.settings.theme + ')'" fill-opacity="1"/>
                                </svg>
                            </div>
                        </template>

                        <!-- Page Grid Overlay -->
                        <div class="absolute inset-0 pattern-grid opacity-[0.03] pointer-events-none"></div>

                        <!-- Content Layer -->
                        <div class="relative z-10 p-[15mm] flex-1 flex flex-col">
                            
                            <!-- Header Section (Page 1 Only) -->
                            <template x-if="pIndex === 0">
                                <div class="relative z-10 w-full"> <!-- Wrapper for multiple templates -->
                                    <!-- classic_prof Header -->
                                    <div x-show="(content.settings.template || 'classic_prof') === 'classic_prof'" class="flex items-start gap-8 mb-8">
                                        <!-- Profile Image -->
                                        <div class="relative group shrink-0">
                                            <div class="w-[38mm] h-[38mm] rounded-full border-[6px] border-white shadow-2xl overflow-hidden bg-slate-50 transition-all">
                                                <img :src="content.header.image || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(content.header.name) + '&size=256&background=random'" 
                                                     class="w-full h-full object-cover">
                                            </div>
                                            <div class="absolute inset-x-0 -bottom-4 flex justify-center opacity-0 group-hover:opacity-100 transition-opacity no-print">
                                                <button @click="triggerImageUpload()" class="bg-primary text-white p-2 rounded-full shadow-lg hover:scale-110 transition-transform">
                                                    <span class="material-symbols-outlined text-sm">photo_camera</span>
                                                </button>
                                                <button x-show="content.header.image" @click="content.header.image = null" class="bg-rose-500 text-white p-2 rounded-full shadow-lg hover:scale-110 transition-transform ml-2">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Basic Info -->
                                        <div class="flex-1 pt-4">
                                            <h1 contenteditable="true" @blur="content.header.name = $event.target.innerText" x-text="content.header.name" 
                                                class="text-3xl font-black text-primary headline tracking-tighter uppercase mb-1 outline-none cv-name"></h1>
                                            <div contenteditable="true" @blur="content.header.job_title = $event.target.innerText" x-text="content.header.job_title" 
                                                 class="inline-block px-4 py-1 text-white text-[10px] font-black rounded-lg uppercase tracking-widest mb-3 outline-none cv-job-title"
                                                 :style="'background-color: var(--theme-' + content.settings.theme + '); font-size: calc(var(--base-font-size) * 0.8)'"></div>
                                            
                                            <!-- Contact Info -->
                                            <div class="grid grid-cols-2 gap-y-2 gap-x-6 border-t border-slate-100 pt-4">
                                                <template x-for="(icon, key) in {'phone': 'phone', 'dob': 'calendar_today', 'gender': 'person', 'email': 'mail', 'address': 'location_on'}">
                                                    <div class="flex items-center gap-3" x-show="content.header[key]">
                                                        <span class="material-symbols-outlined text-sm cv-icon" x-text="icon"
                                                              :style="'color: var(--theme-' + content.settings.theme + '); opacity: 0.6'"></span>
                                                        <div contenteditable="true" @blur="content.header[key] = $event.target.innerText" x-text="content.header[key]" class="font-bold text-slate-600 outline-none cv-info-text"
                                                             :style="'font-size: var(--base-font-size)'"></div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- modern_bento Header (Image 1) -->
                                    <div x-show="content.settings.template === 'modern_bento'" class="flex gap-10 mb-2 pt-8 relative z-10 w-full pl-6 pr-6">
                                        <div class="cv-left-col relative z-20">
                                            <!-- The grey background bar is now handled in CSS -->
                                            <div class="relative group w-[45mm] h-[55mm] bg-white overflow-hidden shadow-sm mb-6 ml-2 ring-1 ring-slate-100">
                                                <img :src="content.header.image || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(content.header.name) + '&background=random'" class="w-full h-full object-cover">
                                                <div class="absolute inset-x-0 bottom-2 flex justify-center opacity-0 group-hover:opacity-100 transition-opacity no-print">
                                                    <button @click="triggerImageUpload()" class="bg-primary text-white p-1.5 rounded-full shadow-lg hover:scale-110"><span class="material-symbols-outlined text-[10px]">photo_camera</span></button>
                                                    <button x-show="content.header.image" @click="content.header.image = null" class="bg-rose-500 text-white p-1.5 rounded-full shadow-lg hover:scale-110 ml-1"><span class="material-symbols-outlined text-[10px]">delete</span></button>
                                                </div>
                                            </div>
                                            <div class="space-y-3 pl-2">
                                                <template x-for="(icon, key) in {'phone': 'phone', 'dob': 'cake', 'address': 'location_on', 'email': 'mail'}">
                                                    <div class="flex items-center gap-3" x-show="content.header[key]">
                                                        <span class="material-symbols-outlined text-[12px] text-slate-400" x-text="icon"></span>
                                                        <div contenteditable="true" @blur="content.header[key] = $event.target.innerText" x-text="content.header[key]" class="font-medium text-slate-700 outline-none leading-tight" :style="'font-size: calc(var(--base-font-size) * 0.9)'"></div>
                                                    </div>
                                                </template>
                                                <!-- Website manual mock -->
                                                <div class="flex items-center gap-3 pl-0.5 mt-2">
                                                    <span class="material-symbols-outlined text-[12px] text-slate-400">language</span>
                                                    <div class="border border-dashed border-orange-500 text-orange-400 px-2 text-[9px] cursor-text outline-none">Website, facebook,...</div>
                                                    <span class="material-symbols-outlined text-[10px] text-slate-800">info</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cv-right-col pt-6 z-20">
                                            <h1 contenteditable="true" @blur="content.header.name = $event.target.innerText" x-text="content.header.name" class="text-4xl font-black text-slate-800 tracking-tight uppercase mb-1 outline-none" :style="'color: #1e3a8a'"></h1>
                                            <div contenteditable="true" @blur="content.header.job_title = $event.target.innerText" x-text="content.header.job_title" class="text-slate-400 font-medium uppercase outline-none mb-6" :style="'font-size: calc(var(--base-font-size) * 1.1)'"></div>
                                        </div>
                                    </div>

                                    <!-- creative_ats Header (Image 2) -->
                                    <div x-show="content.settings.template === 'creative_ats'" class="flex gap-10 mb-0 pt-8 relative z-10 w-full min-h-[65mm]">
                                        <!-- Top left header part fits into the left column -->
                                        <div class="cv-left-col relative z-20">
                                            <div class="relative group w-[45mm] h-[45mm] overflow-hidden mb-6 mx-auto">
                                                <img :src="content.header.image || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(content.header.name) + '&size=256&background=random'" class="w-full h-full object-cover">
                                                <div class="absolute inset-x-0 bottom-2 flex justify-center opacity-0 group-hover:opacity-100 transition-opacity no-print">
                                                    <button @click="triggerImageUpload()" class="bg-primary text-white p-1.5 rounded-full shadow-lg hover:scale-110"><span class="material-symbols-outlined text-[10px]">photo_camera</span></button>
                                                    <button x-show="content.header.image" @click="content.header.image = null" class="bg-rose-500 text-white p-1.5 rounded-full shadow-lg hover:scale-110 ml-1"><span class="material-symbols-outlined text-[10px]">delete</span></button>
                                                </div>
                                            </div>
                                            <div class="space-y-3 px-2">
                                                <template x-for="(icon, key) in {'phone': 'phone', 'dob': 'cake', 'address': 'location_on', 'email': 'mail'}">
                                                    <div class="flex items-center gap-3 drop-shadow-md" x-show="content.header[key]">
                                                        <span class="material-symbols-outlined text-[12px] text-white" x-text="icon"></span>
                                                        <div contenteditable="true" @blur="content.header[key] = $event.target.innerText" x-text="content.header[key]" class="font-medium text-white outline-none leading-tight" :style="'font-size: calc(var(--base-font-size) * 0.9)'"></div>
                                                    </div>
                                                </template>
                                                <div class="flex items-center gap-3 mt-2 drop-shadow-md">
                                                    <span class="material-symbols-outlined text-[12px] text-white">language</span>
                                                    <div class="border border-dashed border-orange-400 text-orange-200 px-2 text-[9px] cursor-text outline-none">Website, facebook,...</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cv-right-col pt-6 z-20 relative">
                                            <!-- Green geometric triangle shape behind name -->
                                            <div class="absolute -left-12 top-[10mm] w-6 h-20 -z-10 bg-emerald-500" style="clip-path: polygon(100% 0, 100% 100%, 0 80%, 0 20%);"></div>
                                            <div class="absolute -left-[3rem] top-[8mm] w-6 h-20 -z-20 border-[3px] border-emerald-500" style="clip-path: polygon(100% 0, 100% 100%, 0 80%, 0 20%);"></div>
                                            
                                            <h1 contenteditable="true" @blur="content.header.name = $event.target.innerText" x-text="content.header.name" class="text-[2.2rem] leading-none font-bold text-[#1e3a8a] tracking-tight uppercase outline-none mb-1"></h1>
                                            <div contenteditable="true" @blur="content.header.job_title = $event.target.innerText" x-text="content.header.job_title" class="text-emerald-500 font-semibold uppercase tracking-wide mt-1 outline-none" :style="'font-size: calc(var(--base-font-size) * 1.1)'"></div>
                                        </div>
                                    </div>

                                    <!-- minimalist Header (Image 3) -->
                                    <div x-show="content.settings.template === 'minimalist'" class="flex flex-col w-full z-10 mb-6">
                                        <!-- Header Block with Grey Background -->
                                        <div class="flex items-start w-full bg-slate-100/50 relative border-l-[6px] border-[#1e40af]">
                                            <div class="flex-1 py-8 px-10">
                                                <h1 contenteditable="true" @blur="content.header.name = $event.target.innerText" x-text="content.header.name" class="text-[2.5rem] font-medium text-slate-800 uppercase leading-[1.1] mb-2 outline-none"></h1>
                                                <div contenteditable="true" @blur="content.header.job_title = $event.target.innerText" x-text="content.header.job_title" class="text-[#1e40af] uppercase outline-none" :style="'font-size: calc(var(--base-font-size) * 1.2)'"></div>
                                                
                                                <div class="grid grid-cols-2 gap-x-8 gap-y-3 mt-8 max-w-xl">
                                                    <template x-for="(icon, key) in {'phone': 'phone', 'email': 'mail', 'dob': 'cake', 'address': 'location_on'}">
                                                        <div class="flex items-center gap-3" x-show="content.header[key]">
                                                            <span class="material-symbols-outlined text-[14px] text-[#1e40af]" x-text="icon"></span>
                                                            <div class="font-medium text-slate-700 outline-none" contenteditable="true" @blur="content.header[key] = $event.target.innerText" x-text="content.header[key]" :style="'font-size: calc(var(--base-font-size) * 0.95)'"></div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                            <!-- Avatar Block spanning vertically -->
                                            <div class="w-[30%] shrink-0 flex items-center justify-center p-6 pb-0">
                                                <div class="relative group w-[35mm] h-[45mm] bg-white p-1 border border-slate-200">
                                                    <img :src="content.header.image || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(content.header.name) + '&background=random'" class="w-full h-full object-cover">
                                                    <div class="absolute inset-x-0 bottom-2 flex justify-center opacity-0 group-hover:opacity-100 transition-opacity no-print">
                                                        <button @click="triggerImageUpload()" class="bg-primary text-white p-1.5 rounded-full shadow-lg hover:scale-110"><span class="material-symbols-outlined text-[10px]">photo_camera</span></button>
                                                        <button x-show="content.header.image" @click="content.header.image = null" class="bg-rose-500 text-white p-1.5 rounded-full shadow-lg hover:scale-110 ml-1"><span class="material-symbols-outlined text-[10px]">delete</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <!-- Two Column Body -->
                            <div class="flex gap-10 flex-1 cv-cols-container" :class="{'is-first-page-body': pIndex === 0}">
                                <!-- Left Column -->
                                <div class="space-y-6 transition-all cv-left-col relative z-20">
                                    <template x-for="(section, sIndex) in page.left" :key="section.id + '_' + pIndex">
                                        <div class="group relative section-block pb-1 rounded-xl transition-all hover:bg-slate-50/50">
                                            <!-- Section Manipulation Toolbar -->
                                            <div class="absolute -right-2 -top-6 opacity-0 group-hover:opacity-100 transition-all flex items-center bg-white shadow-xl border border-slate-200 rounded-lg overflow-hidden z-[100] scale-90 no-print">
                                                <button @click="moveSection('left', content.left_sections.findIndex(s => s.id === section.id), -1)" class="p-1 px-2 bg-yellow-400 text-black hover:bg-yellow-500"><span class="material-symbols-outlined text-sm">arrow_upward</span></button>
                                                <button @click="moveSection('left', content.left_sections.findIndex(s => s.id === section.id), 1)" class="p-1 px-2 bg-yellow-400 text-black hover:bg-yellow-500 border-l border-white/20"><span class="material-symbols-outlined text-sm">arrow_downward</span></button>
                                                <button @click="removeSection('left', content.left_sections.findIndex(s => s.id === section.id))" class="p-1 px-3 bg-slate-500 text-white hover:bg-rose-500 text-[10px] font-black uppercase">Xóa</button>
                                                <button @click="addItem(content.left_sections.find(s => s.id === section.id))" class="p-1 px-3 bg-primary text-white hover:bg-blue-700 text-[10px] font-black uppercase">Thêm</button>
                                            </div>

                                            <!-- Logic for Header -->
                                            <div class="flex items-center gap-3 mb-3 px-2 cv-sec-header">
                                                <h3 contenteditable="true" @blur="section.title = $event.target.innerText; content.left_sections.find(s => s.id === section.id).title = $event.target.innerText" x-text="section.isSplit ? section.title + ' (Tiếp)' : section.title" 
                                                    class="text-xs font-black text-primary headline tracking-widest whitespace-nowrap outline-none uppercase cv-sec-title"></h3>
                                                <div class="flex-1 h-1 rounded-full bg-slate-100 flex items-center justify-end px-1 gap-1 cv-sec-line">
                                                    <div :style="'background-color: var(--theme-' + content.settings.theme + ')'" class="w-1.5 h-1.5 rounded-full cv-sec-dot"></div>
                                                </div>
                                            </div>

                                            <div class="space-y-4 px-2">
                                                <template x-for="(item, iIndex) in section.items" :key="item.id">
                                                    <div class="space-y-0.5 relative p-1 rounded hover:bg-white transition-opacity group/item" :data-item-id="item.id">
                                                        <!-- Item Manipulation Toolbar -->
                                                        <div class="absolute -right-4 -top-4 opacity-0 group-hover/item:opacity-100 transition-all flex items-center bg-white shadow-lg border border-slate-100 rounded overflow-hidden z-[100] scale-75 no-print">
                                                            <button @click="moveItem(content.left_sections.find(s => s.id === section.id), content.left_sections.find(s => s.id === section.id).items.findIndex(it => it.id === item.id), -1)" class="p-1 bg-slate-100 hover:bg-yellow-400"><span class="material-symbols-outlined text-xs">arrow_upward</span></button>
                                                            <button @click="moveItem(content.left_sections.find(s => s.id === section.id), content.left_sections.find(s => s.id === section.id).items.findIndex(it => it.id === item.id), 1)" class="p-1 bg-slate-100 hover:bg-yellow-400 border-l border-white/20"><span class="material-symbols-outlined text-xs">arrow_downward</span></button>
                                                            <button @click="removeLevelItem(content.left_sections.find(s => s.id === section.id), content.left_sections.find(s => s.id === section.id).items.findIndex(it => it.id === item.id))" class="p-1 px-2 bg-slate-300 text-white hover:bg-rose-500 text-[8px] font-black uppercase">Xóa</button>
                                                        </div>

                                                        <div contenteditable="true" @blur="item.title = $event.target.innerText; content.left_sections.find(s => s.id === section.id).items.find(it => it.id === item.id).title = $event.target.innerText" x-text="item.title" class="font-black text-primary outline-none"
                                                             :style="'font-size: calc(var(--base-font-size) * 1.05)'"></div>
                                                        <div contenteditable="true" @blur="item.subtitle = $event.target.innerText; content.left_sections.find(s => s.id === section.id).items.find(it => it.id === item.id).subtitle = $event.target.innerText" x-text="item.subtitle" class="font-bold text-slate-400 italic outline-none leading-none"
                                                             :style="'font-size: calc(var(--base-font-size) * 0.95)'"></div>
                                                        <div contenteditable="true" @input="item.description = $event.target.innerText; content.left_sections.find(s => s.id === section.id).items.find(it => it.id === item.id).description = $event.target.innerText" x-text="item.description" 
                                                             class="text-slate-500 leading-snug mt-1 outline-none whitespace-pre-wrap"
                                                             :style="'font-size: calc(var(--base-font-size) * 0.95)'"></div>
                                                    </div>
                                                </template>
                                                <!-- Text Type Support -->
                                                <template x-if="section.type === 'text'">
                                                    <div contenteditable="true" @input="section.content = $event.target.innerText" x-text="section.content"
                                                         class="text-slate-600 leading-snug font-medium outline-none whitespace-pre-wrap px-2"
                                                         :style="'font-size: var(--base-font-size)'"></div>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                <!-- Right Column -->
                                <div class="flex-1 space-y-6 cv-right-col">
                                    <template x-for="(section, sIndex) in page.right" :key="section.id + '_' + pIndex">
                                        <div class="group relative section-block pb-1 rounded-xl transition-all hover:bg-slate-50/50">
                                            <!-- Section Manipulation Toolbar -->
                                            <div class="absolute -right-2 -top-6 opacity-0 group-hover:opacity-100 transition-all flex items-center bg-white shadow-xl border border-slate-200 rounded-lg overflow-hidden z-[100] scale-90 no-print">
                                                <button @click="moveSection('right', content.right_sections.findIndex(s => s.id === section.id), -1)" class="p-1 px-2 bg-yellow-400 text-black hover:bg-yellow-500"><span class="material-symbols-outlined text-sm">arrow_upward</span></button>
                                                <button @click="moveSection('right', content.right_sections.findIndex(s => s.id === section.id), 1)" class="p-1 px-2 bg-yellow-400 text-black hover:bg-yellow-500 border-l border-white/20"><span class="material-symbols-outlined text-sm">arrow_downward</span></button>
                                                <button @click="removeSection('right', content.right_sections.findIndex(s => s.id === section.id))" class="p-1 px-3 bg-slate-500 text-white hover:bg-rose-500 text-[10px] font-black uppercase">Xóa</button>
                                                <button @click="addItem(content.right_sections.find(s => s.id === section.id))" class="p-1 px-3 bg-primary text-white hover:bg-blue-700 text-[10px] font-black uppercase">Thêm</button>
                                            </div>

                                            <div class="flex items-center gap-3 mb-4 px-4 cv-sec-header">
                                                <h3 contenteditable="true" @blur="section.title = $event.target.innerText; content.right_sections.find(s => s.id === section.id).title = $event.target.innerText" x-text="section.isSplit ? section.title + ' (Tiếp theo)' : section.title" 
                                                    class="text-xs font-black text-primary headline tracking-widest whitespace-nowrap outline-none uppercase cv-sec-title"></h3>
                                                <div class="flex-1 h-2 rounded-full bg-slate-100/50 flex items-center justify-end px-1 gap-1 cv-sec-line">
                                                    <div :style="'background-color: var(--theme-' + content.settings.theme + ')'" class="w-6 h-1 rounded-full cv-sec-dot"></div>
                                                </div>
                                            </div>

                                            <div class="space-y-6 px-4">
                                                <template x-for="(item, iIndex) in section.items" :key="item.id">
                                                    <div class="space-y-1 relative pl-4 border-l-2 border-slate-50 p-1 rounded hover:bg-white group/item transition-all" :data-item-id="item.id">
                                                        <!-- Item Manipulation Toolbar -->
                                                        <div class="absolute -right-4 -top-4 opacity-0 group-hover/item:opacity-100 transition-all flex items-center bg-white shadow-lg border border-slate-100 rounded overflow-hidden z-[100] scale-75 no-print">
                                                            <button @click="moveItem(content.right_sections.find(s => s.id === section.id), content.right_sections.find(s => s.id === section.id).items.findIndex(it => it.id === item.id), -1)" class="p-1 bg-slate-100 hover:bg-yellow-400"><span class="material-symbols-outlined text-xs">arrow_upward</span></button>
                                                            <button @click="moveItem(content.right_sections.find(s => s.id === section.id), content.right_sections.find(s => s.id === section.id).items.findIndex(it => it.id === item.id), 1)" class="p-1 bg-slate-100 hover:bg-yellow-400 border-l border-white/20"><span class="material-symbols-outlined text-xs">arrow_downward</span></button>
                                                            <button @click="removeLevelItem(content.right_sections.find(s => s.id === section.id), content.right_sections.find(s => s.id === section.id).items.findIndex(it => it.id === item.id))" class="p-1 px-2 bg-slate-300 text-white hover:bg-rose-500 text-[8px] font-black uppercase">Xóa</button>
                                                        </div>

                                                        <div class="flex justify-between items-start">
                                                            <div contenteditable="true" @blur="item.title = $event.target.innerText; content.right_sections.find(s => s.id === section.id).items.find(it => it.id === item.id).title = $event.target.innerText" x-text="item.title" class="font-black text-primary uppercase outline-none flex-1"
                                                                 :style="'font-size: calc(var(--base-font-size) * 1.05)'"></div>
                                                            <div :class="'px-4 py-0.5 text-white rounded-full whitespace-nowrap text-[8px] font-bold'" 
                                                                 contenteditable="true" @blur="item.date = $event.target.innerText; content.right_sections.find(s => s.id === section.id).items.find(it => it.id === item.id).date = $event.target.innerText" x-text="item.date"
                                                                 :style="'background-color: var(--theme-' + content.settings.theme + ');'"></div>
                                                        </div>
                                                        <div contenteditable="true" @blur="item.subtitle = $event.target.innerText; content.right_sections.find(s => s.id === section.id).items.find(it => it.id === item.id).subtitle = $event.target.innerText" x-text="item.subtitle" class="font-bold text-slate-500 italic outline-none leading-none"
                                                             :style="'font-size: calc(var(--base-font-size) * 0.95)'"></div>
                                                        <div contenteditable="true" @input="item.description = $event.target.innerText; content.right_sections.find(s => s.id === section.id).items.find(it => it.id === item.id).description = $event.target.innerText" x-text="item.description" 
                                                             class="text-slate-500 leading-snug outline-none whitespace-pre-wrap"
                                                             :style="'font-size: calc(var(--base-font-size) * 0.95)'"></div>
                                                    </div>
                                                </template>
                                                <!-- Text Type Support -->
                                                <template x-if="section.type === 'text'">
                                                    <div contenteditable="true" @input="section.content = $event.target.innerText" x-text="section.content"
                                                         class="text-slate-600 leading-snug font-medium outline-none whitespace-pre-wrap"
                                                         :style="'font-size: var(--base-font-size)'"></div>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Footer (Shared) -->
                            <div class="h-[15mm] flex items-center justify-between border-t border-slate-100 mt-4 px-4 no-print text-[8px] text-slate-300 font-black uppercase tracking-widest">
                                <span>Trang <span x-text="pIndex + 1"></span> / <span x-text="pages.length"></span></span>
                                <span>Tạo bởi Joboko A4 AI Builder</span>
                            </div>
                        </div>

                        <!-- Floating Page Badge (WOW Factor) -->
                        <div class="absolute top-1/2 -left-12 -translate-y-1/2 rotate-90 no-print z-50">
                            <div class="flex items-center gap-3 px-4 py-2 bg-slate-900 text-white rounded-full shadow-2xl border border-slate-700/50 backdrop-blur-md">
                                <span class="text-[10px] font-black uppercase tracking-[0.2em]" x-text="'PAGE ' + (pIndex + 1)"></span>
                                <div class="w-1.5 h-1.5 rounded-full" :style="'background-color: var(--theme-' + content.settings.theme + ')'"></div>
                            </div>
                        </div>

                        <!-- Footer Decoration (Page 1 Only) -->
                        <template x-if="pIndex === 0">
                            <div class="absolute bottom-0 left-0 w-full h-[60px] pointer-events-none">
                                <svg viewBox="0 0 800 60" class="w-full h-full" preserveAspectRatio="none">
                                    <path d="M0,60 L800,60 L800,0 C600,40 200,-20 0,60 Z" :fill="'var(--theme-' + content.settings.theme + ')'" fill-opacity="1"/>
                                </svg>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Script Block -->
    <script>
        function cvBuilder() {
            return {
                content: @json($cv->content),
                zoom: 0.85,
                pages: [{ left: [], right: [] }],
                autoSaveTimeout: null,
                
                init() {
                    // Recursive IDs for all sections and items
                    const addIds = (list) => {
                        list.forEach(s => {
                            if(!s.id) s.id = 'sec_' + Math.random().toString(36).substr(2, 9);
                            if(s.items) s.items.forEach(it => {
                                if(!it.id) it.id = 'item_' + Math.random().toString(36).substr(2, 9);
                            });
                        });
                    };
                    addIds(this.content.left_sections);
                    addIds(this.content.right_sections);

                    // Injecting enhanced CSS for pagination
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
                            position: relative;
                            background: white;
                        }
                        
                        /* Cố định chuẩn A4 in ấn */
                        @page {
                            size: 210mm 297mm;
                            margin: 0mm; 
                        }
                        
                        @media print {
                            * {
                                -webkit-print-color-adjust: exact !important;
                                print-color-adjust: exact !important;
                                -webkit-text-size-adjust: none !important;
                                text-size-adjust: none !important;
                            }
                            
                            html, body {
                                width: 210mm !important;
                                background: white !important;
                                margin: 0 !important;
                                padding: 0 !important;
                                font-size: 12px !important; /* Thu nhỏ cỡ chữ thêm nữa khi export PDF */
                            }
                            
                            /* Chỉ hiện duy nhất bảng làm việc đã được script cách ly */
                            #scroll-workspace {
                                display: block !important;
                                position: absolute !important;
                                left: 0 !important;
                                top: 0 !important;
                                width: 210mm !important;
                                height: auto !important;
                                margin: 0 !important;
                                padding: 0 !important;
                                overflow: visible !important;
                                background: white !important;
                            }
                            
                            #scroll-workspace > div {
                                transform: none !important;
                                display: block !important;
                                align-items: flex-start !important;
                                margin: 0 !important;
                                padding: 0 !important;
                                width: 210mm !important;
                            }
                            
                            .page-a4 { 
                                width: 210mm !important;
                                height: 297mm !important;
                                box-shadow: none !important; 
                                margin: 0 !important;
                                padding: 0 !important;
                                border: none !important;
                                page-break-after: always !important; 
                                break-after: page !important;
                            }
                            
                            .no-print { display: none !important; }
                        }
                    `;
                    document.head.appendChild(style);
                    
                    // Script CÁCH LY DOM khẩn cấp để in mượt mà
                    let printWorkspaceParent, printWorkspaceSibling, hiddenNodes = [];
                    window.addEventListener('beforeprint', () => {
                        const workspace = document.getElementById('scroll-workspace');
                        if(!workspace) return;
                        
                        // Tắt zoom
                        workspace.querySelector('div').style.transform = 'none';
                        
                        printWorkspaceParent = workspace.parentNode;
                        printWorkspaceSibling = workspace.nextElementSibling;
                        
                        // Ẩn tất cả những gì không thuộc CV
                        Array.from(document.body.children).forEach(child => {
                            if (child.tagName !== 'SCRIPT' && child.tagName !== 'STYLE' && child.tagName !== 'LINK') {
                                hiddenNodes.push({ node: child, display: child.style.display });
                                child.style.display = 'none';
                            }
                        });
                        
                        // Đưa workspace ra ngoài trực tiếp Body để thoát quy tắc layout
                        document.body.appendChild(workspace);
                    });

                    window.addEventListener('afterprint', () => {
                        const workspace = document.getElementById('scroll-workspace');
                        if(!workspace) return;
                        
                        // Trả lại DOM
                        if (printWorkspaceSibling) {
                            printWorkspaceParent.insertBefore(workspace, printWorkspaceSibling);
                        } else {
                            printWorkspaceParent.appendChild(workspace);
                        }
                        
                        // Khôi phục layout app
                        hiddenNodes.forEach(item => {
                            item.node.style.display = item.display;
                        });
                        hiddenNodes = [];
                        
                        // Hồi máu Zoom
                        window.dispatchEvent(new CustomEvent('restore-zoom'));
                    });

                    this.paginate();

                    this.$watch('content', () => {
                        this.paginate();
                        clearTimeout(this.autoSaveTimeout);
                        this.autoSaveTimeout = setTimeout(() => this.saveCv(), 3000);
                    }, { deep: true });
                },

                // Pagination Engine 3.0 (Dynamic Height Splitting)
                async paginate() {
                    const MAX_HEIGHT = 1000; // Pixels approx minus header/footer
                    const tempPages = [{ left: [], right: [] }];
                    
                    const tpl = this.content.settings.template || 'classic_prof';
                    const isOneColumn = false; // Fallback feature flag if needed later

                    let headerOffsets = {
                        'classic_prof': { left: 300, right: 350 },
                        'modern_bento': { left: 420, right: 140 }, 
                        'creative_ats': { left: 400, right: 140 }, 
                        'minimalist': { left: 320, right: 320 } 
                    };
                    const offsetMap = headerOffsets[tpl] || headerOffsets['classic_prof'];

                    if (isOneColumn) {
                        let currentHeight = offsetMap.left; // Initial offset for Page 1 Header
                        let currentPageIdx = 0;

                        const processList = (sections, side) => {
                            sections.forEach(originalSection => {
                                let section = JSON.parse(JSON.stringify(originalSection));
                                const height = this.estimateHeight(section);
                                
                                if (currentHeight + height > MAX_HEIGHT) {
                                    if (section.items && section.items.length > 1) {
                                        let fits = [];
                                        let overflows = [];
                                        let testHeight = 50;

                                        section.items.forEach(item => {
                                            const itemH = 60 + (item.description ? item.description.length / 5 : 0);
                                            if (currentHeight + testHeight + itemH < MAX_HEIGHT) {
                                                fits.push(item);
                                                testHeight += itemH;
                                            } else {
                                                overflows.push(item);
                                            }
                                        });

                                        if (fits.length > 0) {
                                            section.items = fits;
                                            tempPages[currentPageIdx][side].push(section);
                                        }

                                        if (overflows.length > 0) {
                                            currentPageIdx++;
                                            if (!tempPages[currentPageIdx]) tempPages.push({ left: [], right: [] });
                                            
                                            tempPages[currentPageIdx][side].push({
                                                ...section,
                                                items: overflows,
                                                isSplit: true
                                            });
                                            currentHeight = 50; 
                                        }
                                    } else {
                                        currentPageIdx++;
                                        if (!tempPages[currentPageIdx]) tempPages.push({ left: [], right: [] });
                                        tempPages[currentPageIdx][side].push(section);
                                        currentHeight = height + 50;
                                    }
                                } else {
                                    tempPages[currentPageIdx][side].push(section);
                                    currentHeight += height;
                                }
                            });
                        };

                        processList(this.content.left_sections, 'left');
                        processList(this.content.right_sections, 'right');
                    } else {
                        const processColumn = (sections, side) => {
                            let currentSideHeight = (side === 'left' ? offsetMap.left : offsetMap.right); // Dynamic Initial offset
                            let currentPageIdx = 0;

                            sections.forEach(originalSection => {
                                let section = JSON.parse(JSON.stringify(originalSection));
                                const height = this.estimateHeight(section);
                                
                                if (currentSideHeight + height > MAX_HEIGHT) {
                                    if (section.items && section.items.length > 1) {
                                        let fits = [];
                                        let overflows = [];
                                        let testHeight = 50; // New section header

                                        section.items.forEach(item => {
                                            const itemH = 60 + (item.description ? item.description.length / 5 : 0);
                                            if (currentSideHeight + testHeight + itemH < MAX_HEIGHT) {
                                                fits.push(item);
                                                testHeight += itemH;
                                            } else {
                                                overflows.push(item);
                                            }
                                        });

                                        if (fits.length > 0) {
                                            section.items = fits;
                                            tempPages[currentPageIdx][side].push(section);
                                        }

                                        if (overflows.length > 0) {
                                            currentPageIdx++;
                                            if (!tempPages[currentPageIdx]) tempPages.push({ left: [], right: [] });
                                            
                                            tempPages[currentPageIdx][side].push({
                                                ...section,
                                                items: overflows,
                                                isSplit: true
                                            });
                                            currentSideHeight = 50; // Reset height for new page (except header)
                                        }
                                    } else {
                                        currentPageIdx++;
                                        if (!tempPages[currentPageIdx]) tempPages.push({ left: [], right: [] });
                                        tempPages[currentPageIdx][side].push(section);
                                        currentSideHeight = height + 50;
                                    }
                                } else {
                                    tempPages[currentPageIdx][side].push(section);
                                    currentSideHeight += height;
                                }
                            });
                        };

                        processColumn(this.content.left_sections, 'left');
                        processColumn(this.content.right_sections, 'right');
                    }

                    this.pages = tempPages;
                },

                estimateHeight(section) {
                    let h = 40; 
                    if (section.type === 'text') {
                        h += (section.content ? section.content.length / 3 : 20);
                    } else if (section.items) {
                        section.items.forEach(it => {
                            h += 60;
                            if (it.description) h += it.description.length / 5;
                        });
                    }
                    return h;
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
                    section.type = null; 
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
                    const statusText = document.getElementById('save-status-text');
                    const statusIcon = document.getElementById('save-status-icon');
                    
                    if(status) {
                        status.classList.remove('text-emerald-500');
                        status.classList.add('text-blue-500');
                        if(statusText) statusText.innerText = 'Đang lưu...';
                        if(statusIcon) {
                            statusIcon.innerText = 'sync';
                            statusIcon.classList.add('animate-spin');
                        }
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
                            status.classList.remove('text-blue-500');
                            status.classList.add('text-emerald-500');
                            if(statusText) statusText.innerText = 'Đã lưu';
                            if(statusIcon) {
                                statusIcon.innerText = 'done';
                                statusIcon.classList.remove('animate-spin');
                            }
                            setTimeout(() => status.classList.add('opacity-0'), 2000);
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
        
        /* Dynamic Templates CSS */
        
        /* template: classic_prof (Default) */
        .cv-left-col { width: 35%; }
        
        /* template: modern_bento (Image 1) */
        .page-a4[data-template="modern_bento"]::before {
            content: ""; position: absolute; left: calc(24mm + 1.5rem); top: 0; bottom: 0; width: 1.5rem; 
            background-color: rgba(203, 213, 225, 0.4); z-index: 0;
        }
        .page-a4[data-template="modern_bento"] .cv-cols-container { padding: 0 1.5rem; }
        .page-a4[data-template="modern_bento"] .cv-cols-container.is-first-page-body .cv-right-col { margin-top: -280px; }
        .page-a4[data-template="modern_bento"] .cv-left-col { width: 35%; padding-left: 0.5rem; padding-right: 1.5rem; }
        .page-a4[data-template="modern_bento"] .cv-right-col { width: 65%; padding-right: 1rem; }
        .page-a4[data-template="modern_bento"] .cv-sec-header { 
            background-color: #e2e8f0; display: inline-flex; padding: 0.35rem 1rem 0.35rem 0.75rem; 
            border-radius: 4px; border-left: 6px solid #64748b; margin-bottom: 1rem; 
        }
        .page-a4[data-template="modern_bento"] .cv-sec-title { color: #1e293b; font-size: 1rem; }
        .page-a4[data-template="modern_bento"] .cv-sec-line { display: none; }
        .page-a4[data-template="modern_bento"] .item-block { border-left-color: #cbd5e1; }
        
        /* template: minimalist (Image 3) */
        .page-a4[data-template="minimalist"] .cv-cols-container { gap: 4rem; padding: 0 2.5rem; }
        .page-a4[data-template="minimalist"] .cv-left-col { width: 35%; }
        .page-a4[data-template="minimalist"] .cv-right-col { width: 65%; }
        .page-a4[data-template="minimalist"] .cv-sec-header { display: flex; align-items: center; border: none; padding: 0; margin-bottom: 1.5rem; margin-top: 1rem; }
        .page-a4[data-template="minimalist"] .cv-sec-title { 
            color: #334155; text-transform: uppercase; font-size: 1.1rem; border: none; width: auto; font-weight: normal; 
        }
        .page-a4[data-template="minimalist"] .cv-sec-title::before { content: "// "; color: #1e40af; font-weight: bold; margin-right: 4px; }
        .page-a4[data-template="minimalist"] .cv-sec-line { display: block; height: 1px; background-color: #cbd5e1; flex: 1; margin-left: 1rem; }
        .page-a4[data-template="minimalist"] .cv-sec-dot { display: none; }
        .page-a4[data-template="minimalist"] .item-block { border-left: none; padding-left: 0; margin-bottom: 1rem; }
        
        /* template: creative_ats (Image 2) */
        .page-a4[data-template="creative_ats"]::before {
            content: ""; position: absolute; left: 0; top: 0; bottom: 0; width: 38%;
            background-color: #1e293b; z-index: 0;
        }
        .page-a4[data-template="creative_ats"] .cv-cols-container { gap: 0; }
        .page-a4[data-template="creative_ats"] .cv-cols-container.is-first-page-body .cv-right-col { margin-top: -260px; }
        .page-a4[data-template="creative_ats"] .cv-left-col { width: 38%; padding-left: 2.5rem; padding-right: 1.5rem; color: rgba(255,255,255,0.8); }
        .page-a4[data-template="creative_ats"] .cv-left-col .cv-sec-title { color: white; border-bottom: 1px solid rgba(255,255,255,0.2); border-left: none; width: 100%; padding-bottom: 0.5rem; margin-bottom: 1rem; }
        .page-a4[data-template="creative_ats"] .cv-right-col { width: 62%; padding-right: 2.5rem; padding-left: 2rem; }
        .page-a4[data-template="creative_ats"] .cv-right-col .cv-sec-header { padding: 0; align-items: end; border: none; margin-bottom: 1.5rem; }
        .page-a4[data-template="creative_ats"] .cv-right-col .cv-sec-title { 
            color: #1e293b; font-size: 1.1rem; border-bottom: 2px solid #22c55e; width: 100%; display: block; padding-bottom: 0.25rem; 
        }
        .page-a4[data-template="creative_ats"] .cv-sec-line { display: none; }
        .page-a4[data-template="creative_ats"] .cv-right-col .item-block { 
            border-left: 1px solid #94a3b8; padding-left: 1.25rem; margin-left: 0.25rem; position: relative; 
        }
        .page-a4[data-template="creative_ats"] .cv-right-col .item-block::before {
            content: ""; position: absolute; left: -4.5px; top: 6px; width: 8px; height: 8px; background-color: #1e293b; border-radius: 50%;
        }
        .page-a4[data-template="creative_ats"] .cv-left-col .item-block { border-left-color: rgba(255,255,255,0.2); }
    </style>
</x-app-layout>

