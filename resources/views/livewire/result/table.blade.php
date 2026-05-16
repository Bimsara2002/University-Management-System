<div>
    <!-- Page Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white">Grades & Results</h1>
            <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Manage student academic results</p>
        </div>

        <a href="{{ route('results.create') }}"
           class="rounded-2xl bg-blue-600 px-7 py-4 text-base font-bold text-white shadow-lg transition hover:bg-blue-700">
            + Add Result
        </a>
    </div>

    <!-- Filters -->
    <div class="mb-7 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-5 shadow-sm transition-colors">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            <div class="lg:col-span-2 flex items-center gap-3 rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                <input type="text"
                       wire:model.live.debounce.300ms="search"
                       placeholder="Search by student, ID or course..."
                       class="w-full border-0 bg-transparent text-base text-slate-900 dark:text-white placeholder-slate-400 outline-none ring-0 focus:ring-0">
            </div>

            <select wire:model.live="semester"
                    class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4 text-base text-slate-900 dark:text-white outline-none focus:border-blue-500 focus:ring-blue-500">
                <option value="">All Semesters</option>
                @foreach($semesters as $sem)
                    <option value="{{ $sem }}">{{ $sem }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm transition-colors">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300">
                <tr class="border-b border-slate-200 dark:border-slate-800 font-extrabold">
                    <th class="px-7 py-5">Student</th>
                    <th class="px-7 py-5">Course</th>
                    <th class="px-7 py-5">Semester</th>
                    <th class="px-7 py-5">Score</th>
                    <th class="px-7 py-5">Grade</th>
                    <th class="px-7 py-5">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-800 dark:text-slate-200">
                @forelse ($results as $result)
                    <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">
                        <td class="px-7 py-5">
                            <p class="font-bold text-slate-900 dark:text-white">{{ $result->student->name }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $result->student->student_id }}</p>
                        </td>
                        <td class="px-7 py-5">
                            <p class="font-bold text-slate-900 dark:text-white">{{ $result->course->course_code }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $result->course->course_name }}</p>
                        </td>
                        <td class="px-7 py-5 text-slate-700 dark:text-slate-300">
                            {{ $result->semester }}
                        </td>
                        <td class="px-7 py-5 font-bold text-slate-900 dark:text-white">
                            {{ $result->marks_obtained }} / {{ $result->total_marks }}
                        </td>
                        <td class="px-7 py-5">
                            @php
                                $gradeClass = match (true) {
                                    in_array($result->grade, ['A+', 'A', 'A-']) => 'bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-400 border border-green-200 dark:border-green-800',
                                    in_array($result->grade, ['B+', 'B', 'B-']) => 'bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-400 border border-blue-200 dark:border-blue-800',
                                    in_array($result->grade, ['C+', 'C', 'C-']) => 'bg-amber-100 text-amber-700 dark:bg-amber-900/50 dark:text-amber-400 border border-amber-200 dark:border-amber-800',
                                    default => 'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-400 border border-red-200 dark:border-red-800',
                                };
                            @endphp
                            <div class="flex items-center gap-2">
                                <span class="rounded-full px-4 py-2 text-xs font-bold {{ $gradeClass }}">
                                    {{ $result->grade }}
                                </span>
                                <span class="text-xs font-bold text-slate-500 dark:text-slate-400">GPA: {{ $result->gpa }}</span>
                            </div>
                        </td>
                        <td class="px-7 py-5">
                            <div class="flex gap-4">
                                <a href="{{ route('results.edit', $result->id) }}"
                                   class="font-bold text-amber-500 hover:text-amber-600">
                                    Edit
                                </a>
                                <button type="button"
                                        wire:click="delete({{ $result->id }})"
                                        onclick="confirm('Are you sure you want to delete this result?') || event.stopImmediatePropagation()"
                                        class="font-bold text-red-500 hover:text-red-700">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-7 py-16 text-center">
                            <p class="text-lg font-bold text-slate-700 dark:text-slate-300">No results found</p>
                            <p class="mt-1 text-sm text-slate-400 dark:text-slate-500">Try changing your search or filters.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $results->links() }}
    </div>
</div>
