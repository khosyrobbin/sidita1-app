<?php

namespace App\Http\Controllers;

use App\Models\ProjectModel;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = ProjectModel::all();

        return view('project', compact('projects'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_project' => 'required|string',
            ]);

            ProjectModel::create([
                'nama_project' => $request->nama_project,
            ]);

            return redirect()->route('project.index')
                ->with('success', 'Project berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Project gagal disimpan!. ' . $e->getMessage());
        }
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
        try {
            $request->validate([
                'nama_project' => 'required|string',
            ]);

            $project->update([
                'nama_project' => $request->nama_project,
            ]);
            return redirect()->route('project.index')
                ->with('success', 'Project berhasil dupdate!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Project gagal diupdate!. ' . $e->getMessage());
        }
    }

    public function destroy(ProjectModel $project)
    {
        try {
            $project->delete();

            return redirect()->route('project.index')
            ->with('success', 'Project berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Project gagal dihapus!' . $e->getMessage());
        }
    }
}
