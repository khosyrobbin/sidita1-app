<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
