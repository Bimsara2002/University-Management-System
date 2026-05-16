<?php

namespace App\Livewire\Result;

use App\Models\Course;
use App\Models\Result;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Create extends Component
{
    public $student_id = '';
    public $course_id = '';
    public $semester = '';
    public $marks_obtained = '';
    public $total_marks = 100;
    public $remarks = '';

    protected function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'semester' => 'required|string|max:50',
            'marks_obtained' => 'required|numeric|min:0|max:'.$this->total_marks,
            'total_marks' => 'required|numeric|min:1',
            'remarks' => 'nullable|string|max:255',
        ];
    }

    public function save()
    {
        $this->validate();

        // Check if already exists
        if (Result::where('student_id', $this->student_id)
                  ->where('course_id', $this->course_id)
                  ->where('semester', $this->semester)
                  ->exists()) {
            $this->addError('course_id', 'A result for this student in this course and semester already exists.');
            return;
        }

        $percentage = ($this->marks_obtained / $this->total_marks) * 100;
        $grade = Result::calculateGrade($percentage);
        $gpa = Result::calculateGpa($grade);

        Result::create([
            'student_id' => $this->student_id,
            'course_id' => $this->course_id,
            'semester' => $this->semester,
            'marks_obtained' => $this->marks_obtained,
            'total_marks' => $this->total_marks,
            'grade' => $grade,
            'gpa' => $gpa,
            'remarks' => $this->remarks,
        ]);

        session()->flash('success', 'Grade recorded successfully.');

        return redirect()->route('results.index');
    }

    public function render()
    {
        $students = Student::orderBy('name')->get();
        $courses = Course::orderBy('course_name')->get();

        return view('livewire.result.create', compact('students', 'courses'));
    }
}
