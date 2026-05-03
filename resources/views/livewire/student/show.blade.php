<div class="mx-auto max-w-6xl px-4 py-8">

    <!-- Header -->
    <div class="mb-6 overflow-hidden rounded-[32px] bg-gradient-to-r from-[#4b3f8f] via-[#6b5bd6] to-[#8d7cf6] p-8 text-white shadow-2xl">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.25em] text-white/70">Student Profile</p>
                <h1 class="mt-3 text-4xl font-extrabold">{{ $student->name }}</h1>
                <p class="mt-2 text-sm text-white/75">
                    View complete student academic and personal details.
                </p>
            </div>

            <a href="{{ route('students.index') }}"
               class="rounded-2xl bg-white/20 px-6 py-3 text-sm font-bold text-white backdrop-blur transition hover:bg-white hover:text-[#4b3f8f]">
                ← Back to Students
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">

        <!-- LEFT PROFILE CARD -->
        <div class="rounded-[30px] bg-white p-6 shadow-xl lg:col-span-1">

            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-[#eee9f8] text-4xl font-extrabold text-[#4b3f8f]">
                {{ strtoupper(substr($student->name, 0, 1)) }}
            </div>

            <h2 class="mt-5 text-center text-xl font-extrabold text-slate-800">
                {{ $student->name }}
            </h2>

            <p class="mt-1 text-center text-sm text-slate-400">
                {{ $student->student_id }}
            </p>

            <div class="mt-6 space-y-3">

                <div class="rounded-2xl bg-[#f8f7fd] p-4">
                    <p class="text-xs font-bold text-slate-400">Program</p>
                    <p class="mt-1 text-sm font-bold text-slate-700">{{ $student->program }}</p>
                </div>

                <div class="rounded-2xl bg-[#f8f7fd] p-4">
                    <p class="text-xs font-bold text-slate-400">Year</p>
                    <p class="mt-1 text-sm font-bold text-slate-700">{{ $student->year }}</p>
                </div>

                <div class="rounded-2xl bg-green-50 p-4">
                    <p class="text-xs font-bold text-green-500">Status</p>
                    <p class="mt-1 text-sm font-bold text-green-700">{{ $student->enrollment_status }}</p>
                </div>

            </div>
        </div>

        <!-- RIGHT DETAILS -->
        <div class="rounded-[30px] bg-white p-8 shadow-xl lg:col-span-3">

            <!-- Personal Info -->
            <div>
                <h3 class="mb-5 text-lg font-extrabold text-slate-800">Personal Information</h3>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <div class="rounded-2xl bg-[#f8f7fd] p-4">
                        <p class="text-xs font-bold text-slate-400">Full Name</p>
                        <p class="mt-1 text-sm font-bold text-slate-800">{{ $student->name }}</p>
                    </div>

                    <div class="rounded-2xl bg-[#f8f7fd] p-4">
                        <p class="text-xs font-bold text-slate-400">Email</p>
                        <p class="mt-1 text-sm font-bold text-slate-800">{{ $student->email }}</p>
                    </div>

                    <div class="rounded-2xl bg-[#f8f7fd] p-4">
                        <p class="text-xs font-bold text-slate-400">Phone</p>
                        <p class="mt-1 text-sm font-bold text-slate-800">{{ $student->phone }}</p>
                    </div>

                    <div class="rounded-2xl bg-[#f8f7fd] p-4 md:col-span-2">
                        <p class="text-xs font-bold text-slate-400">Address</p>
                        <p class="mt-1 text-sm font-bold text-slate-800">{{ $student->address }}</p>
                    </div>

                </div>
            </div>

            <!-- Academic Info -->
            <div class="mt-10 border-t border-slate-100 pt-8">
                <h3 class="mb-5 text-lg font-extrabold text-slate-800">Academic Information</h3>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <div class="rounded-2xl bg-[#f8f7fd] p-4">
                        <p class="text-xs font-bold text-slate-400">Student ID</p>
                        <p class="mt-1 text-sm font-bold text-slate-800">{{ $student->student_id }}</p>
                    </div>

                    <div class="rounded-2xl bg-[#f8f7fd] p-4">
                        <p class="text-xs font-bold text-slate-400">Program</p>
                        <p class="mt-1 text-sm font-bold text-slate-800">{{ $student->program }}</p>
                    </div>

                    <div class="rounded-2xl bg-[#f8f7fd] p-4">
                        <p class="text-xs font-bold text-slate-400">Year</p>
                        <p class="mt-1 text-sm font-bold text-slate-800">{{ $student->year }}</p>
                    </div>

                    <div class="rounded-2xl bg-green-50 p-4">
                        <p class="text-xs font-bold text-green-500">Enrollment Status</p>
                        <p class="mt-1 text-sm font-bold text-green-700">{{ $student->enrollment_status }}</p>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>