<x-app-layout>
    <!-- Search Bar -->
    <div class="mt-6">
        <form method="GET" action="{{ route('dashboard') }}" id="search-form" class="flex items-center space-x-4">
            <input type="text" name="search" value="{{ request()->get('search') }}" id="search-input"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Search by name" required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md"
                style="display: none;">Search</button>
        </form>
    </div>

    <!-- Create Task Button (Initially Hidden) -->
    <a href="{{ route('admin.create-task', ['userId' => $selectedUserId ?? '']) }}"
        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300"
        id="create-task-btn" style="display: none;">Create Task</a>

    <!-- Users List -->
    <div class="mt-6" id="users-list">
        @if ($users->count() > 0)
            <div class="space-y-4">
                @foreach ($users as $user)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h4 class="font-semibold">{{ $user->name }}</h4>
                        <p>Email: {{ $user->email }}</p>
                        <!-- User Specific Button to Create Task -->
                        <a class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"
                            onclick="selectUser({{ $user->id }})">
                            Select user
                        </a>
                        <a href="{{ route('admin.user-tasks', ['user' => $user->id]) }}"
                            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                            View User
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $users->appends(request()->query())->links() }}
            </div>
        @else
            <p>No users found</p>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Trigger the AJAX request whenever the user types in the search input
            $('#search-input').on('keyup', function() {
                let searchQuery = $(this).val(); // Get the value of the search input

                // If the search query is empty, don't perform any request
                if (searchQuery.length > 0) {
                    $.ajax({
                        url: '{{ route('dashboard') }}',
                        method: 'GET',
                        data: {
                            search: searchQuery
                        },
                        success: function(response) {
                            let usersHtml = '';
                            if (response.users.data.length > 0) {
                                response.users.data.forEach(function(user) {
                                    usersHtml += `
                                        <div class="bg-white p-4 rounded-lg shadow-md">
                                            <h4 class="font-semibold">${user.name}</h4>
                                            <p>Email: ${user.email}</p>
                                            <a class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600" onclick="selectUser(${user.id})">
                                                Select user
                                            </a>
                                        </div>
                                    `;
                                });
                                $('#users-list').html(usersHtml);
                                $('#users-list').append(response.users.links);
                            } else {
                                $('#users-list').html('<p>No users found</p>');
                            }
                        }
                    });
                } else {
                    // If the search query is empty, show the original list of users
                    $('#users-list').html('<p>No users found</p>');
                }
            });
        });

        function selectUser(userId) {
            // Set the selected user ID in the Create Task button's href
            let createTaskBtn = document.getElementById('create-task-btn');
            createTaskBtn.style.display = 'inline-block'; // Show the Create Task button
            createTaskBtn.href = `{{ url('admin/create-task') }}?userId=${userId}`;

            // Optionally, you can store the selected userId in a global variable for future use
            window.selectedUserId = userId;
        }
    </script>
</x-app-layout>
