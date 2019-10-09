<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use SoftDeletes;
    protected $table = "divisions";
    protected $fillable = ['division_name'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function teams()
    {
        return $this->hasMany(Team::class, 'division_id');
    }

    public function members()
    {
        return $this->hasMany(Member::class, 'division_id');
    }
    
    public static function isExistDivisionByName($name, $id = null)
    {
        $divisionInfo = Division::select('id', 'division_name')
        ->where('division_name', $name);

        if (!empty($id)) {
            $divisionInfo->where('id', '<>', $id);
        }
        return $divisionInfo->first();
    }

    public static function getAllDivisions($params = [])
    {
        $conditions = [];

        if (!empty($params['division_name'])) {
            array_push($conditions, ['division_name', 'like', '%' . $params['division_name'] . '%']);
        }

        return Division::select('id', 'division_name')
            ->where($conditions)
            ->withCount('members')
            ->orderBy('id', 'desc')
            ->paginate(PER_PAGE);
    }

    public static function deleteDivision($divisionId)
    {
        Division::where('id', $divisionId)->delete();
        return true;
    }

    public static function addDivisions($input)
    {
        try {
            Division::create($input);
            return true;
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return false;
        }
    }

    public static function getInfoDivisions($divisionId)
    {
        return Division::select('id', 'division_name')
            ->where('id', $divisionId)->first();
    }

    public static function updateInfoDivision($input)
    {
        try {
            $divisions = Division::getInfoDivisions($input['division_id']);
            $divisions->update($input);
            return $divisions;
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return false;
        }
    }

    public static function getListDivisionDropdownList()
    {
        return Division::select('id', 'division_name')
            ->pluck('division_name', 'id')
            ->toArray();
    }
}