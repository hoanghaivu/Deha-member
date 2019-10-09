<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Member;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function index()
    {
        $params = request()->all();
        $teams = Team::getAllTeams($params);
        $divisions = Division::getListDivisionDropdownList();
        return view('teams.list', compact('teams', 'divisions'));
    }

    public function listMember()
    {
        return Member::getListMemberDropdownList();
    }

    public function store(Request $request)
    {
        $input = $request->all();
        if(Team::addTeams($input)) {
            session()->flash(SUCCESS, __('dehaMessage.team.add_success'));
        } else {
            session()->flash(ERROR, __('dehaMessage.team.add_failed'));
        }
    }
}