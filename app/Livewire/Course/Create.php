<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.dashboard')]
class Create extends Component
{
    public string $course_code = '';
    public string $course_name = '';
    public string $department = '';
    public string $instructor = '';
    public string $credits = '';
    public string $capacity = '';
    public string $enrolled = '';
    public string $schedule = '';
    public string $room = '';
    public string $status = '';

    public function store()
    {
        $this->validate([
            'course_code' => 'required|string|max:50|unique:courses,course_code',
            'course_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'credits' => 'required|integer|min:1|max:6',
            'capacity' => 'required|integer|min:1',
            'enrolled' => 'required|integer|min:0|lte:capacity',
            'schedule' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        Course::create([
            'course_code' => $this->course_code,
            'course_name' => $this->course_name,
            'department' => $this->department,
            'instructor' => $this->instructor,
            'credits' => $this->credits,
            'capacity' => $this->capacity,
            'enrolled' => $this->enrolled,
            'schedule' => $this->schedule,
            'room' => $this->room,
            'status' => $this->status,
        ]);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course created successfully!');
    }

    public function render()
    {
        return view('livewire.course.create');
    }
}