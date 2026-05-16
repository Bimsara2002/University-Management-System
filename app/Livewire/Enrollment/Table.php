<?php

namespace App\Livewire\Enrollment;

use App\Models\Enrollment;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Table extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatus() { $this->resetPage(); }

    public function delete($id)
    {
        Enrollment::findOrFail($id)->delete();
        session()->flash('success', 'Enrollment removed successfully.');
    }

    public function render()
    {
        $enrollments = Enrollment::with(['student', 'course'])
            ->when($this->search, function ($query) {
                $query->whereHas('student', fn($q) => $q->where('name', 'like', "%{$this->search}%")->orWhere('student_id', 'like', "%{$this->search}%"))
                      ->orWhereHas('course', fn($q) => $q->where('course_name', 'like', "%{$this->search}%")->orWhere('course_code', 'like', "%{$this->search}%"));
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.enrollment.table', compact('enrollments'));
    }
}
