<?php

namespace Database\Seeders;

use App\Models\Result;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    public function run(): void
    {
        $enrollments = Enrollment::with(['student', 'course'])->where('status', 'Completed')->get();
        if ($enrollments->isEmpty()) return;

        foreach ($enrollments as $enrollment) {
            $marks = rand(40, 98);
            $percentage = $marks; // since total is 100
            $grade = Result::calculateGrade($percentage);
            $gpa = Result::calculateGpa($grade);

            Result::firstOrCreate(
                [
                    'student_id' => $enrollment->student_id,
                    'course_id'  => $enrollment->course_id,
                    'semester'   => '2023/24 Sem 1',
                ],
                [
                    'marks_obtained' => $marks,
                    'total_marks'    => 100,
                    'grade'          => $grade,
                    'gpa'            => $gpa,
                    'remarks'        => $marks >= 50 ? 'Pass' : 'Fail',
                ]
            );
        }
    }
}
