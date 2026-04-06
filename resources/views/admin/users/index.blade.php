<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 fw-bold text-dark">
            {{ __('Quản lý thành viên') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center">
                <span class="material-symbols-outlined me-2">check_circle</span>
                <span class="fw-bold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <!-- Search Box & Add Button Row -->
                <div class="row g-2 mb-4 align-items-center">
                    <div class="col-md-8 col-lg-6">
                        <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex gap-2">
                            <div class="input-group flex-grow-1">
                                <span class="input-group-text bg-light border-end-0">
                                    <span class="material-symbols-outlined text-muted" style="font-size: 20px;">search</span>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo tên hoặc email..." class="form-control bg-light border-start-0 focus-none">
                            </div>
                            <button type="submit" class="btn btn-dark fw-bold px-4">
                                {{ __('Tìm kiếm') }}
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.users.index') }}" class="btn btn-light fw-bold text-muted px-4">
                                    {{ __('Xóa lọc') }}
                                </a>
                            @endif
                        </form>
                    </div>
                    <div class="col-auto ms-auto">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-4 fw-bold d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined" style="font-size: 20px;">add</span>
                            {{ __('Thêm mới') }}
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-secondary small fw-bold text-uppercase px-3 py-3" style="letter-spacing: 1px;">ID</th>
                                <th class="text-secondary small fw-bold text-uppercase px-3 py-3" style="letter-spacing: 1px;">Người dùng</th>
                                <th class="text-secondary small fw-bold text-uppercase px-3 py-3" style="letter-spacing: 1px;">Email</th>
                                <th class="text-secondary small fw-bold text-uppercase px-3 py-3" style="letter-spacing: 1px;">Vai trò</th>
                                <th class="text-secondary small fw-bold text-uppercase px-3 py-3" style="letter-spacing: 1px;">Ngày tạo</th>
                                <th class="text-secondary small fw-bold text-uppercase px-3 py-3 text-end" style="letter-spacing: 1px;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="px-3 py-3 text-secondary">#{{ $user->id }}</td>
                                    <td class="px-3 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold me-3" style="width: 36px; height: 36px;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 text-secondary small">{{ $user->email }}</td>
                                    <td class="px-3 py-3">
                                        @if($user->role === 'admin')
                                            <span class="badge bg-dark text-white rounded-pill px-3" style="font-size: 10px; font-weight: 800;">ADMIN</span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3" style="font-size: 10px; font-weight: 800;">MEMBER</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 text-secondary small">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="px-3 py-3 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-light fw-bold text-primary px-3">Xem</a>
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-light fw-bold text-success px-3">Sửa</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted fst-italic">Không tìm thấy người dùng nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 pt-3 border-top d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
