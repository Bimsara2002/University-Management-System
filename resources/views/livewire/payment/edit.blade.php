<div class="min-h-screen">
    <div class="mb-6 overflow-hidden rounded-[32px] bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 p-8 text-white shadow-2xl">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <a href="{{ route('payments.index') }}" class="text-sm font-bold text-white/80 hover:text-white hover:underline transition">
                    &larr; Back to Payments
                </a>
                <h1 class="mt-2 text-4xl font-extrabold">Edit Payment</h1>
                <p class="mt-2 max-w-2xl text-sm text-white/80">
                    Update fee payment record.
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
        <!-- Live Preview Card -->
        <div class="rounded-[30px] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-xl lg:col-span-1 transition-colors">
            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/50 text-4xl font-extrabold text-orange-600 dark:text-orange-400">
                LKR
            </div>

            <h2 class="mt-5 text-center text-xl font-extrabold text-slate-800 dark:text-white">
                {{ $amount ? number_format((float)$amount, 2) : '0.00' }}
            </h2>

            <div class="mt-8 space-y-4">
                <div class="rounded-2xl border border-slate-100 dark:border-slate-800 bg-[#f8f7fd] dark:bg-slate-800 p-4 transition-colors">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500">Student</p>
                    <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $student_id ? 'Selected' : 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl border border-slate-100 dark:border-slate-800 bg-[#f8f7fd] dark:bg-slate-800 p-4 transition-colors">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500">Method</p>
                    <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $payment_method ?: 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl border border-slate-100 dark:border-slate-800 bg-[#f8f7fd] dark:bg-slate-800 p-4 transition-colors">
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500">Date</p>
                    <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200">{{ $payment_date ?: 'Not selected' }}</p>
                </div>

                <div class="rounded-2xl border border-green-100 dark:border-green-900/50 bg-green-50 dark:bg-green-900/20 p-4 transition-colors">
                    <p class="text-xs font-bold text-green-500 dark:text-green-400">Status</p>
                    <p class="mt-1 text-sm font-bold text-green-700 dark:text-green-300">{{ $status ?: 'Not selected' }}</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="rounded-[30px] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-8 shadow-xl lg:col-span-3 transition-colors">
            <form wire:submit.prevent="update" class="space-y-8">

                <!-- Payment Details -->
                <div>
                    <h3 class="mb-5 text-lg font-extrabold text-slate-800 dark:text-white">Payment Details</h3>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Student <span class="text-red-500">*</span></label>
                            <select wire:model.live="student_id"
                                    class="w-full rounded-2xl border @error('student_id') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                                <option value="">Select Student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->student_id }} - {{ $student->name }}</option>
                                @endforeach
                            </select>
                            @error('student_id') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Description <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="description" placeholder="e.g. Semester 1 Registration Fee"
                                   class="w-full rounded-2xl border @error('description') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('description') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Amount (LKR) <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" wire:model.live="amount" placeholder="0.00"
                                   class="w-full rounded-2xl border @error('amount') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('amount') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Payment Date <span class="text-red-500">*</span></label>
                            <input type="date" wire:model.live="payment_date"
                                   class="w-full rounded-2xl border @error('payment_date') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                            @error('payment_date') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Payment Method <span class="text-red-500">*</span></label>
                            <select wire:model.live="payment_method"
                                    class="w-full rounded-2xl border @error('payment_method') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                                <option value="Cash">Cash</option>
                                <option value="Card">Credit/Debit Card</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Online">Online Payment gateway</option>
                            </select>
                            @error('payment_method') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Status <span class="text-red-500">*</span></label>
                            <select wire:model.live="status"
                                    class="w-full rounded-2xl border @error('status') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                                <option value="Paid">Paid</option>
                                <option value="Pending">Pending</option>
                                <option value="Overdue">Overdue</option>
                            </select>
                            @error('status') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">Notes (Optional)</label>
                            <textarea wire:model.live="notes" rows="2" placeholder="Any specific notes regarding this payment..."
                                      class="w-full rounded-2xl border @error('notes') border-red-500 bg-red-50 @else border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 @enderror px-5 py-4 text-slate-900 dark:text-white outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10"></textarea>
                            @error('notes') <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-slate-100 dark:border-slate-800 pt-6 md:flex-row md:justify-end">
                    <a href="{{ route('payments.index') }}"
                       class="rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 px-7 py-3 text-center text-sm font-bold text-slate-700 dark:text-slate-300 transition hover:bg-slate-50 dark:hover:bg-slate-700">
                        Cancel
                    </a>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="rounded-2xl bg-orange-600 px-7 py-3 font-bold text-white shadow-lg shadow-orange-500/30 transition hover:bg-orange-700 disabled:opacity-60">
                        <span wire:loading.remove>Update Payment</span>
                        <span wire:loading>Updating...</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
