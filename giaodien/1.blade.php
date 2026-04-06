<!DOCTYPE html>

<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Bảng điều khiển - Career Tailor</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;600;700;800&amp;family=Manrope:wght@400;500;600&amp;display=swap" rel="stylesheet" />
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
        }

        h1,
        h2,
        h3,
        .display-font {
            font-family: 'Be Vietnam Pro', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .tonal-layering {
            transition: background-color 0.3s ease;
        }
    </style>
</head>

<body class="bg-[#faf8ff] text-on-surface">
    <!-- SideNavBar Shell -->
    <aside class="fixed left-0 top-0 h-full flex flex-col bg-[#faf8ff] dark:bg-slate-950 h-screen w-64 border-r-0 z-50">
        <div class="p-6 flex flex-col gap-1">
            <h1 class="text-xl font-bold tracking-tight text-[#00476d] dark:text-white">Career Tailor</h1>
            <p class="text-xs text-slate-500 font-medium tracking-widest uppercase">AI Assistant</p>
        </div>
        <nav class="flex-1 mt-4 space-y-1">
            <!-- Active Tab: Tổng quan -->
            <a class="flex items-center gap-3 px-4 py-3 bg-[#00476d] text-white rounded-xl mx-2 scale-95 duration-150 transition-transform" href="#">
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
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2" href="#">
                <span class="material-symbols-outlined" data-icon="psychology">psychology</span>
                <span class="font-medium">Phân tích AI</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-colors mx-2" href="#">
                <span class="material-symbols-outlined" data-icon="alt_route">alt_route</span>
                <span class="font-medium">Lộ trình học</span>
            </a>
        </nav>
        <div class="p-4">
            <button class="w-full py-3 bg-gradient-to-br from-[#00476d] to-[#006090] text-white rounded-full font-bold shadow-lg shadow-primary/20 hover:brightness-110 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm" data-icon="add">add</span>
                Tạo CV mới
            </button>
        </div>
        <div class="mt-auto border-t border-slate-200/50 p-2 space-y-1">
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 transition-colors mx-2" href="#">
                <span class="material-symbols-outlined" data-icon="settings">settings</span>
                <span class="font-medium">Cài đặt</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 transition-colors mx-2" href="#">
                <span class="material-symbols-outlined" data-icon="logout">logout</span>
                <span class="font-medium">Đăng xuất</span>
            </a>
            <div class="flex items-center gap-3 px-4 py-4 mt-2 bg-surface-container-low rounded-xl mx-2">
                <img alt="Ảnh đại diện người dùng" class="w-10 h-10 rounded-full object-cover" data-alt="professional portrait of a confident asian male recruiter with a warm smile and modern eyeglasses in a bright office" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBtHPxFy2UJBR2yhitfZsooooapv9yE4jIduQbZDp5eU0uwshdNrkOzXxLjjp8bddj1OpHnW7-nXTMNnRVKxVglDVBjStuG586mkwzpLPUj-AvPgNEGP7ukMLWCenH30Kufvqkku4TEwU9gFe9kajuDQnbgby6DJzGQ8HOTZVig7IquqWWA-jDL4uJnsnykr7b-QyctFH4w1SfTGvcnIGfpViIY4rjfbA4K9Gcz3qCc9ep0mfqmkHNFy1RL4zIJfQgr9cAAwE_8kMM" />
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-primary truncate">Minh Hoàng</p>
                    <p class="text-xs text-slate-500 truncate">Premium Member</p>
                </div>
            </div>
        </div>
    </aside>
    <!-- TopAppBar Shell -->
    <header class="fixed top-0 right-0 left-64 h-16 flex items-center justify-between px-8 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl">
        <div class="flex items-center bg-surface-container-high px-4 py-2 rounded-full w-96">
            <span class="material-symbols-outlined text-slate-400 mr-2" data-icon="search">search</span>
            <input class="bg-transparent border-none focus:ring-0 text-sm w-full placeholder:text-slate-400" placeholder="Tìm kiếm CV, công việc..." type="text" />
        </div>
        <div class="flex items-center gap-4">
            <button class="p-2 text-slate-500 hover:text-primary transition-colors relative">
                <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-white"></span>
            </button>
            <button class="p-2 text-slate-500 hover:text-primary transition-colors">
                <span class="material-symbols-outlined" data-icon="help">help</span>
            </button>
            <button class="px-6 py-2 bg-secondary text-white rounded-full font-bold text-sm hover:brightness-110 transition-all">
                Phân tích ngay
            </button>
        </div>
    </header>
    <!-- Main Content Canvas -->
    <main class="pl-64 pt-16 min-h-screen bg-[#faf8ff]">
        <div class="p-8 max-w-7xl mx-auto space-y-8">
            <!-- Hero / Welcome Section -->
            <section class="flex flex-col md:flex-row justify-between items-end gap-6">
                <div>
                    <h2 class="text-4xl font-extrabold text-primary tracking-tight mb-2">Chào buổi sáng, Hoàng</h2>
                    <p class="text-slate-500 text-lg">Hôm nay AI đã chuẩn bị 5 gợi ý công việc mới phù hợp với bạn.</p>
                </div>
                <div class="flex gap-4">
                    <div class="p-4 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 min-w-[180px]">
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined" data-icon="description">description</span>
                        </div>
                        <div>
                            <p class="text-2xl font-extrabold text-primary">12</p>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Tổng số CV</p>
                        </div>
                    </div>
                    <div class="p-4 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 min-w-[180px]">
                        <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary">
                            <span class="material-symbols-outlined" data-icon="analytics">analytics</span>
                        </div>
                        <div>
                            <p class="text-2xl font-extrabold text-secondary">08</p>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Đã phân tích</p>
                        </div>
                    </div>
                    <div class="p-4 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 min-w-[180px]">
                        <div class="w-12 h-12 bg-tertiary/10 rounded-xl flex items-center justify-center text-tertiary">
                            <span class="material-symbols-outlined" data-icon="auto_awesome">auto_awesome</span>
                        </div>
                        <div>
                            <p class="text-2xl font-extrabold text-tertiary">05</p>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Gợi ý mới</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main Dashboard Grid -->
            <div class="grid grid-cols-12 gap-8">
                <!-- Left Column: Quick Actions & Recent CVs -->
                <div class="col-span-12 lg:col-span-8 space-y-8">
                    <!-- Quick Start Section (Bento Style) -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="relative overflow-hidden group bg-gradient-to-br from-primary to-primary-container p-8 rounded-3xl text-white shadow-xl">
                            <div class="relative z-10">
                                <h3 class="text-xl font-bold mb-2">Tải lên CV của bạn</h3>
                                <p class="text-white/70 text-sm mb-6 max-w-[200px]">AI sẽ tự động bóc tách và phân tích điểm mạnh của bạn.</p>
                                <button class="bg-white text-primary px-6 py-2 rounded-full font-bold text-sm hover:scale-105 transition-transform">Bắt đầu ngay</button>
                            </div>
                            <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-white/10 text-9xl font-thin rotate-12" data-icon="upload_file">upload_file</span>
                        </div>
                        <div class="relative overflow-hidden group bg-white p-8 rounded-3xl border border-slate-200/60 shadow-sm">
                            <div class="relative z-10">
                                <h3 class="text-xl font-bold text-primary mb-2">Dán JD công việc</h3>
                                <p class="text-slate-500 text-sm mb-6 max-w-[200px]">Kiểm tra mức độ phù hợp và nhận gợi ý chỉnh sửa CV.</p>
                                <button class="bg-primary text-white px-6 py-2 rounded-full font-bold text-sm hover:scale-105 transition-transform">Phân tích JD</button>
                            </div>
                            <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-slate-100 text-9xl font-thin -rotate-12" data-icon="content_paste_search">content_paste_search</span>
                        </div>
                    </div>
                    <!-- Recent CV Cards -->
                    <div>
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-primary">CV Gần đây</h3>
                            <a class="text-sm font-bold text-secondary flex items-center hover:underline" href="#">Xem tất cả <span class="material-symbols-outlined text-sm ml-1" data-icon="arrow_forward">arrow_forward</span></a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- CV Card 1 -->
                            <div class="bg-surface-container-lowest p-6 rounded-3xl shadow-sm hover:shadow-xl transition-shadow group cursor-pointer border border-transparent hover:border-primary/10">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-primary group-hover:text-white transition-colors">
                                        <span class="material-symbols-outlined" data-icon="article">article</span>
                                    </div>
                                    <div class="bg-secondary/10 px-3 py-1 rounded-full text-secondary text-xs font-bold">Matching: 92%</div>
                                </div>
                                <h4 class="text-lg font-bold text-primary mb-1">Senior UI/UX Designer</h4>
                                <p class="text-slate-400 text-xs mb-4">Cập nhật 2 giờ trước • Tiếng Anh</p>
                                <div class="flex gap-2">
                                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-medium">Portfolio</span>
                                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-medium">Design System</span>
                                </div>
                            </div>
                            <!-- CV Card 2 -->
                            <div class="bg-surface-container-lowest p-6 rounded-3xl shadow-sm hover:shadow-xl transition-shadow group cursor-pointer border border-transparent hover:border-primary/10">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-primary group-hover:text-white transition-colors">
                                        <span class="material-symbols-outlined" data-icon="article">article</span>
                                    </div>
                                    <div class="bg-tertiary/10 px-3 py-1 rounded-full text-tertiary text-xs font-bold">Matching: 78%</div>
                                </div>
                                <h4 class="text-lg font-bold text-primary mb-1">Product Manager CV</h4>
                                <p class="text-slate-400 text-xs mb-4">Cập nhật 1 ngày trước • Tiếng Việt</p>
                                <div class="flex gap-2">
                                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-medium">Strategy</span>
                                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-medium">Agile</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Column: Matching Jobs & AI Suggestion -->
                <div class="col-span-12 lg:col-span-4 space-y-8">
                    <!-- AI Suggestion Bubble (Glassmorphism) -->
                    <div class="bg-white/40 backdrop-blur-xl border border-white/60 p-6 rounded-3xl relative overflow-hidden">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-secondary to-tertiary rounded-full flex items-center justify-center text-white shadow-lg shadow-secondary/30">
                                <span class="material-symbols-outlined text-sm" data-icon="psychology" style="font-variation-settings: 'FILL' 1;">psychology</span>
                            </div>
                            <span class="text-sm font-bold text-primary">Gợi ý từ Career Tailor AI</span>
                        </div>
                        <p class="text-primary/80 text-sm leading-relaxed italic">
                            "Dựa trên 12 CV của bạn, kỹ năng <strong>Figma</strong> và <strong>React</strong> đang có nhu cầu tăng 15% trong tuần này. Hãy cân nhắc cập nhật các dự án liên quan để tăng tỷ lệ trúng tuyển!"
                        </p>
                    </div>
                    <!-- Matching Jobs List -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                        <h3 class="text-xl font-bold text-primary mb-6">Việc làm phù hợp</h3>
                        <div class="space-y-6">
                            <!-- Job Item 1 -->
                            <div class="flex gap-4 group cursor-pointer">
                                <div class="w-12 h-12 bg-surface-container rounded-2xl overflow-hidden flex-shrink-0">
                                    <img alt="Logo Công ty" class="w-full h-full object-cover" data-alt="minimalist tech company logo with abstract blue shapes on white background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCb3ltLEQcqA83cyFO4dN7oyxRPtS-WeXyBsI2HZyCKGG_gtH8KzIr83Ex1T4DCDI2R4cfmojmla76iI8WECdOfPN_Tsk6aXnIVNUXuZ1QAr8dt6E5g1TVQ-qR3xz09omS2gSgO3wdq7U78nlh5as5Tb3wWJ-GUJUdjp8VDBfiNInXcKuWEy5LccKpHoPX5XSy21yTnBM8C1QRRkCRJZYrs_yHKgHQ5iYYbijYGUBXGijxtEKylkttjiNYlGzI8ViXYQlD2HuF0vM8" />
                                </div>
                                <div class="flex-1 min-w-0 border-b border-slate-100 pb-4 group-last:border-none">
                                    <h4 class="text-sm font-bold text-primary truncate group-hover:text-secondary transition-colors">Senior Product Designer</h4>
                                    <p class="text-xs text-slate-500 mb-2">Google • Singapore</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-extrabold text-secondary">$4,500 - $6,000</span>
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[10px] text-secondary" data-icon="star" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="text-[10px] font-bold text-secondary">98% Match</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Job Item 2 -->
                            <div class="flex gap-4 group cursor-pointer">
                                <div class="w-12 h-12 bg-surface-container rounded-2xl overflow-hidden flex-shrink-0">
                                    <img alt="Logo Công ty" class="w-full h-full object-cover" data-alt="vibrant music app logo with clean lines and modern aesthetics" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDKO4mA1gMUMjmHkkikI1M_QwkFkvbdyLWm7jeRKGu7ck5XzeFaChJlehlhXFHqSskccJ6Zcq3Tnj4zFmNfq9tC9_gEEIYMEcCBKrXjcR-YntGWx7FUkSFHTZGJnq9yFWwsUpntIYxYw5HZpqMM1ntBI7P689TbEXhvSdHqDRUVWilY-m1IQD-94Z114ao3Q2LxDiWOuznLgp5FeIDNmOcNTR8qBwQ0XDZVqr7qVrDWlcNuFML019KeQtcJfAANJ26JA1vghF6DsaU" />
                                </div>
                                <div class="flex-1 min-w-0 border-b border-slate-100 pb-4 group-last:border-none">
                                    <h4 class="text-sm font-bold text-primary truncate group-hover:text-secondary transition-colors">UX Researcher</h4>
                                    <p class="text-xs text-slate-500 mb-2">Spotify • Remote</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-extrabold text-secondary">$3,000 - $4,200</span>
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[10px] text-secondary" data-icon="star" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="text-[10px] font-bold text-secondary">85% Match</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Job Item 3 -->
                            <div class="flex gap-4 group cursor-pointer">
                                <div class="w-12 h-12 bg-surface-container rounded-2xl overflow-hidden flex-shrink-0">
                                    <img alt="Logo Công ty" class="w-full h-full object-cover" data-alt="professional corporate logo with sharp typography and blue accent color" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAOrSzc-PqdAzH7TfpiJIF-YC1MYNC-gYvuWuma0tcES3dFZBvf3DfiyEdCx1G1UwtzBb-rbhpGxmA2NEstRcTaEFJkJhk9ChPaB8tb1q9wid5C8BBGRmUrbtpebfIWysXayC9CHZIVAlRi0jBxOQYAu-YW2Ok2IB7SDsEs4GajJq7Fz0Ysb9IKqPbxmYjhrXWC4EIL8HA8mTtfqIdg7_8d9VWsYY-v-y8E7cA6IG2loVGXu5il-0NZZ-q0DbSVMAqJMPLLUy2UKpA" />
                                </div>
                                <div class="flex-1 min-w-0 border-b border-slate-100 pb-4 group-last:border-none">
                                    <h4 class="text-sm font-bold text-primary truncate group-hover:text-secondary transition-colors">Design Lead</h4>
                                    <p class="text-xs text-slate-500 mb-2">Figma • Tokyo</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-extrabold text-secondary">$7,000 - $9,500</span>
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[10px] text-secondary" data-icon="star" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="text-[10px] font-bold text-secondary">92% Match</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="w-full mt-8 py-3 border border-slate-200 rounded-2xl text-slate-600 font-bold text-sm hover:bg-slate-50 transition-colors">Khám phá thêm việc làm</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Contextual FAB (Only for Dashboard) -->
    <button class="fixed bottom-8 right-8 w-16 h-16 bg-primary text-white rounded-2xl shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50 group">
        <span class="material-symbols-outlined text-3xl" data-icon="edit_note">edit_note</span>
        <span class="absolute right-full mr-4 bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">Viết CV mới bằng AI</span>
    </button>
</body>

</html>