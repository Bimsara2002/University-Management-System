<div>
    <!-- Page Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">Students</h1>
            <p class="mt-2 text-lg text-slate-500">Manage student information and records</p>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('students.create') }}"
            class="rounded-2xl bg-blue-600 px-7 py-4 text-base font-bold text-white shadow-lg transition hover:bg-blue-700">
                + Add Student
            </a>

            <a href="{{ route('students.export') }}"
            class="rounded-2xl border border-slate-300 bg-white px-7 py-4 text-base font-bold text-slate-700 shadow-sm transition hover:bg-slate-100">
                ⬇ Export CSV
            </a>
        </div>
    </div>
        

    <!-- Filter Box -->
    <div class="mb-7 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">

            <!-- Search -->
            <div class="lg:col-span-2 flex items-center gap-3 rounded-2xl border border-slate-300 bg-white px-5 py-4">
                <span class="text-xl text-slate-400">⌕</span>

                <input type="text"
                       wire:model.live.debounce.400ms="keyword"
                       placeholder="Search by name, ID, email, department..."
                       class="w-full border-0 bg-transparent text-base outline-none ring-0 focus:ring-0">
            </div>

            <!-- Dynamic Department Filter -->
            <select wire:model.live="department"
                    class="rounded-2xl border border-slate-300 px-5 py-4 text-base outline-none focus:border-blue-500 focus:ring-blue-500">
                <option value="">All Departments</option>

                @foreach ($departments as $departmentName)
                    <option value="{{ $departmentName }}">
                        {{ $departmentName }}
                    </option>
                @endforeach
            </select>

            <!-- Status Filter -->
            <select wire:model.live="status"
                    class="rounded-2xl border border-slate-300 px-5 py-4 text-base outline-none focus:border-blue-500 focus:ring-blue-500">
                <option value="">All Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Graduated">Graduated</option>
                <option value="Suspended">Suspended</option>
            </select>
        </div>

        <!-- Filter Summary -->
        <div class="mt-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <p class="text-sm font-semibold text-slate-500">
                Showing
                <span class="font-extrabold text-blue-600">{{ $students->total() }}</span>
                students
            </p>

            <button type="button"
                    wire:click="resetFilters"
                    class="w-fit rounded-xl border border-slate-300 px-5 py-2 text-sm font-bold text-slate-700 transition hover:bg-slate-100">
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
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="w-full text-left">
            <thead class="bg-slate-50">
                <tr class="border-b border-slate-200 text-sm font-extrabold text-slate-700">
                    <th class="px-7 py-5">Student ID</th>
                    <th class="px-7 py-5">Name</th>
                    <th class="px-7 py-5">Department</th>
                    <th class="px-7 py-5">Year</th>
                    <th class="px-7 py-5">Status</th>
                    <th class="px-7 py-5">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200">
                @forelse ($students as $student)
                    <tr class="transition hover:bg-slate-50">
                        <td class="px-7 py-5 text-sm font-medium text-slate-900">
                            {{ $student->student_id }}
                        </td>

                        <td class="px-7 py-5">
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 font-extrabold text-blue-600">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>

                                <div>
                                    <p class="font-extrabold text-slate-900">{{ $student->name }}</p>
                                    <p class="text-sm text-slate-500">{{ $student->email }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-7 py-5 text-sm text-slate-700">
                            {{ $student->program }}
                        </td>

                        <td class="px-7 py-5 text-sm text-slate-700">
                            Year {{ $student->year }}
                        </td>

                        <td class="px-7 py-5">
                            @php
                                $currentStatus = $student->enrollment_status ?? 'Active';

                                $statusClass = match ($currentStatus) {
                                    'Active' => 'bg-green-100 text-green-600',
                                    'Inactive' => 'bg-slate-100 text-slate-600',
                                    'Graduated' => 'bg-blue-100 text-blue-600',
                                    'Suspended' => 'bg-red-100 text-red-600',
                                    default => 'bg-green-100 text-green-600',
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
                            <p class="text-lg font-bold text-slate-700">No students found</p>
                            <p class="mt-1 text-sm text-slate-400">Try changing your search or filter options.</p>
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

        <div class="relative w-[90%] max-w-md rounded-3xl bg-white p-8 text-center shadow-2xl">
            <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-3xl text-red-600">
                !
            </div>

            <h2 class="text-2xl font-extrabold text-slate-900">
                Delete Student?
            </h2>

            <p class="mt-3 text-sm text-slate-500">
                Are you sure you want to delete this student? This action cannot be undone.
            </p>

            <div class="mt-8 flex gap-4">
                <button type="button"
                        wire:click="cancelDelete"
                        class="flex-1 rounded-2xl border border-slate-300 px-5 py-3 font-bold text-slate-700 hover:bg-slate-100">
                    Cancel
                </button>

                <button type="button"
                        wire:click="deleteStudent({{ $confirmingDeleteId }})"
                        class="flex-1 rounded-2xl bg-red-600 px-5 py-3 font-bold text-white hover:bg-red-700">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>
@endif

</div>