<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'name' => 'Kasun Perera',
                'email' => 'kasun1@gmail.com',
                'student_id' => 'STU001',
                'year' => '1st Year',
                'program' => 'IT',
                'phone' => '0771234567',
                'address' => 'Colombo',
                'enrollment_status' => 'Active',
            ],
            [
                'name' => 'Nimali Silva',
                'email' => 'nimali@gmail.com',
                'student_id' => 'STU002',
                'year' => '2nd Year',
                'program' => 'Business',
                'phone' => '0712345678',
                'address' => 'Gampaha',
                'enrollment_status' => 'Active',
            ],
            [
                'name' => 'Saman Kumara',
                'email' => 'saman@gmail.com',
                'student_id' => 'STU003',
                'year' => '3rd Year',
                'program' => 'Engineering',
                'phone' => '0723456789',
                'address' => 'Kandy',
                'enrollment_status' => 'Inactive',
            ],
            [
                'name' => 'Dilani Fernando',
                'email' => 'dilani@gmail.com',
                'student_id' => 'STU004',
                'year' => '1st Year',
                'program' => 'IT',
                'phone' => '0754567890',
                'address' => 'Negombo',
                'enrollment_status' => 'Active',
            ],
            [
                'name' => 'Ravindu Jayasinghe',
                'email' => 'ravindu@gmail.com',
                'student_id' => 'STU005',
                'year' => '4th Year',
                'program' => 'Software Engineering',
                'phone' => '0765678901',
                'address' => 'Kurunegala',
                'enrollment_status' => 'Active',
            ],
            [
                'name' => 'Sanduni Perera',
                'email' => 'sanduni@gmail.com',
                'student_id' => 'STU006',
                'year' => '2nd Year',
                'program' => 'Management',
                'phone' => '0776789012',
                'address' => 'Kalutara',
                'enrollment_status' => 'Inactive',
            ],
            [
                'name' => 'Tharindu Silva',
                'email' => 'tharindu@gmail.com',
                'student_id' => 'STU007',
                'year' => '3rd Year',
                'program' => 'IT',
                'phone' => '0787890123',
                'address' => 'Matara',
                'enrollment_status' => 'Active',
            ],
            [
                'name' => 'Anjali Fernando',
                'email' => 'anjali@gmail.com',
                'student_id' => 'STU008',
                'year' => '1st Year',
                'program' => 'Design',
                'phone' => '0798901234',
                'address' => 'Galle',
                'enrollment_status' => 'Active',
            ],
            [
                'name' => 'Nuwan Wickramasinghe',
                'email' => 'nuwan@gmail.com',
                'student_id' => 'STU009',
                'year' => '4th Year',
                'program' => 'Engineering',
                'phone' => '0709012345',
                'address' => 'Anuradhapura',
                'enrollment_status' => 'Inactive',
            ],
            [
                'name' => 'Piumi Senanayake',
                'email' => 'piumi@gmail.com',
                'student_id' => 'STU010',
                'year' => '2nd Year',
                'program' => 'IT',
                'phone' => '0710123456',
                'address' => 'Polonnaruwa',
                'enrollment_status' => 'Active',
            ],
            [
                'name' => 'Chamod Perera',
                'email' => 'chamod@gmail.com',
                'student_id' => 'STU011',
                'year' => '3rd Year',
                'program' => 'Business',
                'phone' => '0721234560',
                'address' => 'Ratnapura',
                'enrollment_status' => 'Active',
            ],
            [
                'name' => 'Ishara De Silva',
                'email' => 'ishara@gmail.com',
                'student_id' => 'STU012',
                'year' => '1st Year',
                'program' => 'Software Engineering',
                'phone' => '0732345671',
                'address' => 'Colombo',
                'enrollment_status' => 'Active',
            ],
            [
                'name' => 'Lakshan Madushanka',
                'email' => 'lakshan@gmail.com',
                'student_id' => 'STU013',
                'year' => '4th Year',
                'program' => 'IT',
                'phone' => '0743456782',
                'address' => 'Badulla',
                'enrollment_status' => 'Inactive',
            ],
            [
                'name' => 'Sewmini Karunarathna',
                'email' => 'sewmini@gmail.com',
                'student_id' => 'STU014',
                'year' => '2nd Year',
                'program' => 'Management',
                'phone' => '0754567893',
                'address' => 'Hambantota',
                'enrollment_status' => 'Active',
            ],
            [
                'name' => 'Dinuka Abeysekara',
                'email' => 'dinuka@gmail.com',
                'student_id' => 'STU015',
                'year' => '3rd Year',
                'program' => 'Engineering',
                'phone' => '0765678904',
                'address' => 'Jaffna',
                'enrollment_status' => 'Active',
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}