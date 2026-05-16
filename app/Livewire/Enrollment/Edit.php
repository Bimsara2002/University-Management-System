<?php

namespace App\Livewire\Enrollment;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Edit extends Component
{
    public Enrollment $enrollment;

    public $student_id;
    public $course_id;
    public $enrolled_at;
    public $status;
    public $notes;

    public function mount($id)
    {
        $this->enrollment = Enrollment::findOrFail($id);
        $this->student_id = $this->enrollment->student_id;
        $this->course_id = $this->enrollment->course_id;
        $this->enrolled_at = $this->enrollment->enrolled_at ? $this->enrollment->enrolled_at->format('Y-m-d') : '';
        $this->status = $this->enrollment->status;
        $this->notes = $this->enrollment->notes;
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

    public function update()
    {
        $this->validate();

        $this->enrollment->update([
            'student_id' => $this->student_id,
            'course_id' => $this->course_id,
            'enrolled_at' => $this->enrolled_at,
            'status' => $this->status,
            'notes' => $this->notes,
        ]);

        session()->flash('success', 'Enrollment updated successfully.');
        return redirect()->route('enrollments.index');
    }

    public function render()
    {
        $students = Student::orderBy('name')->get();
        $courses = Course::orderBy('course_name')->get();

        return view('livewire.enrollment.edit', compact('students', 'courses'));
    }
}
