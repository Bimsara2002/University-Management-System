<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Show extends Component

{
    public Course $course;

    public function mount($id)
    {
        $this->course = Course::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.course.show');
    }
}
