<?php

namespace App\Livewire\Result;

use App\Models\Result;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Table extends Component
{
    use WithPagination;

    public string $search = '';
    public string $semester = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingSemester() { $this->resetPage(); }

    public function delete($id)
    {
        Result::findOrFail($id)->delete();
        session()->flash('success', 'Result record deleted successfully.');
    }

    public function render()
    {
        $semesters = Result::select('semester')->distinct()->pluck('semester');

        $results = Result::with(['student', 'course'])
            ->when($this->search, function ($query) {
                $query->whereHas('student', fn($q) => $q->where('name', 'like', "%{$this->search}%")->orWhere('student_id', 'like', "%{$this->search}%"))
                      ->orWhereHas('course', fn($q) => $q->where('course_name', 'like', "%{$this->search}%")->orWhere('course_code', 'like', "%{$this->search}%"));
            })
            ->when($this->semester, function ($query) {
                $query->where('semester', $this->semester);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.result.table', compact('results', 'semesters'));
    }
}
