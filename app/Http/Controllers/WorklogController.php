<?php

namespace App\Http\Controllers;

use App\Models\ProjectModel;
use App\Models\WorklogModel;
use Illuminate\Http\Request;

class WorklogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $worklog = WorklogModel::all();
        $project = ProjectModel::get();

        return view('worklog', compact('worklog','project'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'project_id' => 'required|string',
            'work_date' => 'required',
            'hours_worked' => 'required|string',
        ]);

        WorklogModel::create([
            'user_id' => $request->user_id,
            'project_id' => $request->project_id,
            'work_date' => $request->work_date,
            'hours_worked' => $request->hours_worked,
        ]);

        return redirect()->route('worklog.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorklogModel $worklog)
    {
        $project = ProjectModel::get();

        return view('components.worklog.EditWorklog', compact('worklog','project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorklogModel $worklog)
    {
        $request->validate([
            'user_id' => 'required|string',
            'project_id' => 'required|string',
            'work_date' => 'required',
            'hours_worked' => 'required|string',
        ]);

        $worklog->update([
            'user_id' => $request->user_id,
            'project_id' => $request->project_id,
            'work_date' => $request->work_date,
            'hours_worked' => $request->hours_worked,
        ]);

        return redirect()->route('worklog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorklogModel $worklog)
    {
        $worklog->delete();

        return redirect()->route('worklog.index');
    }
}
