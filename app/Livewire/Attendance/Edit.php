<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Edit extends Component
{
    public Attendance $attendance;

    public $student_id;
    public $course_id;
    public $date;
    public $status;
    public $remarks;

    public function mount($id)
    {
        $this->attendance = Attendance::findOrFail($id);
        $this->student_id = $this->attendance->student_id;
        $this->course_id = $this->attendance->course_id;
        $this->date = $this->attendance->date ? $this->attendance->date->format('Y-m-d') : '';
        $this->status = $this->attendance->status;
        $this->remarks = $this->attendance->remarks;
    }

    protected function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->attendance->update([
            'student_id' => $this->student_id,
            'course_id' => $this->course_id,
            'date' => $this->date,
            'status' => $this->status,
            'remarks' => $this->remarks,
        ]);

        session()->flash('success', 'Attendance record updated successfully.');
        return redirect()->route('attendances.index');
    }

    public function render()
    {
        $students = Student::orderBy('name')->get();
        $courses = Course::orderBy('course_name')->get();

        return view('livewire.attendance.edit', compact('students', 'courses'));
    }
}
