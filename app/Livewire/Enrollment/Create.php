<?php

namespace App\Livewire\Enrollment;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Create extends Component
{
    public $student_id = '';
    public $course_id = '';
    public $enrolled_at = '';
    public $status = 'Enrolled';
    public $notes = '';

    public function mount()
    {
        $this->enrolled_at = now()->format('Y-m-d');
    }

    protected function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'enrolled_at' => 'required|date',
            'status' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        // Check if already enrolled
        if (Enrollment::where('student_id', $this->student_id)->where('course_id', $this->course_id)->exists()) {
            $this->addError('course_id', 'Student is already enrolled in this course.');
            return;
        }

        Enrollment::create([
            'student_id' => $this->student_id,
            'course_id' => $this->course_id,
            'enrolled_at' => $this->enrolled_at,
            'status' => $this->status,
            'notes' => $this->notes,
        ]);

        // Increment enrolled count on Course
        $course = Course::find($this->course_id);
        $course->increment('enrolled');

        session()->flash('success', 'Student enrolled successfully.');

        return redirect()->route('enrollments.index');
    }

    public function render()
    {
        $students = Student::orderBy('name')->get();
        $courses = Course::orderBy('course_name')->get();

        return view('livewire.enrollment.create', compact('students', 'courses'));
    }
}
