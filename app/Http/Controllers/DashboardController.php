<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
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

        $totalCourses = Course::count();

        return view('dashboard', compact(
            'totalStudents',
            'chartLabels',
            'chartValues',
            'activeStudents',
            'departmentsCount',
            'latestStudents',
            'totalCourses'
        ));
    }
}