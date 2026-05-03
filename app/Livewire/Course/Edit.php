<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Edit extends Component
{
    public Course $course;

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

    public function mount($id)
    {
        $this->course = Course::findOrFail($id);

        $this->course_code = $this->course->course_code;
        $this->course_name = $this->course->course_name;
        $this->department = $this->course->department;
        $this->instructor = $this->course->instructor;
        $this->credits = (string) $this->course->credits;
        $this->capacity = (string) $this->course->capacity;
        $this->enrolled = (string) $this->course->enrolled;
        $this->schedule = $this->course->schedule;
        $this->room = $this->course->room;
        $this->status = $this->course->status;
    }

    public function update()
    {
        $validated = $this->validate([
            'course_code' => 'required|string|max:50|unique:courses,course_code,' . $this->course->id,
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

        $this->course->update($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function render()
    {
        return view('livewire.course.edit');
    }
}