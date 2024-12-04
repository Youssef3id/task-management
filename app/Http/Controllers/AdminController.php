<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Project;

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
        // Fetch tasks for the given user
        $tasks = $user->projects;

        // Return the tasks in a view
        return view('admin.user-tasks', compact('user', 'tasks'));
    }
    public function create()
    {
        $users = User::all(); // Get all users to assign tasks to
        return view('admin.create-task', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Project::create([
            'user_id' => $request->user_id,
            'name' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.create-task')->with('success', 'Task created successfully!');
    }

}


