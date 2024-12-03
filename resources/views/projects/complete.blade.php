<x-app-layout>
    <div class="container py-5 mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold">Complete Task</h1>
            <a href="{{ route('projects.index') }}"
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition duration-300">Back to
                Projects</a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <h5 class="text-xl font-semibold text-blue-600">{{ $project->name }}</h5>
            <p class="text-gray-600">{{ Str::limit($project->description, 100, '...') }}</p>

            <div class="mt-4">
                <h6 class="font-semibold text-gray-700">Task: {{ $task->name }}</h6>
                <p class="text-gray-600">{{ $task->description }}</p>

                @if (!$task->completed)
                    <form action="{{ route('tasks.complete', ['project' => $project->id, 'task' => $task->id]) }}"
                        method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-300">
                            Mark Task as Completed
                        </button>
                    </form>
                @else
                    <p class="text-green-600 font-semibold mt-4">Task already completed!</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
