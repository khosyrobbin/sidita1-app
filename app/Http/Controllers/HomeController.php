<?php

namespace App\Http\Controllers;

use App\Models\ProjectModel;
use App\Models\WorklogModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $groupedWorklogs = WorklogModel::groupByMonth();

        return view('home', compact('groupedWorklogs'));
    }
}
