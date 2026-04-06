<header class="fixed top-0 right-0 left-64 h-16 flex items-center justify-between px-8 z-40 glass-panel">
    <div class="flex items-center bg-surface-container-high px-4 py-2 rounded-full w-96">
        <span class="material-symbols-outlined text-slate-400 mr-2">search</span>
        <input class="bg-transparent border-none focus:ring-0 text-sm w-full placeholder:text-slate-400" 
               placeholder="Tìm kiếm CV, công việc..." 
               type="text" />
    </div>
    <div class="flex items-center gap-4">
        <!-- Notifications -->
        <button class="p-2 text-slate-500 hover:text-primary transition-colors relative">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-white"></span>
        </button>
        
        <!-- Help -->
        <button class="p-2 text-slate-500 hover:text-primary transition-colors">
            <span class="material-symbols-outlined">help</span>
        </button>
        
        <!-- Primary Action -->
        <button class="px-6 py-2 bg-secondary text-white rounded-full font-bold text-sm hover:brightness-110 transition-all shadow-lg shadow-secondary/20">
            Phân tích ngay
        </button>
    </div>
</header>
