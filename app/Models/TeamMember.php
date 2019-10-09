<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use SoftDeletes;
    protected $table = "team_members";
    protected $fillable = [
        'member_id',
        'team_id',
        'position_id',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function members()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function teams()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function positions()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
}
