<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['name' => 'Ashan Perera',    'email' => 'ashan.perera@student.ac.lk',    'student_id' => 'STU2024001', 'year' => '1', 'program' => 'Computer Science',       'phone' => '0711234567', 'address' => '12 Galle Rd, Colombo 03',      'enrollment_status' => 'Active'],
            ['name' => 'Nimasha Silva',   'email' => 'nimasha.silva@student.ac.lk',   'student_id' => 'STU2024002', 'year' => '2', 'program' => 'Information Technology', 'phone' => '0722345678', 'address' => '45 Kandy Rd, Kurunegala',      'enrollment_status' => 'Active'],
            ['name' => 'Kasun Fernando',  'email' => 'kasun.fernando@student.ac.lk',  'student_id' => 'STU2024003', 'year' => '3', 'program' => 'Software Engineering',    'phone' => '0733456789', 'address' => '78 Matara Rd, Galle',           'enrollment_status' => 'Active'],
            ['name' => 'Dilnoza Rathnayake','email' => 'dilnoza.r@student.ac.lk',     'student_id' => 'STU2024004', 'year' => '1', 'program' => 'Computer Science',       'phone' => '0744567890', 'address' => '23 Negombo Rd, Colombo 14',    'enrollment_status' => 'Active'],
            ['name' => 'Tharindu Jayawardena','email' => 'tharindu.j@student.ac.lk', 'student_id' => 'STU2024005', 'year' => '4', 'program' => 'Data Science',           'phone' => '0755678901', 'address' => '90 Maharagama Rd, Pannipitiya','enrollment_status' => 'Graduated'],
            ['name' => 'Sanduni Wickramasinghe','email' => 'sanduni.w@student.ac.lk','student_id' => 'STU2024006', 'year' => '2', 'program' => 'Information Technology', 'phone' => '0766789012', 'address' => '5 Temple Rd, Nugegoda',        'enrollment_status' => 'Active'],
            ['name' => 'Ravindu Dissanayake', 'email' => 'ravindu.d@student.ac.lk',  'student_id' => 'STU2024007', 'year' => '3', 'program' => 'Software Engineering',   'phone' => '0777890123', 'address' => '34 Main St, Anuradhapura',      'enrollment_status' => 'Active'],
            ['name' => 'Sachini Mendis',  'email' => 'sachini.m@student.ac.lk',       'student_id' => 'STU2024008', 'year' => '1', 'program' => 'Computer Science',       'phone' => '0788901234', 'address' => '67 Lake Rd, Kandy',             'enrollment_status' => 'Active'],
            ['name' => 'Isuru Bandara',   'email' => 'isuru.b@student.ac.lk',         'student_id' => 'STU2024009', 'year' => '2', 'program' => 'Data Science',           'phone' => '0799012345', 'address' => '11 Hill St, Badulla',           'enrollment_status' => 'Inactive'],
            ['name' => 'Nadeesha Kumari', 'email' => 'nadeesha.k@student.ac.lk',      'student_id' => 'STU2024010', 'year' => '4', 'program' => 'Information Technology', 'phone' => '0701123456', 'address' => '88 Sea View Rd, Colombo 06',   'enrollment_status' => 'Active'],
            ['name' => 'Thisara Ekanayake','email' => 'thisara.e@student.ac.lk',      'student_id' => 'STU2024011', 'year' => '3', 'program' => 'Computer Science',       'phone' => '0712234567', 'address' => '29 Baseline Rd, Colombo 09',   'enrollment_status' => 'Active'],
            ['name' => 'Oshadi Liyanage', 'email' => 'oshadi.l@student.ac.lk',        'student_id' => 'STU2024012', 'year' => '1', 'program' => 'Software Engineering',   'phone' => '0723345678', 'address' => '55 Flower Rd, Colombo 07',      'enrollment_status' => 'Active'],
            ['name' => 'Chamara Priyantha','email' => 'chamara.p@student.ac.lk',      'student_id' => 'STU2024013', 'year' => '2', 'program' => 'Data Science',           'phone' => '0734456789', 'address' => '77 Airport Rd, Katunayake',     'enrollment_status' => 'Suspended'],
            ['name' => 'Bhagya Weerasinghe','email' => 'bhagya.w@student.ac.lk',     'student_id' => 'STU2024014', 'year' => '4', 'program' => 'Computer Science',       'phone' => '0745567890', 'address' => '13 Lotus Rd, Colombo 02',       'enrollment_status' => 'Graduated'],
            ['name' => 'Malith Gunawardena','email' => 'malith.g@student.ac.lk',     'student_id' => 'STU2024015', 'year' => '3', 'program' => 'Information Technology', 'phone' => '0756678901', 'address' => '42 Marine Dr, Colombo 01',      'enrollment_status' => 'Active'],
        ];

        foreach ($students as $data) {
            Student::firstOrCreate(['email' => $data['email']], $data);
        }
    }
}