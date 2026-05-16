@php
    use App\Models\Student;
    use App\Models\Course;
    use App\Models\Enrollment;
    use App\Models\Payment;

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

    $totalCourses = Course::count();
    $totalEnrollments = Enrollment::count();
    $totalPayments = Payment::sum('amount');
    $pendingPayments = Payment::where('status', '!=', 'Paid')->count();

    $latestStudents = Student::latest()->take(3)->get();
    $upcomingCourses = Course::where('status', 'Active')->take(3)->get();
@endphp

<x-dashboard-layout>

<div>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white">Dashboard</h1>
        <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">
            Welcome back! Here's what's happening today.
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-4">

        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm transition-colors">
            <div class="flex items-center justify-between">
                <div class="rounded-xl bg-blue-100 dark:bg-blue-900/50 p-3 text-blue-600 dark:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                </div>
                <span class="text-sm font-bold text-green-500">Live</span>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-slate-900 dark:text-white">{{ $totalStudents }}</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Total Students</p>
        </div>

        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm transition-colors">
            <div class="flex items-center justify-between">
                <div class="rounded-xl bg-green-100 dark:bg-green-900/50 p-3 text-green-600 dark:text-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
                <span class="text-sm font-bold text-green-500">Active</span>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-slate-900 dark:text-white">{{ $activeStudents }}</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Active Students</p>
        </div>

        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm transition-colors">
            <div class="flex items-center justify-between">
                <div class="rounded-xl bg-purple-100 dark:bg-purple-900/50 p-3 text-purple-600 dark:text-purple-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" /></svg>
                </div>
                <span class="text-sm font-bold text-green-500">Departments</span>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-slate-900 dark:text-white">{{ $departmentsCount }}</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Departments</p>
        </div>

        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm transition-colors">
            <div class="flex items-center justify-between">
                <div class="rounded-xl bg-orange-100 dark:bg-orange-900/50 p-3 text-orange-600 dark:text-orange-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                </div>
                <span class="text-sm font-bold text-green-500">Live</span>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-slate-900 dark:text-white">{{ $totalCourses }}</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Total Courses</p>
        </div>

        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm transition-colors">
            <div class="flex items-center justify-between">
                <div class="rounded-xl bg-teal-100 dark:bg-teal-900/50 p-3 text-teal-600 dark:text-teal-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                </div>
                <span class="text-sm font-bold text-green-500">Active</span>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-slate-900 dark:text-white">{{ $totalEnrollments }}</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Total Enrollments</p>
        </div>

        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm transition-colors">
            <div class="flex items-center justify-between">
                <div class="rounded-xl bg-green-100 dark:bg-green-900/50 p-3 text-green-600 dark:text-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>
                </div>
                <span class="text-sm font-bold text-red-500">{{ $pendingPayments }} Pending</span>
            </div>
            <h2 class="mt-4 text-2xl font-extrabold text-slate-900 dark:text-white">LKR {{ number_format($totalPayments, 0) }}</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Revenue</p>
        </div>

    </div>

    <!-- Chart -->
    <div class="mb-8 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm transition-colors">
        <div class="mb-5 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-indigo-500"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" /></svg>
            <div>
                <h2 class="text-xl font-extrabold text-slate-900 dark:text-white">Students by Department</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">Real data from students table</p>
            </div>
        </div>

        <canvas id="studentsDepartmentChart" height="100"></canvas>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        <!-- Upcoming Classes -->
        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm lg:col-span-2 transition-colors">
            <h2 class="mb-5 text-lg font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-orange-500"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                Upcoming Classes
            </h2>

            <div class="space-y-4">
                @forelse($upcomingCourses as $course)
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4 last:border-0">
                    <div>
                        <p class="font-bold text-slate-900 dark:text-white">{{ $course->course_name }}</p>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $course->instructor ?? 'TBA' }}</p>
                    </div>
                    <div class="text-right text-sm text-slate-500 dark:text-slate-400">
                        <p class="font-bold text-blue-600 dark:text-blue-400">{{ $course->schedule ?? 'TBA' }}</p>
                        <p>Room: {{ $course->room ?? 'TBA' }}</p>
                    </div>
                </div>
                @empty
                <p class="text-sm text-slate-500 dark:text-slate-400">No active classes found.</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Students -->
        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm transition-colors">
            <h2 class="mb-5 text-lg font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-500"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                Recent Students
            </h2>

            <div class="space-y-4 text-sm">
                @forelse ($latestStudents as $student)
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/50 font-extrabold text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>

                        <div>
                            <p class="font-semibold text-slate-800 dark:text-slate-200">{{ $student->name }}</p>
                            <p class="text-slate-500 dark:text-slate-400">
                                {{ $student->program }} • {{ $student->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 dark:text-slate-400">No recent students found.</p>
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
