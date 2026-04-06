<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="space-y-1">
                <h2 class="text-3xl font-extrabold tracking-tight text-primary uppercase">Chọn mẫu CV yêu thích</h2>
                <p class="text-slate-500 text-lg font-medium">Bắt đầu với một bộ khung chuyên nghiệp để AI tối ưu hóa tốt nhất.</p>
            </div>
            <a href="{{ route('client.cv-management') }}" class="px-6 py-2.5 bg-slate-100 text-slate-600 font-bold rounded-xl hover:bg-slate-200 transition-all uppercase text-xs tracking-widest flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">close</span>
                Hủy bỏ
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-12 px-4" x-data="{ filter: 'All' }">
        <!-- Category Filters -->
        <div class="flex flex-wrap items-center justify-between gap-6 mb-12">
            <div class="flex items-center bg-white p-1.5 rounded-2xl shadow-sm border border-slate-100">
                <template x-for="cat in ['All', 'Professional', 'Modern', 'Simple', 'ATS']">
                    <button @click="filter = cat" 
                            :class="filter === cat ? 'bg-primary text-white shadow-lg' : 'text-slate-400 hover:text-primary'"
                            class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all" 
                            x-text="cat === 'All' ? 'Tất cả' : cat">
                    </button>
                </template>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ngôn ngữ:</span>
                <select class="bg-white border-slate-100 rounded-xl text-xs font-bold text-primary focus:ring-primary/20">
                    <option>Tiếng Việt</option>
                    <option>Tiếng Anh</option>
                </select>
            </div>
        </div>

        <!-- Templates Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($templates as $template)
            <div x-show="filter === 'All' || filter === '{{ $template['category'] }}'" 
                 class="group bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col h-full"
                 x-data="{ selectedColor: '{{ $template['colors'][0] }}' }">
                
                <!-- Preview Container -->
                <div class="aspect-[3/4] bg-slate-50 relative overflow-hidden p-6 cursor-pointer group-hover:bg-slate-100 transition-colors">
                    <!-- High-Fidelity CSS Preview Mockup -->
                    <div class="w-full h-full bg-white shadow-2xl rounded-lg overflow-hidden border border-slate-100 relative group-hover:scale-[1.02] transition-transform duration-500">
                        <!-- Sidebar Template (Modern) -->
                        @if($template['id'] === 'modern_bento')
                            <div class="flex h-full">
                                <div :class="'w-1/3 h-full opacity-20 bg-' + selectedColor + '-500'"></div>
                                <div class="p-4 space-y-3 flex-1">
                                    <div :class="'h-3 w-3/4 rounded bg-' + selectedColor + '-100'"></div>
                                    <div class="h-2 w-1/2 rounded bg-slate-50"></div>
                                    <div class="pt-4 grid grid-cols-2 gap-2">
                                        <div class="h-10 rounded bg-slate-50"></div>
                                        <div class="h-10 rounded bg-slate-50"></div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="p-6 space-y-4">
                                <div :class="'h-4 w-1/2 rounded bg-' + selectedColor + '-200'"></div>
                                <div class="h-2 w-full rounded bg-slate-50"></div>
                                <div class="h-2 w-full rounded bg-slate-50"></div>
                                <div class="pt-4 space-y-2">
                                    <div :class="'h-1 w-full bg-' + selectedColor + '-100'"></div>
                                    <div class="h-10 rounded bg-slate-50"></div>
                                    <div class="h-10 rounded bg-slate-50"></div>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Overlay Action -->
                        <div class="absolute inset-0 bg-primary/80 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                            <form action="{{ route('client.cv-templates.select') }}" method="POST">
                                @csrf
                                <input type="hidden" name="template_id" value="{{ $template['id'] }}">
                                <input type="hidden" name="base_color" :value="selectedColor">
                                <button type="submit" class="px-8 py-3 bg-white text-primary font-black rounded-xl uppercase text-[10px] tracking-widest hover:scale-105 transition-transform">
                                    SỬ DỤNG MẪU NÀY
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Template Info -->
                <div class="p-8 space-y-4 flex flex-col flex-1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-black text-primary headline tracking-tight">{{ $template['name'] }}</h3>
                        <span class="px-2.5 py-0.5 bg-slate-100 text-slate-400 text-[9px] font-black rounded-full uppercase">{{ $template['category'] }}</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed line-clamp-2">{{ $template['description'] }}</p>
                    
                    <!-- Color Swatches -->
                    <div class="pt-4 mt-auto border-t border-slate-50 flex items-center justify-between">
                        <div class="flex gap-2">
                            @foreach($template['colors'] as $color)
                                <button @click="selectedColor = '{{ $color }}'" 
                                        :class="selectedColor === '{{ $color }}' ? 'ring-2 ring-offset-2 ring-primary scale-110' : ''"
                                        class="w-4 h-4 rounded-full bg-{{ $color }}-500 transition-all">
                                </button>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-1.5 text-[9px] font-black text-slate-300">
                            <span class="material-symbols-outlined text-sm">favorite</span>
                            {{ rand(10, 50) }}K
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <style>
        .headline { font-family: 'Be Vietnam Pro', sans-serif; }
    </style>
</x-app-layout>
