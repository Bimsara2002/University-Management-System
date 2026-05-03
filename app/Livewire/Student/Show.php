<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Show extends Component
{
    public $student;

    public function mount($id)
    {
        $this->student = Student::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.student.show');
    }
}