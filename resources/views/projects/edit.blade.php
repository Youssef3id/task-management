<x-app-layout>
    <div class="container py-8 mx-auto">
        <!-- Heading -->
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-semibold">Edit Project: {{ $project->name }}</h1>
        </div>

        <!-- Project Edit Form -->
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Specify the HTTP method as PUT for updating -->

            <!-- Project Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">task Name</label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('name', $project->name) }}" required>
            </div>

            <!-- Project Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">task Description</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('description', $project->description) }}</textarea>
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="mt-6 flex justify-between items-center">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">
                    Update task
                </button>
                <a href="{{ route('projects.index') }}"
                    class="px-6 py-3 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition duration-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
