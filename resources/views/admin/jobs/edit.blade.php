<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-sky-500">edit_note</span>
            <span>Chỉnh sửa Job Description</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="glass-card rounded-[2.5rem] shadow-sm border border-white overflow-hidden p-10">
            <div class="mb-10">
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Cập nhật mô tả công việc</h3>
                <p class="text-sm text-slate-400 font-medium">Chỉnh sửa thông tin chi tiết cho vị trí: <span class="text-sky-500 font-bold">{{ $job->title }}</span></p>
            </div>

            <form method="POST" action="{{ route('admin.jobs.update', $job) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="space-y-2">
                        <label for="title" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Tiêu đề công việc <span class="text-rose-500">*</span></label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-sky-500 transition-colors">work</span>
                            <input type="text" name="title" id="title" value="{{ old('title', $job->title) }}" required 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 placeholder:text-slate-300"
                                placeholder="VD: Senior Backend Developer">
                        </div>
                        @error('title')<p class="text-[10px] text-rose-500 font-bold px-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Domain -->
                    <div class="space-y-2">
                        <label for="domain" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Lĩnh vực</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-emerald-500 transition-colors">category</span>
                            <input type="text" name="domain" id="domain" value="{{ old('domain', $job->domain) }}" 
                                class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 placeholder:text-slate-300"
                                placeholder="VD: IT, Marketing, Kế toán...">
                        </div>
                        @error('domain')<p class="text-[10px] text-rose-500 font-bold px-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Employer -->
                <div class="space-y-2">
                    <label for="employer_id" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Người đăng tuyển <span class="text-rose-500">*</span></label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-sky-500 transition-colors">person</span>
                        <select name="employer_id" id="employer_id" required
                            class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-bold text-slate-900 appearance-none">
                            <option value="">Chọn người đăng tuyển</option>
                            @foreach($employers as $employer)
                                <option value="{{ $employer->id }}" {{ old('employer_id', $job->employer_id) == $employer->id ? 'selected' : '' }}>
                                    {{ $employer->name }} ({{ $employer->email }})
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none">expand_more</span>
                    </div>
                    @error('employer_id')<p class="text-[10px] text-rose-500 font-bold px-1">{{ $message }}</p>@enderror
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label for="description" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Mô tả chi tiết</label>
                    <div class="relative group">
                        <textarea name="description" id="description" rows="6"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-medium text-slate-900 placeholder:text-slate-300 resize-none"
                            placeholder="Nhập mô tả chi tiết về công việc...">{{ old('description', $job->description) }}</textarea>
                    </div>
                    @error('description')<p class="text-[10px] text-rose-500 font-bold px-1">{{ $message }}</p>@enderror
                </div>

                <!-- Requirements -->
                <div class="space-y-2">
                    <label for="requirements" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">Yêu cầu công việc</label>
                    <p class="text-[11px] text-slate-400 px-1">Mỗi yêu cầu viết trên một dòng</p>
                    <div class="relative group">
                        <textarea name="requirements" id="requirements" rows="6"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500/20 transition-all font-medium text-slate-900 placeholder:text-slate-300 resize-none"
                            placeholder="VD:&#10;Có 3 năm kinh nghiệm lập trình Java&#10;Thành thạo Spring Boot, Hibernate">{{ old('requirements', is_array($job->requirements) ? implode("\n", $job->requirements) : $job->requirements) }}</textarea>
                    </div>
                    @error('requirements')<p class="text-[10px] text-rose-500 font-bold px-1">{{ $message }}</p>@enderror
                </div>

                <div class="pt-8 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.jobs.index') }}" class="px-8 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl font-bold text-sm transition-all active:scale-95">
                        Hủy bỏ
                    </a>
                    <button type="submit" class="px-10 py-4 bg-sky-500 hover:bg-sky-600 text-white rounded-2xl font-black text-sm shadow-xl shadow-sky-500/30 transition-all active:scale-95 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">save</span>
                        Cập nhật JD
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
