<div class="mx-auto max-w-6xl px-4 py-8">

    <div class="mb-6 overflow-hidden rounded-[32px] bg-gradient-to-r from-yellow-500 via-amber-500 to-orange-500 p-8 text-white shadow-2xl">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.25em] text-white/80">Student Update</p>
                <h1 class="mt-3 text-4xl font-extrabold">Edit Student</h1>
                <p class="mt-2 max-w-2xl text-sm text-white/80">
                    Update student academic, contact, and enrollment details.
                </p>
            </div>

            <a href="{{ route('students.index') }}"
               class="rounded-2xl bg-white/20 px-6 py-3 text-sm font-bold text-white backdrop-blur transition hover:bg-white hover:text-orange-600">
                ← Back to Students
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">

        <div class="rounded-[30px] bg-white p-6 shadow-xl lg:col-span-1">
            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-yellow-100 text-4xl font-extrabold text-yellow-600">
                {{ $name ? strtoupper(substr($name, 0, 1)) : 'S' }}
            </div>

            <h2 class="mt-5 text-center text-xl font-extrabold text-slate-800">
                {{ $name ?: 'Student Name' }}
            </h2>

            <p class="mt-1 text-center text-sm text-slate-400">
                {{ $student_id ?: 'Student ID' }}
            </p>

            <div class="mt-6 space-y-3">
                <div class="rounded-2xl bg-[#f8f7fd] p-4">
                    <p class="text-xs font-bold text-slate-400">Program</p>
                    <p class="mt-1 text-sm font-bold text-slate-700">{{ $program ?: 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl bg-[#f8f7fd] p-4">
                    <p class="text-xs font-bold text-slate-400">Year</p>
                    <p class="mt-1 text-sm font-bold text-slate-700">{{ $year ?: 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl bg-green-50 p-4">
                    <p class="text-xs font-bold text-green-500">Status</p>
                    <p class="mt-1 text-sm font-bold text-green-700">{{ $enrollment_status ?: 'Not selected' }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-[30px] bg-white p-8 shadow-xl lg:col-span-3">
            <form wire:submit.prevent="update" class="space-y-8">

                <div>
                    <h3 class="mb-5 text-lg font-extrabold text-slate-800">Personal Information</h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Student Name <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="name"
                                   class="w-full rounded-2xl border @error('name') border-red-500 bg-red-50 @else border-slate-200 bg-[#f8f7fd] @enderror px-4 py-3 text-slate-800 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('name') <p class="mt-2 text-sm font-semibold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" wire:model.live="email"
                                   class="w-full rounded-2xl border @error('email') border-red-500 bg-red-50 @else border-slate-200 bg-[#f8f7fd] @enderror px-4 py-3 text-slate-800 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('email') <p class="mt-2 text-sm font-semibold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Phone Number <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="phone"
                                   class="w-full rounded-2xl border @error('phone') border-red-500 bg-red-50 @else border-slate-200 bg-[#f8f7fd] @enderror px-4 py-3 text-slate-800 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('phone') <p class="mt-2 text-sm font-semibold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Address <span class="text-red-500">*</span></label>
                            <textarea wire:model.live="address" rows="3"
                                      class="w-full rounded-2xl border @error('address') border-red-500 bg-red-50 @else border-slate-200 bg-[#f8f7fd] @enderror px-4 py-3 text-slate-800 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10"></textarea>
                            @error('address') <p class="mt-2 text-sm font-semibold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-8">
                    <h3 class="mb-5 text-lg font-extrabold text-slate-800">Academic Information</h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Student ID <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="student_id"
                                   class="w-full rounded-2xl border @error('student_id') border-red-500 bg-red-50 @else border-slate-200 bg-[#f8f7fd] @enderror px-4 py-3 text-slate-800 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('student_id') <p class="mt-2 text-sm font-semibold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Program <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="program"
                                   class="w-full rounded-2xl border @error('program') border-red-500 bg-red-50 @else border-slate-200 bg-[#f8f7fd] @enderror px-4 py-3 text-slate-800 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('program') <p class="mt-2 text-sm font-semibold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Academic Year <span class="text-red-500">*</span></label>
                            <select wire:model.live="year"
                                    class="w-full rounded-2xl border @error('year') border-red-500 bg-red-50 @else border-slate-200 bg-[#f8f7fd] @enderror px-4 py-3 text-slate-800 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                                <option value="">Select Year</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                            @error('year') <p class="mt-2 text-sm font-semibold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Enrollment Status <span class="text-red-500">*</span></label>
                            <select wire:model.live="enrollment_status"
                                    class="w-full rounded-2xl border @error('enrollment_status') border-red-500 bg-red-50 @else border-slate-200 bg-[#f8f7fd] @enderror px-4 py-3 text-slate-800 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                                <option value="">Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Graduated">Graduated</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                            @error('enrollment_status') <p class="mt-2 text-sm font-semibold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-slate-100 pt-6 md:flex-row md:justify-end">
                    <a href="{{ route('students.index') }}"
                       class="rounded-2xl bg-slate-100 px-7 py-3 text-center text-sm font-bold text-slate-700 transition hover:bg-slate-200">
                        Cancel
                    </a>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="rounded-2xl bg-gradient-to-r from-yellow-500 to-orange-500 px-7 py-3 text-sm font-bold text-white shadow-lg shadow-orange-500/30 transition hover:-translate-y-0.5 disabled:opacity-60">
                        <span wire:loading.remove>Update Student</span>
                        <span wire:loading>Updating...</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>