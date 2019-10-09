<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;
    protected $table = "teams";
    protected $fillable = [
        'division_id',
        'team_name',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class, 'team_id');
    }

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->using(TeamMember::class);
    }

    public static function getAllTeams($params = [])
    {
        $conditions = [];

        if (!empty($params['team_name'])) {
            array_push($conditions, ['team_name', 'like', '%' . $params['team_name'] . '%']);
        }

        return Team::select('id', 'team_name', 'division_id')
            ->where($conditions)
            ->withCount('teamMembers')
            ->orderBy('id', 'desc')
            ->paginate(PER_PAGE);
    }

    private static function _formatMembers($members)
    {
        $dataMembers = [];
        foreach ($members as $member) {
            array_push($dataMembers, ['member_id' => $member]);
        }
        return $dataMembers;
    }

    public static function addTeams($input)
    {
        DB::beginTransaction();
        try {
            $teams = Team::create($input);
            $teams->teamMembers()->createMany(Team::_formatMembers($input['members']));
            DB::commit();
            return true;
        }
        catch (\Exception $exception) {
            \Log::info($exception->getMessage());
            DB::rollBack();
            return false;
        }
    }
}