<x-app-layout>
    <div class="container py-8 mx-auto">
        <!-- Project Header -->
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-semibold">Task: {{ $project->name }}</h1>
        </div>

        <!-- Project Details -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h5 class="text-2xl font-semibold text-blue-600">{{ $project->name }}</h5>
            <p class="text-gray-700 mt-2">{{ $project->description ?? 'No description available.' }}</p>
            <small class="text-gray-500 block mt-2">Created on {{ $project->created_at->format('d M, Y') }}</small>
        </div>


        <!-- Delete Project Form with Confirmation -->
        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="mt-6" id="delete-form">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDelete(event)"
                class="px-6 py-3 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-300">
                Delete task
            </button>
        </form>
    </div>

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Prevent form submission
            const confirmation = confirm("Are you sure you want to delete this project? This action cannot be undone.");
            if (confirmation) {
                document.getElementById('delete-form').submit(); // Submit the form if confirmed
            }
        }
    </script>
</x-app-layout>
