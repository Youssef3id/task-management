<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Tasks for {{ $user->name }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Here are the tasks assigned to {{ $user->name }}.
                </p>
            </div>
            <div class="border-t border-gray-200">
                @if ($tasks->isEmpty())
                    <p class="px-4 py-5 text-sm text-gray-500">No tasks assigned to this user.</p>
                @else
                    <div class="space-y-4 px-4 py-5 sm:px-6">
                        @foreach ($tasks as $task)
                            <div class="bg-gray-50 px-6 py-4 rounded-lg shadow">
                                <h4 class="text-lg font-semibold text-gray-800">{{ $task->name }}</h4>
                                <p class="text-sm text-gray-600">Description: {{ $task->description }}</p>
                                <p class="text-sm text-gray-600">
                                    Status:
                                    @if ($task->completed == 0)
                                        Not Completed
                                    @else
                                        Completed
                                    @endif
                                </p>
                                <p class="text-sm text-gray-600"> Date:
                                    {{ $task->created_at ? \Carbon\Carbon::parse($task->created_at)->format('M d, Y') : 'Not set' }}
                                </p>
                                <!-- Edit and Delete Buttons -->
                                <div class="flex space-x-4 mt-4">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.edit-task', ['task' => $task->id]) }}"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                        Edit Task
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.delete-task', ['task' => $task->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this task?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                            Delete Task
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
