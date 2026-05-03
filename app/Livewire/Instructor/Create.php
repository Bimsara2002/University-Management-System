<?php

namespace App\Livewire\Instructor;

use App\Models\Instructor;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Create extends Component
{
    public $name, $email, $phone, $department, $designation, $address;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:instructors,email',
        'phone' => 'required|min:10',
        'department' => 'required',
        'designation' => 'required',
    ];

    public function save()
    {
        $this->validate();

        Instructor::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'department' => $this->department,
            'designation' => $this->designation,
            'address' => $this->address,
        ]);

        session()->flash('success', 'Instructor created successfully.');

        return redirect()->route('instructors.index');
    }

    public function render()
    {
        return view('livewire.instructor.create');
    }
}