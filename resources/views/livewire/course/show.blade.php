<div class="min-h-screen bg-[#eee9f8] px-6 py-8">

    <div class="mb-8 rounded-[32px] bg-gradient-to-r from-[#4b3f8f] to-[#7c63f4] px-10 py-10 text-white shadow-xl">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="mb-3 text-sm font-extrabold uppercase tracking-[0.4em] text-white/70">
                    Course Profile
                </p>

                <h1 class="text-4xl font-extrabold md:text-5xl">
                    {{ $course->course_name }}
                </h1>

                <p class="mt-4 text-base text-white/80">
                    Complete academic course details and enrollment overview.
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('courses.edit', $course->id) }}"
                   class="rounded-2xl bg-white px-7 py-4 text-sm font-extrabold text-[#4b3f8f] transition hover:bg-white/90">
                    Edit Course
                </a>

                <a href="{{ route('courses.index') }}"
                   class="rounded-2xl bg-white/20 px-7 py-4 text-sm font-extrabold text-white transition hover:bg-white/30">
                    ← Back
                </a>
            </div>
        </div>
    </div>

    @php
        $percent = $course->capacity > 0
            ? min(100, round(($course->enrolled / $course->capacity) * 100))
            : 0;
    @endphp

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">

        <div class="rounded-[32px] bg-white p-8 shadow-xl lg:col-span-1">
            <div class="flex flex-col items-center text-center">
                <div class="flex h-28 w-28 items-center justify-center rounded-full bg-[#eee9f8] text-5xl font-extrabold text-[#4b3f8f]">
                    {{ strtoupper(substr($course->course_name, 0, 1)) }}
                </div>

                <h2 class="mt-7 text-2xl font-extrabold text-slate-900">
                    {{ $course->course_name }}
                </h2>

                <p class="mt-2 text-sm text-slate-400">
                    {{ $course->course_code }}
                </p>

                <span class="mt-5 rounded-full px-5 py-2 text-sm font-extrabold
                    {{ $course->status === 'Active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $course->status }}
                </span>
            </div>

            <div class="mt-8">
                <div class="mb-3 flex justify-between text-sm font-bold text-slate-600">
                    <span>Enrollment</span>
                    <span>{{ $course->enrolled }}/{{ $course->capacity }}</span>
                </div>

                <div class="h-3 w-full rounded-full bg-slate-200">
                    <div class="h-3 rounded-full bg-[#4b3f8f]"
                         style="width: {{ $percent }}%"></div>
                </div>

                <p class="mt-3 text-center text-sm font-bold text-slate-500">
                    {{ $percent }}% filled
                </p>
            </div>
        </div>

        <div class="rounded-[32px] bg-white p-10 shadow-xl lg:col-span-3">

            <h2 class="mb-7 text-2xl font-extrabold text-slate-900">
                Course Information
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div class="rounded-2xl bg-[#f8f7fd] p-5">
                    <p class="text-sm font-bold text-slate-400">Course Code</p>
                    <p class="mt-2 font-extrabold text-slate-900">{{ $course->course_code }}</p>
                </div>

                <div class="rounded-2xl bg-[#f8f7fd] p-5">
                    <p class="text-sm font-bold text-slate-400">Course Name</p>
                    <p class="mt-2 font-extrabold text-slate-900">{{ $course->course_name }}</p>
                </div>

                <div class="rounded-2xl bg-[#f8f7fd] p-5">
                    <p class="text-sm font-bold text-slate-400">Department</p>
                    <p class="mt-2 font-extrabold text-slate-900">{{ $course->department }}</p>
                </div>

                <div class="rounded-2xl bg-[#f8f7fd] p-5">
                    <p class="text-sm font-bold text-slate-400">Instructor</p>
                    <p class="mt-2 font-extrabold text-slate-900">{{ $course->instructor }}</p>
                </div>
            </div>

            <div class="my-10 border-t border-slate-200"></div>

            <h2 class="mb-7 text-2xl font-extrabold text-slate-900">
                Academic Details
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <div class="rounded-2xl bg-blue-50 p-5">
                    <p class="text-sm font-bold text-blue-500">Credits</p>
                    <p class="mt-2 text-2xl font-extrabold text-blue-700">{{ $course->credits }}</p>
                </div>

                <div class="rounded-2xl bg-green-50 p-5">
                    <p class="text-sm font-bold text-green-500">Capacity</p>
                    <p class="mt-2 text-2xl font-extrabold text-green-700">{{ $course->capacity }}</p>
                </div>

                <div class="rounded-2xl bg-purple-50 p-5">
                    <p class="text-sm font-bold text-purple-500">Enrolled</p>
                    <p class="mt-2 text-2xl font-extrabold text-purple-700">{{ $course->enrolled }}</p>
                </div>
            </div>

            <div class="my-10 border-t border-slate-200"></div>

            <h2 class="mb-7 text-2xl font-extrabold text-slate-900">
                Schedule Details
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div class="rounded-2xl bg-[#f8f7fd] p-5">
                    <p class="text-sm font-bold text-slate-400">Schedule</p>
                    <p class="mt-2 font-extrabold text-slate-900">{{ $course->schedule }}</p>
                </div>

                <div class="rounded-2xl bg-[#f8f7fd] p-5">
                    <p class="text-sm font-bold text-slate-400">Room</p>
                    <p class="mt-2 font-extrabold text-slate-900">{{ $course->room }}</p>
                </div>
            </div>

        </div>
    </div>
</div>