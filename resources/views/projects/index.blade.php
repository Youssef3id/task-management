<x-app-layout>
    <div class="container py-5 mx-auto">
        @if (auth()->user() && auth()->user()->role === 'user')
            <div class="mb-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold">My Tasks</h1>

            </div>
        @endif
        @if ($projects->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($projects as $task)
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <h5 class="text-xl font-semibold text-blue-600">{{ $task->name }}</h5>
                        <p class="text-gray-600">{{ Str::limit($task->description, 100, '...') }}</p>
                        <small class="text-gray-500">Created on {{ $task->created_at->format('d M, Y') }}</small>
                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('projects.show', $task->id) }}"
                                class="text-blue-500 hover:text-blue-600 transition duration-300">View</a>

                            <!-- Mark as Complete Button -->
                            @if (!$task->completed)
                                <form action="{{ route('projects.complete', $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-300">
                                        Mark as Complete
                                    </button>
                                </form>
                            @else
                                <span class="text-green-500">Completed</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            @if (auth()->user() && auth()->user()->role === 'user')
                <div class="mt-8 text-center text-gray-600">
                    <p>No Tasks found. Start by creating one!</p>
            @endif
    </div>
    @endif
    </div>
</x-app-layout>
