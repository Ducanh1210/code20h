<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-sky-500">person</span>
            <span>Chi tiết tài khoản: {{ $user->name }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="glass-card rounded-[2.5rem] shadow-sm border border-white overflow-hidden p-10">
            <div class="mb-10 flex items-center gap-6">
                <div class="w-24 h-24 rounded-[2.5rem] bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center font-black text-slate-400 text-4xl border-4 border-white shadow-xl">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ $user->name }}</h3>
                    <p class="text-sm text-slate-400 font-medium">Thành viên hệ thống từ {{ $user->created_at->translatedFormat('d M, Y') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">ID Tài khoản</p>
                    <div class="p-4 bg-slate-50 rounded-2xl font-bold text-slate-900 border border-white">
                        #{{ $user->id }}
                    </div>
                </div>

                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Vai trò</p>
                    @php
                        $roleColors = [
                            'admin' => 'bg-emerald-500/10 text-emerald-600',
                            'employer' => 'bg-amber-500/10 text-amber-600',
                            'candidate' => 'bg-purple-500/10 text-purple-600'
                        ];
                        $roleNames = [
                            'admin' => 'Quản trị viên',
                            'employer' => 'Nhà tuyển dụng',
                            'candidate' => 'Ứng viên'
                        ];
                    @endphp
                    <div class="p-4 rounded-2xl font-bold border border-white {{ $roleColors[$user->role] ?? 'bg-slate-100 text-slate-500' }}">
                        {{ $roleNames[$user->role] ?? $user->role }}
                    </div>
                </div>

                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Địa chỉ Email</p>
                    <div class="p-4 bg-slate-50 rounded-2xl font-bold text-slate-900 border border-white flex items-center gap-3">
                        <span class="material-symbols-outlined text-slate-400 text-lg">mail</span>
                        {{ $user->email }}
                    </div>
                </div>

                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Ngày tham gia</p>
                    <div class="p-4 bg-slate-50 rounded-2xl font-bold text-slate-900 border border-white flex items-center gap-3">
                        <span class="material-symbols-outlined text-slate-400 text-lg">calendar_today</span>
                        {{ $user->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>

            <div class="pt-10 flex items-center justify-end gap-3 border-t border-slate-50 mt-10">
                <a href="{{ route('admin.users.index') }}" class="px-8 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl font-bold text-sm transition-all active:scale-95">
                    Quay lại
                </a>
                <a href="{{ route('admin.users.edit', $user) }}" class="px-10 py-4 bg-sky-500 hover:bg-sky-600 text-white rounded-2xl font-black text-sm shadow-xl shadow-sky-500/30 transition-all active:scale-95 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">edit</span>
                    Chỉnh sửa
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>
