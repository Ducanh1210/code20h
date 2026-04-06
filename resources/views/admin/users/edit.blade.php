<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-amber-500">manage_accounts</span>
            <span>Chỉnh sửa tài khoản: {{ $user->name }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="glass-card rounded-[2.5rem] shadow-sm border border-white overflow-hidden p-10">
            <div class="mb-10 flex items-center gap-6">
                <div class="w-20 h-20 rounded-[2rem] bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center font-black text-slate-400 text-3xl border-4 border-white shadow-lg">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">Cập nhật hồ sơ</h3>
                    <p class="text-sm text-slate-400 font-medium">Sửa đổi thông tin tài khoản hoặc phân quyền người dùng.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Họ và tên</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-sky-500 transition-colors">person</span>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 placeholder:text-slate-300">
                        </div>
                        @error('name')<p class="text-[10px] text-rose-500 font-bold px-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Role -->
                    <div class="space-y-2">
                        <label for="role" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Vai trò hệ thống</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-emerald-500 transition-colors">verified_user</span>
                            <select name="role" id="role" required
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 appearance-none">
                                <option value="candidate" {{ old('role', $user->role) == 'candidate' ? 'selected' : '' }}>Ứng viên (Candidate)</option>
                                <option value="employer" {{ old('role', $user->role) == 'employer' ? 'selected' : '' }}>Nhà tuyển dụng (Employer)</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Quản trị viên (Admin)</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none">expand_more</span>
                        </div>
                        @error('role')<p class="text-[10px] text-rose-500 font-bold px-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Địa chỉ Email</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-sky-500 transition-colors">mail</span>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required 
                            class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 placeholder:text-slate-300">
                    </div>
                    @error('email')<p class="text-[10px] text-rose-500 font-bold px-1">{{ $message }}</p>@enderror
                </div>

                <div class="pt-8 mb-4">
                    <h4 class="text-sm font-black text-amber-600 uppercase tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">shield</span> Đổi mật khẩu (Để trống nếu không đổi)
                    </h4>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Mật khẩu mới</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-rose-500 transition-colors">lock</span>
                            <input type="password" name="password" id="password"
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 placeholder:text-slate-200"
                                placeholder="••••••••">
                        </div>
                        @error('password')<p class="text-[10px] text-rose-500 font-bold px-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Xác nhận lại</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-rose-500 transition-colors">lock_reset</span>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 placeholder:text-slate-200"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="pt-8 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}" class="px-8 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl font-bold text-sm transition-all active:scale-95">
                        Quay lại
                    </a>
                    <button type="submit" class="px-10 py-4 bg-sky-500 hover:bg-sky-600 text-white rounded-2xl font-black text-sm shadow-xl shadow-sky-500/30 transition-all active:scale-95">
                        Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
