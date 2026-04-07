<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ config('app.name', 'AI Career Tailor') }} | Đăng ký</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"/>

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              colors: {
                "on-secondary-fixed-variant": "#3b35a7",
                "surface-container-low": "#f2f4f6",
                "tertiary": "#611e00",
                "inverse-on-surface": "#eff1f3",
                "on-error-container": "#93000a",
                "error": "#ba1a1a",
                "primary-fixed-dim": "#b8c4ff",
                "inverse-primary": "#b8c4ff",
                "primary": "#00288e",
                "secondary-fixed-dim": "#c3c0ff",
                "on-surface": "#191c1e",
                "on-background": "#191c1e",
                "surface-container-highest": "#e0e3e5",
                "on-tertiary": "#ffffff",
                "surface": "#f7f9fb",
                "secondary-container": "#8f8bff",
                "on-tertiary-fixed": "#380d00",
                "outline-variant": "#c4c5d5",
                "secondary": "#544fc0",
                "on-secondary": "#ffffff",
                "background": "#f7f9fb",
                "tertiary-fixed-dim": "#ffb59a",
                "on-secondary-container": "#231791",
                "surface-tint": "#3755c3",
                "on-primary-fixed": "#001453",
                "surface-dim": "#d8dadc",
                "tertiary-container": "#872d00",
                "primary-container": "#1e40af",
                "primary-fixed": "#dde1ff",
                "secondary-fixed": "#e2dfff",
                "on-error": "#ffffff",
                "outline": "#757684",
                "surface-bright": "#f7f9fb",
                "inverse-surface": "#2d3133",
                "on-primary-fixed-variant": "#173bab",
                "on-tertiary-container": "#ffa583",
                "on-primary": "#ffffff",
                "on-tertiary-fixed-variant": "#802a00",
                "on-primary-container": "#a8b8ff",
                "surface-container": "#eceef0",
                "on-surface-variant": "#444653",
                "surface-variant": "#e0e3e5",
                "error-container": "#ffdad6",
                "on-secondary-fixed": "#0f0069",
                "surface-container-lowest": "#ffffff",
                "tertiary-fixed": "#ffdbce",
                "surface-container-high": "#e6e8ea",
              },
              borderRadius: {
                "DEFAULT": "0.125rem",
                "lg": "0.25rem",
                "xl": "0.5rem",
                "full": "0.75rem",
              },
              fontFamily: {
                "headline": ["Manrope"],
                "body": ["Inter"],
                "label": ["Inter"],
              },
            },
          },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
            font-size: 20px;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 0.5px solid rgba(203, 213, 225, 0.4);
            box-shadow: 0 4px 20px rgba(0, 40, 142, 0.04), 0 12px 40px rgba(0, 0, 0, 0.02);
        }
        .subtle-glow:focus-within {
            box-shadow: inset 0 0 8px rgba(0, 40, 142, 0.05);
        }
        body { overflow-y: auto; }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">

    <!-- Global Background Canvas -->
    <div class="fixed inset-0 z-[-1] bg-gradient-to-br from-white via-[#f8fafc] to-[#f1f5f9]">
        <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-primary/5 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[600px] h-[600px] bg-secondary/5 rounded-full blur-[120px]"></div>
    </div>

    <!-- Main Content Container -->
    <main class="min-h-screen w-full flex flex-col items-center justify-center p-6 py-12">

        <!-- Branding Anchor -->
        <div class="mb-10 text-center">
            <h1 class="font-headline text-xl font-bold tracking-tighter text-primary">
                AI Career Tailor
            </h1>
            <p class="font-label text-[10px] uppercase tracking-[0.2em] text-outline mt-2">The Digital Atelier</p>
        </div>

        <!-- Register Card -->
        <div class="w-full max-w-[440px] glass-card p-7 md:p-10 rounded-xl">

            <!-- Header Section -->
            <div class="mb-6 text-center">
                <h2 class="font-headline text-xl font-light tracking-wider text-on-surface mb-2">
                    Tạo tài khoản
                </h2>
                <p class="text-on-surface-variant text-xs font-light">
                    Bắt đầu hành trình sự nghiệp được cá nhân hóa.
                </p>
            </div>

            <!-- Status / Error Messages -->
            @if (session('status'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-800 text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-600">check_circle</span>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700 text-sm flex items-start gap-2">
                    <span class="material-symbols-outlined text-red-500 shrink-0">error</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Full Name -->
                <div class="space-y-2">
                    <label class="font-label text-[11px] uppercase tracking-widest text-outline ml-1" for="name">
                        Họ và tên
                    </label>
                    <div class="relative group subtle-glow">
                        <input
                            class="w-full bg-surface-container-low/50 border-0 rounded-lg py-3 px-4 text-on-surface placeholder:text-outline/60 focus:ring-1 focus:ring-primary/20 transition-all font-body text-sm @error('name') ring-1 ring-red-400 @enderror"
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            placeholder="Nguyễn Văn A"
                            required
                            autofocus
                        />
                    </div>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="font-label text-[11px] uppercase tracking-widest text-outline ml-1" for="email">
                        Email
                    </label>
                    <div class="relative group subtle-glow">
                        <input
                            class="w-full bg-surface-container-low/50 border-0 rounded-lg py-3 px-4 text-on-surface placeholder:text-outline/60 focus:ring-1 focus:ring-primary/20 transition-all font-body text-sm @error('email') ring-1 ring-red-400 @enderror"
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="name@example.com"
                            required
                        />
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label class="font-label text-[11px] uppercase tracking-widest text-outline ml-1" for="password">
                        Mật khẩu
                    </label>
                    <div class="relative group subtle-glow">
                        <input
                            class="w-full bg-surface-container-low/50 border-0 rounded-lg py-3 px-4 pr-12 text-on-surface placeholder:text-outline/60 focus:ring-1 focus:ring-primary/20 transition-all font-body text-sm @error('password') ring-1 ring-red-400 @enderror"
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Tối thiểu 8 ký tự"
                            required
                        />
                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-outline/60 hover:text-on-surface transition-colors"
                        >
                            <span class="material-symbols-outlined" id="password-toggle">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label class="font-label text-[11px] uppercase tracking-widest text-outline ml-1" for="password_confirmation">
                        Xác nhận mật khẩu
                    </label>
                    <div class="relative group subtle-glow">
                        <input
                            class="w-full bg-surface-container-low/50 border-0 rounded-lg py-3.5 px-5 pr-12 text-on-surface placeholder:text-outline/60 focus:ring-1 focus:ring-primary/20 transition-all font-body text-sm @error('password_confirmation') ring-1 ring-red-400 @enderror"
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="Nhập lại mật khẩu"
                            required
                        />
                        <button
                            type="button"
                            onclick="togglePasswordConfirm()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-outline/60 hover:text-on-surface transition-colors"
                        >
                            <span class="material-symbols-outlined" id="password-confirm-toggle">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Primary CTA -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-primary to-primary-container text-white py-3.5 rounded-xl font-headline font-semibold tracking-wider shadow-lg shadow-primary/20 hover:shadow-primary/30 transform hover:-translate-y-0.5 transition-all duration-300 mt-1"
                >
                    Tạo tài khoản
                </button>
            </form>

            <!-- Footer Message -->
            <p class="mt-6 text-center text-sm font-light text-on-surface-variant">
                Đã có tài khoản?
                <a class="text-primary font-medium border-b border-transparent hover:border-primary transition-all ml-1"
                   href="{{ route('login') }}">
                    Đăng nhập
                </a>
            </p>
        </div>

        <!-- System Footer -->
        <footer class="mt-12 text-center">
            <div class="flex justify-center gap-8 mb-4">
                <a class="font-label text-[10px] uppercase tracking-[0.1em] text-outline hover:text-primary transition-colors" href="#">Chính sách bảo mật</a>
                <a class="font-label text-[10px] uppercase tracking-[0.1em] text-outline hover:text-primary transition-colors" href="#">Điều khoản dịch vụ</a>
                <a class="font-label text-[10px] uppercase tracking-[0.1em] text-outline hover:text-primary transition-colors" href="#">AI đạo đức</a>
            </div>
            <p class="font-label text-[9px] uppercase tracking-[0.15em] text-outline/60">
                © {{ date('Y') }} AI Career Tailor. The Digital Atelier.
            </p>
        </footer>
    </main>

    <!-- Decorative Elements -->
    <div class="fixed top-0 left-0 p-10 pointer-events-none opacity-20">
        <span class="material-symbols-outlined text-primary" style="font-size:64px;">architecture</span>
    </div>
    <div class="fixed bottom-0 right-0 p-10 pointer-events-none opacity-20">
        <span class="material-symbols-outlined text-primary" style="font-size:64px;">auto_awesome</span>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('password-toggle');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }

        function togglePasswordConfirm() {
            const input = document.getElementById('password_confirmation');
            const icon = document.getElementById('password-confirm-toggle');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>
