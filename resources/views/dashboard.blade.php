<x-app-layout>

    <a href="{{ route('admin.create-task') }}"
        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300">+ Create
        New Task</a>
    <!-- Users Cards Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($users as $user)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-gray-600">Email: {{ $user->email }}</p>
                    <button
                        class="mt-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-300"
                        onclick="window.location.href='{{ route('admin.user.tasks', $user->id) }}'">
                        View Tasks
                    </button>

                </div>
            </div>
        @endforeach
    </div>

    <!-- Tasks Section -->
    <div id="tasks-container" class="mt-6">
        <!-- Tasks will be dynamically loaded here -->
    </div>
    </div>

    <script>
        document.querySelectorAll('.view-tasks').forEach(button => {
            button.addEventListener('click', function() {
                let userId = this.getAttribute('data-user-id');

                // Fetch the tasks for the selected user using AJAX
                fetch(`/admin/user/${userId}/tasks`)
                    .then(response => response.json())
                    .then(tasks => {
                        let tasksContainer = document.getElementById('tasks-container');
                        tasksContainer.innerHTML = ''; // Clear previous tasks

                        if (tasks.length > 0) {
                            tasks.forEach(task => {
                                let taskElement = document.createElement('div');
                                taskElement.classList.add('bg-white', 'shadow-lg', 'rounded-lg',
                                    'p-6', 'mt-4');
                                taskElement.innerHTML = `
                                    <h4 class="text-lg font-semibold text-gray-800">Task: ${task.title}</h4>
                                    <p class="text-gray-600">Status: ${task.status}</p>
                                `;
                                tasksContainer.appendChild(taskElement);
                            });
                        } else {
                            tasksContainer.innerHTML = '<p>No tasks available for this user.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching tasks:', error);
                    });
            });
        });
    </script>
</x-app-layout>
