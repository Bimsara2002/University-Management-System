<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $enrollments = Enrollment::with(['student', 'course'])->get();
        if ($enrollments->isEmpty()) return;

        $statuses = ['Present', 'Present', 'Present', 'Present', 'Absent', 'Late', 'Excused'];
        $dates = [];
        for ($i = 30; $i >= 1; $i--) {
            $day = now()->subDays($i);
            if (!in_array($day->dayOfWeek, [0, 6])) { // skip weekends
                $dates[] = $day->toDateString();
            }
        }

        foreach ($enrollments->take(20) as $enrollment) {
            foreach (array_slice($dates, 0, 10) as $date) {
                Attendance::firstOrCreate(
                    [
                        'student_id' => $enrollment->student_id,
                        'course_id'  => $enrollment->course_id,
                        'date'       => $date,
                    ],
                    [
                        'status'  => $statuses[array_rand($statuses)],
                        'remarks' => null,
                    ]
                );
            }
        }
    }
}
