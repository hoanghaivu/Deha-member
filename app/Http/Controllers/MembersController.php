<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use App\Models\Division;
use App\Models\Member;

class MembersController extends Controller
{
    public function index()
    {
        $params = request()->all();
        $members = Member::getAllMembers($params);
        return view('members.list', compact('members'));
    }

    public function create()
    {
        $divisions = Division::getListDivisionDropdownList();
        $positions = Position::getListPositionDropdownList();
        return view('members.add', compact('divisions', 'positions'));
    }

    public function store(MemberRequest $request)
    {
        $input = $request->all();
        if(Member::addMembers($input)) {
            session()->flash(SUCCESS, __('dehaMessage.member.add_success'));
            return redirect()->route(MEMBER_LIST)->withInput();
        } else {
            session()->flash(ERROR, __('dehaMessage.member.add_failed'));
            return redirect()->back()->withInput();
        }
    }

    public function edit(Request $request)
    {
        $members = Member::getMemberInfo($request->id);
        $divisions = Division::getListDivisionDropdownList();
        $positions = Position::getListPositionDropdownList();
        abort_if(empty($members), 404);
        return view('members.edit', compact('members', 'divisions', 'positions'));
    }

    public function update(MemberRequest $request)
    {
        $input = $request->all();
        if(Member::updateMemberInfo($input)) {
            session()->flash(SUCCESS, __('dehaMessage.member.edit_success'));
            return redirect()->route(MEMBER_LIST)->withInput();
        }
        session()->flash(ERROR, __('dehaMessage.member.edit_fail'));
        return redirect()->back()->withInput();
    }
    
    public function detail(Request $request)
    {
        return Member::getDetailMembers($request);
    }

    public function delete(Request $request)
    {
        $input = $request->input('memberId');
        $members = Member::deleteMembers($input);

        if ($members) {
            session()->flash(SUCCESS, __('dehaMessage.member.delete_success'));
            return redirect()->back()->withInput();
        }
        session()->flash(ERROR, __('dehaMessage.member.delete_fail'));
        return redirect()->back()->withInput();
    }

}