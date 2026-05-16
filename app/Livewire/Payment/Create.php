<?php

namespace App\Livewire\Payment;

use App\Models\Payment;
use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Create extends Component
{
    public $student_id = '';
    public $amount = '';
    public $payment_date = '';
    public $payment_method = 'Cash';
    public $status = 'Paid';
    public $description = '';
    public $notes = '';

    public function mount()
    {
        $this->payment_date = now()->format('Y-m-d');
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

    public function save()
    {
        $this->validate();

        $receipt_no = 'REC-' . strtoupper(Str::random(6)) . '-' . rand(1000, 9999);

        Payment::create([
            'student_id' => $this->student_id,
            'receipt_no' => $receipt_no,
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
            'description' => $this->description,
            'notes' => $this->notes,
        ]);

        session()->flash('success', 'Payment recorded successfully. Receipt No: ' . $receipt_no);

        return redirect()->route('payments.index');
    }

    public function render()
    {
        $students = Student::orderBy('name')->get();
        return view('livewire.payment.create', compact('students'));
    }
}
