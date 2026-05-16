<div>
    <!-- Page Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white">Attendance</h1>
            <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">View and track student attendance records</p>
        </div>

        <a href="{{ route('attendances.create') }}"
           class="rounded-2xl bg-blue-600 px-7 py-4 text-base font-bold text-white shadow-lg transition hover:bg-blue-700">
            + Mark Attendance
        </a>
    </div>

    <!-- Filters -->
    <div class="mb-7 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-5 shadow-sm transition-colors">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
            <select wire:model.live="course_id"
                    class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4 text-base text-slate-900 dark:text-white outline-none focus:border-blue-500 focus:ring-blue-500">
                <option value="">Select Course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_code }} - {{ $course->course_name }}</option>
                @endforeach
            </select>

            <input type="date"
                   wire:model.live="date"
                   class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4 text-base text-slate-900 dark:text-white outline-none focus:border-blue-500 focus:ring-blue-500 [color-scheme:light_dark]">
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm transition-colors">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300">
                <tr class="border-b border-slate-200 dark:border-slate-800 font-extrabold">
                    <th class="px-7 py-5">Date</th>
                    <th class="px-7 py-5">Course</th>
                    <th class="px-7 py-5">Student</th>
                    <th class="px-7 py-5">Status</th>
                    <th class="px-7 py-5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-800 dark:text-slate-200">
                @forelse ($attendances as $record)
                    <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">
                        <td class="px-7 py-5 font-bold text-slate-900 dark:text-white">
                            {{ $record->date->format('M d, Y') }}
                        </td>
                        <td class="px-7 py-5">
                            <p class="font-bold text-slate-900 dark:text-white">{{ $record->course->course_code }}</p>
                            <p class="text-slate-500 dark:text-slate-400">{{ $record->course->course_name }}</p>
                        </td>
                        <td class="px-7 py-5">
                            <p class="font-bold text-slate-900 dark:text-white">{{ $record->student->name }}</p>
                            <p class="text-slate-500 dark:text-slate-400">{{ $record->student->student_id }}</p>
                        </td>
                        <td class="px-7 py-5">
                            @php
                                $statusClass = match ($record->status) {
                                    'Present' => 'bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-400 border border-green-200 dark:border-green-800',
                                    'Late' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/50 dark:text-amber-400 border border-amber-200 dark:border-amber-800',
                                    'Excused' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-400 border border-blue-200 dark:border-blue-800',
                                    'Absent' => 'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-400 border border-red-200 dark:border-red-800',
                                    default => 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 border border-slate-200 dark:border-slate-700',
                                };
                            @endphp
                            <span class="rounded-full px-4 py-2 text-xs font-bold {{ $statusClass }}">
                                {{ $record->status }}
                            </span>
                        </td>
                        <td class="px-7 py-5 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('attendances.edit', $record->id) }}" class="text-slate-400 transition hover:text-blue-600 dark:hover:text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                </a>
                                <button type="button" wire:click="delete({{ $record->id }})" wire:confirm="Are you sure you want to delete this record?" class="text-slate-400 transition hover:text-red-600 dark:hover:text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" /><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-7 py-16 text-center">
                            <p class="text-lg font-bold text-slate-700 dark:text-slate-300">No attendance records found</p>
                            <p class="mt-1 text-sm text-slate-400 dark:text-slate-500">Select a course and date to view records.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $attendances->links() }}
    </div>
</div>
