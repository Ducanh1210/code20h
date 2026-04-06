<<<<<<< HEAD
<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-sky-500">person_add</span>
            <span>Thêm tài khoản mới</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="glass-card rounded-[2.5rem] shadow-sm border border-white overflow-hidden p-10">
            <div class="mb-10">
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Thông tin cơ bản</h3>
                <p class="text-sm text-slate-400 font-medium">Cung cấp các thông tin cần thiết để khởi tạo tài khoản mới.</p>
            </div>

            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Họ và tên</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-sky-500 transition-colors">person</span>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 placeholder:text-slate-300"
                                placeholder="VD: Nguyễn Văn A">
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
                                <option value="candidate" {{ old('role') == 'candidate' ? 'selected' : '' }}>Ứng viên (Candidate)</option>
                                <option value="employer" {{ old('role') == 'employer' ? 'selected' : '' }}>Nhà tuyển dụng (Employer)</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Quản trị viên (Admin)</option>
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
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                            class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 placeholder:text-slate-300"
                            placeholder="example@gmail.com">
                    </div>
                    @error('email')<p class="text-[10px] text-rose-500 font-bold px-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Mật khẩu</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-rose-500 transition-colors">lock</span>
                            <input type="password" name="password" id="password" required 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 placeholder:text-slate-300"
                                placeholder="••••••••">
                        </div>
                        @error('password')<p class="text-[10px] text-rose-500 font-bold px-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Xác nhận mật khẩu</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-rose-500 transition-colors">lock_reset</span>
                            <input type="password" name="password_confirmation" id="password_confirmation" required 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 placeholder:text-slate-300"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="pt-8 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}" class="px-8 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl font-bold text-sm transition-all active:scale-95">
                        Hủy bỏ
                    </a>
                    <button type="submit" class="px-10 py-4 bg-sky-500 hover:bg-sky-600 text-white rounded-2xl font-black text-sm shadow-xl shadow-sky-500/30 transition-all active:scale-95">
                        Tạo tài khoản
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
=======
<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 fw-bold text-dark">
            {{ __('Thêm người dùng mới') }} 👤
        </h2>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center mb-5 pb-4 border-bottom">
                        <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-4 me-3">
                            <span class="material-symbols-outlined fs-2">person_add</span>
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-1">Tạo tài khoản mới</h4>
                            <p class="text-muted small mb-0">Nhập thông tin bên dưới để đăng ký thành viên mới.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label small fw-bold text-uppercase text-secondary" style="letter-spacing: 1px;">Họ và Tên</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control form-control-lg bg-light border-0 rounded-3 px-4 py-3 @error('name') is-invalid @enderror" required autofocus placeholder="Ví dụ: Nguyễn Văn A">
                            @error('name')
                                <div class="invalid-feedback fw-bold small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="form-label small fw-bold text-uppercase text-secondary" style="letter-spacing: 1px;">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg bg-light border-0 rounded-3 px-4 py-3 @error('email') is-invalid @enderror" required placeholder="email@example.com">
                            @error('email')
                                <div class="invalid-feedback fw-bold small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label for="role" class="form-label small fw-bold text-uppercase text-secondary" style="letter-spacing: 1px;">Quyền Truy Cập</label>
                            <select id="role" name="role" class="form-select form-select-lg bg-light border-0 rounded-3 px-4 py-3 @error('role') is-invalid @enderror">
                                <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User (Người dùng thường)</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin (Quản trị viên)</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback fw-bold small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-4 mb-5">
                            <!-- Password -->
                            <div class="col-md-6">
                                <label for="password" class="form-label small fw-bold text-uppercase text-secondary" style="letter-spacing: 1px;">Mật Khẩu</label>
                                <input id="password" type="password" name="password" class="form-control form-control-lg bg-light border-0 rounded-3 px-4 py-3 @error('password') is-invalid @enderror" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback fw-bold small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label small fw-bold text-uppercase text-secondary" style="letter-spacing: 1px;">Xác nhận Mật Khẩu</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control form-control-lg bg-light border-0 rounded-3 px-4 py-3" required>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-3 pt-4 border-top">
                            <a class="btn btn-link text-muted fw-bold text-decoration-none text-uppercase small" style="letter-spacing: 1px;" href="{{ route('admin.users.index') }}">
                                {{ __('Hủy bỏ') }}
                            </a>
                            <button type="submit" class="btn btn-primary px-5 py-3 rounded-3 fw-bold text-uppercase small shadow-sm" style="letter-spacing: 1px;">
                                {{ __('Tạo Tài Khoản') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
>>>>>>> 14ee4e5678a0a7c7bfd39895dec67b34ad98870c
