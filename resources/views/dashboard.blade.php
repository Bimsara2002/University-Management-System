@php
    use App\Models\Student;

    $totalStudents = Student::count();

    $departmentData = Student::query()
        ->whereNotNull('program')
        ->where('program', '!=', '')
        ->selectRaw('program, COUNT(*) as total')
        ->groupBy('program')
        ->orderBy('program')
        ->pluck('total', 'program');

    $chartLabels = $departmentData->keys();
    $chartValues = $departmentData->values();

    $activeStudents = Student::where('enrollment_status', 'Active')->count();
    $departmentsCount = Student::whereNotNull('program')
        ->where('program', '!=', '')
        ->distinct('program')
        ->count('program');

    $latestStudents = Student::latest()->take(3)->get();
@endphp

<x-dashboard-layout>

<div>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900">Dashboard</h1>
        <p class="mt-2 text-lg text-slate-500">
            Welcome back! Here's what's happening today.
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-4">

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-xl bg-blue-100 p-3 text-xl text-blue-600">👥</div>
                <span class="text-sm font-bold text-green-500">Live</span>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-slate-900">{{ $totalStudents }}</h2>
            <p class="text-sm text-slate-500">Total Students</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-xl bg-green-100 p-3 text-xl text-green-600">✅</div>
                <span class="text-sm font-bold text-green-500">Active</span>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-slate-900">{{ $activeStudents }}</h2>
            <p class="text-sm text-slate-500">Active Students</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-xl bg-purple-100 p-3 text-xl text-purple-600">🏫</div>
                <span class="text-sm font-bold text-green-500">Departments</span>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-slate-900">{{ $departmentsCount }}</h2>
            <p class="text-sm text-slate-500">Departments</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="rounded-xl bg-orange-100 p-3 text-xl text-orange-600">📚</div>
                <span class="text-sm font-bold text-green-500">Courses</span>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-slate-900">{{ $totalCourses }}</h2>
            <p class="text-sm text-slate-500">Total Courses</p>
        </div>

    </div>

    <!-- Chart -->
    <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-5">
            <h2 class="text-xl font-extrabold text-slate-900">Students by Department</h2>
            <p class="text-sm text-slate-500">Real data from students table</p>
        </div>

        <canvas id="studentsDepartmentChart" height="100"></canvas>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        <!-- Upcoming Classes -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">
            <h2 class="mb-5 text-lg font-extrabold text-slate-900">📅 Upcoming Classes</h2>

            <div class="space-y-4">
                <div class="flex items-center justify-between border-b pb-4">
                    <div>
                        <p class="font-bold text-slate-900">Software Engineering</p>
                        <p class="text-sm text-slate-500">Mr. Fernando</p>
                    </div>
                    <div class="text-right text-sm text-slate-500">
                        <p class="font-bold text-blue-600">09:00 AM</p>
                        <p>Room: A-101</p>
                    </div>
                </div>

                <div class="flex items-center justify-between border-b pb-4">
                    <div>
                        <p class="font-bold text-slate-900">Database Management</p>
                        <p class="text-sm text-slate-500">Ms. Perera</p>
                    </div>
                    <div class="text-right text-sm text-slate-500">
                        <p class="font-bold text-blue-600">11:00 AM</p>
                        <p>Room: B-205</p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-bold text-slate-900">Web Application Development</p>
                        <p class="text-sm text-slate-500">Dr. Silva</p>
                    </div>
                    <div class="text-right text-sm text-slate-500">
                        <p class="font-bold text-blue-600">02:00 PM</p>
                        <p>Lab: IT-3</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Students -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-extrabold text-slate-900">Recent Students</h2>

            <div class="space-y-4 text-sm">
                @forelse ($latestStudents as $student)
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 font-extrabold text-blue-600">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>

                        <div>
                            <p class="font-semibold text-slate-800">{{ $student->name }}</p>
                            <p class="text-slate-500">
                                {{ $student->program }} • {{ $student->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500">No recent students found.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    new Chart(document.getElementById('studentsDepartmentChart'), {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Students',
                data: @json($chartValues),
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
</script>

</x-dashboard-layout>
