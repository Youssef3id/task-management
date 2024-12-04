<x-app-layout>
    <h2>Create Task</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.store-task') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="user_id" class="block text-sm font-medium text-gray-700">Assign to User</label>
            <select id="user_id" name="user_id"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Select a User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Task Title</label>
            <input type="text" name="title" id="title"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                required>
            @error('title')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Task Description</label>
            <textarea name="description" id="description" rows="4"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            @error('description')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>


        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create Task</button>
    </form>
</x-app-layout>
