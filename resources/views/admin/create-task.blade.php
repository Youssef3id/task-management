<x-app-layout>
    <h2 class="text-lg font-bold mb-4">Create Task</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- User Information -->
    <div class="mb-6 p-4 bg-gray-100 rounded-lg shadow-md">
        <h3 class="text-sm font-medium text-gray-700">Assign Task To:</h3>
        <p class="text-gray-900">
            <span class="font-bold">Name:</span> {{ $user->name }} <br>
            <span class="font-bold">Email:</span> {{ $user->email }}
        </p>
    </div>

    <form action="{{ route('admin.store-task') }}" method="POST">
        @csrf

        <!-- Hidden User ID Input -->
        <input type="hidden" name="user_id" value="{{ $user->id }}">

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
