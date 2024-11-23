<div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg">
        <h2 class="text-xl mb-4">Add/Edit Client</h2>
        <form>
            <div>
                <label for="name">Name</label>
                <input type="text" wire:model="name" class="border rounded w-full">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" wire:model="email" class="border rounded w-full">
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="phone">Phone</label>
                <input type="text" wire:model="phone" class="border rounded w-full">
                @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <button type="button" wire:click="store" class="bg-green-500 text-white px-4 py-2">Save</button>
                <button type="button" wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2">Cancel</button>
            </div>
        </form>
    </div>
</div>
