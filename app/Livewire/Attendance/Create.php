<?php

namespace App\Livewire\Attendance;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Attendance;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Create extends Component
{
    public $course_id = '';
    public $date = '';
    
    // Array to hold attendance statuses for each student: [student_id => status]
    public array $attendance_data = [];

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
    }

    public function loadStudents()
    {
        if (!$this->course_id) {
            $this->attendance_data = [];
            return;
        }

        $enrollments = Enrollment::with('student')->where('course_id', $this->course_id)->where('status', 'Enrolled')->get();
        
        $this->attendance_data = [];
        foreach ($enrollments as $enrollment) {
            // Check if attendance already taken for this date
            $existing = Attendance::where('student_id', $enrollment->student_id)
                                  ->where('course_id', $this->course_id)
                                  ->whereDate('date', $this->date)
                                  ->first();
                                  
            $this->attendance_data[$enrollment->student_id] = $existing ? $existing->status : 'Present';
        }
    }

    public function updatedCourseId()
    {
        $this->loadStudents();
    }

    public function updatedDate()
    {
        $this->loadStudents();
    }

    public function save()
    {
        $this->validate([
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
        ]);

        foreach ($this->attendance_data as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'course_id' => $this->course_id,
                    'date' => $this->date,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        session()->flash('success', 'Attendance recorded successfully.');

        return redirect()->route('attendances.index');
    }

    public function render()
    {
        $courses = Course::orderBy('course_name')->get();
        $enrollments = [];
        
        if ($this->course_id) {
            $enrollments = Enrollment::with('student')->where('course_id', $this->course_id)->where('status', 'Enrolled')->get();
        }

        return view('livewire.attendance.create', compact('courses', 'enrollments'));
    }
}
