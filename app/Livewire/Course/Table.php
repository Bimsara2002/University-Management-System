<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Table extends Component
{
    public string $keyword = '';
    public string $department = '';

    public ?int $confirmingDeleteId = null;

    public function resetFilters()
    {
        $this->keyword = '';
        $this->department = '';
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function cancelDelete()
    {
        $this->confirmingDeleteId = null;
    }

    public function deleteCourse()
    {
        if ($this->confirmingDeleteId) {
            Course::findOrFail($this->confirmingDeleteId)->delete();

            $this->confirmingDeleteId = null;

            return redirect()
                ->route('courses.index')
                ->with('success', 'Course deleted successfully.');
        }
    }

    public function render()
    {
        $search = trim($this->keyword);

        $departments = Course::query()
            ->whereNotNull('department')
            ->where('department', '!=', '')
            ->select('department')
            ->distinct()
            ->orderBy('department')
            ->pluck('department');

        $courses = Course::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('course_name', 'like', "%{$search}%")
                        ->orWhere('course_code', 'like', "%{$search}%")
                        ->orWhere('instructor', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%");
                });
            })
            ->when($this->department !== '', function ($query) {
                $query->where('department', $this->department);
            })
            ->latest()
            ->get();

        return view('livewire.course.table', compact('courses', 'departments'));
    }
}