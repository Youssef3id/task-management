<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Mail\TaskCompleted;
use Illuminate\Support\Facades\Mail;
use App\Models\Project;
class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;
        return view('projects.index', compact('projects'));
    }
    public function show($id)
    {
        $project = auth()->user()->projects()->findOrFail($id);
        return view('projects.show', compact('project'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = auth()->user()->projects()->findOrFail($id);
        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }
    public function markComplete(Project $project)
    {
        // Mark the task as completed
        $project->completed = true;
        $project->save();

        // Send email to the admin notifying about the completed task
        $adminEmail = 'youssef.3id@icloud.com'; // Replace with your admin's email address
        Mail::to($adminEmail)->send(new TaskCompleted($project));

        // Redirect to the projects index page
        return redirect()->route('projects.index')->with('success', 'Task completed successfully and admin notified!');
    }





}
