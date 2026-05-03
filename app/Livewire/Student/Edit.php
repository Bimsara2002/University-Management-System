<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.dashboard')]
class Edit extends Component
{
    public Student $student;

    public string $name = '';
    public string $email = '';
    public string $student_id = '';
    public string $year = '';
    public string $program = '';
    public string $phone = '';
    public string $address = '';
    public string $enrollment_status = '';

    public function mount($id)
    {
        $this->student = Student::findOrFail($id);

        $this->name = $this->student->name;
        $this->email = $this->student->email;
        $this->student_id = $this->student->student_id;
        $this->year = $this->student->year;
        $this->program = $this->student->program;
        $this->phone = $this->student->phone;
        $this->address = $this->student->address;
        $this->enrollment_status = $this->student->enrollment_status;
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:students,email,' . $this->student->id,
            'student_id' => 'required|unique:students,student_id,' . $this->student->id,
            'year' => 'required',
            'program' => 'required',
            'phone' => 'required|min:10',
            'address' => 'required|min:5',
            'enrollment_status' => 'required',
        ];
    }

    public function update()
    {
        $validated = $this->validate();

        $this->student->update($validated);

        session()->flash('success', 'Student updated successfully.');

        return redirect()->route('students.index');
    }

    public function render()
    {
        return view('livewire.student.edit');
    }
}