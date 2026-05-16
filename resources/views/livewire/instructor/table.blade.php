<div>
    <!-- Page Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white">Instructors</h1>
            <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Manage university faculty and instructors</p>
        </div>

        <a href="{{ route('instructors.create') }}"
           class="rounded-2xl bg-blue-600 px-7 py-4 text-base font-bold text-white shadow-lg transition hover:bg-blue-700">
            + Add Instructor
        </a>
    </div>

    <!-- Filter Box -->
    <div class="mb-7 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-5 shadow-sm transition-colors">
        <div class="flex items-center gap-3 rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4 w-full md:w-1/2 lg:w-1/3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Search instructors by name, email or department..."
                   class="w-full border-0 bg-transparent text-base text-slate-900 dark:text-white placeholder-slate-400 outline-none ring-0 focus:ring-0">
        </div>
    </div>

    <!-- Loading State -->
    <div wire:loading.flex
         wire:target="search"
         class="mb-5 items-center gap-3 rounded-2xl border border-blue-200 bg-blue-50 px-5 py-4 text-blue-700">
        <svg class="h-5 w-5 animate-spin" viewBox="0 0 24 24" fill="none">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
        <span class="text-sm font-bold">Loading instructors...</span>
    </div>

    <!-- Instructor Cards -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($instructors as $instructor)
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:hover:shadow-slate-800/50">
                <!-- Top -->
                <div class="mb-6 flex items-start justify-between">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-100 dark:bg-indigo-900/50 text-2xl font-bold text-indigo-600 dark:text-indigo-400 border border-indigo-200 dark:border-indigo-800">
                        {{ strtoupper(substr($instructor->name, 0, 1)) }}
                    </div>
                    <span class="rounded-full bg-slate-100 dark:bg-slate-800 px-4 py-2 text-sm font-bold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                        {{ $instructor->designation }}
                    </span>
                </div>

                <!-- Title -->
                <h2 class="text-xl font-extrabold text-slate-900 dark:text-white truncate">
                    {{ $instructor->name }}
                </h2>
                <p class="mt-2 text-base text-slate-600 dark:text-slate-400 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg>
                    {{ $instructor->department }}
                </p>

                <!-- Details -->
                <div class="mt-6 space-y-3 text-sm text-slate-700 dark:text-slate-300">
                    <p class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                        <a href="mailto:{{ $instructor->email }}" class="hover:text-blue-600 dark:hover:text-blue-400">{{ $instructor->email }}</a>
                    </p>
                    <p class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-400"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.18-7.076-7.076l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                        {{ $instructor->phone }}
                    </p>
                </div>

                <!-- Actions -->
                <div class="mt-7 flex items-center justify-between border-t border-slate-100 dark:border-slate-800 pt-5">
                    <a href="{{ route('instructors.edit', $instructor->id) }}"
                       class="font-bold text-amber-500 hover:text-amber-600 transition">
                        Edit Profile
                    </a>

                    <button type="button"
                            wire:click="delete({{ $instructor->id }})"
                            onclick="confirm('Are you sure you want to remove this instructor?') || event.stopImmediatePropagation()"
                            class="font-bold text-red-500 hover:text-red-700 transition">
                        Remove
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-12 text-center shadow-sm">
                <p class="text-lg font-bold text-slate-700 dark:text-slate-300">No instructors found</p>
                <p class="mt-1 text-sm text-slate-400 dark:text-slate-500">Try changing your search terms.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $instructors->links() }}
    </div>

</div>