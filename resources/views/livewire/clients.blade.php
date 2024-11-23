<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Clients</h1>
        <button wire:click="create"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-200">
            Add Client
        </button>
    </div>

    <div class="flex flex-col md:flex-row md:items-center md:space-x-4 mb-6">
        <input wire:model.debounce.300ms="search"
               wire:input="$dispatch('filter-updated')"
               type="text"
               placeholder="Search by name"
               class="border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition w-full md:w-auto shadow-sm">

        <select wire:model="filterStatus"
                class="border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition w-full md:w-64 shadow-sm">
            <option value="">Filter by Status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="banned">Banned</option>
        </select>

        <select wire:model="filterCategory"
                class="border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition w-full md:w-64 shadow-sm">
            <option value="">Filter by Category</option>
            <option value="vip">VIP</option>
            <option value="regular">Regular</option>
            <option value="new">New</option>
        </select>

    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-700">Name</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-700">Email</th>
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-700">Phone</th>
                <th class="border border-gray-300 px-4 py-2 text-center text-gray-700">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($clients as $client)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 text-gray-800">{{ $client->name }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-gray-800">{{ $client->email }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-gray-800">{{ $client->phone }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <button wire:click="edit({{ $client->id }})"
                                class="bg-yellow-500 text-white px-3 py-1 rounded-lg shadow hover:bg-yellow-600 transition">
                            Edit
                        </button>
                        <button wire:click="delete({{ $client->id }})"
                                class="bg-red-500 text-white px-3 py-1 rounded-lg shadow hover:bg-red-600 transition">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">No clients found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($isOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">{{ $client_id ? 'Edit Client' : 'Add Client' }}</h2>
                <form>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium">Name</label>
                        <input type="text" id="name" wire:model="name"
                               class="border border-gray-300 rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium">Email</label>
                        <input type="email" id="email" wire:model="email"
                               class="border border-gray-300 rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-medium">Phone</label>
                        <input type="text" id="phone" wire:model="phone"
                               class="border border-gray-300 rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="button" wire:click="closeModal"
                                class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 transition mr-2">
                            Cancel
                        </button>
                        <button type="button" wire:click="store"
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="mt-6">
        {{ $clients->links() }}
    </div>
</div>
