<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Table extends Component
{
    use WithPagination;

    public string $keyword = '';
    public string $department = '';
    public string $status = '';

    public ?int $confirmingDeleteId = null;

    public function updatingKeyword()
    {
        $this->resetPage();
    }

    public function updatingDepartment()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->keyword = '';
        $this->department = '';
        $this->status = '';
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function cancelDelete()
    {
        $this->confirmingDeleteId = null;
    }

    public function deleteStudent()
    {
        if ($this->confirmingDeleteId) {
            Student::findOrFail($this->confirmingDeleteId)->delete();

            $this->confirmingDeleteId = null;

            return redirect()
                ->route('students.index')
                ->with('success', 'Student deleted successfully.');
        }
    }

    public function render()
    {
        $search = trim($this->keyword);

        $departments = Student::query()
            ->whereNotNull('program')
            ->where('program', '!=', '')
            ->select('program')
            ->distinct()
            ->orderBy('program')
            ->pluck('program');

        $students = Student::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('student_id', 'like', "%{$search}%")
                        ->orWhere('program', 'like', "%{$search}%");
                });
            })
            ->when($this->department !== '', function ($query) {
                $query->where('program', $this->department);
            })
            ->when($this->status !== '', function ($query) {
                $query->where('enrollment_status', $this->status);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.student.table', compact('students', 'departments'));
    }
}