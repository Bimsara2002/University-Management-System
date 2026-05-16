<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();
        if ($students->isEmpty()) return;

        $methods = ['Cash', 'Card', 'Bank Transfer', 'Online'];
        $statuses = ['Paid', 'Paid', 'Paid', 'Pending', 'Overdue'];
        
        foreach ($students as $student) {
            $numPayments = rand(1, 3);
            for ($i = 0; $i < $numPayments; $i++) {
                Payment::create([
                    'student_id'     => $student->id,
                    'receipt_no'     => 'REC-' . strtoupper(Str::random(6)) . '-' . rand(1000, 9999),
                    'amount'         => rand(15000, 50000),
                    'payment_date'   => now()->subDays(rand(1, 100)),
                    'payment_method' => $methods[array_rand($methods)],
                    'status'         => $statuses[array_rand($statuses)],
                    'description'    => 'Semester Fee - Installment ' . ($i + 1),
                ]);
            }
        }
    }
}
