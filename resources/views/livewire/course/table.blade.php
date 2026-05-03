<div>
    <!-- Page Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">Courses</h1>
            <p class="mt-2 text-lg text-slate-500">Manage course catalog and enrollments</p>
        </div>

        <a href="{{ route('courses.create') }}"
           class="rounded-2xl bg-blue-600 px-7 py-4 text-base font-bold text-white shadow-lg transition hover:bg-blue-700">
            + Add Course
        </a>
    </div>

    <!-- Search Filter -->
    <div class="mb-7 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
            <div class="lg:col-span-3 flex items-center gap-3 rounded-2xl border border-slate-300 bg-white px-5 py-4">
                <span class="text-xl text-slate-400">⌕</span>

                <input type="text"
                       wire:model.live.debounce.400ms="keyword"
                       placeholder="Search courses by name, code, or instructor..."
                       class="w-full border-0 bg-transparent text-base outline-none ring-0 focus:ring-0">
            </div>

            <select wire:model.live="department"
                    class="rounded-2xl border border-slate-300 px-5 py-4 text-base outline-none focus:border-blue-500 focus:ring-blue-500">
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

            <div class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <!-- Top -->
                <div class="mb-7 flex items-start justify-between">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-2xl text-blue-600">
                        📖
                    </div>

                    <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-bold text-slate-700">
                        {{ $course->credits }} Credits
                    </span>
                </div>

                <!-- Title -->
                <h2 class="text-xl font-extrabold text-slate-900">
                    {{ $course->course_name }}
                </h2>

                <p class="mt-2 text-base text-slate-600">
                    {{ $course->course_code }} • {{ $course->department }}
                </p>

                <!-- Details -->
                <div class="mt-6 space-y-3 text-base text-slate-700">
                    <p>👥 Instructor: {{ $course->instructor ?? 'Not Assigned' }}</p>
                    <p>🕘 {{ $course->schedule ?? 'Schedule not added' }}</p>
                    <p>🗓️ Room {{ $course->room ?? 'N/A' }}</p>
                </div>

                <!-- Enrollment -->
                <div class="mt-7">
                    <div class="mb-3 flex items-center justify-between">
                        <p class="text-base text-slate-600">Enrollment</p>
                        <p class="font-extrabold text-slate-900">
                            {{ $course->enrolled }}/{{ $course->capacity }}
                        </p>
                    </div>

                    <div class="h-2.5 w-full rounded-full bg-slate-200">
                        <div class="h-2.5 rounded-full bg-blue-600"
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
            <div class="col-span-full rounded-2xl border border-slate-200 bg-white p-12 text-center shadow-sm">
                <p class="text-lg font-bold text-slate-700">No courses found</p>
                <p class="mt-1 text-sm text-slate-400">Add your first course or change filters.</p>
            </div>
        @endforelse
    </div>

@if ($confirmingDeleteId)
    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

        <div class="relative w-[90%] max-w-md rounded-3xl bg-white p-8 text-center shadow-2xl">
            <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-3xl font-extrabold text-red-600">
                !
            </div>

            <h2 class="text-2xl font-extrabold text-slate-900">
                Delete Course?
            </h2>

            <p class="mt-3 text-sm text-slate-500">
                Are you sure you want to delete this course? This action cannot be undone.
            </p>

            <div class="mt-8 flex gap-4">
                <button type="button"
                        wire:click="cancelDelete"
                        class="flex-1 rounded-2xl border border-slate-300 px-5 py-3 font-bold text-slate-700 hover:bg-slate-100">
                    Cancel
                </button>

                <button type="button"
                        wire:click="deleteCourse"
                        class="flex-1 rounded-2xl bg-red-600 px-5 py-3 font-bold text-white hover:bg-red-700">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>
@endif
</div>