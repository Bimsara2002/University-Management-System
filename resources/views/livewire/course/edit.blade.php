<div class="min-h-screen bg-[#eee9f8] px-6 py-8">

    <div class="mb-8 rounded-[32px] bg-gradient-to-r from-[#4b3f8f] to-[#7c63f4] px-10 py-10 text-white shadow-xl">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="mb-3 text-sm font-extrabold uppercase tracking-[0.4em] text-white/70">
                    Course Management
                </p>

                <h1 class="text-4xl font-extrabold md:text-5xl">
                    Edit Course
                </h1>

                <p class="mt-4 text-base text-white/80">
                    Update course academic, schedule, capacity, and enrollment details.
                </p>
            </div>

            <a href="{{ route('courses.index') }}"
               class="w-fit rounded-2xl bg-white/20 px-8 py-4 text-sm font-extrabold text-white transition hover:bg-white/30">
                ← Back to Courses
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">

        <div class="rounded-[32px] bg-white p-8 shadow-xl lg:col-span-1">
            <div class="flex flex-col items-center text-center">
                <div class="flex h-28 w-28 items-center justify-center rounded-full bg-[#eee9f8] text-5xl font-extrabold text-[#4b3f8f]">
                    {{ $course_name ? strtoupper(substr($course_name, 0, 1)) : 'C' }}
                </div>

                <h2 class="mt-7 text-2xl font-extrabold text-slate-900">
                    {{ $course_name ?: 'Course Name' }}
                </h2>

                <p class="mt-2 text-sm text-slate-400">
                    {{ $course_code ?: 'Course Code Preview' }}
                </p>
            </div>

            <div class="mt-8 space-y-4">
                <div class="rounded-2xl bg-[#f8f7fd] p-5">
                    <p class="text-sm font-bold text-slate-400">Department</p>
                    <p class="mt-2 font-extrabold text-slate-800">
                        {{ $department ?: 'Not selected' }}
                    </p>
                </div>

                <div class="rounded-2xl bg-[#f8f7fd] p-5">
                    <p class="text-sm font-bold text-slate-400">Credits</p>
                    <p class="mt-2 font-extrabold text-slate-800">
                        {{ $credits ?: 'Not selected' }}
                    </p>
                </div>

                <div class="rounded-2xl bg-green-50 p-5">
                    <p class="text-sm font-bold text-green-500">Status</p>
                    <p class="mt-2 font-extrabold text-green-700">
                        {{ $status ?: 'Not selected' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="rounded-[32px] bg-white p-10 shadow-xl lg:col-span-3">
            <form wire:submit.prevent="update">

                <h2 class="mb-7 text-2xl font-extrabold text-slate-900">Course Information</h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Course Code <span class="text-red-500">*</span></label>
                        <input type="text" wire:model.live="course_code"
                               class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                        @error('course_code') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Course Name <span class="text-red-500">*</span></label>
                        <input type="text" wire:model.live="course_name"
                               class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                        @error('course_name') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Department <span class="text-red-500">*</span></label>
                        <select wire:model.live="department"
                                class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                            <option value="">Select Department</option>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Cyber Security">Cyber Security</option>
                            <option value="Data Science">Data Science</option>
                            <option value="Business Management">Business Management</option>
                            <option value="Accounting">Accounting</option>
                        </select>
                        @error('department') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Instructor <span class="text-red-500">*</span></label>
                        <input type="text" wire:model.live="instructor"
                               class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                        @error('instructor') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="my-10 border-t border-slate-200"></div>

                <h2 class="mb-7 text-2xl font-extrabold text-slate-900">Academic Details</h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Credits <span class="text-red-500">*</span></label>
                        <input type="number" wire:model.live="credits"
                               class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                        @error('credits') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Capacity <span class="text-red-500">*</span></label>
                        <input type="number" wire:model.live="capacity"
                               class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                        @error('capacity') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Enrolled Students <span class="text-red-500">*</span></label>
                        <input type="number" wire:model.live="enrolled"
                               class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                        @error('enrolled') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Status <span class="text-red-500">*</span></label>
                        <select wire:model.live="status"
                                class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        @error('status') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="my-10 border-t border-slate-200"></div>

                <h2 class="mb-7 text-2xl font-extrabold text-slate-900">Schedule Details</h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Schedule <span class="text-red-500">*</span></label>
                        <input type="text" wire:model.live="schedule"
                               class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                        @error('schedule') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Room <span class="text-red-500">*</span></label>
                        <input type="text" wire:model.live="room"
                               class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                        @error('room') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-10 flex flex-col gap-4 md:flex-row">
                    <a href="{{ route('courses.index') }}"
                       class="flex-1 rounded-2xl border border-slate-300 px-6 py-4 text-center font-extrabold text-slate-700 hover:bg-slate-100">
                        Cancel
                    </a>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="flex-1 rounded-2xl bg-[#4b3f8f] px-6 py-4 font-extrabold text-white shadow-lg transition hover:bg-[#3c3277] disabled:opacity-60">
                        <span wire:loading.remove>Update Course</span>
                        <span wire:loading>Updating...</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>