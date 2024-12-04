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
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
