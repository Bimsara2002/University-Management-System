<?php

namespace App\Livewire\Result;

use App\Models\Course;
use App\Models\Result;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Edit extends Component
{
    public Result $result;

    public $student_id;
    public $course_id;
    public $semester;
    public $marks_obtained;
    public $total_marks;
    public $remarks;

    public function mount($id)
    {
        $this->result = Result::findOrFail($id);
        
        $this->student_id = $this->result->student_id;
        $this->course_id = $this->result->course_id;
        $this->semester = $this->result->semester;
        $this->marks_obtained = $this->result->marks_obtained;
        $this->total_marks = $this->result->total_marks;
        $this->remarks = $this->result->remarks;
    }

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

    public function update()
    {
        $this->validate();

        $percentage = ($this->marks_obtained / $this->total_marks) * 100;
        $grade = Result::calculateGrade($percentage);
        $gpa = Result::calculateGpa($grade);

        $this->result->update([
            'student_id' => $this->student_id,
            'course_id' => $this->course_id,
            'semester' => $this->semester,
            'marks_obtained' => $this->marks_obtained,
            'total_marks' => $this->total_marks,
            'grade' => $grade,
            'gpa' => $gpa,
            'remarks' => $this->remarks,
        ]);

        session()->flash('success', 'Grade updated successfully.');

        return redirect()->route('results.index');
    }

    public function render()
    {
        $students = Student::orderBy('name')->get();
        $courses = Course::orderBy('course_name')->get();

        return view('livewire.result.edit', compact('students', 'courses'));
    }
}
