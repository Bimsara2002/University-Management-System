<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            ['course_code' => 'CS101', 'course_name' => 'Introduction to Programming',   'department' => 'Computer Science',       'instructor' => 'Dr. R. Silva',     'credits' => 3, 'capacity' => 50, 'enrolled' => 42, 'schedule' => 'Mon/Wed 09:00-10:30',   'room' => 'Lab-A1',  'status' => 'Active'],
            ['course_code' => 'CS201', 'course_name' => 'Data Structures & Algorithms',  'department' => 'Computer Science',       'instructor' => 'Dr. P. Fernando',  'credits' => 4, 'capacity' => 45, 'enrolled' => 38, 'schedule' => 'Tue/Thu 10:00-11:30',   'room' => 'A-202',   'status' => 'Active'],
            ['course_code' => 'CS301', 'course_name' => 'Software Engineering',          'department' => 'Computer Science',       'instructor' => 'Mr. A. Jayawardena','credits' => 3, 'capacity' => 40, 'enrolled' => 35, 'schedule' => 'Mon/Fri 11:00-12:30',   'room' => 'B-301',   'status' => 'Active'],
            ['course_code' => 'IT101', 'course_name' => 'Web Application Development',   'department' => 'Information Technology', 'instructor' => 'Ms. N. Perera',    'credits' => 3, 'capacity' => 40, 'enrolled' => 30, 'schedule' => 'Wed/Fri 14:00-15:30',   'room' => 'Lab-B2',  'status' => 'Active'],
            ['course_code' => 'IT201', 'course_name' => 'Database Management Systems',  'department' => 'Information Technology', 'instructor' => 'Dr. S. Wickrama',  'credits' => 4, 'capacity' => 45, 'enrolled' => 40, 'schedule' => 'Mon/Wed 13:00-14:30',   'room' => 'A-303',   'status' => 'Active'],
            ['course_code' => 'SE101', 'course_name' => 'Object-Oriented Programming',  'department' => 'Software Engineering',   'instructor' => 'Dr. K. Rathnayake','credits' => 4, 'capacity' => 35, 'enrolled' => 28, 'schedule' => 'Tue/Thu 08:00-09:30',   'room' => 'Lab-C1',  'status' => 'Active'],
            ['course_code' => 'SE201', 'course_name' => 'System Analysis & Design',     'department' => 'Software Engineering',   'instructor' => 'Mr. L. Gunawardena','credits' => 3, 'capacity' => 35, 'enrolled' => 22, 'schedule' => 'Mon/Wed 15:00-16:30',   'room' => 'B-204',   'status' => 'Active'],
            ['course_code' => 'DS101', 'course_name' => 'Statistics for Data Science',  'department' => 'Data Science',           'instructor' => 'Dr. T. Ekanayake', 'credits' => 3, 'capacity' => 30, 'enrolled' => 25, 'schedule' => 'Tue/Thu 11:00-12:30',   'room' => 'A-101',   'status' => 'Active'],
            ['course_code' => 'DS201', 'course_name' => 'Machine Learning Fundamentals','department' => 'Data Science',           'instructor' => 'Dr. R. Silva',     'credits' => 4, 'capacity' => 30, 'enrolled' => 18, 'schedule' => 'Fri 09:00-12:00',       'room' => 'Lab-D1',  'status' => 'Active'],
            ['course_code' => 'CS401', 'course_name' => 'Computer Networks',            'department' => 'Computer Science',       'instructor' => 'Mr. A. Jayawardena','credits' => 3, 'capacity' => 40, 'enrolled' => 0,  'schedule' => 'TBA',                  'room' => 'TBA',     'status' => 'Inactive'],
        ];

        foreach ($courses as $data) {
            Course::firstOrCreate(['course_code' => $data['course_code']], $data);
        }
    }
}