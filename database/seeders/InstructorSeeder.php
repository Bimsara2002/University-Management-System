<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = [
            ['name' => 'Dr. R. Silva',        'email' => 'r.silva@faculty.ac.lk',       'phone' => '0112345001', 'department' => 'Computer Science',       'designation' => 'Professor',           'address' => '10 Faculty Quarters, Colombo 07'],
            ['name' => 'Dr. P. Fernando',     'email' => 'p.fernando@faculty.ac.lk',    'phone' => '0112345002', 'department' => 'Computer Science',       'designation' => 'Associate Professor', 'address' => '22 University Ave, Colombo 03'],
            ['name' => 'Mr. A. Jayawardena',  'email' => 'a.jayawardena@faculty.ac.lk', 'phone' => '0112345003', 'department' => 'Computer Science',       'designation' => 'Senior Lecturer',     'address' => '5 Park Rd, Nugegoda'],
            ['name' => 'Ms. N. Perera',       'email' => 'n.perera@faculty.ac.lk',      'phone' => '0112345004', 'department' => 'Information Technology', 'designation' => 'Lecturer',            'address' => '78 Hill St, Kandy'],
            ['name' => 'Dr. S. Wickrama',     'email' => 's.wickrama@faculty.ac.lk',    'phone' => '0112345005', 'department' => 'Information Technology', 'designation' => 'Associate Professor', 'address' => '33 Lake Dr, Colombo 02'],
            ['name' => 'Dr. K. Rathnayake',   'email' => 'k.rathnayake@faculty.ac.lk',  'phone' => '0112345006', 'department' => 'Software Engineering',   'designation' => 'Professor',           'address' => '9 Lotus Rd, Battaramulla'],
            ['name' => 'Mr. L. Gunawardena',  'email' => 'l.gunawardena@faculty.ac.lk', 'phone' => '0112345007', 'department' => 'Software Engineering',   'designation' => 'Senior Lecturer',     'address' => '56 Green Path, Colombo 03'],
            ['name' => 'Dr. T. Ekanayake',    'email' => 't.ekanayake@faculty.ac.lk',   'phone' => '0112345008', 'department' => 'Data Science',           'designation' => 'Associate Professor', 'address' => '14 Marine Dr, Colombo 01'],
        ];

        foreach ($instructors as $data) {
            Instructor::firstOrCreate(['email' => $data['email']], $data);
        }
    }
}