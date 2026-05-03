<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Create extends Component
{
    public string $name = '';
    public string $email = '';
    public string $student_id = '';
    public string $year = '';
    public string $program = '';
    public string $phone = '';
    public string $address = '';
    public string $enrollment_status = '';

    protected function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:students,email',
            'student_id' => 'required|unique:students,student_id',
            'year' => 'required',
            'program' => 'required',
            'phone' => 'required|min:10',
            'address' => 'required|min:5',
            'enrollment_status' => 'required',
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'Student name is required.',
            'name.min' => 'Student name must be at least 3 characters.',

            'email.required' => 'Email address is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email already exists.',

            'student_id.required' => 'Student ID is required.',
            'student_id.unique' => 'This Student ID already exists.',

            'year.required' => 'Please select academic year.',
            'program.required' => 'Program is required.',

            'phone.required' => 'Phone number is required.',
            'phone.min' => 'Phone number must be at least 10 digits.',

            'address.required' => 'Address is required.',
            'address.min' => 'Address must be at least 5 characters.',

            'enrollment_status.required' => 'Status is required.',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        Student::create($validated);

        session()->flash('success', 'Student created successfully.');

        return redirect()->route('students.index');
    }

    public function render()
    {
        return view('livewire.student.create');
    }
}