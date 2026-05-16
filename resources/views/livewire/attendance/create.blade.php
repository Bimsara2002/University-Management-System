<div class="min-h-screen">
    <div class="mb-6 overflow-hidden rounded-[32px] bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-8 text-white shadow-2xl">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <a href="{{ route('attendances.index') }}" class="text-sm font-bold text-white/80 hover:text-white hover:underline transition">
                    &larr; Back to Attendance
                </a>
                <h1 class="mt-2 text-4xl font-extrabold">Mark Attendance</h1>
                <p class="mt-2 max-w-2xl text-sm text-white/80">
                    Record attendance for an entire class at once.
                </p>
            </div>
        </div>
    </div>

    <div class="rounded-[30px] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xl transition-colors">
        <!-- Setup Section -->
        <div class="p-8 border-b border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 rounded-t-[30px] transition-colors">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Course <span class="text-red-500">*</span></label>
                    <select wire:model.live="course_id"
                            class="w-full rounded-2xl border @error('course_id') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        <option value="">Select Course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_code }} - {{ $course->course_name }}</option>
                        @endforeach
                    </select>
                    @error('course_id') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Date <span class="text-red-500">*</span></label>
                    <input type="date" wire:model.live="date"
                           class="w-full rounded-2xl border @error('date') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 [color-scheme:light_dark]">
                    @error('date') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Student List Section -->
        @if ($course_id)
            <form wire:submit.prevent="save">
                <div class="overflow-x-auto p-0">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 transition-colors">
                            <tr class="border-b border-slate-200 dark:border-slate-800 font-extrabold">
                                <th class="px-8 py-5">Student</th>
                                <th class="px-8 py-5 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-800 dark:text-slate-200 transition-colors">
                            @forelse ($enrollments as $enrollment)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="px-8 py-5">
                                        <p class="font-bold text-slate-900 dark:text-white">{{ $enrollment->student->name }}</p>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $enrollment->student->student_id }}</p>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex justify-center gap-4">
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input type="radio" wire:model="attendance_data.{{ $enrollment->student->id }}" value="Present" class="text-green-600 focus:ring-green-500 dark:focus:ring-green-500/50 dark:bg-slate-800 dark:border-slate-600 w-5 h-5 transition">
                                                <span class="font-bold text-slate-700 dark:text-slate-300 group-hover:text-green-600 dark:group-hover:text-green-400 transition">Present</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input type="radio" wire:model="attendance_data.{{ $enrollment->student->id }}" value="Late" class="text-amber-500 focus:ring-amber-500 dark:focus:ring-amber-500/50 dark:bg-slate-800 dark:border-slate-600 w-5 h-5 transition">
                                                <span class="font-bold text-slate-700 dark:text-slate-300 group-hover:text-amber-500 dark:group-hover:text-amber-400 transition">Late</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input type="radio" wire:model="attendance_data.{{ $enrollment->student->id }}" value="Absent" class="text-red-600 focus:ring-red-500 dark:focus:ring-red-500/50 dark:bg-slate-800 dark:border-slate-600 w-5 h-5 transition">
                                                <span class="font-bold text-slate-700 dark:text-slate-300 group-hover:text-red-600 dark:group-hover:text-red-400 transition">Absent</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input type="radio" wire:model="attendance_data.{{ $enrollment->student->id }}" value="Excused" class="text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-500/50 dark:bg-slate-800 dark:border-slate-600 w-5 h-5 transition">
                                                <span class="font-bold text-slate-700 dark:text-slate-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">Excused</span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-8 py-16 text-center text-slate-500 dark:text-slate-400">
                                        No students are currently enrolled in this course.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (count($enrollments) > 0)
                    <div class="flex items-center justify-end gap-4 border-t border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 p-8 rounded-b-[30px] transition-colors">
                        <button type="submit"
                                wire:loading.attr="disabled"
                                class="rounded-2xl bg-blue-600 px-8 py-4 text-base font-bold text-white transition hover:bg-blue-700 shadow-lg shadow-blue-500/30 disabled:opacity-60">
                            <span wire:loading.remove>Save Attendance</span>
                            <span wire:loading>Saving...</span>
                        </button>
                    </div>
                @endif
            </form>
        @else
            <div class="p-16 text-center text-slate-500 dark:text-slate-400 font-bold transition-colors">
                Please select a course to view students and mark attendance.
            </div>
        @endif
    </div>
</div>
