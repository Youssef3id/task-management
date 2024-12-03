<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects; // جلب المشاريع الخاصة بالمستخدم الحالي
        return view('projects.index', compact('projects'));
    }
    public function create()
    {
        return view('projects.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        auth()->user()->projects()->create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
    }
    public function show($id)
    {
        $project = auth()->user()->projects()->findOrFail($id);
        return view('projects.show', compact('project'));
    }
    public function edit($id)
    {
        $project = auth()->user()->projects()->findOrFail($id);
        return view('projects.edit', compact('project'));
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
    public function destroy($id)
    {
        $project = auth()->user()->projects()->findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }
    public function markComplete(Project $project)
    {
        $project->completed = true;
        $project->save();

        return redirect()->route('projects.index');
    }





}
