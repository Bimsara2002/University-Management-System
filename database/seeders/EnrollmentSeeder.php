<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();
        $courses  = Course::where('status', 'Active')->get();

        if ($students->isEmpty() || $courses->isEmpty()) return;

        $pairs = [
            [0, 0], [0, 1], [0, 3],
            [1, 1], [1, 3], [1, 4],
            [2, 2], [2, 5], [2, 6],
            [3, 0], [3, 3],
            [4, 7], [4, 8],
            [5, 1], [5, 4],
            [6, 2], [6, 5],
            [7, 0], [7, 3],
            [8, 7],
            [9, 4], [9, 3],
            [10, 0], [10, 1], [10, 2],
            [11, 5], [11, 6],
            [13, 7], [13, 8],
            [14, 4], [14, 1],
        ];

        $statuses = ['Enrolled', 'Enrolled', 'Enrolled', 'Completed', 'Dropped'];

        foreach ($pairs as [$si, $ci]) {
            $student = $students->get($si);
            $course  = $courses->get($ci);
            if (!$student || !$course) continue;

            Enrollment::firstOrCreate(
                ['student_id' => $student->id, 'course_id' => $course->id],
                [
                    'enrolled_at' => now()->subDays(rand(10, 180)),
                    'status'      => $statuses[array_rand($statuses)],
                ]
            );
        }
    }
}
