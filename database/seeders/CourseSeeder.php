<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'course_code' => 'CS101',
                'course_name' => 'Introduction to Programming',
                'department' => 'Computer Science',
                'instructor' => 'Dr. Perera',
                'credits' => 3,
                'capacity' => 50,
                'enrolled' => 45,
                'schedule' => 'Mon 9:00-11:00',
                'room' => 'A101',
                'status' => 'Active',
            ],
            [
                'course_code' => 'CS102',
                'course_name' => 'Data Structures',
                'department' => 'Computer Science',
                'instructor' => 'Mr. Silva',
                'credits' => 4,
                'capacity' => 40,
                'enrolled' => 35,
                'schedule' => 'Tue 10:00-12:00',
                'room' => 'A102',
                'status' => 'Active',
            ],
            [
                'course_code' => 'BUS201',
                'course_name' => 'Business Management',
                'department' => 'Business',
                'instructor' => 'Mrs. Fernando',
                'credits' => 3,
                'capacity' => 60,
                'enrolled' => 50,
                'schedule' => 'Wed 1:00-3:00',
                'room' => 'B201',
                'status' => 'Active',
            ],
            [
                'course_code' => 'ENG301',
                'course_name' => 'Engineering Mechanics',
                'department' => 'Engineering',
                'instructor' => 'Dr. Jayasinghe',
                'credits' => 4,
                'capacity' => 45,
                'enrolled' => 40,
                'schedule' => 'Thu 9:00-11:00',
                'room' => 'C301',
                'status' => 'Active',
            ],
            [
                'course_code' => 'IT202',
                'course_name' => 'Database Systems',
                'department' => 'IT',
                'instructor' => 'Mr. Wickramasinghe',
                'credits' => 3,
                'capacity' => 50,
                'enrolled' => 48,
                'schedule' => 'Fri 2:00-4:00',
                'room' => 'A201',
                'status' => 'Active',
            ],
            [
                'course_code' => 'SE303',
                'course_name' => 'Software Engineering',
                'department' => 'Software Engineering',
                'instructor' => 'Ms. Senanayake',
                'credits' => 4,
                'capacity' => 55,
                'enrolled' => 50,
                'schedule' => 'Mon 11:00-1:00',
                'room' => 'A301',
                'status' => 'Active',
            ],
            [
                'course_code' => 'DES101',
                'course_name' => 'Graphic Design Basics',
                'department' => 'Design',
                'instructor' => 'Mr. Peris',
                'credits' => 2,
                'capacity' => 30,
                'enrolled' => 25,
                'schedule' => 'Tue 3:00-5:00',
                'room' => 'D101',
                'status' => 'Inactive',
            ],
            [
                'course_code' => 'MGT202',
                'course_name' => 'Human Resource Management',
                'department' => 'Management',
                'instructor' => 'Mrs. Karunarathna',
                'credits' => 3,
                'capacity' => 60,
                'enrolled' => 55,
                'schedule' => 'Wed 9:00-11:00',
                'room' => 'B202',
                'status' => 'Active',
            ],
            [
                'course_code' => 'CS401',
                'course_name' => 'Machine Learning',
                'department' => 'Computer Science',
                'instructor' => 'Dr. Abeysekara',
                'credits' => 5,
                'capacity' => 35,
                'enrolled' => 30,
                'schedule' => 'Thu 1:00-3:00',
                'room' => 'A401',
                'status' => 'Active',
            ],
            [
                'course_code' => 'IT305',
                'course_name' => 'Network Security',
                'department' => 'IT',
                'instructor' => 'Mr. Fernando',
                'credits' => 4,
                'capacity' => 40,
                'enrolled' => 38,
                'schedule' => 'Fri 9:00-11:00',
                'room' => 'A305',
                'status' => 'Active',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}