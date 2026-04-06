<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-sky-500">group</span>
            <span>Khách hàng & Thành viên</span>
        </div>
    </x-slot>

    <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="glass-card p-6 rounded-[2rem] shadow-sm border border-slate-200/60 transition-all hover:shadow-xl hover:scale-[1.02]">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-sky-500/10 rounded-2xl flex items-center justify-center text-sky-600">
                        <span class="material-symbols-outlined">group</span>
                    </div>
                </div>
                <h4 class="text-3xl font-black text-slate-900 mb-1">{{ $users->total() }}</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tổng người dùng</p>
            </div>
            
            <div class="glass-card p-6 rounded-[2rem] shadow-sm border border-slate-200/60 transition-all hover:shadow-xl hover:scale-[1.02]">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-600">
                        <span class="material-symbols-outlined">shield_person</span>
                    </div>
                </div>
                <h4 class="text-3xl font-black text-slate-900 mb-1">{{ \App\Models\User::where('role', 'admin')->count() }}</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Quản trị viên</p>
            </div>

            <div class="glass-card p-6 rounded-[2rem] shadow-sm border border-slate-200/60 transition-all hover:shadow-xl hover:scale-[1.02]">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-600">
                        <span class="material-symbols-outlined">person_search</span>
                    </div>
                </div>
                <h4 class="text-3xl font-black text-slate-900 mb-1">{{ \App\Models\User::where('role', 'employer')->count() }}</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nhà tuyển dụng</p>
            </div>

            <div class="glass-card p-6 rounded-[2rem] shadow-sm border border-slate-200/60 transition-all hover:shadow-xl hover:scale-[1.02]">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-600">
                        <span class="material-symbols-outlined">badge</span>
                    </div>
                </div>
                <h4 class="text-3xl font-black text-slate-900 mb-1">{{ \App\Models\User::where('role', 'candidate')->count() }}</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Ứng viên</p>
            </div>
        </div>

        <!-- Main Table Area -->
        <div class="glass-card rounded-[2.5rem] shadow-sm border border-white overflow-hidden p-2">
            <div class="p-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Danh sách tài khoản</h3>
                    <p class="text-xs text-slate-400 font-medium">Quản lý và cập nhật thông tin thành viên hệ thống.</p>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-4">
                    <!-- Search Bar -->
                    <form action="{{ route('admin.users.index') }}" method="GET" class="flex items-center gap-2">
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-sky-500 transition-colors">search</span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm tên hoặc email..." 
                                class="pl-12 pr-4 py-3 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 text-sm w-full md:w-64 placeholder:font-medium">
                        </div>
                        <button type="submit" class="p-3 bg-slate-900 text-white rounded-2xl hover:bg-slate-800 transition-all active:scale-95">
                            <span class="material-symbols-outlined">filter_list</span>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.users.index') }}" class="p-3 bg-slate-100 text-slate-500 rounded-2xl hover:bg-slate-200 transition-all active:scale-95" title="Xóa lọc">
                                <span class="material-symbols-outlined">close</span>
                            </a>
                        @endif
                    </form>

                    <a href="{{ route('admin.users.create') }}" class="flex items-center gap-2 px-6 py-3 bg-sky-500 hover:bg-sky-600 text-white rounded-2xl font-bold text-sm shadow-lg shadow-sky-500/25 transition-all active:scale-95 whitespace-nowrap">
                        <span class="material-symbols-outlined">person_add</span>
                        Thêm người dùng
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b border-slate-100">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Người dùng</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Vai trò</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Ngày đăng ký</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($users as $user)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center font-black text-slate-400 border border-white group-hover:from-sky-50 transition-all">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 text-sm leading-tight">{{ $user->name }}</p>
                                        <p class="text-[11px] text-slate-400 font-medium">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                @php
                                    $roleColors = [
                                        'admin' => 'bg-emerald-500/10 text-emerald-600',
                                        'employer' => 'bg-amber-500/10 text-amber-600',
                                        'candidate' => 'bg-purple-500/10 text-purple-600'
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $roleColors[$user->role] ?? 'bg-slate-100 text-slate-500' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <p class="text-xs font-bold text-slate-600 capitalize tracking-tight">
                                    {{ $user->created_at->translatedFormat('d M, Y') }}
                                </p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                    {{ $user->created_at->diffForHumans() }}
                                </p>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center hover:bg-sky-500 hover:text-white transition-all shadow-sm">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all shadow-sm {{ $user->id === auth()->id() ? 'opacity-20 cursor-not-allowed' : '' }}" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <span class="material-symbols-outlined text-slate-200 text-6xl">search_off</span>
                                    <p class="font-bold text-slate-400 text-sm">Không tìm thấy người dùng nào phù hợp.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-8 py-6 border-t border-slate-100">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    @if(session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-8 right-8 bg-sky-500 text-white px-6 py-4 rounded-3xl shadow-2xl flex items-center gap-3 z-[100] animate-in slide-in-from-right-4 duration-500" x-transition.out.opacity.duration.1000ms>
        <span class="material-symbols-outlined">check_circle</span>
        <p class="font-bold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-8 right-8 bg-rose-500 text-white px-6 py-4 rounded-3xl shadow-2xl flex items-center gap-3 z-[100] animate-in slide-in-from-right-4 duration-500" x-transition.out.opacity.duration.1000ms>
        <span class="material-symbols-outlined">error</span>
        <p class="font-bold text-sm">{{ session('error') }}</p>
    </div>
    @endif

</x-admin-layout>
