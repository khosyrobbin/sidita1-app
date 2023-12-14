<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WorklogModel extends Model
{
    use HasFactory;
    protected $table = 'worklogs';
    protected $fillable = [
        'project_id',
        'user_id',
        'work_date',
        'hours_worked',
    ];

    public function project()
    {
        return $this->belongsTo(ProjectModel::class);
    }

    public static function groupByMonth()
    {
        $userId = Auth::user()->id;

        // return static::selectRaw('MONTH(work_date) as month, YEAR(work_date) as year, SUM(hours_worked) as total_hours')
        //     ->where('user_id', $userId)
        //     ->groupBy('year', 'month')
        //     ->orderBy('year', 'desc')
        //     ->orderBy('month', 'desc')
        //     ->get();

        return static::selectRaw('EXTRACT(MONTH FROM work_date) as month, EXTRACT(YEAR FROM work_date) as year, SUM(hours_worked) as total_hours, user_id')
            ->groupBy('year', 'month', 'user_id')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
    }
}
