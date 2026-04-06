<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 fw-bold text-dark">
            {{ __('Chào mừng trở lại, ') . Auth::user()->name }}! 👋
        </h2>
    </x-slot>

    <div class="container-fluid p-0">
        <!-- Welcome Banner -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
            <div class="card-body p-5 text-white position-relative shadow-lg" style="z-index: 1;">
                <h3 class="display-5 fw-bold mb-3 italic">Làm việc hiệu quả nhé!</h3>
                <p class="lead mb-4 opacity-75">Khám phá các tính năng quản lý tài khoản và tối ưu hóa quy trình làm việc của bạn ngay từ Dashboard này.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('profile.edit') }}" class="btn btn-white text-primary fw-bold px-4 py-2 rounded-3 shadow-sm bg-white border-0">Cập nhật Profile</a>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-white text-white border-white border-opacity-25 fw-bold px-4 py-2 rounded-3" style="backdrop-filter: blur(5px); background: rgba(255,255,255,0.1);">Quản lý Thành viên</a>
                    @endif
                </div>
            </div>
            <!-- Decorative circle -->
            <div class="position-absolute top-0 end-0 mt-n5 me-n5 opacity-25" style="z-index: 0;">
                <svg width="400" height="400" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"><circle cx="100" cy="100" r="100" fill="white"/></svg>
            </div>
        </div>

        @if(Auth::user()->role === 'admin' && isset($totalUsers))
            <!-- Admin Stats Section -->
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 border-start border-primary border-5">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-uppercase text-muted small fw-bold mb-1" style="letter-spacing: 1px;">Tổng người dùng</div>
                                <div class="h2 fw-bold mb-0 text-dark">{{ $totalUsers }}</div>
                            </div>
                            <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-4">
                                <span class="material-symbols-outlined fs-2">group</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 border-start border-dark border-5">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-uppercase text-muted small fw-bold mb-1" style="letter-spacing: 1px;">Tài khoản Admin</div>
                                <div class="h2 fw-bold mb-0 text-dark">{{ $adminCount }}</div>
                            </div>
                            <div class="p-3 bg-dark bg-opacity-10 text-dark rounded-4">
                                <span class="material-symbols-outlined fs-2">admin_panel_settings</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            @if(isset($recentUsers))
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-light border-0 px-4 py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark">Thành viên mới gia nhập</h5>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-link link-primary fw-bold text-decoration-none small">Xem tất cả</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            @foreach($recentUsers as $user)
                                <div class="col-md-6 col-lg-4">
                                    <div class="d-flex align-items-center p-3 bg-light rounded-4 border-0 transition-all hover-shadow">
                                        <div class="rounded-3 bg-primary text-white d-flex align-items-center justify-content-center fw-bold me-3" style="width: 48px; height: 48px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div class="text-truncate">
                                            <div class="fw-bold text-dark text-truncate">{{ $user->name }}</div>
                                            <div class="small text-muted text-truncate">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @else
            <!-- Non-Admin Section -->
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-4 me-3">
                                <span class="material-symbols-outlined fs-2">lock</span>
                            </div>
                            <h5 class="mb-0 fw-bold text-dark">Thông tin</h5>
                        </div>
                        <p class="text-muted small italic mb-0">Hệ thống đang bảo mật dữ liệu cá nhân của bạn. Cập nhật thông tin định kỳ để đảm bảo an toàn.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
