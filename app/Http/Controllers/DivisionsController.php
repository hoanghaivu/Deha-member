<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DivisionRequest;

class DivisionsController extends Controller
{
    public function index()
    {
        $params = request()->all();
        $divisions = Division::getAllDivisions($params);
        return view('divisions.list', compact('divisions'));
    }

    public function delete(Request $request)
    {
        $divisionId = $request->input('divisionId');
        $divisions = Division::deleteDivision($divisionId);

        if($divisions) {
            session()->flash(SUCCESS, __('dehaMessage.division.delete_success'));
            return redirect()->back();
        }

        session()->flash(ERROR, __('dehaMessage.division.delete_fail'));

        return redirect()->back();
    }

    public function create()
    {
        return view('divisions.add');
    }

    public function store(DivisionRequest $request)
    {
        $input = $request->all();
        if(Division::addDivisions($input)) {
            session()->flash(SUCCESS, __('dehaMessage.division.add_success'));
            return redirect()->route(DIVISION_LIST)->withInput();
        }

        session()->flash(ERROR, __('dehaMessage.division.add_fail'));
        return redirect()->back()->withInput();
    }

    public function edit(Request $request)
    {
        $divisions = Division::getInfoDivisions($request->id);
        abort_if(empty($divisions), 404);
        return view('divisions.edit', compact('divisions'));

    }

    public function update(DivisionRequest $request)
    {
        $input = $request->all();
        if (Division::updateInfoDivision($input)) {
            session()->flash(SUCCESS, __('dehaMessage.division.edit_success'));
            return redirect()->route(DIVISION_LIST)->withInput();
        }

        session()->flash(ERROR, __('dehaMessage.division.edit_fail'));
        return redirect()->back()->withInput();
    }
}