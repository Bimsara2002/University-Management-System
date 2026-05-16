<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Table extends Component
{
    use WithPagination;

    public string $course_id = '';
    public string $date = '';

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
    }

    public function updatingCourseId() { $this->resetPage(); }
    public function updatingDate() { $this->resetPage(); }

    public function delete($id)
    {
        Attendance::findOrFail($id)->delete();
        session()->flash('success', 'Attendance record removed successfully.');
    }

    public function render()
    {
        $courses = Course::orderBy('course_name')->get();

        $attendances = Attendance::with(['student', 'course'])
            ->when($this->course_id, function ($query) {
                $query->where('course_id', $this->course_id);
            })
            ->when($this->date, function ($query) {
                $query->whereDate('date', $this->date);
            })
            ->orderBy('student_id')
            ->paginate(15);

        return view('livewire.attendance.table', compact('attendances', 'courses'));
    }
}
