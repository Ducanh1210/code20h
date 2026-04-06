<x-client-layout>
    <!-- Background Decor (Mesh Gradients) -->
    <div class="fixed inset-0 overflow-hidden -z-10 bg-[#fafaff]">
        <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] bg-[#e0e7ff] rounded-full blur-[120px] opacity-60 animate-pulse"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-[#f0f9ff] rounded-full blur-[100px] opacity-50"></div>
    </div>

    <!-- Main Hero -->
    <section class="relative pt-32 pb-40 lg:pt-48 lg:pb-64">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
            
            <!-- Left: Strategic Messaging -->
            <div class="relative z-10 space-y-10 animate-fade-in text-center lg:text-left">
                <div class="inline-flex items-center gap-3 px-5 py-2.5 bg-white/60 backdrop-blur-xl border border-white/50 rounded-full shadow-lg shadow-indigo-100/30">
                    <span class="flex h-2.5 w-2.5 bg-indigo-500 rounded-full shadow-[0_0_10px_rgba(79,70,229,1)]"></span>
                    <span class="text-xs font-black uppercase tracking-[0.2em] text-indigo-700 leading-none">AI Intelligence Engine v2.0</span>
                </div>
                
                <h1 class="font-heading text-6xl md:text-7xl lg:text-8xl font-black text-slate-950 leading-[0.95] tracking-tight">
                    Chạm tới <br/> <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 via-blue-500 to-indigo-400">Sự Nghiệp</span> <br/> Mơ Ước.
                </h1>
                
                <p class="text-xl text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium opacity-80 italic">
                    AI Personal Career Optimizer giúp bạn phân tích hồ sơ, lấp đầy lỗ hổng kỹ năng và đồng hành cùng bạn đến khi có Job.
                </p>
                
                <div class="flex flex-wrap justify-center lg:justify-start gap-6 pt-6">
                    <a href="{{ route('register') }}" class="group relative px-12 py-6 bg-slate-950 text-white font-black rounded-3xl overflow-hidden active:scale-95 transition-all shadow-2xl hover:shadow-indigo-200">
                        <span class="relative z-10 flex items-center gap-3">
                            Khám phá ngay <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </a>
                    
                    <button class="px-12 py-6 bg-white/50 backdrop-blur-md border-2 border-slate-100 text-slate-900 font-black rounded-3xl hover:bg-white hover:border-indigo-600/20 transition-all shadow-sm">
                        Quy trình AI
                    </button>
                </div>
                
                <!-- Social Proof / Users -->
                <div class="flex items-center justify-center lg:justify-start gap-5 pt-10">
                    <div class="flex -space-x-3">
                        <div class="w-12 h-12 rounded-full border-4 border-white bg-indigo-100 shadow-sm flex items-center justify-center text-xs font-bold">JD</div>
                        <div class="w-12 h-12 rounded-full border-4 border-white bg-blue-100 shadow-sm flex items-center justify-center text-xs font-bold">AL</div>
                        <div class="w-12 h-12 rounded-full border-4 border-white bg-slate-100 shadow-sm flex items-center justify-center text-xs font-bold">TK</div>
                    </div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-widest leading-none">+12K Members Joined</p>
                </div>
            </div>

            <!-- Right: Premium Interactive UI Mockup -->
            <div class="relative perspective-1000 group">
                <!-- Main Mockup Container -->
                <div class="relative bg-white/40 backdrop-blur-3xl border border-white/60 p-6 rounded-[3.5rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.06)] transform group-hover:rotate-x-2 group-hover:rotate-y-[-2] transition-transform duration-700 ease-out">
                    <div class="bg-white rounded-[3rem] p-10 shadow-inner space-y-12">
                        <!-- Header Simulator -->
                        <div class="flex items-center justify-between border-b border-slate-50 pb-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center hover:bg-indigo-600 group/icon transition-all shadow-sm">
                                    <svg class="w-6 h-6 text-indigo-600 group-hover/icon:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <div class="space-y-0.5">
                                    <h5 class="text-base font-bold text-slate-900 leading-none">Nguyen Van A</h5>
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Candidate Profile</span>
                                </div>
                            </div>
                            <div class="p-3 bg-emerald-50 rounded-2xl flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                <span class="text-[10px] font-black text-emerald-600 uppercase">Match Score Optimized</span>
                            </div>
                        </div>

                        <!-- Progress Section -->
                        <div class="flex flex-col md:flex-row items-center gap-12">
                            <div class="relative w-40 h-40 group/radial shrink-0">
                                <svg class="w-full h-full -rotate-90">
                                    <circle cx="80" cy="80" r="70" class="stroke-slate-100 fill-none" stroke-width="12"></circle>
                                    <circle cx="80" cy="80" r="70" class="stroke-indigo-600 fill-none" stroke-width="12" stroke-dasharray="440" stroke-dashoffset="66" stroke-linecap="round shadow-sm"></circle>
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span class="text-4xl font-black text-slate-950">85<span class="text-indigo-600">%</span></span>
                                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest leading-none mt-1">Excellent</span>
                                </div>
                            </div>
                            <div class="space-y-5 flex-1">
                                <h4 class="text-2xl font-black text-slate-950 leading-tight">Match Quality Analysis</h4>
                                <div class="space-y-3">
                                    <div class="h-2.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-indigo-600 rounded-full w-[85%]"></div>
                                    </div>
                                    <div class="flex justify-between text-[11px] font-black text-slate-400 uppercase tracking-tighter">
                                        <span>Skills Match</span>
                                        <span class="text-indigo-600">92% Match</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action List simulator -->
                         <div class="grid grid-cols-2 gap-4">
                            <div class="p-5 rounded-[2rem] bg-slate-50 border border-slate-100/50 space-y-3 hover:bg-indigo-50/50 hover:border-indigo-100 transition-all cursor-default group/card">
                                <div class="w-8 h-8 rounded-xl bg-white flex items-center justify-center text-emerald-500 shadow-sm italic font-black text-xs">A+</div>
                                <h6 class="text-sm font-bold text-slate-900 leading-none">Skill Strengths</h6>
                                <p class="text-[10px] font-medium text-slate-500 leading-relaxed">System Design, High Performance Java, Database Tuning.</p>
                            </div>
                            <div class="p-5 rounded-[2rem] bg-slate-50 border border-slate-100/50 space-y-3 hover:bg-red-50/50 hover:border-red-100 transition-all cursor-default">
                                <div class="w-8 h-8 rounded-xl bg-white flex items-center justify-center text-amber-500 shadow-sm italic font-black text-xs">!!</div>
                                <h6 class="text-sm font-bold text-slate-900 leading-none">Missing Gap</h6>
                                <p class="text-[10px] font-medium text-slate-500 leading-relaxed">Bổ sung ngay Docker & K8s để tăng 15% Match Rate.</p>
                            </div>
                         </div>
                    </div>
                </div>

                <!-- Floating Orbs (AI Decor) -->
                <div class="absolute -top-16 -right-16 w-32 h-32 bg-indigo-500/20 rounded-full blur-2xl animate-bounce-slow"></div>
                <div class="absolute top-1/2 -left-12 p-5 bg-white rounded-3xl shadow-2xl border border-slate-100 animate-float">
                    <p class="text-[10px] font-black text-indigo-600 uppercase mb-2 leading-none tracking-widest">AI Suggestion</p>
                    <p class="text-xs font-bold text-slate-900 leading-tight">"Thay đổi tiêu đề thành: Chuyên gia Microservices Java..."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Features Section -->
    <section id="features" class="py-40 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center space-y-4 mb-24">
                <span class="text-xs font-black text-indigo-600 uppercase tracking-[0.3em]">System Capabilities</span>
                <h2 class="font-heading text-5xl lg:text-6xl font-black text-slate-950">Vượt xa mọi kỳ vọng.</h2>
                <p class="text-slate-500 text-lg max-w-2xl mx-auto italic font-medium leading-relaxed">Chúng tôi không chỉ chỉnh sửa CV, chúng tôi kiến tạo lộ trình thành công cho bạn.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="group p-10 bg-slate-50 rounded-[3rem] border border-slate-100 hover:bg-white hover:border-indigo-100 hover:shadow-2xl hover:shadow-indigo-100/50 transition-all duration-500 space-y-10">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-indigo-600 shadow-lg group-hover:scale-110 group-hover:-rotate-3 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-2xl font-black text-slate-950 leading-tight tracking-tight">AI Matching Score %</h4>
                        <p class="text-slate-500 text-sm leading-relaxed font-bold opacity-80 italic">Đánh giá độ phù hợp của Resume với Job Description theo thời gian thực.</p>
                    </div>
                    <div class="pt-4 border-t border-slate-200/50 flex justify-between items-center group-hover:translate-x-1 transition-transform">
                        <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">Learn more</span>
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group p-10 bg-slate-50 rounded-[3rem] border border-slate-100 hover:bg-white hover:border-indigo-100 hover:shadow-2xl hover:shadow-indigo-100/50 transition-all duration-500 space-y-10">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-blue-500 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-2xl font-black text-slate-950 leading-tight tracking-tight">Trích xuất kỹ năng</h4>
                        <p class="text-slate-500 text-sm leading-relaxed font-bold opacity-80 italic">Tự động nhận diện kinh nghiệm, kỹ năng và thành tựu từ văn bản thô.</p>
                    </div>
                    <div class="pt-4 border-t border-slate-200/50 flex justify-between items-center group-hover:translate-x-1 transition-transform">
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Explore Engine</span>
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group p-10 bg-slate-50 rounded-[3rem] border border-slate-100 hover:bg-white hover:border-indigo-100 hover:shadow-2xl hover:shadow-indigo-100/50 transition-all duration-500 space-y-10">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-amber-500 shadow-lg group-hover:scale-110 group-hover:-rotate-3 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-2xl font-black text-slate-950 leading-tight tracking-tight">Career Roadmap</h4>
                        <p class="text-slate-500 text-sm leading-relaxed font-bold opacity-80 italic">Đề xuất lộ trình học tập để đáp ứng những kỹ năng còn thiếu hụt.</p>
                    </div>
                    <div class="pt-4 border-t border-slate-200/50 flex justify-between items-center group-hover:translate-x-1 transition-transform">
                        <span class="text-[10px] font-black text-amber-600 uppercase tracking-widest">Plan Roadmap</span>
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern Dark Footer Variant -->
    <footer class="bg-slate-950 py-32 text-white overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16">
            <div class="space-y-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-2xl flex items-center justify-center font-black">AI</div>
                    <span class="font-heading font-black text-2xl tracking-tighter uppercase">AI Career Tailor</span>
                </div>
                <p class="text-slate-400 text-sm font-medium italic opacity-70">Empowering candidates with the world's most advanced AI resume optimization engine.</p>
            </div>
            
            <div class="space-y-8">
                <h6 class="text-xs font-black uppercase tracking-widest text-indigo-400">Platform</h6>
                <ul class="space-y-4 text-sm font-bold text-slate-500">
                    <li class="hover:text-white transition-colors"><a href="#">How it works</a></li>
                    <li class="hover:text-white transition-colors"><a href="#">AI Analysis</a></li>
                    <li class="hover:text-white transition-colors"><a href="#">Pricing</a></li>
                </ul>
            </div>
            
            <div class="space-y-8">
                <h6 class="text-xs font-black uppercase tracking-widest text-indigo-400">Resources</h6>
                <ul class="space-y-4 text-sm font-bold text-slate-500">
                    <li class="hover:text-white transition-colors"><a href="#">Documentation</a></li>
                    <li class="hover:text-white transition-colors"><a href="#">API Integration</a></li>
                    <li class="hover:text-white transition-colors"><a href="#">Community</a></li>
                </ul>
            </div>

            <div class="space-y-8">
                <h6 class="text-xs font-black uppercase tracking-widest text-indigo-400">Newsletter</h6>
                <div class="relative group">
                    <input type="email" placeholder="Email Address..." class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-6 py-4 text-sm font-bold focus:outline-none focus:border-indigo-600 transition-all"/>
                    <button class="absolute right-2 top-2 p-2 bg-indigo-600 rounded-xl hover:bg-indigo-500 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="absolute bottom-[-10%] flex justify-center w-full opacity-5 pointer-events-none">
            <span class="text-[20rem] font-black font-heading leading-none">TAILOR</span>
        </div>
    </footer>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-30px); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-bounce-slow { animation: bounce-slow 4s ease-in-out infinite; }
        .perspective-1000 { perspective: 1000px; }
        .rotate-x-2 { transform: rotateX(5deg); }
        .rotate-y-2 { transform: rotateY(-5deg); }
        
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
</x-client-layout>
