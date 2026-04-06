<!DOCTYPE html>

<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Quản lý CV - Career Tailor</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&amp;family=Manrope:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-dim": "#d9d9e4",
                        "surface-container-highest": "#e1e2ec",
                        "on-tertiary": "#ffffff",
                        "inverse-surface": "#2e3038",
                        "on-surface-variant": "#434654",
                        "on-tertiary-container": "#6de2ff",
                        "on-primary-fixed-variant": "#004b72",
                        "error-container": "#ffdad6",
                        "on-secondary": "#ffffff",
                        "surface": "#faf8ff",
                        "surface-container": "#ededf8",
                        "on-primary-container": "#acd8ff",
                        "surface-bright": "#faf8ff",
                        "on-background": "#191b23",
                        "secondary": "#4648d4",
                        "surface-variant": "#e1e2ec",
                        "secondary-fixed-dim": "#c0c1ff",
                        "on-primary-fixed": "#001e31",
                        "primary": "#00476d",
                        "on-secondary-fixed-variant": "#2f2ebe",
                        "on-error": "#ffffff",
                        "primary-fixed": "#cce5ff",
                        "surface-container-low": "#f3f3fd",
                        "inverse-primary": "#90cdff",
                        "surface-container-lowest": "#ffffff",
                        "secondary-fixed": "#e1e0ff",
                        "tertiary-fixed-dim": "#4cd7f6",
                        "error": "#ba1a1a",
                        "on-surface": "#191b23",
                        "primary-container": "#006090",
                        "outline-variant": "#c3c6d6",
                        "surface-container-high": "#e7e7f2",
                        "on-primary": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-secondary-fixed": "#07006c",
                        "tertiary-container": "#006475",
                        "primary-fixed-dim": "#90cdff",
                        "outline": "#737685",
                        "tertiary-fixed": "#acedff",
                        "surface-tint": "#006496",
                        "on-secondary-container": "#fffbff",
                        "tertiary": "#004a58",
                        "on-tertiary-fixed": "#001f26",
                        "on-tertiary-fixed-variant": "#004e5c",
                        "background": "#faf8ff",
                        "inverse-on-surface": "#f0f0fb",
                        "secondary-container": "#6063ee"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Be Vietnam Pro"],
                        "body": ["Manrope"],
                        "label": ["Manrope"]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Manrope', sans-serif;
            line-height: 1.6;
        }

        h1,
        h2,
        h3,
        .headline {
            font-family: 'Be Vietnam Pro', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .glass-card {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>

<body class="bg-surface text-on-background">
    <!-- SideNavBar Shell -->
    <aside class="fixed left-0 top-0 h-full flex flex-col w-64 bg-[#faf8ff] dark:bg-slate-950 border-r-0 z-50">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-container rounded-xl flex items-center justify-center text-white shadow-lg">
                    <span class="material-symbols-outlined" data-icon="architecture">architecture</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-[#00476d] dark:text-white">Career Tailor</h1>
                    <p class="text-[10px] uppercase tracking-widest text-slate-500 font-bold">AI Assistant</p>
                </div>
            </div>
            <nav class="space-y-1">
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2 rounded-xl" href="#">
                    <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                    <span class="font-medium">Tổng quan</span>
                </a>
                <!-- Active State: Quản lý CV -->
                <a class="flex items-center gap-3 px-4 py-3 bg-[#00476d] text-white rounded-xl mx-2 scale-95 duration-150 transition-transform shadow-md shadow-primary/20" href="#">
                    <span class="material-symbols-outlined" data-icon="description" style="font-variation-settings: 'FILL' 1;">description</span>
                    <span class="font-medium">Quản lý CV</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2 rounded-xl" href="#">
                    <span class="material-symbols-outlined" data-icon="work">work</span>
                    <span class="font-medium">Việc làm</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2 rounded-xl" href="#">
                    <span class="material-symbols-outlined" data-icon="psychology">psychology</span>
                    <span class="font-medium">Phân tích AI</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2 rounded-xl" href="#">
                    <span class="material-symbols-outlined" data-icon="alt_route">alt_route</span>
                    <span class="font-medium">Lộ trình học</span>
                </a>
            </nav>
        </div>
        <div class="mt-auto p-6 space-y-4">
            <button class="w-full py-4 bg-gradient-to-r from-primary to-secondary rounded-2xl text-white font-bold text-sm shadow-xl hover:opacity-90 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined" data-icon="add">add</span>
                Tạo CV mới
            </button>
            <div class="pt-4 border-t border-slate-200/50">
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-200 transition-colors rounded-xl mx-2" href="#">
                    <span class="material-symbols-outlined" data-icon="settings">settings</span>
                    <span class="text-sm">Cài đặt</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-error hover:bg-error-container transition-colors rounded-xl mx-2" href="#">
                    <span class="material-symbols-outlined" data-icon="logout">logout</span>
                    <span class="text-sm">Đăng xuất</span>
                </a>
            </div>
        </div>
    </aside>
    <!-- Main Content Shell -->
    <main class="ml-64 min-h-screen bg-[#faf8ff] pb-12">
        <!-- TopAppBar -->
        <header class="fixed top-0 right-0 left-64 h-16 flex items-center justify-between px-8 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl">
            <div class="flex items-center gap-4 flex-1">
                <div class="relative w-full max-w-md">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl" data-icon="search">search</span>
                    <input class="w-full bg-surface-container-high border-none rounded-full py-2 pl-10 pr-4 focus:ring-2 focus:ring-primary/30 transition-all text-sm" placeholder="Tìm kiếm CV, kỹ năng, hoặc công ty..." type="text" />
                </div>
            </div>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2">
                    <button class="w-10 h-10 flex items-center justify-center rounded-full text-slate-500 hover:bg-slate-100 transition-colors">
                        <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                    </button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-full text-slate-500 hover:bg-slate-100 transition-colors">
                        <span class="material-symbols-outlined" data-icon="help">help</span>
                    </button>
                </div>
                <button class="px-6 py-2 bg-secondary text-white font-bold rounded-full text-sm hover:shadow-lg transition-all">
                    Phân tích ngay
                </button>
                <img alt="Người dùng" class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm" data-alt="close-up portrait of a professional man in a tailored blue suit with clean background and soft natural lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAhzbgUoHgOfTlci-kIjFpI8bz373sWjWkPP7HVSpFr9nxUVTouBu7WwiRxjE7xvlsLgjrVNhkMpT85zHRX1TnYfFqqbhAjNi6wUz_bntZObDxQF7zc9wHQl_-EJiHedm9l8HKWNYyqIdnhfmdb1B5PpRIuE8_HPQSVD4HwvymHlGEuSS8aomIgOZBaPA2p7jtKNm7eZJsZVmHX_YWAdnoiv2BEtM_2SaIS3Ilrn7V0eZsZ6wx2XtmaXYpQ9eJLPkwv-Li0V0hjG6Y" />
            </div>
        </header>
        <!-- Content Canvas -->
        <div class="pt-24 px-8 max-w-7xl mx-auto">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div class="space-y-1">
                    <h2 class="text-3xl font-extrabold tracking-tight text-primary">Quản lý CV</h2>
                    <p class="text-slate-500 text-lg">Tối ưu hóa hành trình sự nghiệp với trợ lý AI chuyên nghiệp.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-outline-variant/30 text-primary font-semibold rounded-xl hover:bg-slate-50 transition-all shadow-sm">
                        <span class="material-symbols-outlined text-xl" data-icon="upload">upload</span>
                        Tải CV lên
                    </button>
                    <button class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-bold rounded-xl hover:shadow-xl transition-all">
                        <span class="material-symbols-outlined text-xl" data-icon="add">add</span>
                        Tạo CV mới
                    </button>
                </div>
            </div>
            <!-- Filters Bar -->
            <div class="flex flex-wrap items-center gap-4 mb-8 bg-surface-container-low/50 p-4 rounded-2xl">
                <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg shadow-sm">
                    <span class="material-symbols-outlined text-slate-400 text-sm" data-icon="calendar_today">calendar_today</span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Ngày tạo:</span>
                    <select class="bg-transparent border-none text-sm font-semibold p-0 pr-6 focus:ring-0">
                        <option>Tất cả thời gian</option>
                        <option>7 ngày qua</option>
                        <option>30 ngày qua</option>
                    </select>
                </div>
                <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg shadow-sm">
                    <span class="material-symbols-outlined text-slate-400 text-sm" data-icon="filter_list">filter_list</span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Vị trí:</span>
                    <select class="bg-transparent border-none text-sm font-semibold p-0 pr-6 focus:ring-0">
                        <option>Tất cả công việc</option>
                        <option>Product Manager</option>
                        <option>UI/UX Designer</option>
                        <option>Software Engineer</option>
                    </select>
                </div>
                <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg shadow-sm">
                    <span class="material-symbols-outlined text-slate-400 text-sm" data-icon="star">star</span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Trạng thái:</span>
                    <select class="bg-transparent border-none text-sm font-semibold p-0 pr-6 focus:ring-0">
                        <option>Mọi trạng thái</option>
                        <option>Trên 80%</option>
                        <option>Cần cập nhật</option>
                    </select>
                </div>
                <div class="ml-auto text-sm text-slate-500">
                    Hiển thị <span class="font-bold text-primary">06</span> bản thảo CV
                </div>
            </div>
            <!-- CV Grid (Bento Style Layout) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1: Primary/Featured CV -->
                <div class="lg:col-span-1 bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/10 hover:shadow-xl transition-all group flex flex-col">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-16 bg-primary/5 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-3xl" data-icon="description">description</span>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-extrabold rounded-full uppercase tracking-tight">Khớp 92%</span>
                            <div class="relative">
                                <button class="w-8 h-8 rounded-full hover:bg-slate-100 flex items-center justify-center transition-colors">
                                    <span class="material-symbols-outlined text-slate-400" data-icon="more_vert">more_vert</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-primary mb-1 group-hover:text-secondary transition-colors">Senior Product Designer</h3>
                        <p class="text-slate-400 text-sm flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs" data-icon="schedule">schedule</span>
                            Cập nhật 2 giờ trước
                        </p>
                    </div>
                    <div class="flex items-center gap-2 mb-8 flex-wrap">
                        <span class="px-2 py-1 bg-slate-100 text-slate-600 text-[11px] font-semibold rounded-md">Figma</span>
                        <span class="px-2 py-1 bg-slate-100 text-slate-600 text-[11px] font-semibold rounded-md">AI Integration</span>
                        <span class="px-2 py-1 bg-slate-100 text-slate-600 text-[11px] font-semibold rounded-md">Agile</span>
                    </div>
                    <div class="mt-auto pt-4 flex items-center justify-between">
                        <button class="text-primary font-bold text-sm flex items-center gap-2 group/btn">
                            Xem chi tiết
                            <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform" data-icon="arrow_forward">arrow_forward</span>
                        </button>
                        <div class="flex -space-x-2">
                            <div class="w-7 h-7 rounded-full bg-secondary-fixed text-secondary flex items-center justify-center text-[10px] font-bold border-2 border-white">AI</div>
                            <div class="w-7 h-7 rounded-full bg-tertiary-fixed text-tertiary flex items-center justify-center text-[10px] font-bold border-2 border-white">DS</div>
                        </div>
                    </div>
                </div>
                <!-- Card 2: Needs Update -->
                <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/10 hover:shadow-xl transition-all group flex flex-col">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-16 bg-error/5 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-error text-3xl" data-icon="description">description</span>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="px-3 py-1 bg-error-container text-error text-[10px] font-extrabold rounded-full uppercase tracking-tight">Cần cập nhật</span>
                            <button class="w-8 h-8 rounded-full hover:bg-slate-100 flex items-center justify-center transition-colors">
                                <span class="material-symbols-outlined text-slate-400" data-icon="more_vert">more_vert</span>
                            </button>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-primary mb-1 group-hover:text-secondary transition-colors">Digital Marketing Lead</h3>
                        <p class="text-slate-400 text-sm flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs" data-icon="schedule">schedule</span>
                            15 Tháng 05, 2024
                        </p>
                    </div>
                    <div class="p-3 bg-error-container/30 rounded-xl mb-6">
                        <p class="text-[11px] text-error font-medium flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm" data-icon="info">info</span>
                            Kỹ năng 'SEO/SEM' đã lỗi thời 18 tháng.
                        </p>
                    </div>
                    <div class="mt-auto pt-4 flex items-center justify-between">
                        <button class="text-primary font-bold text-sm flex items-center gap-2">Sửa ngay</button>
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Ver 1.4</span>
                    </div>
                </div>
                <!-- Card 3: New Template -->
                <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/10 hover:shadow-xl transition-all group flex flex-col relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-secondary/5 rounded-full blur-2xl"></div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-16 bg-secondary/5 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-secondary text-3xl" data-icon="history_edu">history_edu</span>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="px-3 py-1 bg-secondary-fixed text-secondary text-[10px] font-extrabold rounded-full uppercase tracking-tight">Bản nháp</span>
                            <button class="w-8 h-8 rounded-full hover:bg-slate-100 flex items-center justify-center transition-colors">
                                <span class="material-symbols-outlined text-slate-400" data-icon="more_vert">more_vert</span>
                            </button>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-primary mb-1 group-hover:text-secondary transition-colors">Business Analyst (Shopee)</h3>
                        <p class="text-slate-400 text-sm flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs" data-icon="schedule">schedule</span>
                            Hôm qua, 14:30
                        </p>
                    </div>
                    <div class="flex flex-col gap-2 mb-6">
                        <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-secondary w-[45%] rounded-full"></div>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase">Hoàn thiện 45%</span>
                    </div>
                    <div class="mt-auto pt-4">
                        <button class="w-full py-2.5 bg-slate-100 text-primary font-bold text-xs rounded-xl hover:bg-slate-200 transition-colors">Tiếp tục chỉnh sửa</button>
                    </div>
                </div>
                <!-- Card 4: Detailed Analytical Card -->
                <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/10 hover:shadow-xl transition-all group flex flex-col">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-16 bg-tertiary/5 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-tertiary text-3xl" data-icon="description">description</span>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="px-3 py-1 bg-tertiary-fixed text-tertiary text-[10px] font-extrabold rounded-full uppercase tracking-tight">Khớp 85%</span>
                            <button class="w-8 h-8 rounded-full hover:bg-slate-100 flex items-center justify-center transition-colors">
                                <span class="material-symbols-outlined text-slate-400" data-icon="more_vert">more_vert</span>
                            </button>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-primary mb-1">Frontend Engineer</h3>
                        <p class="text-slate-400 text-sm">Cập nhật 3 ngày trước</p>
                    </div>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between text-[11px] font-bold uppercase text-slate-500">
                            <span>Sáng tạo</span>
                            <span class="text-primary">80%</span>
                        </div>
                        <div class="h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-tertiary w-[80%]"></div>
                        </div>
                        <div class="flex items-center justify-between text-[11px] font-bold uppercase text-slate-500">
                            <span>Kỹ thuật</span>
                            <span class="text-primary">95%</span>
                        </div>
                        <div class="h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-primary w-[95%]"></div>
                        </div>
                    </div>
                    <div class="mt-auto pt-4 flex items-center justify-between">
                        <button class="text-primary font-bold text-sm">Xem phân tích</button>
                        <span class="material-symbols-outlined text-slate-300" data-icon="analytics">analytics</span>
                    </div>
                </div>
                <!-- Card 5: Simplified Card -->
                <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/10 hover:shadow-xl transition-all group flex flex-col">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-16 bg-slate-100 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-slate-400 text-3xl" data-icon="description">description</span>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-extrabold rounded-full uppercase tracking-tight">Bản lưu</span>
                            <button class="w-8 h-8 rounded-full hover:bg-slate-100 flex items-center justify-center transition-colors">
                                <span class="material-symbols-outlined text-slate-400" data-icon="more_vert">more_vert</span>
                            </button>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-primary mb-1">Fullstack Dev (Old)</h3>
                        <p class="text-slate-400 text-sm">20 Tháng 01, 2024</p>
                    </div>
                    <div class="flex items-center gap-2 mt-auto">
                        <span class="text-[11px] text-slate-400 italic">"CV cũ dự phòng"</span>
                    </div>
                </div>
                <!-- Card 6: Add New Action Card -->
                <button class="border-2 border-dashed border-outline-variant/50 rounded-3xl p-6 flex flex-col items-center justify-center text-slate-400 hover:border-primary hover:text-primary hover:bg-primary/5 transition-all group">
                    <div class="w-16 h-16 rounded-full bg-slate-100 group-hover:bg-primary/10 flex items-center justify-center mb-4 transition-colors">
                        <span class="material-symbols-outlined text-3xl" data-icon="add_circle">add_circle</span>
                    </div>
                    <h3 class="font-bold text-lg">Tạo bản nháp mới</h3>
                    <p class="text-sm text-slate-400">Tối ưu cho vị trí công việc cụ thể</p>
                </button>
            </div>
            <!-- Bottom Stats / Tip Section -->
            <div class="mt-12 p-8 bg-gradient-to-br from-[#00476d] to-[#4648d4] rounded-[2rem] text-white relative overflow-hidden">
                <div class="absolute right-0 top-0 w-1/3 h-full opacity-10 pointer-events-none">
                    <span class="material-symbols-outlined text-[200px]" data-icon="auto_awesome">auto_awesome</span>
                </div>
                <div class="relative z-10 max-w-2xl">
                    <h4 class="text-2xl font-bold mb-4">Gợi ý từ AI: Tăng khả năng trúng tuyển</h4>
                    <p class="text-blue-100 mb-6 leading-relaxed">
                        Bạn có <span class="font-bold text-white underline decoration-2 underline-offset-4">3 CV</span> đã hơn 6 tháng chưa cập nhật. Các công ty công nghệ thường đánh giá cao những ứng viên có sự cập nhật liên tục về dự án cá nhân và công nghệ mới.
                    </p>
                    <div class="flex items-center gap-4">
                        <button class="px-6 py-2.5 bg-white text-primary font-extrabold rounded-xl hover:shadow-lg transition-all text-sm">
                            Cập nhật ngay
                        </button>
                        <button class="px-6 py-2.5 bg-transparent border border-white/30 text-white font-bold rounded-xl hover:bg-white/10 transition-all text-sm">
                            Xem báo cáo thị trường
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Floating Action Button (FAB) suppressed per logic for Profile/Details/Settings but active for Home/Management if needed. Rule states suppress on Details, Transactional. Keeping for primary action on dashboard. -->
    <div class="fixed bottom-8 right-8 z-50">
        <button class="w-14 h-14 bg-primary text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-transform active:scale-95 group">
            <span class="material-symbols-outlined text-2xl" data-icon="smart_toy" style="font-variation-settings: 'FILL' 1;">smart_toy</span>
            <div class="absolute bottom-full right-0 mb-4 bg-white text-primary p-3 rounded-2xl shadow-xl w-48 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity text-xs font-bold border border-primary/10">
                Chào bạn! Tôi có thể giúp bạn tối ưu CV nào hôm nay?
            </div>
        </button>
    </div>
</body>

</html>