<div>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900">Add Instructor</h1>
        <p class="text-slate-500 mt-1">Create a new instructor profile</p>
    </div>

    <!-- Success Message -->
    @if(session()->has('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow border border-slate-200 p-6">

        <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Name -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Full Name</label>
                <input type="text" wire:model="name"
                       class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter name">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" wire:model="email"
                       class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter email">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Phone</label>
                <input type="text" wire:model="phone"
                       class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter phone">
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Department -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Department</label>
                <input type="text" wire:model="department"
                       class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter department">
                @error('department') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Designation -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Designation</label>
                <select wire:model="designation"
                        class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Designation</option>
                    <option>Lecturer</option>
                    <option>Senior Lecturer</option>
                    <option>Assistant Professor</option>
                    <option>Professor</option>
                </select>
                @error('designation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Address</label>
                <textarea wire:model="address"
                          class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                          rows="3"
                          placeholder="Enter address"></textarea>
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Buttons -->
            <div class="md:col-span-2 flex justify-end gap-3 mt-4">

                <a href="{{ route('instructors.index') }}"
                   class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300">
                    Cancel
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow">
                    Save Instructor
                </button>

            </div>

        </form>

    </div>

</div>