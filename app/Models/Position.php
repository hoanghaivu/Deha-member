<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;
    protected $table = "positions";
    protected $fillable = [
        'position_name',
        'memo',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function memberPositions()
    {
        return $this->hasMany(MemberPosition::class, 'position_id');
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->using( MemberPosition::class);
    }

    public static function getListPositionDropdownList()
    {
        return Position::select('id', 'position_name')
            ->pluck('position_name', 'id')
            ->toArray();
    }
}
