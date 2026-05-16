<div>
    <!-- Page Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white">Students</h1>
            <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Manage student information and records</p>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('students.create') }}"
            class="rounded-2xl bg-blue-600 px-7 py-4 text-base font-bold text-white shadow-lg transition hover:bg-blue-700">
                + Add Student
            </a>

            <a href="{{ route('students.export', [
                'keyword' => $keyword,
                'department' => $department,
                'status' => $status
            ]) }}"
            class="bg-green-600 text-white px-7 py-4 text-base font-bold rounded-2xl shadow-lg transition hover:bg-green-700">
                Export CSV
            </a>
        </div>
    </div>
        

    <!-- Filter Box -->
    <div class="mb-7 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-5 shadow-sm transition-colors">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">

            <!-- Search -->
            <div class="lg:col-span-2 flex items-center gap-3 rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>

                <input type="text"
                       wire:model.live.debounce.400ms="keyword"
                       placeholder="Search by name, ID, email, department..."
                       class="w-full border-0 bg-transparent text-base text-slate-900 dark:text-white placeholder-slate-400 outline-none ring-0 focus:ring-0">
            </div>

            <!-- Dynamic Department Filter -->
            <select wire:model.live="department"
                    class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4 text-base text-slate-900 dark:text-white outline-none focus:border-blue-500 focus:ring-blue-500">
                <option value="">All Departments</option>

                @foreach ($departments as $departmentName)
                    <option value="{{ $departmentName }}">
                        {{ $departmentName }}
                    </option>
                @endforeach
            </select>

            <!-- Status Filter -->
            <select wire:model.live="status"
                    class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4 text-base text-slate-900 dark:text-white outline-none focus:border-blue-500 focus:ring-blue-500">
                <option value="">All Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Graduated">Graduated</option>
                <option value="Suspended">Suspended</option>
            </select>
        </div>

        <!-- Filter Summary -->
        <div class="mt-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                Showing
                <span class="font-extrabold text-blue-600 dark:text-blue-400">{{ $students->total() }}</span>
                students
            </p>

            <button type="button"
                    wire:click="resetFilters"
                    class="w-fit rounded-xl border border-slate-300 dark:border-slate-700 px-5 py-2 text-sm font-bold text-slate-700 dark:text-slate-300 transition hover:bg-slate-100 dark:hover:bg-slate-800">
                Reset Filters
            </button>
        </div>
    </div>

    <!-- Loading State -->
    <div wire:loading.flex
         wire:target="keyword,department,status,resetFilters"
         class="mb-5 items-center gap-3 rounded-2xl border border-blue-200 bg-blue-50 px-5 py-4 text-blue-700">
        <svg class="h-5 w-5 animate-spin" viewBox="0 0 24 24" fill="none">
            <circle class="opacity-25" cx="12" cy="12" r="10"
                    stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>

        <span class="text-sm font-bold">
            Loading students...
        </span>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm transition-colors">
        <table class="w-full text-left">
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr class="border-b border-slate-200 dark:border-slate-800 text-sm font-extrabold text-slate-700 dark:text-slate-300">
                    <th class="px-7 py-5">Student ID</th>
                    <th class="px-7 py-5">Name</th>
                    <th class="px-7 py-5">Department</th>
                    <th class="px-7 py-5">Year</th>
                    <th class="px-7 py-5">Status</th>
                    <th class="px-7 py-5">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                @forelse ($students as $student)
                    <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">
                        <td class="px-7 py-5 text-sm font-medium text-slate-900 dark:text-white">
                            {{ $student->student_id }}
                        </td>

                        <td class="px-7 py-5">
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/50 font-extrabold text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>

                                <div>
                                    <p class="font-extrabold text-slate-900 dark:text-white">{{ $student->name }}</p>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $student->email }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-7 py-5 text-sm text-slate-700 dark:text-slate-300">
                            {{ $student->program }}
                        </td>

                        <td class="px-7 py-5 text-sm text-slate-700 dark:text-slate-300">
                            Year {{ $student->year }}
                        </td>

                        <td class="px-7 py-5">
                            @php
                                $currentStatus = $student->enrollment_status ?? 'Active';

                                $statusClass = match ($currentStatus) {
                                    'Active' => 'bg-green-100 text-green-600 dark:bg-green-900/50 dark:text-green-400 border border-green-200 dark:border-green-800',
                                    'Inactive' => 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300 border border-slate-200 dark:border-slate-700',
                                    'Graduated' => 'bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400 border border-blue-200 dark:border-blue-800',
                                    'Suspended' => 'bg-red-100 text-red-600 dark:bg-red-900/50 dark:text-red-400 border border-red-200 dark:border-red-800',
                                    default => 'bg-green-100 text-green-600 dark:bg-green-900/50 dark:text-green-400 border border-green-200 dark:border-green-800',
                                };
                            @endphp

                            <span class="rounded-full px-4 py-2 text-sm font-bold {{ $statusClass }}">
                                {{ $currentStatus }}
                            </span>
                        </td>

                        <td class="px-7 py-5">
                            <div class="flex items-center gap-4">
                                <a href="{{ route('students.show', $student->id) }}"
                                   class="font-bold text-blue-600 hover:text-blue-800">
                                    View
                                </a>

                                <a href="{{ route('students.edit', $student->id) }}"
                                   class="font-bold text-amber-500 hover:text-amber-600">
                                    Edit
                                </a>

                                <button type="button"
                                        wire:click="$set('confirmingDeleteId', {{ $student->id }})"
                                        class="font-bold text-red-500 hover:text-red-700">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-7 py-16 text-center">
                            <p class="text-lg font-bold text-slate-700 dark:text-slate-300">No students found</p>
                            <p class="mt-1 text-sm text-slate-400 dark:text-slate-500">Try changing your search or filter options.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $students->links() }}
    </div>

    @if ($confirmingDeleteId)
    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

        <div class="relative w-[90%] max-w-md rounded-3xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-8 text-center shadow-2xl">
            <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-red-600 dark:bg-red-900/50 dark:text-red-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>

            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">
                Delete Student?
            </h2>

            <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">
                Are you sure you want to delete this student? This action cannot be undone.
            </p>

            <div class="mt-8 flex gap-4">
                <button type="button"
                        wire:click="cancelDelete"
                        class="flex-1 rounded-2xl border border-slate-300 dark:border-slate-600 px-5 py-3 font-bold text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                    Cancel
                </button>

                <button type="button"
                        wire:click="deleteStudent({{ $confirmingDeleteId }})"
                        class="flex-1 rounded-2xl bg-red-600 px-5 py-3 font-bold text-white hover:bg-red-700 transition shadow-lg shadow-red-500/30">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>
@endif

</div>