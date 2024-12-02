<x-app-layout>
    <div class="max-w-2xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-semibold mb-6">Create New taks</h1>

        <form action="{{ route('projects.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-700">task Name</label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-lg font-medium text-gray-700">Description (Optional)</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>

            <!-- Save Project Button with Green Color -->
            <button type="submit"
                class="w-full mt-4 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                Save task
            </button>
        </form>
    </div>
</x-app-layout>
