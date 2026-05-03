<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentExportController extends Controller
{
    public function export()
    {
        $students = Student::latest()->get();

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