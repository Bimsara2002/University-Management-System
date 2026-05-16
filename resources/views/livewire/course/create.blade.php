<div class="min-h-screen">
    <div class="mb-6 overflow-hidden rounded-[32px] bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-8 text-white shadow-2xl">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <a href="{{ route('courses.index') }}" class="text-sm font-bold text-white/80 hover:text-white hover:underline transition">
                    &larr; Back to Courses
                </a>
                <h1 class="mt-2 text-4xl font-extrabold">Add New Course</h1>
                <p class="mt-2 max-w-2xl text-sm text-white/80">
                    Create a complete course profile with academic, schedule, capacity, and enrollment details.
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
        <!-- Live Preview Card -->
        <div class="rounded-[30px] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-xl lg:col-span-1 transition-colors">
            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/50 text-4xl font-extrabold text-blue-600 dark:text-blue-400">
                {{ $course_name ? strtoupper(substr($course_name, 0, 1)) : 'C' }}
            </div>

            <h2 class="mt-5 text-center text-xl font-extrabold text-slate-800 dark:text-white">
                {{ $course_name ?: 'Course Name' }}
            </h2>

            <p class="mt-1 text-center text-sm text-slate-400 dark:text-slate-500">
                {{ $course_code ?: 'Course Code Preview' }}
            </p>

            <div class="mt-8 space-y-4">
                <div class="rounded-2xl border border-slate-100 dark:border-slate-800 bg-[#f8f7fd] dark:bg-slate-800 p-4 transition-colors">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500">Department</p>
                    <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $department ?: 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl border border-slate-100 dark:border-slate-800 bg-[#f8f7fd] dark:bg-slate-800 p-4 transition-colors">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500">Credits</p>
                    <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $credits ?: 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl border border-green-100 dark:border-green-900/50 bg-green-50 dark:bg-green-900/20 p-4 transition-colors">
                    <p class="text-xs font-bold text-green-500 dark:text-green-400">Status</p>
                    <p class="mt-1 text-sm font-bold text-green-700 dark:text-green-300">{{ $status ?: 'Not selected' }}</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="rounded-[30px] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-8 shadow-xl lg:col-span-3 transition-colors">
            <form wire:submit.prevent="store" class="space-y-8">

                <!-- Course Information -->
                <div>
                    <h3 class="mb-5 text-lg font-extrabold text-slate-800 dark:text-white">Course Information</h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Course Code <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="course_code" placeholder="SE101"
                                   class="w-full rounded-2xl border @error('course_code') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            @error('course_code') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Course Name <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="course_name" placeholder="Software Engineering"
                                   class="w-full rounded-2xl border @error('course_name') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            @error('course_name') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Department <span class="text-red-500">*</span></label>
                            <select wire:model.live="department"
                                    class="w-full rounded-2xl border @error('department') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
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
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Instructor <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="instructor" placeholder="Dr. Perera"
                                   class="w-full rounded-2xl border @error('instructor') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            @error('instructor') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Academic Details -->
                <div class="border-t border-slate-100 dark:border-slate-800 pt-8">
                    <h3 class="mb-5 text-lg font-extrabold text-slate-800 dark:text-white">Academic Details</h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Credits <span class="text-red-500">*</span></label>
                            <input type="number" wire:model.live="credits" placeholder="3"
                                   class="w-full rounded-2xl border @error('credits') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            @error('credits') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Capacity <span class="text-red-500">*</span></label>
                            <input type="number" wire:model.live="capacity" placeholder="50"
                                   class="w-full rounded-2xl border @error('capacity') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            @error('capacity') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Enrolled Students <span class="text-red-500">*</span></label>
                            <input type="number" wire:model.live="enrolled" placeholder="0"
                                   class="w-full rounded-2xl border @error('enrolled') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            @error('enrolled') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Status <span class="text-red-500">*</span></label>
                            <select wire:model.live="status"
                                    class="w-full rounded-2xl border @error('status') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                                <option value="">Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            @error('status') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Schedule Details -->
                <div class="border-t border-slate-100 dark:border-slate-800 pt-8">
                    <h3 class="mb-5 text-lg font-extrabold text-slate-800 dark:text-white">Schedule Details</h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Schedule <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="schedule" placeholder="Mon/Wed 9:00 AM - 10:30 AM"
                                   class="w-full rounded-2xl border @error('schedule') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            @error('schedule') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Room <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="room" placeholder="Room A-101"
                                   class="w-full rounded-2xl border @error('room') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            @error('room') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-slate-100 dark:border-slate-800 pt-6 md:flex-row md:justify-end">
                    <a href="{{ route('courses.index') }}"
                       class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-7 py-3 text-center text-sm font-bold text-slate-700 dark:text-slate-300 transition hover:bg-slate-50 dark:hover:bg-slate-700">
                        Cancel
                    </a>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="rounded-2xl bg-blue-600 px-7 py-3 font-bold text-white shadow-lg shadow-blue-500/30 transition hover:bg-blue-700 disabled:opacity-60">
                        <span wire:loading.remove>Save Course</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>