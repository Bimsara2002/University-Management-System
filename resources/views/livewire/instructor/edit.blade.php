<div class="min-h-screen">
    <div class="mb-6 overflow-hidden rounded-[32px] bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 p-8 text-white shadow-2xl">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <a href="{{ route('instructors.index') }}" class="text-sm font-bold text-white/80 hover:text-white hover:underline transition">
                    &larr; Back to Instructors
                </a>
                <h1 class="mt-2 text-4xl font-extrabold">Edit Instructor</h1>
                <p class="mt-2 max-w-2xl text-sm text-white/80">
                    Update faculty member details.
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
        <!-- Live Preview Card -->
        <div class="rounded-[30px] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-xl lg:col-span-1 transition-colors">
            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/50 text-4xl font-extrabold text-orange-600 dark:text-orange-400">
                {{ $name ? strtoupper(substr($name, 0, 1)) : 'I' }}
            </div>

            <h2 class="mt-5 text-center text-xl font-extrabold text-slate-800 dark:text-white">
                {{ $name ?: 'Instructor Name' }}
            </h2>

            <p class="mt-1 text-center text-sm text-slate-400 dark:text-slate-500">
                {{ $designation ?: 'Designation Preview' }}
            </p>

            <div class="mt-8 space-y-4">
                <div class="rounded-2xl border border-slate-100 dark:border-slate-800 bg-[#f8f7fd] dark:bg-slate-800 p-4 transition-colors">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500">Department</p>
                    <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $department ?: 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl border border-slate-100 dark:border-slate-800 bg-[#f8f7fd] dark:bg-slate-800 p-4 transition-colors">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500">Email</p>
                    <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200 break-all">{{ $email ?: 'Not provided' }}</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="rounded-[30px] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-8 shadow-xl lg:col-span-3 transition-colors">
            <form wire:submit.prevent="update" class="space-y-8">

                <!-- Personal Information -->
                <div>
                    <h3 class="mb-5 text-lg font-extrabold text-slate-800 dark:text-white">Personal Information</h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="name" placeholder="Dr. John Smith"
                                   class="w-full rounded-2xl border @error('name') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('name') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" wire:model.live="email" placeholder="john.smith@university.edu"
                                   class="w-full rounded-2xl border @error('email') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('email') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Phone Number <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="phone" placeholder="+94 7X XXX XXXX"
                                   class="w-full rounded-2xl border @error('phone') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('phone') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Residential Address <span class="text-red-500">*</span></label>
                            <textarea wire:model.live="address" rows="3" placeholder="Full address"
                                      class="w-full rounded-2xl border @error('address') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10"></textarea>
                            @error('address') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Academic Details -->
                <div class="border-t border-slate-100 dark:border-slate-800 pt-8">
                    <h3 class="mb-5 text-lg font-extrabold text-slate-800 dark:text-white">Academic Details</h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Department <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="department" placeholder="e.g. Computer Science"
                                   class="w-full rounded-2xl border @error('department') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('department') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Designation <span class="text-red-500">*</span></label>
                            <select wire:model.live="designation"
                                    class="w-full rounded-2xl border @error('designation') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                                <option value="">Select Designation</option>
                                <option value="Professor">Professor</option>
                                <option value="Associate Professor">Associate Professor</option>
                                <option value="Senior Lecturer">Senior Lecturer</option>
                                <option value="Lecturer">Lecturer</option>
                                <option value="Assistant Lecturer">Assistant Lecturer</option>
                                <option value="Instructor">Instructor</option>
                            </select>
                            @error('designation') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-slate-100 dark:border-slate-800 pt-6 md:flex-row md:justify-end">
                    <a href="{{ route('instructors.index') }}"
                       class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-7 py-3 text-center text-sm font-bold text-slate-700 dark:text-slate-300 transition hover:bg-slate-50 dark:hover:bg-slate-700">
                        Cancel
                    </a>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="rounded-2xl bg-orange-600 px-7 py-3 font-bold text-white shadow-lg shadow-orange-500/30 transition hover:bg-orange-700 disabled:opacity-60">
                        <span wire:loading.remove>Update Instructor</span>
                        <span wire:loading>Updating...</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>