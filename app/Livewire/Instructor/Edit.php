<?php

namespace App\Livewire\Instructor;

use App\Models\Instructor;
use Livewire\Component;

class Edit extends Component
{
    public Instructor $instructor;

    protected function rules()
    {
        return [
            'instructor.name' => 'required',
            'instructor.email' => 'required|email',
            'instructor.phone' => 'required',
            'instructor.department' => 'required',
            'instructor.designation' => 'required',
        ];
    }

    public function mount($id)
    {
        $this->instructor = Instructor::findOrFail($id);
    }

    public function update()
    {
        $this->validate();

        $this->instructor->save();

        session()->flash('success', 'Instructor updated.');

        return redirect()->route('instructors.index');
    }

    public function render()
    {
        return view('livewire.instructor.edit');
    }
}