<!DOCTYPE html>

<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Lộ trình &amp; Phỏng vấn | Career Tailor</title>
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
        h4 {
            font-family: 'Be Vietnam Pro', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-[#faf8ff] text-on-surface">
    <!-- SideNavBar (Execution from JSON) -->
    <aside class="fixed left-0 top-0 h-full flex flex-col h-screen w-64 border-r-0 bg-[#faf8ff] dark:bg-slate-950 z-50">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">architecture</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-[#00476d] dark:text-white">Career Tailor</h1>
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">AI Assistant</p>
                </div>
            </div>
            <nav class="space-y-1">
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2 rounded-xl" href="#">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-medium">Tổng quan</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2 rounded-xl" href="#">
                    <span class="material-symbols-outlined">description</span>
                    <span class="font-medium">Quản lý CV</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2 rounded-xl" href="#">
                    <span class="material-symbols-outlined">work</span>
                    <span class="font-medium">Việc làm</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2 rounded-xl" href="#">
                    <span class="material-symbols-outlined">psychology</span>
                    <span class="font-medium">Phân tích AI</span>
                </a>
                <!-- Active Tab: Lộ trình học (determined by page intent) -->
                <a class="flex items-center gap-3 px-4 py-3 bg-[#00476d] text-white rounded-xl mx-2 scale-95 duration-150 transition-transform" href="#">
                    <span class="material-symbols-outlined">alt_route</span>
                    <span class="font-medium">Lộ trình học</span>
                </a>
            </nav>
            <div class="mt-8 px-4">
                <button class="w-full py-3 bg-gradient-to-br from-primary to-primary-container text-white rounded-full font-bold shadow-lg shadow-primary/20 hover:opacity-90 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Tạo CV mới
                </button>
            </div>
        </div>
        <div class="mt-auto p-6 border-t border-slate-100 dark:border-slate-800">
            <nav class="space-y-1">
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 transition-colors mx-2 rounded-xl" href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="font-medium">Cài đặt</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 transition-colors mx-2 rounded-xl text-error" href="#">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-medium">Đăng xuất</span>
                </a>
            </nav>
        </div>
    </aside>
    <!-- TopAppBar (Execution from JSON) -->
    <header class="fixed top-0 right-0 left-64 h-16 flex items-center justify-between px-8 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl">
        <div class="flex items-center flex-1 max-w-xl">
            <div class="relative w-full">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input class="w-full pl-10 pr-4 py-2 bg-surface-container-high border-none rounded-full focus:ring-2 focus:ring-primary/30 text-sm" placeholder="Tìm kiếm tài liệu, câu hỏi..." type="text" />
            </div>
        </div>
        <div class="flex items-center gap-4">
            <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 text-slate-600 transition-colors">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 text-slate-600 transition-colors">
                <span class="material-symbols-outlined">help</span>
            </button>
            <div class="h-8 w-[1px] bg-slate-200 mx-2"></div>
            <button class="px-6 py-2 bg-primary text-white rounded-full text-sm font-bold hover:bg-primary-container transition-all">
                Phân tích ngay
            </button>
            <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary/20">
                <img alt="Người dùng" class="w-full h-full object-cover" data-alt="Professional headshot of a young business person with a friendly expression and minimalist background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAiAgCXPj0XTvpSDJCVpFup-7OAPxHO3-ClxULqMckLtQh8SWmPE2OvIP2xuXWJy8hGbfM3QGzW9BDjqBYQmmeV1-59zB3PugTcDuIOcuClhmhhIpumDv7-6l98VDxQRxO2R7fqmAyoioSHIISigSX0T7haKiRhPymqf2zAo2MC7KhRcpeWhXPx2eSSxufF3yHS4ktRg7DdlZjzY_6DTJhAxASqDFlHiCA6l4nWugIM_JBf7uegcljPjqGj25x13aBiiAKudg5em20" />
            </div>
        </div>
    </header>
    <!-- Main Content Area -->
    <main class="ml-64 pt-24 p-8 min-h-screen">
        <div class="max-w-6xl mx-auto">
            <!-- Page Header Section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-4xl font-extrabold tracking-tight text-primary mb-2">Lộ trình &amp; Phỏng vấn</h2>
                    <p class="text-slate-500 max-w-lg">Dựa trên phân tích JD của <span class="font-bold text-secondary">Senior Product Designer</span>, AI đã tối ưu hóa lộ trình cá nhân cho bạn.</p>
                </div>
                <div class="flex gap-2 p-1 bg-surface-container rounded-2xl">
                    <button class="px-6 py-2.5 bg-surface-container-lowest shadow-sm rounded-xl text-primary font-bold transition-all">
                        Lộ trình học tập
                    </button>
                    <button class="px-6 py-2.5 text-slate-500 font-semibold hover:bg-white/50 rounded-xl transition-all">
                        Câu hỏi phỏng vấn
                    </button>
                </div>
            </div>
            <!-- Bento Grid Layout for Dashboard Insight -->
            <div class="grid grid-cols-12 gap-6 mb-12">
                <!-- Learning Progress Card -->
                <div class="col-span-12 lg:col-span-4 bg-surface-container-lowest p-8 rounded-[2rem] flex flex-col justify-between relative overflow-hidden group">
                    <div class="absolute -right-12 -top-12 w-48 h-48 bg-secondary/5 rounded-full blur-3xl group-hover:bg-secondary/10 transition-colors"></div>
                    <div>
                        <div class="flex items-center justify-between mb-8">
                            <span class="text-slate-400 font-bold text-sm uppercase tracking-widest">Tiến độ tổng quát</span>
                            <div class="w-12 h-12 bg-secondary/10 rounded-2xl flex items-center justify-center text-secondary">
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">analytics</span>
                            </div>
                        </div>
                        <div class="flex items-baseline gap-2 mb-2">
                            <span class="text-6xl font-extrabold tracking-tighter text-primary">64%</span>
                            <span class="text-secondary font-bold text-lg">Hoàn thành</span>
                        </div>
                        <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden mt-6">
                            <div class="bg-gradient-to-r from-secondary to-primary h-full w-[64%]" style="box-shadow: 0 0 12px rgba(70, 72, 212, 0.4);"></div>
                        </div>
                    </div>
                    <p class="text-sm text-slate-500 mt-8 leading-relaxed">Bạn cần thêm khoảng <span class="font-bold text-on-surface">12 giờ</span> để hoàn thành các kỹ năng trọng yếu còn thiếu.</p>
                </div>
                <!-- Featured Learning Path -->
                <div class="col-span-12 lg:col-span-8 bg-primary p-8 rounded-[2rem] text-white relative overflow-hidden">
                    <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none">
                        <span class="material-symbols-outlined text-[20rem]" style="font-variation-settings: 'wght' 200;">model_training</span>
                    </div>
                    <div class="relative z-10 h-full flex flex-col">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-2xl font-bold mb-2">Trọng tâm hôm nay</h3>
                                <p class="text-primary-fixed opacity-80 max-w-md">Nâng cao kỹ năng Phân tích dữ liệu người dùng &amp; Thiết kế hệ thống (Design Systems).</p>
                            </div>
                            <span class="px-4 py-1.5 bg-white/20 backdrop-blur-md border border-white/20 rounded-full text-xs font-bold uppercase tracking-widest">AI Gợi ý</span>
                        </div>
                        <div class="mt-auto pt-10 flex gap-4 overflow-x-auto no-scrollbar">
                            <div class="min-w-[200px] p-5 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/10">
                                <span class="material-symbols-outlined mb-3 text-secondary-fixed">monitoring</span>
                                <p class="font-bold mb-1">User Metrics</p>
                                <p class="text-xs opacity-60">45 phút bài tập</p>
                            </div>
                            <div class="min-w-[200px] p-5 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/10">
                                <span class="material-symbols-outlined mb-3 text-secondary-fixed">auto_awesome_motion</span>
                                <p class="font-bold mb-1">Advanced Figma</p>
                                <p class="text-xs opacity-60">1h 20 phút video</p>
                            </div>
                            <div class="min-w-[200px] p-5 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/10">
                                <span class="material-symbols-outlined mb-3 text-secondary-fixed">record_voice_over</span>
                                <p class="font-bold mb-1">Stakeholder Interview</p>
                                <p class="text-xs opacity-60">Thực hành mô phỏng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Timeline Roadmap Section -->
            <div class="grid grid-cols-12 gap-10">
                <div class="col-span-12 lg:col-span-7">
                    <h3 class="text-xl font-bold text-primary mb-8 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-surface-container-highest flex items-center justify-center">
                            <span class="material-symbols-outlined text-sm">list_alt</span>
                        </span>
                        Lộ trình chi tiết
                    </h3>
                    <div class="space-y-0 relative before:content-[''] before:absolute before:left-[19px] before:top-4 before:bottom-4 before:w-[2px] before:bg-slate-100">
                        <!-- Step 1 (Completed) -->
                        <div class="relative pl-12 pb-10 group">
                            <div class="absolute left-0 top-1 w-10 h-10 rounded-full bg-secondary text-white flex items-center justify-center z-10 ring-4 ring-[#faf8ff]">
                                <span class="material-symbols-outlined text-xl">check</span>
                            </div>
                            <div class="p-6 bg-surface-container-low rounded-[1.5rem] group-hover:bg-white group-hover:shadow-xl transition-all duration-300">
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="font-bold text-primary text-lg">Kỹ năng nghiên cứu (User Research)</h4>
                                    <span class="text-xs font-bold text-secondary bg-secondary/10 px-3 py-1 rounded-full uppercase">Hoàn thành</span>
                                </div>
                                <p class="text-sm text-slate-500 mb-4">Phân tích các phương pháp phỏng vấn, khảo sát và xây dựng User Persona dựa trên JD.</p>
                                <div class="flex gap-2 flex-wrap">
                                    <span class="px-3 py-1 bg-white rounded-lg text-xs font-semibold text-slate-600 border border-slate-100">Quantitative Analysis</span>
                                    <span class="px-3 py-1 bg-white rounded-lg text-xs font-semibold text-slate-600 border border-slate-100">Empathy Mapping</span>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2 (Active) -->
                        <div class="relative pl-12 pb-10 group">
                            <div class="absolute left-0 top-1 w-10 h-10 rounded-full bg-white border-4 border-secondary text-secondary flex items-center justify-center z-10 ring-4 ring-[#faf8ff]">
                                <span class="material-symbols-outlined text-xl">play_arrow</span>
                            </div>
                            <div class="p-6 bg-white shadow-xl shadow-secondary/5 rounded-[1.5rem] border border-secondary/10">
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="font-bold text-primary text-lg">Phát triển Hệ thống thiết kế (Design Systems)</h4>
                                    <div class="flex items-center gap-1.5 text-xs font-bold text-primary px-3 py-1 bg-primary-fixed rounded-full">
                                        <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse"></span>
                                        ĐANG HỌC
                                    </div>
                                </div>
                                <p class="text-sm text-slate-500 mb-6">Xây dựng thư viện component, quy chuẩn màu sắc và typography theo tiêu chuẩn Enterprise.</p>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between text-xs font-bold mb-1">
                                        <span class="text-slate-600">Thời gian dự kiến: 5 giờ</span>
                                        <span class="text-secondary">40%</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-slate-100 rounded-full">
                                        <div class="h-full bg-secondary w-[40%] rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 3 (Pending) -->
                        <div class="relative pl-12 pb-10 group opacity-60">
                            <div class="absolute left-0 top-1 w-10 h-10 rounded-full bg-slate-200 text-slate-400 flex items-center justify-center z-10 ring-4 ring-[#faf8ff]">
                                <span class="material-symbols-outlined text-xl">lock</span>
                            </div>
                            <div class="p-6 bg-surface-container-low rounded-[1.5rem]">
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="font-bold text-primary text-lg">Kỹ năng thuyết trình giải pháp</h4>
                                    <span class="text-xs font-bold text-slate-400 bg-slate-200 px-3 py-1 rounded-full uppercase">Chờ xử lý</span>
                                </div>
                                <p class="text-sm text-slate-500">Cách kể chuyện (Storytelling) về quy trình thiết kế cho các bên liên quan và quản lý.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Interview Questions Side Section -->
                <div class="col-span-12 lg:col-span-5">
                    <div class="sticky top-24">
                        <div class="bg-surface-container-low p-8 rounded-[2rem] border border-slate-100">
                            <div class="flex items-center justify-between mb-8">
                                <h3 class="text-xl font-bold text-primary flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-secondary">
                                        <span class="material-symbols-outlined text-sm">question_answer</span>
                                    </span>
                                    Câu hỏi phỏng vấn
                                </h3>
                                <button class="text-xs font-bold text-secondary hover:underline">Xem tất cả (24)</button>
                            </div>
                            <div class="space-y-4">
                                <!-- Question 1 (Easy) -->
                                <div class="p-5 bg-white rounded-2xl hover:translate-x-1 transition-transform cursor-pointer group">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-bold rounded uppercase">Dễ</span>
                                        <span class="text-[10px] font-bold text-slate-400">#Behavioral</span>
                                    </div>
                                    <p class="text-sm font-bold text-primary leading-snug group-hover:text-secondary transition-colors">"Bạn xử lý xung đột ý kiến với kỹ sư phần mềm như thế nào?"</p>
                                </div>
                                <!-- Question 2 (Medium) -->
                                <div class="p-5 bg-white rounded-2xl hover:translate-x-1 transition-transform cursor-pointer group border-l-4 border-yellow-400">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 text-[10px] font-bold rounded uppercase">Trung bình</span>
                                        <span class="text-[10px] font-bold text-slate-400">#Product_Strategy</span>
                                    </div>
                                    <p class="text-sm font-bold text-primary leading-snug group-hover:text-secondary transition-colors">"Làm thế nào để bạn đo lường sự thành công của một tính năng mới sau khi ra mắt?"</p>
                                </div>
                                <!-- Question 3 (Hard) -->
                                <div class="p-5 bg-white rounded-2xl hover:translate-x-1 transition-transform cursor-pointer group border-l-4 border-error">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-0.5 bg-red-100 text-error text-[10px] font-bold rounded uppercase">Khó</span>
                                        <span class="text-[10px] font-bold text-slate-400">#Technical_Case</span>
                                    </div>
                                    <p class="text-sm font-bold text-primary leading-snug group-hover:text-secondary transition-colors">"Hãy mô tả quy trình thiết kế cho một hệ thống quy mô lớn với hàng triệu người dùng đồng thời."</p>
                                </div>
                            </div>
                            <!-- Mock Interview Action -->
                            <div class="mt-8 p-6 bg-gradient-to-br from-[#4648d4] to-[#6063ee] rounded-2xl text-white">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center">
                                        <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">mic</span>
                                    </div>
                                    <div>
                                        <p class="font-bold">Luyện tập AI Voice</p>
                                        <p class="text-xs opacity-80">Phỏng vấn thử cùng AI trợ lý</p>
                                    </div>
                                </div>
                                <button class="w-full py-3 bg-white text-secondary font-extrabold rounded-xl hover:bg-opacity-90 transition-all">
                                    Bắt đầu ngay
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Skills Analysis Visualizer -->
            <div class="mt-20">
                <div class="flex items-center justify-between mb-10">
                    <h3 class="text-2xl font-bold text-primary">Phân tích kỹ năng từ JD</h3>
                    <div class="flex items-center gap-4 text-sm font-semibold">
                        <div class="flex items-center gap-2"><span class="w-3 h-3 bg-primary rounded-full"></span> Hiện tại</div>
                        <div class="flex items-center gap-2"><span class="w-3 h-3 bg-secondary rounded-full"></span> JD yêu cầu</div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-[1.5rem] border border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">UI Design</p>
                        <div class="flex items-end gap-2 h-24 mb-4">
                            <div class="flex-1 bg-primary rounded-lg h-[90%] relative group">
                                <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-on-surface text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">90%</div>
                            </div>
                            <div class="flex-1 bg-secondary rounded-lg h-[85%] relative group">
                                <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-on-surface text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">85%</div>
                            </div>
                        </div>
                        <p class="text-xs font-bold text-green-600 flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">trending_up</span>
                            Đã vượt kỳ vọng
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-[1.5rem] border border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">UX Strategy</p>
                        <div class="flex items-end gap-2 h-24 mb-4">
                            <div class="flex-1 bg-primary rounded-lg h-[60%]"></div>
                            <div class="flex-1 bg-secondary rounded-lg h-[95%]"></div>
                        </div>
                        <p class="text-xs font-bold text-error flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">priority_high</span>
                            Cần cải thiện thêm
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-[1.5rem] border border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Interaction</p>
                        <div class="flex items-end gap-2 h-24 mb-4">
                            <div class="flex-1 bg-primary rounded-lg h-[75%]"></div>
                            <div class="flex-1 bg-secondary rounded-lg h-[80%]"></div>
                        </div>
                        <p class="text-xs font-bold text-primary flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">horizontal_rule</span>
                            Mức độ cân bằng
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-[1.5rem] border border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">AI Tools</p>
                        <div class="flex items-end gap-2 h-24 mb-4">
                            <div class="flex-1 bg-primary rounded-lg h-[40%]"></div>
                            <div class="flex-1 bg-secondary rounded-lg h-[70%]"></div>
                        </div>
                        <p class="text-xs font-bold text-secondary flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">lightbulb</span>
                            Ưu tiên học mới
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>