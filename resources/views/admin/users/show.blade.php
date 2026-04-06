<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold text-dark">
                {{ __('Chi tiết thành viên') }} 👤
            </h2>
            <a href="{{ route('admin.users.index') }}" class="btn btn-light px-4 fw-bold">
                {{ __('Quay lại') }}
            </a>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-primary py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="rounded-pill bg-white text-primary d-flex align-items-center justify-content-center fw-bold me-4 shadow" style="width: 80px; height: 80px; font-size: 32px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="text-white">
                            <h3 class="fw-bold mb-1">{{ $user->name }}</h3>
                            <p class="mb-0 opacity-75">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-4 border-0">
                                <label class="small fw-bold text-uppercase text-secondary d-block mb-2" style="letter-spacing: 1px;">ID tài khoản</label>
                                <p class="h5 fw-bold text-dark mb-0">#{{ $user->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-4 border-0">
                                <label class="small fw-bold text-uppercase text-secondary d-block mb-2" style="letter-spacing: 1px;">Vai trò hệ thống</label>
                                @if($user->role === 'admin')
                                    <span class="badge bg-dark fs-6 rounded-pill px-3">Quản trị viên</span>
                                @else
                                    <span class="badge bg-primary fs-6 rounded-pill px-3">Thành viên</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-4 border-0">
                                <label class="small fw-bold text-uppercase text-secondary d-block mb-2" style="letter-spacing: 1px;">Ngày tham gia</label>
                                <p class="h5 fw-bold text-dark mb-0">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-4 border-0">
                                <label class="small fw-bold text-uppercase text-secondary d-block mb-2" style="letter-spacing: 1px;">Cập nhật lần cuối</label>
                                <p class="h5 fw-bold text-dark mb-0">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top d-flex gap-3">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary px-5 py-3 rounded-3 fw-bold text-uppercase small shadow-sm" style="letter-spacing: 1px;">
                            {{ __('Chỉnh sửa tài khoản') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
