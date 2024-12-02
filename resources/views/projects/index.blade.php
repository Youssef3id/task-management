<x-app-layout>
    <div class="container py-5 mx-auto">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-2xl font-semibold">My Tasks</h1>
            <a href="{{ route('projects.create') }}"
                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300">+ Create
                New Task</a>
        </div>

        @if ($projects->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($projects as $project)
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <h5 class="text-xl font-semibold text-blue-600">{{ $project->name }}</h5>
                        <p class="text-gray-600">{{ Str::limit($project->description, 100, '...') }}</p>
                        <small class="text-gray-500">Created on {{ $project->created_at->format('d M, Y') }}</small>
                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('projects.show', $project->id) }}"
                                class="text-blue-500 hover:text-blue-600 transition duration-300">View</a>
                            <a href="{{ route('projects.edit', $project->id) }}"
                                class="text-gray-500 hover:text-gray-600 transition duration-300">Edit</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="mt-8 text-center text-gray-600">
                <p>No Taskes found. Start by creating one!</p>
            </div>
        @endif
    </div>
</x-app-layout>
