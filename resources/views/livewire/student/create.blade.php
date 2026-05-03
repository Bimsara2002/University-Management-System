<div class="min-h-screen bg-[#eee9f8] px-6 py-8">

    <div class="mb-8 rounded-[32px] bg-gradient-to-r from-[#4b3f8f] to-[#7c63f4] px-10 py-10 text-white shadow-xl">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="mb-3 text-sm font-extrabold uppercase tracking-[0.4em] text-white/70">
                    Student Registration
                </p>

                <h1 class="text-4xl font-extrabold md:text-5xl">
                    Add New Student
                </h1>

                <p class="mt-4 text-base text-white/80">
                    Create a complete student profile with academic, contact, and enrollment details.
                </p>
            </div>

            <a href="{{ route('students.index') }}"
               class="w-fit rounded-2xl bg-white/20 px-8 py-4 text-sm font-extrabold text-white transition hover:bg-white/30">
                ← Back to Students
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">

        <div class="rounded-[32px] bg-white p-8 shadow-xl lg:col-span-1">
            <div class="flex flex-col items-center text-center">
                <div class="flex h-28 w-28 items-center justify-center rounded-full bg-[#eee9f8] text-5xl font-extrabold text-[#4b3f8f]">
                    {{ $name ? strtoupper(substr($name, 0, 1)) : 'S' }}
                </div>

                <h2 class="mt-7 text-2xl font-extrabold text-slate-900">
                    {{ $name ?: 'Student Name' }}
                </h2>

                <p class="mt-2 text-sm text-slate-400">
                    {{ $student_id ?: 'Student ID Preview' }}
                </p>
            </div>

            <div class="mt-8 space-y-4">
                <div class="rounded-2xl bg-[#f8f7fd] p-5">
                    <p class="text-sm font-bold text-slate-400">Program</p>
                    <p class="mt-2 font-extrabold text-slate-800">
                        {{ $program ?: 'Not selected' }}
                    </p>
                </div>

                <div class="rounded-2xl bg-[#f8f7fd] p-5">
                    <p class="text-sm font-bold text-slate-400">Year</p>
                    <p class="mt-2 font-extrabold text-slate-800">
                        {{ $year ?: 'Not selected' }}
                    </p>
                </div>

                <div class="rounded-2xl bg-green-50 p-5">
                    <p class="text-sm font-bold text-green-500">Status</p>
                    <p class="mt-2 font-extrabold text-green-700">
                        {{ $enrollment_status ?: 'Not selected' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="rounded-[32px] bg-white p-10 shadow-xl lg:col-span-3">
            <form wire:submit.prevent="save">

                <h2 class="mb-7 text-2xl font-extrabold text-slate-900">
                    Personal Information
                </h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Student Name <span class="text-red-500">*</span></label>
                        <input type="text" wire:model.live="name" placeholder="Bimsara Kaushal"
                               class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                        @error('name') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" wire:model.live="email" placeholder="student@example.com"
                               class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                        @error('email') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Phone Number <span class="text-red-500">*</span></label>
                        <input type="text" wire:model.live="phone" placeholder="0771234567"
                               class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                        @error('phone') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Address <span class="text-red-500">*</span></label>
                        <textarea wire:model.live="address" rows="3" placeholder="Enter student address"
                                  class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]"></textarea>
                        @error('address') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="my-10 border-t border-slate-200"></div>

                <h2 class="mb-7 text-2xl font-extrabold text-slate-900">
                    Academic Information
                </h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Student ID <span class="text-red-500">*</span></label>
                        <input type="text" wire:model.live="student_id" placeholder="STU001"
                               class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                        @error('student_id') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Program <span class="text-red-500">*</span></label>
                        <select wire:model.live="program"
                                class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
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
                        <label class="mb-2 block font-extrabold text-slate-800">Academic Year <span class="text-red-500">*</span></label>
                        <select wire:model.live="year"
                                class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                            <option value="">Select Year</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>
                        @error('year') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-extrabold text-slate-800">Enrollment Status <span class="text-red-500">*</span></label>
                        <select wire:model.live="enrollment_status"
                                class="w-full rounded-2xl border border-slate-200 bg-[#f8f7fd] px-5 py-4 outline-none focus:border-[#4b3f8f]">
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Graduated">Graduated</option>
                            <option value="Suspended">Suspended</option>
                        </select>
                        @error('enrollment_status') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-10 flex flex-col gap-4 md:flex-row">
                    <a href="{{ route('students.index') }}"
                       class="flex-1 rounded-2xl border border-slate-300 px-6 py-4 text-center font-extrabold text-slate-700 hover:bg-slate-100">
                        Cancel
                    </a>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="flex-1 rounded-2xl bg-[#4b3f8f] px-6 py-4 font-extrabold text-white shadow-lg transition hover:bg-[#3c3277] disabled:opacity-60">
                        <span wire:loading.remove>Save Student</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>