<?php

namespace App\Livewire\Payment;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.dashboard')]
class Table extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatus() { $this->resetPage(); }

    public function delete($id)
    {
        Payment::findOrFail($id)->delete();
        session()->flash('success', 'Payment record deleted successfully.');
    }

    public function render()
    {
        $payments = Payment::with('student')
            ->when($this->search, function ($query) {
                $query->whereHas('student', fn($q) => $q->where('name', 'like', "%{$this->search}%")->orWhere('student_id', 'like', "%{$this->search}%"))
                      ->orWhere('receipt_no', 'like', "%{$this->search}%");
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->latest('payment_date')
            ->paginate(10);

        return view('livewire.payment.table', compact('payments'));
    }
}
