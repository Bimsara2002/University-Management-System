<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'semester',
        'marks_obtained',
        'total_marks',
        'grade',
        'gpa',
        'remarks',
    ];

    protected $casts = [
        'marks_obtained' => 'decimal:2',
        'total_marks' => 'decimal:2',
        'gpa' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Calculate percentage
     */
    public function getPercentageAttribute(): float
    {
        if ($this->total_marks <= 0) return 0;
        return round(($this->marks_obtained / $this->total_marks) * 100, 1);
    }

    /**
     * Auto-calculate grade from marks
     */
    public static function calculateGrade(float $percentage): string
    {
        return match(true) {
            $percentage >= 90 => 'A+',
            $percentage >= 80 => 'A',
            $percentage >= 75 => 'B+',
            $percentage >= 70 => 'B',
            $percentage >= 65 => 'C+',
            $percentage >= 55 => 'C',
            $percentage >= 45 => 'D',
            default => 'F',
        };
    }

    /**
     * Auto-calculate GPA from grade
     */
    public static function calculateGpa(string $grade): float
    {
        return match($grade) {
            'A+' => 4.00,
            'A'  => 4.00,
            'B+' => 3.50,
            'B'  => 3.00,
            'C+' => 2.50,
            'C'  => 2.00,
            'D'  => 1.00,
            default => 0.00,
        };
    }
}
