<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleOverTime extends Model
{
    use SoftDeletes;
    protected $table = "schedule_over_times";
    protected $fillable = [
        'team_id',
        'date_ot',
        'memo',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function teams()
    {
        return $this->hasMany(Team::class, 'team_id', 'id');
    }
}