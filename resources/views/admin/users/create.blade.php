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
