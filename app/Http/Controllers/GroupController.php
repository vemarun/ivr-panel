<?php

namespace App\Http\Controllers;

use App\group;
use Auth;
use Illuminate\Http\Request;
use Response;

class GroupController extends Controller
{
    public function index(group $group)
    {
        $groups = $group->where('user_id', Auth::user()->id)->get();
        return $groups;
    }

    public function create(Request $request, group $group)
    {
        $this->validate($request, [
            'group' => 'required',
        ]);

        $group->user_id = Auth::user()->id;
        $group->source_number = session('source_number');
        $group->group_name = $request->group;
        $group->holidays = json_encode($request->holidays);
        $group->office_start_time = $request->office_start_time;
        $group->office_end_time = $request->office_end_time;

        try {
            $group->save();
            return Response::json(['message' => 'Group successfully created'], 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return Response::json(['message' => 'Something went wrong. This groupname might already exist. Try another groupname.'], 400);
        }

    }

    public function delete()
    {

    }

    public function update()
    {

    }
}
