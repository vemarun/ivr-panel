<?php

namespace App\Http\Controllers;

use App\callReports;
use App\clientManageSources;
use App\manageAgents;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Response;
use Session;
use Yajra\Datatables\Datatables;

class ManageAgentsController extends Controller
{

    public function store(Request $request)
    {

        #Validate form
        $this->validate(request(), [
            'agent_destination' => 'required|max:11|min:10',
        ]);

        #fetch all form data except _token field
        $detail = $request->except(['_token']);

        if (empty($detail['group'])) {
            $detail['group'] = '';
        }

        $query = manageAgents::create([
            'user_id' => Auth::user()->id,
            'source_number' => $detail['source_number'],
            'agent_name' => $detail['agent_name'],
            'agent_destination' => $detail['agent_destination'],
            'ext' => $detail['ext'],
            'group_id' => $detail['group'],
        ]);

        if ($query) {
            return Response::json([
                'message' => "Agents details saved successfully."], 201);
        }

        /** in case error **/
        return Response::json([
            'message' => "Please Check submitted data"], 422);
    }

    /**************************************************
     *
     *  Get Source number Agents
     *
     *********************************************/
    public function manageAgents(Request $request, manageAgents $manage)
    {

        $user_id = Auth::user()->id;
        $source_number = Session::get('source_number');

        if ($request->filled('search')) {
            $search = $request->search;
        } else {
            $search = '';
        }
        if ($request->filled('page')) {
            $page = $request->page;
        } else {
            $page = 1;
        }
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $agents = $manage->where(function ($agents) use ($user_id, $source_number) {
            $agents->where('user_id', $user_id)->where('source_number', $source_number);
        })->where(function ($agents) use ($search) {
            $agents = $agents->where('agent_name', 'like', '%' . $search . '%')
                ->orWhere('agent_destination', 'like', '%' . $search . '%');
        })->with('group')->orderBy('is_active', 'desc')->paginate(200);

        return Response::json($agents, 201);

    }

    // it doesn't delete, only disables/enables the agent
    public function deleteAgent(Request $request, manageAgents $manageAgents)
    {
        $this->validate($request, [
            'agent_id' => 'required',
        ]);

        $agent = $manageAgents->where('id', $request->agent_id)->first();

        if ($agent->user_id != Auth::user()->id) {
            return Response::json(['message' => 'Not your agent'], 400);
        } else {
            $agent->is_active == 1 ? $agent->update(['is_active' => 0]) : $agent->update(['is_active' => 1]);
        }
        return Response::json(['message' => 'Success, Agent Status modified'], 201);
    }

    // this one deletes agent
    public function hardDeleteAgent(Request $request, manageAgents $manageAgents)
    {
        $this->validate($request, [
            'agent_id' => 'required',
        ]);

        $agent = $manageAgents->where('id', $request->agent_id)->first();

        if ($agent->user_id != Auth::user()->id) {
            return Response::json(['message' => 'Not your agent'], 400);
        } else {
            $agent->delete();
        }
        return Response::json(['message' => 'Success, Agent Deleted'], 201);
    }

    #[admin]
    protected function admin_getagents(manageAgents $data, Datatables $datatables)
    {
        if (Auth::user()->client_type != 'admin') {
            return Response::json(['message' => "Not allowed"], 400);
        } else {
            return $datatables->collection($data->with('users')->get())->make(true);
        }
    }

    public function editAgent(Request $request, manageAgents $manageAgents)
    {
        $this->validate($request, [
            'agent_id' => 'required',
        ]);

        $agent = $manageAgents->where('id', $request->agent_id)->first();

        if ($agent->user_id != Auth::user()->id) {
            return Response::json(['message' => 'Not your agent'], 400);
        }

        if ($request->filled('agent_destination')) {
            $agent->agent_destination = $request->agent_destination;
        }
        if ($request->filled('agent_name')) {
            $agent->agent_name = $request->agent_name;
        }

        if ($request->filled('group')) {
            $agent->group_id = $request->group;
        }

        if ($request->filled('ext')) {
            $agent->ext = $request->ext;
        }

        if ($agent->save()) {
            return Response::json(['message' => 'Success, Agent Details Edited'], 201);
        } else {
            return Response::json(['message' => 'Unexpected error'], 422);
        }

    }

    public function moveAgent(Request $request, manageAgents $manageAgents, clientManageSources $source_numbers)
    {
        $this->validate($request, [
            'agent_id' => 'required',
            'source_number' => 'required',
        ]);

        $source_number = $source_numbers->find($request->source_number);

        if ($source_number->user_id != Auth::user()->id) {
            return Response::json(['message' => 'Not your source_number'], 400);
        }

        $agent = $manageAgents->where('id', $request->agent_id)->first();

        if ($agent->user_id != Auth::user()->id) {
            return Response::json(['message' => 'Not your agent'], 400);
        }

        if ($request->filled('source_number')) {
            $agent->source_number = $request->source_number;

        }

        if ($agent->save()) {
            return Response::json(['message' => 'Success, Agent moved to another source_number'], 201);
        } else {
            return Response::json(['message' => 'Unexpected error'], 400);
        }

    }

    public function copyAgent(Request $request, manageAgents $manageAgents, clientManageSources $source_numbers)
    {
        $this->validate($request, [
            'agent_id' => 'required',
            'source_number' => 'required',
        ]);

        $source_number = $source_numbers->find($request->source_number);

        if ($source_number->user_id != Auth::user()->id) {
            return Response::json(['message' => 'Not your source_number'], 400);
        }

        $agent = $manageAgents->where('id', $request->agent_id)->first();

        if ($agent->user_id != Auth::user()->id) {
            return Response::json(['message' => 'Not your agent'], 400);
        }

        $copy_agent = $agent->replicate();
        $copy_agent->source_number = $request->source_number;

        if ($copy_agent->save()) {
            return Response::json(['message' => 'Success, Agent Copied to another source_number'], 201);
        } else {
            return Response::json(['message' => 'Unexpected error'], 400);
        }

    }

    public function copyAll(Request $request, manageAgents $manageAgents, clientManageSources $source_numbers)
    {
        $this->validate($request, [
            'source_number1' => 'required',
            'source_number2' => 'required',
        ]);

        $source_number1 = $request->source_number1;
        $source_number2 = $request->source_number2;
        $user_id = Auth::user()->id;

        $source_number = $source_numbers->find($source_number1);
        if ($source_number1->user_id != Auth::user()->id) {
            return Response::json(['message' => 'Not your source_number1'], 400);
        }
        $source_number = $source_numbers->find($source_number2);
        if ($source_number2->user_id != Auth::user()->id) {
            return Response::json(['message' => 'Not your source_number2'], 400);
        }

        $agents = $manageAgents->where('user_id', $user_id)
            ->where('source_number', $source_number1)->get();

        foreach ($agents as $agent) {
            $newagent = $agent->replicate();
            $newagent->source_number = $source_number2;
            $newagent->save();
        }

        return Response::json(['message' => "Success, Source Number:{$source_number1} agents copied to {$source_number2}"], 201);

    }

    public function moveAll(Request $request, manageAgents $manageAgents, clientManageSources $source_numbers)
    {
        $this->validate($request, [
            'source_number1' => 'required',
            'source_number2' => 'required',
        ]);

        $source_number1 = $request->source_number1;
        $source_number2 = $request->source_number2;
        $user_id = Auth::user()->id;

        $source_number = $source_numbers->find($source_number1);
        if ($source_number->user_id != Auth::user()->id) {
            return Response::json(['message' => 'Not your source_number1'], 400);
        }
        $source_number = $source_numbers->find($source_number2);
        if ($source_number->user_id != Auth::user()->id) {
            return Response::json(['message' => 'Not your source_number2'], 400);
        }

        $agents = $manageAgents->where('user_id', $user_id)
            ->where('source_number', $source_number1)
            ->update(['source_number' => $source_number2]);

        return Response::json(['message' => "Success, Source Number:{$source_number1} agents moved to {$source_number2}"], 201);

    }

    public function agentReport(Request $request, manageAgents $manageAgent, callReports $callReports)
    {
        $source_number = Session::get('source_number');
        $user_id = Auth::user()->id;

        if ($request->filled('start_date')) {
            $start_date = $request->start_date;
            $year = date('Y', strtotime($start_date));
        } else {
            $start_date = date('Y-m-d');
            $year = date('Y');
        }
        if ($request->filled('end_date')) {
            $end_date = $request->end_date;
        } else {
            $end_date = date('Y-m-d');
        }

        if ($request->filled('agent')) {
            $agent = $request->agent;
        } else {
            $agent = '';
        }

        if ($request->filled('start_date')) {
            $start_date = $request->start_date;
        } else {
            $start_date = date('Y-m-d');
        }

        if ($request->filled('end_date')) {
            $end_date = $request->end_date;
        } else {
            $end_date = date('Y-m-d');
        }
        if (empty($agent)) {
            $agent_detail = DB::select("select count(if(is_active=1,1,NULL)) 'active_agents',
                                              count(if(is_active=0,1,NULL)) 'inactive_agents'
                                              from manage_agents where user_id=$user_id and
                                              source_number='$source_number'
                                            ");
            $agents = $manageAgent->where('user_id', $user_id)->where('source_number', $source_number)->get();
            foreach ($agents as $iagent) {
                $icall_count = $callReports->where('user_id', $user_id)
                    ->where('source_number', $source_number)
                    ->where('agent_number', 'like', '%' . $iagent->agent_destination . '%')
                    ->count();

                $iinbound_calls = $callReports->where('user_id', $user_id)
                    ->where('source_number', $source_number)
                    ->where('agent_number', 'like', '%' . $iagent->agent_destination . '%')
                    ->where('call_type', 'Inbound')
                    ->count();

                $ioutbound_calls = $callReports->where('user_id', $user_id)
                    ->where('source_number', $source_number)
                    ->where('agent_number', 'like', '%' . $iagent->agent_destination . '%')
                    ->where('call_type', 'Outbound')
                    ->count();

                $itotal_call_duration = $callReports->where('user_id', $user_id)
                    ->where('source_number', $source_number)
                    ->where('agent_number', 'like', '%' . $iagent->agent_destination . '%')
                    ->sum('conv_duration');

                $each_agent_report[] = [
                    'agent_name' => $iagent->agent_name,
                    'agent_number' => $iagent->agent_destination,
                    'call_count' => $icall_count,
                    'inbound_calls' => $iinbound_calls,
                    'outbound_calls' => $ioutbound_calls,
                    'total_call_duration' => $itotal_call_duration,
                    'agent_rating' => $iagent->agent_rating,
                    'created_at' => $iagent->created_at,
                    'is_active' => $iagent->is_active == 1 ? 'Active' : 'Disabled',
                ];
            }
            $agent_number = '';
            $recent_call = '';
        } else {
            $agent_detail = $manageAgent->where('user_id', $user_id)
                ->where('source_number', $source_number)
                ->where('id', $agent)
                ->first();

            $agent_number = $agent_detail->agent_destination;
            $recent_call = $callReports->where('user_id', $user_id)
                ->where('source_number', $source_number)
                ->where('agent_number', $agent_number)->paginate(10);

            $each_agent_report = '';
        }

        $call_count = $callReports->where('user_id', $user_id)
            ->where('source_number', $source_number)
            ->where('agent_number', 'like', '%' . $agent_number . '%')
            ->count();

        $inbound_calls = $callReports->where('user_id', $user_id)
            ->where('source_number', $source_number)
            ->where('agent_number', 'like', '%' . $agent_number . '%')
            ->where('call_type', 'Inbound')
            ->count();

        $outbound_calls = $callReports->where('user_id', $user_id)
            ->where('source_number', $source_number)
            ->where('agent_number', 'like', '%' . $agent_number . '%')
            ->where('call_type', 'Outbound')
            ->count();

        $average_call_duration = $callReports->where('user_id', $user_id)
            ->where('source_number', $source_number)
            ->where('agent_number', 'like', '%' . $agent_number . '%')
            ->avg('conv_duration');

        $average_inbound_call_duration = $callReports->where('user_id', $user_id)
            ->where('source_number', $source_number)
            ->where('agent_number', 'like', '%' . $agent_number . '%')
            ->where('call_type', 'Inbound')
            ->avg('conv_duration');

        $average_outbound_call_duration = $callReports->where('user_id', $user_id)
            ->where('source_number', $source_number)
            ->where('agent_number', 'like', '%' . $agent_number . '%')
            ->where('call_type', 'Outbound')
            ->avg('conv_duration');

        $total_call_duration = $callReports->where('user_id', $user_id)
            ->where('source_number', $source_number)
            ->where('agent_number', 'like', '%' . $agent_number . '%')
            ->sum('conv_duration');

        $total_inbound_call_duration = $callReports->where('user_id', $user_id)
            ->where('source_number', $source_number)
            ->where('agent_number', 'like', '%' . $agent_number . '%')
            ->where('call_type', 'Inbound')
            ->sum('conv_duration');

        $total_outbound_call_duration = $callReports->where('user_id', $user_id)
            ->where('source_number', $source_number)
            ->where('agent_number', 'like', '%' . $agent_number . '%')
            ->where('call_type', 'Outbound')
            ->sum('conv_duration');

        $monthWiseData = DB::select("select count(*) as count,
                                            DATE_FORMAT(`start_time`,'%M') as month from call_reports
                                            where source_number=$source_number
                                            and agent_number like '%$agent_number%'
                                            and YEAR(start_time) =$year  group by month(start_time)");

        $data = [
            'agent_detail' => $agent_detail,
            'agent_number' => $agent_number,
            'call_count' => $call_count,
            'inbound_calls' => $inbound_calls,
            'outbound_calls' => $outbound_calls,
            'average_call_duration' => $average_call_duration,
            'average_inbound_call_duration' => $average_inbound_call_duration,
            'average_outbound_call_duration' => $average_outbound_call_duration,
            'total_call_duration' => $total_call_duration,
            'total_outbound_call_duration' => $total_outbound_call_duration,
            'total_inbound_call_duration' => $total_inbound_call_duration,
            'each_agent_report' => $each_agent_report,
            'recent_calls' => $recent_call,
            'month_wise_data' => $monthWiseData,
        ];

        return $data;

    }

}
