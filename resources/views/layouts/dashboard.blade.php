<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-[#f8fafc] font-sans text-slate-900">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 z-40 flex h-screen w-72 flex-col border-r border-slate-200 bg-white">
        <div class="flex h-24 items-center gap-4 border-b border-slate-200 px-6">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-white">
                🎓
            </div>
            <h1 class="text-xl font-extrabold text-slate-900">UniManage</h1>
        </div>

        <nav class="flex-1 space-y-2 px-4 py-6">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-4 rounded-2xl px-5 py-4 text-base font-bold transition
               {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-100' }}">
                ▦ <span>Dashboard</span>
            </a>

            <a href="{{ route('students.index') }}"
               class="flex items-center gap-4 rounded-2xl px-5 py-4 text-base font-bold transition
               {{ request()->routeIs('students.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-100' }}">
                👥 <span>Students</span>
            </a>

            <a href="{{ route('courses.index') }}"
                class="flex items-center gap-4 rounded-2xl px-5 py-4 text-base font-bold transition
                {{ request()->routeIs('courses.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    📚 <span>Courses</span>
            </a>

            <a href="{{ route('instructors.index') }}"
            class="flex items-center gap-4 rounded-2xl px-5 py-4 text-base font-bold transition
                {{ request()->routeIs('instructors.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    👨‍🏫 <span>Instructors</span>
            </a>


            <a href="#"
               class="flex items-center gap-4 rounded-2xl px-5 py-4 text-base font-bold text-slate-700 transition hover:bg-slate-100">
                🎓 <span>Faculty</span>
            </a>

            <a href="#"
               class="flex items-center gap-4 rounded-2xl px-5 py-4 text-base font-bold text-slate-700 transition hover:bg-slate-100">
                📝 <span>Attendance</span>
            </a>

            <a href="#"
               class="flex items-center gap-4 rounded-2xl px-5 py-4 text-base font-bold text-slate-700 transition hover:bg-slate-100">
                🏅 <span>Grades</span>
            </a>
        </nav>

        <div class="border-t border-slate-200 px-4 py-5">
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-4 rounded-2xl px-5 py-4 text-base font-bold text-slate-700 transition hover:bg-slate-100">
                ⚙️ <span>Settings</span>
            </a>
        </div>
    </aside>

    <!-- Main -->
    <main class="ml-72 flex-1">
        <!-- Topbar -->
        <header class="sticky top-0 z-30 flex h-24 items-center justify-end border-b border-slate-200 bg-white px-8">
            <div class="flex items-center gap-6">
                <div class="relative text-2xl">
                    🔔
                    <span class="absolute -right-1 -top-1 h-3 w-3 rounded-full bg-red-500"></span>
                </div>

                <div class="h-12 w-px bg-slate-200"></div>

                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-lg font-extrabold text-blue-600">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-base font-extrabold text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-slate-500">Administrator</p>
                    </div>
                </div>
            </div>
        </header>

        <section class="p-8">
            {{ $slot }}
        </section>
    </main>
</div>

@if (session()->has('success'))
<div 
    x-data="{ show: true }"
    x-init="
        setTimeout(() => show = false, 3000);
        document.body.style.overflow = 'hidden';
        setTimeout(() => document.body.style.overflow = 'auto', 3000);
    "
    x-show="show"
    x-transition
    class="fixed inset-0 z-50 flex items-center justify-center">

    <!-- Background Blur -->
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>

    <!-- Popup -->
    <div class="relative rounded-3xl bg-white px-10 py-8 text-center shadow-2xl">

        <!-- Icon -->
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-3xl text-green-600">
            ✔
        </div>

        <!-- Title -->
        <h2 class="text-xl font-extrabold text-slate-900">
            Success
        </h2>

        <!-- Message -->
        <p class="mt-2 text-sm text-slate-500">
            {{ session('success') }}
        </p>

    </div>
</div>
@endif
@if ($errors->any())
<div 
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show"
    x-transition
    class="fixed inset-0 z-50 flex items-center justify-center">

    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>

    <div class="relative w-[90%] max-w-md rounded-3xl bg-white px-8 py-7 text-center shadow-2xl">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-3xl text-red-600">
            ✕
        </div>

        <h2 class="text-xl font-extrabold text-slate-900">
            Error
        </h2>

        <div class="mt-3 space-y-1 text-sm text-slate-500">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
</div>
@endif

@livewireScripts
</body>
</html>