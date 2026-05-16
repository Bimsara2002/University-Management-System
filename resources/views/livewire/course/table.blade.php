<div>
    <!-- Page Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white">Courses</h1>
            <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Manage course catalog and enrollments</p>
        </div>

        <a href="{{ route('courses.create') }}"
           class="rounded-2xl bg-blue-600 px-7 py-4 text-base font-bold text-white shadow-lg transition hover:bg-blue-700">
            + Add Course
        </a>
    </div>

    <!-- Search Filter -->
    <div class="mb-7 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-5 shadow-sm transition-colors">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
            <div class="lg:col-span-3 flex items-center gap-3 rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>

                <input type="text"
                       wire:model.live.debounce.400ms="keyword"
                       placeholder="Search courses by name, code, or instructor..."
                       class="w-full border-0 bg-transparent text-base text-slate-900 dark:text-white placeholder-slate-400 outline-none ring-0 focus:ring-0">
            </div>

            <select wire:model.live="department"
                    class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4 text-base text-slate-900 dark:text-white outline-none focus:border-blue-500 focus:ring-blue-500">
                <option value="">All Departments</option>

                @foreach ($departments as $departmentName)
                    <option value="{{ $departmentName }}">{{ $departmentName }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Course Cards -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($courses as $course)
            @php
                $percent = $course->capacity > 0
                    ? min(100, round(($course->enrolled / $course->capacity) * 100))
                    : 0;
            @endphp

            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:hover:shadow-slate-800/50">
                <!-- Top -->
                <div class="mb-7 flex items-start justify-between">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                    </div>

                    <span class="rounded-full bg-slate-100 dark:bg-slate-800 px-4 py-2 text-sm font-bold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                        {{ $course->credits }} Credits
                    </span>
                </div>

                <!-- Title -->
                <h2 class="text-xl font-extrabold text-slate-900 dark:text-white">
                    {{ $course->course_name }}
                </h2>

                <p class="mt-2 text-base text-slate-600 dark:text-slate-400">
                    {{ $course->course_code }} • {{ $course->department }}
                </p>

                <!-- Details -->
                <div class="mt-6 space-y-3 text-base text-slate-700 dark:text-slate-300">
                    <p class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg> {{ $course->instructor ?? 'Not Assigned' }}</p>
                    <p class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg> {{ $course->schedule ?? 'Schedule not added' }}</p>
                    <p class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg> Room {{ $course->room ?? 'N/A' }}</p>
                </div>

                <!-- Enrollment -->
                <div class="mt-7">
                    <div class="mb-3 flex items-center justify-between">
                        <p class="text-base text-slate-600 dark:text-slate-400">Enrollment</p>
                        <p class="font-extrabold text-slate-900 dark:text-white">
                            {{ $course->enrolled }}/{{ $course->capacity }}
                        </p>
                    </div>

                    <div class="h-2.5 w-full rounded-full bg-slate-200 dark:bg-slate-700">
                        <div class="h-2.5 rounded-full bg-blue-600 dark:bg-blue-500"
                             style="width: {{ $percent }}%"></div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-7 flex items-center justify-between">
                    <a href="{{ route('courses.show', $course->id) }}"
                        class="font-bold text-blue-600 hover:text-blue-800">
                        View
                    </a>

                    <a href="{{ route('courses.edit', $course->id) }}"
                        class="font-bold text-amber-500 hover:text-amber-600">
                        Edit
                    </a>

                    <button type="button"
                            wire:click="confirmDelete({{ $course->id }})"
                            class="font-bold text-red-500 hover:text-red-700">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-12 text-center shadow-sm">
                <p class="text-lg font-bold text-slate-700 dark:text-slate-300">No courses found</p>
                <p class="mt-1 text-sm text-slate-400 dark:text-slate-500">Add your first course or change filters.</p>
            </div>
        @endforelse
    </div>

@if ($confirmingDeleteId)
    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

        <div class="relative w-[90%] max-w-md rounded-3xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-8 text-center shadow-2xl">
            <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-red-600 dark:bg-red-900/50 dark:text-red-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>

            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">
                Delete Course?
            </h2>

            <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">
                Are you sure you want to delete this course? This action cannot be undone.
            </p>

            <div class="mt-8 flex gap-4">
                <button type="button"
                        wire:click="cancelDelete"
                        class="flex-1 rounded-2xl border border-slate-300 dark:border-slate-600 px-5 py-3 font-bold text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                    Cancel
                </button>

                <button type="button"
                        wire:click="deleteCourse"
                        class="flex-1 rounded-2xl bg-red-600 px-5 py-3 font-bold text-white hover:bg-red-700 transition shadow-lg shadow-red-500/30">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>
@endif
</div>