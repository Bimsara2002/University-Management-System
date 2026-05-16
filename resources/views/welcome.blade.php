<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode')); $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark': darkMode}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mosaic University Management</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-nav {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .bg-grid-pattern {
            background-image: linear-gradient(to right, rgba(0,0,0,0.05) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(0,0,0,0.05) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .dark .bg-grid-pattern {
            background-image: linear-gradient(to right, rgba(255,255,255,0.02) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(255,255,255,0.02) 1px, transparent 1px);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-[#0a0a0a] text-slate-900 dark:text-slate-100 antialiased selection:bg-blue-500 selection:text-white transition-colors duration-300 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="glass-nav fixed top-0 w-full z-50 border-b border-slate-200/50 dark:border-slate-800/50 bg-white/70 dark:bg-slate-900/70 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-500/30">
                        M
                    </div>
                    <span class="font-extrabold text-xl tracking-tight text-slate-900 dark:text-white">Mosaic<span class="text-blue-600 dark:text-blue-400">Uni</span></span>
                </div>
                
                <div class="flex items-center gap-6">
                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode" type="button" class="text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-colors p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800">
                        <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" /></svg>
                        <svg x-show="darkMode" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" /></svg>
                    </button>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-bold text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-bold text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-full bg-slate-900 dark:bg-white px-6 py-2.5 text-sm font-bold text-white dark:text-slate-900 transition hover:bg-slate-800 dark:hover:bg-slate-200 shadow-lg shadow-slate-900/20 dark:shadow-white/10">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow pt-32 pb-16 flex flex-col justify-center relative overflow-hidden bg-grid-pattern">
        <!-- Abstract gradient shapes -->
        <div class="absolute top-0 -left-40 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 dark:opacity-10 animate-blob"></div>
        <div class="absolute top-0 -right-40 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 dark:opacity-10 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 dark:opacity-10 animate-blob animation-delay-4000"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-blue-200 dark:border-blue-900/50 bg-blue-50/50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-sm font-bold mb-8 backdrop-blur-sm">
                <span class="flex h-2 w-2 rounded-full bg-blue-600 dark:bg-blue-400 animate-pulse"></span>
                Mosaic System v2.0
            </div>
            
            <h1 class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white tracking-tight leading-tight mb-8">
                Empowering Modern <br />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600">Education Management</span>
            </h1>
            
            <p class="mt-4 text-xl text-slate-600 dark:text-slate-400 max-w-3xl mx-auto mb-10 leading-relaxed">
                Streamline operations, enhance student experiences, and unify your campus with the next generation of academic administration software.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('login') }}" class="rounded-full bg-blue-600 px-8 py-4 text-lg font-bold text-white transition hover:bg-blue-700 hover:-translate-y-1 shadow-xl shadow-blue-500/30">
                    Access Portal
                </a>
                <a href="#features" class="rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-8 py-4 text-lg font-bold text-slate-700 dark:text-slate-300 transition hover:bg-slate-50 dark:hover:bg-slate-700 hover:-translate-y-1 shadow-lg shadow-slate-200/50 dark:shadow-none">
                    Explore Features
                </a>
            </div>
        </div>

        <!-- Dashboard Preview Image/Mockup -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 relative z-10">
            <div class="rounded-3xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 p-2 shadow-2xl backdrop-blur-xl">
                <div class="rounded-[22px] overflow-hidden border border-slate-100 dark:border-slate-800 bg-slate-100 dark:bg-slate-950 aspect-video relative flex items-center justify-center">
                    <!-- Stylized placeholder for dashboard UI -->
                    <div class="absolute inset-0 p-8 grid grid-cols-4 gap-6 opacity-60 dark:opacity-40 pointer-events-none">
                        <!-- Sidebar -->
                        <div class="col-span-1 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 flex flex-col gap-4">
                            <div class="w-2/3 h-8 bg-slate-200 dark:bg-slate-800 rounded-lg"></div>
                            <div class="mt-8 space-y-3">
                                <div class="w-full h-10 bg-blue-50 dark:bg-blue-900/20 rounded-xl"></div>
                                <div class="w-full h-10 bg-slate-100 dark:bg-slate-800/50 rounded-xl"></div>
                                <div class="w-full h-10 bg-slate-100 dark:bg-slate-800/50 rounded-xl"></div>
                                <div class="w-full h-10 bg-slate-100 dark:bg-slate-800/50 rounded-xl"></div>
                            </div>
                        </div>
                        <!-- Main Content -->
                        <div class="col-span-3 flex flex-col gap-6">
                            <div class="w-full h-20 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl"></div>
                            <div class="grid grid-cols-3 gap-6">
                                <div class="h-32 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl"></div>
                                <div class="h-32 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl"></div>
                                <div class="h-32 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl"></div>
                            </div>
                            <div class="flex-grow bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl"></div>
                        </div>
                    </div>
                    <div class="absolute z-20 flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-16 h-16 text-blue-500 mb-4 drop-shadow-lg"><path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 0 1 8.25-8.25.75.75 0 0 1 .75.75v6.75H18a.75.75 0 0 1 .75.75 8.25 8.25 0 0 1-16.5 0Z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M12.75 3a.75.75 0 0 1 .75-.75 8.25 8.25 0 0 1 8.25 8.25.75.75 0 0 1-.75.75h-7.5a.75.75 0 0 1-.75-.75V3Z" clip-rule="evenodd" /></svg>
                        <p class="font-extrabold text-2xl text-slate-800 dark:text-white drop-shadow-md">Unified Dashboard Experience</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-white dark:bg-[#0f0f0f] border-t border-slate-200 dark:border-slate-800 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-black text-slate-900 dark:text-white mb-4">Everything you need to run your institution.</h2>
                <p class="text-lg text-slate-500 dark:text-slate-400">A complete ecosystem designed to reduce administrative overhead and focus on academic excellence.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 rounded-[32px] border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/50 rounded-2xl flex items-center justify-center text-blue-600 dark:text-blue-400 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Student Management</h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">Maintain comprehensive student profiles, academic histories, and personal information in one secure database.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-[32px] border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/50 rounded-2xl flex items-center justify-center text-purple-600 dark:text-purple-400 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Attendance Tracking</h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">Easily record and monitor student attendance across all courses with real-time reporting and alerts.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-[32px] border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-green-100 dark:bg-green-900/50 rounded-2xl flex items-center justify-center text-green-600 dark:text-green-400 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Fee Collection</h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">Manage tuition, record payments, and track overdue balances seamlessly with integrated financial tools.</p>
                </div>

                <!-- Feature 4 -->
                <div class="p-8 rounded-[32px] border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-amber-100 dark:bg-amber-900/50 rounded-2xl flex items-center justify-center text-amber-600 dark:text-amber-400 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Academic Results</h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">Calculate GPAs, record course grades, and generate automated transcripts for every semester.</p>
                </div>
                
                <!-- Feature 5 -->
                <div class="p-8 rounded-[32px] border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-rose-100 dark:bg-rose-900/50 rounded-2xl flex items-center justify-center text-rose-600 dark:text-rose-400 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Instructor Hub</h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">Empower educators with tools to manage their courses, view rosters, and input marks directly.</p>
                </div>

                <!-- Feature 6 -->
                <div class="p-8 rounded-[32px] border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-14 h-14 bg-indigo-100 dark:bg-indigo-900/50 rounded-2xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Live Dashboard</h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">Gain immediate insights into university metrics with live charts, statistics, and proactive alerts.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 relative overflow-hidden bg-blue-600 dark:bg-blue-900">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-3xl md:text-5xl font-black text-white mb-6">Ready to transform your campus?</h2>
            <p class="text-xl text-blue-100 mb-10">Join leading institutions upgrading their management architecture.</p>
            <a href="{{ route('register') }}" class="inline-block rounded-full bg-white px-10 py-4 text-lg font-bold text-blue-600 transition hover:bg-blue-50 shadow-2xl hover:-translate-y-1">
                Start Your Free Trial
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white dark:bg-[#0a0a0a] border-t border-slate-200 dark:border-slate-800 py-12 transition-colors mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="h-8 w-8 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center text-white font-black text-sm">
                    M
                </div>
                <span class="font-bold text-slate-900 dark:text-white tracking-tight">MosaicUni</span>
            </div>
            
            <p class="text-slate-500 dark:text-slate-400 text-sm">
                &copy; {{ date('Y') }} Mosaic University Management System. All rights reserved. Laravel v{{ app()->version() }}
            </p>

            <div class="flex gap-4">
                <a href="#" class="text-slate-400 hover:text-blue-600 transition">Terms</a>
                <a href="#" class="text-slate-400 hover:text-blue-600 transition">Privacy</a>
                <a href="#" class="text-slate-400 hover:text-blue-600 transition">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>
