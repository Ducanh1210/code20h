<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 fw-bold text-dark">
            {{ __('Chỉnh sửa tài khoản') }} 🛠️
        </h2>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center mb-5 pb-4 border-bottom">
                        <div class="rounded-3 bg-primary text-white d-flex align-items-center justify-content-center fw-bold me-3" style="width: 56px; height: 56px; font-size: 24px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
                            <p class="text-muted small mb-0">Cập nhật hồ sơ và quyền truy cập của người dùng.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label small fw-bold text-uppercase text-secondary" style="letter-spacing: 1px;">Họ và Tên</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control form-control-lg bg-light border-0 rounded-3 px-4 py-3 @error('name') is-invalid @enderror" required autofocus>
                            @error('name')
                                <div class="invalid-feedback fw-bold small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="form-label small fw-bold text-uppercase text-secondary" style="letter-spacing: 1px;">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control form-control-lg bg-light border-0 rounded-3 px-4 py-3 @error('email') is-invalid @enderror" required>
                            @error('email')
                                <div class="invalid-feedback fw-bold small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role (Read-only as per request) -->
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-secondary" style="letter-spacing: 1px;">Quyền Truy Cập</label>
                            <div class="form-control-plaintext bg-light rounded-3 px-4 py-3 fw-bold">
                                {{ $user->role === 'admin' ? 'Admin (Quản trị viên)' : 'User (Người dùng thường)' }}
                            </div>
                            <p class="small text-muted mt-2">Lưu ý: Quyền truy cập không thể thay đổi sau khi tạo.</p>
                        </div>

                        <div class="p-4 bg-light rounded-4 mb-5 border">
                            <p class="small fw-bold text-danger text-uppercase mb-3 d-flex align-items-center">
                                <span class="material-symbols-outlined me-2" style="font-size: 20px;">security</span>
                                Bảo mật
                            </p>
                            <div class="row g-4">
                                <!-- Password -->
                                <div class="col-md-6">
                                    <label for="password" class="form-label text-muted small fw-bold">Mật khẩu mới (Để trống nếu không đổi)</label>
                                    <input id="password" type="password" name="password" class="form-control bg-white border-0 rounded-3 px-4 py-3 @error('password') is-invalid @enderror" autocomplete="new-password">
                                    @error('password')
                                        <div class="invalid-feedback fw-bold small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label text-muted small fw-bold">Xác nhận mật khẩu</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control bg-white border-0 rounded-3 px-4 py-3">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-3 pt-4 border-top">
                            <a class="btn btn-link text-muted fw-bold text-decoration-none text-uppercase small" style="letter-spacing: 1px;" href="{{ route('admin.users.index') }}">
                                {{ __('Quay lại') }}
                            </a>
                            <button type="submit" class="btn btn-primary px-5 py-3 rounded-3 fw-bold text-uppercase small shadow-sm" style="letter-spacing: 1px;">
                                {{ __('Lưu Thay Đổi') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
