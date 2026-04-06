<!DOCTYPE html>

<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
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

        .score-glow {
            filter: drop-shadow(0 0 12px rgba(70, 72, 212, 0.4));
        }
    </style>
</head>

<body class="bg-[#faf8ff] text-on-surface">
    <!-- SideNavBar Shell -->
    <aside class="fixed left-0 top-0 h-full flex flex-col h-screen w-64 bg-[#faf8ff] dark:bg-slate-950 z-50">
        <div class="p-6">
            <h1 class="text-xl font-bold tracking-tight text-[#00476d] dark:text-white">Career Tailor</h1>
            <p class="text-xs text-slate-500 font-medium mt-1">AI Assistant</p>
        </div>
        <nav class="flex-1 mt-4">
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2" href="#">
                <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                <span class="font-medium">Tổng quan</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2" href="#">
                <span class="material-symbols-outlined" data-icon="description">description</span>
                <span class="font-medium">Quản lý CV</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2" href="#">
                <span class="material-symbols-outlined" data-icon="work">work</span>
                <span class="font-medium">Việc làm</span>
            </a>
            <!-- Active State for AI Analysis -->
            <a class="flex items-center gap-3 px-4 py-3 bg-[#00476d] text-white rounded-xl mx-2 scale-95 duration-150 transition-transform" href="#">
                <span class="material-symbols-outlined" data-icon="psychology">psychology</span>
                <span class="font-medium">Phân tích AI</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2" href="#">
                <span class="material-symbols-outlined" data-icon="alt_route">alt_route</span>
                <span class="font-medium">Lộ trình học</span>
            </a>
        </nav>
        <div class="p-4 mt-auto">
            <button class="w-full bg-[#00476d] text-white py-3 rounded-xl font-bold flex items-center justify-center gap-2 hover:opacity-90 transition-opacity">
                <span class="material-symbols-outlined" data-icon="add">add</span>
                Tạo CV mới
            </button>
            <div class="mt-6 border-t border-slate-200 pt-4">
                <a class="flex items-center gap-3 px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-colors" href="#">
                    <span class="material-symbols-outlined" data-icon="settings">settings</span>
                    <span class="text-sm">Cài đặt</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-colors mt-1" href="#">
                    <span class="material-symbols-outlined" data-icon="logout">logout</span>
                    <span class="text-sm">Đăng xuất</span>
                </a>
            </div>
        </div>
    </aside>
    <!-- TopAppBar Shell -->
    <header class="fixed top-0 right-0 left-64 h-16 flex items-center justify-between px-8 z-40 bg-white/80 backdrop-blur-xl">
        <div class="flex items-center gap-4 flex-1">
            <div class="relative w-full max-w-md">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm" data-icon="search">search</span>
                <input class="w-full pl-10 pr-4 py-2 bg-surface-container-high border-none rounded-full text-sm focus:ring-2 focus:ring-primary/30 outline-none" placeholder="Tìm kiếm tài liệu..." type="text" />
            </div>
        </div>
        <div class="flex items-center gap-6">
            <button class="flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-primary to-primary-container text-white rounded-full font-semibold text-sm shadow-sm">
                Phân tích ngay
            </button>
            <div class="flex gap-3 text-slate-500">
                <span class="material-symbols-outlined cursor-pointer hover:text-primary transition-colors" data-icon="notifications">notifications</span>
                <span class="material-symbols-outlined cursor-pointer hover:text-primary transition-colors" data-icon="help">help</span>
            </div>
            <div class="w-8 h-8 rounded-full overflow-hidden bg-slate-200">
                <img alt="Avatar" data-alt="close-up portrait of a young professional smiling against a clean neutral background with soft studio lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCWDM9wdk1asVXeSTcQokCyrFT_YP6xoOAgRyerN840GSS-FE_r-lRO0Emvx12UiBw1-Pz2kVpaGv2mjgyh9iVZy1vLuPiUROSDxQTVhO_6LfdPPaWCbFviQzlogJX7f6Os6bhWLtr4ith2LUETKxYzLoVpHiizUaRL-lnbf881L-vsDMxDVL1ANHFy_oJ5YPXJiH4-SgORmMAclcf9hpKw8I7WyWwjOQmE5kj0Od6-VRpY_o4jVdfgTHK01MAtk7KD-D9w_ZZqLuk" />
            </div>
        </div>
    </header>
    <!-- Main Canvas -->
    <main class="ml-64 pt-20 p-8 min-h-screen">
        <!-- Score Header Section -->
        <section class="mb-10 text-center flex flex-col items-center">
            <div class="relative w-40 h-40 flex items-center justify-center mb-4">
                <svg class="w-full h-full -rotate-90">
                    <circle class="text-surface-container-high" cx="80" cy="80" fill="transparent" r="70" stroke="currentColor" stroke-width="8"></circle>
                    <circle class="text-secondary score-glow" cx="80" cy="80" fill="transparent" r="70" stroke="currentColor" stroke-dasharray="440" stroke-dashoffset="66" stroke-linecap="round" stroke-width="8"></circle>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-4xl font-extrabold tracking-tight text-primary">85%</span>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-secondary">Matching Score</span>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-primary mb-2">Độ tương thích rất cao!</h2>
            <p class="text-slate-500 max-w-lg">CV của bạn có sự liên kết chặt chẽ với các yêu cầu kỹ thuật từ nhà tuyển dụng. Chỉ cần một vài chỉnh sửa nhỏ để đạt trạng thái tối ưu.</p>
        </section>
        <!-- Split Screen: CV vs JD -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Left: CV Summary -->
            <div class="bg-surface-container-lowest rounded-xl p-8 border border-outline-variant/10">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-container" data-icon="article">article</span>
                        Tóm tắt CV của bạn
                    </h3>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Phiên bản hiện tại</span>
                </div>
                <div class="space-y-6">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase mb-2">Kinh nghiệm chính</p>
                        <p class="text-on-surface font-medium">3+ năm phát triển Java Backend, có kinh nghiệm với Microservices và Cloud Infrastructure.</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-surface-container-low text-primary rounded-full text-xs font-bold">Java</span>
                        <span class="px-3 py-1 bg-surface-container-low text-primary rounded-full text-xs font-bold">Spring Boot</span>
                        <span class="px-3 py-1 bg-surface-container-low text-primary rounded-full text-xs font-bold">PostgreSQL</span>
                        <span class="px-3 py-1 bg-surface-container-low text-primary rounded-full text-xs font-bold">Docker</span>
                    </div>
                    <div class="p-4 bg-surface-container rounded-lg italic text-slate-600 text-sm leading-relaxed">
                        "Tôi sử dụng Spring Boot để xây dựng hệ thống quản lý đơn hàng cho đối tác nước ngoài."
                    </div>
                </div>
            </div>
            <!-- Right: Job Description -->
            <div class="bg-surface-container-lowest rounded-xl p-8 border border-outline-variant/10">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary" data-icon="work_outline">work_outline</span>
                        Mô tả công việc (JD)
                    </h3>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Mục tiêu</span>
                </div>
                <div class="space-y-6">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase mb-2">Vị trí tuyển dụng</p>
                        <p class="text-on-surface font-bold text-xl">Senior Backend Engineer (Java)</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase mb-2">Yêu cầu cốt lõi</p>
                        <ul class="space-y-2">
                            <li class="flex gap-2 items-start text-sm text-on-surface">
                                <span class="material-symbols-outlined text-green-500 text-sm mt-0.5" data-icon="check_circle" data-weight="fill">check_circle</span>
                                Có kiến thức sâu về tối ưu hóa hệ thống backend.
                            </li>
                            <li class="flex gap-2 items-start text-sm text-on-surface">
                                <span class="material-symbols-outlined text-green-500 text-sm mt-0.5" data-icon="check_circle" data-weight="fill">check_circle</span>
                                Thành thạo kiến trúc Microservices và thiết kế API.
                            </li>
                            <li class="flex gap-2 items-start text-sm text-on-surface">
                                <span class="material-symbols-outlined text-red-500 text-sm mt-0.5" data-icon="error" data-weight="fill">error</span>
                                Có kinh nghiệm với Kubernetes (K8s) và CI/CD.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- AI Recommendations & Rephrasing (Bento Grid Style) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Strengths -->
            <div class="bg-white p-6 rounded-2xl border border-emerald-100 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-emerald-50 rounded-lg">
                        <span class="material-symbols-outlined text-emerald-600" data-icon="verified">verified</span>
                    </div>
                    <h4 class="font-bold text-emerald-900">Điểm mạnh</h4>
                </div>
                <p class="text-sm text-emerald-800 leading-relaxed">Nền tảng kỹ thuật Java và Spring Boot rất vững chắc, khớp 100% với Stack công nghệ của dự án.</p>
            </div>
            <!-- Missing Skills -->
            <div class="bg-white p-6 rounded-2xl border border-amber-100 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-amber-50 rounded-lg">
                        <span class="material-symbols-outlined text-amber-600" data-icon="warning">warning</span>
                    </div>
                    <h4 class="font-bold text-amber-900">Kỹ năng còn thiếu</h4>
                </div>
                <p class="text-sm text-amber-800 leading-relaxed">Chưa đề cập rõ kinh nghiệm vận hành với Kubernetes và tối ưu hóa CI/CD pipeline.</p>
            </div>
            <!-- AI Suggestions -->
            <div class="bg-white p-6 rounded-2xl border border-primary-container/20 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-surface-container-low rounded-lg">
                        <span class="material-symbols-outlined text-primary" data-icon="lightbulb">lightbulb</span>
                    </div>
                    <h4 class="font-bold text-primary">Đề xuất cải thiện</h4>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">Nên bổ sung các con số cụ thể (KPI) về hiệu suất hệ thống để thể hiện năng lực tối ưu.</p>
            </div>
        </div>
        <!-- AI Rephrasing Feature Section -->
        <section class="bg-gradient-to-br from-primary to-[#003551] rounded-3xl p-10 text-white relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-secondary/20 blur-[100px] rounded-full"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-8">
                    <span class="material-symbols-outlined text-secondary-fixed-dim" data-icon="magic_button">magic_button</span>
                    <h3 class="text-xl font-bold">AI Rephrasing: Nâng tầm diễn đạt</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <!-- Original -->
                    <div class="relative">
                        <div class="absolute -top-4 -left-4 px-3 py-1 bg-slate-700 text-[10px] font-bold rounded-md uppercase tracking-widest">Gốc</div>
                        <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/10">
                            <p class="text-slate-300 italic">"Tôi sử dụng Spring Boot để phát triển ứng dụng."</p>
                        </div>
                    </div>
                    <!-- AI Suggested -->
                    <div class="relative">
                        <div class="absolute -top-4 -left-4 px-3 py-1 bg-secondary text-[10px] font-bold rounded-md uppercase tracking-widest shadow-lg shadow-secondary/50">AI Đề xuất</div>
                        <div class="bg-white/20 backdrop-blur-xl p-6 rounded-2xl border border-white/30 shadow-2xl">
                            <p class="text-white font-medium leading-relaxed">
                                "Chuyên gia phát triển Backend với kinh nghiệm thiết kế kiến trúc hệ thống mở rộng (Scalable) trên nền tảng <span class="text-secondary-fixed-dim font-bold">Spring Boot</span>, tối ưu hóa 30% tốc độ xử lý dữ liệu."
                            </p>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button class="flex items-center gap-2 px-4 py-2 bg-secondary rounded-full text-xs font-bold hover:bg-secondary-container transition-all">
                                <span class="material-symbols-outlined text-sm" data-icon="content_copy">content_copy</span>
                                Áp dụng vào CV
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer Floating Actions (Contextual) -->
        <div class="fixed bottom-8 right-8 flex gap-4 z-50">
            <button class="flex items-center gap-2 px-6 py-4 bg-white text-primary border border-primary/20 rounded-2xl font-bold shadow-xl hover:bg-surface-container-low transition-all">
                <span class="material-symbols-outlined" data-icon="edit">edit</span>
                Chỉnh sửa CV
            </button>
            <button class="flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-secondary to-primary-container text-white rounded-2xl font-bold shadow-2xl shadow-secondary/20 hover:scale-105 transition-transform">
                <span class="material-symbols-outlined" data-icon="auto_awesome">auto_awesome</span>
                Tối ưu toàn bộ CV
            </button>
        </div>
    </main>
</body>

</html>