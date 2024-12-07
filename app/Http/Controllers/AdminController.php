<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Project;
use App\Mail\TaskAssigned;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all users with their tasks
        $users = User::with('projects')->get();

        // Pass the users data to the view
        return view('dashboard', compact('users'));
    }
    public function showUserTasks(User $user)
    {
        // Fetch tasks associated with the user
        $tasks = $user->projects; // Ensure the 'projects' relationship exists

        // Return the view
        return view('admin.user-tasks', compact('user', 'tasks'));
    }
    public function create(request $request)
    {
        $userId = $request->query('userId');
        $user = User::findOrFail($userId);

        return view('admin.create-task', compact('user'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure the user exists in the 'users' table
            'title' => 'required|string|max:255',    // Task title is required
            'description' => 'nullable|string',     // Description is optional
        ]);

        // Create the new task with the provided user_id, title, and description
        $task = Project::create([
            'user_id' => $request->user_id,  // Assign the task to the user
            'name' => $request->title,       // Set the task title
            'description' => $request->description, // Set the task description
        ]);

        // Send the email to the user who is assigned the task
        $user = $task->user; // Assuming you have a relationship between Task and User
        Mail::to($user->email)->later(now()->addSeconds(10), new TaskAssigned($task));
        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }

    public function dashboard(Request $request)
    {
        $search = $request->input('search');

        // Query users based on the search term, exclude the logged-in user, and paginate
        $users = User::where('id', '!=', auth()->id()) // Exclude logged-in user
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(5); // 10 users per page

        // Check if it's an AJAX request
        if ($request->ajax()) {
            return response()->json([
                'users' => $users
            ]);
        }

        return view('dashboard', compact('users'));
    }
    public function edit($taskId)
    {
        $user = User::all();
        $task = Project::findOrFail($taskId);
        return view('projects.edit', compact('task', 'user'));
    }
    public function update(Request $request, $taskId)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Find and update the task
        $task = Project::findOrFail($taskId);
        $task->update($validatedData);

        // Redirect back with a success message
        return back()->with('success', 'Task updated successfully');
    }
    public function destroy($taskId)
    {
        $task = Project::findOrFail($taskId);
        $task->delete();
        return redirect()->route('admin.user-tasks', ['user' => $task->user_id])->with('success', 'Task deleted successfully');
    }
}


