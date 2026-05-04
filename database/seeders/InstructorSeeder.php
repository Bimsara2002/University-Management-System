<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instructor;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = [
            [
                'name' => 'Dr. Nimal Perera',
                'email' => 'nimal.perera@gmail.com',
                'phone' => '0771111111',
                'department' => 'Computer Science',
                'designation' => 'Senior Lecturer',
                'address' => 'Colombo',
            ],
            [
                'name' => 'Ms. Sanduni Silva',
                'email' => 'sanduni.silva@gmail.com',
                'phone' => '0772222222',
                'department' => 'Business',
                'designation' => 'Lecturer',
                'address' => 'Gampaha',
            ],
            [
                'name' => 'Mr. Kasun Fernando',
                'email' => 'kasun.fernando@gmail.com',
                'phone' => '0773333333',
                'department' => 'IT',
                'designation' => 'Assistant Lecturer',
                'address' => 'Negombo',
            ],
            [
                'name' => 'Dr. Chamila Jayasinghe',
                'email' => 'chamila.j@gmail.com',
                'phone' => '0774444444',
                'department' => 'Engineering',
                'designation' => 'Senior Lecturer',
                'address' => 'Kandy',
            ],
            [
                'name' => 'Mrs. Piumi Senanayake',
                'email' => 'piumi.s@gmail.com',
                'phone' => '0775555555',
                'department' => 'Management',
                'designation' => 'Lecturer',
                'address' => 'Kalutara',
            ],
            [
                'name' => 'Mr. Tharindu Wickramasinghe',
                'email' => 'tharindu.w@gmail.com',
                'phone' => '0776666666',
                'department' => 'Software Engineering',
                'designation' => 'Lecturer',
                'address' => 'Kurunegala',
            ],
            [
                'name' => 'Ms. Anjali Perera',
                'email' => 'anjali.p@gmail.com',
                'phone' => '0777777777',
                'department' => 'Design',
                'designation' => 'Instructor',
                'address' => 'Galle',
            ],
            [
                'name' => 'Dr. Ravindu Abeysekara',
                'email' => 'ravindu.a@gmail.com',
                'phone' => '0781111111',
                'department' => 'Computer Science',
                'designation' => 'Senior Lecturer',
                'address' => 'Colombo',
            ],
            [
                'name' => 'Mr. Saman Kumara',
                'email' => 'saman.k@gmail.com',
                'phone' => '0782222222',
                'department' => 'Engineering',
                'designation' => 'Lecturer',
                'address' => 'Anuradhapura',
            ],
            [
                'name' => 'Ms. Dilani Fernando',
                'email' => 'dilani.f@gmail.com',
                'phone' => '0783333333',
                'department' => 'IT',
                'designation' => 'Assistant Lecturer',
                'address' => 'Matara',
            ],
            [
                'name' => 'Dr. Nuwan Silva',
                'email' => 'nuwan.s@gmail.com',
                'phone' => '0784444444',
                'department' => 'Business',
                'designation' => 'Senior Lecturer',
                'address' => 'Ratnapura',
            ],
            [
                'name' => 'Mrs. Sewmini Karunarathna',
                'email' => 'sewmini.k@gmail.com',
                'phone' => '0785555555',
                'department' => 'Management',
                'designation' => 'Lecturer',
                'address' => 'Hambantota',
            ],
            [
                'name' => 'Mr. Lakshan Madushanka',
                'email' => 'lakshan.m@gmail.com',
                'phone' => '0786666666',
                'department' => 'IT',
                'designation' => 'Instructor',
                'address' => 'Badulla',
            ],
            [
                'name' => 'Ms. Ishara De Silva',
                'email' => 'ishara.d@gmail.com',
                'phone' => '0787777777',
                'department' => 'Software Engineering',
                'designation' => 'Lecturer',
                'address' => 'Colombo',
            ],
            [
                'name' => 'Dr. Dinuka Peris',
                'email' => 'dinuka.p@gmail.com',
                'phone' => '0791111111',
                'department' => 'Computer Science',
                'designation' => 'Senior Lecturer',
                'address' => 'Jaffna',
            ],
        ];

        foreach ($instructors as $instructor) {
            Instructor::create($instructor);
        }
    }
}