<?php

namespace App\Livewire\Instructor;

use App\Models\Instructor;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Table extends Component
{
    use WithPagination;

    public string $search = '';

    public function delete($id)
    {
        Instructor::findOrFail($id)->delete();

        session()->flash('success', 'Instructor deleted successfully.');
    }

    public function render()
    {
        $instructors = Instructor::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%")
                      ->orWhere('department', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('livewire.instructor.table', compact('instructors'));
    }
}