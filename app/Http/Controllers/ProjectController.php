<?php

namespace App\Http\Controllers;

use App\Models\ProjectModel;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = ProjectModel::all();

        return view('project', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_project' => 'required|string',
        ]);

        ProjectModel::create([
            'nama_project' => $request->nama_project,
        ]);

        return redirect()->route('project.index');
    }

    public function show(ProjectModel $project)
    {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $project
        ]);
    }

    public function edit(ProjectModel $project)
    {
        return view('components.projects.EditProject', compact('project'));
    }

    public function update(Request $request, ProjectModel $project)
    {
        $request->validate([
            'nama_project' => 'required|string',
        ]);

        $project->update([
            'nama_project' => $request->nama_project,
        ]);
        return redirect()->route('project.index');
    }

    public function destroy(ProjectModel $project)
    {
        $project->delete();

        return redirect()->route('project.index');
    }
}
