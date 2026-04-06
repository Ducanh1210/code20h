<div class="admin-sidebar">
    <!-- Brand -->
    <div class="sidebar-brand">
        <h1>CODE20H</h1>
        <span>Quản trị viên</span>
    </div>

    <!-- Main Navigation -->
    <div class="nav-section">
        <div class="nav-section-title">Tổng quan</div>
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="material-symbols-outlined">dashboard</span>
            Bảng điều khiển
        </a>
    </div>

    @if(Auth::user()->role === 'admin')
    <div class="nav-section">
        <div class="nav-section-title">Quản lý</div>
        <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">group</span>
            Người dùng
        </a>
        <!-- Add more nav items here if needed -->
    </div>
    @endif

    <!-- Bottom -->
    <div class="sidebar-bottom">
        <a href="{{ url('/') }}">
            <span class="material-symbols-outlined" style="font-size:18px">storefront</span>
            Về trang chủ
        </a>
    </div>
</div>
