<div class="min-h-screen">
    <div class="mb-6 overflow-hidden rounded-[32px] bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 p-8 text-white shadow-2xl">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <a href="{{ route('students.index') }}" class="text-sm font-bold text-white/80 hover:text-white hover:underline transition">
                    &larr; Back to Students
                </a>
                <h1 class="mt-2 text-4xl font-extrabold">Edit Student</h1>
                <p class="mt-2 max-w-2xl text-sm text-white/80">
                    Update student academic, contact, and enrollment details.
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
        <!-- Live Preview Card -->
        <div class="rounded-[30px] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-xl lg:col-span-1 transition-colors">
            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/50 text-4xl font-extrabold text-orange-600 dark:text-orange-400">
                {{ $name ? strtoupper(substr($name, 0, 1)) : 'S' }}
            </div>

            <h2 class="mt-5 text-center text-xl font-extrabold text-slate-800 dark:text-white">
                {{ $name ?: 'Student Name' }}
            </h2>

            <p class="mt-1 text-center text-sm text-slate-400 dark:text-slate-500">
                {{ $student_id ?: 'Student ID Preview' }}
            </p>

            <div class="mt-8 space-y-4">
                <div class="rounded-2xl border border-slate-100 dark:border-slate-800 bg-[#f8f7fd] dark:bg-slate-800 p-4 transition-colors">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500">Program</p>
                    <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $program ?: 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl border border-slate-100 dark:border-slate-800 bg-[#f8f7fd] dark:bg-slate-800 p-4 transition-colors">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500">Year</p>
                    <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $year ?: 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl border border-green-100 dark:border-green-900/50 bg-green-50 dark:bg-green-900/20 p-4 transition-colors">
                    <p class="text-xs font-bold text-green-500 dark:text-green-400">Status</p>
                    <p class="mt-1 text-sm font-bold text-green-700 dark:text-green-300">{{ $enrollment_status ?: 'Not selected' }}</p>
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
                            <input type="text" wire:model.live="name"
                                   class="w-full rounded-2xl border @error('name') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('name') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" wire:model.live="email"
                                   class="w-full rounded-2xl border @error('email') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('email') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Phone Number</label>
                            <input type="text" wire:model.live="phone"
                                   class="w-full rounded-2xl border @error('phone') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('phone') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Address</label>
                            <textarea wire:model.live="address" rows="3"
                                      class="w-full rounded-2xl border @error('address') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10"></textarea>
                            @error('address') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Academic Information -->
                <div class="border-t border-slate-100 dark:border-slate-800 pt-8">
                    <h3 class="mb-5 text-lg font-extrabold text-slate-800 dark:text-white">Academic Information</h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Student ID <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="student_id"
                                   class="w-full rounded-2xl border @error('student_id') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('student_id') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Program <span class="text-red-500">*</span></label>
                            <select wire:model.live="program"
                                    class="w-full rounded-2xl border @error('program') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                                <option value="">Select Program</option>
                                <option value="Software Engineering">Software Engineering</option>
                                <option value="Information Technology">Information Technology</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Cyber Security">Cyber Security</option>
                                <option value="Data Science">Data Science</option>
                                <option value="Business Management">Business Management</option>
                                <option value="Accounting">Accounting</option>
                            </select>
                            @error('program') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Academic Year <span class="text-red-500">*</span></label>
                            <select wire:model.live="year"
                                    class="w-full rounded-2xl border @error('year') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                                <option value="">Select Year</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                            @error('year') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Enrollment Status <span class="text-red-500">*</span></label>
                            <select wire:model.live="enrollment_status"
                                    class="w-full rounded-2xl border @error('enrollment_status') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                                <option value="">Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Graduated">Graduated</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                            @error('enrollment_status') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-slate-100 dark:border-slate-800 pt-6 md:flex-row md:justify-end">
                    <a href="{{ route('students.index') }}"
                       class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-7 py-3 text-center text-sm font-bold text-slate-700 dark:text-slate-300 transition hover:bg-slate-50 dark:hover:bg-slate-700">
                        Cancel
                    </a>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="rounded-2xl bg-orange-600 px-7 py-3 font-bold text-white shadow-lg shadow-orange-500/30 transition hover:bg-orange-700 disabled:opacity-60">
                        <span wire:loading.remove>Update Student</span>
                        <span wire:loading>Updating...</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>