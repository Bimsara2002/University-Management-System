<?php

namespace App\Livewire\Payment;

use App\Models\Payment;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Edit extends Component
{
    public Payment $payment;

    public $student_id;
    public $amount;
    public $payment_date;
    public $payment_method;
    public $status;
    public $description;
    public $notes;

    public function mount($id)
    {
        $this->payment = Payment::findOrFail($id);
        
        $this->student_id = $this->payment->student_id;
        $this->amount = $this->payment->amount;
        $this->payment_date = $this->payment->payment_date ? $this->payment->payment_date->format('Y-m-d') : '';
        $this->payment_method = $this->payment->payment_method;
        $this->status = $this->payment->status;
        $this->description = $this->payment->description;
        $this->notes = $this->payment->notes;
    }

    protected function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'payment_method' => 'required',
            'status' => 'required',
            'description' => 'required|string|max:255',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->payment->update([
            'student_id' => $this->student_id,
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
            'description' => $this->description,
            'notes' => $this->notes,
        ]);

        session()->flash('success', 'Payment updated successfully.');

        return redirect()->route('payments.index');
    }

    public function render()
    {
        $students = Student::orderBy('name')->get();
        return view('livewire.payment.edit', compact('students'));
    }
}
