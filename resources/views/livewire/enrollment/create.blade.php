<div class="min-h-screen">
    <div class="mb-6 overflow-hidden rounded-[32px] bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-8 text-white shadow-2xl">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <a href="{{ route('enrollments.index') }}" class="text-sm font-bold text-white/80 hover:text-white hover:underline transition">
                    &larr; Back to Enrollments
                </a>
                <h1 class="mt-2 text-4xl font-extrabold">New Enrollment</h1>
                <p class="mt-2 max-w-2xl text-sm text-white/80">
                    Enroll a student into a specific course.
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
        <!-- Live Preview Card -->
        <div class="rounded-[30px] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-xl lg:col-span-1 transition-colors">
            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/50 text-4xl font-extrabold text-blue-600 dark:text-blue-400">
                E
            </div>

            <h2 class="mt-5 text-center text-xl font-extrabold text-slate-800 dark:text-white">
                New Enrollment
            </h2>

            <div class="mt-8 space-y-4">
                <div class="rounded-2xl border border-slate-100 dark:border-slate-800 bg-[#f8f7fd] dark:bg-slate-800 p-4 transition-colors">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500">Student</p>
                    <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $student_id ? 'Selected' : 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl border border-slate-100 dark:border-slate-800 bg-[#f8f7fd] dark:bg-slate-800 p-4 transition-colors">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500">Course</p>
                    <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $course_id ? 'Selected' : 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl border border-slate-100 dark:border-slate-800 bg-[#f8f7fd] dark:bg-slate-800 p-4 transition-colors">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500">Date</p>
                    <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $enrolled_at ?: 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl border border-green-100 dark:border-green-900/50 bg-green-50 dark:bg-green-900/20 p-4 transition-colors">
                    <p class="text-xs font-bold text-green-500 dark:text-green-400">Status</p>
                    <p class="mt-1 text-sm font-bold text-green-700 dark:text-green-300">{{ $status ?: 'Not selected' }}</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="rounded-[30px] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-8 shadow-xl lg:col-span-3 transition-colors">
            <form wire:submit.prevent="save" class="space-y-8">

                <!-- Enrollment Information -->
                <div>
                    <h3 class="mb-5 text-lg font-extrabold text-slate-800 dark:text-white">Enrollment Details</h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Student <span class="text-red-500">*</span></label>
                            <select wire:model.live="student_id"
                                    class="w-full rounded-2xl border @error('student_id') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                                <option value="">Select Student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->student_id }} - {{ $student->name }}</option>
                                @endforeach
                            </select>
                            @error('student_id') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Course <span class="text-red-500">*</span></label>
                            <select wire:model.live="course_id"
                                    class="w-full rounded-2xl border @error('course_id') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                                <option value="">Select Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course_code }} - {{ $course->course_name }}</option>
                                @endforeach
                            </select>
                            @error('course_id') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Enrollment Date <span class="text-red-500">*</span></label>
                            <input type="date" wire:model.live="enrolled_at"
                                   class="w-full rounded-2xl border @error('enrolled_at') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                            @error('enrolled_at') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Status <span class="text-red-500">*</span></label>
                            <select wire:model.live="status"
                                    class="w-full rounded-2xl border @error('status') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                                <option value="Enrolled">Enrolled</option>
                                <option value="Completed">Completed</option>
                                <option value="Dropped">Dropped</option>
                            </select>
                            @error('status') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Additional Notes</label>
                            <textarea wire:model.live="notes" rows="3" placeholder="Any specific notes regarding this enrollment..."
                                      class="w-full rounded-2xl border @error('notes') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10"></textarea>
                            @error('notes') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-slate-100 dark:border-slate-800 pt-6 md:flex-row md:justify-end">
                    <a href="{{ route('enrollments.index') }}"
                       class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-7 py-3 text-center text-sm font-bold text-slate-700 dark:text-slate-300 transition hover:bg-slate-50 dark:hover:bg-slate-700">
                        Cancel
                    </a>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="rounded-2xl bg-blue-600 px-7 py-3 font-bold text-white shadow-lg shadow-blue-500/30 transition hover:bg-blue-700 disabled:opacity-60">
                        <span wire:loading.remove>Enroll Student</span>
                        <span wire:loading>Enrolling...</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
