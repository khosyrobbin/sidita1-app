<?php

namespace App\Http\Controllers;

use App\Models\ProjectModel;
use App\Models\WorklogModel;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WorklogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $worklog = WorklogModel::orderBy('work_date', 'desc')->get();
        $project = ProjectModel::get();

        return view('worklog', compact('worklog', 'project'));
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required|string',
    //         'project_id' => 'required|string',
    //         'work_date' => 'required',
    //         'hours_worked' => 'required|string',
    //     ]);

    //     WorklogModel::create([
    //         'user_id' => $request->user_id,
    //         'project_id' => $request->project_id,
    //         'work_date' => $request->work_date,
    //         'hours_worked' => $request->hours_worked,
    //     ]);

    //     return redirect()->route('worklog.index');
    // }
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'project_id' => 'required',
                'user_id' => 'required',
                'work_date' => 'required|date',
                'hours_worked' => [
                    'required',
                    'numeric',
                    'min:1',
                    function ($attribute, $value, $fail) use ($request) {
                        $totalHoursWorked = WorklogModel::where('user_id', $request->user_id)
                            ->where('work_date', $request->work_date)
                            ->sum('hours_worked');

                        if (($totalHoursWorked + $value) > 8) {
                            $fail('Total jam kerja pada tanggal yang sama tidak boleh melebihi 8 jam.');
                        }
                    },
                ],
            ]);

            WorklogModel::create($request->all());

            return redirect()->route('worklog.index')
                ->with('success', 'Worklog berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Sehari maksimal 8 jam kerja. ' . $e->getMessage());
        }
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

        return view('components.worklog.EditWorklog', compact('worklog', 'project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorklogModel $worklog)
    {
        try {
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

            return redirect()->route('worklog.index')
            ->with('success', 'Worklog berhasil diperbarui!');;
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Sehari maksimal 8 jam kerja. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorklogModel $worklog)
    {
        try {
            $worklog->delete();

        return redirect()->route('worklog.index')
        ->with('success', 'Worklog berhasil dihapus!');;
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Worklog gagal dihapus!. ' . $e->getMessage());
        }
    }
}
