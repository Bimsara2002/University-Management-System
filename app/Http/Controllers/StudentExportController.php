<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentExportController extends Controller
{
    public function export(Request $request)
    {
        $query = Student::query();

        // 🔍 SAME filters as Livewire
        $search = trim($request->keyword);

        $query->when($search !== '', function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('student_id', 'like', "%{$search}%")
                    ->orWhere('program', 'like', "%{$search}%");
            });
        });

        $query->when($request->department !== null && $request->department !== '', function ($q) use ($request) {
            $q->where('program', $request->department);
        });

        $query->when($request->status !== null && $request->status !== '', function ($q) use ($request) {
            $q->where('enrollment_status', $request->status);
        });

        $students = $query->latest()->get();

        $csv = "Student ID,Name,Email,Phone,Department,Year,Status,Address\n";

        foreach ($students as $student) {
            $csv .= '"' . $student->student_id . '",';
            $csv .= '"' . $student->name . '",';
            $csv .= '"' . $student->email . '",';
            $csv .= '"' . $student->phone . '",';
            $csv .= '"' . $student->program . '",';
            $csv .= '"' . $student->year . '",';
            $csv .= '"' . $student->enrollment_status . '",';
            $csv .= '"' . $student->address . '"' . "\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="students.csv"');
    }
}