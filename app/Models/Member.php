<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;
    protected $table = "members";
    protected $fillable = [
        'division_id',
        'full_name',
        'gender',
        'birthday',
        'hometown',
        'start_working_date',
        'deha_mail',
        'person_mail',
        'mobile',
        'skype',
        'facebook',
        'current_accommodation',
        'experience',
        'id_card_member',
        'date_issued',
        'place_issued',
        'marital_status',
        'education',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class, 'member_id');
    }

    public function memberPositions()
    {
        return $this->hasMany(MemberPosition::class, 'member_id');
    }

    public static function getAllMembers($params = [])
    {
        $conditions = [];

        if (!empty($params['name'])) {
            array_push($conditions, ['full_name', 'like', '%' . $params['name'] . '%']);
        }
        if (!empty($params['mobile'])) {
            array_push($conditions, ['mobile', 'like', '%' . $params['mobile'] . '%']);
        }

        return Member::select('id', 'full_name', 'birthday', 'mobile', 'gender')
            ->where($conditions)
            ->with([
                'memberPositions' => function ($query) {
                    $query->select('id', 'member_id', 'position_id')
                        ->with([
                            'positions' => function ($query) {
                                $query->select('id', 'position_name');
                            },
                        ]);
                },
            ])->orderBy('id', 'desc')->paginate(PER_PAGE);
    }

    public static function getDetailMembers($params)
    {
        $memberId = $params->idMember;
        $data = Member::find($memberId);
        $division = Division::find($data->division_id);
        $data->division_name = $division->division_name;

        return $data;
    }

    private static function _formatDataMembers(&$input)
    {
        $input['birthday'] = date('Y-m-d', strtotime($input['birthday']));
        $input['start_working_date'] = date('Y-m-d', strtotime($input['start_working_date']));
        $input['date_issued'] = date('Y-m-d', strtotime($input['date_issued']));
        return $input;
    }

    private static function _formatPositions($positions)
    {
        $dataPositions = [];
        foreach ($positions as $position) {
            array_push($dataPositions, ['position_id' => $position]);
        }
        return $dataPositions;
    }

    public static function addMembers($input)
    {
        DB::beginTransaction();
        try {
            $members = Member::create(Member::_formatDataMembers($input));
            $members->memberPositions()->createMany(Member::_formatPositions($input['positions']));
            DB::commit();
            return true;
        }
        catch (\Exception $exception) {
            \Log::info($exception->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public static function getMemberInfo($memberId)
    {
        return Member::select(
            'id',
            'division_id',
            'full_name',
            'gender',
            'birthday',
            'hometown',
            'start_working_date',
            'deha_mail',
            'person_mail',
            'mobile',
            'skype',
            'facebook',
            'current_accommodation',
            'experience',
            'id_card_member',
            'date_issued',
            'place_issued',
            'marital_status',
            'education')
            ->where('id', $memberId)->first();
    }

    public static function updateMemberInfo($input)
    {
        try {
            $members = Member::getMemberInfo($input['member_id']);
            $members->update(Member::_formatDataMembers($input));
            return $members;
        } catch(\Exception $exception) {
            dd($exception->getMessage());
            Log::info($exception->getMessage());
            return false;
        }
    }

    public static function isExistMemberByPersonMail($personMail,  $id = null)
    {
        $memberPersonMail = Member::select('id', 'person_mail')
        ->where('person_mail', $personMail);

        if (!empty($id)) {
            $memberPersonMail->where('id', '<>', $id);
        }
        return $memberPersonMail->first();
    }

    public static function isExistMemberByDehaMail($dehaMail,  $id = null)
    {
        $memberDehaMail = Member::select('id', 'deha_mail')
        ->where('deha_mail', $dehaMail);

        if (!empty($id)) {
            $memberDehaMail->where('id', '<>', $id);
        }
        return $memberDehaMail->first();
    }

    public static function isExistMemberByMobile($mobile,  $id = null)
    {
        $memberMobile = Member::select('id', 'mobile')
        ->where('mobile', $mobile);

        if (!empty($id)) {
            $memberMobile->where('id', '<>', $id);
        }
        return $memberMobile->first();
    }

    public static function isExistMemberByIdCard($idCard,  $id = null)
    {
        $memberIdCard = Member::select('id', 'id_card_member')
        ->where('id_card_member', $idCard);

        if (!empty($id)) {
            $memberIdCard->where('id', '<>', $id);
        }
        return $memberIdCard->first();
    }
    
    public static function deleteMembers($input)
    {
        Member::where('id', $input)->delete();
        return true;
    }

    public static function getListMemberDropdownList()
    {
        $members = Member::select('id', 'full_name')->get();
        return $members;
    }
}
