<?php

namespace App\Livewire\Instructor;

use App\Models\Instructor;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Edit extends Component
{
    public Instructor $instructor;

    public $name, $email, $phone, $department, $designation, $address;

    public function mount($id)
    {
        $this->instructor = Instructor::findOrFail($id);
        $this->name = $this->instructor->name;
        $this->email = $this->instructor->email;
        $this->phone = $this->instructor->phone;
        $this->department = $this->instructor->department;
        $this->designation = $this->instructor->designation;
        $this->address = $this->instructor->address;
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:instructors,email,' . $this->instructor->id,
            'phone' => 'required|min:10',
            'department' => 'required',
            'designation' => 'required',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->instructor->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'department' => $this->department,
            'designation' => $this->designation,
            'address' => $this->address,
        ]);

        session()->flash('success', 'Instructor updated successfully.');

        return redirect()->route('instructors.index');
    }

    public function render()
    {
        return view('livewire.instructor.edit');
    }
}