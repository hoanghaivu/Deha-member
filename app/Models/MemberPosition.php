<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberPosition extends Model
{
    use SoftDeletes;
    protected $table = "member_positions";
    protected $fillable = [
        'member_id',
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

    public function positions()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
}
