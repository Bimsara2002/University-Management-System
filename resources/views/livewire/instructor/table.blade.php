<div>

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-extrabold text-slate-900">Instructors</h1>

        <a href="{{ route('instructors.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
            + Add Instructor
        </a>
    </div>

    <!-- Search -->
    <div class="mb-4">
        <input type="text"
               wire:model.live="search"
               placeholder="Search instructors..."
               class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Success Message -->
    @if(session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white shadow rounded-2xl overflow-hidden">
        <table class="w-full text-sm text-left">

            <thead class="bg-slate-100 text-slate-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Department</th>
                    <th class="px-6 py-3">Designation</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($instructors as $instructor)
                    <tr class="border-b hover:bg-slate-50">

                        <td class="px-6 py-4 font-semibold text-slate-800">
                            {{ $instructor->name }}
                        </td>

                        <td class="px-6 py-4">{{ $instructor->email }}</td>

                        <td class="px-6 py-4">{{ $instructor->department }}</td>

                        <td class="px-6 py-4">{{ $instructor->designation }}</td>

                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('instructors.edit', $instructor->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                Edit
                            </a>

                            <button
                                wire:click="delete({{ $instructor->id }})"
                                onclick="confirm('Delete this instructor?') || event.stopImmediatePropagation()"
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                Delete
                            </button>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-slate-400">
                            No instructors found
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $instructors->links() }}
    </div>

</div>