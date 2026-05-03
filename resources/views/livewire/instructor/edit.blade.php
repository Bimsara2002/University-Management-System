<div>

    <h1 class="text-2xl font-extrabold mb-6">Edit Instructor</h1>

    <form wire:submit.prevent="update" class="bg-white p-6 rounded-2xl shadow space-y-4">

        <input type="text" wire:model="instructor.name"
               class="w-full border px-4 py-2 rounded">

        <input type="email" wire:model="instructor.email"
               class="w-full border px-4 py-2 rounded">

        <input type="text" wire:model="instructor.phone"
               class="w-full border px-4 py-2 rounded">

        <input type="text" wire:model="instructor.department"
               class="w-full border px-4 py-2 rounded">

        <input type="text" wire:model="instructor.designation"
               class="w-full border px-4 py-2 rounded">

        <textarea wire:model="instructor.address"
                  class="w-full border px-4 py-2 rounded"></textarea>

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Update Instructor
        </button>

    </form>

</div>